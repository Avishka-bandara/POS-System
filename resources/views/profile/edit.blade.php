@extends('layouts.layouts')

@section('title', 'Edit Profile')


@section('content')

    @vite(['resources/css/custom.scss', 'resources/js/roles/edit.js'])


    <div class="container pt-4 col-lg-10 col-md-10 col-sm-6 ">
        <div class="row mb-4 pt-4">
            <div class="col-lg-12 col-md-10 col-sm-6">
                <h1 class="h3 text-gray-800">Assign Roles | New User</h1>
                @if (session('success'))
                    <div class ="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">

            <!-- Admin Edit Form -->
            <div class="col-lg-12 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="{{ route('profile.new_user') }}" method="POST" id="adminEditForm">
                            @csrf
                            <div class="row">
                                <div class="col-4 mb-3">
                                    <label for="firstName" class="form-label">First Name</label>
                                    <input type="text" class="form-control" name="firstName" id="firstName"
                                        placeholder="First Name" value="">
                                    @if ($errors->has('firstName'))
                                        <span class="text-danger">{{ $errors->first('firstName') }}</span>
                                    @endif
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="lastName" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" name="lastName" id="lastName"
                                        placeholder="Last Name" value="">
                                    @if ($errors->has('lastName'))
                                        <span class="text-danger">{{ $errors->first('lastName') }}</span>
                                    @endif
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="phoneNumber" class="form-label">Contact Number</label>
                                    <input type="text" class="form-control" name="phoneNumber" id="phoneNumber"
                                        placeholder="+ 94" value="">
                                    @if ($errors->has('phoneNumber'))
                                        <span class="text-danger">{{ $errors->first('phoneNumber') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="Email" autocomplete="new-email" value="">
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="userPassword" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="userPassword" id="userPassword"
                                        placeholder="Password" autocomplete="new-password" value="">
                                    @if ($errors->has('userPassword'))
                                        <span class="text-danger">{{ $errors->first('userPassword') }}</span>
                                    @endif
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="role" class="form-label">Role</label>
                                    <select class="form-control" id="role" name="role">
                                        <option>Select a role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('role'))
                                        <span class="text-danger">{{ $errors->first('role') }}</span>
                                    @endif
                                </div>

                            </div>
                            <button type="submit" class="btn btn-success">Create New User</button>
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
                            <table class="table table-bordered align-middle" id="usertable">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>User Name</th>
                                        <th>Email</th>
                                        <th>Contact</th>
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
        </div>
    </div>
@endsection



<html lang="en">

<head>
    <meta charset="UTF-8">
    @vite(['resources/js/app.js', 'resources/css/custom.scss', 'resources/js/roles/editUser.js'])
</head>

<body>

    <!-- Offcanvas Drawer -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="editEmplyee" aria-labelledby="editEmplyee">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="editDrawerLabel">Edit User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form action="{{ route('user.save') }}" method="POST" id="editUserForm">
                @csrf
                <input type="hidden" name="user_id" id="user_id" value="">
                <div class="col-12 mb-3">
                    <label for="first_Name" class="form-label">First Name</label>
                    <input type="text" class="form-control" name="first_Name" id="first_Name"
                        placeholder="First Name">
                    @if ($errors->has('first_Name'))
                        <span class="text-danger">{{ $errors->first('first_Name') }}</span>
                    @endif
                </div>
                <div class="col-12 mb-3">
                    <label for="last_Name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" name="last_Name" id="last_Name"
                        placeholder="Last Name">
                    @if ($errors->has('last_Name'))
                        <span class="text-danger">{{ $errors->first('last_Name') }}</span>
                    @endif
                </div>
                <div class="col-12 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" name="user_email" id="user_email"
                        placeholder="Email">
                    @if ($errors->has('user_email'))
                        <span class="text-danger">{{ $errors->first('user_email') }}</span>
                    @endif
                </div>
                <div class="col-12 mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="user_password" id="user_password"
                        placeholder="Password">
                    @if ($errors->has('user_password'))
                        <span class="text-danger">{{ $errors->first('user_password') }}</span>
                    @endif
                </div>
                <div class="col-12 mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-control" name="user_role" id="user_role">

                    </select>
                    @if ($errors->has('role'))
                        <span class="text-danger">{{ $errors->first('role') }}</span>
                    @endif
                </div>
                <div class="row align-items-center justify-content-center">
                    <button type="submit" class="btn btn-success col-4 mb-3 btn-sm me-4"
                        data-bs-dismiss="offcanvas">Update</button>
                    <button type="button" class="btn btn-danger col-4 mb-3 btn-sm" id="deleteUserBtn"
                        data-bs-dismiss="offcanvas">Delete</button>
                </div>
            </form>
        </div>
    </div>


</body>

</html>
