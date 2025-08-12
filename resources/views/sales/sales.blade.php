@extends('layouts.layouts')

@section('title', 'POS')


@section('content')

@vite(['resources/css/custom.scss'])
@vite(['resources/js/sales/sales.js', 'resources/js/app.js'])

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container pt-4 col-lg-10 col-md-10 col-sm-6">
    <h4 class="mb-4 text-gray-800">New Bill</h4>

    <!-- Product Selection Row -->
    <div class="row g-3 align-items-end px-3 mb-5" style="display: flex; justify-content: space-between;">
        @foreach ($products as $product)
        <div class="col-md-4">
            <label for="productItem" class="form-label">Select Product</label>
            <select class="form-control" id="productItem" name="product" style="box-shadow: none;">
                <option value="" selected disabled>Select a product</option>
                <option value="{{ $product->id }}" data-stock="{{ $product->quantity }}">
                    {{ $product->name }} - {{ $product->category->name }} - LKR({{ $product->price }})
                </option>
            </select>
        </div>

        <div class="col-md-3">
            <label for="quantity" class="form-label">Qty</label>
            <input type="number" class="form-control" id="quantity" name="quantity"
                max="{{ $product->quantity }}" min="1" required>
        </div>
        @endforeach

        <div class="col-md-2">
            <button class="btn btn-success w-100" id="addProductBtn" type="button">Add</button>
        </div>
    </div>

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
                            <th class="text-end bill-heading">Grand Total:</th>
                            <th id="grandTotal" class="bill-heading">LKR 0.00</th>

                            <th class="text-end bill-heading payment">Payment:</th>
                            <th class="bill-heading payment"><input id="payment" type="text" placeholder="LKR 0.00"
                                    required></th>
                            <th class="text-end bill-heading balance">Balance:</th>
                            <th id="balance" class="bill-heading balance">LKR 0.00</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="text-end mt-3">
        <button type="button" class="btn btn-primary" id="finalizeSale">
            <i class="fas fa-check-circle me-1"></i> Process Sale
        </button>
    </div>

</div>


@endsection