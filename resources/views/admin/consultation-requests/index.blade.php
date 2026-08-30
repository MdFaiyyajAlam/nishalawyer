@extends('layouts.admin')
@section('title', 'Consultation Requests')
@section('header', 'Consultation Requests')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-auto-hide">{{ session('success') }}</div>
    @endif

    <div class="admin-card rounded-xl p-6">
        <div class="flex items-center justify-between mb-4">
            <h5 class="mb-0">Requests</h5>
            <form method="GET" action="{{ route('admin.consultations.index') }}" class="flex gap-2">
                <select name="status" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                    <option value="">All Status</option>
                    @foreach (['new', 'in_progress', 'scheduled', 'closed', 'cancelled'] as $st)
                        <option value="{{ $st }}" {{ request('status') === $st ? 'selected' : '' }}>{{ \Illuminate\Support\Str::title(str_replace('_', ' ', $st)) }}</option>
                    @endforeach
                </select>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Requester</th>
                        <th>Practice Area</th>
                        <th>Preferred</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($requests as $request)
                        <tr class="{{ $request->status === 'new' ? 'fw-semibold' : '' }}">
                            <td>
                                {{ $request->name }}
                                <div><small class="text-muted">{{ $request->email }}</small></div>
                            </td>
                            <td>{{ $request->practiceArea?->title ?? '—' }}</td>
                            <td>
                                @if ($request->preferred_date)
                                    {{ $request->preferred_date->format('M d, Y') }}
                                    @if ($request->preferred_time) · {{ $request->preferred_time->format('h:i A') }} @endif
                                @else
                                    —
                                @endif
                            </td>
                            <td>
                                <span class="badge status-badge {{ ['new'=>'bg-danger','in_progress'=>'bg-warning','scheduled'=>'bg-primary','closed'=>'bg-success','cancelled'=>'bg-secondary'][$request->status] ?? 'bg-secondary' }}">{{ \Illuminate\Support\Str::title(str_replace('_', ' ', $request->status)) }}</span>
                            </td>
                            <td>{{ $request->created_at->format('M d, Y') }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.consultations.show', $request) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted py-4">No consultation requests.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">{{ $requests->withQueryString()->links() }}</div>
    </div>
@endsection