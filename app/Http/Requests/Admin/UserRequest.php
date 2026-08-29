<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    public function rules(): array
    {
        $userId = $this->route('user');

        $rules = [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email' . ($userId ? ",{$userId->id}" : '')],
            'phone' => ['nullable', 'string', 'max:20'],
            'role_id' => ['required', 'exists:roles,id'],
            'is_active' => ['boolean'],
        ];

        if (! $userId || $this->isMethod('post')) {
            $rules['password'] = ['required', 'confirmed', 'min:8'];
        } else {
            $rules['password'] = ['nullable', 'confirmed', 'min:8'];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'Please enter the user\'s first name.',
            'last_name.required' => 'Please enter the user\'s last name.',
            'email.required' => 'Please enter the user\'s email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already in use.',
            'role_id.required' => 'Please select a user role.',
            'password.required' => 'Please enter a password.',
            'password.min' => 'Password must be at least 8 characters.',
        ];
    }
}