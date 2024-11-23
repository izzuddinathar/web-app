@extends('layouts.app')

@section('title', 'Edit Menu') <!-- Page title -->
@section('header', 'Edit Menu') <!-- Card header -->

@section('content')
<div class="container">
    <h1>Edit Menu</h1>

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

    <!-- Edit Menu Form -->
    <form action="{{ route('menus.update', $menu->menu_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="mb-3">
            <label for="nama_menu" class="form-label">Menu Name</label>
            <input type="text" name="nama_menu" id="nama_menu" class="form-control" value="{{ old('nama_menu', $menu->nama_menu) }}" required>
        </div>

        <!-- Category -->
        <div class="mb-3">
            <label for="kategori" class="form-label">Category</label>
            <select name="kategori" id="kategori" class="form-control" required>
                <option value="makanan" {{ old('kategori', $menu->kategori) === 'makanan' ? 'selected' : '' }}>Makanan</option>
                <option value="minuman" {{ old('kategori', $menu->kategori) === 'minuman' ? 'selected' : '' }}>Minuman</option>
                <option value="cemilan" {{ old('kategori', $menu->kategori) === 'cemilan' ? 'selected' : '' }}>Cemilan</option>
            </select>
        </div>

        <!-- Price -->
        <div class="mb-3">
            <label for="harga" class="form-label">Price</label>
            <input type="number" name="harga" id="harga" class="form-control" value="{{ old('harga', $menu->harga) }}" step="0.01" required>
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Description</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $menu->deskripsi) }}</textarea>
        </div>

        <!-- Image -->
        <div class="mb-3">
            <label for="gambar" class="form-label">Photo</label>
            <input type="file" name="gambar" id="gambar" class="form-control">
            @if($menu->gambar)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $menu->gambar) }}" alt="Menu Photo" class="img-thumbnail" width="100">
            </div>
            @endif
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Update Menu</button>
    </form>
</div>
@endsection
