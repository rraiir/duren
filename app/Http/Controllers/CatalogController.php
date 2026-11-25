<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    /**
     * Tampilkan katalog durian untuk pembeli.
     */
    public function index(Request $request)
    {
        $query = Product::where('is_active', true);

        if ($request->filled('type') && in_array($request->type, ['ready', 'preorder'])) {
            $query->where('type', $request->type);
        }

        $products = $query->with('reviews')->orderBy('name')->orderBy('size')->get();

        return view('buyer.catalog', compact('products'));
    }

    /**
     * Tampilkan detail durian untuk pembeli.
     */
    public function show($id)
    {
        $product = Product::where('is_active', true)->with(['reviews.user'])->findOrFail($id);

        // Rekomendasi 3 produk aktif lainnya
        $otherProducts = Product::where('is_active', true)
            ->where('id', '!=', $id)
            ->with('reviews')
            ->take(3)
            ->get();

        return view('buyer.product-detail', compact('product', 'otherProducts'));
    }
}
