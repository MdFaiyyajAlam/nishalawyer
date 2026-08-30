@extends('layouts.admin')
@section('title', 'Add Practice Area')
@section('header', 'Create Practice Area')

@php $old = old(); @endphp
@section('content')
    <div class="admin-card rounded-xl p-6 max-w-2xl">
        @if ($errors->any())
            <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
        @endif

        <form method="POST" action="{{ route('admin.practice-areas.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Title *</label>
                    <input type="text" name="title" value="{{ $old['title'] ?? '' }}" class="form-control" required maxlength="100">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Slug *</label>
                    <input type="text" name="slug" value="{{ $old['slug'] ?? '' }}" class="form-control" required maxlength="100">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Short Description *</label>
                <input type="text" name="short_description" value="{{ $old['short_description'] ?? '' }}" class="form-control" required maxlength="255">
            </div>
            <div class="mb-3">
                <label class="form-label">Full Description *</label>
                <textarea name="description" rows="6" class="form-control" required>{{ $old['description'] ?? '' }}</textarea>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <label class="form-label">Icon (Bootstrap class)</label>
                    <input type="text" name="icon" value="{{ $old['icon'] ?? '' }}" class="form-control" placeholder="bi-briefcase">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Color Class</label>
                    <input type="text" name="color_class" value="{{ $old['color_class'] ?? 'bg-blue-900' }}" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ $old['sort_order'] ?? 0 }}" class="form-control" min="0">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Image</label>
                <input type="file" name="image" accept="image/*" class="form-control">
            </div>
            <div class="d-flex gap-4 mb-3">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured" {{ ($old['is_featured'] ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_featured">Featured</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" checked>
                    <label class="form-check-label" for="is_active">Active</label>
                </div>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-primary"><i class="bi bi-check-circle me-1"></i> Create</button>
                <a href="{{ route('admin.practice-areas.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection