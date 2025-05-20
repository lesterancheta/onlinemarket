@extends('layouts.app')

@section('title', 'Order List')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4" style="color:rgb(241, 68, 15); font-weight: 700;">Order List</h2>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-danger text-white">
                <tr>
                    <th scope="col" style="width: 5%;">#</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Order ID</th>
                    <th scope="col">Total</th>
                    <th scope="col">Status</th>
                    <th scope="col">Ordered At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $order->user->name ?? 'N/A' }}</td>
                        <td>{{ $order->order_number }}</td>
                        <td>₱{{ number_format($order->total_amount, 2) }}</td>
                        <td>
                            <span class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'pending' ? 'warning' : 'secondary') }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td>{{ $order->created_at->format('M d, Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No orders found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="container mt-4">
    <!-- Back Button (Right-Aligned) -->
<a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mb-3 float-end">
     Back
</a>

    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $orders->links() }}
    </div>
</div>
@endsection
