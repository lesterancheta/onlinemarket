<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('shop.index', compact('products'));
    }

   public function order(Request $request, Product $product)
{
    // Optional: validate quantity or image
    $validated = $request->validate([
        'quantity' => 'required|integer|min:1|max:' . $product->stock,
        'image' => 'nullable|image|max:2048', // Only needed if image upload is expected
    ]);

    // Optional: Image upload logic
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('products', 'public');
        $product->picture = $imagePath;
        $product->save(); // Save new image if applicable
    }

    // You can also add order saving logic here (like creating an Order model)

    return redirect()->back()->with('success', 'Order placed!');
}

}
