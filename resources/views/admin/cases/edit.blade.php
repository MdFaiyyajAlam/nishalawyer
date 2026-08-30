@extends('layouts.admin')
@section('title', 'Edit Case')
@section('header', 'Edit Case — ' . $case->case_number)

@php $old = old(); @endphp
@section('content')
    <div class="admin-card rounded-xl p-6 max-w-3xl">
        @if ($errors->any())
            <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
        @endif

        <form method="POST" action="{{ route('admin.cases.update', $case) }}">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Case Number *</label>
                    <input type="text" name="case_number" value="{{ $old['case_number'] ?? $case->case_number }}" class="form-control" required>
                </div>
                <div class="col-md-8">
                    <label class="form-label">Case Title *</label>
                    <input type="text" name="title" value="{{ $old['title'] ?? $case->title }}" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Client *</label>
                    <select name="client_id" class="form-select" required>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}" {{ ($old['client_id'] ?? $case->client_id) == $client->id ? 'selected' : '' }}>{{ $client->full_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Practice Area</label>
                    <select name="practice_area_id" class="form-select">
                        <option value="">Select Practice Area</option>
                        @foreach ($practiceAreas as $area)
                            <option value="{{ $area->id }}" {{ ($old['practice_area_id'] ?? $case->practice_area_id) == $area->id ? 'selected' : '' }}>{{ $area->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Opponent Name</label>
                    <input type="text" name="opponent_name" value="{{ $old['opponent_name'] ?? $case->opponent_name }}" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Court Name</label>
                    <input type="text" name="court_name" value="{{ $old['court_name'] ?? $case->court_name }}" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Court Case Number</label>
                    <input type="text" name="court_case_number" value="{{ $old['court_case_number'] ?? $case->court_case_number }}" class="form-control">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Status *</label>
                    <select name="status" class="form-select" required>
                        @foreach (['pending','active','dismissed','settled','closed','won','lost'] as $st)
                            <option value="{{ $st }}" {{ ($old['status'] ?? $case->status) === $st ? 'selected' : '' }}>{{ ucfirst($st) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Priority *</label>
                    <select name="priority" class="form-select" required>
                        @foreach (['low','medium','high','urgent'] as $p)
                            <option value="{{ $p }}" {{ ($old['priority'] ?? $case->priority) === $p ? 'selected' : '' }}>{{ ucfirst($p) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Fees (₹)</label>
                    <input type="number" name="fees" step="0.01" min="0" value="{{ $old['fees'] ?? $case->fees }}" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Filed Date</label>
                    <input type="date" name="filed_date" value="{{ $old['filed_date'] ?? $case->filed_date?->format('Y-m-d') }}" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Next Hearing Date</label>
                    <input type="date" name="next_hearing_date" value="{{ $old['next_hearing_date'] ?? $case->next_hearing_date?->format('Y-m-d') }}" class="form-control">
                </div>
                <div class="col-12">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="3" class="form-control">{{ $old['description'] ?? $case->description }}</textarea>
                </div>
                <div class="col-12">
                    <label class="form-label">Remarks</label>
                    <textarea name="remarks" rows="2" class="form-control">{{ $old['remarks'] ?? $case->remarks }}</textarea>
                </div>
                <div class="col-12 d-flex gap-2 pt-2">
                    <button class="btn btn-primary"><i class="bi bi-check-circle me-1"></i> Update Case</button>
                    <a href="{{ route('admin.cases.show', $case) }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </div>
        </form>
    </div>
@endsection