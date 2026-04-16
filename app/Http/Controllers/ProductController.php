<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);
        return view('product.index', compact('products'));
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(StoreProductRequest $request)
    {
        // ambil data valid
        $validated = $request->validated();

        // otomatis isi user_id dari user login
        $validated['user_id'] = auth()->id();

        Product::create($validated);

        return redirect()->route('product.index')
            ->with('success', 'Product created successfully.');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product.view', compact('product'));
    }

    public function edit(Product $product)
    {
        // cek policy
        $this->authorize('update', $product);

        return view('product.edit', compact('product'));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        // ambil data valid
        $validated = $request->validated();

        // masukkan data baru ke model (BELUM disimpan)
        $product->fill($validated);

        // cek apakah ada perubahan
        if (!$product->isDirty()) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Tidak ada perubahan data!');
        }

        // simpan jika ada perubahan
        $product->save();

        return redirect()->route('product.index')
            ->with('success', 'Product updated successfully.');
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);

        // cek policy
        $this->authorize('delete', $product);

        $product->delete();

        return redirect()->route('product.index')
            ->with('success', 'Product berhasil dihapus');
    }

    public function export()
    {
        return "Export berhasil (hanya admin yang bisa akses)";
    }
}