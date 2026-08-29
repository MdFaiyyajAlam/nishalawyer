<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CaseStoreRequest;
use App\Http\Requests\Admin\CaseUpdateRequest;
use App\Models\LegalCase;
use App\Models\PracticeArea;
use App\Models\User;
use App\Services\CaseService;
use Illuminate\Http\Request;

class CaseController extends Controller
{
    protected CaseService $caseService;

    public function __construct(CaseService $caseService)
    {
        $this->caseService = $caseService;
    }

    public function index(Request $request)
    {
        $query = LegalCase::with(['client', 'advocate', 'practiceArea']);

        if ($request->filled('status')) {
            $query->where('status', $request->get('status'));
        }

        if ($request->filled('priority')) {
            $query->where('priority', $request->get('priority'));
        }

        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('case_number', 'like', "%{$search}%")
                    ->orWhere('title', 'like', "%{$search}%")
                    ->orWhere('court_name', 'like', "%{$search}%");
            });
        }

        $cases = $query->orderByDesc('created_at')->paginate(15);

        return view('admin.cases.index', compact('cases'));
    }

    public function create()
    {
        $clients = User::whereHas('role', function ($q) {
            $q->where('slug', 'client');
        })->get();

        $practiceAreas = PracticeArea::where('is_active', true)->get();

        return view('admin.cases.create', compact('clients', 'practiceAreas'));
    }

    public function store(CaseStoreRequest $request)
    {
        $advocate = User::whereHas('role', function ($q) {
            $q->where('slug', 'advocate');
        })->first();

        $this->caseService->createCase($request->validated(), $advocate->id);

        return redirect()->route('admin.cases.index')
            ->with('success', 'Case created successfully!');
    }

    public function show(LegalCase $case)
    {
        $case->load(['client', 'advocate', 'practiceArea', 'documents']);
        return view('admin.cases.show', compact('case'));
    }

    public function edit(LegalCase $case)
    {
        $clients = User::whereHas('role', function ($q) {
            $q->where('slug', 'client');
        })->get();

        $practiceAreas = PracticeArea::where('is_active', true)->get();

        return view('admin.cases.edit', compact('case', 'clients', 'practiceAreas'));
    }

    public function update(CaseUpdateRequest $request, LegalCase $case)
    {
        $this->caseService->updateCase($case, $request->validated());

        return redirect()->route('admin.cases.index')
            ->with('success', 'Case updated successfully!');
    }

    public function destroy(LegalCase $case)
    {
        $case->delete();

        return back()->with('success', 'Case deleted successfully!');
    }

    public function close(LegalCase $case)
    {
        $this->caseService->closeCase($case);

        return back()->with('success', 'Case closed successfully!');
    }
}