@extends('layouts.admin')
@section('title', 'Appointment Slots')
@section('header', 'Available Slots')

@section('content')
    <div class="admin-card rounded-xl p-6">
        <h5 class="mb-1">Slots for: {{ $advocate?->full_name ?? 'Advocate' }}</h5>
        <p class="text-muted small mb-4">{{ $slots->count() }} total slots · {{ $slots->where('is_booked', true)->count() }} booked</p>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($slots as $slot)
                        <tr>
                            <td class="fw-semibold">{{ $slot->date->format('D, M d, Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($slot->start_time)->format('h:i A') }} – {{ \Carbon\Carbon::parse($slot->end_time)->format('h:i A') }}</td>
                            <td>
                                <span class="badge status-badge {{ $slot->is_booked ? 'bg-danger' : 'bg-success' }}">{{ $slot->is_booked ? 'Booked' : 'Available' }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="text-center text-muted py-4">No slots defined yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection