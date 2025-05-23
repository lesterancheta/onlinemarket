@extends('layouts.app')

@section('content')
    <style>
        h2, h3 {
            color: #ee4d2d;
            font-weight: bold;
        }

        .table th {
            background-color: #ee4d2d;
            color: white;
            vertical-align: middle;
        }

        .table td {
            vertical-align: middle;
        }

        .btn-primary {
            background-color: #ee4d2d;
            border: none;
        }

        .btn-primary:hover {
            background-color: #d84324;
        }

        .form-select {
            border-color: #ee4d2d;
        }

        .form-select:focus {
            border-color: #ee4d2d;
            box-shadow: 0 0 0 0.2rem rgba(238, 77, 45, 0.25);
        }

        .container {
            margin-top: 30px;
        }

        .table-responsive {
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            border-radius: 10px;
            overflow: hidden;
        }
    </style>

    <div class="container">
        <h2>Welcome, {{ auth()->user()->name }}</h2>

        <h3 class="mt-4">Your Orders</h3>

        @if ($orders->isEmpty())
            <p class="text-muted">You have no orders yet.</p>
        @else
            <div class="table-responsive mt-3">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Product</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Customer Name</th>
                            <th>Address</th>
                            <th>Contact</th>
                            <th>Delivery Status</th>
                            <th>Delivery Person</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->product->name ?? 'Product deleted' }}</td>
                                <td>{{ ucfirst($order->status) }}</td>
                                <td>₱{{ number_format($order->total, 2) }}</td>
                                <td>{{ $order->customer->name ?? 'N/A' }}</td>
                                <td>{{ $order->customer->address ?? 'N/A' }}</td>
                                <td>{{ $order->customer->contact_number ?? 'N/A' }}</td>
                                <td>{{ ucfirst($order->delivery_status ?? 'Not set') }}</td>
                                <td>{{ optional($order->deliveryPerson)->name ?? 'Not assigned' }}</td>
                                <td>
                                    <form action="{{ route('vendor.orders.update', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <select name="status" class="form-select mb-1" required>
                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>

                                        <select name="delivery_person_id" class="form-select mb-1">
                                            <option value="">-- Assign Delivery Person --</option>
                                            @foreach ($deliveryPeople as $person)
                                                <option value="{{ $person->id }}" {{ $order->delivery_person_id == $person->id ? 'selected' : '' }}>
                                                    {{ $person->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <button type="submit" class="btn btn-sm btn-primary mt-1">Update</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="container mt-4">
    <!-- Back Button (Right-Aligned) -->
<a href="{{ route('vendor.dashboard') }}" class="btn btn-secondary mb-3 float-end">
     Back
</a>

            </div>
        @endif
    </div>
@endsection
