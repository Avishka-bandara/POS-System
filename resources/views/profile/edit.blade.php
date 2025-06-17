@extends('layouts.layouts')

@section('title', 'Edit Profile')


@section('content')

    @vite(['resources/css/custom.scss'])


    <div class="container pt-4 col-lg-10 col-md-10 col-sm-6 ">
        <div class="row mb-4 pt-4">
            <div class="col-lg-12 col-md-10 col-sm-6">
                <h1 class="h3">Edit Profile</h1>
            </div>
        </div>
        <div class="row">

            <!-- Admin Edit Form -->
            <div class="col-lg-12 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="#" method="POST" id="adminEditForm">
                            <div class="row">
                                <div class="col-4 mb-3">
                                    <label for="Name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="adminName" placeholder="Admin Name">
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="phone" class="form-label">Contact Number</label>
                                    <input type="text" class="form-control" id="phone" placeholder="+94 76 123 4567">
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email"
                                        placeholder="admin@example.com">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Update Profile</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Registered Cashiers Table -->
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-secondary text-white">
                        Registered Cashiers
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Cashier Name</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Sample row -->
                                    <tr>
                                        <td>1</td>
                                        <td>Kasun Perera</td>
                                        <td>kasun@example.com</td>
                                        <td>071 234 5678</td>
                                        <td>
                                            <a class="btn btn-primary" data-bs-toggle="offcanvas" href="#editEmplyee"
                                                role="button" aria-controls="editDrawer">
                                                Edit
                                            </a>
                                        </td>
                                    </tr>
                                    <!-- You can duplicate for more sample rows -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



<html lang="en">
<head>
    <meta charset="UTF-8">
    @vite(['resources/js/app.js', 'resources/css/custom.css'])
</head>

<body>

    <!-- Offcanvas Drawer -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="editEmplyee" aria-labelledby="editEmplyee">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="editDrawerLabel">Edit User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            Hello! I'm in the right drawer.
        </div>
    </div>

    
</body>

</html>
