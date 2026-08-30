@extends('layouts.admin')
@section('title', 'Write Post')
@section('header', 'Create Blog Post')

@php $old = old(); @endphp
@section('content')
    <div class="admin-card rounded-xl p-6 max-w-3xl">
        @if ($errors->any())
            <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
        @endif

        <form method="POST" action="{{ route('admin.blog.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Title *</label>
                <input type="text" name="title" value="{{ $old['title'] ?? '' }}" class="form-control" required>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Slug</label>
                    <input type="text" name="slug" value="{{ $old['slug'] ?? '' }}" class="form-control" placeholder="auto-generated if blank">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Category</label>
                    <select name="category_id" class="form-select">
                        <option value="">No Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ ($old['category_id'] ?? '') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Excerpt</label>
                <textarea name="excerpt" rows="2" class="form-control" maxlength="500">{{ $old['excerpt'] ?? '' }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Content *</label>
                <textarea name="content" rows="10" class="form-control" required>{{ $old['content'] ?? '' }}</textarea>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Featured Image</label>
                    <input type="file" name="featured_image" accept="image/*" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tags</label>
                    <select name="tags[]" class="form-select" multiple size="3">
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <label class="form-label">Status *</label>
                    <select name="status" class="form-select" required>
                        @foreach (['draft', 'published', 'archived'] as $st)
                            <option value="{{ $st }}" {{ ($old['status'] ?? 'draft') === $st ? 'selected' : '' }}>{{ ucfirst($st) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-8 d-flex align-items-end gap-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured" {{ ($old['is_featured'] ?? false) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_featured">Featured</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="comments_enabled" value="1" id="comments_enabled" checked>
                        <label class="form-check-label" for="comments_enabled">Comments Enabled</label>
                    </div>
                </div>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-primary"><i class="bi bi-check-circle me-1"></i> Create Post</button>
                <a href="{{ route('admin.blog.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection