@extends('layouts.layout')

@section('content')

<style>
  /* Full dark background */
  body, html {
    height: 100%;
    margin: 0;
    background: #121212; /* very dark */
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  /* Center container full viewport height */
  .container {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 1rem;
  }

  /* Login card styling */
  .login-card {
    background: #1e1e1e; /* dark gray */
    border-radius: 1rem;
    width: 100%;
    max-width: 400px;
    padding: 2.5rem 2rem;
    color: #eee;
    text-align: center;
    box-shadow: none; /* no glow */
  }

  /* Title */
  .login-title {
    font-size: 2rem;
    font-weight: 700;
    color: #f97316;
    margin-bottom: 2rem;
  }

  /* Form group */
  .form-group {
    position: relative;
    margin-bottom: 1.5rem;
  }

  /* Inputs */
  .form-control {
    width: 100%;
    padding: 0.75rem 2.75rem 0.75rem 1rem;
    border: 1.5px solid #444;
    border-radius: 8px;
    background-color: #2a2a2a;
    color: #eee;
    font-weight: 600;
    font-size: 1rem;
    outline-offset: 2px;
    outline-color: transparent;
    transition: border-color 0.3s ease, background-color 0.3s ease;
  }
  .form-control::placeholder {
    color: #bbb;
    font-weight: 600;
  }
  .form-control:focus {
    border-color: #f97316;
    background-color: #3c3c3c;
    outline-color: #f97316;
  }

  /* SVG icons inside inputs */
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
  .btn-login {
    width: 100%;
    background-color: #f97316;
    color: white;
    border: none;
    padding: 0.85rem;
    border-radius: 10px;
    font-weight: 700;
    font-size: 1.1rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
  .btn-login:hover {
    background-color: #ea580c;
  }

  /* Alert messages */
  .alert {
    border-radius: 8px;
    margin-bottom: 1.25rem;
    padding: 0.8rem 1rem;
    font-weight: 600;
    background-color: #b91c1c; /* dark red */
    color: #fff;
  }

  /* Register link */
  .register-link {
    margin-top: 1.5rem;
    color: #eee;
    font-weight: 600;
  }
  .register-link a {
    color: #f97316;
    text-decoration: none;
    font-weight: 700;
    transition: color 0.3s ease;
  }
  .register-link a:hover {
    color: #ea580c;
  }

  /* Responsive for small screens */
  @media (max-width: 480px) {
    .login-card {
      padding: 2rem 1.5rem;
      max-width: 95%;
    }
    .login-title {
      font-size: 1.6rem;
    }
  }
</style>

<div class="container">
  <div class="login-card">

    <h2 class="login-title">Login</h2>

    {{-- Error / Validation Message --}}
    @if (session('error'))
      <div class="alert text-center" role="alert">
        {{ session('error') }}
      </div>
    @endif

    @if ($errors->any())
      <div class="alert text-center" role="alert">
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

      <button type="submit" class="btn-login">Login</button>
    </form>

    <p class="register-link">
      Don't have an account? 
      <a href="{{ route('register') }}">Register here</a>
    </p>
  </div>
</div>

@endsection
