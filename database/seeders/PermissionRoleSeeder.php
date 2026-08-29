<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('slug', 'admin')->first();
        $advocateRole = Role::where('slug', 'advocate')->first();
        $clientRole = Role::where('slug', 'client')->first();

        // Admin gets all permissions
        if ($adminRole) {
            $allPermissions = Permission::all()->pluck('id')->toArray();
            $adminRole->permissions()->sync($allPermissions);
        }

        // Advocate permissions
        $advocatePermissions = [
            'cases.view', 'cases.create', 'cases.edit', 'cases.manage',
            'appointments.view', 'appointments.create', 'appointments.edit', 'appointments.manage',
            'documents.view', 'documents.create', 'documents.download', 'documents.manage',
            'blog.view', 'blog.create', 'blog.edit', 'blog.manage',
            'testimonials.view', 'testimonials.approve', 'testimonials.manage',
            'contacts.view', 'contacts.reply', 'contacts.manage',
            'legal_notices.view', 'legal_notices.create', 'legal_notices.manage',
            'reports.view', 'reports.manage',
            'practice_areas.view', 'practice_areas.manage',
            'faqs.view', 'faqs.manage',
        ];

        if ($advocateRole) {
            $permissionIds = Permission::whereIn('slug', $advocatePermissions)->pluck('id')->toArray();
            $advocateRole->permissions()->sync($permissionIds);
        }

        // Client permissions
        $clientPermissions = [
            'cases.view',
            'appointments.view', 'appointments.create',
            'documents.view', 'documents.download',
        ];

        if ($clientRole) {
            $permissionIds = Permission::whereIn('slug', $clientPermissions)->pluck('id')->toArray();
            $clientRole->permissions()->sync($permissionIds);
        }
    }
}