<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ReportService;
use Illuminate\Http\Request;

class ReportController extends Controller
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

        return view('admin.reports.index', compact('stats', 'caseStatusData', 'appointmentStatusData'));
    }

    public function cases(Request $request)
    {
        $casesData = $this->reportService->getCaseStatusReport();
        $practiceAreaData = $this->reportService->getPracticeAreaCases();
        $monthlyCases = $this->reportService->getMonthlyCases();

        return view('admin.reports.cases', compact('casesData', 'practiceAreaData', 'monthlyCases'));
    }

    public function appointments(Request $request)
    {
        $appointmentData = $this->reportService->getAppointmentStatusReport();
        $monthlyAppointments = $this->reportService->getMonthlyAppointments();

        return view('admin.reports.appointments', compact('appointmentData', 'monthlyAppointments'));
    }

    public function revenue(Request $request)
    {
        $revenueData = $this->reportService->getCaseStatusReport();
        return view('admin.reports.revenue', compact('revenueData'));
    }
}