<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
{
    /**
     * Tentukan apakah pengguna memiliki otorisasi untuk melakukan request ini.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Bersihkan input sebelum divalidasi (misal format Rupiah pada harga).
     */
    protected function prepareForValidation(): void
    {
        if ($this->has('price')) {
            $this->merge([
                'price' => rupiahToNumber((string) $this->price),
            ]);
        }
    }

    /**
     * Dapatkan aturan validasi untuk request penambahan durian baru.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'size' => ['required', Rule::in(Product::SIZES)],
            'est_weight_gram' => ['required', 'integer', 'min:' . Product::MIN_WEIGHT_GRAM],
            'price' => ['required', 'integer', 'min:' . Product::MIN_PRICE],
            'stock' => ['required', 'integer', 'min:0'],
            'type' => ['required', Rule::in(Product::TYPES)],
            'eta_text' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
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
            'name.required' => 'Nama varian durian wajib diisi.',
            'name.max' => 'Nama varian maksimal 100 karakter.',
            'size.required' => 'Ukuran durian wajib dipilih.',
            'size.in' => 'Ukuran harus salah satu dari: S, M, atau L.',
            'est_weight_gram.required' => 'Estimasi berat durian wajib diisi.',
            'est_weight_gram.integer' => 'Estimasi berat harus berupa angka bulat dalam gram.',
            'est_weight_gram.min' => 'Estimasi berat minimal ' . Product::MIN_WEIGHT_GRAM . ' gram.',
            'price.required' => 'Harga durian wajib diisi.',
            'price.integer' => 'Harga harus berupa angka yang valid.',
            'price.min' => 'Harga minimal ' . numberToRupiah(Product::MIN_PRICE) . '.',
            'stock.required' => 'Jumlah stok wajib diisi.',
            'stock.integer' => 'Jumlah stok harus berupa angka.',
            'stock.min' => 'Jumlah stok tidak boleh bernilai negatif.',
            'type.required' => 'Tipe durian wajib dipilih.',
            'type.in' => 'Tipe durian harus ready atau preorder.',
        ];
    }
}
