@extends('layouts.layout')

@section('content')
<style>
  body {
    background-color: #fff9f7;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  .login-card {
    max-width: 420px;
    width: 100%;
    background: #fff;
    padding: 3rem 2.5rem;
    border-radius: 25px;
    box-shadow: 0 12px 25px rgba(238, 77, 45, 0.15);
    transition: box-shadow 0.3s ease;
  }

  .login-card:hover {
    box-shadow: 0 18px 35px rgba(238, 77, 45, 0.3);
  }

  .login-title {
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

  .form-control {
    border-radius: 12px;
    padding: 1rem 3.5rem 1rem 1.25rem;
    border: 2px solid #ee4d2d;
    font-size: 1.1rem;
    transition: border-color 0.3s ease;
  }

  .form-control:focus {
    border-color: #d94425;
    box-shadow: 0 0 8px rgba(238, 77, 45, 0.4);
  }

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

  .btn-login {
    background-color: #ee4d2d;
    border: none;
    width: 100%;
    padding: 1.15rem;
    font-weight: 700;
    font-size: 1.2rem;
    border-radius: 30px;
    transition: background-color 0.3s ease;
  }

  .btn-login:hover {
    background-color: #d94425;
  }

  .register-link {
    text-align: center;
    margin-top: 1.8rem;
    font-size: 1rem;
  }

  .register-link a {
    color: #ee4d2d;
    font-weight: 600;
    text-decoration: none;
    transition: color 0.3s ease;
  }

  .register-link a:hover {
    color: #d94425;
    text-decoration: underline;
  }

  .alert {
    padding: 0.9rem 1.2rem;
    border-radius: 12px;
    font-size: 0.95rem;
    font-weight: 600;
    color: #721c24;
    background-color: #f8d7da;
    border: 1px solid #f5c6cb;
  }
</style>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 70vh;">
  <div class="login-card">
    <h2 class="login-title">Login</h2>

    {{-- Error / Validation Message --}}
    @if (session('error'))
      <div class="alert text-center mb-4" role="alert">
        {{ session('error') }}
      </div>
    @endif

    @if ($errors->any())
      <div class="alert text-center mb-4" role="alert">
        {{ $errors->first() }}
      </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
      @csrf
      
      <div class="form-group">
        <input 
          type="email" 
          name="email" 
          class="form-control @error('email') is-invalid @enderror" 
          placeholder="Email" 
          required 
          autofocus
          value="{{ old('email') }}"
        >
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20 4H4a2 2 0 00-2 2v12a2 2 0 002 2h16a2 2 0 002-2V6a2 2 0 00-2-2zm0 2v.511l-8 5.333-8-5.333V6h16zM4 18V8.68l7.4 4.93a1 1 0 001.2 0L20 8.68V18H4z"/></svg>
      </div>

      <div class="form-group">
        <input 
          type="password" 
          name="password" 
          class="form-control @error('password') is-invalid @enderror" 
          placeholder="Password" 
          required
        >
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M17 8h-1V6a4 4 0 00-8 0v2H7a2 2 0 00-2 2v8a2 2 0 002 2h10a2 2 0 002-2v-8a2 2 0 00-2-2zM9 6a2 2 0 114 0v2H9V6zm6 10H9v-4h6v4z"/></svg>
      </div>

      <button type="submit" class="btn btn-login">Login</button>
    </form>

    <p class="register-link">
      Don't have an account? 
      <a href="{{ route('register') }}">Register here</a>
    </p>
  </div>
</div>
@endsection
