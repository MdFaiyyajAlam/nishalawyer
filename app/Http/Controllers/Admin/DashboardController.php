<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $stats = $this->reportService->getDashboardStats();
        $caseStatusData = $this->reportService->getCaseStatusReport();
        $appointmentStatusData = $this->reportService->getAppointmentStatusReport();
        $monthlyCases = $this->reportService->getMonthlyCases();
        $monthlyAppointments = $this->reportService->getMonthlyAppointments();
        $practiceAreaCases = $this->reportService->getPracticeAreaCases();

        return view('admin.dashboard', compact(
            'stats',
            'caseStatusData',
            'appointmentStatusData',
            'monthlyCases',
            'monthlyAppointments',
            'practiceAreaCases'
        ));
    }
}