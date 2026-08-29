<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use App\Models\BlogTag;
use Illuminate\Database\Seeder;

class BlogCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Legal Updates', 'slug' => 'legal-updates', 'description' => 'Latest updates and changes in the legal field.', 'is_active' => true],
            ['name' => 'Court Judgments', 'slug' => 'court-judgments', 'description' => 'Analysis of important court judgments and their implications.', 'is_active' => true],
            ['name' => 'Legal Guides', 'slug' => 'legal-guides', 'description' => 'Comprehensive guides to help you understand legal processes.', 'is_active' => true],
            ['name' => 'Case Studies', 'slug' => 'case-studies', 'description' => 'In-depth analysis of real legal cases and their outcomes.', 'is_active' => true],
            ['name' => 'Law Firm News', 'slug' => 'law-firm-news', 'description' => 'News and updates from our law firm.', 'is_active' => true],
            ['name' => 'Legal Tips', 'slug' => 'legal-tips', 'description' => 'Practical legal tips and advice.', 'is_active' => true],
        ];

        foreach ($categories as $category) {
            BlogCategory::create($category);
        }

        $tags = [
            ['name' => 'Family Law', 'slug' => 'family-law'],
            ['name' => 'Divorce', 'slug' => 'divorce'],
            ['name' => 'Criminal Defense', 'slug' => 'criminal-defense'],
            ['name' => 'Civil Law', 'slug' => 'civil-law'],
            ['name' => 'Property Law', 'slug' => 'property-law'],
            ['name' => 'Consumer Rights', 'slug' => 'consumer-rights'],
            ['name' => 'Cyber Crime', 'slug' => 'cyber-crime'],
            ['name' => 'Corporate Law', 'slug' => 'corporate-law'],
            ['name' => 'Legal Advice', 'slug' => 'legal-advice'],
            ['name' => 'Court Proceedings', 'slug' => 'court-proceedings'],
        ];

        foreach ($tags as $tag) {
            BlogTag::create($tag);
        }
    }
}
