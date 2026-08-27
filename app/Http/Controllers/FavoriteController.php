<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    
    public function index()
    {
        $favorites = Favorite::with(['cat', 'product'])->where('user_id', Auth::id())->latest()->get();

        return view('favorites.index', compact('favorites'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cat_id' => 'nullable|exists:cats,id',
            'product_id' => 'nullable|exists:products,id',
        ]);

        Favorite::create([
            'user_id' => Auth::id(),
            'cat_id' => $request->cat_id,
            'product_id' => $request->product_id,
        ]);

        return redirect()->route('favorites.index')->with('success', 'Berhasil ditambahkan ke wishlist.');
    }

    public function destroy(string $id)
    {
        $favorite = Favorite::where('user_id', Auth::id())->findOrFail($id);

        $favorite->delete();

        return redirect()->route('favorites.index')->with('success', 'Berhasil dihapus dari wishlist.');
    }
}