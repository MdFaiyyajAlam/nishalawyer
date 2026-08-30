@extends('layouts.admin')
@section('title', 'Document Details')
@section('header', 'Document — ' . $document->title)

@section('content')
    <div class="admin-card rounded-xl p-6 max-w-2xl">
        <div class="d-flex align-items-center mb-4">
            <i class="bi {{ $document->icon_class }} text-primary" style="font-size: 2.5rem;"></i>
            <div class="ms-3">
                <h4 class="font-display font-bold text-primary mb-0">{{ $document->title }}</h4>
                <small class="text-muted">{{ $document->original_filename }}</small>
            </div>
        </div>

        <dl class="row">
            <dt class="col-sm-4">Owner</dt>
            <dd class="col-sm-8">{{ $document->user?->full_name ?? '—' }}</dd>
            <dt class="col-sm-4">Case</dt>
            <dd class="col-sm-8">{{ $document->legalCase?->case_number ?? '—' }}</dd>
            <dt class="col-sm-4">Type</dt>
            <dd class="col-sm-8">{{ ucfirst($document->document_type) }}</dd>
            <dt class="col-sm-4">File Type</dt>
            <dd class="col-sm-8">{{ strtoupper($document->file_type) }}</dd>
            <dt class="col-sm-4">Size</dt>
            <dd class="col-sm-8">{{ $document->file_size_formatted }}</dd>
            <dt class="col-sm-4">Shared</dt>
            <dd class="col-sm-8">{{ $document->is_shared ? 'Yes' : 'No' }}</dd>
            <dt class="col-sm-4">Description</dt>
            <dd class="col-sm-8">{{ $document->description ?? '—' }}</dd>
            <dt class="col-sm-4">Uploaded</dt>
            <dd class="col-sm-8">{{ $document->created_at->format('M d, Y H:i') }}</dd>
        </dl>

        <div class="d-flex gap-2 mt-4">
            <a href="{{ route('admin.documents.download', $document) }}" class="btn btn-primary"><i class="bi bi-download me-1"></i> Download</a>
            <a href="{{ route('admin.documents.index') }}" class="btn btn-outline-secondary">Back</a>
        </div>
    </div>
@endsection