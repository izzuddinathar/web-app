@extends('layouts.app')

@section('title', 'Manage Inventory')
@section('header', 'Inventory Management')

@section('content')
<div class="container">
    <h1>Inventory Management</h1>

    <!-- Success Message -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Add New Inventory Item Button -->
    <a href="{{ route('inventories.create') }}" class="btn btn-primary mb-3">Add New Inventory Item</a>

    <!-- Inventory Table -->
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Raw Material</th>
                <th>Quantity</th>
                <th>Unit</th>
                <th>Supplier</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($inventories as $inventory)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $inventory->nama_bahan_pokok }}</td>
                <td>{{ $inventory->jumlah }}</td>
                <td>{{ $inventory->satuan }}</td>
                <td>{{ $inventory->supplier }}</td>
                <td>
                    <a href="{{ route('inventories.edit', $inventory->inventory_id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('inventories.destroy', $inventory->inventory_id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No inventory items found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
