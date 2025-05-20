@extends('layouts.app')

@section('content')
    <style>
        h1 {
            color: #ee4d2d;
            font-weight: bold;
        }

        .btn-primary, .btn-success {
            background-color: #ee4d2d;
            border: none;
        }

        .btn-primary:hover, .btn-success:hover {
            background-color: #d84324;
        }

        .btn-warning {
            background-color: #ffc107;
            color: black;
        }

        .table th {
            background-color: #ee4d2d;
            color: white;
            text-align: center;
            vertical-align: middle;
        }

        .table td {
            vertical-align: middle;
            text-align: center;
        }

        .form-control:focus, .form-select:focus {
            border-color: #ee4d2d;
            box-shadow: 0 0 0 0.2rem rgba(238, 77, 45, 0.25);
        }

        .modal-header {
            background-color: #f8f9fa;
            border-bottom: 2px solid #ee4d2d;
        }

        .modal-footer {
            border-top: 1px solid #dee2e6;
        }

        .table-responsive {
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            border-radius: 10px;
            overflow: hidden;
        }
    </style>

    <div class="container mt-4">
        {{-- Back to Admin Dashboard --}}

        <h1 class="mb-4">Manage Products</h1>

        {{-- Create Product Button --}}
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createProductModal">
            + Create Product
        </button>

        {{-- Product Table --}}
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead>
                    <tr>
                        <th>Name</th>
                       
                        <th>Vendor</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            
                            <td>{{ $product->vendor->name ?? 'N/A' }}</td>
                            <td>₱{{ number_format($product->price, 2) }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>{{ $product->created_at ? $product->created_at->diffForHumans() : 'N/A' }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning mb-1" data-bs-toggle="modal" data-bs-target="#editProductModal{{ $product->id }}">
                                    Edit
                                </button>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>

                        {{-- Edit Product Modal --}}
                        <div class="modal fade" id="editProductModal{{ $product->id }}" tabindex="-1" aria-labelledby="editProductModalLabel{{ $product->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Product</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="text" name="name" class="form-control mb-2" value="{{ $product->name }}" placeholder="Product Name" required>
                                            <textarea name="description" class="form-control mb-2" placeholder="Description">{{ $product->description }}</textarea>
                                            <input type="number" name="price" class="form-control mb-2" value="{{ $product->price }}" placeholder="Price" required>
                                            <input type="number" name="stock" class="form-control mb-2" value="{{ $product->stock }}" placeholder="Stock" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-success">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
            <div class="container mt-4">
    <!-- Back Button (Right-Aligned) -->
<a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mb-3 float-end">
     Back
</a>

        </div>
    </div>

    {{-- Create Product Modal --}}
    <div class="modal fade" id="createProductModal" tabindex="-1" aria-labelledby="createProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.products.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="name" class="form-control mb-2" placeholder="Product Name" required>
                        <textarea name="description" class="form-control mb-2" placeholder="Description"></textarea>
                        <input type="number" name="price" class="form-control mb-2" placeholder="Price" required>
                        <input type="number" name="stock" class="form-control mb-2" placeholder="Stock" required>
                        <select name="vendor_id" class="form-control mb-2" required>
                            <option value="" disabled selected>Select Vendor</option>
                            @foreach ($vendors as $vendor)
                                <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
