@extends('layouts.app')

@section('title', 'Manage Sales Programs')
@section('header', 'Sales Programs Management')

@section('content')
<div class="container">
    <h1>Sales Programs Management</h1>

    <!-- Success Message -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Add New Sales Program Button -->
    <a href="{{ route('sales-programs.create') }}" class="btn btn-primary mb-3">Add New Sales Program</a>

    <!-- Sales Programs Table -->
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Program Name</th>
                <th>Discount</th>
                <th>Validity Date</th>
                <th>Validity Time</th>
                <th>Menu</th>
                <th>Product Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($programs as $program)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $program->nama_program }}</td>
                <td>{{ number_format($program->diskon, 2) }}</td>
                <td>{{ $program->tanggal_berlaku }}</td>
                <td>{{ $program->jam_berlaku }}</td>
                <td>{{ $program->menu->nama_menu ?? 'All Menus' }}</td>
                <td>{{ ucfirst($program->kategori_produk) ?? 'All Categories' }}</td>
                <td>
                    <a href="{{ route('sales-programs.edit', $program->program_id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('sales-programs.destroy', $program->program_id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">No sales programs found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
