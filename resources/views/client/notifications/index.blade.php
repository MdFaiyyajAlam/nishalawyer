@extends('layouts.client')
@section('title', 'Notifications')
@section('header', 'Notifications')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-auto-hide d-flex align-items-center">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="client-card rounded-xl p-6">
        <div class="flex items-center justify-between mb-4">
            <h5 class="font-display font-bold text-primary mb-0">All Notifications</h5>
            @if ($notifications->whereNull('read_at')->count())
                <form method="POST" action="{{ route('client.notifications.mark-as-read') }}">
                    @csrf
                    <button class="btn btn-outline-primary btn-sm"><i class="bi bi-check2-all me-1"></i> Mark All as Read</button>
                </form>
            @endif
        </div>

        @forelse ($notifications as $notification)
            <div class="document-item p-3 rounded-lg mb-2 {{ $notification->read_at ? 'opacity-75' : '' }}">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="fw-semibold text-gray-800 mb-1">
                            @unless ($notification->read_at)
                                <span class="badge bg-primary me-1">New</span>
                            @endunless
                            {{ $notification->data['title'] ?? 'Notification' }}
                        </p>
                        <p class="text-muted small mb-1">{{ $notification->data['body'] ?? $notification->data['message'] ?? '' }}</p>
                        <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                    </div>
                    <div class="d-inline-flex gap-1">
                        @unless ($notification->read_at)
                            <form method="POST" action="{{ route('client.notifications.mark-as-read', $notification->id) }}">
                                @csrf
                                <button class="btn btn-sm btn-outline-primary" title="Mark as read"><i class="bi bi-check2"></i></button>
                            </form>
                        @endunless
                        <form method="POST" action="{{ route('client.notifications.destroy', $notification->id) }}" onsubmit="return confirm('Delete this notification?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" title="Delete"><i class="bi bi-trash"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted text-center py-4">No notifications yet.</p>
        @endforelse

        <div class="mt-3">{{ $notifications->links() }}</div>
    </div>
@endsection