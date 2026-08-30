@extends('layouts.admin')
@section('title', 'Edit FAQ')
@section('header', 'Edit FAQ')

@php $old = old(); @endphp
@section('content')
    <div class="admin-card rounded-xl p-6 max-w-2xl">
        @if ($errors->any())
            <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
        @endif

        <form method="POST" action="{{ route('admin.faqs.update', $faq) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Question *</label>
                <input type="text" name="question" value="{{ $old['question'] ?? $faq->question }}" class="form-control" required maxlength="255">
            </div>
            <div class="mb-3">
                <label class="form-label">Answer *</label>
                <textarea name="answer" rows="5" class="form-control" required>{{ $old['answer'] ?? $faq->answer }}</textarea>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Practice Area</label>
                    <select name="practice_area_id" class="form-select">
                        <option value="">General</option>
                        @foreach ($practiceAreas as $pa)
                            <option value="{{ $pa->id }}" {{ ($old['practice_area_id'] ?? $faq->practice_area_id) == $pa->id ? 'selected' : '' }}>{{ $pa->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Status *</label>
                    <select name="status" class="form-select" required>
                        <option value="active" {{ ($old['status'] ?? $faq->status) === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ ($old['status'] ?? $faq->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ $old['sort_order'] ?? $faq->sort_order }}" class="form-control" min="0">
                </div>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-primary"><i class="bi bi-check-circle me-1"></i> Update</button>
                <a href="{{ route('admin.faqs.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection