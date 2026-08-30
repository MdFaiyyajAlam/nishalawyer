@extends('layouts.admin')
@section('title', $practiceArea->title)
@section('header', 'Practice Area Detail')

@section('content')
    <div class="admin-card rounded-xl p-6 max-w-3xl">
        <div class="flex items-center gap-3 mb-4">
            <span class="badge status-badge {{ $practiceArea->color_class }} p-3"><i class="bi {{ $practiceArea->icon ?? 'bi-briefcase' }} fs-4"></i></span>
            <div>
                <h4 class="font-display font-bold text-primary mb-0">{{ $practiceArea->title }}</h4>
                <small class="text-muted">/{{ $practiceArea->slug }}</small>
            </div>
        </div>

        <p class="fw-semibold">{{ $practiceArea->short_description }}</p>
        <div class="border-top pt-3 mb-3">{!! nl2br(e($practiceArea->description)) !!}</div>

        <dl class="row">
            <dt class="col-sm-3">Featured</dt><dd class="col-sm-9">{{ $practiceArea->is_featured ? 'Yes' : 'No' }}</dd>
            <dt class="col-sm-3">Active</dt><dd class="col-sm-9">{{ $practiceArea->is_active ? 'Yes' : 'No' }}</dd>
            <dt class="col-sm-3">Sort Order</dt><dd class="col-sm-9">{{ $practiceArea->sort_order }}</dd>
        </dl>

        <div class="d-flex gap-2 mt-4">
            <a href="{{ route('admin.practice-areas.edit', $practiceArea) }}" class="btn btn-primary"><i class="bi bi-pencil me-1"></i> Edit</a>
            <a href="{{ route('admin.practice-areas.index') }}" class="btn btn-outline-secondary">Back</a>
        </div>
    </div>
@endsection