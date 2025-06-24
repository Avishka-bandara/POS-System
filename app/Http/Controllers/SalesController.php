<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index(){
        $products = \App\Models\Product::all();
        return view('sales.sales')->with('products', $products);
    }
}
