<?php

if (!function_exists('numberToRupiah')) {
    /**
     * Format angka menjadi format mata uang Rupiah (contoh: Rp 250.000).
     */
    function numberToRupiah($angka): string
    {
        return 'Rp ' . number_format((int) $angka, 0, ',', '.');
    }
}

if (!function_exists('rupiahToNumber')) {
    /**
     * Konversi string format rupiah atau teks berangka ke integer murni.
     */
    function rupiahToNumber(string $rp): int
    {
        return (int) preg_replace('/\D/', '', $rp);
    }
}
