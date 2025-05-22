@extends('layouts.app')

@section('title', 'Your Products')

@section('content')
<style>
    .table th {
        background-color: #ee4d2d;
        color: white;
        vertical-align: middle;
    }

    .table td {
        vertical-align: middle;
    }

    .btn-orange {
        background-color: #ee4d2d;
        color: #fff;
        border: none;
        transition: 0.3s ease;
    }

    .btn-orange:hover {
        background-color: #d84324;
        color: #fff;
    }

    .btn-warning {
        background-color: #ffc107;
        color: #212529;
        border: none;
    }

    .btn-warning:hover {
        background-color: #e0a800;
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
    }

    .btn-danger:hover {
        background-color:rgb(245, 84, 9);
    }

    .modal-header {
        background-color: #ee4d2d;
        color: white;
    }

    .modal-footer .btn-primary {
        background-color: #ee4d2d;
        border: none;
    }

    .modal-footer .btn-primary:hover {
        background-color: #d84324;
    }

    h2 {
        font-weight: 700;
        color: #ee4d2d;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: none;
    }
</style>

    <!-- Heading -->
    <h2>Your Products</h2>

    <!-- Add Product Button -->
    <a href="{{ route('vendor.products.create') }}" class="btn btn-orange mb-3">Add New Product</a>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Products Table -->
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price (₱)</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>
                            @if($product->picture)
                                <img src="{{ asset('storage/app/public/' . $product->picture) }}" width="60" height="60" style="object-fit: cover;">
                            @else
                                <img src="{{ asset('images/no-image.png') }}" width="60" height="60">
                            @endif
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>₱{{ number_format($product->price, 2) }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $product->id }}">
                                Edit
                            </button>

                            <form action="{{ route('vendor.products.destroy', $product) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this product?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Product Modal -->
                    <div class="modal fade" id="editModal{{ $product->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $product->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('vendor.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $product->id }}">Edit Product</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group mb-3">
                                            <label>Product Name</label>
                                            <input type="text" name="name" value="{{ $product->name }}" class="form-control" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Price (₱)</label>
                                            <input type="number" name="price" value="{{ $product->price }}" class="form-control" step="0.01" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Stock</label>
                                            <input type="number" name="stock" value="{{ $product->stock }}" class="form-control" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Product Image</label>
                                            <input type="file" name="image" class="form-control" accept="image/*">
                                            @if($product->picture)
                                                <small class="text-muted d-block mt-2">Current image: 
                                                    <img src="{{ asset('storage/app/public/' . $product->picture) }}" width="40" height="40" class="ms-2" style="object-fit: cover;">
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button class="btn btn-primary" type="submit">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End Edit Product Modal -->

                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Logout Button -->
    <div class="text-end mt-3">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-danger">Logout</button>
        </form>
        <div class="container mt-4">
    <!-- Back Button (Right-Aligned) -->
<a href="{{ route('vendor.dashboard') }}" class="btn btn-secondary mb-3 float-end">
     Back
</a>

    </div>
</div>
@endsection
