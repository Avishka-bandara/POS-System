<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::get ('/edit-product',[ProductController::class,'editProducts'])->name('edit.product');
Route::post('/add-category-save', [ProductController::class, 'addCategorySave'])->name('add.category.save');
Route::get('/fetch-categories', [ProductController::class, 'fetchCategories'])->name('fetch.categories');
Route::post('/update-category', [ProductController::class, 'updateCategory'])->name('update.category');
Route::post('/delete-category/{id}', [ProductController::class, 'deleteCategory'])->name('delete.category');



Route::Post('/check-quantity', [ProductController::class, 'checkQuantity'])->name('check.quantity');
