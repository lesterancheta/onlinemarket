@extends('layouts.layout')

@section('title', 'Admin Dashboard')

@section('content')

<style>
    :root {
        --shopee-orange: #ee4d2d;
        --shopee-orange-dark: #d94425;
    }

    body {
        background-color: #fff9f7;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    h2, h4 {
        color: var(--shopee-orange);
        font-weight: 700;
    }

    .sidebar {
        height: 100vh;
        background-color: #fff;
        padding: 1rem;
        border-right: 1px solid #f0c2b1;
        position: sticky;
        top: 0;
    }

    .sidebar .nav-link {
        color: #333;
        font-weight: 600;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        transition: background 0.3s;
    }

    .sidebar .nav-link.active,
    .sidebar .nav-link:hover {
        background-color: #ffebe6;
        color: var(--shopee-orange);
    }

    .card {
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(238, 77, 45, 0.2);
        border: none;
        transition: transform 0.15s ease-in-out;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(238, 77, 45, 0.3);
    }

    .btn-shopee {
        background-color: var(--shopee-orange);
        border: none;
        color: white;
        border-radius: 30px;
        padding: 0.5rem 1.25rem;
        font-weight: 600;
    }

    .btn-shopee:hover {
        background-color: var(--shopee-orange-dark);
    }

    .navbar-brand {
        color: var(--shopee-orange) !important;
        font-weight: 900;
        font-size: 1.6rem;
        letter-spacing: 1px;
    }
</style>

<!-- Admin Navbar -->
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm mb-0">
    <div class="container">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Public Market</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdminContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarAdminContent">
            <ul class="navbar-nav ms-auto">
                @auth
                    @if(auth()->user()->role === 'admin')
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    @endif
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- Main Content with Sidebar -->
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar">
            <nav class="nav flex-column">
                <a class="nav-link active" href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
                <a class="nav-link" href="{{ route('admin.vendors') }}">🛍️ Vendors</a>
                <a class="nav-link" href="{{ route('admin.customers') }}">👥 Customers</a>
                <a class="nav-link" href="{{ route('admin.products.manage') }}">📦 Products</a>
                <a class="nav-link" href="{{ route('admin.orders') }}">🧾 Orders</a>
            </nav>
        </div>

        <!-- Page Content -->
        <div class="col-md-10 py-4">
            <h2 class="mb-4 text-center">Admin Dashboard</h2>

            <!-- Statistics -->
            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <div class="card text-center p-3">
                        <h5>🛍️ Vendors</h5>
                        <h2>{{ $vendors }}</h2>
                        <a href="{{ route('admin.vendors') }}" class="btn btn-shopee btn-sm mt-2">View</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card text-center p-3">
                        <h5>👥 Customers</h5>
                        <h2>{{ $customers }}</h2>
                        <a href="{{ route('admin.customers') }}" class="btn btn-shopee btn-sm mt-2">View</a>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <div class="card text-center p-3">
                        <h5>📦 Products</h5>
                        <h2>{{ $products }}</h2>
                        <a href="{{ route('admin.products.manage') }}" class="btn btn-shopee btn-sm mt-2">View</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card text-center p-3">
                        <h5>🧾 Orders</h5>
                        <h2>{{ $orders }}</h2>
                        <a href="{{ route('admin.orders') }}" class="btn btn-shopee btn-sm mt-2">View</a>
                    </div>
                </div>
            </div>

            <hr class="my-5">

            <!-- New Items & Recent Orders -->
            <div class="row">
                <div class="col-md-3">
                    <h4>New Vendors</h4>
                    <div class="d-flex flex-column gap-2">
                        @forelse($vendorList as $vendor)
                            <div class="card shadow-sm border-0 p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <strong>{{ $vendor->name }}</strong>
                                    <span class="badge bg-secondary">New</span>
                                </div>
                            </div>
                        @empty
                            <div class="card p-3 text-center text-muted">No vendors yet</div>
                        @endforelse
                    </div>
                </div>

                <div class="col-md-3">
                    <h4>New Products</h4>
                    <div class="d-flex flex-column gap-2">
                        @forelse($productList as $product)
                            <div class="card shadow-sm border-0 p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $product->name }}</strong>
                                        <p class="mb-0 text-muted" style="font-size: 0.9rem;">₱{{ number_format($product->price, 2) }}</p>
                                    </div>
                                    <span class="badge bg-danger">{{ $product->stock }} in stock</span>
                                </div>
                            </div>
                        @empty
                            <div class="card p-3 text-center text-muted">No products yet</div>
                        @endforelse
                    </div>
                </div>

                <div class="col-md-6">
                    <h4>Recent Orders</h4>
                    <div class="d-flex flex-column gap-2">
                        @forelse($recentOrders as $order)
                            <div class="card shadow-sm border-0 p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>Order #{{ $order->id }}</strong><br>
                                        <small>by {{ optional($order->user)->name ?? 'Unknown User' }}</small>
                                    </div>
                                    <span class="badge bg-danger">{{ $order->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="card p-3 text-center text-muted">No recent orders</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
