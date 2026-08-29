<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CaseUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $caseId = $this->route('case');

        return [
            'case_number' => ['required', 'string', 'max:50', 'unique:cases,case_number' . ($caseId ? ",{$caseId->id}" : '')],
            'title' => ['required', 'string', 'max:255'],
            'client_id' => ['required', 'exists:users,id'],
            'practice_area_id' => ['nullable', 'exists:practice_areas,id'],
            'opponent_name' => ['nullable', 'string', 'max:255'],
            'opponent_details' => ['nullable', 'string'],
            'court_name' => ['nullable', 'string', 'max:255'],
            'court_case_number' => ['nullable', 'string', 'max:100'],
            'status' => ['required', 'in:pending,active,dismissed,settled,closed,won,lost'],
            'priority' => ['required', 'in:low,medium,high,urgent'],
            'fees' => ['nullable', 'numeric', 'min:0'],
            'filed_date' => ['nullable', 'date'],
            'next_hearing_date' => ['nullable', 'date'],
            'description' => ['nullable', 'string'],
            'remarks' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'case_number.required' => 'Please enter a case number.',
            'title.required' => 'Please enter a case title.',
            'client_id.required' => 'Please select a client.',
            'status.required' => 'Please select a case status.',
            'priority.required' => 'Please select a priority level.',
        ];
    }
}