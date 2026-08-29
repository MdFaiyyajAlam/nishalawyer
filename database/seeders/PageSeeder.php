<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'content' => '<h2>Privacy Policy</h2><p>This Privacy Policy describes how NishaLawyer collects, uses, and discloses your personal information when you use our services.</p><h3>Information We Collect</h3><p>We collect information you provide directly to us, including your name, email address, phone number, and any information you include in communications with us.</p><h3>How We Use Your Information</h3><p>We use the information we collect to provide, maintain, and improve our services, and to personalize your experience.</p>',
                'meta_title' => 'Privacy Policy - NishaLawyer',
                'meta_description' => 'Learn about how NishaLawyer handles your personal information and data privacy.',
                'meta_keywords' => 'privacy policy, lawyer, legal services, data privacy',
                'status' => 'published',
                'is_system' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Terms of Service',
                'slug' => 'terms-of-service',
                'content' => '<h2>Terms of Service</h2><p>These Terms of Service govern your use of the NishaLawyer website and services.</p><h3>Use of Services</h3><p>You may use our services to inquire about legal services and communicate with our team. Any information you provide is subject to these terms.</p>',
                'meta_title' => 'Terms of Service - NishaLawyer',
                'meta_description' => 'Review the terms and conditions for using NishaLawyer services.',
                'meta_keywords' => 'terms of service, lawyer, legal services, terms and conditions',
                'status' => 'published',
                'is_system' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Legal Notice',
                'slug' => 'legal-notice',
                'content' => '<h2>Legal Notice</h2><p>This website is operated by NishaLawyer ("we", "us", or "our"). By accessing or using this website, you agree to be bound by these terms.</p><h3>Intellectual Property</h3><p>All content on this site is the property of NishaLawyer and protected by copyright and other intellectual property laws.</p>',
                'meta_title' => 'Legal Notice - NishaLawyer',
                'meta_description' => 'Legal notice for the NishaLawyer website.',
                'meta_keywords' => 'legal notice, lawyer, legal services',
                'status' => 'published',
                'is_system' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Disclaimer',
                'slug' => 'disclaimer',
                'content' => '<h2>Disclaimer</h2><p>The information on this website is for general informational purposes only and does not constitute legal advice.</p>',
                'meta_title' => 'Disclaimer - NishaLawyer',
                'meta_description' => 'Disclaimer for NishaLawyer website.',
                'meta_keywords' => 'disclaimer, lawyer, legal information',
                'status' => 'published',
                'is_system' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($pages as $page) {
            Page::create($page);
        }
    }
}