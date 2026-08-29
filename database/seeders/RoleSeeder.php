<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Administrator',
                'slug' => 'admin',
                'description' => 'Full access to all system features and settings.',
                'level' => 100,
            ],
            [
                'name' => 'Advocate',
                'slug' => 'advocate',
                'description' => 'Lawyer with full access to client and case management.',
                'level' => 50,
            ],
            [
                'name' => 'Client',
                'slug' => 'client',
                'description' => 'Client who can book appointments, track cases, and upload documents.',
                'level' => 10,
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}