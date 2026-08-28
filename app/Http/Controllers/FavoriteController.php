<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Menampilkan daftar wishlist milik user yang sedang login.
     * Data cat/product diambil lewat accessor getFavoritableAttribute()
     * di model Favorite, bukan eager load relasi biasa.
     */
    public function index()
    {
        $favorites = Favorite::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('favorites.index', compact('favorites'));
    }

    /**
     * Menambahkan kucing atau produk ke wishlist.
     * favoritable_type harus 'cat' atau 'product'.
     */
    public function store(Request $request)
    {
        $request->validate([
            'favoritable_id' => 'required|integer',
            'favoritable_type' => 'required|in:cat,product',
        ]);

        Favorite::create([
            'user_id' => Auth::id(),
            'favoritable_id' => $request->favoritable_id,
            'favoritable_type' => $request->favoritable_type,
        ]);

        return redirect()
            ->route('favorites.index')
            ->with('success', 'Berhasil ditambahkan ke wishlist.');
    }

    /**
     * Menghapus item dari wishlist.
     */
    public function destroy(string $id)
    {
        $favorite = Favorite::where('user_id', Auth::id())
            ->findOrFail($id);

        $favorite->delete();

        return redirect()
            ->route('favorites.index')
            ->with('success', 'Berhasil dihapus dari wishlist.');
    }
}