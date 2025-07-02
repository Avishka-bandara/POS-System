@extends('layouts.layouts')

@section('title', 'Role Management')

@section('content')


    @vite([
        'resources/css/custom.scss'
        ])
    @vite([
        'resources/js/roles/roles.js',
        'resources/js/app.js'
        ])

    <div class="container mt-5 col-lg-10 col-md-10 col-sm-6">
        <div class="row mb-4 pt-4">
            <div class="col-lg-12 col-md-10 col-sm-6">
                <h1 class="h3">Grant Permissions</h1>    
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
        </div>

        <!-- Create Role Form -->
        <div class="card mb-5">
            <div class="card-header">
                <h5>Create New Role</h5>
            </div>
            <div class="card-body">
                <form id="createRoleForm" action="{{url('api/roles')}}" method="POST">
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
                    <!-- Role Dropdown -->
                    <form action="{{route('profile.rolesave')}}" method="POST" id="permissionsForm">
                        @csrf
                    <div class="mb-4">
                        <label for="roleSelect" class="form-label">Select Role</label>
                        <select class="form-select" id="role_id" name="role_id" style="box-shadow: none;">
                            
                        </select>
                    </div>
                    <!-- Permissions Table -->
                    <div class="table-responsive" id="permissionTable">
                        <table class="table table-hover align-middle" >
                            <thead>
                                <tr>
                                    <th>Permission Name</th>
                                    
                                </tr>
                            </thead>
                            <tbody id="permissionsTable">
                                <!-- Permissions will be rendered dynamically -->
                                
                                @foreach($permissions as $permission)
                                    <tr>
                                        <td width="80%">{{$permission->name}}</td>
                                        <td>
                                            <input type="checkbox" class="permission-checkbox" id="permission_{{ $permission->id }}" name="permissions[{{ $permission->name }}]" value="{{$permission->name}}">
                                        </td>
                                    </tr>
                                @endforeach

                                
                            </tbody>
                        </table>
                    </div>

                    <div class="text-end">
                        <button type="button" class="btn btn-danger mt-3" id="deleteRole">Delete Role</button>
                        <button type="submit" class="btn btn-success mt-3" id="updatePermissions">Update Permissions</button>
                    </div>
                    
                </form>
                
            </div>
        </div>

    </div>


@endsection
