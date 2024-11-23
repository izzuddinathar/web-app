@extends('layouts.app')

@section('title', 'Forbidden')

@section('content')
<div class="container text-center">
    <h1 class="display-4 text-danger">403</h1>
    <h2 class="mb-4">Forbidden</h2>
    <p class="mb-4">You do not have permission to access this page.</p>
    <a href="{{ route('dashboard') }}" class="btn btn-primary">Go Back to Dashboard</a>
</div>
@endsection
