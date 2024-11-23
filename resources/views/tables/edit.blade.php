@extends('layouts.app')

@section('title', 'Edit Table')
@section('header', 'Edit Table')

@section('content')
<div class="container">
    <h1>Edit Table</h1>

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

    <form action="{{ route('tables.update', $table->table_id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Table Number -->
        <div class="mb-3">
            <label for="nomor_meja" class="form-label">Table Number</label>
            <input type="number" name="nomor_meja" id="nomor_meja" class="form-control" value="{{ old('nomor_meja', $table->nomor_meja) }}" required>
        </div>

        <!-- Capacity -->
        <div class="mb-3">
            <label for="kapasitas" class="form-label">Capacity</label>
            <input type="number" name="kapasitas" id="kapasitas" class="form-control" value="{{ old('kapasitas', $table->kapasitas) }}" required>
        </div>

        <!-- Status -->
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="tersedia" {{ old('status', $table->status) === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="dipesan" {{ old('status', $table->status) === 'dipesan' ? 'selected' : '' }}>Dipesan</option>
                <option value="terisi" {{ old('status', $table->status) === 'terisi' ? 'selected' : '' }}>Terisi</option>
            </select>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-primary">Update Table</button>
    </form>
</div>
@endsection
