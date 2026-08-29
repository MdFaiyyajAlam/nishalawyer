<?php

namespace Database\Seeders;

use App\Models\PracticeArea;
use Illuminate\Database\Seeder;

class PracticeAreaSeeder extends Seeder
{
    public function run(): void
    {
        $areas = [
            [
                'title' => 'Family Law',
                'slug' => 'family-law',
                'short_description' => 'Legal matters concerning family relationships.',
                'description' => '<p>Family law covers a broad range of legal matters including marriage, divorce, child custody, adoption, domestic violence, and property settlements. Our approach is always focused on achieving the best outcome for your family.</p><p>We understand that these matters can be emotionally challenging, and we provide compassionate yet assertive legal representation to protect your family\'s interests.</p>',
                'color_class' => 'bg-blue-900',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Divorce Law',
                'slug' => 'divorce-law',
                'short_description' => 'Navigating divorce proceedings with compassion and expertise.',
                'description' => '<p>Divorce is one of the most challenging times in a person\'s life. We provide comprehensive legal counsel to help you navigate divorce proceedings, including asset division, alimony, and child support.</p>',
                'color_class' => 'bg-blue-800',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Criminal Law',
                'slug' => 'criminal-law',
                'short_description' => 'Defending your rights with aggressive and strategic representation.',
                'description' => '<p>Criminal charges can have life-altering consequences. Our experienced criminal defense attorneys provide zealous representation and fight to protect your rights and freedom.</p>',
                'color_class' => 'bg-blue-950',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Civil Law',
                'slug' => 'civil-law',
                'short_description' => 'Resolving disputes and protecting your civil rights.',
                'description' => '<p>Civil law governs disputes between individuals, businesses, and organizations. We provide strong representation in civil litigation, contract disputes, and tort claims.</p>',
                'color_class' => 'bg-blue-700',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'title' => 'Property Disputes',
                'slug' => 'property-disputes',
                'short_description' => 'Protecting your real estate and property interests.',
                'description' => '<p>Property disputes can be complex and emotionally charged. We provide comprehensive legal representation for real estate disputes, boundary issues, landlord-tenant disputes, and property transfers.</p>',
                'color_class' => 'bg-blue-800',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'title' => 'Consumer Court',
                'slug' => 'consumer-court',
                'short_description' => 'Fighting for consumer rights and fair treatment.',
                'description' => '<p>Consumer protection laws exist to ensure fair treatment. We help consumers navigate consumer court proceedings, file complaints against businesses, and resolve disputes with service providers.</p>',
                'color_class' => 'bg-blue-900',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 6,
            ],
            [
                'title' => 'Cyber Crime',
                'slug' => 'cyber-crime',
                'short_description' => 'Addressing the growing challenges of cybercrime.',
                'description' => '<p>Cybercrime is rapidly growing as technology advances. We provide specialized legal counsel for cybercrime cases including identity theft, online fraud, data breaches, cyberstalking, and digital crime defense.</p>',
                'color_class' => 'bg-blue-700',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 7,
            ],
            [
                'title' => 'Corporate Law',
                'slug' => 'corporate-law',
                'short_description' => 'Guiding businesses through legal complexities.',
                'description' => '<p>Corporate law governs business operations, transactions, and governance. We provide comprehensive legal counsel for business formation, contracts, compliance, mergers, and corporate governance.</p>',
                'color_class' => 'bg-blue-950',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 8,
            ],
            [
                'title' => 'Documentation',
                'slug' => 'documentation',
                'short_description' => 'Drafting and reviewing legal documents.',
                'description' => '<p>Legal documentation is crucial for protecting your interests. We provide comprehensive document drafting services for contracts, agreements, wills, trusts, power of attorney, and other legal documents.</p>',
                'color_class' => 'bg-blue-800',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 9,
            ],
        ];

        foreach ($areas as $area) {
            PracticeArea::create($area);
        }
    }
}
