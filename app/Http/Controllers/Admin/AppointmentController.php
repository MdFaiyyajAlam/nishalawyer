<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\AppointmentSlot;
use App\Models\User;
use App\Services\AppointmentService;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    protected AppointmentService $appointmentService;

    public function __construct(AppointmentService $appointmentService)
    {
        $this->appointmentService = $appointmentService;
    }

    public function index(Request $request)
    {
        $query = Appointment::with(['client', 'advocate']);

        if ($request->filled('status')) {
            $query->where('status', $request->get('status'));
        }

        if ($request->filled('date_from') && $request->filled('date_to')) {
            $query->whereBetween('date', [$request->get('date_from'), $request->get('date_to')]);
        }

        $appointments = $query->orderByDesc('created_at')->paginate(15);

        return view('admin.appointments.index', compact('appointments'));
    }

    public function calendar()
    {
        $appointments = Appointment::whereIn('status', ['pending', 'confirmed'])
            ->where('date', '>=', now()->subMonths(2)->toDateString())
            ->where('date', '<=', now()->addMonths(3)->toDateString())
            ->get(['id', 'appointment_number', 'type', 'date', 'start_time', 'end_time', 'status']);

        $events = $appointments->map(function ($a) {
            return [
                'id' => $a->id,
                'title' => $a->appointment_number . ($a->type ? ' · ' . $a->type : ''),
                'start' => $a->date->toDateString() . 'T' . $a->start_time,
                'end' => $a->date->toDateString() . 'T' . $a->end_time,
                'color' => $a->status === 'confirmed' ? '#1d4ed8' : ($a->status === 'pending' ? '#d97706' : '#16a34a'),
            ];
        })->all();

        return view('admin.appointments.calendar', compact('appointments', 'events'));
    }

    public function show(Appointment $appointment)
    {
        $appointment->load(['client', 'advocate', 'slot']);
        return view('admin.appointments.show', compact('appointment'));
    }

    public function updateStatus(Request $request, Appointment $appointment)
    {
        $status = $request->input('status');
        $notes = $request->input('admin_notes');

        if ($status === 'confirmed') {
            $this->appointmentService->confirmAppointment($appointment);
        } elseif ($status === 'cancelled') {
            $this->appointmentService->cancelAppointment($appointment);
        } elseif ($status === 'completed') {
            $this->appointmentService->completeAppointment($appointment);
        } elseif ($status === 'rejected') {
            $appointment->update(['status' => 'rejected']);
        }

        if ($notes) {
            $appointment->update(['admin_notes' => $notes]);
        }

        return back()->with('success', 'Appointment status updated!');
    }

    public function slots()
    {
        $advocate = User::whereHas('role', function ($q) {
            $q->where('slug', 'advocate');
        })->first();

        $slots = AppointmentSlot::where('advocate_id', $advocate->id)
            ->orderBy('date')
            ->get();

        return view('admin.appointments.slots', compact('slots', 'advocate'));
    }
}