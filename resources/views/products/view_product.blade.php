@extends('layouts.layouts')

@section('title', 'View Product')

@section('content')

@vite([
    'resources/js/product/edit-product.js',
    'resources/css/custom.scss',
])
    <div class="container pt-4 col-lg-10 col-md-10 col-sm-6">
        <div class="row mb-4 pt-4">
            <div class="col-lg-12 col-md-10 col-sm-6">
                <h1 class="h3">View Product</h1>
            </div>
        </div>
        <div class="row justify-content-center pb-5">
            <div class="col-lg-12 col-md-10 col-sm-6">
                <div class="card shadow">
                    <div class="card-body">

                        <form action="{{ url('/api/edit-product') }}" method="POST" id="searchProductForm">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="productName" class="form-label">Product Name</label>
                                    <input type="text" class="form-control" list="productList" id="productName" placeholder="Type to search..." name="productName">
                                    <datalist id="productList">
                                        {{-- @foreach ($products as $product)
                                            <option value="{{ $product->name }} ({{ $product->brand }}) - ${{ number_format($product->price, 2) }}">
                                        @endforeach --}}
                                    </datalist>
                                </div>

                                <div class="col-md-6">
                                    <label for="brand" class="form-label">Brand</label>
                                    <input type="text" class="form-control @error('brand') is-invalid @enderror"
                                        id="brand" name="brand"  required>
                                </div>
                            </div>
                            {{-- <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="product" class="form-label">Select Product</label>
                                    <input class="form-control" list="productList" id="product" name="product"
                                        placeholder="Type to search..." style="box-shadow: none;">
                                    <datalist id="productList">
                                        {{-- @foreach ($products as $product)
                                            <option value="{{ $product->name }} ({{ $product->brand }}) - ${{ number_format($product->price, 2) }}">
                                        @endforeach 
                                    </datalist>
                                </div>

                            </div> --}}



                            <div class="text-start mt-5">
                                <button type="submit" class="btn btn-success col-3">
                                    <i class="fas fa-plus-circle me-1"></i> Search
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Products</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Brand</th>
                                <th>Available quantity</th>
                                <th>Expire Date</th>
                                <th>Sale Quantity</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>2011/04/25</td>
                                <td>$320,800</td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-sm">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection
