<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Admin', 'description' => 'Administrator role'],
            ['name' => 'Vice-admin', 'description' => 'Admin + Regular user role'],
            ['name' => 'Regular Role', 'description' => 'Regular User','created_at' => now(),],
        ];

        foreach ($roles as $roleData) {
            Role::updateOrInsert(
                ['name' => $roleData['name']],
                $roleData
            );
        }
    }
}
