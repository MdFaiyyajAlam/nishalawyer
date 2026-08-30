@extends('layouts.admin')
@section('title', 'Pages')
@section('header', 'CMS Pages')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-auto-hide">{{ session('success') }}</div>
    @endif

    <div class="admin-card rounded-xl p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4">
            <form method="GET" action="{{ route('admin.pages.index') }}" class="flex gap-2">
                <select name="status" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                    <option value="">All Status</option>
                    @foreach (['draft', 'published'] as $st)
                        <option value="{{ $st }}" {{ request('status') === $st ? 'selected' : '' }}>{{ ucfirst($st) }}</option>
                    @endforeach
                </select>
            </form>
            <a href="{{ route('admin.pages.create') }}" class="btn btn-primary"><i class="bi bi-file-earmark-plus me-1"></i> New Page</a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Page</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>System</th>
                        <th>Sort</th>
                        <th>Updated</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pages as $page)
                        <tr>
                            <td class="fw-semibold">{{ $page->title }}</td>
                            <td><code>/{{ $page->slug }}</code></td>
                            <td>
                                <span class="badge status-badge {{ $page->status === 'published' ? 'bg-success' : 'bg-secondary' }}">{{ ucfirst($page->status) }}</span>
                            </td>
                            <td>{{ $page->is_system ? '<i class="bi bi-shield-lock text-primary"></i>' : '—' }}</td>
                            <td>{{ $page->sort_order }}</td>
                            <td>{{ $page->updated_at->format('M d, Y') }}</td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-1">
                                    <a href="{{ route('admin.pages.show', $page) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                                    @if (! $page->is_system)
                                        <form method="POST" action="{{ route('admin.pages.destroy', $page) }}" class="d-inline" onsubmit="return confirm('Delete this page?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center text-muted py-4">No pages.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">{{ $pages->withQueryString()->links() }}</div>
    </div>
@endsection