@extends('layouts.admin')
@section('title', 'Testimonials')
@section('header', 'Testimonials')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-auto-hide d-flex align-items-center">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="admin-card rounded-xl p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4">
            <form method="GET" action="{{ route('admin.testimonials.index') }}" class="flex gap-2">
                <select name="status" class="form-select form-select-sm w-auto">
                    <option value="">All Status</option>
                    @foreach (['pending', 'approved', 'rejected'] as $st)
                        <option value="{{ $st }}" {{ request('status') === $st ? 'selected' : '' }}>{{ ucfirst($st) }}</option>
                    @endforeach
                </select>
                <button class="btn btn-sm btn-primary"><i class="bi bi-funnel"></i></button>
            </form>
            <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i> Add Testimonial</a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Client</th>
                        <th>Testimonial</th>
                        <th>Rating</th>
                        <th>Practice Area</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($testimonials as $t)
                        <tr>
                            <td>
                                <div class="fw-semibold">{{ $t->client_name }}</div>
                                <small class="text-muted">{{ $t->client_title ?? '—' }}</small>
                            </td>
                            <td class="small">{{ \Illuminate\Support\Str::limit($t->content, 80) }}</td>
                            <td>
                                @for ($i = 1; $i <= 5; $i)
                                    <i class="bi bi-star{{ $i <= $t->rating ? '-fill' : '' }} text-warning"></i>
                                @endfor
                            </td>
                            <td>{{ $t->practiceArea?->title ?? '—' }}</td>
                            <td>
                                <span class="badge status-badge {{ ['pending'=>'bg-warning','approved'=>'bg-success','rejected'=>'bg-danger'][$t->status] ?? 'bg-secondary' }}">{{ ucfirst($t->status) }}</span>
                            </td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-1">
                                    <a href="{{ route('admin.testimonials.show', $t) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
                                    @if ($t->status !== 'approved')
                                        <form method="POST" action="{{ route('admin.testimonials.approve', $t) }}" class="d-inline">
                                            @csrf
                                            <button class="btn btn-sm btn-outline-success" title="Approve"><i class="bi bi-check-lg"></i></button>
                                        </form>
                                    @endif
                                    @if ($t->status !== 'rejected')
                                        <form method="POST" action="{{ route('admin.testimonials.reject', $t) }}" class="d-inline">
                                            @csrf
                                            <button class="btn btn-sm btn-outline-warning" title="Reject"><i class="bi bi-x-lg"></i></button>
                                        </form>
                                    @endif
                                    <form method="POST" action="{{ route('admin.testimonials.destroy', $t) }}" class="d-inline" onsubmit="return confirm('Delete this testimonial?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted py-4">No testimonials found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">{{ $testimonials->withQueryString()->links() }}</div>
    </div>
@endsection