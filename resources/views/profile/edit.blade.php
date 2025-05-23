@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<style>
    .profile-card {
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .profile-card h2 {
        font-weight: bold;
        color: #ee4d2d;
    }

    .btn-orange {
        background-color: #ee4d2d;
        color: #fff;
        border: none;
    }

    .btn-orange:hover {
        background-color: #d84324;
    }

    .form-label {
        font-weight: 600;
    }
</style>

<div class="container mt-5">
    <div class="profile-card">
        <h2 class="mb-4">Edit Your Profile</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" value="{{ auth()->user()->email }}" class="form-control" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-control" rows="3">{{ old('address', auth()->user()->address) }}</textarea>
            </div>

           
            <button type="submit" class="btn btn-orange">Save Changes</button>
            
        </form>
    </div>
</div>
@endsection
