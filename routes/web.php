<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/admin');
});

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

    Route::get('/laporan', function () {
        return view('admin.reports');
    })->name('admin.reports');

    Route::get('/pengaturan', function () {
        return view('admin.settings');
    })->name('admin.settings');
});
