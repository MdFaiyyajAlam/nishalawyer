@extends('layouts.admin')
@section('title', $role->name)
@section('header', 'Role Detail')

@section('content')
    <div class="admin-card rounded-xl p-6 max-w-3xl">
        <h4 class="font-display font-bold text-primary">{{ $role->name }}</h4>
        <dl class="row">
            <dt class="col-sm-3">Slug</dt><dd class="col-sm-9"><code>{{ $role->slug }}</code></dd>
            <dt class="col-sm-3">Description</dt><dd class="col-sm-9">{{ $role->description ?? '—' }}</dd>
            <dt class="col-sm-3">Level</dt><dd class="col-sm-9">{{ $role->level }}</dd>
        </dl>

        <h6 class="mt-4">Permissions ({{ $role->permissions->count() }})</h6>
        <div class="row g-2 mb-4">
            @forelse ($role->permissions as $permission)
                <div class="col-md-4">
                    <span class="badge status-badge bg-primary">{{ $permission->name }}</span>
                </div>
            @empty
                <p class="text-muted small">No permissions assigned.</p>
            @endforelse
        </div>

        <h6 class="mt-4">Users with this role ({{ $role->users->count() }})</h6>
        <ul class="list-group list-group-flush mb-4">
            @forelse ($role->users as $user)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $user->full_name }}
                    <small class="text-muted">{{ $user->email }}</small>
                </li>
            @empty
                <li class="list-group-item text-muted">No users.</li>
            @endforelse
        </ul>

        <div class="d-flex gap-2">
            <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-primary"><i class="bi bi-pencil me-1"></i> Edit</a>
            <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary">Back</a>
        </div>
    </div>
@endsection