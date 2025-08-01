<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminrole = Role::create(['name' => 'admin']);
        Role::create(['name' => 'cashier']);


        $permissions = Permission::all();
        $adminrole->syncPermissions($permissions);

    }
}
