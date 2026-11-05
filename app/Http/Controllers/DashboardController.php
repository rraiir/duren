<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Tampilkan dashboard ringkasan untuk admin.
     */
    public function adminDashboard()
    {
        $needVerifyCount = Order::where('status', 'waiting_verification')->count();
        $activeOrdersCount = Order::whereIn('status', ['waiting_shipping_fee', 'processing', 'shipped'])->count();
        $readyStockCount = Product::where('type', 'ready')->where('is_active', true)->sum('stock');
        $monthlyRevenue = Order::where('status', 'completed')
            ->whereYear('completed_at', Carbon::now()->year)
            ->whereMonth('completed_at', Carbon::now()->month)
            ->sum('total_price');

        // Aktivitas terkini dari tabel orders
        $recentOrders = Order::with('user')->orderByDesc('updated_at')->take(5)->get();

        return view('admin.dashboard', compact(
            'needVerifyCount',
            'activeOrdersCount',
            'readyStockCount',
            'monthlyRevenue',
            'recentOrders'
        ));
    }

    /**
     * Tampilkan dashboard ringkasan untuk pembeli.
     */
    public function buyerDashboard()
    {
        $userId = Auth::id();

        $waitingPaymentCount = Order::where('user_id', $userId)
            ->whereIn('status', ['waiting_payment', 'payment_rejected'])
            ->count();

        $waitingVerificationCount = Order::where('user_id', $userId)
            ->where('status', 'waiting_verification')
            ->count();

        $activeCount = Order::where('user_id', $userId)
            ->whereIn('status', ['waiting_shipping_fee', 'processing', 'shipped'])
            ->count();

        $completedCount = Order::where('user_id', $userId)
            ->where('status', 'completed')
            ->count();

        $latestOrder = Order::with(['orderItems.product'])
            ->where('user_id', $userId)
            ->orderByDesc('created_at')
            ->first();

        $orderHistory = Order::with(['orderItems.product'])
            ->where('user_id', $userId)
            ->orderByDesc('created_at')
            ->skip(1)
            ->take(3)
            ->get();

        return view('buyer.dashboard', compact(
            'waitingPaymentCount',
            'waitingVerificationCount',
            'activeCount',
            'completedCount',
            'latestOrder',
            'orderHistory'
        ));
    }
}
