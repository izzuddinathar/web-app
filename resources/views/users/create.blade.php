@extends('layouts.app')

@section('title', 'Edit User') <!-- Page title -->
@section('header', 'Edit User') <!-- Card header -->

@section('content')
<div class="container">
    <h1>Add New User</h1>
    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf <!-- CSRF token for security -->

        <!-- Name Field -->
        <div class="form-group">
            <label for="nama">Name</label>
            <input type="text" name="nama" id="nama" class="form-control" placeholder="Enter full name" value="{{ old('nama') }}" required>
            @error('nama')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Phone Number Field -->
        <div class="form-group">
            <label for="no_telp">Phone Number</label>
            <input type="text" name="no_telp" id="no_telp" class="form-control" placeholder="Enter phone number" value="{{ old('no_telp') }}" required>
            @error('no_telp')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Email Field -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Enter email" value="{{ old('email') }}" required>
            @error('email')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Photo Field -->
        <div class="form-group">
            <label for="foto">Photo</label>
            <input type="file" name="foto" id="foto" class="form-control-file">
            @error('foto')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Username Field -->
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control" placeholder="Enter username" value="{{ old('username') }}" required>
            @error('username')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Password Field -->
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required>
            @error('password')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Role Field -->
        <div class="form-group">
            <label for="role">Role</label>
            <select name="role" id="role" class="form-control" required>
                <option value="">Select Role</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="owner" {{ old('role') == 'owner' ? 'selected' : '' }}>Owner</option>
                <option value="waiters" {{ old('role') == 'waiters' ? 'selected' : '' }}>Waiters</option>
                <option value="cook" {{ old('role') == 'cook' ? 'selected' : '' }}>Cook</option>
                <option value="cleaner" {{ old('role') == 'cleaner' ? 'selected' : '' }}>Cleaner</option>
            </select>
            @error('role')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
