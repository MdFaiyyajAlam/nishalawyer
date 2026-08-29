<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General
            ['key' => 'site_title', 'value' => 'NishaLawyer', 'type' => 'string', 'group' => 'general', 'label' => 'Site Title', 'is_public' => true],
            ['key' => 'site_tagline', 'value' => 'Premium Legal Services', 'type' => 'string', 'group' => 'general', 'label' => 'Site Tagline', 'is_public' => true],
            ['key' => 'site_description', 'value' => 'NishaLawyer provides premium legal services with compassion and expertise.', 'type' => 'string', 'group' => 'general', 'label' => 'Site Description', 'is_public' => true],

            // Contact
            ['key' => 'contact_email', 'value' => 'nisha@nivalawyer.com', 'type' => 'string', 'group' => 'contact', 'label' => 'Contact Email', 'is_public' => true],
            ['key' => 'contact_phone', 'value' => '+91-98765-43210', 'type' => 'string', 'group' => 'contact', 'label' => 'Contact Phone', 'is_public' => true],
            ['key' => 'contact_address', 'value' => '123 Legal Chambers, High Court Road, Mumbai - 400001', 'type' => 'string', 'group' => 'contact', 'label' => 'Contact Address', 'is_public' => true],

            // Social Media
            ['key' => 'facebook_url', 'value' => 'https://facebook.com/nivalawyer', 'type' => 'string', 'group' => 'social', 'label' => 'Facebook URL', 'is_public' => true],
            ['key' => 'linkedin_url', 'value' => 'https://linkedin.com/company/nivalawyer', 'type' => 'string', 'group' => 'social', 'label' => 'LinkedIn URL', 'is_public' => true],
            ['key' => 'twitter_url', 'value' => 'https://twitter.com/nivalawyer', 'type' => 'string', 'group' => 'social', 'label' => 'Twitter URL', 'is_public' => true],

            // Business Hours
            ['key' => 'business_hours', 'value' => '{"monday":"9:00 AM - 6:00 PM","tuesday":"9:00 AM - 6:00 PM","wednesday":"9:00 AM - 6:00 PM","thursday":"9:00 AM - 6:00 PM","friday":"9:00 AM - 6:00 PM","saturday":"Closed","sunday":"Closed"}', 'type' => 'json', 'group' => 'business', 'label' => 'Business Hours', 'is_public' => true],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}