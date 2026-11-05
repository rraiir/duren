<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class BuyerController extends Controller
{
    /**
     * Tampilkan daftar pembeli untuk admin.
     */
    public function index(Request $request)
    {
        $query = User::where('role', 'buyer')->withCount('orders');

        // Pencarian nama atau nomor WA
        if ($request->filled('search')) {
            $search = $request->search;
            $cleanSearch = preg_replace('/[^0-9]/', '', $search);
            $query->where(function ($q) use ($search, $cleanSearch) {
                $q->where('name', 'like', '%' . $search . '%');
                if (! empty($cleanSearch)) {
                    $q->orWhere('phone', 'like', '%' . $cleanSearch . '%');
                }
            });
        }

        // Filter status
        if ($request->filter === 'aktif') {
            $query->where('is_active', true);
        } elseif ($request->filter === 'nonaktif') {
            $query->where('is_active', false);
        }

        $buyers = $query->orderByDesc('created_at')->get();

        return view('admin.buyers', compact('buyers'));
    }

    /**
     * Perbarui data pembeli.
     */
    public function update(Request $request, $id)
    {
        $buyer = User::where('role', 'buyer')->findOrFail($id);

        $cleanPhone = preg_replace('/[^0-9]/', '', $request->phone);
        if (str_starts_with($cleanPhone, '0')) {
            $normalizedPhone = '62' . substr($cleanPhone, 1);
        } elseif (str_starts_with($cleanPhone, '8')) {
            $normalizedPhone = '62' . $cleanPhone;
        } else {
            $normalizedPhone = $cleanPhone;
        }

        $request->merge(['phone' => $normalizedPhone]);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'string', Rule::unique('users', 'phone')->ignore($buyer->id)],
            'address' => ['required', 'string'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'phone.required' => 'Nomor WhatsApp wajib diisi.',
            'phone.unique' => 'Nomor WhatsApp ini sudah digunakan oleh akun lain.',
            'address.required' => 'Alamat lengkap wajib diisi.',
        ]);

        $buyer->update([
            'name' => trim($validated['name']),
            'phone' => $normalizedPhone,
            'address' => trim($validated['address']),
            'is_active' => $request->boolean('is_active', $buyer->is_active),
        ]);

        return redirect()->route('admin.buyers')->with('success', 'Data pembeli ' . $buyer->name . ' berhasil diperbarui.');
    }

    /**
     * Sakelar aktif/nonaktif akun pembeli.
     */
    public function toggleStatus($id)
    {
        $buyer = User::where('role', 'buyer')->findOrFail($id);
        $buyer->is_active = ! $buyer->is_active;
        $buyer->save();

        $statusText = $buyer->is_active ? 'diaktifkan kembali' : 'dinonaktifkan';

        return redirect()->route('admin.buyers')->with('success', "Akun pembeli {$buyer->name} berhasil {$statusText}.");
    }

    /**
     * Reset password pembeli oleh admin.
     */
    public function resetPassword(Request $request, $id)
    {
        $buyer = User::where('role', 'buyer')->findOrFail($id);

        $request->validate([
            'new_password' => ['required', 'string', 'min:8'],
        ], [
            'new_password.required' => 'Password baru wajib diisi.',
            'new_password.min' => 'Password baru minimal 8 karakter.',
        ]);

        $buyer->password = $request->new_password;
        $buyer->save();

        return redirect()->route('admin.buyers')->with('success', "Password baru untuk {$buyer->name} berhasil disimpan. Silakan kirimkan password baru ini kepada pembeli melalui WhatsApp ({$buyer->phone}).");
    }
}
