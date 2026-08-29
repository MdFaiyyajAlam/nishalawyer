<?php

namespace App\Services;

use App\Http\Requests\Admin\CaseStoreRequest;
use App\Models\LegalCase;
use App\Models\User;

class CaseService
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function createCase(array $data, int $advocateId): LegalCase
    {
        $caseData = $data;
        $caseData['case_number'] = $this->authService->generateCaseNumber();
        $caseData['advocate_id'] = $advocateId;

        return LegalCase::create($caseData);
    }

    public function updateCase(LegalCase $case, array $data): LegalCase
    {
        $case->update($data);
        return $case;
    }

    public function closeCase(LegalCase $case): LegalCase
    {
        $case->update(['status' => 'closed', 'is_active' => false]);
        return $case;
    }

    public function getClientCases(int $clientId): \Illuminate\Database\Eloquent\Collection
    {
        return LegalCase::where('client_id', $clientId)
            ->orderByDesc('created_at')
            ->get();
    }

    public function getAdvocateCases(int $advocateId): \Illuminate\Database\Eloquent\Collection
    {
        return LegalCase::where('advocate_id', $advocateId)
            ->orderByDesc('created_at')
            ->get();
    }

    public function getCasesByStatus(string $status, int $userId): \Illuminate\Database\Eloquent\Collection
    {
        return LegalCase::where('advocate_id', $userId)
            ->where('status', $status)
            ->orderByDesc('created_at')
            ->get();
    }

    public function searchCases(int $userId, string $search): \Illuminate\Database\Eloquent\Collection
    {
        return LegalCase::where('advocate_id', $userId)
            ->where(function ($query) use ($search) {
                $query->where('case_number', 'like', "%{$search}%")
                    ->orWhere('title', 'like', "%{$search}%")
                    ->orWhere('court_name', 'like', "%{$search}%");
            })
            ->orderByDesc('created_at')
            ->get();
    }
}