@extends('layouts.app')

@section('title', 'Manage Sales Reports')
@section('header', 'Sales Reports Management')

@section('content')
<div class="container">
    <h1>Sales Reports Management</h1>

    <!-- Success Message -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Add New Sales Report Button -->
    <a href="{{ route('sales-reports.create') }}" class="btn btn-primary mb-3">Add New Sales Report</a>

    <!-- Sales Reports Table -->
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Menu</th>
                <th>Price</th>
                <th>Total</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reports as $report)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $report->tanggal }}</td>
                <td>{{ $report->menu->nama_menu }}</td>
                <td>{{ number_format($report->harga, 2) }}</td>
                <td>{{ number_format($report->total, 2) }}</td>
                <td>
                    <a href="{{ route('sales-reports.edit', $report->report_id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('sales-reports.destroy', $report->report_id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No sales reports found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
