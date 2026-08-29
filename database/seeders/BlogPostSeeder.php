<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogPostSeeder extends Seeder
{
    public function run(): void
    {
        $advocate = User::whereHas('role', function ($q) {
            $q->where('slug', 'advocate');
        })->first();

        $categoryLegalUpdates = BlogCategory::where('slug', 'legal-updates')->first();
        $categoryLegalGuides = BlogCategory::where('slug', 'legal-guides')->first();
        $categoryCourtJudgments = BlogCategory::where('slug', 'court-judgments')->first();
        $categoryCaseStudies = BlogCategory::where('slug', 'case-studies')->first();

        $posts = [
            [
                'title' => 'Top 10 Legal Requirements for Startup Registration in India',
                'slug' => 'startup-registration-india',
                'category_id' => $categoryLegalGuides ? $categoryLegalGuides->id : null,
                'author_id' => $advocate ? $advocate->id : 1,
                'excerpt' => 'Starting a business in India requires navigating several legal requirements. This comprehensive guide covers the top 10 legal essentials for startup registration.',
                'content' => '<p>Starting a business in India requires navigating several legal requirements. This comprehensive guide covers the top 10 legal essentials for startup registration and compliance.</p><h3>1. Choose Your Business Structure</h3><p>The first step in starting a business is determining the appropriate legal structure - sole proprietorship, partnership, LLP, or private limited company.</p><h3>2. Register Your Business</h3><p>Register your business with the appropriate authorities including the Ministry of Corporate Affairs (MCA).</p><h3>3. Obtain PAN and TAN</h3><p>All businesses must obtain a PAN and TAN from the Income Tax Department.</p><h3>4. Register for GST</h3><p>If your annual turnover exceeds the threshold limit, you must register for GST.</p>',
                'featured_image' => 'blog/startup-registration.jpg',
                'status' => 'published',
                'is_featured' => true,
                'published_at' => now()->subDays(15),
                'meta_title' => 'Startup Registration in India - Legal Requirements',
                'meta_description' => 'Complete guide to legal requirements for startup registration in India.',
            ],
            [
                'title' => 'Understanding Child Custody Laws in India: A Comprehensive Guide',
                'slug' => 'child-custody-laws-india',
                'category_id' => $categoryLegalGuides ? $categoryLegalGuides->id : null,
                'author_id' => $advocate ? $advocate->id : 1,
                'excerpt' => 'Understanding child custody laws is crucial for parents going through a divorce.',
                'content' => '<p>Understanding child custody laws is crucial for parents going through a divorce. This guide explains custody types, legal rights, and the court decision-making process.</p><h3>Types of Child Custody</h3><p>1. Legal Custody: Decision-making right<br>2. Physical Custody: Living arrangement<br>3. Joint Custody: Both parents share custody.</p>',
                'featured_image' => 'blog/child-custody.jpg',
                'status' => 'published',
                'is_featured' => true,
                'published_at' => now()->subDays(30),
                'meta_title' => 'Child Custody Laws in India - Guide',
                'meta_description' => 'Understanding child custody laws in India for divorcing parents.',
            ],
            [
                'title' => 'Recent Supreme Court Rulings on Women Property Rights',
                'slug' => 'supreme-court-women-property',
                'category_id' => $categoryCourtJudgments ? $categoryCourtJudgments->id : null,
                'author_id' => $advocate ? $advocate->id : 1,
                'excerpt' => 'An analysis of recent landmark Supreme Court judgments on women property rights.',
                'content' => '<p>An analysis of recent landmark Supreme Court judgments on women property rights and inheritance laws in India.</p><h3>Major Rulings</h3><p>Recent rulings strengthening women property rights in ancestral property.</p>',
                'featured_image' => 'blog/women-property.jpg',
                'status' => 'published',
                'is_featured' => false,
                'published_at' => now()->subDays(45),
                'meta_title' => 'Supreme Court Women Property Rights Rulings',
                'meta_description' => 'Analysis of Supreme Court rulings on women property rights.',
            ],
            [
                'title' => 'How to Handle a Cybercrime Complaint in India',
                'slug' => 'cybercrime-complaint-india',
                'category_id' => $categoryLegalGuides ? $categoryLegalGuides->id : null,
                'author_id' => $advocate ? $advocate->id : 1,
                'excerpt' => 'If you become a victim of cybercrime, it is essential to act quickly.',
                'content' => '<p>If you become a victim of cybercrime, it is essential to act quickly. This guide explains the process of filing a cybercrime complaint.</p><h3>Steps</h3><p>1. Document the incident<br>2. File complaint at cybercrime.gov.in<br>3. Submit written complaint to local cybercrime cell<br>4. Follow up with investigating officer.</p>',
                'featured_image' => 'blog/cybercrime.jpg',
                'status' => 'published',
                'is_featured' => true,
                'published_at' => now()->subDays(20),
                'meta_title' => 'File Cybercrime Complaint in India - Guide',
                'meta_description' => 'Step-by-step guide to filing cybercrime complaint in India.',
            ],
            [
                'title' => 'Case Study: Property Title Dispute Resolution',
                'slug' => 'property-title-dispute-case-study',
                'category_id' => $categoryCaseStudies ? $categoryCaseStudies->id : null,
                'author_id' => $advocate ? $advocate->id : 1,
                'excerpt' => 'A detailed case study of how we successfully challenged a complex property title dispute.',
                'content' => '<p>A detailed case study of successfully challenging a complex property title dispute through meticulous research and legal strategy.</p><h3>Strategy</h3><p>We conducted thorough title searches, examined historical records.</p>',
                'featured_image' => 'blog/property-case-study.jpg',
                'status' => 'published',
                'is_featured' => false,
                'published_at' => now()->subDays(10),
                'meta_title' => 'Property Title Dispute Case Study',
                'meta_description' => 'Case study of challenging property title disputes.',
            ],
        ];

        foreach ($posts as $post) {
            $blogPost = BlogPost::create($post);
            $tagIds = BlogTag::all()->pluck('id')->random(3)->toArray();
            $blogPost->tags()->sync($tagIds);
        }
    }
}
