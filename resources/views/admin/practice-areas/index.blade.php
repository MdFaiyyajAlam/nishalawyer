@extends('layouts.admin')
@section('title', 'Practice Areas')
@section('header', 'Practice Areas')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-auto-hide d-flex align-items-center">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="admin-card rounded-xl p-6">
        <div class="flex items-center justify-between mb-4">
            <h5 class="mb-0">All Practice Areas ({{ $practiceAreas->count() }})</h5>
            <a href="{{ route('admin.practice-areas.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i> Add Practice Area</a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Practice Area</th>
                        <th>Short Description</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Sort</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($practiceAreas as $pa)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge status-badge {{ $pa->color_class }} p-2"><i class="bi {{ $pa->icon ?? 'bi-briefcase' }}"></i></span>
                                    <div>
                                        <span class="fw-semibold">{{ $pa->title }}</span>
                                        <div><small class="text-muted">/{{ $pa->slug }}</small></div>
                                    </div>
                                </div>
                            </td>
                            <td class="small">{{ \Illuminate\Support\Str::limit($pa->short_description, 60) }}</td>
                            <td>{{ $pa->is_featured ? '<i class="bi bi-star-fill text-warning"></i>' : '—' }}</td>
                            <td>
                                <span class="badge status-badge {{ $pa->is_active ? 'bg-success' : 'bg-secondary' }}">{{ $pa->is_active ? 'Active' : 'Inactive' }}</span>
                            </td>
                            <td>{{ $pa->sort_order }}</td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-1">
                                    <a href="{{ route('admin.practice-areas.show', $pa) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('admin.practice-areas.edit', $pa) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                                    <form method="POST" action="{{ route('admin.practice-areas.destroy', $pa) }}" class="d-inline" onsubmit="return confirm('Delete this practice area?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted py-4">No practice areas yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection