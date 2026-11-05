<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Tampilkan daftar artikel untuk admin.
     */
    public function index(Request $request)
    {
        $query = Article::query();

        // Pencarian judul
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter status
        if ($request->filter === 'terbit') {
            $query->where('is_published', true);
        } elseif ($request->filter === 'draft') {
            $query->where('is_published', false);
        }

        $articles = $query->orderByDesc('created_at')->get();

        return view('admin.articles', compact('articles'));
    }

    /**
     * Simpan artikel baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'summary' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'cover' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
        ], [
            'title.required' => 'Judul artikel wajib diisi.',
            'summary.required' => 'Ringkasan artikel wajib diisi.',
            'body.required' => 'Isi artikel wajib diisi.',
            'cover.image' => 'Berkas sampul harus berupa gambar (JPG atau PNG).',
            'cover.max' => 'Ukuran sampul maksimal 2 MB.',
        ]);

        $isPublished = $request->boolean('is_published');
        $coverPath = null;

        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('covers', 'public');
        }

        Article::create([
            'title' => trim($validated['title']),
            'summary' => trim($validated['summary']),
            'body' => trim($validated['body']),
            'cover_path' => $coverPath,
            'is_published' => $isPublished,
            'published_at' => $isPublished ? Carbon::now() : null,
        ]);

        return redirect()->route('admin.articles')->with('success', 'Artikel berhasil disimpan.');
    }

    /**
     * Perbarui artikel.
     */
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'summary' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'cover' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
        ], [
            'title.required' => 'Judul artikel wajib diisi.',
            'summary.required' => 'Ringkasan artikel wajib diisi.',
            'body.required' => 'Isi artikel wajib diisi.',
            'cover.image' => 'Berkas sampul harus berupa gambar (JPG atau PNG).',
            'cover.max' => 'Ukuran sampul maksimal 2 MB.',
        ]);

        $isPublished = $request->boolean('is_published');

        if ($request->hasFile('cover')) {
            if ($article->cover_path) {
                Storage::disk('public')->delete($article->cover_path);
            }
            $article->cover_path = $request->file('cover')->store('covers', 'public');
        }

        // Set published_at jika baru pertama kali diterbitkan
        if ($isPublished && ! $article->is_published && ! $article->published_at) {
            $article->published_at = Carbon::now();
        }

        $article->title = trim($validated['title']);
        $article->summary = trim($validated['summary']);
        $article->body = trim($validated['body']);
        $article->is_published = $isPublished;
        $article->save();

        return redirect()->route('admin.articles')->with('success', 'Artikel berhasil diperbarui.');
    }

    /**
     * Hapus artikel.
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        if ($article->cover_path) {
            Storage::disk('public')->delete($article->cover_path);
        }

        $article->delete();

        return redirect()->route('admin.articles')->with('success', 'Artikel berhasil dihapus.');
    }
}
