<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\LegalCase;
use App\Models\Testimonial;
use App\Services\ReportService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected ReportService $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function index()
    {
        $user = auth()->user();

        $stats = [
            'total_cases' => $user->cases()->count(),
            'active_cases' => $user->cases()->where('status', 'active')->count(),
            'total_appointments' => Appointment::where('client_id', $user->id)->count(),
            'upcoming_appointments' => Appointment::where('client_id', $user->id)
                ->where('date', '>=', now()->toDateString())
                ->whereIn('status', ['pending', 'confirmed'])
                ->count(),
            'pending_appointments' => Appointment::where('client_id', $user->id)
                ->where('status', 'pending')
                ->count(),
        ];

        $recentCases = $user->cases()->latest()->limit(5)->get();
        $upcomingAppointments = Appointment::where('client_id', $user->id)
            ->where('date', '>=', now()->toDateString())
            ->whereIn('status', ['pending', 'confirmed'])
            ->orderBy('date')
            ->orderBy('start_time')
            ->limit(5)
            ->get();

        $unreadNotifications = $user->unreadNotifications()->limit(5)->get();

        return view('client.dashboard', compact('stats', 'recentCases', 'upcomingAppointments', 'unreadNotifications'));
    }
}