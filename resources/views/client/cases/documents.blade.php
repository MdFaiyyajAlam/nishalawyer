@extends('layouts.client')
@section('title', 'Case Documents')
@section('header', 'Documents — ' . $case->case_number)

@section('content')
    <div class="client-card rounded-xl p-6">
        <div class="flex items-center justify-between mb-4">
            <h5 class="font-display font-bold text-primary mb-0">{{ $case->title }}</h5>
            <a href="{{ route('client.documents.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-upload me-1"></i> Upload</a>
        </div>

        @forelse ($documents as $doc)
            <div class="document-item p-3 rounded-lg mb-2">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="fw-semibold text-gray-800 mb-0"><i class="bi {{ $doc->icon_class }} me-2"></i>{{ $doc->title }}</p>
                        <small class="text-muted">{{ $doc->original_filename }} &middot; {{ $doc->file_size_formatted }} &middot; {{ $doc->created_at->format('M d, Y') }}</small>
                    </div>
                    <a href="{{ route('client.documents.download', $doc) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-download"></i></a>
                </div>
            </div>
        @empty
            <p class="text-muted text-sm">No documents for this case yet.</p>
        @endforelse

        <a href="{{ route('client.cases.show', $case) }}" class="btn btn-outline-secondary mt-3">Back to Case</a>
    </div>
@endsection