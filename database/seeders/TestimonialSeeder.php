<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'client_name' => 'Priya Sharma',
                'client_title' => 'Business Owner',
                'content' => 'Advocate Nisha provided exceptional legal counsel during my divorce proceedings. Her attention to detail and unwavering dedication resulted in a favorable settlement. I highly recommend her services.',
                'rating' => 5,
                'is_featured' => true,
                'status' => 'approved',
                'approved_at' => now(),
            ],
            [
                'client_name' => 'Rajesh Kumar',
                'client_title' => 'IT Professional',
                'content' => 'I was falsely accused of a crime and was terrified. Advocate Nisha fought tirelessly for my innocence and got all charges dropped. Her expertise in criminal law is unmatched.',
                'rating' => 5,
                'is_featured' => true,
                'status' => 'approved',
                'approved_at' => now(),
            ],
            [
                'client_name' => 'Meera Patel',
                'client_title' => 'Homemaker',
                'content' => 'During my property dispute, Advocate Nisha was a constant source of support and guidance. She explained every step of the process and won our case with excellent arguments.',
                'rating' => 5,
                'is_featured' => false,
                'status' => 'approved',
                'approved_at' => now(),
            ],
            [
                'client_name' => 'Amit Verma',
                'client_title' => 'Startup Founder',
                'content' => 'Our startup faced a complex contract dispute. Advocate Nisha\'s corporate law expertise helped us negotiate a favorable settlement without going to court. Excellent service!',
                'rating' => 4,
                'is_featured' => true,
                'status' => 'approved',
                'approved_at' => now(),
            ],
            [
                'client_name' => 'Sunita Reddy',
                'client_title' => 'Teacher',
                'content' => 'The consumer court case against a fraudulent company was handled with great professionalism. Advocate Nisha recovered our money and ensured justice was served.',
                'rating' => 5,
                'is_featured' => false,
                'status' => 'approved',
                'approved_at' => now(),
            ],
            [
                'client_name' => 'Vikram Singh',
                'client_title' => 'Journalist',
                'content' => 'When I faced cyber threats and online harassment, Advocate Nisha understood the urgency and got immediate protection orders. She truly cares about her clients.',
                'rating' => 4,
                'is_featured' => false,
                'status' => 'approved',
                'approved_at' => now(),
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}