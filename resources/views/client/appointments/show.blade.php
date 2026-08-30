@extends('layouts.client')
@section('title', 'Appointment Details')
@section('header', 'Appointment — ' . $appointment->appointment_number)

@section('content')
    <div class="client-card rounded-xl p-6 max-w-2xl">
        <div class="flex items-center justify-between mb-4">
            <h4 class="font-display font-bold text-primary mb-0">{{ $appointment->appointment_number }}</h4>
            <span class="status-badge {{ ['pending'=>'bg-warning','confirmed'=>'bg-success','completed'=>'bg-primary','cancelled'=>'bg-secondary','rejected'=>'bg-danger'][$appointment->status] ?? 'bg-secondary' }} text-white">
                {{ ucfirst($appointment->status) }}
            </span>
        </div>

        <dl class="row">
            <dt class="col-sm-4">Advocate</dt>
            <dd class="col-sm-8">{{ $appointment->advocate?->full_name ?? '—' }}</dd>
            <dt class="col-sm-4">Date</dt>
            <dd class="col-sm-8">{{ \Illuminate\Support\Carbon::parse($appointment->date)->format('l, M d, Y') }}</dd>
            <dt class="col-sm-4">Time</dt>
            <dd class="col-sm-8">{{ \Illuminate\Support\Carbon::parse($appointment->start_time)->format('H:i') }} – {{ \Illuminate\Support\Carbon::parse($appointment->end_time)->format('H:i') }}</dd>
            <dt class="col-sm-4">Type</dt>
            <dd class="col-sm-8">{{ ucfirst($appointment->type) }}</dd>
            <dt class="col-sm-4">Preferred Contact</dt>
            <dd class="col-sm-8">{{ ucfirst($appointment->preferred_contact) }}</dd>
            <dt class="col-sm-4">Reason</dt>
            <dd class="col-sm-8">{{ $appointment->reason ?? '—' }}</dd>
            @if ($appointment->admin_notes)
                <dt class="col-sm-4">Notes</dt>
                <dd class="col-sm-8">{{ $appointment->admin_notes }}</dd>
            @endif
            <dt class="col-sm-4">Requested On</dt>
            <dd class="col-sm-8">{{ $appointment->created_at->format('M d, Y H:i') }}</dd>
        </dl>

        <div class="d-flex gap-2 mt-4">
            <a href="{{ route('client.appointments.index') }}" class="btn btn-outline-secondary">Back</a>
            @if (in_array($appointment->status, ['pending', 'confirmed']))
                <form method="POST" action="{{ route('client.appointments.cancel', $appointment) }}" onsubmit="return confirm('Cancel this appointment?')">
                    @csrf
                    <button class="btn btn-outline-danger"><i class="bi bi-x-circle me-1"></i> Cancel Appointment</button>
                </form>
            @endif
        </div>
    </div>
@endsection