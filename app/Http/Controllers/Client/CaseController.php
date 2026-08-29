<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\LegalCase;
use App\Models\CaseDocument;
use Illuminate\Http\Request;

class CaseController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $cases = LegalCase::where('client_id', $user->id)
            ->orderByDesc('created_at')
            ->get();

        return view('client.cases.index', compact('cases'));
    }

    public function show(LegalCase $case)
    {
        $this->authorize('view', $case);

        $case->load(['practiceArea', 'documents', 'legalNotices']);

        return view('client.cases.show', compact('case'));
    }

    public function documents(LegalCase $case)
    {
        $this->authorize('view', $case);

        $documents = $case->documents()
            ->where('is_shared_with_client', true)
            ->orderByDesc('created_at')
            ->get();

        return view('client.cases.documents', compact('case', 'documents'));
    }
}