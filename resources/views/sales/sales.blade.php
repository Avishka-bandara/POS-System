@extends('layouts.layouts')

@section('title', 'Sales')


@section('content')

    @vite(['resources/css/sales.css', 'resources/css/custom.scss'])
    @vite(['resources/js/sales/sales.js'])


    <div class="container pt-4 col-lg-10 col-md-10 col-sm-6">
        <h4 class="mb-4">New Bill</h4>

        <!-- Product Selection Row -->
        <form action="#" method="POST" id="productForm">
        <div class="row g-3 align-items-end px-3" style="display: flex; justify-content: space-between;">
            <div class="col-md-4">
                <label for="productItem" class="form-label">Select Product</label>
                <input class="form-control" list="productList" id="productItem" name="product" placeholder="Type to search..." style="box-shadow: none;">
                <datalist id="productList">
                    {{-- @foreach ($products as $product)
                        <option
                            value="{{ $product->name }} ({{ $product->brand }}) - ${{ number_format($product->price, 2) }}">
                    @endforeach --}}
                </datalist>
            </div>

            <div class="col-md-3">
                <label for="quantity" class="form-label">Qty</label>
                <input type="number" class="form-control" id="quantity" name="quantity" min="1" value="1">
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
                    <table class="table ">
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
                        <tbody>
                            <!-- Sample row (static) -->
                            <tr>
                                <td>1</td>
                                <td>Sample Product</td>
                                <td>2</td>
                                <td>10.00</td>
                                <td>20.00</td>
                                <td><button class="btn btn-sm btn-danger">X</button></td>
                            </tr>
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <th colspan="5" class="text-end">Grand Total:</th>
                                <th>$20.00</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <!-- Print Button -->
        <div class="text-end mt-3">
            <button class="btn btn-primary">
                <i class="fas fa-print me-1"></i> Print Bill
            </button>
        </div>
    </div>


@endsection
