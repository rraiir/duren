<?php

namespace App\Http\Controllers;

use App\Models\BuyerAddress;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            case 'nego':
                $query->where('status', 'waiting_price_approval');
                break;
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
            'nego' => Order::where('status', 'waiting_price_approval')->count(),
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

    /**
     * Setujui tawaran negosiasi harga pembeli oleh admin (ala inDrive approval).
     */
    public function approveNegotiation(Request $request, $code)
    {
        $order = Order::where('code', $code)->firstOrFail();

        if ($order->negotiation_status === Order::NEGO_PENDING) {
            $order->total_price = $order->proposed_price;
            $order->negotiation_status = Order::NEGO_APPROVED;
            $order->status = Order::STATUS_WAITING_PAYMENT;
            $order->pay_deadline = Carbon::now()->addMinutes(Order::PAY_DEADLINE_MINUTES);
            $order->save();

            return back()->with('success', "Tawaran harga pesanan {$order->code} disetujui sebesar " . numberToRupiah($order->total_price) . ". Pembeli kini dapat membayar via QRIS.");
        }

        return back()->with('error', 'Pesanan tidak dalam status pengajuan negosiasi.');
    }

    /**
     * Tolak tawaran negosiasi harga pembeli oleh admin.
     */
    public function rejectNegotiation(Request $request, $code)
    {
        $order = Order::where('code', $code)->firstOrFail();

        if ($order->negotiation_status === Order::NEGO_PENDING) {
            $order->negotiation_status = Order::NEGO_REJECTED;
            $order->status = Order::STATUS_CANCELLED;
            $order->cancel_reason = $request->input('reason', 'Tawaran harga belum dapat disetujui oleh toko.');
            $order->save();

            return back()->with('info', "Tawaran harga pesanan {$order->code} ditolak.");
        }

        return back()->with('error', 'Pesanan tidak dalam status pengajuan negosiasi.');
    }

    /**
     * Tampilkan halaman checkout pembeli dengan dukungan multi-alamat dan negosiasi.
     */
    public function showCheckout(Request $request)
    {
        $user = Auth::user();
        $addresses = $user->addresses()->orderByDesc('is_primary')->get();
        $primaryAddress = $addresses->firstWhere('is_primary', true) ?? $addresses->first();

        // Ambil produk yang dibeli
        $productId = $request->input('product_id', 1);
        $product = Product::where('is_active', true)->find($productId) ?? Product::where('is_active', true)->first();
        $quantity = max(1, (int) $request->input('quantity', 1));

        // Jika ada tawaran nego dari halaman detail
        $proposedUnitPrice = (int) $request->input('proposed_price', $product ? $product->price : 0);
        $isNegotiated = $request->boolean('is_negotiated', false) && ($proposedUnitPrice < ($product ? $product->price : 0));

        return view('buyer.checkout', compact('user', 'addresses', 'primaryAddress', 'product', 'quantity', 'proposedUnitPrice', 'isNegotiated'));
    }

    /**
     * Proses pembuatan pesanan pembeli (checkout) dengan multi-alamat & negosiasi harga inDrive.
     */
    public function processCheckout(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1'],
            'address_choice' => ['required', 'in:primary,saved,new'],
            'terms' => ['accepted'],
        ], [
            'terms.accepted' => 'Anda harus menyetujui Aturan & Garansi toko untuk melanjutkan.',
        ]);

        $product = Product::findOrFail($request->product_id);
        $qty = (int) $request->quantity;

        // Validasi stok
        if ($product->isReady() && $product->stock < $qty) {
            return back()->with('error', "Stok durian {$product->name} tidak mencukupi (sisa {$product->stock}).");
        }

        // Penanganan Alamat Pengiriman
        $shippingText = '';
        if ($request->address_choice === 'new') {
            $request->validate([
                'new_recipient_name' => ['required', 'string', 'max:100'],
                'new_phone' => ['required', 'string'],
                'new_address_line' => ['required', 'string'],
            ], [
                'new_recipient_name.required' => 'Nama penerima alamat baru wajib diisi.',
                'new_phone.required' => 'Nomor WhatsApp penerima wajib diisi.',
                'new_address_line.required' => 'Alamat lengkap tujuan wajib diisi.',
            ]);

            $isFirst = $user->addresses()->count() === 0;
            $newAddr = BuyerAddress::create([
                'user_id' => $user->id,
                'label' => $request->input('new_label', 'Alamat Tambahan'),
                'recipient_name' => trim($request->new_recipient_name),
                'phone' => trim($request->new_phone),
                'address_line' => trim($request->new_address_line),
                'is_primary' => $isFirst || $request->boolean('set_primary'),
            ]);

            if ($newAddr->is_primary && ! $isFirst) {
                $user->addresses()->where('id', '!=', $newAddr->id)->update(['is_primary' => false]);
            }

            $shippingText = "{$newAddr->recipient_name} ({$newAddr->phone}) - {$newAddr->address_line}";
        } elseif ($request->address_choice === 'saved' && $request->filled('saved_address_id')) {
            $savedAddr = $user->addresses()->findOrFail($request->saved_address_id);
            $shippingText = "{$savedAddr->recipient_name} ({$savedAddr->phone}) - {$savedAddr->address_line}";
        } else {
            $primary = $user->primaryAddress ?? $user->addresses()->first();
            if ($primary) {
                $shippingText = "{$primary->recipient_name} ({$primary->phone}) - {$primary->address_line}";
            } else {
                $shippingText = "{$user->name} ({$user->phone}) - " . ($user->address ?? 'Alamat toko');
            }
        }

        // Penanganan Negosiasi inDrive
        $isNego = $request->boolean('is_negotiated');
        $proposedUnitPrice = (int) $request->input('proposed_price', $product->price);
        $totalNormal = $product->price * $qty;

        if ($isNego && $proposedUnitPrice < $product->price) {
            // Validasi batas bawah tawar (tidak boleh lebih rendah dari batas toleransi toko)
            if ($proposedUnitPrice < $product->min_negotiation_price) {
                return back()->with('error', 'Tawaran harga terlalu rendah. Batas minimal tawar adalah ' . numberToRupiah($product->min_negotiation_price) . ' per buah.');
            }

            $totalPrice = $proposedUnitPrice * $qty;
            $negoStatus = Order::NEGO_PENDING;
            $orderStatus = Order::STATUS_WAITING_PRICE_APPROVAL;
            $payDeadline = null;
        } else {
            $totalPrice = $totalNormal;
            $negoStatus = Order::NEGO_NONE;
            $orderStatus = Order::STATUS_WAITING_PAYMENT;
            $payDeadline = Carbon::now()->addMinutes(Order::PAY_DEADLINE_MINUTES);
        }

        // Generate Order Code (misal DRN-0006)
        $latestId = Order::max('id') ?? 0;
        $orderCode = 'DRN-' . str_pad($latestId + 1, 4, '0', STR_PAD_LEFT);

        DB::transaction(function () use ($orderCode, $user, $orderStatus, $product, $totalPrice, $isNego, $negoStatus, $request, $shippingText, $payDeadline, $qty) {
            $order = Order::create([
                'code' => $orderCode,
                'user_id' => $user->id,
                'status' => $orderStatus,
                'type' => $product->type,
                'total_price' => $totalPrice,
                'proposed_price' => $isNego ? $totalPrice : null,
                'negotiation_status' => $negoStatus,
                'negotiation_note' => $isNego ? trim($request->input('negotiation_note', '')) : null,
                'shipping_address' => $shippingText,
                'checkout_at' => Carbon::now(),
                'pay_deadline' => $payDeadline ?? Carbon::now()->addMinutes(15),
                'terms_accepted_at' => Carbon::now(),
            ]);

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $qty,
                'price_at_purchase' => $isNego ? (int) $request->input('proposed_price') : $product->price,
            ]);

            if ($product->isReady()) {
                $product->decrement('stock', $qty);
            }
        });

        if ($isNego) {
            return redirect()->route('buyer.orders.show', $orderCode)
                ->with('success', 'Tawaran harga Anda berhasil diajukan ke Admin. Mohon menunggu persetujuan.');
        }

        return redirect()->route('buyer.payment', $orderCode)
            ->with('success', 'Pesanan berhasil dibuat. Silakan transfer dan unggah bukti QRIS.');
    }

    /**
     * Simpan ulasan buah oleh pembeli untuk pesanan yang sudah selesai.
     */
    public function storeReview(Request $request, $code)
    {
        $user = Auth::user();
        $order = Order::with('orderItems')->where('code', $code)->where('user_id', $user->id)->firstOrFail();

        if ($order->status !== Order::STATUS_COMPLETED) {
            return back()->with('error', 'Ulasan hanya dapat diberikan untuk pesanan yang sudah selesai.');
        }

        if ($order->review()->exists()) {
            return back()->with('info', 'Anda sudah memberikan ulasan untuk pesanan ini.');
        }

        $validated = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['required', 'string', 'min:5', 'max:500'],
        ], [
            'rating.required' => 'Bintang rating wajib dipilih (1-5).',
            'comment.required' => 'Tulis ulasan rasa dan kualitas buah durian.',
            'comment.min' => 'Ulasan minimal 5 karakter.',
        ]);

        $productId = $order->orderItems->first()?->product_id ?? 1;

        Review::create([
            'order_id' => $order->id,
            'user_id' => $user->id,
            'product_id' => $productId,
            'rating' => $validated['rating'],
            'comment' => trim($validated['comment']),
        ]);

        return back()->with('success', 'Terima kasih atas ulasan buah Anda! Ulasan Anda kini tampil di toko.');
    }

    /**
     * Tampilkan riwayat pesanan milik pembeli yang sedang login.
     */
    public function buyerOrders(Request $request)
    {
        $user = Auth::user();
        $orders = Order::with(['orderItems.product', 'review'])
            ->where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->get();

        return view('buyer.orders', compact('orders'));
    }

    /**
     * Tampilkan detail pesanan milik pembeli.
     */
    public function buyerOrderDetail($code)
    {
        $user = Auth::user();
        $order = Order::with(['orderItems.product', 'review', 'user'])
            ->where('code', $code)
            ->first();

        return view('buyer.order-detail', [
            'code' => $code,
            'order' => $order,
        ]);
    }
}
