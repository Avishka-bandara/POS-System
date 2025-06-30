<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        permission::create(['name' => 'add_product']);
        permission::create(['name' => 'view_product']);
        permission::create(['name' => 'edit_product']);
        permission::create(['name' => 'delete_product']);
        permission::create(['name' => 'pos_access']);
        permission::create(['name' => 'modify_roles']);

    }
}
