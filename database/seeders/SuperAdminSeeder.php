<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Create User
        $superAdminRole = Role::where('name', 'Super Admin')->first();
        $user = User::firstOrCreate(
            ['email' => 'superadmin@sembark.com'],
            [
                'name' => 'Sembark Super Admin',
                'password' => Hash::make('sembark12345')
            ]
        );

        // Assign Role
        $user->assignRole($superAdminRole);
    }
}
