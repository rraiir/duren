<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBuyerRequest extends FormRequest
{
    /**
     * Tentukan apakah pengguna memiliki otorisasi untuk melakukan request ini.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Normalisasi nomor telepon sebelum divalidasi.
     */
    protected function prepareForValidation(): void
    {
        if ($this->has('phone')) {
            $cleanPhone = preg_replace('/[^0-9]/', '', (string) $this->phone);
            if (str_starts_with($cleanPhone, '0')) {
                $normalizedPhone = '62' . substr($cleanPhone, 1);
            } elseif (str_starts_with($cleanPhone, '8')) {
                $normalizedPhone = '62' . $cleanPhone;
            } else {
                $normalizedPhone = $cleanPhone;
            }

            $this->merge(['phone' => $normalizedPhone]);
        }
    }

    /**
     * Dapatkan aturan validasi untuk perbaruan data pembeli.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $buyerId = $this->route('id');

        return [
            'name' => ['required', 'string', 'max:100'],
            'phone' => [
                'required',
                'string',
                'regex:/^62[0-9]{8,13}$/',
                Rule::unique('users', 'phone')->ignore($buyerId),
            ],
            'address' => ['required', 'string'],
        ];
    }

    /**
     * Pesan error kustom berbahasa Indonesia.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama lengkap pembeli wajib diisi.',
            'name.max' => 'Nama lengkap maksimal 100 karakter.',
            'phone.required' => 'Nomor WhatsApp wajib diisi.',
            'phone.regex' => 'Format nomor WhatsApp tidak valid (contoh: 081234567890).',
            'phone.unique' => 'Nomor WhatsApp ini sudah terdaftar pada akun lain.',
            'address.required' => 'Alamat pengiriman pembeli wajib diisi.',
        ];
    }
}
