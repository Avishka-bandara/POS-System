<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\RoleController;

Route::get('/', function () {
    return view('auth.login');
    // return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/role', [RoleController::class, 'index'])->name('profile.role');
});

require __DIR__.'/auth.php';



Route::get('/product/view-product',[ProductController::class, 'index'])->name('product.index');
Route::get('/product/add-product',[ProductController::class, 'addProduct'])->name('product.add_product');
Route::get('/product/add-catergory',[ProductController::class, 'addCategory'])->name('product.category');
Route::post('/product/add-product-save',[ProductController::class, 'addNewProductSave'])->name('product.add_new_product_save');

Route::post('/sales/submit', [App\Http\Controllers\SalesController::class, 'store'])->name('sales.store');






Route::get('POS/Sales', [SalesController::class, 'index'])->name('sales.index');
