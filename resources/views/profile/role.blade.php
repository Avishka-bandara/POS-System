@extends('layouts.layouts')

@section('title', 'Role Management')

@section('content')


    @vite(['resources/css/custom.scss'])

    <div class="container mt-5 col-lg-10 col-md-10 col-sm-6">
        <div class="row mb-4 pt-4">
            <div class="col-lg-12 col-md-10 col-sm-6">
                <h1 class="h3">Edit Roles</h1>
            </div>
        </div>

        <!-- Create Role Form -->
        <div class="card mb-5">
            <div class="card-header">
                <h5>Create New Role</h5>
            </div>
            <div class="card-body">
                <form id="createRoleForm">
                    <div class=" row mt-3">
                        <div class="col-5 mb-3">
                            <input type="text" class="form-control" id="roleName" name="roleName"
                            placeholder="Enter role name" style="box-shadow: none;" >
                        </div>
                        <div class="col-5 ">
                            <button type="submit" class="btn btn-primary" style="box-shadow: none;">Create Role</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Select Role and Show Permissions -->
        <div class="card mb-5 mt-4">
            <div class="card-header">
                <h5>Manage Role Permissions</h5>
            </div>
            <div class="card-body">
                <form id="rolePermissionsForm">
                    <!-- Role Dropdown -->
                    <div class="mb-4">
                        <label for="roleSelect" class="form-label">Select Role</label>
                        <select class="form-select" id="roleSelect" name="roleSelect" style="box-shadow: none;">
                            <option value="">-- Choose a role --</option>
                            <option value="admin">Admin</option>
                            <option value="cashier">Cashier</option>
                            <option value="manager">Manager</option>
                            <!-- More roles will be dynamically loaded here -->
                        </select>
                    </div>

                    <!-- Permissions Table -->
                    <div class="table-responsive" id="permissionTable">
                        <table class="table table-hover align-middle" >
                            <thead>
                                <tr>
                                    <th>Permission Name</th>
                                    <th class="text-center">Allow</th>
                                    <th class="text-center">Not Allow</th>
                                </tr>
                            </thead>
                            <tbody id="permissionsTable">
                                <!-- Permissions will be rendered dynamically -->
                                <tr>
                                    <td>Add Product</td>
                                    <td class="text-center">
                                        <input type="radio" name="add_product" value="1" class="form-check-input">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="add_product" value="0" class="form-check-input">
                                    </td>
                                </tr>
                                <tr>
                                    <td>View Product</td>
                                    <td class="text-center">
                                        <input type="radio" name="view_product" value="1" class="form-check-input">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="view_product" value="0" class="form-check-input">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Edit Product</td>
                                    <td class="text-center">
                                        <input type="radio" name="edit_product" value="1" class="form-check-input">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="edit_product" value="0" class="form-check-input">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Delete Product</td>
                                    <td class="text-center">
                                        <input type="radio" name="delete_product" value="1" class="form-check-input">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="delete_product" value="0" class="form-check-input">
                                    </td>
                                </tr>
                                <tr>
                                    <td>POS Access</td>
                                    <td class="text-center">
                                        <input type="radio" name="pos" value="1" class="form-check-input">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="pos" value="0" class="form-check-input">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-success mt-3">Update Permissions</button>
                    </div>
                </form>
            </div>
        </div>

    </div>


@endsection
