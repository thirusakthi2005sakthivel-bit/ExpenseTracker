<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Order;
use App\Models\StockIn;
use App\Models\StockOutA;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function index()
    {
        // Summary Cards
        $totalProducts   = Product::count();
        $totalCategories = Category::count();
        $totalSuppliers  = Supplier::count();
        $totalOrders     = Order::count();

        // Stock Summary
        $totalStockIn  = StockIn::sum('quantity');
        $totalStockOut = StockOutA::sum('quantity');

        // Inventory Status
        $lowStock = Product::whereBetween('stock', [1, 5])->count();
        $outStock = Product::where('stock', 0)->count();

        // Recent Orders
       $recentOrders = Order::with('product')
    ->latest()
    ->take(5)
    ->get();

        // Recent Stock In
        $recentStockIns = StockIn::with('product', 'supplier')
            ->latest()
            ->take(5)
            ->get();

        // Low Stock Products
        $lowStockProducts = Product::with('category', 'supplier')
            ->whereBetween('stock', [1, 5])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard.index', compact(
            'totalProducts',
            'totalCategories',
            'totalSuppliers',
            'totalOrders',
            'totalStockIn',
            'totalStockOut',
            'lowStock',
            'outStock',
            'recentOrders',
            'recentStockIns',
            'lowStockProducts'
        ));
    }
}