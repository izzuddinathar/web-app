@extends('layouts.app')

@section('title', 'Add New Payment')
@section('header', 'Add New Payment')

@section('content')
<div class="container">
    <h1>Add New Payment</h1>

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

    <form action="{{ route('payments.store') }}" method="POST">
        @csrf

        <!-- Table Number -->
        <div class="mb-3">
            <label for="nomor_meja" class="form-label">Table Number</label>
            <select name="nomor_meja" id="nomor_meja" class="form-control" required>
                <option value="">Select a table</option>
                @foreach($tables as $table)
                    <option value="{{ $table->nomor_meja }}" {{ old('nomor_meja') == $table->nomor_meja ? 'selected' : '' }}>
                        Table {{ $table->nomor_meja }} (Capacity: {{ $table->kapasitas }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Menu -->
        <div class="mb-3">
            <label for="menu_id" class="form-label">Menu</label>
            <select name="menu_id" id="menu_id" class="form-control" required>
                <option value="">Select a menu</option>
                @foreach($menus as $menu)
                    <option value="{{ $menu->menu_id }}" {{ old('menu_id') == $menu->menu_id ? 'selected' : '' }}>
                        {{ $menu->nama_menu }} (Price: {{ $menu->harga }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Quantity -->
        <div class="mb-3">
            <label for="jumlah" class="form-label">Quantity</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control" value="{{ old('jumlah') }}" min="1" required>
        </div>

        <!-- Payment Method -->
        <div class="mb-3">
            <label for="metode_pembayaran" class="form-label">Payment Method</label>
            <select name="metode_pembayaran" id="metode_pembayaran" class="form-control" required>
                <option value="tunai" {{ old('metode_pembayaran') === 'tunai' ? 'selected' : '' }}>Tunai</option>
                <option value="kartu kredit" {{ old('metode_pembayaran') === 'kartu kredit' ? 'selected' : '' }}>Kartu Kredit</option>
                <option value="kartu debit" {{ old('metode_pembayaran') === 'kartu debit' ? 'selected' : '' }}>Kartu Debit</option>
                <option value="qris" {{ old('metode_pembayaran') === 'qris' ? 'selected' : '' }}>QRIS</option>
            </select>
        </div>

        <!-- Status -->
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="belum dibayar" {{ old('status') === 'belum dibayar' ? 'selected' : '' }}>Belum Dibayar</option>
                <option value="lunas" {{ old('status') === 'lunas' ? 'selected' : '' }}>Lunas</option>
            </select>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-primary">Add Payment</button>
    </form>
</div>
@endsection