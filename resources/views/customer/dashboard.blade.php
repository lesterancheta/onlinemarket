@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h2 class="mb-4">Welcome, {{ auth()->user()->name }}</h2>

            <h4 class="mb-3">Your Orders</h4>

            @if ($orders->isEmpty())
                <div class="alert alert-info" role="alert">
                    You have no orders yet.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Order ID</th>
                                <th>Product</th>
                                
                                <th>Total</th>
                                <th>Delivery Status</th>
                                <th>Delivery Person</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>#{{ $order->id }}</td>
                                    <td>{{ $order->product->name ?? 'Product deleted' }}</td>
                                    <td>
                                        
                                    </td>
                                    <td>₱{{ number_format($order->total, 2) }}</td>
                                    <td>
                                        <span class="badge bg-info text-dark">{{ ucfirst($order->delivery_status ?? 'Not set') }}</span>
                                    </td>
                                    <td>{{ $order->deliveryPerson->name ?? 'Not assigned' }}</td>


                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="container mt-4">
    <!-- Back Button (Right-Aligned) -->
<a href="{{ route('shop') }}" class="btn btn-secondary mb-3 float-end">
     Back
</a>

                </div>
            @endif
        </div>
    </div>
</div>
@endsection
