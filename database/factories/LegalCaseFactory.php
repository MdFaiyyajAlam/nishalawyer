<?php

namespace Database\Factories;

use App\Models\LegalCase;
use App\Models\PracticeArea;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LegalCaseFactory extends Factory
{
    protected $model = LegalCase::class;

    public function definition(): array
    {
        $advocate = User::whereHas('role', function ($q) {
            $q->where('slug', 'advocate');
        })->first();

        $client = User::whereHas('role', function ($q) {
            $q->where('slug', 'client');
        })->first();

        return [
            'case_number' => 'CASE-' . now()->format('Y') . '-' . str_pad((string) fake()->unique()->randomNumber(4), 4, '0', STR_PAD_LEFT),
            'title' => fake()->sentence(6),
            'client_id' => $client ? $client->id : User::factory()->create(['role_id' => 3])->id,
            'advocate_id' => $advocate ? $advocate->id : 2,
            'practice_area_id' => PracticeArea::inRandomOrder()->first()?->id,
            'opponent_name' => fake()->name(),
            'opponent_details' => fake()->paragraph(),
            'court_name' => fake()->randomElement(['Supreme Court', 'High Court', 'District Court', 'Sessions Court']),
            'court_case_number' => 'CRL-' . fake()->year() . '-' . fake()->numberBetween(1000, 9999),
            'status' => fake()->randomElement(['pending', 'active', 'settled', 'closed', 'won', 'lost']),
            'priority' => fake()->randomElement(['low', 'medium', 'high', 'urgent']),
            'description' => fake()->paragraph(3),
            'fees' => fake()->randomFloat(2, 5000, 50000),
            'filed_date' => fake()->date(),
            'next_hearing_date' => fake()->date(),
            'remarks' => fake()->sentence(),
            'is_active' => true,
        ];
    }
}