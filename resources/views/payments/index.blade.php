@extends('layouts.app')

@section('title', 'Manage Payments')
@section('header', 'Payment Management')

@section('content')
<div class="container">
    <h1>Payment Management</h1>

    <!-- Success Message -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Add New Payment Button -->
    <a href="{{ route('payments.create') }}" class="btn btn-primary mb-3">Add New Payment</a>

    <!-- Payments Table -->
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Table Number</th>
                <th>Menu Name</th>
                <th>Quantity</th>
                <th>Payment Method</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($payments as $payment)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $payment->nomor_meja }}</td>
                <td>{{ $payment->menu->nama_menu }}</td>
                <td>{{ $payment->jumlah }}</td>
                <td>{{ ucfirst($payment->metode_pembayaran) }}</td>
                <td>{{ ucfirst($payment->status) }}</td>
                <td>
                    <a href="{{ route('payments.edit', $payment->payment_id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('payments.destroy', $payment->payment_id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">No payments found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
