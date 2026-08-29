<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Core Seeders
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            PermissionRoleSeeder::class,
            UserSeeder::class,
            PracticeAreaSeeder::class,
            BlogCategorySeeder::class,
            BlogPostSeeder::class,
            TestimonialSeeder::class,
            FaqSeeder::class,
            SettingSeeder::class,
            PageSeeder::class,
        ]);

        // Optional: Generate additional test data
        if (app()->environment('local')) {
            User::factory(10)->create([
                'role_id' => Role::where('slug', 'client')->first()?->id,
            ]);
        }
    }
}
