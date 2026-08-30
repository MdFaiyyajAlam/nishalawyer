@extends('layouts.admin')
@section('title', 'Contact Messages')
@section('header', 'Contact Messages')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-auto-hide">{{ session('success') }}</div>
    @endif

    <div class="admin-card rounded-xl p-6">
        <div class="flex items-center justify-between mb-4">
            <h5 class="mb-0">Inbox</h5>
            <form method="GET" action="{{ route('admin.contacts.index') }}" class="flex gap-2">
                <select name="status" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                    <option value="">All Status</option>
                    @foreach (['new', 'read', 'replied', 'archived'] as $st)
                        <option value="{{ $st }}" {{ request('status') === $st ? 'selected' : '' }}>{{ ucfirst($st) }}</option>
                    @endforeach
                </select>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>From</th>
                        <th>Subject</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($contacts as $contact)
                        <tr class="{{ $contact->status === 'new' ? 'fw-semibold' : '' }}">
                            <td>
                                {{ $contact->name }}
                                <div><small class="text-muted">{{ $contact->email }}</small></div>
                            </td>
                            <td>{{ \Illuminate\Support\Str::limit($contact->subject ?? $contact->message, 60) }}</td>
                            <td>
                                <span class="badge status-badge {{ ['new'=>'bg-danger','read'=>'bg-secondary','replied'=>'bg-success','archived'=>'bg-dark'][$contact->status] ?? 'bg-secondary' }}">{{ ucfirst($contact->status) }}</span>
                            </td>
                            <td>{{ $contact->created_at->format('M d, Y') }}</td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-1">
                                    <a href="{{ route('admin.contacts.show', $contact) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
                                    <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}" class="d-inline" onsubmit="return confirm('Delete this message?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">No messages.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">{{ $contacts->withQueryString()->links() }}</div>
    </div>
@endsection