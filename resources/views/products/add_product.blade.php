@extends('layouts.layouts')

@section('title', 'Add Product')


@section('content')

    @vite(['resources/css/custom.scss', 'resources/js/product/add-product.js', 'resources/css/toast.scss', 'resources/js/app.js'])



    <div class="container pt-4 col-lg-10 col-md-10 col-sm-6">
        <div class="row mb-4 pt-4">
            <div class="col-lg-12 col-md-10 col-sm-6">
                <h1 class="h3 text-gray-800">Add New Product</h1>
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
                                    <input type="text" class="form-control " id="productName" name="productName"
                                        required>
                                </div>

                                <div class="col-md-6">
                                    <label for="brand" class="form-label">Seller</label>
                                    <input type="text" class="form-control" id="brand" name="brand">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="size" class="form-label">Size</label>
                                    {{-- <input type="text" class="form-control" id="size" name="size"
                                        value="{{ old('size') }}">
                                    @error('size')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror --}}
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="size" name="size"
                                            value="{{ old('size') }}" placeholder="Enter size">
                                        <select class="form-select col-lg-3" id="unit" name="unit" required>
                                            <option value="" disabled selected>Select Unit</option>
                                            @foreach ($measurementUnits as $unit)
                                                <option value="{{ $unit->id }}">{{ $unit->name }}-
                                                    <strong>{{ $unit->symbol }}</strong>
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <label for="quantity" class="form-label">Quantity</label>
                                    <input type="number" min="1" class="form-control" id="quantity" name="quantity"
                                        required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="expiryDate" class="form-label">Expiry Date</label>
                                    <input type="text" class="form-control" id="expiryDate" name="expiryDate"
                                        value="{{ old('expiryDate') }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="price" class="form-label">Price ($)</label>
                                    <input type="number" step="0.01" min="0" class="form-control" id="price"
                                        name="price" value="{{ old('price') }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="category_id" class="form-label">Category</label>
                                    <select class="form-control" id="category_id" name="category_id" required>
                                        <option>Select a category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

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
