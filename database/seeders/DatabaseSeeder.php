<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\RoleSeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\MeasurementUnitSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            PermissionSeeder::class, // create permissions first
            RoleSeeder::class,
            MeasurementUnitSeeder::class, // then assign them to roles
        ]);


        $user = User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'phone' => '1234567890',
            'email' => 'test@example.com',
            'password' => Hash::make('12345678'), // password

        ]);

         $user->assignRole('admin');

        
    }
}
