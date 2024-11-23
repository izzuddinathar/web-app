@extends('layouts.app')

@section('title', 'Manage Menus') <!-- Page title -->
@section('header', 'Menu Management') <!-- Card header -->

@section('content')
<div class="container">
    <h1>Menu Management</h1>

    <!-- Success Message -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Add New Menu Button -->
    <a href="{{ route('menus.create') }}" class="btn btn-primary mb-3">Add New Menu</a>

    <!-- Menu Table -->
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Menu Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Description</th>
                <th>Photo</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($menus as $menu)
            <tr>
                <td>{{ $loop->iteration }}</td> <!-- Auto-incrementing number -->
                <td>{{ $menu->nama_menu }}</td>
                <td>{{ ucfirst($menu->kategori) }}</td>
                <td>{{ number_format($menu->harga, 2) }}</td>
                <td>{{ $menu->deskripsi }}</td>
                <td>
                    @if($menu->gambar)
                    <img src="{{ asset('storage/' . $menu->gambar) }}" alt="Menu Photo" class="img-thumbnail" width="50">
                    @else
                    <span class="text-muted">No Photo</span>
                    @endif
                </td>
                <td>
                    <!-- Edit Button -->
                    <a href="{{ route('menus.edit', $menu->menu_id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <!-- Delete Button -->
                    <form action="{{ route('menus.destroy', $menu->menu_id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this menu?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">No menus found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
