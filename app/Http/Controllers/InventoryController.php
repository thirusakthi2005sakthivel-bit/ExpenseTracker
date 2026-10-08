<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'supplier']);

        // Product Search
        if ($request->filled('search')) {
            $query->where('productname', 'like', '%' . $request->search . '%');
        }

        // Category Filter
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Stock Status Filter
        if ($request->filled('status')) {

            switch ($request->status) {

                case 'instock':
                    $query->where('stock', '>', 5);
                    break;

                case 'lowstock':
                    $query->whereBetween('stock', [1, 5]);
                    break;

                case 'outstock':
                    $query->where('stock', 0);
                    break;
            }
        }

        $products = $query->latest()->paginate(10);

        // AJAX Request
        if ($request->ajax()) {
            return view('admin.inventory.table', compact('products'))->render();
        }

        // Summary Cards
        $totalProducts = Product::count();

        $inStock = Product::where('stock', '>', 5)->count();

        $lowStock = Product::whereBetween('stock', [1, 5])->count();

        $outStock = Product::where('stock', 0)->count();

        // Inventory Value
        $inventoryValue = Product::selectRaw('SUM(stock * purchase_price) as total')
                                 ->value('total');

        $categories = Category::where('status', 'active')->get();

        return view('admin.inventory.index', compact(
            'products',
            'categories',
            'totalProducts',
            'inStock',
            'lowStock',
            'outStock',
            'inventoryValue'
        ));
    }
}