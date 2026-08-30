@extends('layouts.admin')
@section('title', 'Appointment Details')
@section('header', 'Appointment — ' . $appointment->appointment_number)

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-auto-hide d-flex align-items-center">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="admin-card rounded-xl p-6 max-w-3xl">
        <div class="flex items-center justify-between mb-4">
            <h4 class="font-display font-bold text-primary mb-0">{{ $appointment->appointment_number }}</h4>
            <span class="badge status-badge {{ ['pending'=>'bg-warning','confirmed'=>'bg-success','completed'=>'bg-primary','cancelled'=>'bg-secondary','rejected'=>'bg-danger'][$appointment->status] ?? 'bg-secondary' }}">
                {{ ucfirst($appointment->status) }}
            </span>
        </div>

        <dl class="row">
            <dt class="col-sm-4">Client</dt>
            <dd class="col-sm-8">{{ $appointment->client?->full_name ?? '—' }} <small class="text-muted">({{ $appointment->client?->email }})</small></dd>
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
            <dt class="col-sm-4">Requested On</dt>
            <dd class="col-sm-8">{{ $appointment->created_at->format('M d, Y H:i') }}</dd>
        </dl>

        <div class="mt-4 pt-3 border-top">
            <h5 class="font-display font-bold text-primary mb-3">Actions</h5>
            <form method="POST" action="{{ route('admin.appointments.update-status', $appointment) }}" class="d-flex gap-2 align-items-end flex-wrap">
                @csrf
                <div>
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        @foreach (['pending','confirmed','completed','cancelled','rejected'] as $st)
                            <option value="{{ $st }}" {{ $appointment->status === $st ? 'selected' : '' }}>{{ ucfirst($st) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex-grow-1 min-w-[200px]">
                    <label class="form-label">Admin Notes</label>
                    <input type="text" name="admin_notes" value="{{ $appointment->admin_notes }}" class="form-control">
                </div>
                <button class="btn btn-primary"><i class="bi bi-check2 me-1"></i> Update</button>
            </form>
        </div>
    </div>
@endsection