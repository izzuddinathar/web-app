<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\SalesReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (! in_array(Auth::user()->role, ['owner'])) {
            abort(403, 'Unauthorized action.');
        }

        $reports = SalesReport::with('menu')->get();

        return view('sales_reports.index', compact('reports'));
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

        return view('sales_reports.create', compact('menus'));
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
            'tanggal' => 'required|date',
            'menu_id' => 'required|exists:menus,menu_id',
            'harga' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
        ]);

        SalesReport::create($request->all());

        return redirect()->route('sales-reports.index')->with('success', 'Sales report created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SalesReport $salesReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SalesReport $salesReport)
    {
        if (! in_array(Auth::user()->role, ['owner'])) {
            abort(403, 'Unauthorized action.');
        }

        $menus = Menu::all();

        return view('sales_reports.edit', compact('salesReport', 'menus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SalesReport $salesReport)
    {
        if (! in_array(Auth::user()->role, ['owner'])) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'tanggal' => 'required|date',
            'menu_id' => 'required|exists:menus,menu_id',
            'harga' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
        ]);

        $salesReport->update($request->all());

        return redirect()->route('sales-reports.index')->with('success', 'Sales report updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalesReport $salesReport)
    {
        if (! in_array(Auth::user()->role, ['owner'])) {
            abort(403, 'Unauthorized action.');
        }

        $salesReport->delete();

        return redirect()->route('sales-reports.index')->with('success', 'Sales report deleted successfully.');
    }
}
