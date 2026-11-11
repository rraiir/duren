<?php

namespace App\Http\Requests;

use App\Models\Article;
use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleRequest extends FormRequest
{
    /**
     * Tentukan apakah pengguna memiliki otorisasi untuk melakukan request ini.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Dapatkan aturan validasi untuk perbaruan artikel.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:' . Article::MAX_TITLE_LENGTH],
            'summary' => ['required', 'string', 'max:' . Article::MAX_SUMMARY_LENGTH],
            'body' => ['required', 'string'],
            'cover' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:' . Article::MAX_COVER_KB],
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
            'title.required' => 'Judul artikel wajib diisi.',
            'title.max' => 'Judul artikel maksimal ' . Article::MAX_TITLE_LENGTH . ' karakter.',
            'summary.required' => 'Ringkasan artikel wajib diisi.',
            'summary.max' => 'Ringkasan artikel maksimal ' . Article::MAX_SUMMARY_LENGTH . ' karakter.',
            'body.required' => 'Isi artikel tidak boleh kosong.',
            'cover.image' => 'Berkas sampul harus berupa berkas gambar (JPG atau PNG).',
            'cover.mimes' => 'Format gambar yang diperbolehkan hanya JPG, JPEG, dan PNG.',
            'cover.max' => 'Ukuran gambar sampul maksimal ' . (Article::MAX_COVER_KB / 1024) . ' MB.',
        ];
    }
}
