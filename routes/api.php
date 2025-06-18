<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::post ('/edit-product',[ProductController::class,'editProducts'])->name('edit.product');
Route::post('/add-category-save', [ProductController::class, 'addCategorySave'])->name('add.category.save');
Route::get('/fetch-categories', [ProductController::class, 'fetchCategories'])->name('fetch.categories');
