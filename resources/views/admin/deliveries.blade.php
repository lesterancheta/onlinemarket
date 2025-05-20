@extends('layouts.admin')

@section('content')
    <h1 class="mb-4">🚚 Deliveries</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Status</th>
                <th>Delivered At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($deliveries as $delivery)
                <tr>
                    <td>{{ $delivery->id }}</td>
                    <td>{{ $delivery->order_id }}</td>
                    <td>{{ $delivery->user->name ?? 'N/A' }}</td>
                    <td>{{ $delivery->status }}</td>
                    <td>{{ $delivery->delivered_at ?? 'Pending' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $deliveries->links() }}
@endsection
