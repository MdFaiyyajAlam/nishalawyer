@extends('layouts.client')
@section('title', 'Case Details')
@section('header', 'Case — ' . $case->case_number)

@section('content')
    <div class="client-card rounded-xl p-6 max-w-3xl">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h4 class="font-display font-bold text-primary mb-1">{{ $case->title }}</h4>
                <span class="text-muted">{{ $case->case_number }}</span>
            </div>
            <div class="text-end">
                <span class="status-badge bg-primary text-white">{{ ucfirst($case->status) }}</span>
                <span class="status-badge {{ ['low'=>'bg-secondary','medium'=>'bg-info','high'=>'bg-warning','urgent'=>'bg-danger'][$case->priority] ?? 'bg-secondary' }} text-white">{{ ucfirst($case->priority) }} Priority</span>
            </div>
        </div>

        <dl class="row">
            <dt class="col-sm-4">Advocate</dt>
            <dd class="col-sm-8">{{ $case->advocate?->full_name ?? '—' }}</dd>
            <dt class="col-sm-4">Practice Area</dt>
            <dd class="col-sm-8">{{ $case->practiceArea?->name ?? '—' }}</dd>
            <dt class="col-sm-4">Court</dt>
            <dd class="col-sm-8">{{ $case->court_name ?? '—' }}</dd>
            <dt class="col-sm-4">Filed Date</dt>
            <dd class="col-sm-8">{{ $case->filed_date?->format('M d, Y') ?? '—' }}</dd>
            <dt class="col-sm-4">Next Hearing</dt>
            <dd class="col-sm-8">{{ $case->next_hearing_date?->format('M d, Y') ?? '—' }}</dd>
            <dt class="col-sm-4">Description</dt>
            <dd class="col-sm-8">{{ $case->description ?? '—' }}</dd>
        </dl>

        <div class="d-flex gap-2 mt-4">
            <a href="{{ route('client.cases.documents', $case) }}" class="btn btn-primary"><i class="bi bi-folder2-open me-1"></i> Case Documents</a>
            <a href="{{ route('client.cases.index') }}" class="btn btn-outline-secondary">Back</a>
        </div>
    </div>
@endsection