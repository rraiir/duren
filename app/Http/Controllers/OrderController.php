<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Tampilkan daftar pesanan masuk untuk admin.
     */
    public function index(Request $request)
    {
        $activeFilter = $request->get('filter', 'all');

        // Jika rute verifikasi bayar, otomatis set filter ke verify
        if ($request->is('admin/verifikasi-bayar*')) {
            $activeFilter = 'verify';
        }

        $query = Order::with(['user', 'orderItems.product']);

        // Pencarian kode atau nama pembeli
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('code', 'like', '%' . $search . '%')
                  ->orWhereHas('user', function ($uq) use ($search) {
                      $uq->where('name', 'like', '%' . $search . '%');
                  });
            });
        }

        // Filter tipe (ready / preorder)
        if ($request->filled('type') && in_array($request->type, ['ready', 'preorder'])) {
            $query->where('type', $request->type);
        }

        // Filter status
        switch ($activeFilter) {
            case 'verify':
                $query->where('status', 'waiting_verification');
                break;
            case 'shipping':
                $query->where('status', 'waiting_shipping_fee');
                break;
            case 'process':
                $query->where('status', 'processing');
                break;
            case 'sent':
                $query->where('status', 'shipped');
                break;
            case 'done':
                $query->where('status', 'completed');
                break;
            case 'cancel':
                $query->whereIn('status', ['cancelled', 'payment_rejected']);
                break;
        }

        $orders = $query->orderByDesc('created_at')->get();

        // Hitung badge counter
        $counts = [
            'all' => Order::count(),
            'verify' => Order::where('status', 'waiting_verification')->count(),
            'shipping' => Order::where('status', 'waiting_shipping_fee')->count(),
            'process' => Order::where('status', 'processing')->count(),
            'sent' => Order::where('status', 'shipped')->count(),
            'done' => Order::where('status', 'completed')->count(),
            'cancel' => Order::whereIn('status', ['cancelled', 'payment_rejected'])->count(),
        ];

        return view('admin.orders', compact('orders', 'activeFilter', 'counts'));
    }

    /**
     * Tampilkan detail pesanan admin.
     */
    public function show($code)
    {
        $order = Order::with(['user', 'orderItems.product'])->where('code', $code)->firstOrFail();

        return view('admin.order-detail', compact('order'));
    }

    /**
     * Verifikasi bukti transfer oleh admin.
     */
    public function verify(Request $request, $code)
    {
        $order = Order::where('code', $code)->firstOrFail();

        $action = $request->input('action'); // 'accept' atau 'reject'

        if ($action === 'accept') {
            $order->status = 'waiting_shipping_fee';
            $order->verified_at = Carbon::now();
            $order->reject_reason = null;
            $order->save();

            return redirect()->route('admin.orders.show', $code)
                ->with('success', 'Pembayaran berhasil diverifikasi. Status pesanan kini Menunggu Ongkir.');
        } elseif ($action === 'reject') {
            $request->validate([
                'reject_reason' => ['required', 'string', 'max:255'],
            ], [
                'reject_reason.required' => 'Alasan penolakan bukti bayar wajib diisi.',
            ]);

            $order->status = 'payment_rejected';
            $order->reject_reason = trim($request->reject_reason);
            $order->save();

            return redirect()->route('admin.orders.show', $code)
                ->with('success', 'Bukti bayar telah ditolak dengan alasan: ' . $order->reject_reason);
        }

        return back();
    }

    /**
     * Perbarui data pengiriman (kurir & nomor resi).
     */
    public function updateShipping(Request $request, $code)
    {
        $order = Order::where('code', $code)->firstOrFail();

        $validated = $request->validate([
            'courier_name' => ['required', 'string', 'max:50'],
            'tracking_number' => ['required', 'string', 'max:50'],
        ], [
            'courier_name.required' => 'Nama kurir wajib diisi.',
            'tracking_number.required' => 'Nomor resi pengiriman wajib diisi.',
        ]);

        $order->courier_name = trim($validated['courier_name']);
        $order->tracking_number = trim($validated['tracking_number']);
        $order->status = 'shipped';
        $order->save();

        return redirect()->route('admin.orders.show', $code)
            ->with('success', 'Informasi pengiriman berhasil diperbarui. Status pesanan kini Dikirim.');
    }
}
