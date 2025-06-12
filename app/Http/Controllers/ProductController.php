<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Logic to retrieve and display products
        return view('products.view_product');
    }

    public function addProduct()
    {
        // Logic to show the form for adding a new product
        return view('products.add_product');
    }
}
