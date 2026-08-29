<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CaseResource;
use App\Models\LegalCase;
use Illuminate\Http\Request;

class CaseApiController extends Controller
{
    public function index(Request $request)
    {
        $cases = LegalCase::where('client_id', $request->user()->id)
            ->with(['practiceArea', 'client'])
            ->paginate(15);

        return CaseResource::collection($cases);
    }

    public function show(Request $request, LegalCase $case)
    {
        $this->authorize('view-case', $case);

        $case->load(['practiceArea', 'client', 'advocate', 'documents']);

        return new CaseResource($case);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'practice_area_id' => ['nullable', 'exists:practice_areas,id'],
            'opponent_name' => ['nullable', 'string', 'max:255'],
            'court_name' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        $case = LegalCase::create(array_merge($validated, [
            'case_number' => app(\App\Services\AuthService::class)->generateCaseNumber(),
            'client_id' => $request->user()->id,
            'advocate_id' => \App\Models\User::whereHas('role', function ($q) {
                $q->where('slug', 'advocate');
            })->first()->id,
            'status' => 'pending',
        ]));

        return new CaseResource($case);
    }

    public function update(Request $request, LegalCase $case)
    {
        $this->authorize('update', $case);

        $validated = $request->validate([
            'title' => ['sometimes', 'string', 'max:255'],
            'opponent_name' => ['sometimes', 'string', 'max:255'],
            'court_name' => ['sometimes', 'string', 'max:255'],
            'status' => ['sometimes', 'in:pending,active,dismissed,settled,closed,won,lost'],
            'priority' => ['sometimes', 'in:low,medium,high,urgent'],
            'description' => ['sometimes', 'string'],
            'remarks' => ['sometimes', 'string'],
            'next_hearing_date' => ['sometimes', 'date'],
        ]);

        $case->update($validated);

        return new CaseResource($case);
    }

    public function destroy(Request $request, LegalCase $case)
    {
        $this->authorize('delete', $case);

        $case->delete();

        return response()->json(['message' => 'Case deleted successfully']);
    }
}