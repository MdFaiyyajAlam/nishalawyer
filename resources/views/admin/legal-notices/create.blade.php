@extends('layouts.admin')
@section('title', 'New Legal Notice')
@section('header', 'Create Legal Notice')

@php $old = old(); @endphp
@section('content')
    <div class="admin-card rounded-xl p-6 max-w-2xl">
        @if ($errors->any())
            <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
        @endif

        <form method="POST" action="{{ route('admin.legal-notices.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Title *</label>
                <input type="text" name="title" value="{{ $old['title'] ?? '' }}" class="form-control" required>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Case *</label>
                    <select name="case_id" class="form-select" required>
                        <option value="">Select case...</option>
                        @foreach ($cases as $case)
                            <option value="{{ $case->id }}" {{ ($old['case_id'] ?? '') == $case->id ? 'selected' : '' }}>{{ $case->case_number }} — {{ $case->title ?? '' }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Notice Type *</label>
                    <input type="text" name="notice_type" value="{{ $old['notice_type'] ?? 'general' }}" class="form-control" required>
                </div>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Sender *</label>
                    <select name="sender_id" class="form-select" required>
                        <option value="">Select sender...</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ ($old['sender_id'] ?? '') == $user->id ? 'selected' : '' }}>{{ $user->full_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Recipient</label>
                    <select name="recipient_id" class="form-select">
                        <option value="">None</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ ($old['recipient_id'] ?? '') == $user->id ? 'selected' : '' }}>{{ $user->full_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Content *</label>
                <textarea name="content" rows="8" class="form-control" required>{{ $old['content'] ?? '' }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Attachment (PDF/DOC/Image, max 10MB)</label>
                <input type="file" name="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-primary"><i class="bi bi-send me-1"></i> Send Notice</button>
                <a href="{{ route('admin.legal-notices.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection