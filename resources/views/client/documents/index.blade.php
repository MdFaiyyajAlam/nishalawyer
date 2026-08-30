@extends('layouts.client')
@section('title', 'Documents')
@section('header', 'My Documents')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-auto-hide d-flex align-items-center">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="client-card rounded-xl p-6 mb-6">
        <div class="flex items-center justify-between mb-4">
            <h5 class="font-display font-bold text-primary mb-0">My Documents</h5>
            <a href="{{ route('client.documents.create') }}" class="btn btn-primary"><i class="bi bi-upload me-1"></i> Upload Document</a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Document</th>
                        <th>Case</th>
                        <th>Type</th>
                        <th>Size</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($documents as $doc)
                        <tr>
                            <td>
                                <i class="bi {{ $doc->icon_class }} text-primary me-2"></i>
                                <span class="fw-semibold">{{ $doc->title }}</span>
                                <div><small class="text-muted">{{ $doc->original_filename }} &middot; {{ $doc->created_at->format('M d, Y') }}</small></div>
                            </td>
                            <td>{{ $doc->legalCase?->case_number ?? '—' }}</td>
                            <td>{{ ucfirst($doc->document_type) }}</td>
                            <td>{{ $doc->file_size_formatted }}</td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-1">
                                    <a href="{{ route('client.documents.download', $doc) }}" class="btn btn-sm btn-outline-primary" title="Download"><i class="bi bi-download"></i></a>
                                    @unless ($doc->is_shared)
                                        <form method="POST" action="{{ route('client.documents.share', $doc) }}" class="d-inline" onsubmit="return confirm('Share this document with your advocate?')">
                                            @csrf
                                            <button class="btn btn-sm btn-outline-success" title="Share with advocate"><i class="bi bi-share"></i></button>
                                        </form>
                                    @endunless
                                    <form method="POST" action="{{ route('client.documents.destroy', $doc) }}" class="d-inline" onsubmit="return confirm('Delete this document?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" title="Delete"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">No documents uploaded yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="client-card rounded-xl p-6">
        <h5 class="font-display font-bold text-primary mb-4">Shared with Advocate</h5>
        @forelse ($sharedDocuments as $doc)
            <div class="document-item p-3 rounded-lg mb-2">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="fw-semibold text-gray-800 mb-0"><i class="bi {{ $doc->icon_class }} me-2"></i>{{ $doc->title }}</p>
                        <small class="text-muted">{{ $doc->legalCase?->case_number ?? 'General' }} &middot; Shared {{ $doc->shared_at?->format('M d, Y') }}</small>
                    </div>
                    <span class="status-badge bg-success text-white">Shared</span>
                </div>
            </div>
        @empty
            <p class="text-muted text-sm">No shared documents.</p>
        @endforelse
    </div>
@endsection