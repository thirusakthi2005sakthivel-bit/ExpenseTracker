<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReportsExport implements FromCollection, WithHeadings
{
    protected $search;
    protected $category_id;
    protected $supplier_id;
    protected $status;

    public function __construct($search, $category_id, $supplier_id, $status)
    {
        $this->search = $search;
        $this->category_id = $category_id;
        $this->supplier_id = $supplier_id;
        $this->status = $status;
    }

    public function collection()
    {
        $query = Product::with([
            'category',
            'supplier',
            'stockins' => function ($q) {
                $q->latest();
            }
        ]);

        // Search
        if ($this->search) {
            $query->where('productname', 'like', '%' . $this->search . '%');
        }

        // Category
        if ($this->category_id) {
            $query->where('category_id', $this->category_id);
        }

        // Supplier
        if ($this->supplier_id) {
            $query->where('supplier_id', $this->supplier_id);
        }

        // Status
        if ($this->status == 'instock') {
            $query->where('stock', '>', 5);
        } elseif ($this->status == 'lowstock') {
            $query->whereBetween('stock', [1, 5]);
        } elseif ($this->status == 'outstock') {
            $query->where('stock', 0);
        }

        return $query->get()->map(function ($product) {

            $stockIn = $product->stockins->first();

            return [
                'Product'       => $product->productname,
                'Category'      => $product->category->name ?? '-',
                'Supplier'      => $product->supplier->supplier_name ?? '-',
                'Stock In Date' => $stockIn->stock_in_date ?? '-',
                'Invoice No'    => $stockIn->invoice_no ?? '-',
                'Current Stock' => $product->stock,
                'Buying Price'  => $product->purchase_price,
                'Selling Price' => $product->selling_price,
                'Status'        => $product->stock == 0
                    ? 'Out Of Stock'
                    : ($product->stock <= 5 ? 'Low Stock' : 'In Stock'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Product',
            'Category',
            'Supplier',
            'Stock In Date',
            'Invoice No',
            'Current Stock',
            'Buying Price',
            'Selling Price',
            'Status',
        ];
    }
}