<?php

namespace App\Services;

use App\Enums\UserRole;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthService
{
    public function registerClient(array $data): User
    {
        $role = Role::where('slug', UserRole::Client->value)->first();

        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'password' => $data['password'],
            'role_id' => $role->id,
            'is_active' => true,
        ]);
    }

    public function registerAdmin(array $data): User
    {
        $role = Role::where('slug', UserRole::Admin->value)->first();

        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'password' => $data['password'],
            'role_id' => $role->id,
            'is_active' => true,
        ]);
    }

    public function generateAppointmentNumber(): string
    {
        return 'APT-' . now()->format('Y') . '-' . str_pad((string) rand(1, 9999), 4, '0', STR_PAD_LEFT);
    }

    public function generateCaseNumber(): string
    {
        return 'CASE-' . now()->format('Y') . '-' . str_pad((string) rand(1, 9999), 4, '0', STR_PAD_LEFT);
    }
}