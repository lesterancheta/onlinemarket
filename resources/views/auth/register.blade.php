@extends('layouts.layout')

@section('title', 'Customer Registration')

@section('content')
<style>
  body {
    background-color: #fff9f7;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  .register-card {
    max-width: 480px;
    width: 100%;
    background: #fff;
    padding: 3rem 2.5rem;
    border-radius: 25px;
    box-shadow: 0 12px 25px rgba(238, 77, 45, 0.15);
    transition: box-shadow 0.3s ease;
  }
  .register-card:hover {
    box-shadow: 0 18px 35px rgba(238, 77, 45, 0.3);
  }

  .register-title {
    font-weight: 700;
    font-size: 2.25rem;
    color: #ee4d2d;
    margin-bottom: 2rem;
    text-align: center;
    letter-spacing: 1px;
  }

  .form-group {
    position: relative;
    margin-bottom: 1.8rem;
  }

  .form-control, .form-select {
    border-radius: 12px;
    padding: 1rem 3.5rem 1rem 1.25rem;
    border: 2px solid #ee4d2d;
    font-size: 1.1rem;
    transition: border-color 0.3s ease;
  }
  .form-control:focus, .form-select:focus {
    border-color: #d94425;
    box-shadow: 0 0 8px rgba(238, 77, 45, 0.4);
  }

  /* Input icons */
  .form-group svg {
    position: absolute;
    top: 50%;
    right: 1.25rem;
    transform: translateY(-50%);
    fill: #ee4d2d;
    width: 22px;
    height: 22px;
    opacity: 0.7;
  }

  .btn-register {
    background-color: #ee4d2d;
    border: none;
    width: 100%;
    padding: 1.15rem;
    font-weight: 700;
    font-size: 1.2rem;
    border-radius: 30px;
    transition: background-color 0.3s ease;
  }
  .btn-register:hover {
    background-color: #d94425;
  }

  .login-link {
    text-align: center;
    margin-top: 1.8rem;
    font-size: 1rem;
  }
  .login-link a {
    color: #ee4d2d;
    font-weight: 600;
    text-decoration: none;
    transition: color 0.3s ease;
  }
  .login-link a:hover {
    color: #d94425;
    text-decoration: underline;
  }

  .alert {
    border-radius: 12px;
  }
</style>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 75vh;">
  <div class="register-card">

    <h2 class="register-title">Customer Registration</h2>

    {{-- Show validation errors --}}
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    {{-- Success flash message --}}
    @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    <form action="{{ route('register') }}" method="POST" novalidate>
      @csrf

      <div class="form-group">
        <input
          type="text"
          class="form-control"
          id="name"
          name="name"
          value="{{ old('name') }}"
          placeholder="Your Name"
          required
          autofocus
        >
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4 8 5.79 8 8s1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
      </div>

      <div class="form-group">
        <input
          type="email"
          class="form-control"
          id="email"
          name="email"
          value="{{ old('email') }}"
          placeholder="Your Email"
          required
        >
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20 4H4a2 2 0 00-2 2v12a2 2 0 002 2h16a2 2 0 002-2V6a2 2 0 00-2-2zm0 2v.511l-8 5.333-8-5.333V6h16zM4 18V8.68l7.4 4.93a1 1 0 001.2 0L20 8.68V18H4z"/></svg>
      </div>

      <div class="form-group">
        <input
          type="text"
          class="form-control"
          id="address"
          name="address"
          value="{{ old('address') }}"
          placeholder="Your Address"
          required
        >
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 110-5 2.5 2.5 0 010 5z"/></svg>
      </div>

      <div class="form-group">
        <input
          type="text"
          class="form-control"
          id="contact_number"
          name="contact_number"
          value="{{ old('contact_number') }}"
          placeholder="Your Contact Number"
          required
        >
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M6.62 10.79a15.053 15.053 0 006.59 6.59l2.2-2.2a1 1 0 011.11-.21c1.12.45 2.33.69 3.59.69a1 1 0 011 1v3.5a1 1 0 01-1 1C10.25 21 3 13.75 3 5a1 1 0 011-1h3.5a1 1 0 011 1c0 1.26.24 2.47.69 3.59a1 1 0 01-.21 1.11l-2.36 2.09z"/></svg>
      </div>

      <div class="form-group">
        <input
          type="password"
          class="form-control"
          id="password"
          name="password"
          placeholder="Your Password"
          required
        >
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M17 8h-1V6a4 4 0 00-8 0v2H7a2 2 0 00-2 2v8a2 2 0 002 2h10a2 2 0 002-2v-8a2 2 0 00-2-2zM9 6a2 2 0 114 0v2H9V6zm6 10H9v-4h6v4z"/></svg>
      </div>

      <div class="form-group">
        <input
          type="password"
          class="form-control"
          id="password_confirmation"
          name="password_confirmation"
          placeholder="Confirm Password"
          required
        >
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M17 8h-1V6a4 4 0 00-8 0v2H7a2 2 0 00-2 2v8a2 2 0 002 2h10a2 2 0 002-2v-8a2 2 0 00-2-2zM9 6a2 2 0 114 0v2H9V6zm6 10H9v-4h6v4z"/></svg>
      </div>

      {{-- Role only for Admins --}}
      @if(auth()->check() && auth()->user()->role == 'admin')
      <div class="form-group">
        <select name="role" id="role" class="form-select" required>
          <option value="admin">Admin</option>
          <option value="vendor">Vendor</option>
          <option value="customer" selected>Customer</option>
          <option value="delivery">Delivery</option>
        </select>
      </div>
      @endif

      <button type="submit" class="btn btn-register">
        Register
      </button>
    </form>

    <p class="login-link">
      Already have an account? 
      <a href="{{ route('login') }}">Login here</a>
    </p>
  </div>
</div>
@endsection
