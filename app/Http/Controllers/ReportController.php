<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\StockIn;
use App\Models\StockOutA;
use App\Models\Order;
use App\Models\Category;
use App\Models\Supplier;
use App\Exports\ReportsExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
  public function index(Request $request)
{
    $query = Product::with([
        'category',
        'supplier',
        'stockins' => function ($q) {
            $q->latest();
        }
    ]);

    // Search
    if ($request->filled('search')) {
        $query->where('productname', 'like', '%' . $request->search . '%');
    }

    // Category
    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    // Supplier
    if ($request->filled('supplier_id')) {
        $query->where('supplier_id', $request->supplier_id);
    }

    // Status
    if ($request->filled('status')) {

        if ($request->status == 'instock') {
            $query->where('stock', '>', 5);
        }

        elseif ($request->status == 'lowstock') {
            $query->whereBetween('stock', [1,5]);
        }

        elseif ($request->status == 'outstock') {
            $query->where('stock',0);
        }

    }

    $products = $query->latest()->get();

    if ($request->ajax()) {
        return view('admin.reports.table', compact('products'))->render();
    }

    $categories = Category::where('status','active')->get();
    $suppliers  = Supplier::where('status','active')->get();

    return view('admin.reports.index', compact(
        'products',
        'categories',
        'suppliers'
    ));
}

public function exportExcel(Request $request)
{
    return Excel::download(
        new ReportsExport(
            $request->search,
            $request->category_id,
            $request->supplier_id,
            $request->status
        ),
         'Inventory_Report.xlsx'
    );
}
}