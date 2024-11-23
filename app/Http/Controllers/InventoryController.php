<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (! in_array(Auth::user()->role, ['admin'])) {
            abort(403, 'Unauthorized action.');
        }
        
        $inventories = Inventory::all();
        return view('inventories.index', compact('inventories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! in_array(Auth::user()->role, ['admin'])) {
            abort(403, 'Unauthorized action.');
        }

        return view('inventories.create');
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
            'nama_bahan_pokok' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'satuan' => 'required|string|max:50',
            'supplier' => 'required|string|max:255',
        ]);

        Inventory::create($request->all());

        return redirect()->route('inventories.index')->with('success', 'Inventory item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory $inventory)
    {
        if (! in_array(Auth::user()->role, ['admin'])) {
            abort(403, 'Unauthorized action.');
        }

        return view('inventories.edit', compact('inventory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventory $inventory)
    {
        if (! in_array(Auth::user()->role, ['admin'])) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'nama_bahan_pokok' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'satuan' => 'required|string|max:50',
            'supplier' => 'required|string|max:255',
        ]);

        $inventory->update($request->all());

        return redirect()->route('inventories.index')->with('success', 'Inventory item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        if (! in_array(Auth::user()->role, ['admin'])) {
            abort(403, 'Unauthorized action.');
        }
        
        $inventory->delete();

        return redirect()->route('inventories.index')->with('success', 'Inventory item deleted successfully.');
    }
}
