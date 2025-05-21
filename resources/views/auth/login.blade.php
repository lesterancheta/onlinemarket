@extends('layouts.layout')

@section('content')
<style>
  body {
    background-color: #fff9f7;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  .login-card {
    max-width: 340px;
    width: 100%;
    background: #ffa94d; /* changed to orange */
    padding: 2rem 1.5rem;
    border-radius: 20px;
    box-shadow: 0 8px 20px rgba(238, 77, 45, 0.15);
    transition: box-shadow 0.3s ease;
  }

  .login-card:hover {
    box-shadow: 0 12px 30px rgba(238, 77, 45, 0.25);
  }

  .login-title {
    font-weight: 700;
    font-size: 1.75rem;
    color: #fff; /* changed text color to white for contrast */
    margin-bottom: 1.5rem;
    text-align: center;
    letter-spacing: 0.5px;
  }

  .form-group {
    position: relative;
    margin-bottom: 1.4rem;
  }

  .form-control {
    border-radius: 10px;
    padding: 0.75rem 3rem 0.75rem 1rem;
    border: 2px solid #fff; /* lighter border for contrast */
    font-size: 0.95rem;
    transition: border-color 0.3s ease;
    background-color: #fff; /* keep input background white */
    color: #333;
  }

  .form-control:focus {
    border-color: #fff;
    box-shadow: 0 0 6px rgba(255, 255, 255, 0.8);
    outline: none;
  }

  .form-group svg {
    position: absolute;
    top: 50%;
    right: 1rem;
    transform: translateY(-50%);
    fill: #fff; /* icon white */
    width: 18px;
    height: 18px;
    opacity: 0.85;
  }

  .btn-login {
    background-color: #fff; /* white button */
    color: #ffa94d; /* orange text */
    border: none;
    width: 100%;
    padding: 0.85rem;
    font-weight: 600;
    font-size: 1rem;
    border-radius: 25px;
    transition: background-color 0.3s ease, color 0.3s ease;
  }

  .btn-login:hover {
    background-color: #d4881f; /* darker orange */
    color: #fff;
  }

  .register-link {
    text-align: center;
    margin-top: 1.3rem;
    font-size: 0.9rem;
    color: #fff;
  }

  .register-link a {
    color: #fff;
    font-weight: 600;
    text-decoration: underline;
    transition: color 0.3s ease;
  }

  .register-link a:hover {
    color: #d4881f;
    text-decoration: underline;
  }

  .alert {
    padding: 0.7rem 1rem;
    border-radius: 10px;
    font-size: 0.85rem;
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
      <div class="alert text-center mb-3" role="alert">
        {{ session('error') }}
      </div>
    @endif

    @if ($errors->any())
      <div class="alert text-center mb-3" role="alert">
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
