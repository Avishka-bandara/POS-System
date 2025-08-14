<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\MeasurementUnit;

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
        $measurementUnits = MeasurementUnit::select('id', 'name', 'symbol')->get();
        return view('products.add_product', ['categories' => $categories, 'measurementUnits' => $measurementUnits]);
    }

    public function addCategory()
    {
        return view('products.add_catergory');
    }


    public function addCategorySave(Request $request)
    {

        //    $validator = Validator::make($request->all(), [
        //         'categoryName' => 'required|string|max:255',
        //     ]);
        //     if ($validator->fails()) {
        //         return response()->json(['error' => $validator->errors()], 422);
        //     }

        $category = Category::where('name', $request->input('categoryName'))->first();
        if ($category) {
            return response()->json(['error' => 'Category already exists.'], 422);
        }

        Category::create([
            'name' => $request->input('categoryName'),
        ]);
        return response()->json(['success' => 'Category added successfully.'], 200);
    }

    public function fetchCategories()
    {
        $categories = Category::select('id', 'name')->get();
        return response()->json(['data' => $categories]);
    }


    public function updateCategory(Request $request)
    {
        $category = Category::find($request->input('id'));
        if (!$category) {
            return response()->json(['error' => 'Category not found.'], 404);
        }

        $category = Category::where('name', $request->input('CategoryName'))->first();
        if ($category) {
            return response()->json(['error' => 'Category already exists.'], 422);
        }

        $category->name = $request->input('CategoryName');
        $category->save();
        return response()->json(['success' => 'Category updated successfully.'], 200);
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


    public function updateProduct(Request $request)
    {
        // dd($id);
        $productId = $request->input('id');
        $product = Product::find($productId);
        if (!$product) {
            return response()->json(['error' => 'Product not found.'], 404);
        }
        $product->update([
            'quantity' => $request->input('Quantity'),
            'exp_date' => $request->input('ExpireDate'),
            'price'    => $request->input('Price'),
        ]);

        return redirect()->back()->with('success', 'Product updated successfully.');
    }


    public function productSettingindex()
    {
        $products = Product::with('category')
            ->where('action', 0)
            ->get();
        return view('profile.product_setting', ['products' => $products]);
    }
    public function activateProduct($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['error' => 'Product not found.'], 404);
        }

        $product->action = 1; // Assuming 1 means active
        $product->save();

        return response()->json(['success' => 'Product activated successfully.']);
    }
}
