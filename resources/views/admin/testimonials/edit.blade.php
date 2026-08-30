@extends('layouts.admin')
@section('title', 'Edit Testimonial')
@section('header', 'Edit Testimonial')

@php $old = old(); @endphp
@section('content')
    <div class="admin-card rounded-xl p-6 max-w-2xl">
        @if ($errors->any())
            <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
        @endif

        <form method="POST" action="{{ route('admin.testimonials.update', $testimonial) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Client Name *</label>
                    <input type="text" name="client_name" value="{{ $old['client_name'] ?? $testimonial->client_name }}" class="form-control" required maxlength="100">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Client Title</label>
                    <input type="text" name="client_title" value="{{ $old['client_title'] ?? $testimonial->client_title }}" class="form-control" maxlength="100">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Testimonial *</label>
                <textarea name="content" rows="5" class="form-control" required>{{ $old['content'] ?? $testimonial->content }}</textarea>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-md-3">
                    <label class="form-label">Rating *</label>
                    <select name="rating" class="form-select" required>
                        @for ($i = 5; $i >= 1; $i--)
                            <option value="{{ $i }}" {{ ($old['rating'] ?? $testimonial->rating) == $i ? 'selected' : '' }}>{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Practice Area</label>
                    <select name="practice_area_id" class="form-select">
                        <option value="">None</option>
                        @foreach ($practiceAreas as $pa)
                            <option value="{{ $pa->id }}" {{ ($old['practice_area_id'] ?? $testimonial->practice_area_id) == $pa->id ? 'selected' : '' }}>{{ $pa->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Status *</label>
                    <select name="status" class="form-select" required>
                        @foreach (['pending', 'approved', 'rejected'] as $st)
                            <option value="{{ $st }}" {{ ($old['status'] ?? $testimonial->status) === $st ? 'selected' : '' }}>{{ ucfirst($st) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Avatar</label>
                    <input type="file" name="client_avatar" accept="image/*" class="form-control form-control-sm">
                </div>
            </div>
            @if ($testimonial->client_avatar)
                <div class="mb-3"><img src="{{ Storage::url($testimonial->client_avatar) }}" width="60" class="rounded-circle" alt=""></div>
            @endif
            <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured" {{ ($old['is_featured'] ?? $testimonial->is_featured) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_featured">Featured on homepage</label>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-primary"><i class="bi bi-check-circle me-1"></i> Update</button>
                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection