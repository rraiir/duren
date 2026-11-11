<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
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
            $query->where('type', Product::TYPE_READY)->where('is_active', true);
        } elseif ($request->filter === 'preorder') {
            $query->where('type', Product::TYPE_PREORDER)->where('is_active', true);
        } elseif ($request->filter === 'inactive') {
            $query->where('is_active', false);
        }

        $products = $query->orderBy('name')->orderBy('size')->get();

        return view('admin.durian', compact('products'));
    }

    /**
     * Simpan durian baru menggunakan Form Request.
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active', true);

        if ($data['type'] === Product::TYPE_READY) {
            $data['eta_text'] = null;
        }

        Product::create($data);

        return redirect()->route('admin.durian')->with('success', 'Durian baru berhasil ditambahkan.');
    }

    /**
     * Perbarui data durian menggunakan Form Request.
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active', $product->is_active);

        if ($data['type'] === Product::TYPE_READY) {
            $data['eta_text'] = null;
        }

        $product->update($data);

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
