@extends('layouts.admin')
@section('title', 'Edit Role')
@section('header', 'Edit Role')

@php $old = old(); $oldPerms = $old['permissions'] ?? $role->permissions->pluck('id')->toArray(); @endphp
@section('content')
    <div class="admin-card rounded-xl p-6 max-w-2xl">
        @if ($errors->any())
            <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
        @endif

        <form method="POST" action="{{ route('admin.roles.update', $role) }}">
            @csrf
            @method('PUT')
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Name *</label>
                    <input type="text" name="name" value="{{ $old['name'] ?? $role->name }}" class="form-control" required maxlength="50">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Slug *</label>
                    <input type="text" name="slug" value="{{ $old['slug'] ?? $role->slug }}" class="form-control" required maxlength="50" {{ in_array($role->slug, ['admin', 'advocate', 'client']) ? 'readonly' : '' }}>
                </div>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-md-8">
                    <label class="form-label">Description</label>
                    <input type="text" name="description" value="{{ $old['description'] ?? $role->description }}" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Level</label>
                    <input type="number" name="level" value="{{ $old['level'] ?? $role->level }}" class="form-control" min="0">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Permissions</label>
                <div class="row g-2 border rounded p-3">
                    @foreach ($permissions as $permission)
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="perm_{{ $permission->id }}" {{ in_array($permission->id, $oldPerms) ? 'checked' : '' }}>
                                <label class="form-check-label small" for="perm_{{ $permission->id }}">{{ $permission->name }}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-primary"><i class="bi bi-check-circle me-1"></i> Update Role</button>
                <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection