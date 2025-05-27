@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #f8f9fa;
        color: #212529;
    }

    .light-card {
        background-color: #ffffff;
        border: 1px solid #dee2e6;
        border-radius: 16px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    }

    .light-title {
        color: #343a40;
        font-weight: 700;
    }

    .light-label {
        font-weight: 600;
        color: #495057;
    }

    .light-input {
        background-color: #fff;
        border: 1px solid #ced4da;
        color: #212529;
        border-radius: 10px;
    }

    .light-input:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.15rem rgba(13, 110, 253, 0.25);
    }

    .btn-primary-light {
        background-color: #0d6efd;
        border: none;
        transition: background-color 0.3s ease;
    }

    .btn-primary-light:hover {
        background-color: #0b5ed7;
    }

    .alert {
        border-radius: 12px;
        font-weight: 500;
    }
</style>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card light-card p-4">
                <div class="card-body">
                    <h2 class="mb-4 text-center light-title">🛍️ Vendor Registration</h2>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form method="POST" action="{{ route('vendor.register.submit') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label light-label">Full Name</label>
                            <input id="name" type="text"
                                   class="form-control light-input @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name') }}" required autofocus>
                            @error('name')
                                <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label light-label">Email Address</label>
                            <input id="email" type="email"
                                   class="form-control light-input @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label light-label">Password</label>
                            <input id="password" type="password"
                                   class="form-control light-input @error('password') is-invalid @enderror"
                                   name="password" required>
                            @error('password')
                                <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label light-label">Confirm Password</label>
                            <input id="password_confirmation" type="password"
                                   class="form-control light-input"
                                   name="password_confirmation" required>
                        </div>

                        <button type="submit"
                                class="btn w-100 py-2 fw-semibold text-white btn-primary-light rounded-3">
                            Register as Vendor
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
