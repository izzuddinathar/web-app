@extends('layouts.app')

@section('title', 'Add New User') <!-- Page title -->
@section('header', 'Add New User') <!-- Card header -->

@section('content')
<div class="container">
    <h1>User Management</h1>

    <!-- Success Message -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Add New User Button -->
    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Add New User</a>

    <!-- User Table -->
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Role</th>
                <th>Photo</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td>{{ $loop->iteration }}</td> <!-- Auto-incrementing number -->
                <td>{{ $user->nama }}</td>
                <td>{{ $user->no_telp }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ ucfirst($user->role) }}</td>
                <td>
                    @if($user->foto)
                    <img src="{{ asset('storage/' . $user->foto) }}" alt="User Photo" class="img-thumbnail" width="50">
                    @else
                    <span class="text-muted">No Photo</span>
                    @endif
                </td>
                <td>
                    <!-- Edit Button -->
                    <a href="{{ route('users.edit', $user->user_id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <!-- Delete Button -->
                    <form action="{{ route('users.destroy', $user->user_id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">No users found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
