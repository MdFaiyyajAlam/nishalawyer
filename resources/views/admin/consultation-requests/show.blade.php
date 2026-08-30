@extends('layouts.admin')
@section('title', 'Consultation Request')
@section('header', 'Consultation Request')

@section('content')
    <div class="admin-card rounded-xl p-6 max-w-2xl">
        <div class="d-flex justify-content-between align-items-start mb-4">
            <h4 class="font-display font-bold text-primary mb-0">{{ $request->name }}</h4>
            <span class="badge status-badge {{ ['new'=>'bg-danger','in_progress'=>'bg-warning','scheduled'=>'bg-primary','closed'=>'bg-success','cancelled'=>'bg-secondary'][$request->status] ?? 'bg-secondary' }}">{{ \Illuminate\Support\Str::title(str_replace('_', ' ', $request->status)) }}</span>
        </div>

        <dl class="row">
            <dt class="col-sm-4">Email</dt><dd class="col-sm-8">{{ $request->email }}</dd>
            <dt class="col-sm-4">Phone</dt><dd class="col-sm-8">{{ $request->phone ?? '—' }}</dd>
            <dt class="col-sm-4">Practice Area</dt><dd class="col-sm-8">{{ $request->practiceArea?->title ?? '—' }}</dd>
            <dt class="col-sm-4">Preferred Contact</dt><dd class="col-sm-8">{{ ucfirst($request->preferred_contact) }}</dd>
            <dt class="col-sm-4">Preferred Date/Time</dt>
            <dd class="col-sm-8">
                @if ($request->preferred_date)
                    {{ $request->preferred_date->format('M d, Y') }} @if ($request->preferred_time)· {{ $request->preferred_time->format('h:i A') }}@endif
                @else
                    —
                @endif
            </dd>
            <dt class="col-sm-4">Submitted</dt><dd class="col-sm-8">{{ $request->created_at->format('M d, Y H:i') }}</dd>
        </dl>

        <div class="border rounded p-3 bg-light mb-4">
            <strong>Message:</strong>
            <div class="mt-1">{!! nl2br(e($request->message)) !!}</div>
        </div>

        <form method="POST" action="{{ route('admin.consultations.update', $request) }}">
            @csrf
            @method('PUT')
            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        @foreach (['new', 'in_progress', 'scheduled', 'closed', 'cancelled'] as $st)
                            <option value="{{ $st }}" {{ $request->status === $st ? 'selected' : '' }}>{{ \Illuminate\Support\Str::title(str_replace('_', ' ', $st)) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-8">
                    <label class="form-label">Admin Notes</label>
                    <textarea name="admin_notes" rows="2" class="form-control">{{ old('admin_notes', $request->admin_notes) }}</textarea>
                </div>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-primary"><i class="bi bi-check-circle me-1"></i> Update</button>
                <a href="{{ route('admin.consultations.index') }}" class="btn btn-outline-secondary">Back</a>
            </div>
        </form>
    </div>
@endsection