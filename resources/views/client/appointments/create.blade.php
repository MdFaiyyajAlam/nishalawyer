@extends('layouts.client')
@section('title', 'Book Appointment')
@section('header', 'Book an Appointment')

@section('content')
    <div class="client-card rounded-xl p-6 max-w-2xl">
        @if ($errors->any())
            <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
        @endif

        @if ($availableDates->isEmpty())
            <div class="alert alert-info">
                <i class="bi bi-info-circle me-2"></i>No slots available right now. Please check back later.
            </div>
        @endif

        <form method="POST" action="{{ route('client.appointments.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Advocate</label>
                <input type="text" class="form-control" value="{{ $advocate?->full_name ?? 'Advocate' }}" disabled>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Date *</label>
                    <input type="date" name="date" min="{{ now()->toDateString() }}" value="{{ old('date') }}" class="form-control" required>
                    @if ($availableDates->isNotEmpty())
                        <small class="text-muted">Available dates: {{ $availableDates->map(fn ($d) => \Illuminate\Support\Carbon::parse($d)->format('M d'))->implode(', ') }}</small>
                    @endif
                </div>
                <div class="col-md-3">
                    <label class="form-label">Start Time *</label>
                    <input type="time" name="start_time" value="{{ old('start_time') }}" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">End Time *</label>
                    <input type="time" name="end_time" value="{{ old('end_time') }}" class="form-control" required>
                </div>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Appointment Type *</label>
                    <select name="type" class="form-select" required>
                        @foreach (['consultation', 'case_discussion', 'document_review', 'follow_up'] as $type)
                            <option value="{{ $type }}" {{ old('type') === $type ? 'selected' : '' }}>{{ ucfirst(str_replace('_', ' ', $type)) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Preferred Contact *</label>
                    <select name="preferred_contact" class="form-select" required>
                        @foreach (['email', 'phone', 'both'] as $c)
                            <option value="{{ $c }}" {{ old('preferred_contact') === $c ? 'selected' : '' }}>{{ ucfirst($c) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Reason / Details</label>
                <textarea name="reason" rows="4" class="form-control" maxlength="500" placeholder="Briefly describe your matter...">{{ old('reason') }}</textarea>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-primary"><i class="bi bi-calendar-check me-1"></i> Request Appointment</button>
                <a href="{{ route('client.appointments.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection