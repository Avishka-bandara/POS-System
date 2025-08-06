<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductSales;
use App\Models\Sales;

class SalesController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('sales.sales')->with('products', $products);
    }

    public function store(Request $request)
    {   
        // dd($request->all());
        $invoiceNumber = $this->generateInvoiceNumber();
        $items = $request->input('items');

        if (!$items || !is_array($items)) {
            return response()->json(['success' => false, 'message' => 'Invalid items.']);
        }

        $sale = Sales::create([
            'grand_total' => array_sum(array_column($items, 'total')),
            'invoice_number' => $invoiceNumber,
            // 'customer_id' => $request->input('customer_id', null),
        ]);

        foreach ($items as $item) {
            $product = Product::find($item['id']);

            if (!$product || $product->quantity < $item['quantity']) {
                return response()->json(['success' => false, 'message' => 'Stock issue']);
            }

            ProductSales::create([
                'sale_id' => $sale->id,
                'product_id' => $item['id'],
                'sale_quantity' => $item['quantity'],
                'sale_price' => $item['price'],
            ]);

            $product->quantity -= $item['quantity'];
            $product->save();
        }

        return response()->json(['success' => true, 'sale_id' => $sale->id, 'redirect' => route('sales.invoice', $sale->id)]);
    }

    public function invoice($id)
    {
        $sale = Sales::with(['items.product'])->findOrFail($id);
        return view('sales.invoice', compact('sale'));
    }

    public function generateInvoiceNumber()
    {
            $latestSale = Sales::latest()->first();

    if ($latestSale && $latestSale->invoice_number) {
        // Remove the prefix and convert to integer
        $lastNumber = (int) str_replace('INV-', '', $latestSale->invoice_number);
    } else {
        $lastNumber = 0;
    }

    // Increment and return formatted number
    return 'INV-' . str_pad($lastNumber + 1, 6, '0', STR_PAD_LEFT);
    }
}
