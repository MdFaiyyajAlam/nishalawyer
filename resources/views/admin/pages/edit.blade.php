@extends('layouts.admin')
@section('title', 'Edit Page')
@section('header', 'Edit Page')

@php $old = old(); @endphp
@section('content')
    <div class="admin-card rounded-xl p-6 max-w-3xl">
        @if ($errors->any())
            <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
        @endif

        <form method="POST" action="{{ route('admin.pages.update', $page) }}">
            @csrf
            @method('PUT')
            <div class="row g-3 mb-3">
                <div class="col-md-8">
                    <label class="form-label">Title *</label>
                    <input type="text" name="title" value="{{ $old['title'] ?? $page->title }}" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Slug *</label>
                    <input type="text" name="slug" value="{{ $old['slug'] ?? $page->slug }}" class="form-control" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Content *</label>
                <textarea name="content" rows="10" class="form-control" required>{{ $old['content'] ?? $page->content }}</textarea>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <label class="form-label">Status *</label>
                    <select name="status" class="form-select" required>
                        @foreach (['draft', 'published'] as $st)
                            <option value="{{ $st }}" {{ ($old['status'] ?? $page->status) === $st ? 'selected' : '' }}>{{ ucfirst($st) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Parent Page</label>
                    <select name="parent_id" class="form-select">
                        <option value="">None</option>
                        @foreach ($parentPages as $parent)
                            <option value="{{ $parent->id }}" {{ ($old['parent_id'] ?? $page->parent_id) == $parent->id ? 'selected' : '' }}>{{ $parent->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ $old['sort_order'] ?? $page->sort_order }}" class="form-control" min="0">
                </div>
            </div>
            <details class="mb-3">
                <summary class="fw-semibold mb-2">SEO Meta (optional)</summary>
                <div class="row g-3">
                    <div class="col-md-6"><input type="text" name="meta_title" value="{{ $old['meta_title'] ?? $page->meta_title }}" class="form-control" placeholder="Meta Title"></div>
                    <div class="col-md-6"><input type="text" name="meta_keywords" value="{{ $old['meta_keywords'] ?? $page->meta_keywords }}" class="form-control" placeholder="Meta Keywords"></div>
                    <div class="col-12"><textarea name="meta_description" rows="2" class="form-control" placeholder="Meta Description">{{ $old['meta_description'] ?? $page->meta_description }}</textarea></div>
                </div>
            </details>
            <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" name="is_system" value="1" id="is_system" {{ $page->is_system ? 'checked' : '' }}>
                <label class="form-check-label" for="is_system">System page (protected from deletion)</label>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-primary"><i class="bi bi-check-circle me-1"></i> Update Page</button>
                <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection