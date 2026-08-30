@extends('layouts.admin')
@section('title', 'Appointments')
@section('header', 'Appointment Management')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-auto-hide d-flex align-items-center">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="admin-card rounded-xl p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4">
            <h5 class="font-display font-bold text-primary mb-0">All Appointments</h5>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.appointments.calendar') }}" class="btn btn-outline-primary"><i class="bi bi-calendar3 me-1"></i> Calendar View</a>
                <a href="{{ route('admin.appointments.slots') }}" class="btn btn-outline-primary"><i class="bi bi-clock me-1"></i> Manage Slots</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Appointment</th>
                        <th>Client</th>
                        <th>Advocate</th>
                        <th>Date &amp; Time</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($appointments as $apt)
                        <tr>
                            <td>
                                <span class="fw-semibold">{{ $apt->appointment_number }}</span>
                            </td>
                            <td>{{ $apt->client?->full_name ?? '—' }}</td>
                            <td>{{ $apt->advocate?->full_name ?? '—' }}</td>
                            <td>
                                {{ \Illuminate\Support\Carbon::parse($apt->date)->format('M d, Y') }}
                                <div><small class="text-muted">{{ \Illuminate\Support\Carbon::parse($apt->start_time)->format('H:i') }} – {{ \Illuminate\Support\Carbon::parse($apt->end_time)->format('H:i') }}</small></div>
                            </td>
                            <td>{{ ucfirst($apt->type) }}</td>
                            <td>
                                <span class="badge status-badge {{ ['pending'=>'bg-warning','confirmed'=>'bg-success','completed'=>'bg-primary','cancelled'=>'bg-secondary','rejected'=>'bg-danger'][$apt->status] ?? 'bg-secondary' }}">
                                    {{ ucfirst($apt->status) }}
                                </span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.appointments.show', $apt) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center text-muted py-4">No appointments found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">{{ $appointments->links() }}</div>
    </div>
@endsection