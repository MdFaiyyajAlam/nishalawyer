@extends('layouts.admin')
@section('title', 'FAQs')
@section('header', 'FAQs')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-auto-hide">{{ session('success') }}</div>
    @endif

    <div class="admin-card rounded-xl p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4">
            <form method="GET" action="{{ route('admin.faqs.index') }}" class="flex gap-2">
                <select name="status" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                    <option value="">All Status</option>
                    @foreach (['active', 'inactive'] as $st)
                        <option value="{{ $st }}" {{ request('status') === $st ? 'selected' : '' }}>{{ ucfirst($st) }}</option>
                    @endforeach
                </select>
            </form>
            <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary"><i class="bi bi-question-circle-plus me-1"></i> Add FAQ</a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th style="width:60px">Order</th>
                        <th>Question</th>
                        <th>Practice Area</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($faqs as $faq)
                        <tr>
                            <td>{{ $faq->sort_order }}</td>
                            <td>
                                <span class="fw-semibold">{{ $faq->question }}</span>
                                <div><small class="text-muted">{{ \Illuminate\Support\Str::limit($faq->answer, 90) }}</small></div>
                            </td>
                            <td>{{ $faq->practiceArea?->title ?? 'General' }}</td>
                            <td>
                                <span class="badge status-badge {{ $faq->status === 'active' ? 'bg-success' : 'bg-secondary' }}">{{ ucfirst($faq->status) }}</span>
                            </td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-1">
                                    <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                                    <form method="POST" action="{{ route('admin.faqs.destroy', $faq) }}" class="d-inline" onsubmit="return confirm('Delete this FAQ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">No FAQs yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">{{ $faqs->withQueryString()->links() }}</div>
    </div>
@endsection