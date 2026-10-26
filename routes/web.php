<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/artikel', function () {
    return view('articles.index');
})->name('articles.index');

Route::get('/artikel/{id}', function ($id) {
    return view('articles.show', ['id' => $id]);
})->name('articles.show');

Route::get('/daftar', function () {
    return view('auth.register');
})->name('register');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::match(['get', 'post'], '/logout', function () {
    if (auth()->check()) {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }
    return redirect('/login');
})->name('logout');

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

Route::prefix('admin')->group(function () {
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
