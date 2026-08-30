@extends('layouts.admin')
@section('title', 'Testimonial')
@section('header', 'Testimonial Detail')

@section('content')
    <div class="admin-card rounded-xl p-6 max-w-2xl">
        <div class="flex items-center gap-3 mb-4">
            @if ($testimonial->client_avatar)
                <img src="{{ Storage::url($testimonial->client_avatar) }}" class="rounded-circle" width="56" height="56" alt="">
            @else
                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width:56px;height:56px;font-size:1.3rem;">
                    {{ strtoupper(substr($testimonial->client_name, 0, 1)) }}
                </div>
            @endif
            <div>
                <h4 class="font-display font-bold text-primary mb-0">{{ $testimonial->client_name }}</h4>
                <small class="text-muted">{{ $testimonial->client_title ?? 'Client' }}</small>
            </div>
        </div>

        <div class="mb-3">
            @for ($i = 1; $i <= 5; $i)
                <i class="bi bi-star{{ $i <= $testimonial->rating ? '-fill' : '' }} text-warning fs-5"></i>
            @endfor
        </div>

        <p class="fst-italic border-start border-3 ps-3 border-warning">{{ $testimonial->content }}</p>

        <dl class="row">
            <dt class="col-sm-4">Practice Area</dt><dd class="col-sm-8">{{ $testimonial->practiceArea?->title ?? '—' }}</dd>
            <dt class="col-sm-4">Status</dt><dd class="col-sm-8">{{ ucfirst($testimonial->status) }}</dd>
            <dt class="col-sm-4">Featured</dt><dd class="col-sm-8">{{ $testimonial->is_featured ? 'Yes' : 'No' }}</dd>
            <dt class="col-sm-4">Submitted</dt><dd class="col-sm-8">{{ $testimonial->created_at->format('M d, Y') }}</dd>
            <dt class="col-sm-4">Approved</dt><dd class="col-sm-8">{{ $testimonial->approved_at?->format('M d, Y') ?? '—' }}</dd>
        </dl>

        <div class="d-flex gap-2 mt-4">
            <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="btn btn-primary"><i class="bi bi-pencil me-1"></i> Edit</a>
            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary">Back</a>
        </div>
    </div>
@endsection