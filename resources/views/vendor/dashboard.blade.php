@extends('layouts.app')

@section('title', 'Vendor Dashboard')

@section('content')
<style>
  .dashboard-heading {
    margin: 3rem 0 2rem;
    text-align: center;
    font-size: 2.5rem;
    font-weight: bold;
    color: #ee4d2d;
  }

  .dashboard-heading span {
    color: #ff6f3d;
  }

  .simple-card {
    border: 1px solid #eee;
    border-radius: 10px;
    padding: 1.5rem;
    background-color: #fff;
    transition: transform 0.2s;
  }

  .simple-card:hover {
    transform: translateY(-5px);
  }

  .card-title {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 1rem;
    color: #333;
  }

  .btn-orange {
    background-color: #ee4d2d;
    color: white;
    font-weight: 600;
    padding: 0.5rem 1.2rem;
    border-radius: 25px;
    text-decoration: none;
    display: inline-block;
  }

  .btn-orange:hover {
    background-color: #d84324;
    color: white;
  }

  .sales-amount {
    font-size: 2rem;
    font-weight: 700;
    color: #28a745;
  }
</style>



  <div class="row g-4 justify-content-center">
    <!-- Products Card -->
    <div class="col-md-4">
      <div class="simple-card text-center">
        <div class="card-title">Your Products</div>
        <div class="mb-3">{{ $productCount }} Product{{ $productCount == 1 ? '' : 's' }}</div>
        <a href="{{ route('vendor.products') }}" class="btn-orange">Manage Products</a>
      </div>
    </div>

    <!-- Orders Card -->
    <div class="col-md-4">
      <div class="simple-card text-center">
        <div class="card-title">Orders</div>
        <div class="mb-3">{{ $orderCount }} Order{{ $orderCount == 1 ? '' : 's' }}</div>
        <a href="{{ route('vendor.orders') }}" class="btn-orange">View Orders</a>
      </div>
    </div>

    <!-- Total Sales Card -->
    <div class="col-md-4">
      <div class="simple-card text-center">
        <div class="card-title">Total Sales</div>
        <div class="sales-amount">₱{{ number_format($totalSales, 2) }}</div>
      </div>
    </div>
  </div>
</div>
@endsection
