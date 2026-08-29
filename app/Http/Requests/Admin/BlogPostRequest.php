<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BlogPostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:blog_posts,slug' . ($this->route('blog_post') ? ",{$this->route('blog_post')->id}" : '')],
            'category_id' => ['nullable', 'exists:blog_categories,id'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'featured_image' => ['nullable', 'image', 'max:2048'],
            'status' => ['required', 'in:draft,published,archived'],
            'is_featured' => ['boolean'],
            'comments_enabled' => ['boolean'],
            'published_at' => ['nullable', 'date'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:255'],
            'meta_keywords' => ['nullable', 'string', 'max:255'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['exists:blog_tags,id'],
        ];

        return $rules;
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Please enter a blog post title.',
            'slug.required' => 'Please enter a slug.',
            'slug.unique' => 'This slug is already in use.',
            'content.required' => 'Please enter the blog post content.',
            'status.required' => 'Please select a status.',
        ];
    }
}