<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkoutSingle(Request $request)
{
    $item = CartItem::findOrFail($request->selected_item_id);

    // Proceed with checkout for $item
    return view('checkout.single', compact('item'));
}

}
