@extends('layouts.admin')
@section('title', 'Documents')
@section('header', 'Document Management')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-auto-hide d-flex align-items-center">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="admin-card rounded-xl p-6">
        <div class="flex items-center justify-between mb-4">
            <h5 class="font-display font-bold text-primary mb-0">All Documents</h5>
            <a href="{{ route('admin.documents.create') }}" class="btn btn-primary"><i class="bi bi-upload me-1"></i> Upload Document</a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Document</th>
                        <th>Owner</th>
                        <th>Case</th>
                        <th>Type</th>
                        <th>Size</th>
                        <th>Shared</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($documents as $doc)
                        <tr>
                            <td>
                                <i class="bi {{ $doc->icon_class }} text-primary me-2"></i>
                                <a href="{{ route('admin.documents.show', $doc) }}" class="fw-semibold text-decoration-none">{{ $doc->title }}</a>
                                <div><small class="text-muted">{{ $doc->original_filename }}</small></div>
                            </td>
                            <td>{{ $doc->user?->full_name ?? '—' }}</td>
                            <td>{{ $doc->legalCase?->case_number ?? '—' }}</td>
                            <td>{{ ucfirst($doc->document_type) }}</td>
                            <td>{{ $doc->file_size_formatted }}</td>
                            <td>
                                <span class="badge status-badge {{ $doc->is_shared ? 'bg-success' : 'bg-secondary' }}">{{ $doc->is_shared ? 'Yes' : 'No' }}</span>
                            </td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-1">
                                    <a href="{{ route('admin.documents.download', $doc) }}" class="btn btn-sm btn-outline-primary" title="Download"><i class="bi bi-download"></i></a>
                                    <form method="POST" action="{{ route('admin.documents.destroy', $doc) }}" class="d-inline" onsubmit="return confirm('Delete this document?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" title="Delete"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center text-muted py-4">No documents found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">{{ $documents->links() }}</div>
    </div>
@endsection