@extends('layouts.admin')
@section('title', 'Case Details')
@section('header', 'Case — ' . $case->case_number)

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-auto-hide d-flex align-items-center">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="admin-card rounded-xl p-6 lg:col-span-2">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h4 class="font-display font-bold text-primary mb-1">{{ $case->title }}</h4>
                    <span class="text-muted">{{ $case->case_number }}</span>
                </div>
                <div class="text-end">
                    <span class="badge status-badge bg-primary mb-1">{{ ucfirst($case->status) }}</span>
                    <span class="badge status-badge {{ ['low'=>'bg-secondary','medium'=>'bg-info','high'=>'bg-warning','urgent'=>'bg-danger'][$case->priority] ?? 'bg-secondary' }}">{{ ucfirst($case->priority) }} Priority</span>
                </div>
            </div>

            <dl class="row">
                <dt class="col-sm-4">Client</dt>
                <dd class="col-sm-8">{{ $case->client?->full_name ?? '—' }}</dd>
                <dt class="col-sm-4">Advocate</dt>
                <dd class="col-sm-8">{{ $case->advocate?->full_name ?? '—' }}</dd>
                <dt class="col-sm-4">Practice Area</dt>
                <dd class="col-sm-8">{{ $case->practiceArea?->name ?? '—' }}</dd>
                <dt class="col-sm-4">Opponent</dt>
                <dd class="col-sm-8">{{ $case->opponent_name ?? '—' }}</dd>
                <dt class="col-sm-4">Court</dt>
                <dd class="col-sm-8">{{ $case->court_name ?? '—' }} {{ $case->court_case_number ? "({$case->court_case_number})" : '' }}</dd>
                <dt class="col-sm-4">Fees</dt>
                <dd class="col-sm-8">&#8377;{{ number_format($case->fees, 2) }}</dd>
                <dt class="col-sm-4">Filed Date</dt>
                <dd class="col-sm-8">{{ $case->filed_date?->format('M d, Y') ?? '—' }}</dd>
                <dt class="col-sm-4">Next Hearing</dt>
                <dd class="col-sm-8">{{ $case->next_hearing_date?->format('M d, Y') ?? '—' }}</dd>
                <dt class="col-sm-4">Description</dt>
                <dd class="col-sm-8">{{ $case->description ?? '—' }}</dd>
                <dt class="col-sm-4">Remarks</dt>
                <dd class="col-sm-8">{{ $case->remarks ?? '—' }}</dd>
            </dl>

            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('admin.cases.edit', $case) }}" class="btn btn-primary"><i class="bi bi-pencil me-1"></i> Edit</a>
                @unless ($case->status === 'closed')
                    <form method="POST" action="{{ route('admin.cases.close', $case) }}">
                        @csrf
                        <button class="btn btn-outline-warning"><i class="bi bi-lock me-1"></i> Close Case</button>
                    </form>
                @endunless
                <a href="{{ route('admin.cases.index') }}" class="btn btn-outline-secondary">Back</a>
            </div>
        </div>

        <div class="admin-card rounded-xl p-6">
            <h5 class="font-display font-bold text-primary mb-4">Documents</h5>
            @forelse ($case->documents as $doc)
                <div class="document-item p-3 rounded-lg mb-2">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-semibold text-gray-800 mb-0"><i class="bi {{ $doc->icon_class }} me-2"></i>{{ $doc->title }}</p>
                            <small class="text-muted">{{ $doc->original_filename }} &middot; {{ $doc->file_size_formatted }}</small>
                        </div>
                        <a href="{{ route('admin.documents.download', $doc) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-download"></i></a>
                    </div>
                </div>
            @empty
                <p class="text-muted text-sm">No documents attached.</p>
            @endforelse
        </div>
    </div>
@endsection