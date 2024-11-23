@extends('layouts.app')

@section('title', 'Add New Order')
@section('header', 'Add New Order')

@section('content')
<div class="container">
    <h1>Add New Order</h1>

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

    <form action="{{ route('orders.store') }}" method="POST">
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

        <!-- Status -->
        <div class="mb-3">
            <label for="status_pesanan" class="form-label">Status</label>
            <select name="status_pesanan" id="status_pesanan" class="form-control" required>
                <option value="dipesan" {{ old('status_pesanan') === 'dipesan' ? 'selected' : '' }}>Dipesan</option>
                <option value="diproses" {{ old('status_pesanan') === 'diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="disajikan" {{ old('status_pesanan') === 'disajikan' ? 'selected' : '' }}>Disajikan</option>
            </select>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-primary">Add Order</button>
    </form>
</div>
@endsection
