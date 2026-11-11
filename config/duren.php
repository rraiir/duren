<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Konfigurasi Toko Durian (DuREN)
    |--------------------------------------------------------------------------
    | Sesuai best practice Laravel, fungsi env() hanya dipanggil di dalam file
    | konfigurasi ini agar tetap aman saat konfigurasi di-cache.
    */
    'nama' => env('DUREN_NAMA', 'DuREN - Toko Durian Segar'),
    'tagline' => env('DUREN_TAGLINE', 'Pusat Durian Montong & Musang King Asli'),
    'wa_admin' => env('DUREN_WA_ADMIN', '62881081111833'),
    'alamat' => env('DUREN_ALAMAT', 'Kepanjenkidul, Kota Blitar'),
];
