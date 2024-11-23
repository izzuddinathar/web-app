<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (! in_array(Auth::user()->role, ['waiters', 'cook'])) {
            abort(403, 'Unauthorized action.');
        }

        $orders = Order::with(['table', 'menu'])->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! in_array(Auth::user()->role, ['waiters', 'cook'])) {
            abort(403, 'Unauthorized action.');
        }

        $tables = Table::where('status', 'dipesan')->get();
        $menus = Menu::all();

        return view('orders.create', compact('tables', 'menus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (! in_array(Auth::user()->role, ['waiters', 'cook'])) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'nomor_meja' => 'required|exists:tables,nomor_meja',
            'menu_id' => 'required|exists:menus,menu_id',
            'jumlah' => 'required|integer|min:1',
            'status_pesanan' => 'required|in:dipesan,diproses,disajikan',
        ]);

        Order::create($request->all());

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        if (! in_array(Auth::user()->role, ['waiters', 'cook'])) {
            abort(403, 'Unauthorized action.');
        }

        $tables = Table::all();
        $menus = Menu::all();

        return view('orders.edit', compact('order', 'tables', 'menus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        if (! in_array(Auth::user()->role, ['waiters', 'cook'])) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'nomor_meja' => 'required|exists:tables,nomor_meja',
            'menu_id' => 'required|exists:menus,menu_id',
            'jumlah' => 'required|integer|min:1',
            'status_pesanan' => 'required|in:dipesan,diproses,disajikan',
        ]);

        $order->update($request->all());

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        if (! in_array(Auth::user()->role, ['waiters', 'cook'])) {
            abort(403, 'Unauthorized action.');
        }

        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}
