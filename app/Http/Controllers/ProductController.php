<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $products = $query->get();

        $categories = Product::select('category')->distinct()->pluck('category');

        return view('products.index', compact('products', 'categories'));
    }
    public function create()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        return view('products.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'photo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'description' => 'nullable|string'
        ]);

        $photo = null;

        if($request->hasFile('photo')){
            $photo = $request->file('photo')->store('products', 'public');
        }

        Product::create([
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'stock' => $request->stock,
            'photo' => $photo,
            'description' => $request->description
        ]);

        return redirect()->route('products.index')->with('success', 'Data produk berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $product = Product::findOrFail($id);

        return view('products.show', compact('product'));
    }

    public function edit(string $id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $product = Product::findOrFail($id);

        return view('products.edit', compact('product'));
    }

    public function update(Request $request, string $id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'photo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'description' => 'nullable|string',
        ]);

        $product->update([
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
        ]);

        if ($request->hasFile('photo')) {
            $product->update([
                'photo' => $request->file('photo')->store('products', 'public'),
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Data produk berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $product = Product::findOrFail($id);

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Data produk berhasil dihapus');
    }
}