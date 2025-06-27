@extends('layouts.layouts')

@section('title', 'POS')


@section('content')

@vite([ 'resources/css/custom.scss'])
@vite(['resources/js/sales/sales.js', 'resources/js/app.js'])


<div class="container pt-4 col-lg-10 col-md-10 col-sm-6">
    <h4 class="mb-4">New Bill</h4>

    <!-- Product Selection Row -->
    <form method="POST" id="productForm">
        <div class="row g-3 align-items-end px-3 mb-5" style="display: flex; justify-content: space-between;">
            <div class="col-md-4">
                <label for="productItem" class="form-label">Select Product</label>
                <select class="form-control" id="productItem" name="product" style="box-shadow: none;">
                    <option value="" selected disabled>Select a product</option>
                    @foreach ($products as $product)
                    <option value="{{ $product->id }}"
                        data-stock="{{ $product->quantity }}">
                        {{ $product->name }} - {{ $product->category->name }} - LKR({{ $product->price }})
                    </option>
                    @endforeach
                </select>

            </div>

            <div class="col-md-3">
                <label for="quantity" class="form-label">Qty</label>
                <input type="number" class="form-control" id="quantity" name="quantity" max="{{ $product->quantity }}" min="1" required>
            </div>

            <div class="col-md-2">
                <button class="btn btn-success w-100" type="submit">Add</button>
            </div>
        </div>
    </form>
    <!-- Bill Table -->
    <div class="card shadow mb-4 mt-3">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="billTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Price ($)</th>
                            <th>Total ($)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="billBody">

                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <th colspan="4" class="text-end">Grand Total:</th>
                            <th id="grandTotal">LKR 0.00</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- Print Button -->
    <div class="text-end mt-3">
        <button class="btn btn-primary" id="printBill">
            <i class="fas fa-print me-1"></i> Print Bill
        </button>
    </div>
    
</div>


@endsection