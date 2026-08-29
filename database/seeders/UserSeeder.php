<?php

namespace Database\Seeders;

use App\Models\LegalCase;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        $adminRole = Role::where('slug', 'admin')->first();
        $admin = User::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'admin@nivalawyer.com',
            'phone' => '+91-98765-43210',
            'password' => Hash::make('password'),
            'role_id' => $adminRole->id,
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Create Advocate (Nisha)
        $advocateRole = Role::where('slug', 'advocate')->first();
        $advocate = User::create([
            'first_name' => 'Nisha',
            'last_name' => 'Sharma',
            'email' => 'nisha@nivalawyer.com',
            'phone' => '+91-98765-43210',
            'password' => Hash::make('password'),
            'role_id' => $advocateRole->id,
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Create a test client
        $clientRole = Role::where('slug', 'client')->first();
        $client = User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'client@nivalawyer.com',
            'phone' => '+91-98765-12345',
            'password' => Hash::make('password'),
            'role_id' => $clientRole->id,
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Create additional test users
        User::factory(5)->create([
            'role_id' => $clientRole->id,
        ]);

        // Create profiles
        $admin->profile()->create([
            'bio' => 'System Administrator for NishaLawyer.',
            'bar_council_number' => 'ADMIN-001',
            'specialization' => 'System Administration',
            'city' => 'Mumbai',
            'state' => 'Maharashtra',
            'country' => 'India',
        ]);

        $advocate->profile()->create([
            'bio' => config('nishalawyer.advocate.bio'),
            'bar_council_number' => config('nishalawyer.advocate.bar_number'),
            'specialization' => 'Family Law, Divorce Law, Criminal Law, Civil Law',
            'address' => config('nishalawyer.advocate.address'),
            'city' => 'Mumbai',
            'state' => 'Maharashtra',
            'country' => 'India',
            'postal_code' => '400001',
            'website' => 'https://nishalawyer.com',
            'qualifications' => config('nishalawyer.advocate.qualifications'),
        ]);

        $client->profile()->create([
            'bio' => 'A valued client seeking legal assistance.',
            'city' => 'Mumbai',
            'state' => 'Maharashtra',
            'country' => 'India',
        ]);
    }
}