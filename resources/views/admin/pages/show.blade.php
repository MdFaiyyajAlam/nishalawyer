@extends('layouts.admin')
@section('title', $page->title)
@section('header', 'Page Detail')

@section('content')
    <div class="admin-card rounded-xl p-6 max-w-3xl">
        <div class="d-flex justify-content-between align-items-start mb-4">
            <h4 class="font-display font-bold text-primary mb-0">{{ $page->title }}</h4>
            <span class="badge status-badge {{ $page->status === 'published' ? 'bg-success' : 'bg-secondary' }}">{{ ucfirst($page->status) }}</span>
        </div>

        <dl class="row">
            <dt class="col-sm-3">Slug</dt><dd class="col-sm-9"><code>/{{ $page->slug }}</code></dd>
            <dt class="col-sm-3">Parent</dt><dd class="col-sm-9">{{ $page->parent_id ? \App\Models\Page::find($page->parent_id)?->title ?? '—' : '—' }}</dd>
            <dt class="col-sm-3">System</dt><dd class="col-sm-9">{{ $page->is_system ? 'Yes' : 'No' }}</dd>
            <dt class="col-sm-3">Sort Order</dt><dd class="col-sm-9">{{ $page->sort_order }}</dd>
            @if ($page->meta_title)
                <dt class="col-sm-3">Meta Title</dt><dd class="col-sm-9">{{ $page->meta_title }}</dd>
            @endif
        </dl>

        <hr>
        <div class="page-content">{!! nl2br(e($page->content)) !!}</div>

        <div class="d-flex gap-2 mt-4">
            <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-primary"><i class="bi bi-pencil me-1"></i> Edit</a>
            <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-secondary">Back</a>
        </div>
    </div>
@endsection