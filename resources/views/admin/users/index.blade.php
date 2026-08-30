@extends('layouts.admin')
@section('title', 'Users')
@section('header', 'User Management')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-auto-hide d-flex align-items-center">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="admin-card rounded-xl p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4">
            <form method="GET" action="{{ route('admin.users.index') }}" class="flex gap-2 flex-1 max-w-md">
                <select name="role" class="form-select form-select-sm w-auto">
                    <option value="">All Roles</option>
                    @foreach (['admin', 'advocate', 'client'] as $r)
                        <option value="{{ $r }}" {{ request('role') === $r ? 'selected' : '' }}>{{ ucfirst($r) }}</option>
                    @endforeach
                </select>
                <input type="text" name="search" value="{{ request('search') }}" class="form-control form-control-sm" placeholder="Search name or email...">
                <button class="btn btn-sm btn-primary"><i class="bi bi-search"></i></button>
            </form>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i> Add User</a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Role</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ $user->avatar_url ?? asset('images/default-avatar.png') }}" class="rounded-circle me-2" width="36" height="36" alt="">
                                    <div>
                                        <div class="fw-semibold">{{ $user->full_name }}</div>
                                        <small class="text-muted">{{ $user->email }}</small>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge status-badge bg-primary">{{ $user->role?->name ?? '—' }}</span></td>
                            <td>{{ $user->phone ?? '—' }}</td>
                            <td>
                                <span class="badge status-badge {{ $user->is_active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $user->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-1">
                                    <a href="{{ route('admin.users.show', $user) }}" class="btn btn-sm btn-outline-primary" title="View"><i class="bi bi-eye"></i></a>
                                    @role('admin')
                                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-outline-secondary" title="Edit"><i class="bi bi-pencil"></i></a>
                                        <form method="POST" action="{{ route('admin.users.toggle-status', $user) }}" class="d-inline">
                                            @csrf
                                            <button class="btn btn-sm btn-outline-warning" title="Toggle status"><i class="bi bi-toggle-{{ $user->is_active ? 'on' : 'off' }}"></i></button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="d-inline" onsubmit="return confirm('Delete this user?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger" title="Delete"><i class="bi bi-trash"></i></button>
                                        </form>
                                    @endrole
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">No users found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">{{ $users->withQueryString()->links() }}</div>
    </div>
@endsection