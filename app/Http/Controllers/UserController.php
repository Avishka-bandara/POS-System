<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // dd($request->all());
        $validate = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'phoneNumber' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email',
            // 'userPassword' => 'required|string|min:8|confirmed',
            'role' => 'required|exists:roles,name',
        ]);

        $user = User::create([
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'phone' => $request->phoneNumber,
            'email' => $request->email,
            'password' => Hash::make($request->userPassword),
        ]);
        $role = Role::where('name', $request->role)->first();

        $user->syncRoles([$role]);

        return redirect()->back()->with('success', 'User created successfully');
        
    }

    public function getUser($id)
    {
        $user = User::with('roles')->findOrFail($id);
        $roles = Role::all();

        return response()->json([
            'user' => $user,
            'roles' => $roles,
            'assigned_roles' => $user->roles->pluck('id') // Array of assigned role IDs
        ]);
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $userID = $request->input('user_id');
        $user = User::findOrFail($userID);

        $user->first_name = $request->input('first_Name');
        $user->last_name = $request->input('last_Name');
        $user->email = $request->input('user_email');
        if($request->filled('user_password')) {
            $user->password = Hash::make($request->input('user_password'));
        }
        $user->save();

        $roleID = $request->input('user_role');
        $role = Role::findOrFail($roleID);        
        $user->syncRoles([$role->name]); // Sync the role with the user

        return redirect()->back()->with('success', 'User updated successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(){
        $users = User::all();
        $roles = Role::all();
        return response()->json([
            'data' => $users ,
            'roles' => $roles
        ]);
    }
    
        
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {    
        $authUserId = Auth::id();

        if ((int)$id === (int)$authUserId) {
            return response()->json(['error' => 'You cannot delete your own account.'], 403);
        }

        // $user = User::findOrFail($id);
        // $user->delete();
        return response()->json(['success' => 'User deleted successfully', 'authUserId' => $authUserId, 'deletedUserId' => $id], 200);

    }
}
