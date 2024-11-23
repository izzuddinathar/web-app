@extends('layouts.app')

@section('title', 'Add New Inventory Item')
@section('header', 'Add New Inventory Item')

@section('content')
<div class="container">
    <h1>Add New Inventory Item</h1>

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

    <form action="{{ route('inventories.store') }}" method="POST">
        @csrf

        <!-- Raw Material Name -->
        <div class="mb-3">
            <label for="nama_bahan_pokok" class="form-label">Raw Material</label>
            <input type="text" name="nama_bahan_pokok" id="nama_bahan_pokok" class="form-control" value="{{ old('nama_bahan_pokok') }}" required>
        </div>

        <!-- Quantity -->
        <div class="mb-3">
            <label for="jumlah" class="form-label">Quantity</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control" value="{{ old('jumlah') }}" min="1" required>
        </div>

        <!-- Unit -->
        <div class="mb-3">
            <label for="satuan" class="form-label">Unit</label>
            <input type="text" name="satuan" id="satuan" class="form-control" value="{{ old('satuan') }}" required>
        </div>

        <!-- Supplier -->
        <div class="mb-3">
            <label for="supplier" class="form-label">Supplier</label>
            <input type="text" name="supplier" id="supplier" class="form-control" value="{{ old('supplier') }}" required>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-primary">Add Inventory Item</button>
    </form>
</div>
@endsection
