<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Tampilkan daftar durian untuk admin.
     */
    public function index(Request $request)
    {
        $query = Product::query();

        // Pencarian nama varian
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter tipe / status
        if ($request->filter === 'ready') {
            $query->where('type', 'ready')->where('is_active', true);
        } elseif ($request->filter === 'preorder') {
            $query->where('type', 'preorder')->where('is_active', true);
        } elseif ($request->filter === 'inactive') {
            $query->where('is_active', false);
        }

        $products = $query->orderBy('name')->orderBy('size')->get();

        return view('admin.durian', compact('products'));
    }

    /**
     * Simpan durian baru.
     */
    public function store(Request $request)
    {
        $cleanPrice = (int) str_replace(['.', ',', ' '], '', $request->price);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'size' => ['required', 'in:S,M,L'],
            'est_weight_gram' => ['required', 'integer', 'min:100'],
            'price' => ['required'],
            'stock' => ['required', 'integer', 'min:0'],
            'type' => ['required', 'in:ready,preorder'],
            'eta_text' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ], [
            'name.required' => 'Nama varian wajib diisi.',
            'size.required' => 'Ukuran wajib dipilih.',
            'est_weight_gram.required' => 'Estimasi berat wajib diisi.',
            'price.required' => 'Harga wajib diisi.',
            'stock.required' => 'Stok wajib diisi.',
            'type.required' => 'Tipe durian wajib dipilih.',
        ]);

        $validated['price'] = $cleanPrice;
        $validated['is_active'] = $request->boolean('is_active', true);

        if ($validated['type'] === 'ready') {
            $validated['eta_text'] = null;
        }

        Product::create($validated);

        return redirect()->route('admin.durian')->with('success', 'Durian baru berhasil ditambahkan.');
    }

    /**
     * Perbarui data durian.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cleanPrice = (int) str_replace(['.', ',', ' '], '', $request->price);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'size' => ['required', 'in:S,M,L'],
            'est_weight_gram' => ['required', 'integer', 'min:100'],
            'price' => ['required'],
            'stock' => ['required', 'integer', 'min:0'],
            'type' => ['required', 'in:ready,preorder'],
            'eta_text' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ], [
            'name.required' => 'Nama varian wajib diisi.',
            'size.required' => 'Ukuran wajib dipilih.',
            'est_weight_gram.required' => 'Estimasi berat wajib diisi.',
            'price.required' => 'Harga wajib diisi.',
            'stock.required' => 'Stok wajib diisi.',
            'type.required' => 'Tipe durian wajib dipilih.',
        ]);

        $validated['price'] = $cleanPrice;
        $validated['is_active'] = $request->boolean('is_active', $product->is_active);

        if ($validated['type'] === 'ready') {
            $validated['eta_text'] = null;
        }

        $product->update($validated);

        return redirect()->route('admin.durian')->with('success', 'Data durian ' . $product->name . ' berhasil diperbarui.');
    }

    /**
     * Sakelar status aktif / nonaktif produk.
     */
    public function toggleStatus($id)
    {
        $product = Product::findOrFail($id);
        $product->is_active = ! $product->is_active;
        $product->save();

        $statusText = $product->is_active ? 'diaktifkan kembali' : 'dinonaktifkan';

        return redirect()->route('admin.durian')->with('success', "Durian {$product->name} ({$product->size}) berhasil {$statusText}.");
    }
}
