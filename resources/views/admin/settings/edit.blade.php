@extends('layouts.admin')
@section('title', 'Edit Setting')
@section('header', 'Edit Setting')

@section('content')
    <div class="admin-card rounded-xl p-6 max-w-2xl">
        @if ($errors->any())
            <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
        @endif

        <form method="POST" action="{{ route('admin.settings.update', $setting) }}">
            @csrf
            @method('PUT')
            <dl class="row">
                <dt class="col-sm-3">Key</dt><dd class="col-sm-9"><code>{{ $setting->key }}</code></dd>
            </dl>
            <div class="mb-3">
                <label class="form-label">Value</label>
                @if ($setting->type === 'boolean')
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="value" value="1" {{ $setting->value ? 'checked' : '' }}>
                        <label class="form-check-label">Enabled</label>
                    </div>
                @elseif ($setting->type === 'json')
                    <textarea name="value" rows="4" class="form-control font-monospace">{{ old('value', $setting->value) }}</textarea>
                @else
                    <input type="text" name="value" value="{{ old('value', $setting->value) }}" class="form-control">
                @endif
            </div>
            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <label class="form-label">Type *</label>
                    <select name="type" class="form-select" required>
                        @foreach (['string', 'integer', 'float', 'boolean', 'json'] as $t)
                            <option value="{{ $t }}" {{ $setting->type === $t ? 'selected' : '' }}>{{ ucfirst($t) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Group *</label>
                    <input type="text" name="group" value="{{ old('group', $setting->group) }}" class="form-control" required maxlength="50">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Label</label>
                    <input type="text" name="label" value="{{ old('label', $setting->label) }}" class="form-control" maxlength="255">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" rows="2" class="form-control">{{ old('description', $setting->description) }}</textarea>
            </div>
            <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" name="is_public" value="1" id="is_public" {{ $setting->is_public ? 'checked' : '' }}>
                <label class="form-check-label" for="is_public">Public (visible on website)</label>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-primary"><i class="bi bi-check-circle me-1"></i> Update</button>
                <a href="{{ route('admin.settings.index') }}" class="btn btn-outline-secondary">Back</a>
            </div>
        </form>
    </div>
@endsection