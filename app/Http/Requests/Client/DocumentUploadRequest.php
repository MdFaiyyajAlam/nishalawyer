<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class DocumentUploadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'documents.*' => ['required', 'file', 'mimes:pdf,doc,docx,jpg,jpeg,png,gif,txt', 'max:10240'],
            'case_id' => ['nullable', 'exists:cases,id'],
            'document_type' => ['required', 'string', 'max:50'],
            'description' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Please enter a title for the document.',
            'documents.*.required' => 'Please select a file to upload.',
            'documents.*.mimes' => 'File must be PDF, DOC, DOCX, JPG, PNG, GIF, or TXT.',
            'documents.*.max' => 'File size must not exceed 10MB.',
            'document_type.required' => 'Please select a document type.',
        ];
    }
}