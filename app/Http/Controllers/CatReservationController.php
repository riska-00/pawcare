<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use App\Models\CatReservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CatReservationController extends Controller
{
    public function index()
    {
        $expiredReservations = CatReservation::with('cat')
            ->whereIn('status', ['pending', 'confirmed'])
            ->where('visit_date', '<=', now()->subDays(3))
            ->get();

        foreach ($expiredReservations as $reservation) {
            $reservation->update(['status' => 'expired']);

            if ($reservation->cat && $reservation->cat->status === 'reserved') {
                $reservation->cat->update(['status' => 'available']);
            }
        }

        if (Auth::user()->role === 'admin') {
            $catReservations = CatReservation::with('cat', 'user')->get();
        } else {
            $catReservations = CatReservation::with('cat')
                ->where('user_id', Auth::id())
                ->get();
        }

        return view(Auth::user()->role === 'admin' ? 'admin.cat_reservations.index' : 'user.cat_reservations.index', compact('catReservations'));
    }

    public function create(Request $request)
    {
        $cat = Cat::findOrFail($request->cat_id);

        if ($cat->status !== 'available') {
            return redirect()->route('cats.show', $cat->id)->with('error', 'Kucing ini sudah tidak tersedia untuk reservasi');
        }

        return view('user.cat_reservations.create', compact('cat'));
    }

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
            'status' => 'pending',
        ]);

        $cat->update([
            'status' => 'reserved',
        ]);

        return redirect()->route('cat_reservations.show', $catReservation->id)->with('success', 'Reservasi kucing berhasil dibuat.');
    }

        public function show(string $id)
    {
        $catReservation = CatReservation::with('cat', 'user')
            ->findOrFail($id);

        if (Auth::user()->role !== 'admin' && $catReservation->user_id !== Auth::id()) {
            abort(403);
        }

        return view(Auth::user()->role === 'admin' ? 'admin.cat_reservations.show' : 'user.cat_reservations.show', compact('catReservation'));
    }

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

        return redirect()->route('cat_reservations.index')->with('success', 'Status reservasi berhasil diperbarui.');
    }
}