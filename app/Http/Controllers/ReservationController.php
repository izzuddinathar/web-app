<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (! in_array(Auth::user()->role, ['waiters'])) {
            abort(403, 'Unauthorized action.');
        }

        $reservations = Reservation::with('table')->get();

        return view('reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! in_array(Auth::user()->role, ['waiters'])) {
            abort(403, 'Unauthorized action.');
        }

        $tables = Table::where('status', 'tersedia')->get();

        return view('reservations.create', compact('tables'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (! in_array(Auth::user()->role, ['waiters'])) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'nomor_kontak' => 'required|string|max:255',
            'waktu_reservasi' => 'required|date|after:now',
            'nomor_meja' => 'required|exists:tables,nomor_meja',
            'status' => 'required|in:terjadwal,dibatalkan,selesai',
        ]);

        Reservation::create($request->all());

        Table::where('nomor_meja', $request->nomor_meja)->update(['status' => 'dipesan']);

        return redirect()->route('reservations.index')->with('success', 'Reservation created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        if (! in_array(Auth::user()->role, ['waiters'])) {
            abort(403, 'Unauthorized action.');
        }

        $tables = Table::where('status', 'tersedia')->orWhere('nomor_meja', $reservation->nomor_meja)->get();

        return view('reservations.edit', compact('reservation', 'tables'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        if (! in_array(Auth::user()->role, ['waiters'])) {
            abort(403, 'Unauthorized action.');
        }

        // Validate the request
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'nomor_kontak' => 'required|string|max:255',
            'waktu_reservasi' => 'required|date|after:now',
            'nomor_meja' => 'required|exists:tables,nomor_meja',
            'status' => 'required|in:terjadwal,dibatalkan,selesai',
        ]);

        // Update the reservation
        $reservation->update($request->all());

        // Update the table status based on reservation status
        if ($request->status === 'dibatalkan' || $request->status === 'selesai') {
            // Set the table status to 'tersedia' if reservation is canceled or completed
            Table::where('nomor_meja', $request->nomor_meja)->update(['status' => 'tersedia']);
        } elseif ($request->status === 'terjadwal') {
            // Set the table status to 'dipesan' if reservation is scheduled
            Table::where('nomor_meja', $request->nomor_meja)->update(['status' => 'dipesan']);
        }

        return redirect()->route('reservations.index')->with('success', 'Reservation updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        if (! in_array(Auth::user()->role, ['waiters'])) {
            abort(403, 'Unauthorized action.');
        }

        Table::where('nomor_meja', $reservation->nomor_meja)->update(['status' => 'tersedia']);
        $reservation->delete();

        return redirect()->route('reservations.index')->with('success', 'Reservation deleted successfully.');
    }
}
