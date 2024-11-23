@extends('layouts.app')

@section('title', 'Edit Sales Report')
@section('header', 'Edit Sales Report')

@section('content')
<div class="container">
    <h1>Edit Sales Report</h1>

    <!-- Validation Errors -->
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('sales-reports.update', $salesReport->report_id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Date -->
        <div class="mb-3">
            <label for="tanggal" class="form-label">Date</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ old('tanggal', $salesReport->tanggal) }}" required>
        </div>

        <!-- Menu -->
        <div class="mb-3">
            <label for="menu_id" class="form-label">Menu</label>
            <select name="menu_id" id="menu_id" class="form-control" required>
                @foreach($menus as $menu)
                    <option value="{{ $menu->menu_id }}" {{ old('menu_id', $salesReport->menu_id) == $menu->menu_id ? 'selected' : '' }}>
                        {{ $menu->nama_menu }} (Price: {{ $menu->harga }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Price -->
        <div class="mb-3">
            <label for="harga" class="form-label">Price</label>
            <input type="number" name="harga" id="harga" class="form-control" value="{{ old('harga', $salesReport->harga) }}" step="0.01" required>
        </div>

        <!-- Total -->
        <div class="mb-3">
            <label for="total" class="form-label">Total</label>
            <input type="number" name="total" id="total" class="form-control" value="{{ old('total', $salesReport->total) }}" step="0.01" required>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-primary">Update Sales Report</button>
    </form>
</div>
@endsection
