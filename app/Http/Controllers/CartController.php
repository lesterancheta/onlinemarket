<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    
    public function index()
{
    $cartItems = CartItem::with('product')
        ->where('user_id', Auth::id())
        ->get()
        ->filter(fn($item) => $item->product !== null);

    $totalPrice = $cartItems->sum(function ($item) {
        return $item->product->price * $item->quantity;
    });

    return view('customer.cart.index', compact('cartItems', 'totalPrice'));
}


   public function add(Request $request, $productId)
{
    $existingItem = CartItem::where('user_id', auth()->id())
                            ->where('product_id', $productId)
                            ->first();

    if ($existingItem) {
        $existingItem->quantity += 1; // or use $request->quantity if available
        $existingItem->save();
    } else {
        CartItem::create([
            'user_id' => auth()->id(),
            'product_id' => $productId,
            'quantity' => 1,
        ]);
    }

    return back()->with('success', 'Item added to cart!');
}


    public function update(Request $request, $id)
{
    $request->validate([
        'quantity' => 'required|integer|min:1'
    ]);

    $cartItem = CartItem::where('id', $id)
        ->where('user_id', Auth::id())
        ->firstOrFail();

    $cartItem->quantity = $request->input('quantity');
    $cartItem->save();

    return back()->with('success', 'Cart updated.');
}

    public function remove($id)
    {
        CartItem::where('id', $id)
            ->where('user_id', Auth::id())
            ->delete();

        return back()->with('success', 'Item removed.');
    }

    public function checkout()
    {
        // You can implement order creation logic here.
        CartItem::where('user_id', Auth::id())->delete();

        return redirect()->route('shop.index')->with('success', 'Checkout complete!');
    }
    public function up()
{
    Schema::table('cart_items', function (Blueprint $table) {
        $table->foreignId('user_id')->after('id')->constrained()->onDelete('cascade');
        
    });
}

public function down()
{
    Schema::table('cart_items', function (Blueprint $table) {
        $table->dropForeign(['user_id']);
        $table->dropColumn('user_id');
    });
}

}
