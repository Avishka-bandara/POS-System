<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;

Route::get('/', function () {
    return view('auth.login');
    // return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// user routes


Route::group(['middleware' => ['role:admin']], function () {
    Route::post('/profile/users-save', [UserController::class, 'store'])->name('user.save');
    Route::get('/profile/role', [RoleController::class, 'index'])->name('profile.role');
    Route::post('/profile/roles-permissions-save', [RolePermissionController::class, 'RolesPermissions'])->name('profile.rolesave');
    Route::post('/profile/new-user',[UserController::class, 'create'])->name('profile.new_user');
});

// product routes
Route::group(['middleware' => ['role:admin|manager|cashier']], function () {
    Route::get('/product/add-catergory',[ProductController::class, 'addCategory'])->name('product.category');
    Route::get('/product/view-product',[ProductController::class, 'index'])->name('product.index');
    Route::get('/product/add-product',[ProductController::class, 'addProduct'])->name('product.add_product');
    Route::post('/product/add-product-save',[ProductController::class, 'addNewProductSave'])->name('product.add_new_product_save');

    // billing routes
    Route::post('/sales/submit', [SalesController::class, 'store'])->name('sales.store');
    Route::get('/invoice/{id}', [SalesController::class, 'invoice'])->name('sales.invoice');
    Route::get('POS/Sales', [SalesController::class, 'index'])->name('sales.index');

});