@extends('layouts.client')
@section('title', 'My Appointments')
@section('header', 'My Appointments')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-auto-hide d-flex align-items-center">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="client-card rounded-xl p-6">
        <div class="flex items-center justify-between mb-4">
            <h5 class="font-display font-bold text-primary mb-0">Appointment History</h5>
            <a href="{{ route('client.appointments.create') }}" class="btn btn-primary"><i class="bi bi-calendar-plus me-1"></i> Book Appointment</a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Appointment</th>
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
                                @if ($apt->reason)
                                    <div><small class="text-muted">{{ \Illuminate\Support\Str::limit($apt->reason, 50) }}</small></div>
                                @endif
                            </td>
                            <td>
                                {{ \Illuminate\Support\Carbon::parse($apt->date)->format('M d, Y') }}
                                <div><small class="text-muted">{{ \Illuminate\Support\Carbon::parse($apt->start_time)->format('H:i') }} – {{ \Illuminate\Support\Carbon::parse($apt->end_time)->format('H:i') }}</small></div>
                            </td>
                            <td>{{ ucfirst($apt->type) }}</td>
                            <td>
                                <span class="status-badge {{ ['pending'=>'bg-warning','confirmed'=>'bg-success','completed'=>'bg-primary','cancelled'=>'bg-secondary','rejected'=>'bg-danger'][$apt->status] ?? 'bg-secondary' }} text-white">
                                    {{ ucfirst($apt->status) }}
                                </span>
                            </td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-1">
                                    <a href="{{ route('client.appointments.show', $apt) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
                                    @if (in_array($apt->status, ['pending', 'confirmed']))
                                        <form method="POST" action="{{ route('client.appointments.cancel', $apt) }}" class="d-inline" onsubmit="return confirm('Cancel this appointment?')">
                                            @csrf
                                            <button class="btn btn-sm btn-outline-danger" title="Cancel"><i class="bi bi-x-circle"></i></button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">No appointments yet. <a href="{{ route('client.appointments.create') }}">Book your first appointment</a>.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">{{ $appointments->links() }}</div>
    </div>
@endsection