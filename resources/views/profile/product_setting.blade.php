@extends('layouts.layouts')


@section('title', 'Product Settings')
@section('content')

    @vite(['resources/css/custom.scss', 'resources/js/app.js', 'resources/js/roles/product-setting.js'])



    <div class="container mt-5 col-lg-10 col-md-10 col-sm-6">
        <div class="row mb-4 pt-4">
            <div class="col-lg-12 col-md-10 col-sm-6">
                <h1 class="h3">Product Settings</h1>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        {{ session('success') }}
                    </div>
                @elseif (session('error'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
            </div>

            <div class="row justify-content-center pb-5">
                <div class="col-lg-12 col-md-10 col-sm-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <form action="#" method="POST" id="editProductForm">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-auto">
                                        <label for="warning-level" class="col-form-label">Warning Level</label>
                                    </div>
                                    <div class="col">
                                        <input type="number" class="form-control" id="warning-level" name="warning-level"
                                            placeholder="warning level">
                                    </div>
                                    <div class="col-auto">
                                        <label for="tax" class="col-form-label">Tax</label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="tax" name="tax"
                                            placeholder="tax value">
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary">Update Settings</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card shadow mt-4 ">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Disable Products</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
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
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->brand }}</td>
                                                <td>{{ $product->quantity }}</td>
                                                <td>{{ $product->size }}</td>
                                                <td>{{ $product->exp_date }}</td>
                                                <td>{{ $product->price }}</td>
                                                <td>{{ $product->category->name }}</td>
                                                <td>
                                                    <button class="btn btn-success btn-sm" id="activate"
                                                        data-id="{{ $product->id }}">Active</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
