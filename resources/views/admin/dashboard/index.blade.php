@extends('admin.layout.app')

@section('title','Dashboard')

@section('content')


<style>
    /* Dashboard Cards Hover */

.stat-card{
    transition: all .25s ease;
    cursor: pointer;
}

.stat-card:hover{
    transform: translateY(-8px);
    box-shadow: 0 18px 35px rgba(0,0,0,.08);
    border-color: #ec1561;
      
}

.stat-card:hover .stat-icon{
    transform: scale(1.12) rotate(8deg);
}

.stat-icon{
    transition: all .25s ease;
}

.stat-card h3{
    transition: color .25s ease;
}

.stat-card:hover h3{
    color: var(--pink);
}

.stat-card:hover .stat-link{
    
    color: var(--orange);
}
</style>

<div class="welcome-text">
    <h4 class="fw-bold mb-1">Welcome Back 👋</h4>
    <p class="text-muted mb-0">
        Here's what's happening in your inventory today.
    </p>
</div>

<div class="row g-3">

    <!-- Total Products -->
    <div class="col-lg-3 col-md-6">
        <div class="card-soft stat-card">
            <div class="stat-icon" style="background:var(--blue-light);color:var(--blue);">
                <i class="bi bi-box-seam"></i>
            </div>
            <h3>{{ $totalProducts }}</h3>
            <p>Total Products</p>
        </div>
    </div>

    <!-- Categories -->
    <div class="col-lg-3 col-md-6">
        <div class="card-soft stat-card">
            <div class="stat-icon" style="background:var(--purple-light);color:var(--purple);">
                <i class="bi bi-grid"></i>
            </div>
            <h3>{{ $totalCategories }}</h3>
            <p>Categories</p>
        </div>
    </div>

    <!-- Suppliers -->
    <div class="col-lg-3 col-md-6">
        <div class="card-soft stat-card">
            <div class="stat-icon" style="background:var(--orange);color:#fff;">
                <i class="bi bi-truck"></i>
            </div>
            <h3>{{ $totalSuppliers }}</h3>
            <p>Suppliers</p>
        </div>
    </div>

    <!-- Orders -->
    <div class="col-lg-3 col-md-6">
        <div class="card-soft stat-card">
            <div class="stat-icon" style="background:var(--pink-light);color:var(--pink);">
                <i class="bi bi-cart-check"></i>
            </div>
            <h3>{{ $totalOrders }}</h3>
            <p>Total Orders</p>
        </div>
    </div>

    <!-- Stock In -->
    <div class="col-lg-3 col-md-6">
        <div class="card-soft stat-card">
            <div class="stat-icon" style="background:var(--green-light);color:var(--green);">
                <i class="bi bi-arrow-down-circle"></i>
            </div>
            <h3>{{ $totalStockIn }}</h3>
            <p>Stock In</p>
        </div>
    </div>

    <!-- Stock Out -->
    <div class="col-lg-3 col-md-6">
        <div class="card-soft stat-card">
            <div class="stat-icon" style="background:var(--red-light);color:var(--red);">
                <i class="bi bi-arrow-up-circle"></i>
            </div>
            <h3>{{ $totalStockOut }}</h3>
            <p>Stock Out</p>
        </div>
    </div>

    <!-- Low Stock -->
    <div class="col-lg-3 col-md-6">
        <div class="card-soft stat-card">
            <div class="stat-icon" style="background:var(--yellow-light);color:var(--yellow);">
                <i class="bi bi-exclamation-triangle"></i>
            </div>
            <h3>{{ $lowStock }}</h3>
            <p>Low Stock</p>
        </div>
    </div>

    <!-- Out Of Stock -->
    <div class="col-lg-3 col-md-6">
        <div class="card-soft stat-card">
            <div class="stat-icon" style="background:var(--red-light);color:var(--red);">
                <i class="bi bi-x-circle"></i>
            </div>
            <h3>{{ $outStock }}</h3>
            <p>Out Of Stock</p>
        </div>
    </div>

</div>

<!-- Recent Orders -->
<div class="card-soft mt-4">

    <div class="table-card-header">
        <h6>Recent Orders</h6>
    </div>

    <div class="table-responsive">

        <table class="table ims-table">

            <thead>
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Date</th>
                </tr>
            </thead>

            <tbody>

            @forelse($recentOrders as $order)

                <tr>
                    <td>{{ $loop->iteration }}</td>
                   
                    <td>
                        {{ $order->product->productname ?? '-' }}
                    </td>

                    <td>{{ $order->customer_name }}</td>
                    <td>₹{{ number_format($order->total,2) }}</td>
                    <td>{{ $order->created_at->format('d-m-Y') }}</td>
                </tr>

            @empty

                <tr>
                    <td colspan="5" class="text-center">
                        No Orders Found
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

<!-- Bottom Tables -->

<div class="row mt-4">

    <!-- Low Stock -->

    <div class="col-lg-6">

        <div class="card-soft">

            <div class="table-card-header">
                <h6>Low Stock Products</h6>
            </div>

            <div class="table-responsive">

                <table class="table ims-table">

                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Stock</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($lowStockProducts as $product)

                        <tr>
                            <td>{{ $product->productname }}</td>
                            <td>
                                <span class="badge badge-low">
                                    {{ $product->stock }}
                                </span>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="2" class="text-center">
                                No Low Stock
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <!-- Recent Stock In -->

    <div class="col-lg-6">

        <div class="card-soft">

            <div class="table-card-header">
                <h6>Recent Stock In</h6>
            </div>

            <div class="table-responsive">

                <table class="table ims-table">

                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Date</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($recentStockIns as $stock)

                        <tr>
                            <td>{{ $stock->product->productname }}</td>
                            <td>{{ $stock->quantity }}</td>
                            <td>{{ \Carbon\Carbon::parse($stock->stock_in_date)->format('d-m-Y') }}</td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="3" class="text-center">
                                No Stock In Records
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection