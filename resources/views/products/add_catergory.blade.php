@extends('layouts.layouts')

@section('title', 'Add Category')

@section('content')

@vite([
    'resources/css/custom.scss',
    'resources/js/product/add-catergory.js',
    'resources/css/toast.scss',
    'resources/js/app.js'

])

    <div class="container pt-4 col-lg-10 col-md-10 col-sm-6">
        <div class="row mb-4 pt-4">
            <div class="col-lg-12 col-md-10 col-sm-6">
                <h1 class="h3">Add New Category</h1>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-10 col-sm-6">
                <div class="card shadow">
                    <div class="card-body">
                        <form action="{{url('api/add-category-save')}}" id="addCategoryForm" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="categoryName" class="form-label">Category Name</label>
                                <input type="text" class="form-control col-5" id="categoryName" name="categoryName">
                            </div>
                            <button type="submit" class="btn btn-primary">Add Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div id="loader" style="display: none;" class="mt-3 text-center">
            <div class="spinner-border text-primary" role="status">
                {{-- <span class="visually-hidden">Loading...</span> --}}
            </div>
        </div>

        <hr class="my-4">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Catergories</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mt-3" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="categoryTableBody"  class="text-center" >
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection



{{-- Edit Category Drawer --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    @vite(['resources/js/app.js', 'resources/css/custom.scss'])
</head>
<body>
    <div id="editDrawer" class="offcanvas offcanvas-end"  aria-labelledby="editDrawerLabel">
        <div class="offcanvas-header">
            <h5 id="editDrawerLabel">Edit Category</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <form id="editCategoryForm" method="POST" action="{{url('/api/update-category')}}">
                @csrf
                <input type="hidden" name="id" id="CategoryId">
                <div class="mb-3">
                    <label for="CategoryName" class="form-label">Category Name</label>
                    <input type="text" class="form-control" id="CategoryName" name="CategoryName" required>
                </div>
                <button type="submit" class="btn btn-success" data-bs-dismiss="offcanvas" aria-label="Close">Update</button>
            </form>
        </div>
    </div>
    
</body>
</html>