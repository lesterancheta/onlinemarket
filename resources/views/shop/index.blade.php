@extends('layouts.app')

@section('title', 'Online Public Market')

@section('content')
<style>
  /* LIGHT THEME BASE */
  body, html {
    background-color: #f9fafb;
    color: #333;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  .market-container {
    margin-top: 3rem;
    padding-bottom: 4rem;
  }

  .market-title {
    font-weight: 700;
    font-size: 2.8rem;
    color: #ff6600; /* orange accent */
    margin-bottom: 2.5rem;
    text-align: center;
    letter-spacing: 1px;
  }

  /* PRODUCT GRID: 4 ITEMS */
  .row.g-4 {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 2rem;
  }

  @media (max-width: 1200px) {
    .row.g-4 {
      grid-template-columns: repeat(3, 1fr);
    }
  }
  @media (max-width: 900px) {
    .row.g-4 {
      grid-template-columns: repeat(2, 1fr);
    }
  }
  @media (max-width: 600px) {
    .row.g-4 {
      grid-template-columns: 1fr;
    }
  }

  /* PRODUCT CARD */
  .card-product {
    background-color: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    height: 100%;
    transition: box-shadow 0.3s ease, transform 0.3s ease;
  }

  .card-product:hover {
    box-shadow: 0 12px 30px rgba(255, 102, 0, 0.3);
    transform: translateY(-6px);
  }

  .card-product img {
    height: 220px;
    width: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
  }
  .card-product:hover img {
    transform: scale(1.05);
  }

  .card-product-body {
    padding: 1.5rem 1.25rem;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  .product-name {
    font-weight: 700;
    font-size: 1.25rem;
    color: #222;
    margin-bottom: 0.7rem;
    min-height: 56px;
    line-height: 1.2;
  }

  .product-price {
    font-size: 1.3rem;
    font-weight: 700;
    color: #ff6600;
    margin-bottom: 1.5rem;
  }

  /* FORMS */
  .order-form {
    display: flex;
    gap: 0.7rem;
    align-items: center;
    flex-wrap: wrap;
  }

  .order-form input[type="number"] {
    width: 65px;
    padding: 0.45rem 0.7rem;
    border-radius: 10px;
    border: 2px solid #ff6600;
    font-weight: 600;
    font-size: 1rem;
    color: #333;
    transition: border-color 0.3s ease;
  }
  .order-form input[type="number"]:focus {
    outline: none;
    border-color: #e65c00;
    box-shadow: 0 0 6px rgba(255, 102, 0, 0.4);
  }

  /* ORDER NOW BUTTON (ORANGE) */
  .order-form button.order-now {
    background-color: #ff6600;
    border: none;
    padding: 0.5rem 1.3rem;
    border-radius: 12px;
    color: #fff;
    font-weight: 700;
    font-size: 1rem;
    cursor: pointer;
    box-shadow: 0 4px 10px rgba(255, 102, 0, 0.4);
    transition: background-color 0.3s ease;
  }
  .order-form button.order-now:hover {
    background-color: #e65c00;
  }

  /* ADD TO CART BUTTON (GREEN) */
  .order-form button.add-to-cart {
    background-color: #28a745;
    border: none;
    padding: 0.5rem 1.3rem;
    border-radius: 12px;
    color: #fff;
    font-weight: 700;
    font-size: 1rem;
    cursor: pointer;
    box-shadow: 0 4px 10px rgba(40, 167, 69, 0.4);
    transition: background-color 0.3s ease;
  }
  .order-form button.add-to-cart:hover {
    background-color: #218838;
  }

  /* ALERTS */
  .alert-success {
    background-color: #dff0d8;
    border-radius: 12px;
    font-weight: 600;
    text-align: center;
    padding: 1rem;
    margin-bottom: 2rem;
    color: #3c763d;
    box-shadow: 0 4px 12px rgba(60, 118, 61, 0.3);
  }

  .alert-info {
    background-color: #f5f5f5;
    border-radius: 12px;
    font-weight: 600;
    text-align: center;
    font-size: 1.2rem;
    color: #666;
    padding: 1rem;
    box-shadow: 0 0 10px rgba(0,0,0,0.05);
    margin-top: 2rem;
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
      <div>
        <div class="card card-product">
          @if ($product->picture)
            <img src="{{ asset('storage/app/public/' . $product->picture) }}" alt="{{ $product->name }}">
          @else
            <img src="{{ asset('images/no-image.png') }}" alt="No Image">
          @endif
          <div class="card-product-body">
            <h5 class="product-name">{{ $product->name }}</h5>
            <p class="product-price">₱{{ number_format($product->price, 2) }}</p>

            @auth
              @if(auth()->user()->role === 'customer')
                <form method="POST" action="{{ route('order.place', $product->id) }}" class="order-form d-inline">
                  @csrf
                  <input type="number" name="quantity" min="1" max="{{ $product->stock }}" value="" required>
                  <button type="submit" class="order-now">Order Now</button>
                </form>

                <form method="POST" action="{{ route('cart.add', $product->id) }}" class="order-form d-inline" style="margin-top: 0.6rem;">
                  @csrf
                  <input type="hidden" name="quantity" value="">
                  <button type="submit" class="add-to-cart">Add to Cart</button>
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
