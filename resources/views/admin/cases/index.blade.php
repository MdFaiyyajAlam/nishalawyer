@extends('layouts.admin')
@section('title', 'Cases')
@section('header', 'Case Management')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-auto-hide d-flex align-items-center">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="admin-card rounded-xl p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4">
            <form method="GET" action="{{ route('admin.cases.index') }}" class="flex gap-2 flex-1 max-w-lg flex-wrap">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control form-control-sm" placeholder="Search case number, title, court...">
                <select name="status" class="form-select form-select-sm w-auto">
                    <option value="">All Status</option>
                    @foreach (['active','pending','settled','closed','won','lost','dismissed'] as $st)
                        <option value="{{ $st }}" {{ request('status') === $st ? 'selected' : '' }}>{{ ucfirst($st) }}</option>
                    @endforeach
                </select>
                <select name="priority" class="form-select form-select-sm w-auto">
                    <option value="">All Priority</option>
                    @foreach (['low','medium','high','urgent'] as $p)
                        <option value="{{ $p }}" {{ request('priority') === $p ? 'selected' : '' }}>{{ ucfirst($p) }}</option>
                    @endforeach
                </select>
                <button class="btn btn-sm btn-primary"><i class="bi bi-search"></i></button>
            </form>
            <a href="{{ route('admin.cases.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i> New Case</a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Case</th>
                        <th>Client</th>
                        <th>Practice Area</th>
                        <th>Status</th>
                        <th>Priority</th>
                        <th>Next Hearing</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cases as $case)
                        <tr>
                            <td>
                                <a href="{{ route('admin.cases.show', $case) }}" class="fw-semibold text-decoration-none">{{ $case->title }}</a>
                                <div><small class="text-muted">{{ $case->case_number }}</small></div>
                            </td>
                            <td>{{ $case->client?->full_name ?? '—' }}</td>
                            <td>{{ $case->practiceArea?->name ?? '—' }}</td>
                            <td><span class="badge status-badge bg-primary">{{ ucfirst($case->status) }}</span></td>
                            <td><span class="badge status-badge {{ ['low'=>'bg-secondary','medium'=>'bg-info','high'=>'bg-warning','urgent'=>'bg-danger'][$case->priority] ?? 'bg-secondary' }}">{{ ucfirst($case->priority) }}</span></td>
                            <td>{{ $case->next_hearing_date?->format('M d, Y') ?? '—' }}</td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-1">
                                    <a href="{{ route('admin.cases.show', $case) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('admin.cases.edit', $case) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                                    <form method="POST" action="{{ route('admin.cases.destroy', $case) }}" class="d-inline" onsubmit="return confirm('Delete this case?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center text-muted py-4">No cases found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">{{ $cases->withQueryString()->links() }}</div>
    </div>
@endsection