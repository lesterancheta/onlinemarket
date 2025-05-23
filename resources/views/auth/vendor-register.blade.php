@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #121212;
        color: #f5f5f5;
    }

    .dark-card {
        background-color: #1f1f1f;
        border: 1px solid #333;
        border-radius: 16px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.5);
    }

    .dark-title {
        color: #ffffff;
        font-weight: 700;
    }

    .dark-label {
        font-weight: 600;
        color: #cccccc;
    }

    .dark-input {
        background-color: #2c2c2c;
        border: 1px solid #444;
        color: #fff;
        border-radius: 10px;
    }

    .dark-input:focus {
        background-color: #2c2c2c;
        border-color: #28a745;
        box-shadow: 0 0 0 0.15rem rgba(40, 167, 69, 0.4);
        color: #fff;
    }

    .btn-ecom-green {
        background-color: #28a745;
        border: none;
        transition: background-color 0.3s ease;
    }

    .btn-ecom-green:hover {
        background-color: #218838;
    }

    .alert {
        border-radius: 12px;
        font-weight: 500;
    }
</style>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card dark-card p-4">
                <div class="card-body">
                    <h2 class="mb-4 text-center dark-title">🛍️ Vendor Registration</h2>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form method="POST" action="{{ route('vendor.register.submit') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label dark-label">Full Name</label>
                            <input id="name" type="text"
                                   class="form-control dark-input @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name') }}" required autofocus>
                            @error('name')
                                <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label dark-label">Email Address</label>
                            <input id="email" type="email"
                                   class="form-control dark-input @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label dark-label">Password</label>
                            <input id="password" type="password"
                                   class="form-control dark-input @error('password') is-invalid @enderror"
                                   name="password" required>
                            @error('password')
                                <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label dark-label">Confirm Password</label>
                            <input id="password_confirmation" type="password"
                                   class="form-control dark-input"
                                   name="password_confirmation" required>
                        </div>

                        <button type="submit"
                                class="btn w-100 py-2 fw-semibold text-white btn-ecom-green rounded-3">
                            Register as Vendor
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
