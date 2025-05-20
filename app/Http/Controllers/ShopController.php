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
        // You can add order handling logic here.
        return redirect()->back()->with('success', 'Order placed!');
        if ($request->hasFile('image')) {
    $imagePath = $request->file('image')->store('products', 'public');
    $product->picture = $imagePath;
}
    }
    
}
