@extends('layouts.app')

@section('title', 'Manage Tables')
@section('header', 'Table Management')

@section('content')
<div class="container">
    <h1>Table Management</h1>

    <!-- Success Message -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Add New Table Button -->
    <a href="{{ route('tables.create') }}" class="btn btn-primary mb-3">Add New Table</a>

    <!-- Table -->
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Table Number</th>
                <th>Capacity</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tables as $table)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $table->nomor_meja }}</td>
                <td>{{ $table->kapasitas }}</td>
                <td>{{ ucfirst($table->status) }}</td>
                <td>
                    <a href="{{ route('tables.edit', $table->table_id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('tables.destroy', $table->table_id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">No tables found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
