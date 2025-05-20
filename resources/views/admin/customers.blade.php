@extends('layouts.app')

@section('title', 'Customer List')

@section('content')
<div class="container mt-4">


    <h2 class="mb-4" style="color:rgb(241, 68, 15); font-weight: 700;">Registered Customers</h2>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-danger text-white">
                <tr>
                    <th scope="col" style="width: 5%;">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Registered At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($customers as $customer)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->created_at->format('M d, Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">No customers found.</td>
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
        {{ $customers->links() }}
    </div>
</div>
@endsection
