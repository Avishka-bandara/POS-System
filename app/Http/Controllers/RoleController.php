<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{
    public function index(){
        $role = Role::all();
        $permissions = Permission::all();
        return view('profile.role', compact('role', 'permissions'));
    }
    
    public function fetchRoles(Request $request)
    {
        $roles = Role::all();
        return response()->json(['roles' => $roles], 200);
    }

    public function store(Request $request)
    {
    
        $roleName = $request->roleName;
        if(!$roleName || Role::where('name', $roleName)->exists()) {
            return response()->json(['error' => 'Role name is required or already exists'], 200);
        }
        $role = Role::create(['name' => $request->roleName]);

        return response()->json(['success' => 'Role created successfully'],200);
            
    }

 
}
