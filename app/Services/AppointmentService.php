<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\AppointmentSlot;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class AppointmentService
{
    public function getUserAppointments(int $userId, int $perPage = 15): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return Appointment::where('client_id', $userId)
            ->orWhere('advocate_id', $userId)
            ->orderByDesc('created_at')
            ->paginate($perPage);
    }

    public function getAvailableSlots(int $advocateId, string $date): Collection
    {
        $slots = AppointmentSlot::where('advocate_id', $advocateId)
            ->where('date', $date)
            ->where('is_booked', false)
            ->orderBy('start_time')
            ->get();

        return $slots;
    }

    public function bookAppointment(array $data, int $clientId): Appointment
    {
        $slot = AppointmentSlot::find($data['slot_id'] ?? null);

        $appointment = Appointment::create([
            'appointment_number' => app(AuthService::class)->generateAppointmentNumber(),
            'client_id' => $clientId,
            'advocate_id' => $slot ? $slot->advocate_id : User::role('advocate')->first()->id,
            'slot_id' => $slot?->id,
            'date' => $data['date'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'type' => $data['type'] ?? 'consultation',
            'reason' => $data['reason'] ?? null,
            'preferred_contact' => $data['preferred_contact'] ?? 'email',
            'status' => 'pending',
        ]);

        if ($slot) {
            $slot->update(['is_booked' => true, 'appointment_id' => $appointment->id]);
        }

        return $appointment;
    }

    public function confirmAppointment(Appointment $appointment): Appointment
    {
        $appointment->update([
            'status' => 'confirmed',
            'confirmed_at' => now(),
        ]);

        if ($appointment->slot) {
            $appointment->slot->update(['is_booked' => true]);
        }

        return $appointment;
    }

    public function cancelAppointment(Appointment $appointment): Appointment
    {
        $appointment->update([
            'status' => 'cancelled',
            'cancelled_at' => now(),
        ]);

        if ($appointment->slot) {
            $appointment->slot->update(['is_booked' => false, 'appointment_id' => null]);
        }

        return $appointment;
    }

    public function completeAppointment(Appointment $appointment): Appointment
    {
        $appointment->update(['status' => 'completed']);
        return $appointment;
    }

    public function getUpcomingAppointments(int $userId): Collection
    {
        return Appointment::where(function ($query) use ($userId) {
            $query->where('client_id', $userId)
                ->orWhere('advocate_id', $userId);
        })
            ->where('date', '>=', now()->toDateString())
            ->whereIn('status', ['pending', 'confirmed'])
            ->orderBy('date')
            ->orderBy('start_time')
            ->get();
    }
}