<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CatController extends Controller
{
    
    public function index()
    {
        $cats = Cat::all();

        return view('cats.index', compact('cats'));    
    }

    /**
     * Show the form for creating a new resource.
     * Khusus admin.
     */
    public function create()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        return view('cats.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'age' => 'required|string|max:50',
            'gender' => 'required|in:jantan,betina',
            'price' => 'required|numeric|min:0',
            'photo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048', 
            'description' => 'nullable|string',
        ]);

        $photo = null;

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo')->store('cats', 'public');
        }

        Cat::create([
            'name' => $request->name,
            'breed' => $request->breed,
            'age' => $request->age,
            'gender' => $request->gender,
            'price' => $request->price,
            'photo' => $photo,
            'description' => $request->description,
        ]);

        return redirect()->route('cats.index')->with('success', 'Data Kucing berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     * Bebas diakses siapa saja.
     */
    public function show(string $id)
    {
        $cat = Cat::findOrFail($id);

        return view('cats.show', compact('cat'));
    }

    /**
     * Show the form for editing the specified resource.
     * Khusus admin.
     */
    public function edit(string $id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $cat = Cat::findOrFail($id);

        return view('cats.edit', compact('cat'));
    }

    /**
     * Update the specified resource in storage.
     * Khusus admin.
     */
    public function update(Request $request, string $id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $cat = Cat::findOrFail($id);

         $request->validate([
            'name' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'age' => 'required|string|max:50',
            'gender' => 'required|in:jantan,betina',
            'price' => 'required|numeric|min:0',
            'photo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048', 
            'description' => 'nullable|string',
            'status' => 'required|in:available,reserved,sold',
        ]);

        $cat->update([
            'name' => $request->name,
            'breed' => $request->breed,
            'age' => $request->age,
            'gender' => $request->gender,
            'price' => $request->price,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        if ($request->hasFile('photo')) {
            $cat->update([
                'photo' => $request->file('photo')->store('cats', 'public')]);
        }

        return redirect()->route('cats.index')->with('success', 'Data Kucing berhasil diperbarui');
        
    }

    /**
     * Remove the specified resource from storage.
     * Khusus admin.
     */
    public function destroy(string $id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $cat = Cat::findOrFail($id);

        $cat->delete();

        return redirect()->route('cats.index')->with('success', 'Data kucing berhasil dihapus');
    }
}