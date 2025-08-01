<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::get ('/edit-product',[ProductController::class,'editProducts'])->name('edit.product');
Route::post('/add-category-save', [ProductController::class, 'addCategorySave'])->name('add.category.save');
Route::get('/fetch-categories', [ProductController::class, 'fetchCategories'])->name('fetch.categories');
Route::post('/update-category', [ProductController::class, 'updateCategory'])->name('update.category');
Route::post('/delete-category/{id}', [ProductController::class, 'deleteCategory'])->name('delete.category');
Route::post('/product/update', [ProductController::class, 'updateProduct'])->name('product.update');



Route::Post('/check-quantity', [ProductController::class, 'checkQuantity'])->name('check.quantity');




// Role management routes
Route::post('/roles', [RoleController::class, 'store'])->name('roles.save');
Route::get('/fetch-roles', [RoleController::class, 'fetchRoles'])->name('roles.fetchRoles');
Route::get('/fetch-permissions/{roleID}', [RolePermissionController::class, 'fetchPermissions'])->name('roles.fetchPermissions');
Route::post('/roles/delete-roles/{roleID}', [RolePermissionController::class, 'deleteRole'])->name('roles.deleteRole');
Route::post('/store-roles-permissions', [RolePermissionController::class, 'RolesPermissions'])->name('rolesPermission.save');


// user roles
Route::get('/fetch-users', [UserController::class, 'show'])->name('fetch.users');
Route::get('/get-users/{id}', [UserController::class, 'getUser'])->name('get.user');
Route::post('/delete-users/{id}', [UserController::class, 'destroy'])->name('delete.user');

