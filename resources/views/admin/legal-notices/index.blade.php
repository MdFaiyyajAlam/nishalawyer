@extends('layouts.admin')
@section('title', 'Legal Notices')
@section('header', 'Legal Notices')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-auto-hide">{{ session('success') }}</div>
    @endif

    <div class="admin-card rounded-xl p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4">
            <form method="GET" action="{{ route('admin.legal-notices.index') }}" class="flex gap-2">
                <select name="status" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                    <option value="">All Status</option>
                    @foreach (['draft', 'sent', 'received', 'read'] as $st)
                        <option value="{{ $st }}" {{ request('status') === $st ? 'selected' : '' }}>{{ ucfirst($st) }}</option>
                    @endforeach
                </select>
            </form>
            <a href="{{ route('admin.legal-notices.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i> New Notice</a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Case</th>
                        <th>From → To</th>
                        <th>Status</th>
                        <th>Sent</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($notices as $notice)
                        <tr>
                            <td class="fw-semibold">{{ $notice->title }}</td>
                            <td><span class="badge status-badge bg-secondary">{{ ucfirst($notice->notice_type) }}</span></td>
                            <td>{{ $notice->legalCase?->case_number ?? '—' }}</td>
                            <td class="small">{{ $notice->sender?->full_name ?? '—' }} → {{ $notice->recipient?->full_name ?? '—' }}</td>
                            <td>
                                <span class="badge status-badge {{ ['draft'=>'bg-secondary','sent'=>'bg-primary','received'=>'bg-warning','read'=>'bg-success'][$notice->status] ?? 'bg-secondary' }}">{{ ucfirst($notice->status) }}</span>
                            </td>
                            <td>{{ $notice->sent_at?->format('M d, Y') ?? '—' }}</td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-1">
                                    <a href="{{ route('admin.legal-notices.show', $notice) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
                                    <form method="POST" action="{{ route('admin.legal-notices.destroy', $notice) }}" class="d-inline" onsubmit="return confirm('Delete this notice?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center text-muted py-4">No legal notices.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">{{ $notices->withQueryString()->links() }}</div>
    </div>
@endsection