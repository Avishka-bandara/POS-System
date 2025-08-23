<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolePermissionController extends Controller
{

    public function fetchPermissions($roleID)
    {
        $role = Role::find($roleID);
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('name');

    return response()->json([
        'permissions' => $permissions,
        'role_permissions' => $rolePermissions,
    ]);

    }

    public function RolesPermissions(Request $request)
    {

        if (!$request->role_id) {
            return redirect()->back()->with('error', 'Please select a role.');
        }

        if (!$request->has('permissions') || empty($request->permissions)) {
            return redirect()->back()->with('error', 'Please select at least one permission.');
        }

        $role = Role::find($request->role_id);
        $role->syncPermissions($request->permissions);
       
        return redirect()->back()->with('success', 'Permissions updated successfully');
        



    }

    public function deleteRole($roleID){
        $role = Role::find($roleID);
        if ($role) {
            $role->delete();
            return response()->json(['success' => 'Role deleted successfully'], 200);
        } else {
            return response()->json(['error' => 'Role not found'], 200);
        }
    }
}
