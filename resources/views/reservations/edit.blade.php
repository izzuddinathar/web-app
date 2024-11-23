@extends('layouts.app')

@section('title', 'Edit Reservation')
@section('header', 'Edit Reservation')

@section('content')
<div class="container">
    <h1>Edit Reservation</h1>

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

    <form action="{{ route('reservations.update', $reservation->reservasi_id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Customer Name -->
        <div class="mb-3">
            <label for="nama_pelanggan" class="form-label">Customer Name</label>
            <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-control" value="{{ old('nama_pelanggan', $reservation->nama_pelanggan) }}" required>
        </div>

        <!-- Contact Number -->
        <div class="mb-3">
            <label for="nomor_kontak" class="form-label">Contact Number</label>
            <input type="text" name="nomor_kontak" id="nomor_kontak" class="form-control" value="{{ old('nomor_kontak', $reservation->nomor_kontak) }}" required>
        </div>

        <!-- Reservation Time -->
        <div class="mb-3">
            <label for="waktu_reservasi" class="form-label">Reservation Time</label>
            <input type="datetime-local" name="waktu_reservasi" id="waktu_reservasi" class="form-control" 
                   value="{{ old('waktu_reservasi', $reservation->waktu_reservasi->format('Y-m-d\TH:i')) }}" required>
        </div>        

        <!-- Table Number -->
        <div class="mb-3">
            <label for="nomor_meja" class="form-label">Table Number</label>
            <select name="nomor_meja" id="nomor_meja" class="form-control" required>
                @foreach($tables as $table)
                    <option value="{{ $table->nomor_meja }}" {{ old('nomor_meja', $reservation->nomor_meja) == $table->nomor_meja ? 'selected' : '' }}>
                        Table {{ $table->nomor_meja }} (Capacity: {{ $table->kapasitas }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Status -->
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="terjadwal" {{ old('status', $reservation->status) === 'terjadwal' ? 'selected' : '' }}>Terjadwal</option>
                <option value="dibatalkan" {{ old('status', $reservation->status) === 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                <option value="selesai" {{ old('status', $reservation->status) === 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-primary">Update Reservation</button>
    </form>
</div>
@endsection
