<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\LegalCase;
use App\Models\Contact;
use App\Models\Testimonial;
use App\Models\User;

class ReportService
{
    public function getDashboardStats(): array
    {
        return [
            'total_clients' => User::whereHas('role', function ($q) {
                $q->where('slug', 'client');
            })->count(),
            'total_cases' => LegalCase::count(),
            'active_cases' => LegalCase::where('status', 'active')->count(),
            'completed_cases' => LegalCase::where('status', 'closed')->count(),
            'total_appointments' => Appointment::count(),
            'pending_appointments' => Appointment::where('status', 'pending')->count(),
            'total_contacts' => Contact::count(),
            'unread_contacts' => Contact::where('status', 'new')->count(),
            'total_revenue' => LegalCase::sum('fees'),
        ];
    }

    public function getCaseStatusReport(): array
    {
        return LegalCase::select('status', \DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();
    }

    public function getAppointmentStatusReport(): array
    {
        return Appointment::select('status', \DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();
    }

    public function getMonthlyCases(): array
    {
        return LegalCase::select(\DB::raw('MONTH(created_at) as month'), \DB::raw('count(*) as count'))
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();
    }

    public function getMonthlyAppointments(): array
    {
        return Appointment::select(\DB::raw('MONTH(date) as month'), \DB::raw('count(*) as count'))
            ->whereYear('date', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();
    }

    public function getPracticeAreaCases(): array
    {
        return LegalCase::join('practice_areas', 'cases.practice_area_id', '=', 'practice_areas.id')
            ->select('practice_areas.title', \DB::raw('count(*) as count'))
            ->groupBy('practice_areas.id', 'practice_areas.title')
            ->pluck('count', 'title')
            ->toArray();
    }
}