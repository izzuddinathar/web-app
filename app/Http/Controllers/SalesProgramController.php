<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\SalesProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (! in_array(Auth::user()->role, ['owner'])) {
            abort(403, 'Unauthorized action.');
        }

        $programs = SalesProgram::with('menu')->get();
        return view('sales_programs.index', compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! in_array(Auth::user()->role, ['owner'])) {
            abort(403, 'Unauthorized action.');
        }

        $menus = Menu::all();
        return view('sales_programs.create', compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (! in_array(Auth::user()->role, ['owner'])) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'nama_program' => 'required|string|max:255',
            'diskon' => 'required|numeric|min:0',
            'tanggal_berlaku' => 'required|date',
            'jam_berlaku' => 'required|date_format:H:i',
            'menu_id' => 'nullable|exists:menus,menu_id',
            'kategori_produk' => 'nullable|in:cemilan,makanan,minuman',
        ]);

        SalesProgram::create($request->all());

        return redirect()->route('sales-programs.index')->with('success', 'Sales program created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SalesProgram $salesProgram)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SalesProgram $salesProgram)
    {
        if (! in_array(Auth::user()->role, ['owner'])) {
            abort(403, 'Unauthorized action.');
        }

        $menus = Menu::all();
        return view('sales_programs.edit', compact('salesProgram', 'menus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SalesProgram $salesProgram)
    {
        if (! in_array(Auth::user()->role, ['owner'])) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'nama_program' => 'required|string|max:255',
            'diskon' => 'required|numeric|min:0',
            'tanggal_berlaku' => 'required|date',
            'jam_berlaku' => 'required|date_format:H:i',
            'menu_id' => 'nullable|exists:menus,menu_id',
            'kategori_produk' => 'nullable|in:cemilan,makanan,minuman',
        ]);

        $salesProgram->update($request->all());

        return redirect()->route('sales-programs.index')->with('success', 'Sales program updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalesProgram $salesProgram)
    {
        if (! in_array(Auth::user()->role, ['owner'])) {
            abort(403, 'Unauthorized action.');
        }
        
        $salesProgram->delete();

        return redirect()->route('sales-programs.index')->with('success', 'Sales program deleted successfully.');
    }
}
