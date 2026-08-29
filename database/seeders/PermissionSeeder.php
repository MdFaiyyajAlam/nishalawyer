<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $modules = [
            'users' => ['view', 'create', 'edit', 'delete', 'manage'],
            'roles' => ['view', 'create', 'edit', 'delete', 'manage'],
            'cases' => ['view', 'create', 'edit', 'delete', 'manage'],
            'appointments' => ['view', 'create', 'edit', 'delete', 'manage'],
            'documents' => ['view', 'create', 'download', 'delete', 'manage'],
            'blog' => ['view', 'create', 'edit', 'delete', 'manage'],
            'testimonials' => ['view', 'create', 'edit', 'delete', 'approve', 'manage'],
            'contacts' => ['view', 'reply', 'delete', 'manage'],
            'settings' => ['view', 'edit', 'manage'],
            'pages' => ['view', 'create', 'edit', 'delete', 'manage'],
            'practice_areas' => ['view', 'create', 'edit', 'delete', 'manage'],
            'legal_notices' => ['view', 'create', 'delete', 'manage'],
            'faqs' => ['view', 'create', 'edit', 'delete', 'manage'],
            'reports' => ['view', 'manage'],
        ];

        foreach ($modules as $module => $actions) {
            foreach ($actions as $action) {
                $name = "{$module}.{$action}";
                Permission::create([
                    'name' => $name,
                    'slug' => $name,
                    'module' => $module,
                    'description' => "Can {$action} {$module}",
                ]);
            }
        }
    }
}