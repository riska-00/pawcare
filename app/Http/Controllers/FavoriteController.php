<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Favorite::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('favorites.index', compact('favorites'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'favoritable_id' => 'required|integer',
            'favoritable_type' => 'required|in:cat,product',
        ]);

        $favorite= Favorite::firstOrCreate([
            'user_id' => Auth::id(),
            'favoritable_id' => $request->favoritable_id,
            'favoritable_type' => $request->favoritable_type,
        ]);

        $message = $favorite->wasRecentlyCreated ? 'Berhasil ditambahkan ke Wishlist.' : 'Item ini sudah ada di Wishlist anda.';

        return redirect()
            ->route('favorites.index')
            ->with('success', 'Berhasil ditambahkan ke wishlist.');
    }

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