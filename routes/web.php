<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Publik (terbuka tanpa login)
Route::get('/', [PublicController::class, 'landing'])->name('landing');
Route::get('/artikel', [PublicController::class, 'articlesIndex'])->name('articles.index');
Route::get('/artikel/{id}', [PublicController::class, 'articlesShow'])->name('articles.show');

// Autentikasi (khusus pengguna yang belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/daftar', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/daftar', [AuthController::class, 'register']);
});

// Logout
Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');

// Area Pembeli (wajib login & peran buyer)
Route::middleware(['auth', 'buyer'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'buyerDashboard'])->name('buyer.dashboard');
    Route::get('/profil', [DashboardController::class, 'profile'])->name('buyer.profile');

    Route::get('/katalog', [CatalogController::class, 'index'])->name('buyer.catalog');
    Route::get('/katalog/{id}', [CatalogController::class, 'show'])->name('buyer.product.show');

    Route::get('/keranjang', function () {
        return view('buyer.cart');
    })->name('buyer.cart');

    Route::get('/checkout', [OrderController::class, 'showCheckout'])->name('buyer.checkout');
    Route::post('/checkout', [OrderController::class, 'processCheckout'])->name('buyer.checkout.process');

    Route::get('/pembayaran/{code?}', function ($code = 'DRN-0042') {
        return view('buyer.payment', ['code' => $code]);
    })->name('buyer.payment');

    Route::get('/pesanan-saya', [OrderController::class, 'buyerOrders'])->name('buyer.orders');

    Route::get('/pesanan-saya/{code}', [OrderController::class, 'buyerOrderDetail'])->name('buyer.orders.show');
    Route::post('/pesanan-saya/{code}/ulasan', [OrderController::class, 'storeReview'])->name('buyer.review.store');

    Route::get('/pesanan', function () {
        return redirect('/pesanan-saya');
    });

    Route::get('/aturan-garansi', function () {
        return view('buyer.rules');
    })->name('buyer.rules');
});

// Area Admin (wajib login & peran admin)
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/profil', [DashboardController::class, 'profile'])->name('admin.profile');

    // 1. Kelola Durian (Produk) - CRUD
    Route::get('/durian', [ProductController::class, 'index'])->name('admin.durian');
    Route::post('/durian', [ProductController::class, 'store'])->name('admin.durian.store');
    Route::put('/durian/{id}', [ProductController::class, 'update'])->name('admin.durian.update');
    Route::post('/durian/{id}/toggle', [ProductController::class, 'toggleStatus'])->name('admin.durian.toggle');

    // 2. Pesanan & Verifikasi Bayar
    Route::get('/pesanan', [OrderController::class, 'index'])->name('admin.orders');
    Route::get('/pesanan/{code}', [OrderController::class, 'show'])->name('admin.orders.show');
    Route::post('/pesanan/{code}/verify', [OrderController::class, 'verify'])->name('admin.orders.verify');
    Route::put('/pesanan/{code}/shipping', [OrderController::class, 'updateShipping'])->name('admin.orders.shipping');
    Route::post('/pesanan/{code}/nego/approve', [OrderController::class, 'approveNegotiation'])->name('admin.orders.nego.approve');
    Route::post('/pesanan/{code}/nego/reject', [OrderController::class, 'rejectNegotiation'])->name('admin.orders.nego.reject');

    Route::get('/verifikasi-bayar', [OrderController::class, 'index'])->name('admin.verification');

    // 3. Kelola Pembeli (CRUD / Pengelolaan Akun)
    Route::get('/pembeli', [BuyerController::class, 'index'])->name('admin.buyers');
    Route::put('/pembeli/{id}', [BuyerController::class, 'update'])->name('admin.buyers.update');
    Route::post('/pembeli/{id}/toggle', [BuyerController::class, 'toggleStatus'])->name('admin.buyers.toggle');
    Route::post('/pembeli/{id}/reset-password', [BuyerController::class, 'resetPassword'])->name('admin.buyers.reset-password');

    // 4. Kelola Artikel - CRUD
    Route::get('/artikel', [ArticleController::class, 'index'])->name('admin.articles');
    Route::post('/artikel', [ArticleController::class, 'store'])->name('admin.articles.store');
    Route::put('/artikel/{id}', [ArticleController::class, 'update'])->name('admin.articles.update');
    Route::delete('/artikel/{id}', [ArticleController::class, 'destroy'])->name('admin.articles.destroy');

    // 5. Laporan & Pengaturan
    Route::get('/laporan', function () {
        return view('admin.reports');
    })->name('admin.reports');

    Route::get('/pengaturan', function () {
        return view('admin.settings');
    })->name('admin.settings');
});
