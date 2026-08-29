<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\AppointmentRequest;
use App\Models\Appointment;
use App\Models\AppointmentSlot;
use App\Models\User;
use App\Services\AppointmentService;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    protected AppointmentService $appointmentService;

    public function __construct(AppointmentService $appointmentService)
    {
        $this->appointmentService = $appointmentService;
    }

    public function index()
    {
        $user = auth()->user();

        $appointments = Appointment::where('client_id', $user->id)
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('client.appointments.index', compact('appointments'));
    }

    public function create()
    {
        $user = auth()->user();
        $advocate = User::whereHas('role', function ($q) {
            $q->where('slug', 'advocate');
        })->first();

        $availableDates = AppointmentSlot::where('advocate_id', $advocate->id)
            ->where('is_booked', false)
            ->where('date', '>=', now()->toDateString())
            ->select('date')
            ->distinct()
            ->orderBy('date')
            ->limit(30)
            ->pluck('date');

        return view('client.appointments.create', compact('advocate', 'availableDates'));
    }

    public function store(AppointmentRequest $request, AuthService $authService)
    {
        $user = auth()->user();

        $advocate = User::whereHas('role', function ($q) {
            $q->where('slug', 'advocate');
        })->first();

        $appointment = Appointment::create([
            'appointment_number' => $authService->generateAppointmentNumber(),
            'client_id' => $user->id,
            'advocate_id' => $advocate->id,
            'date' => $request->input('date'),
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time'),
            'type' => $request->input('type', 'consultation'),
            'reason' => $request->input('reason'),
            'preferred_contact' => $request->input('preferred_contact'),
            'status' => 'pending',
        ]);

        return redirect()
            ->route('client.appointments.index')
            ->with('success', 'Appointment request submitted successfully! We will confirm your booking shortly.');
    }

    public function show(Appointment $appointment)
    {
        $this->authorize('view', $appointment);

        return view('client.appointments.show', compact('appointment'));
    }

    public function cancel(Appointment $appointment)
    {
        $this->authorize('cancel', $appointment);

        $this->appointmentService->cancelAppointment($appointment);

        return back()->with('success', 'Appointment has been cancelled.');
    }
}