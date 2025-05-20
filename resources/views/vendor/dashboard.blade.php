@extends('layouts.app')

@section('title', 'Vendor Dashboard')

@section('content')
<style>
  .vendor-container {
    margin-top: 3rem;
    margin-bottom: 3rem;
  }

  .welcome-text {
    font-weight: 700;
    font-size: 2.8rem;
    margin-bottom: 3rem;
    text-align: center;
    color: #ee4d2d; /* Shopee primary orange */
  }
  .welcome-text span {
    color: #ff6f3d; /* Lighter orange */
  }

  .card-vendor {
    border-radius: 18px;
    box-shadow: 0 10px 25px rgba(238, 77, 45, 0.15);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: none;
  }
  .card-vendor:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(238, 77, 45, 0.3);
  }

  .card-header-vendor {
    border-top-left-radius: 18px;
    border-top-right-radius: 18px;
    font-weight: 700;
    font-size: 1.3rem;
    padding: 1rem 1.5rem;
  }

  .card-body-vendor {
    padding: 2rem 1.5rem;
    text-align: center;
  }

  .card-title-vendor {
    font-size: 2.2rem;
    font-weight: 700;
    margin-bottom: 1.3rem;
    color: #333;
  }

  .btn-vendor {
    padding: 0.6rem 1.5rem;
    font-weight: 600;
    border-radius: 30px;
    font-size: 1rem;
    box-shadow: 0 6px 12px rgba(238, 77, 45, 0.3);
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
  }
  .btn-orange-vendor {
    background-color: #ee4d2d;
    border: none;
    color: #fff;
  }
  .btn-orange-vendor:hover {
    background-color: #d84324;
    box-shadow: 0 8px 18px rgba(238, 77, 45, 0.5);
  }
</style>

<div class="container vendor-container">
    <h1 class="welcome-text">Welcome, <span>{{ Auth::user()->name }}</span></h1>

    <div class="row g-4 justify-content-center">
        <div class="col-md-4">
            <div class="card card-vendor">
                <div class="card-header card-header-vendor text-white" style="background-color: #ee4d2d;">Your Products</div>
                <div class="card-body card-body-vendor">
                    <h5 class="card-title card-title-vendor">{{ $productCount }} Product{{ $productCount == 1 ? '' : 's' }}</h5>
                    <a href="{{ route('vendor.products') }}" class="btn btn-orange-vendor">Manage Products</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-vendor">
                <div class="card-header card-header-vendor text-white" style="background-color: #ff6f3d;">Orders</div>
                <div class="card-body card-body-vendor">
                    <h5 class="card-title card-title-vendor">{{ $orderCount }} Order{{ $orderCount == 1 ? '' : 's' }}</h5>
                    <a href="{{ route('vendor.orders') }}" class="btn btn-orange-vendor">View Orders</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-vendor">
                <div class="card-header card-header-vendor text-white" style="background-color: #ff8550;">Total Sales</div>
                <div class="card-body card-body-vendor">
                    <h5 class="card-title card-title-vendor">₱{{ number_format($totalSales, 2) }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
