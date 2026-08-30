@extends('layouts.client')
@section('title', 'My Cases')
@section('header', 'My Cases')

@section('content')
    <div class="client-card rounded-xl p-6">
        <h5 class="font-display font-bold text-primary mb-4">Case List</h5>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @forelse ($cases as $case)
                <div class="document-item p-4 rounded-lg">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-muted small">{{ $case->case_number }}</span>
                        <span class="status-badge {{ ['low'=>'bg-secondary','medium'=>'bg-info','high'=>'bg-warning','urgent'=>'bg-danger'][$case->priority] ?? 'bg-secondary' }} text-white">{{ ucfirst($case->priority) }}</span>
                    </div>
                    <h6 class="fw-bold mb-1">{{ $case->title }}</h6>
                    <p class="text-muted small mb-2">
                        {{ $case->court_name ?? '—' }}
                        @if ($case->next_hearing_date)
                            &middot; Next hearing: {{ $case->next_hearing_date->format('M d, Y') }}
                        @endif
                    </p>
                    <div class="flex items-center justify-between">
                        <span class="status-badge bg-primary text-white">{{ ucfirst($case->status) }}</span>
                        <a href="{{ route('client.cases.show', $case) }}" class="btn btn-sm btn-outline-primary">View Details <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            @empty
                <p class="text-muted">No cases assigned yet.</p>
            @endforelse
        </div>
    </div>
@endsection