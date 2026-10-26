<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Publik (terbuka tanpa login)
Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/artikel', function () {
    return view('articles.index');
})->name('articles.index');

Route::get('/artikel/{id}', function ($id) {
    return view('articles.show', ['id' => $id]);
})->name('articles.show');

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
    Route::get('/dashboard', function () {
        return view('buyer.dashboard');
    })->name('buyer.dashboard');

    Route::get('/katalog', function () {
        return view('buyer.catalog');
    })->name('buyer.catalog');

    Route::get('/katalog/{id}', function ($id) {
        return view('buyer.product-detail', ['id' => $id]);
    })->name('buyer.product.show');

    Route::get('/keranjang', function () {
        return view('buyer.cart');
    })->name('buyer.cart');

    Route::get('/checkout', function () {
        return view('buyer.checkout');
    })->name('buyer.checkout');

    Route::get('/pembayaran/{code?}', function ($code = 'DRN-0042') {
        return view('buyer.payment', ['code' => $code]);
    })->name('buyer.payment');

    Route::get('/pesanan-saya', function () {
        return view('buyer.orders');
    })->name('buyer.orders');

    Route::get('/pesanan-saya/{code}', function ($code) {
        return view('buyer.order-detail', ['code' => $code]);
    })->name('buyer.orders.show');

    Route::get('/pesanan', function () {
        return redirect('/pesanan-saya');
    });

    Route::get('/aturan-garansi', function () {
        return view('buyer.rules');
    })->name('buyer.rules');
});

// Area Admin (wajib login & peran admin)
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/durian', function () {
        return view('admin.durian');
    })->name('admin.durian');

    Route::get('/pesanan', function () {
        return view('admin.orders');
    })->name('admin.orders');

    Route::get('/pesanan/{code}', function ($code) {
        return view('admin.order-detail', ['code' => $code]);
    })->name('admin.orders.show');

    Route::get('/verifikasi-bayar', function () {
        return view('admin.orders');
    })->name('admin.verification');

    Route::get('/pembeli', function () {
        return view('admin.buyers');
    })->name('admin.buyers');

    Route::get('/artikel', function () {
        return view('admin.articles');
    })->name('admin.articles');

    Route::get('/laporan', function () {
        return view('admin.reports');
    })->name('admin.reports');

    Route::get('/pengaturan', function () {
        return view('admin.settings');
    })->name('admin.settings');
});
