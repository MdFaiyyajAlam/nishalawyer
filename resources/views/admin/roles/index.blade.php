@extends('layouts.admin')
@section('title', 'Roles & Permissions')
@section('header', 'Roles & Permissions')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-auto-hide">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <div class="admin-card rounded-xl p-6 mb-4">
        <div class="flex items-center justify-between mb-4">
            <h5 class="mb-0">All Roles</h5>
            <a href="{{ route('admin.roles.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i> Add Role</a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Role</th>
                        <th>Slug</th>
                        <th>Level</th>
                        <th>Permissions</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>
                                <span class="fw-semibold">{{ $role->name }}</span>
                                @if (in_array($role->slug, ['admin', 'advocate', 'client']))
                                    <span class="badge status-badge bg-secondary ms-1">System</span>
                                @endif
                                @if ($role->description)
                                    <div><small class="text-muted">{{ $role->description }}</small></div>
                                @endif
                            </td>
                            <td><code>{{ $role->slug }}</code></td>
                            <td>{{ $role->level }}</td>
                            <td>
                                <span class="badge status-badge bg-primary">{{ $role->permissions->count() }}</span>
                                <small class="text-muted ms-1">{{ $role->permissions->take(3)->pluck('name')->implode(', ') }}{{ $role->permissions->count() > 3 ? '…' : '' }}</small>
                            </td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-1">
                                    <a href="{{ route('admin.roles.show', $role) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                                    @if (! in_array($role->slug, ['admin', 'advocate', 'client']))
                                        <form method="POST" action="{{ route('admin.roles.destroy', $role) }}" class="d-inline" onsubmit="return confirm('Delete this role?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="admin-card rounded-xl p-6">
        <h5 class="mb-3">All Permissions ({{ $permissions->count() }})</h5>
        <div class="row g-2">
            @foreach ($permissions as $permission)
                <div class="col-md-4 col-lg-3">
                    <div class="border rounded p-2 d-flex align-items-center gap-2">
                        <i class="bi bi-key text-primary"></i>
                        <div>
                            <div class="small fw-semibold">{{ $permission->name }}</div>
                            @if ($permission->module)
                                <small class="text-muted">{{ $permission->module }}</small>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection