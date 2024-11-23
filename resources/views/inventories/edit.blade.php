@extends('layouts.app')

@section('title', 'Edit Inventory Item')
@section('header', 'Edit Inventory Item')

@section('content')
<div class="container">
    <h1>Edit Inventory Item</h1>

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

    <form action="{{ route('inventories.update', $inventory->inventory_id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Raw Material Name -->
        <div class="mb-3">
            <label for="nama_bahan_pokok" class="form-label">Raw Material</label>
            <input type="text" name="nama_bahan_pokok" id="nama_bahan_pokok" class="form-control" value="{{ old('nama_bahan_pokok', $inventory->nama_bahan_pokok) }}" required>
        </div>

        <!-- Quantity -->
        <div class="mb-3">
            <label for="jumlah" class="form-label">Quantity</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control" value="{{ old('jumlah', $inventory->jumlah) }}" min="1" required>
        </div>

        <!-- Unit -->
        <div class="mb-3">
            <label for="satuan" class="form-label">Unit</label>
            <input type="text" name="satuan" id="satuan" class="form-control" value="{{ old('satuan', $inventory->satuan) }}" required>
        </div>

        <!-- Supplier -->
        <div class="mb-3">
            <label for="supplier" class="form-label">Supplier</label>
            <input type="text" name="supplier" id="supplier" class="form-control" value="{{ old('supplier', $inventory->supplier) }}" required>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-primary">Update Inventory Item</button>
    </form>
</div>
@endsection
