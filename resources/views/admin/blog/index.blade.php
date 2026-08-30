@extends('layouts.admin')
@section('title', 'Blog')
@section('header', 'Blog Posts')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-auto-hide d-flex align-items-center">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="admin-card rounded-xl p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4">
            <form method="GET" action="{{ route('admin.blog.index') }}" class="flex gap-2 flex-1 max-w-md">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control form-control-sm" placeholder="Search posts...">
                <select name="status" class="form-select form-select-sm w-auto">
                    <option value="">All Status</option>
                    @foreach (['draft', 'published', 'archived'] as $st)
                        <option value="{{ $st }}" {{ request('status') === $st ? 'selected' : '' }}>{{ ucfirst($st) }}</option>
                    @endforeach
                </select>
                <button class="btn btn-sm btn-primary"><i class="bi bi-search"></i></button>
            </form>
            <a href="{{ route('admin.blog.create') }}" class="btn btn-primary"><i class="bi bi-journal-plus me-1"></i> Write Post</a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Post</th>
                        <th>Category</th>
                        <th>Author</th>
                        <th>Status</th>
                        <th>Published</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($posts as $post)
                        <tr>
                            <td>
                                <span class="fw-semibold">{{ $post->title }}</span>
                                @if ($post->is_featured)
                                    <span class="badge status-badge bg-warning ms-1">Featured</span>
                                @endif
                                <div><small class="text-muted">/{{ $post->slug }}</small></div>
                            </td>
                            <td>{{ $post->category?->name ?? '—' }}</td>
                            <td>{{ $post->author?->full_name ?? '—' }}</td>
                            <td>
                                <span class="badge status-badge {{ ['draft'=>'bg-secondary','published'=>'bg-success','archived'=>'bg-warning'][$post->status] ?? 'bg-secondary' }}">{{ ucfirst($post->status) }}</span>
                            </td>
                            <td>{{ $post->published_at?->format('M d, Y') ?? '—' }}</td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-1">
                                    <a href="{{ route('admin.blog.show', $post) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('admin.blog.edit', $post) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                                    <form method="POST" action="{{ route('admin.blog.destroy', $post) }}" class="d-inline" onsubmit="return confirm('Delete this post?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted py-4">No blog posts found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">{{ $posts->withQueryString()->links() }}</div>
    </div>
@endsection