<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\RoleController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/role', [RoleController::class, 'index'])->name('profile.role');
});

require __DIR__.'/auth.php';



Route::get('/product/view-product',[ProductController::class, 'index'])->name('product.index');
Route::get('/product/add-product',[ProductController::class, 'addProduct'])->name('product.add_product');







Route::get('POS/Sales', [SalesController::class, 'index'])->name('sales.index');
