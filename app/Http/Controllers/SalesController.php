<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class SalesController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('sales.sales')->with('products', $products);
    }
}
