<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use Illuminate\Http\Request;

class CatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cats = Cat::all();

        return view('cats.index', compact('cats'));    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cats.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
     */
    public function show(string $id)
    {
        $cat = Cat::findOrFail($id);

        return view('cats.show', compact('cat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cat = Cat::findOrFail($id);

        return view('cats.edit', compact('cat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
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
     */
    public function destroy(string $id)
    {
        $cat = Cat::findOrFail($id);

        $cat->delete();

        return redirect()->route('cats.index')->with('success', 'Data kucing berhasil dihapus');
    }
}
