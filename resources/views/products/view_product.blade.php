@extends('layouts.layouts')

@section('title', 'View Product')

@section('content')

@vite(['resources/js/product/edit-product.js', 'resources/css/custom.scss', 'resources/js/app.js'])
<div class="container pt-4 col-lg-10 col-md-10 col-sm-6">
    <div class="row mb-4 pt-4">
        <div class="col-lg-12 col-md-10 col-sm-6">
            <h1 class="h3 text-gray-800">View Product</h1>
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
                                <select class="form-control select2" id="productName" name="productName">
                                    <option disabled {{ request('name') ? '' : 'selected' }}>Select Product</option>
                                    @foreach ($uniqueProductNames as $product)
                                    <option value="{{ $product->name }}"
                                        {{ request('name') === $product->name ? 'selected' : '' }}>
                                        {{ $product->name }} - {{ $product->category->name }}
                                    </option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="col-md-6">
                                <label for="brandName" class="form-label">Brand Name</label>
                                <select type="text" class="form-control" id="brandName" name="brandName">
                                    <option disabled {{ request('brand') ? '' : 'selected' }}>Brand</option>
                                    @foreach ($uniqueBrandNames as $BrandName)
                                    <option value="{{ $BrandName->brand }}"
                                        {{ request('brand') === $BrandName->brand ? 'selected' : '' }}>
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
        <div class="table-responsive ">
            <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-right">
                        <th>#</th>
                        <th>Name</th>
                        <th>Brand</th>
                        <th>quantity</th>
                        <th>Size (g)</th>
                        <th>Expire Date</th>
                        <th>Price (LKR)</th>
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







<!-- Offcanvas Drawer -->
<div id="editDrawer" class="offcanvas offcanvas-end" aria-labelledby="editDrawerLabel">
    <div class="offcanvas-header">
        <h5 id="editDrawerLabel">Edit Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <form id="editCategoryForm" method="POST" action="{{ url('/api/product/update/') }}">
            @csrf
            <input type="hidden" name="id" id="CategoryId">
            <div class="mb-3">
                <label for="CategoryName" class="form-label">Name</label>
                <input type="text" class="form-control" id="CategoryName" name="CategoryName" disabled>
            </div>
            <div class="mb-3">
                <label for="BrandName" class="form-label">Brand Name</label>
                <input type="text" class="form-control" id="BrandName" name="BrandName" disabled>
            </div>
            <div class="mb-3">
                <label for="Quantity" class="form-label">Quantity</label>
                <input type="text" class="form-control" id="Quantity" name="Quantity" required>
            </div>
            <div class="mb-3">
                <label for="ExpireDate" class="form-label">Expire Date</label>
                <input type="date" class="form-control" id="ExpireDate" name="ExpireDate" required>
            </div>
            <div class="mb-3">
                <label for="Price" class="form-label">Price</label>
                <input type="text" class="form-control" id="Price" name="Price" required>
            </div>
            <div class="mb-3">
                <label for="Category" class="form-label">Category</label>
                <input type="text" class="form-control" id="Category" name="Category" disabled>
            </div>
            <button type="submit" class="btn btn-success" data-bs-dismiss="offcanvas"
                aria-label="Close">Update</button>
            <button type="reset" class="btn btn-danger" data-bs-dismiss="offcanvas"
                aria-label="Close">Disable</button>
        </form>
    </div>
</div>


@endsection