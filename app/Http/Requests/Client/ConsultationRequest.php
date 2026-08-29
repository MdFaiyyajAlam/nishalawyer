<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class ConsultationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'practice_area_id' => ['nullable', 'exists:practice_areas,id'],
            'preferred_contact' => ['required', 'in:email,phone,both'],
            'message' => ['required', 'string', 'min:50', 'max:2000'],
            'preferred_date' => ['nullable', 'date', 'after_or_equal:today'],
            'preferred_time' => ['nullable', 'date_format:H:i'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please enter your full name.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'preferred_contact.required' => 'Please select a preferred contact method.',
            'message.required' => 'Please enter your consultation message.',
            'message.min' => 'Message must be at least 50 characters.',
        ];
    }
}