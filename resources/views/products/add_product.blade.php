@extends('layouts.layouts')

@section('title', 'Add Product')


@section('content')
@vite([ 
    'resources/css/custom.scss',
    'resources/js/product/add-product.js'
])



    <div class="container pt-4 col-lg-10 col-md-10 col-sm-6">
        <div class="row mb-4 pt-4">
            <div class="col-lg-12 col-md-10 col-sm-6">
                <h1 class="h3">Add New Product</h1>
            </div>
        </div>
        {{-- @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif --}}
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-10 col-sm-6">
                <div class="card shadow">
                    <div class="card-body">

                        <form action="{{ route('product.add_new_product_save') }}" method="POST" id="addProductForm">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="productName" class="form-label">Product Name</label>
                                    <input type="text" class="form-control @error('productName') is-invalid @enderror"
                                        id="productName" name="productName" value="{{ old('productName') }}" required>
                                    @error('productName')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="brand" class="form-label">Seller</label>
                                    <input type="text" class="form-control @error('brand') is-invalid @enderror"
                                        id="brand" name="brand" value="{{ old('brand') }}" >
                                    @error('brand')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="size" class="form-label">Size</label>
                                    <input type="text" class="form-control @error('size') is-invalid @enderror"
                                        id="size" name="size" value="{{ old('size') }}">
                                    @error('size')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="quantity" class="form-label">Quantity</label>
                                    <input type="number" min="1"
                                        class="form-control @error('quantity') is-invalid @enderror" id="quantity"
                                        name="quantity" value="{{ old('quantity') }}" required>
                                    @error('quantity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="expiryDate" class="form-label">Expiry Date</label>
                                    <input type="date" class="form-control @error('expiryDate') is-invalid @enderror"
                                        id="expiryDate" name="expiryDate" value="{{ old('expiryDate') }}">
                                    @error('expiryDate')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="price" class="form-label">Price ($)</label>
                                    <input type="number" step="0.01" min="0"
                                        class="form-control @error('price') is-invalid @enderror" id="price"
                                        name="price" value="{{ old('price') }}" required>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="category" class="form-label">Category</label>
                                    <input type="text" class="form-control @error('category') is-invalid @enderror"
                                        id="category" name="category" value="{{ old('category') }}" required>
                                    @error('category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            {{-- <div class="btn-group  col-md-4">
                                
                               <a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Dropdown link
                                </a>

                                <ul class="dropdown-menu">
                                    <button class="dropdown-item" type="button" value="action">Action</button>
                                    <button class="dropdown-item" type="button" value="another_action">Another action</button>
                                    <button class="dropdown-item" type="button" value="something_else">Something else here</button>
                                </ul>
                           </div> --}}

                            <div class="text-end mt-5">
                                <button type="submit" class="btn btn-success col-3">
                                    <i class="fas fa-plus-circle me-1"></i> Add Product
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
