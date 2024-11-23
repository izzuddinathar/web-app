@extends('layouts.app')

@section('title', 'Edit Sales Program')
@section('header', 'Edit Sales Program')

@section('content')
<div class="container">
    <h1>Edit Sales Program</h1>

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

    <form action="{{ route('sales-programs.update', $salesProgram->program_id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Program Name -->
        <div class="mb-3">
            <label for="nama_program" class="form-label">Program Name</label>
            <input type="text" name="nama_program" id="nama_program" class="form-control" value="{{ old('nama_program', $salesProgram->nama_program) }}" required>
        </div>

        <!-- Discount -->
        <div class="mb-3">
            <label for="diskon" class="form-label">Discount</label>
            <input type="number" name="diskon" id="diskon" class="form-control" value="{{ old('diskon', $salesProgram->diskon) }}" step="0.01" required>
        </div>

        <!-- Validity Date -->
        <div class="mb-3">
            <label for="tanggal_berlaku" class="form-label">Validity Date</label>
            <input type="datetime-local" name="tanggal_berlaku" id="tanggal_berlaku" class="form-control" value="{{ old('tanggal_berlaku', $salesProgram->tanggal_berlaku) }}" required>
        </div>

        <!-- Validity Time -->
        <div class="mb-3">
            <label for="jam_berlaku" class="form-label">Validity Time</label>
            <input type="time" name="jam_berlaku" id="jam_berlaku" class="form-control" value="{{ old('jam_berlaku', $salesProgram->jam_berlaku) }}" required>
        </div>

        <!-- Menu -->
        <div class="mb-3">
            <label for="menu_id" class="form-label">Menu (Optional)</label>
            <select name="menu_id" id="menu_id" class="form-control">
                <option value="">All Menus</option>
                @foreach($menus as $menu)
                    <option value="{{ $menu->menu_id }}" {{ old('menu_id', $salesProgram->menu_id) == $menu->menu_id ? 'selected' : '' }}>
                        {{ $menu->nama_menu }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Product Category -->
        <div class="mb-3">
            <label for="kategori_produk" class="form-label">Product Category (Optional)</label>
            <select name="kategori_produk" id="kategori_produk" class="form-control">
                <option value="">All Categories</option>
                <option value="cemilan" {{ old('kategori_produk', $salesProgram->kategori_produk) === 'cemilan' ? 'selected' : '' }}>Cemilan</option>
                <option value="makanan" {{ old('kategori_produk', $salesProgram->kategori_produk) === 'makanan' ? 'selected' : '' }}>Makanan</option>
                <option value="minuman" {{ old('kategori_produk', $salesProgram->kategori_produk) === 'minuman' ? 'selected' : '' }}>Minuman</option>
            </select>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-primary">Update Sales Program</button>
    </form>
</div>
@endsection
