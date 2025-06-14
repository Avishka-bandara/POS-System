@extends('layouts.layouts')

@section('title', 'View Product')

@section('content')
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

                        <form action="#" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="productName" class="form-label">Product Name</label>
                                    <input type="text" class="form-control @error('productName') is-invalid @enderror"
                                        id="productName" name="productName" value="{{ old('productName') }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="brand" class="form-label">Brand</label>
                                    <input type="text" class="form-control @error('brand') is-invalid @enderror"
                                        id="brand" name="brand" value="{{ old('brand') }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="btn-group col-md-4 mt-3">
                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Dropdown link
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </div>

                            </div>

                            

                            <div class="text-end mt-5">
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
