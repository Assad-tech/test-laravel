<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'admin',
                'description' => 'Administrator role',
            ],
            [
                'name' => 'user',
                'description' => 'Regular user role',
            ],
            // Add more roles here
        ];

        foreach ($roles as $roleData) {
            Role::create($roleData);
        }
    }
}
