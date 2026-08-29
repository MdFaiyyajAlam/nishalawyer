<?php

namespace Database\Factories;

use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestimonialFactory extends Factory
{
    protected $model = Testimonial::class;

    public function definition(): array
    {
        return [
            'client_name' => fake()->name(),
            'client_title' => fake()->jobTitle(),
            'content' => fake()->paragraph(3),
            'rating' => fake()->numberBetween(4, 5),
            'status' => 'approved',
            'is_featured' => fake()->boolean(30),
            'approved_at' => now(),
        ];
    }
}