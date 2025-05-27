@extends('layouts.layout')

@section('title', 'Customer Registration')

@section('content')

<style>
  body, html {
    background-color: #f8f9fa;
    height: 100%;
    margin: 0;
    font-family: Arial, sans-serif;
    color: #333;
  }

  .container {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 1rem;
  }

  .register-card {
    background: #ffffff;
    border: 1px solid #dee2e6;
    border-radius: 1rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    width: 100%;
    max-width: 900px;
    padding: 2rem;
    color: #333;
  }

  .register-title {
    font-size: 2rem;
    font-weight: 700;
    color: #0d6efd;
    margin-bottom: 1.5rem;
    text-align: center;
  }

  form {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem 1.5rem;
  }

  .form-group {
    position: relative;
  }

  .form-control {
    width: 100%;
    padding: 0.75rem 2.5rem 0.75rem 1rem;
    border: 1px solid #ced4da;
    border-radius: 8px;
    background-color: #fff;
    color: #333;
    font-size: 1rem;
  }

  .form-control::placeholder {
    color: #6c757d;
  }

  .form-control:focus {
    border-color: #0d6efd;
    outline: none;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
  }

  .form-group svg {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    fill: #0d6efd;
    width: 20px;
    height: 20px;
    pointer-events: none;
  }

  .btn-register {
    grid-column: 1 / -1;
    background-color: #0d6efd;
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
    background-color: #0b5ed7;
  }

  .login-link {
    grid-column: 1 / -1;
    text-align: center;
    margin-top: 1rem;
    color: #333;
    font-weight: bold;
  }

  .login-link a {
    color: #0d6efd;
    text-decoration: none;
  }

  .login-link a:hover {
    text-decoration: underline;
  }

  .alert {
    border-radius: 8px;
    grid-column: 1 / -1;
  }

  select.form-select {
    width: 100%;
    padding: 0.75rem 1rem;
    border-radius: 8px;
    border: 1px solid #ced4da;
    background-color: #fff;
    color: #333;
    font-size: 1rem;
  }

  select.form-select:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13,110,253,0.25);
    outline: none;
  }

  @media (max-width: 900px) {
    form {
      grid-template-columns: repeat(2, 1fr);
    }
  }

  @media (max-width: 600px) {
    form {
      grid-template-columns: 1fr;
    }
  }
</style>

<div class="container">
  <div class="register-card">
    <h2 class="register-title">Customer Registration</h2>

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    <form action="{{ route('register') }}" method="POST" novalidate>
      @csrf

      <div class="form-group">
        <input type="text" class="form-control" name="name" placeholder="Your Name" value="{{ old('name') }}" required autofocus>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="..."/></svg>
      </div>

      <div class="form-group">
        <input type="email" class="form-control" name="email" placeholder="Your Email" value="{{ old('email') }}" required>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="..."/></svg>
      </div>

      <div class="form-group">
        <input type="text" class="form-control" name="address" placeholder="Your Address" value="{{ old('address') }}" required>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="..."/></svg>
      </div>

      <div class="form-group">
        <input type="text" class="form-control" name="contact_number" placeholder="Your Contact Number" value="{{ old('contact_number') }}" required>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="..."/></svg>
      </div>

      <div class="form-group">
        <input type="password" class="form-control" name="password" placeholder="Your Password" required>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="..."/></svg>
      </div>

      <div class="form-group">
        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="..."/></svg>
      </div>

      @if(auth()->check() && auth()->user()->role == 'admin')
      <div class="form-group">
        <select name="role" class="form-select" required>
          <option value="admin">Admin</option>
          <option value="vendor">Vendor</option>
          <option value="customer" selected>Customer</option>
          <option value="delivery">Delivery</option>
        </select>
      </div>
      @endif

      <button type="submit" class="btn-register">Register</button>
    </form>

    <p class="login-link">
      Already have an account?
      <a href="{{ route('login') }}">Login here</a>
    </p>
  </div>
</div>

@endsection
