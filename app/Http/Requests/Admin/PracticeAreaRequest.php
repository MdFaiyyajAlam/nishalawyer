<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PracticeAreaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:100'],
            'slug' => ['required', 'string', 'max:100', 'unique:practice_areas,slug' . ($this->route('practice_area') ? ",{$this->route('practice_area')->id}" : '')],
            'short_description' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'icon' => ['nullable', 'string', 'max:50'],
            'image' => ['nullable', 'image', 'max:2048'],
            'color_class' => ['nullable', 'string', 'max:50'],
            'is_featured' => ['boolean'],
            'is_active' => ['boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Please enter the practice area title.',
            'slug.required' => 'Please enter a slug for the practice area.',
            'slug.unique' => 'This slug is already in use.',
            'short_description.required' => 'Please enter a short description.',
            'description.required' => 'Please enter a detailed description.',
        ];
    }
}