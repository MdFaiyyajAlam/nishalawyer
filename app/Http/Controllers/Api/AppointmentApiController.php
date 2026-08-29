<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentApiController extends Controller
{
    public function index(Request $request)
    {
        $appointments = Appointment::where('client_id', $request->user()->id)
            ->orWhere('advocate_id', $request->user()->id)
            ->with(['client', 'advocate'])
            ->paginate(15);

        return AppointmentResource::collection($appointments);
    }

    public function show(Request $request, Appointment $appointment)
    {
        $this->authorize('view', $appointment);
        $appointment->load(['client', 'advocate', 'slot']);

        return new AppointmentResource($appointment);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => ['required', 'date'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i'],
            'type' => ['required', 'string'],
            'reason' => ['nullable', 'string'],
            'preferred_contact' => ['required', 'in:email,phone,both'],
        ]);

        $advocate = \App\Models\User::whereHas('role', function ($q) {
            $q->where('slug', 'advocate');
        })->first();

        $appointment = Appointment::create(array_merge($validated, [
            'appointment_number' => app(\App\Services\AuthService::class)->generateAppointmentNumber(),
            'client_id' => $request->user()->id,
            'advocate_id' => $advocate->id,
            'status' => 'pending',
        ]));

        return new AppointmentResource($appointment);
    }

    public function update(Request $request, Appointment $appointment)
    {
        $this->authorize('update', $appointment);

        $validated = $request->validate([
            'status' => ['sometimes', 'in:pending,confirmed,cancelled,completed,rejected'],
            'reason' => ['sometimes', 'string'],
            'preferred_contact' => ['sometimes', 'in:email,phone,both'],
        ]);

        $appointment->update($validated);

        return new AppointmentResource($appointment);
    }
}