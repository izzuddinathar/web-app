@extends('layouts.app')

@section('title', 'Add New Reservation')
@section('header', 'Add New Reservation')

@section('content')
<div class="container">
    <h1>Add New Reservation</h1>

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

    <form action="{{ route('reservations.store') }}" method="POST">
        @csrf

        <!-- Customer Name -->
        <div class="mb-3">
            <label for="nama_pelanggan" class="form-label">Customer Name</label>
            <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-control" value="{{ old('nama_pelanggan') }}" required>
        </div>

        <!-- Contact Number -->
        <div class="mb-3">
            <label for="nomor_kontak" class="form-label">Contact Number</label>
            <input type="text" name="nomor_kontak" id="nomor_kontak" class="form-control" value="{{ old('nomor_kontak') }}" required>
        </div>

        <!-- Reservation Time -->
        <div class="mb-3">
            <label for="waktu_reservasi" class="form-label">Reservation Time</label>
            <input type="datetime-local" name="waktu_reservasi" id="waktu_reservasi" class="form-control" 
                   value="{{ old('waktu_reservasi', now()->format('Y-m-d\TH:i')) }}" required>
        </div>        

        <!-- Table Number -->
        <div class="mb-3">
            <label for="nomor_meja" class="form-label">Table Number</label>
            <select name="nomor_meja" id="nomor_meja" class="form-control" required>
                <option value="">Select a table</option>
                @foreach($tables as $table)
                    <option value="{{ $table->nomor_meja }}" {{ old('nomor_meja') == $table->nomor_meja ? 'selected' : '' }}>
                        Table {{ $table->nomor_meja }} (Capacity: {{ $table->kapasitas }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Status -->
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="terjadwal" {{ old('status') === 'terjadwal' ? 'selected' : '' }}>Terjadwal</option>
                <option value="dibatalkan" {{ old('status') === 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                <option value="selesai" {{ old('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-primary">Add Reservation</button>
    </form>
</div>
@endsection
