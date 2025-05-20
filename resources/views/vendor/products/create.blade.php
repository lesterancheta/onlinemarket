@extends('layouts.app')

@section('title', 'Add New Product')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-primary" style="color: #f53d2d;">Add New Product</h1>
        <a href="{{ route('vendor.products') }}" class="btn btn-outline-secondary">← Back to Product List</a>
    </div>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
            <form action="{{ route('vendor.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" id="name" name="name" class="form-control rounded-3" required>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price (₱)</label>
                    <input type="number" id="price" name="price" step="0.01" class="form-control rounded-3" required>
                </div>

                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" id="stock" name="stock" class="form-control rounded-3" required min="0">
                </div>

                <div class="mb-4">
                    <label for="image" class="form-label">Product Image</label>
                    <input type="file" id="image" name="image" accept="image/*" class="form-control rounded-3">
                </div>

                <button type="submit" class="btn w-100 text-white fw-semibold rounded-3" style="background-color: #f53d2d;">
                    ➕ Add Product
                </button>
            </form>
        </div>
    </div>

    <!-- Logout Button -->
    <div class="text-end mt-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-outline-danger rounded-3">Logout</button>
        </form>
    </div>
</div>
@endsection
