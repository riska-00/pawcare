<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use App\Models\CatReservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CatReservationController extends Controller
{
    /**
     * Menampilkan riwayat reservasi milik user
     * atau seluruh reservasi untuk admin.
     */
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $catReservations = CatReservation::with('cat', 'user')->get();
        } else {
            $catReservations = CatReservation::with('cat')
                ->where('user_id', Auth::id())
                ->get();
        }

        return view('cat_reservations.index', compact('catReservations'));
    }

    /**
     * Menampilkan form reservasi kucing.
     */
    public function create(Request $request)
    {
        $cat = Cat::findOrFail($request->cat_id);

        return view('cat_reservations.create', compact('cat'));
    }

    /**
     * Menyimpan reservasi baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cat_id' => 'required|exists:cats,id',
            'visit_date' => 'required|date|after_or_equal:today',
            'notes' => 'nullable|string',
        ]);

        $cat = Cat::findOrFail($request->cat_id);

        if ($cat->status !== 'available') {
            return back()->with('error', 'Kucing sudah tidak tersedia untuk reservasi.');
        }

        $catReservation = CatReservation::create([
            'user_id' => Auth::id(),
            'cat_id' => $cat->id,
            'visit_date' => $request->visit_date,
            'notes' => $request->notes,
            'status' => 'confirmed',
        ]);

        $cat->update([
            'status' => 'reserved',
        ]);

        return redirect()
            ->route('cat_reservations.show', $catReservation->id)
            ->with('success', 'Reservasi kucing berhasil dibuat.');
    }

    /**
     * Menampilkan bukti/detail reservasi.
     * Bisa diakses oleh admin (siapa saja) atau pemilik reservasi itu sendiri.
     */
    public function show(string $id)
    {
        $catReservation = CatReservation::with('cat', 'user')
            ->findOrFail($id);

        if (Auth::user()->role !== 'admin' && $catReservation->user_id !== Auth::id()) {
            abort(403);
        }

        return view('cat_reservations.show', compact('catReservation'));
    }

    /**
     * Mengubah status reservasi oleh admin.
     * Hanya admin yang boleh mengubah status reservasi.
     */
    public function update(Request $request, string $id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $catReservation = CatReservation::with('cat')
            ->findOrFail($id);

        $request->validate([
            'status' => 'required|in:confirmed,paid,completed,cancelled,expired',
        ]);

        $catReservation->update([
            'status' => $request->status,
        ]);

        if (in_array($request->status, ['cancelled', 'expired'])) {
            $catReservation->cat->update([
                'status' => 'available',
            ]);
        } elseif ($request->status === 'completed') {
            $catReservation->cat->update([
                'status' => 'sold',
            ]);
        } else {
            $catReservation->cat->update([
                'status' => 'reserved',
            ]);
        }

        return redirect()
            ->route('cat_reservations.index')
            ->with('success', 'Status reservasi berhasil diperbarui.');
    }
}