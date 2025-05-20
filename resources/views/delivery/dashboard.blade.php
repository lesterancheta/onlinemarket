@extends('layouts.app')

@section('content')
<style>
    .dashboard-header {
        font-weight: bold;
        color: #ee4d2d;
        margin-bottom: 1.5rem;
    }

    .order-card {
        border: 1px solid #f3f3f3;
        border-radius: 15px;
        box-shadow: 0 8px 18px rgba(238, 77, 45, 0.08);
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        background-color: #fff;
        transition: box-shadow 0.3s ease;
    }

    .order-card:hover {
        box-shadow: 0 12px 30px rgba(238, 77, 45, 0.2);
    }

    .order-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #333;
    }

    .label {
        font-weight: 500;
        color: #888;
    }

    .value {
        color: #444;
    }

    .form-select,
    .btn-update {
        margin-top: 0.5rem;
    }

    .btn-update {
        background-color: #ee4d2d;
        color: white;
        border: none;
        font-weight: 600;
    }

    .btn-update:hover {
        background-color: #d94425;
    }
</style>

<div class="container">
    <h2 class="dashboard-header">Welcome, {{ auth()->user()->name }} (Delivery Dashboard)</h2>

    <h4 class="mb-4">Assigned Orders</h4>

    @if ($orders->isEmpty())
        <div class="alert alert-info">No assigned deliveries.</div>
    @else
        @foreach ($orders as $order)
            <div class="order-card">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <div class="order-title">Order #{{ $order->id }}</div>
                        <div><span class="label">Product:</span> <span class="value">{{ $order->product->name ?? 'Product deleted' }}</span></div>
                        <div><span class="label">Customer Name:</span> <span class="value">{{ $order->customer->name ?? 'N/A' }}</span></div>
                        <div><span class="label">Address:</span> <span class="value">{{ $order->customer->address ?? 'N/A' }}</span></div>
                        <div><span class="label">Contact:</span> <span class="value">{{ $order->customer->contact_number ?? 'N/A' }}</span></div>
                    </div>
                    <div class="col-md-6">
                        <div><span class="label">Order Status:</span> <span class="value">{{ ucfirst($order->status) }}</span></div>
                        <div><span class="label">Delivery Status:</span> <span class="value">{{ ucfirst($order->delivery_status ?? 'Not set') }}</span></div>

                        <form action="{{ route('delivery.orders.updateStatus', $order->id) }}" method="POST" class="mt-3">
                            @csrf
                            @method('PUT')
                            <div class="input-group">
                                <select name="delivery_status" class="form-select" required>
                                    <option value="pending" {{ $order->delivery_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="out_for_delivery" {{ $order->delivery_status == 'out_for_delivery' ? 'selected' : '' }}>Out for Delivery</option>
                                    <option value="delivered" {{ $order->delivery_status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                </select>
                                <button type="submit" class="btn btn-update ms-2">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
