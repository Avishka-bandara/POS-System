@extends('layouts.layouts')

@section('title', 'View Product')

@section('content')

@vite([
    'resources/js/product/edit-product.js',
    'resources/css/custom.scss',
    'resources/js/app.js'
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

                        <form action="{{ url('/api/edit-product') }}" method="POST" id="editProductForm">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="productName" class="form-label">Product Name</label>
                                    <select type="text" class="form-control" id="productName" placeholder="Type to search..." name="productName">
                                        <option  disabled selected>Select Product</option>
                                        @foreach ($uniqueProductNames as $product)
                                            <option value="{{ $product->name }}">
                                                {{ $product->name }} -  {{ $product->category->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="brandName" class="form-label">Brand Name</label>
                                    <select type="text" class="form-control" id="brandName" placeholder="Type to search..." name="brandName">
                                        <option  disabled selected>Brand</option>
                                        @foreach ($uniqueBrandNames as $BrandName)
                                            <option value="{{ $BrandName->brand }}">
                                                {{ $BrandName->brand }}  
                                            </option>
                                        @endforeach
                                    </select>
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
                                <th>#</th>
                                <th>Name</th>
                                <th>Brand</th>
                                <th>quantity</th>
                                <th>Expire Date</th>
                                <th>Price</th>
                                <th>Catergory</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection




<html lang="en">
<head>
    <meta charset="UTF-8">
    @vite(['resources/js/app.js', 'resources/css/custom.scss'])
</head>

<body>

    <!-- Offcanvas Drawer -->
    <div id="editDrawer" class="offcanvas offcanvas-end"  aria-labelledby="editDrawerLabel">
        <div class="offcanvas-header">
            <h5 id="editDrawerLabel">Edit Category</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <form id="editCategoryForm" method="POST" action="#">
                @csrf
                {{-- <input type="hidden" name="id" id="CategoryId">
                <div class="mb-3">
                    <label for="CategoryName" class="form-label">Category Name</label>
                    <input type="text" class="form-control" id="CategoryName" name="CategoryName" required>
                </div>
                <button type="submit" class="btn btn-success" data-bs-dismiss="offcanvas" aria-label="Close">Update</button> --}}
            </form>
        </div>
    </div>

    
</body>

</html>

