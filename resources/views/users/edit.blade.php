@extends('layouts.app')

@section('title', 'Edit User') <!-- Page title -->
@section('header', 'Edit User') <!-- Card header -->

@section('content')
<div class="container">
    <h1>Edit User</h1>
    <form action="{{ route('users.update', $user->user_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Method spoofing for PUT request -->

        <!-- Name Field -->
        <div class="form-group">
            <label for="nama">Name</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ $user->nama }}" disabled>
        </div>

        <!-- Phone Number Field -->
        <div class="form-group">
            <label for="no_telp">Phone Number</label>
            <input type="text" name="no_telp" id="no_telp" class="form-control" value="{{ old('no_telp', $user->no_telp) }}" required>
            @error('no_telp')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Photo Field -->
        <div class="form-group">
            <label for="foto">Photo</label>
            <input type="file" name="foto" id="foto" class="form-control-file">
            @if($user->foto)
                <img src="{{ asset('storage/' . $user->foto) }}" alt="User Photo" class="img-thumbnail mt-2" width="100">
            @endif
            @error('foto')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Role Field -->
        <div class="form-group">
            <label for="role">Role</label>
            <select name="role" id="role" class="form-control" required>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="owner" {{ $user->role == 'owner' ? 'selected' : '' }}>Owner</option>
                <option value="waiters" {{ $user->role == 'waiters' ? 'selected' : '' }}>Waiters</option>
                <option value="cook" {{ $user->role == 'cook' ? 'selected' : '' }}>Cook</option>
                <option value="cleaner" {{ $user->role == 'cleaner' ? 'selected' : '' }}>Cleaner</option>
            </select>
            @error('role')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
