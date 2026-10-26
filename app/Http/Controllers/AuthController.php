<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Proses autentikasi pengguna.
     */
    public function login(Request $request)
    {
        $request->validate([
            'phone' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'phone.required' => 'Nomor WhatsApp wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $cleanPhone = preg_replace('/[^0-9]/', '', $request->phone);
        if (str_starts_with($cleanPhone, '0')) {
            $normalizedPhone = '62' . substr($cleanPhone, 1);
        } elseif (str_starts_with($cleanPhone, '8')) {
            $normalizedPhone = '62' . $cleanPhone;
        } else {
            $normalizedPhone = $cleanPhone;
        }

        $user = User::where('phone', $normalizedPhone)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return back()->withInput($request->only('phone'))->withErrors([
                'phone' => 'Nomor WhatsApp atau password salah.',
            ]);
        }

        if (! $user->is_active) {
            return back()->withInput($request->only('phone'))->withErrors([
                'phone' => 'Akun dinonaktifkan. Hubungi Admin.',
            ]);
        }

        Auth::login($user, $request->boolean('remember'));
        $request->session()->regenerate();

        if ($user->isAdmin()) {
            return redirect()->intended(route('admin.dashboard'));
        }

        return redirect()->intended(route('buyer.dashboard'));
    }

    /**
     * Tampilkan halaman registrasi.
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Daftarkan pembeli baru.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'string', 'regex:/^(08|628|\+628)[0-9]{8,13}$/'],
            'address' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'phone.required' => 'Nomor WhatsApp wajib diisi.',
            'phone.regex' => 'Format nomor WhatsApp harus diawali 08 atau 62 (contoh: 081234567890).',
            'address.required' => 'Alamat lengkap wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
        ]);

        $cleanPhone = preg_replace('/[^0-9]/', '', $request->phone);
        if (str_starts_with($cleanPhone, '0')) {
            $normalizedPhone = '62' . substr($cleanPhone, 1);
        } elseif (str_starts_with($cleanPhone, '8')) {
            $normalizedPhone = '62' . $cleanPhone;
        } else {
            $normalizedPhone = $cleanPhone;
        }

        if (User::where('phone', $normalizedPhone)->exists()) {
            return back()->withInput()->withErrors([
                'phone' => 'Nomor WhatsApp ini sudah terdaftar.',
            ]);
        }

        $user = User::create([
            'name' => trim($request->name),
            'phone' => $normalizedPhone,
            'address' => trim($request->address),
            'password' => $request->password,
            'role' => 'buyer',
            'is_active' => true,
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('buyer.dashboard')->with('success', 'Pendaftaran berhasil. Selamat datang di DuREN!');
    }

    /**
     * Keluar dari sesi.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah berhasil keluar.');
    }
}
