<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\PracticeArea;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $familyLaw = PracticeArea::where('slug', 'family-law')->first();
        $divorceLaw = PracticeArea::where('slug', 'divorce-law')->first();
        $criminalLaw = PracticeArea::where('slug', 'criminal-law')->first();
        $civilLaw = PracticeArea::where('slug', 'civil-law')->first();
        $propertyDisputes = PracticeArea::where('slug', 'property-disputes')->first();

        $faqs = [
            [
                'question' => 'How long does a divorce case typically take?',
                'answer' => 'The duration of a divorce case depends on various factors including the complexity of assets, custody disputes, and court scheduling. Uncontested divorces can be resolved in 3-6 months, while contested cases may take 1-3 years or more.',
                'practice_area_id' => $divorceLaw ? $divorceLaw->id : null,
                'sort_order' => 1,
                'status' => 'active',
            ],
            [
                'question' => 'What documents are needed for a divorce?',
                'answer' => 'Required documents typically include marriage certificate, proof of income, asset statements, debt documents, and identification. The specific requirements may vary based on jurisdiction and case complexity.',
                'practice_area_id' => $divorceLaw ? $divorceLaw->id : null,
                'sort_order' => 2,
                'status' => 'active',
            ],
            [
                'question' => 'How much does it cost to hire a lawyer?',
                'answer' => 'Legal fees vary based on case complexity, duration, and the lawyer\'s experience. We offer transparent pricing with flat fees for most services and payment plans for complex cases.',
                'practice_area_id' => $familyLaw ? $familyLaw->id : null,
                'sort_order' => 3,
                'status' => 'active',
            ],
            [
                'question' => 'What should I do if I am accused of a crime?',
                'answer' => 'If you are accused of a crime, exercise your right to remain silent and contact an experienced criminal defense attorney immediately. Do not speak to law enforcement without your lawyer present.',
                'practice_area_id' => $criminalLaw ? $criminalLaw->id : null,
                'sort_order' => 4,
                'status' => 'active',
            ],
            [
                'question' => 'How can I protect my property during a divorce?',
                'answer' => 'Property division in divorce depends on whether your state follows equitable distribution or community property laws. A prenuptial agreement or careful legal strategy can help protect your assets.',
                'practice_area_id' => $propertyDisputes ? $propertyDisputes->id : null,
                'sort_order' => 5,
                'status' => 'active',
            ],
            [
                'question' => 'What is the difference between civil and criminal law?',
                'answer' => 'Civil law deals with disputes between individuals or organizations, typically involving monetary damages. Criminal law involves offenses against the state or society, with penalties including fines or imprisonment.',
                'practice_area_id' => $civilLaw ? $civilLaw->id : null,
                'sort_order' => 6,
                'status' => 'active',
            ],
            [
                'question' => 'How do I prepare for my initial consultation?',
                'answer' => 'Gather all relevant documents including contracts, correspondence, identification, and any court notices. Write down your questions and concerns beforehand to make the most of your consultation time.',
                'practice_area_id' => null,
                'sort_order' => 7,
                'status' => 'active',
            ],
            [
                'question' => 'Do you offer weekend or evening consultations?',
                'answer' => 'Yes, we offer flexible consultation scheduling including evenings and weekends by appointment. Contact us to discuss available time slots.',
                'practice_area_id' => null,
                'sort_order' => 8,
                'status' => 'active',
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}