@extends('layouts.admin')
@section('title', $blogPost->title)
@section('header', 'Blog Post')

@section('content')
    <div class="admin-card rounded-xl p-6 max-w-3xl">
        <div class="flex items-center justify-between mb-4">
            <h4 class="font-display font-bold text-primary mb-0">{{ $blogPost->title }}</h4>
            <span class="badge status-badge {{ ['draft'=>'bg-secondary','published'=>'bg-success','archived'=>'bg-warning'][$blogPost->status] ?? 'bg-secondary' }}">{{ ucfirst($blogPost->status) }}</span>
        </div>

        @if ($blogPost->featured_image)
            <img src="{{ Storage::url($blogPost->featured_image) }}" class="img-fluid rounded mb-4" alt="{{ $blogPost->title }}">
        @endif

        <dl class="row">
            <dt class="col-sm-3">Slug</dt><dd class="col-sm-9">/{{ $blogPost->slug }}</dd>
            <dt class="col-sm-3">Category</dt><dd class="col-sm-9">{{ $blogPost->category?->name ?? '—' }}</dd>
            <dt class="col-sm-3">Author</dt><dd class="col-sm-9">{{ $blogPost->author?->full_name ?? '—' }}</dd>
            <dt class="col-sm-3">Tags</dt>
            <dd class="col-sm-9">
                @forelse ($blogPost->tags as $tag)
                    <span class="badge status-badge bg-primary me-1">{{ $tag->name }}</span>
                @empty
                    —
                @endforelse
            </dd>
            <dt class="col-sm-3">Published</dt><dd class="col-sm-9">{{ $blogPost->published_at?->format('M d, Y H:i') ?? '—' }}</dd>
        </dl>

        <hr>
        <div class="blog-content">{!! nl2br(e($blogPost->content)) !!}</div>

        <div class="d-flex gap-2 mt-4">
            <a href="{{ route('admin.blog.edit', $blogPost) }}" class="btn btn-primary"><i class="bi bi-pencil me-1"></i> Edit</a>
            <a href="{{ route('admin.blog.index') }}" class="btn btn-outline-secondary">Back</a>
        </div>
    </div>
@endsection