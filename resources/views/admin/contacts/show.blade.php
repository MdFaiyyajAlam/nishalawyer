@extends('layouts.admin')
@section('title', 'Message from ' . $contact->name)
@section('header', 'Contact Message')

@section('content')
    <div class="admin-card rounded-xl p-6 max-w-2xl">
        <div class="d-flex justify-content-between align-items-start mb-4">
            <div>
                <h4 class="font-display font-bold text-primary mb-1">{{ $contact->subject ?? '(No Subject)' }}</h4>
                <small class="text-muted">{{ $contact->created_at->format('M d, Y H:i') }}</small>
            </div>
            <span class="badge status-badge {{ ['new'=>'bg-danger','read'=>'bg-secondary','replied'=>'bg-success','archived'=>'bg-dark'][$contact->status] ?? 'bg-secondary' }}">{{ ucfirst($contact->status) }}</span>
        </div>

        <div class="border rounded p-3 mb-4 bg-light">
            <div class="d-flex justify-content-between mb-2">
                <span class="fw-semibold">{{ $contact->name }}</span>
            </div>
            <div class="small text-muted mb-2">
                <i class="bi bi-envelope me-1"></i> {{ $contact->email }}
                @if ($contact->phone) · <i class="bi bi-telephone me-1"></i> {{ $contact->phone }} @endif
            </div>
            <hr>
            {!! nl2br(e($contact->message)) !!}
        </div>

        @if ($contact->admin_reply)
            <div class="border rounded p-3 mb-4 border-success">
                <strong><i class="bi bi-reply me-1"></i> Your Reply</strong>
                <div class="small text-muted mb-2">{{ $contact->replied_at?->format('M d, Y H:i') }}</div>
                {!! nl2br(e($contact->admin_reply)) !!}
            </div>
        @else
            <form method="POST" action="{{ route('admin.contacts.reply', $contact) }}">
                @csrf
                @method('PUT')
                <label class="form-label fw-semibold">Reply</label>
                <textarea name="admin_reply" rows="4" class="form-control mb-2" required placeholder="Write your reply...">{{ old('admin_reply') }}</textarea>
                <button class="btn btn-primary"><i class="bi bi-send me-1"></i> Send Reply</button>
            </form>
        @endif

        <div class="mt-4">
            <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-secondary">Back to Inbox</a>
        </div>
    </div>
@endsection