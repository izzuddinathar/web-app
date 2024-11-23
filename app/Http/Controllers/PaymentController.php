<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Payment;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (! in_array(Auth::user()->role, ['admin'])) {
            abort(403, 'Unauthorized action.');
        }

        $payments = Payment::with(['table', 'menu'])->get();

        return view('payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! in_array(Auth::user()->role, ['admin'])) {
            abort(403, 'Unauthorized action.');
        }

        $tables = Table::all();
        $menus = Menu::all();

        return view('payments.create', compact('tables', 'menus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (! in_array(Auth::user()->role, ['admin'])) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'nomor_meja' => 'required|exists:tables,nomor_meja',
            'menu_id' => 'required|exists:menus,menu_id',
            'jumlah' => 'required|integer|min:1',
            'metode_pembayaran' => 'required|in:tunai,kartu kredit,kartu debit,qris',
            'status' => 'required|in:belum dibayar,lunas',
        ]);

        Payment::create($request->all());

        return redirect()->route('payments.index')->with('success', 'Payment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        if (! in_array(Auth::user()->role, ['admin'])) {
            abort(403, 'Unauthorized action.');
        }

        $tables = Table::all();
        $menus = Menu::all();

        return view('payments.edit', compact('payment', 'tables', 'menus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        if (! in_array(Auth::user()->role, ['admin'])) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'nomor_meja' => 'required|exists:tables,nomor_meja',
            'menu_id' => 'required|exists:menus,menu_id',
            'jumlah' => 'required|integer|min:1',
            'metode_pembayaran' => 'required|in:tunai,kartu kredit,kartu debit,qris',
            'status' => 'required|in:belum dibayar,lunas',
        ]);

        $payment->update($request->all());

        return redirect()->route('payments.index')->with('success', 'Payment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        if (! in_array(Auth::user()->role, ['admin'])) {
            abort(403, 'Unauthorized action.');
        }

        $payment->delete();

        return redirect()->route('payments.index')->with('success', 'Payment deleted successfully.');
    }
}
