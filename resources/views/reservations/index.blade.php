@extends('layouts.app')

@section('title', 'Manage Reservations')
@section('header', 'Reservation Management')

@section('content')
<div class="container">
    <h1>Reservation Management</h1>

    <!-- Success Message -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Add New Reservation Button -->
    <a href="{{ route('reservations.create') }}" class="btn btn-primary mb-3">Add New Reservation</a>

    <!-- Reservation Table -->
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Customer Name</th>
                <th>Contact Number</th>
                <th>Reservation Time</th>
                <th>Table Number</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reservations as $reservation)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $reservation->nama_pelanggan }}</td>
                <td>{{ $reservation->nomor_kontak }}</td>
                <td>{{ $reservation->waktu_reservasi }}</td>
                <td>{{ $reservation->nomor_meja }}</td>
                <td>{{ ucfirst($reservation->status) }}</td>
                <td>
                    <a href="{{ route('reservations.edit', $reservation->reservasi_id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('reservations.destroy', $reservation->reservasi_id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">No reservations found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
