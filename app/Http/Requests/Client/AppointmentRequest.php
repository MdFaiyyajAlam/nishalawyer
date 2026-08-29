<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AppointmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'date' => ['required', 'date', 'after_or_equal:today'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
            'type' => ['required', 'string', 'max:50'],
            'reason' => ['nullable', 'string', 'max:500'],
            'preferred_contact' => ['required', 'in:email,phone,both'],
        ];
    }

    public function messages(): array
    {
        return [
            'date.required' => 'Please select a date for your appointment.',
            'date.after_or_equal' => 'Appointment date cannot be in the past.',
            'start_time.required' => 'Please select a start time.',
            'end_time.after' => 'End time must be after start time.',
            'type.required' => 'Please select an appointment type.',
            'preferred_contact.required' => 'Please select a preferred contact method.',
        ];
    }
}