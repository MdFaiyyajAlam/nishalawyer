@extends('layouts.admin')
@section('title', 'Upload Document')
@section('header', 'Upload Document')

@section('content')
    <div class="admin-card rounded-xl p-6 max-w-2xl">
        @if ($errors->any())
            <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
        @endif

        <form method="POST" action="{{ route('admin.documents.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Title *</label>
                <input type="text" name="title" value="{{ old('title') }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">File *</label>
                <input type="file" name="documents[]" class="form-control" required>
                <small class="text-muted">Allowed: PDF, DOC, DOCX, JPG, PNG, GIF, TXT (max 10MB)</small>
            </div>
            <div class="mb-3">
                <label class="form-label">Link to Case</label>
                <select name="case_id" class="form-select">
                    <option value="">No Case</option>
                    @foreach ($cases as $case)
                        <option value="{{ $case->id }}" {{ old('case_id') == $case->id ? 'selected' : '' }}>{{ $case->case_number }} — {{ $case->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Document Type *</label>
                <select name="document_type" class="form-select" required>
                    @foreach (['general', 'agreement', 'court_filing', 'evidence', 'id_proof', 'other'] as $type)
                        <option value="{{ $type }}" {{ old('document_type') === $type ? 'selected' : '' }}>{{ ucfirst(str_replace('_', ' ', $type)) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" rows="3" class="form-control">{{ old('description') }}</textarea>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-primary"><i class="bi bi-upload me-1"></i> Upload</button>
                <a href="{{ route('admin.documents.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection