<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category; 

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

    public function addCategory(){
        return view('products.add_catergory');
    }


    public function addCategorySave(Request $request)
    {

       $validator = Validator::make($request->all(), [
            'categoryName' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        Category::create([
            'name' => $request->input('categoryName'),
        ]);
        return response()->json(['success' => 'Category added successfully.']);
    }

    public function fetchCategories(){
         $categories = Category::select('id', 'name')->get();
        return response()->json(['data' => $categories]);
    }

    public function updateCategory(Request $request)
    {
        $category = Category::find($request->input('id'));
        if (!$category) {
            return response()->json(['error' => 'Category not found.'], 404);
        }
        $category->name = $request->input('CategoryName');
        $category->save();
        return response()->json(['success' => 'Category updated successfully.']);
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['error' => 'Category not found.'], 404);
        }
        $category->delete();
        return response()->json(['success' => 'Category deleted successfully.']);
    }


    public function addNewProductSave(Request $request)
    {
    //    dd($request->all());
    
    Product::create([
        'name' => $request->input('productName'),
        'brand' => $request->input('brand'),
        'size' => $request->input('size'),
        'quantity' => $request->input('quantity'),
        'exp_date' => $request->input('expiryDate'),
        'price' => $request->input('price'),
        'category' => $request->input('category'),
    ]);

    return response()->json(['success' => 'Product added successfully.']);
    }


    public function editProducts(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'Search completed successfully.',
            'data' => $request->all()
        ]);
    }
}
