@extends('layouts.app')

@section('title', 'Online Public Market')

@section('content')
<style>
  .market-container {
    margin-top: 3rem;
  }

  .market-title {
    font-weight: 700;
    font-size: 2.5rem;
    color: #ee4d2d;
    margin-bottom: 2rem;
    text-align: center;
  }

  .card-product {
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(238, 77, 45, 0.12);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    height: 100%;
  }
  .card-product:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 30px rgba(238, 77, 45, 0.25);
  }

  .card-product img {
    height: 220px;
    object-fit: cover;
    border-bottom: 3px solid #ee4d2d;
  }

  .card-product-body {
    flex-grow: 1;
    padding: 1.25rem 1.5rem;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  .product-name {
    font-weight: 600;
    font-size: 1.3rem;
    color: #333;
    margin-bottom: 0.6rem;
    min-height: 52px; /* to keep consistent height */
  }

  .product-price {
    font-size: 1.2rem;
    color: #ee4d2d;
    font-weight: 700;
    margin-bottom: 1.2rem;
  }

  .order-form {
    display: flex;
    gap: 0.8rem;
    align-items: center;
  }

  .order-form input[type="number"] {
    width: 70px;
    padding: 0.5rem 0.75rem;
    border-radius: 12px;
    border: 2px solid #ee4d2d;
    font-weight: 600;
    font-size: 1rem;
    transition: border-color 0.3s ease;
  }
  .order-form input[type="number"]:focus {
    outline: none;
    border-color: #d94425;
    box-shadow: 0 0 8px rgba(238, 77, 45, 0.4);
  }

  .order-form button {
    background-color:rgb(252, 99, 11); /* a nice green */
    border: none;
    padding: 0.55rem 1.2rem;
    border-radius: 15px;
    color: #fff;
    font-weight: 700;
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
  .order-form button:hover {
    background-color:rgb(252, 92, 0);
  }

  .alert-success {
    border-radius: 15px;
    font-weight: 600;
    text-align: center;
  }

  .alert-info {
    border-radius: 15px;
    font-weight: 600;
    text-align: center;
    font-size: 1.2rem;
    color: #555;
  }
</style>

<div class="container market-container">
  <h1 class="market-title">Products</h1>

  @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif

  <div class="row g-4">
    @forelse ($products as $product)
      <div class="col-md-4 col-sm-6">
        <div class="card card-product">
          @if ($product->picture)
            <img src="{{ asset('storage/' . $product->picture) }}" alt="{{ $product->name }}">
          @else
            <img src="{{ asset('images/no-image.png') }}" alt="No Image">
          @endif
          <div class="card-product-body">
            <h5 class="product-name">{{ $product->name }}</h5>
            <p class="product-price">₱{{ number_format($product->price, 2) }}</p>

            @auth
              @if(auth()->user()->role === 'customer')
                <!-- ORDER NOW -->
<form method="POST" action="{{ route('order.place', $product->id) }}" class="order-form d-inline">
    @csrf
    <input type="number" name="quantity" min="1" max="{{ $product->stock }}" value="1" required>
    <button type="submit" class="btn btn-success">Order Now</button>
</form>

<!-- ADD TO CART -->
<form method="POST" action="{{ route('cart.add', $product->id) }}" class="cart-form d-inline">
    @csrf
    <input type="hidden" name="quantity" value="1"> <!-- or sync quantity via JS if needed -->
    <button type="submit" class="btn btn-primary">Add to Cart</button>
</form>

              @endif
            @endauth
          </div>
        </div>
      </div>
    @empty
      <div class="col-12">
        <div class="alert alert-info">No products available at the moment.</div>
      </div>
    @endforelse
  </div>
</div>
@endsection
