@extends('layouts.app')

@section('title', 'Manage Orders')
@section('header', 'Order Management')

@section('content')
<div class="container">
    <h1>Order Management</h1>

    <!-- Success Message -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Add New Order Button -->
    <a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">Add New Order</a>

    <!-- Orders Table -->
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Table Number</th>
                <th>Menu Name</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $order->nomor_meja }}</td>
                <td>{{ $order->menu->nama_menu }}</td>
                <td>{{ $order->jumlah }}</td>
                <td>{{ ucfirst($order->status_pesanan) }}</td>
                <td>
                    <a href="{{ route('orders.edit', $order->order_id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('orders.destroy', $order->order_id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No orders found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
