@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Your Shopping Cart</h2>

    @if($cartItems->count())
        <form method="POST" action="{{ route('checkout.single') }}">
            @csrf
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price (each)</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $item)
                       <tr>
    <td>
        <input type="radio" name="selected_item_id" value="{{ $item->id }}" required>
    </td>
    <td>{{ $item->product->name }}</td>
    <td>
        <form method="POST" action="{{ route('cart.update', $item->id) }}">
            @csrf
            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" style="width: 60px;">
            <button type="submit" class="btn btn-sm btn-primary">Update</button>
        </form>
    </td>
    <td>₱{{ number_format($item->product->price, 2) }}</td>
    <td>₱{{ number_format($item->product->price * $item->quantity, 2) }}</td>
    <td>
                                <!-- Remove Button with Modal -->
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#removeModal{{ $item->id }}" type="button">
                                    Remove
                                </button>

                                <!-- Remove Confirmation Modal -->
                                <div class="modal fade" id="removeModal{{ $item->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Remove Item</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to remove <strong>{{ $item->product->name }}</strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <form method="POST" action="{{ route('cart.remove', $item->id) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Yes, Remove</button>
                                                </form>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Checkout Button (opens modal) -->
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#checkoutModal">
                Proceed to Checkout
            </button>

            <!-- Modal: Confirm Single Item Checkout -->
            <div class="modal fade" id="checkoutModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Confirm Checkout</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to checkout the selected item?
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Yes, Proceed</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @else
        <p>Your cart is empty.</p>
        <a href="{{ url('/') }}" class="btn btn-primary">Continue Shopping</a>
    @endif

    <!-- Back Button -->
    <a href="{{ route('shop.index') }}" class="btn btn-secondary mt-3 float-end">Back</a>
</div>
@endsection
