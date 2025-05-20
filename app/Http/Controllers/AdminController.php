<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Count totals
        $vendors = User::where('role', 'vendor')->count();
        $customers = User::where('role', 'customer')->count();
        $products = Product::count();
        $orders = Order::count();

        // Latest 5 orders with user info
        $recentOrders = Order::with('user')->latest()->take(5)->get();

        // Latest 5 vendors
        $vendorList = User::where('role', 'vendor')->latest()->take(5)->get();

        // Latest 5 products
        $productList = Product::latest()->take(5)->get();

        // Return view from resources/views/admin/dashboard.blade.php
        return view('admin.admin-dashboard', compact(
            'vendors',
            'customers',
            'products',
            'orders',
            'recentOrders',
            'vendorList',
            'productList'
        ));
    }

    
    public function viewVendors()
    {
        $vendors = User::where('role', 'vendor')->latest()->paginate(10);
        return view('admin.vendors', compact('vendors'));
    }
public function viewCustomers()
{
    $customers = User::where('role', 'customer')->paginate(10); // Or whatever field defines customers
    return view('admin.customers', compact('customers'));
    }

      public function viewOrders()
    {
        $orders = Order::with('user')->latest()->paginate(10); // eager load user
        return view('admin.orders', compact('orders'));
    }
        public function manageProducts()
{
    $products = Product::with('vendor')->latest()->get();
    $vendors = User::where('role', 'vendor')->get(); // ✅ add this line

    return view('admin.manage-products', compact('products', 'vendors'));
}
public function viewDeliveries()
{
    $deliveries = Delivery::with(['order', 'user'])->latest()->paginate(10); // Adjust relationships as needed
    return view('admin.deliveries', compact('deliveries'));
}

}
