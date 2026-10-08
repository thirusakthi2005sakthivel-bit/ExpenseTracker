<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\StockInController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StockOutAController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;



Route::get('/', [AuthController::class,'login'])->name('login');

Route::post('/login', [AuthController::class,'loginStore'])
    ->name('login.store');

Route::get('/register', [AuthController::class,'register'])
    ->name('register');

Route::post('/register', [AuthController::class,'registerStore'])
    ->name('register.store');

Route::post('/logout', [AuthController::class,'logout'])
    ->name('logout');

    Route::post('/orders', [OrderController::class, 'store'])
    ->name('orders.store');
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/dashboard', [dashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/low-stock-notification', [dashboardController::class, 'lowStockNotification'])
        ->name('lowstock.notification');

    // Products
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/product/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.delete');
    Route::get('/product-search', [ProductController::class, 'search'])->name('product.search');

    // Categories
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/categories/{id}/update', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/categories/{id}/delete', [CategoryController::class, 'destroy'])->name('category.delete');
    Route::get('/category/search', [CategoryController::class, 'search'])->name('category.search');

    // Suppliers
    Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier.index');
    Route::get('/supplier/create', [SupplierController::class, 'create'])->name('supplier.create');
    Route::post('/supplier/store', [SupplierController::class, 'store'])->name('supplier.store');
    Route::get('/supplier/{id}/edit', [SupplierController::class, 'edit'])->name('supplier.edit');
    Route::put('/supplier/{id}/update', [SupplierController::class, 'update'])->name('supplier.update');
    Route::delete('/supplier/{id}/delete', [SupplierController::class, 'destroy'])->name('supplier.delete');
    Route::get('/supplier/search', [SupplierController::class, 'search'])->name('supplier.search');

    // Stock In
    Route::get('/stockin', [StockInController::class, 'index'])->name('stockin.index');
    Route::get('/stockin/create', [StockInController::class, 'create'])->name('stockin.create');
    Route::post('/stockin/store', [StockInController::class, 'store'])->name('stockin.store');
    Route::get('/stockin/{id}/edit', [StockInController::class, 'edit'])->name('stockin.edit');
    Route::put('/stockin/{id}/update', [StockInController::class, 'update'])->name('stockin.update');
    Route::delete('/stockin/{id}/delete', [StockInController::class, 'destroy'])->name('stockin.delete');
    Route::get('/product/details/{id}', [StockInController::class, 'getProductDetails'])->name('product.details');

    // Stock Out
    Route::get('/stockout', [StockOutAController::class, 'index'])->name('stockout.index');
    Route::get('/stockout/create', [StockOutAController::class, 'create'])->name('stockout.create');
    Route::post('/stockout', [StockOutAController::class, 'store'])->name('stockout.store');
    Route::get('/stockout/{stockOutA}/edit', [StockOutAController::class, 'edit'])->name('stockout.edit');
    Route::put('/stockout/{stockOutA}', [StockOutAController::class, 'update'])->name('stockout.update');
    Route::delete('/stockout/{stockOutA}', [StockOutAController::class, 'destroy'])->name('stockout.destroy');

    // Orders (Admin only)
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::patch('/orders/{order}/accept', [OrderController::class, 'accept'])->name('orders.accept');

    // Inventory
    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');

    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/export', [ReportController::class, 'exportExcel'])->name('reports.export');
   
});




// Customer Home
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

      Route::post('/orders/store', [OrderController::class, 'store'])
    ->name('orders.store');

    // cartcontroller

     Route::post('/cart/add',[CartController::class,'store'])
        ->name('cart.store');

    Route::get('/cart',[CartController::class,'index'])
        ->name('cart.index');

    Route::post('/cart/update/{cart}',
        [CartController::class,'update'])
        ->name('cart.update');

    Route::delete('/cart/delete/{cart}',
        [CartController::class,'destroy'])
        ->name('cart.destroy');

      Route::get('/checkout',[CheckoutController::class,'index'])
        ->name('checkout.index');

    Route::post('/checkout/place-order',[CheckoutController::class,'placeOrder'])
        ->name('checkout.placeOrder');
});






 