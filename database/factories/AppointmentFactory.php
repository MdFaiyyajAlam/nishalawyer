<?php

namespace Database\Factories;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    protected $model = Appointment::class;

    public function definition(): array
    {
        return [
            'appointment_number' => 'APT-' . now()->format('Y') . '-' . str_pad((string) fake()->unique()->randomNumber(4), 4, '0', STR_PAD_LEFT),
            'client_id' => \App\Models\User::whereHas('role', function ($q) {
                $q->where('slug', 'client');
            })->first()?->id ?? 3,
            'advocate_id' => \App\Models\User::whereHas('role', function ($q) {
                $q->where('slug', 'advocate');
            })->first()?->id ?? 2,
            'date' => fake()->date(),
            'start_time' => '09:00:00',
            'end_time' => '10:00:00',
            'type' => fake()->randomElement(['consultation', 'hearing', 'meeting', 'review']),
            'reason' => fake()->sentence(10),
            'preferred_contact' => fake()->randomElement(['email', 'phone', 'both']),
            'status' => fake()->randomElement(['pending', 'confirmed', 'completed']),
        ];
    }
}