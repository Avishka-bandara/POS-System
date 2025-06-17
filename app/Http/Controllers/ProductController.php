<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product; 

class ProductController extends Controller
{
    public function index()
    {
        // Logic to retrieve and display products
        return view('products.view_product');
    }

    public function addProduct()
    {
        return view('products.add_product');
    }


    public function addNewProductSave(Request $request)
    {
    //    dd($request->all());
    $data = $request->all();
    $data = Product::create([
        'name' => $data['productName'],
        'brand' => $data['brand'],
        'size' => $data['size'],
        'quantity' => $data['quantity'],
        'exp_date' => $data['expiryDate'],
        'price' => $data['price'],
        'category' => $data['category'],
    ]);

    return redirect()->back()->with('success', 'Product added successfully.');
    }
}
