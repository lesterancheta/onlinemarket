@extends('layouts.layout')

@section('title', 'Customer Registration')

@section('content')

<style>
  /* Reset & base */
  body, html {
    background-color: #121212;
    height: 100%;
    margin: 0;
    font-family: Arial, sans-serif;
  }

  /* Center container with flex */
  .container {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 1rem;
  }

  /* Card wrapper */
  .register-card {
    background: #1f1f1f;
    border: 2px solid #f97316;
    border-radius: 1rem;
    box-shadow: 0 4px 12px rgba(249,115,22,0.3);
    width: 100%;
    max-width: 900px; /* max width expanded for desktop */
    padding: 2rem;
    color: white;
  }

  .register-title {
    font-size: 2rem;
    font-weight: 700;
    color: #f97316;
    margin-bottom: 1.5rem;
    text-align: center;
  }

  /* Form grid: 3 columns desktop */
  form {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem 1.5rem;
  }

  /* Form groups */
  .form-group {
    position: relative;
  }

  /* Inputs */
  .form-control {
    width: 100%;
    padding: 0.75rem 2.75rem 0.75rem 1rem;
    border: 1.5px solid #444;
    border-radius: 8px;
    background-color: #2c2c2c;
    color: white;
    font-weight: bold;
    font-size: 1rem;
    outline-offset: 2px;
    outline-color: transparent;
    transition: border-color 0.3s ease;
  }

  .form-control::placeholder {
    color: #bbb;
    font-weight: bold;
  }

  .form-control:focus {
    border-color: #f97316;
    outline-color: #f97316;
    background-color: #3a3a3a;
  }

  /* SVG icon position */
  .form-group svg {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    fill: #f97316;
    width: 20px;
    height: 20px;
    pointer-events: none;
  }

  /* Button */
  .btn-register {
    grid-column: 1 / -1; /* full width */
    background-color: #f97316;
    color: white;
    border: none;
    padding: 0.75rem;
    border-radius: 8px;
    font-weight: 700;
    font-size: 1.1rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-top: 1rem;
  }

  .btn-register:hover {
    background-color: #ea580c;
  }

  /* Login link */
  .login-link {
    grid-column: 1 / -1; /* full width */
    text-align: center;
    margin-top: 1rem;
    color: white;
    font-weight: bold;
  }

  .login-link a {
    color: #f97316;
    text-decoration: none;
    font-weight: 700;
  }

  /* Alerts full width */
  .alert {
    border-radius: 8px;
    grid-column: 1 / -1;
  }

  /* Select styling */
  select.form-select {
    width: 100%;
    padding: 0.75rem 1rem;
    border-radius: 8px;
    border: 1.5px solid #444;
    background-color: #2c2c2c;
    color: white;
    font-weight: bold;
    font-size: 1rem;
  }

  select.form-select:focus {
    border-color: #f97316;
    outline-color: #f97316;
    background-color: #3a3a3a;
    outline-offset: 2px;
  }

  /* Responsive adjustments */
  @media (max-width: 900px) {
    form {
      grid-template-columns: repeat(2, 1fr); /* 2 columns tablets */
    }
  }

  @media (max-width: 600px) {
    form {
      grid-template-columns: 1fr; /* 1 column phones */
    }
  }
</style>

<div class="container">
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

      <button type="submit" class="btn-register">
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
