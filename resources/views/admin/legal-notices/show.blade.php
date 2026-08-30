@extends('layouts.admin')
@section('title', $legalNotice->title)
@section('header', 'Legal Notice')

@section('content')
    <div class="admin-card rounded-xl p-6 max-w-3xl">
        <div class="d-flex justify-content-between align-items-start mb-4">
            <h4 class="font-display font-bold text-primary mb-0">{{ $legalNotice->title }}</h4>
            <span class="badge status-badge {{ ['draft'=>'bg-secondary','sent'=>'bg-primary','received'=>'bg-warning','read'=>'bg-success'][$legalNotice->status] ?? 'bg-secondary' }}">{{ ucfirst($legalNotice->status) }}</span>
        </div>

        <dl class="row">
            <dt class="col-sm-3">Notice Type</dt><dd class="col-sm-9">{{ ucfirst($legalNotice->notice_type) }}</dd>
            <dt class="col-sm-3">Case</dt><dd class="col-sm-9">{{ $legalNotice->legalCase?->case_number ?? '—' }}</dd>
            <dt class="col-sm-3">Sender</dt><dd class="col-sm-9">{{ $legalNotice->sender?->full_name ?? '—' }}</dd>
            <dt class="col-sm-3">Recipient</dt><dd class="col-sm-9">{{ $legalNotice->recipient?->full_name ?? '—' }}</dd>
            <dt class="col-sm-3">Sent At</dt><dd class="col-sm-9">{{ $legalNotice->sent_at?->format('M d, Y H:i') ?? '—' }}</dd>
            <dt class="col-sm-3">Read At</dt><dd class="col-sm-9">{{ $legalNotice->read_at?->format('M d, Y H:i') ?? '—' }}</dd>
        </dl>

        <div class="border rounded p-3 bg-light mb-3">
            {!! nl2br(e($legalNotice->content)) !!}
        </div>

        @if ($legalNotice->file_path)
            <a href="{{ Storage::url($legalNotice->file_path) }}" target="_blank" class="btn btn-outline-primary mb-3">
                <i class="bi bi-paperclip me-1"></i> {{ $legalNotice->original_filename ?? 'Download Attachment' }}
            </a>
        @endif

        <div class="d-flex gap-2 mt-2">
            <a href="{{ route('admin.legal-notices.index') }}" class="btn btn-outline-secondary">Back</a>
        </div>
    </div>
@endsection