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
        $products = Product::with('category')->get();

        // Get only distinct product names
        $uniqueProductNames = Product::select('name', 'category_id')
            ->groupBy('name', 'category_id')
            ->get();

        // Get only distinct brand names
        $uniqueBrandNames = Product::select('brand')->distinct()->get();

        return view('products.view_product', [
            'products' => $products,
            'uniqueProductNames' => $uniqueProductNames,
            'uniqueBrandNames' => $uniqueBrandNames,
        ]);
    }

    public function addProduct()
    {
        $categories = Category::select('id', 'name')->get();
        return view ('products.add_product', ['categories' => $categories]);
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
            'category_id' => $request->input('category_id'),
        ]);

        return response()->json(['success' => 'Product added successfully.']);
    }


    public function editProducts(Request $request)
    {
        $productName = $request->input('productName');
        $brand = $request->input('brandName');
        
        $productDetail = Product::with('category')
            ->where('name', 'like', '%' . $productName . '%')
            ->where('brand', 'like', '%' . $brand . '%')
            ->get();


        return response()->json([
            'message' => 'Search completed successfully.',
            'data' => $productDetail 
        ]);
    }
}
