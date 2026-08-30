@extends('layouts.admin')
@section('title', 'User Details')
@section('header', 'User — ' . $user->full_name)

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="admin-card rounded-xl p-6 text-center lg:col-span-1">
            <img src="{{ $user->avatar_url ?? asset('images/default-avatar.png') }}" class="rounded-circle mx-auto mb-3" width="96" height="96" alt="">
            <h4 class="font-display font-bold text-primary mb-1">{{ $user->full_name }}</h4>
            <p class="text-muted mb-2">{{ $user->email }}</p>
            <span class="badge status-badge bg-primary">{{ $user->role?->name ?? 'No Role' }}</span>
            <span class="badge status-badge {{ $user->is_active ? 'bg-success' : 'bg-secondary' }}">{{ $user->is_active ? 'Active' : 'Inactive' }}</span>
            <hr>
            <p class="text-sm text-muted mb-1"><i class="bi bi-telephone me-1"></i>{{ $user->phone ?? 'No phone' }}</p>
            <p class="text-sm text-muted"><i class="bi bi-calendar me-1"></i>Joined {{ $user->created_at->format('M d, Y') }}</p>
            @role('admin')
                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary mt-3 w-100"><i class="bi bi-pencil me-1"></i> Edit User</a>
            @endrole
        </div>

        <div class="admin-card rounded-xl p-6 lg:col-span-2">
            <h5 class="font-display font-bold text-primary mb-4">Profile Information</h5>
            <dl class="row mb-0">
                <dt class="col-sm-4">Bar Council No.</dt>
                <dd class="col-sm-8">{{ $user->profile?->bar_council_number ?? '—' }}</dd>
                <dt class="col-sm-4">Specialization</dt>
                <dd class="col-sm-8">{{ $user->profile?->specialization ?? '—' }}</dd>
                <dt class="col-sm-4">City</dt>
                <dd class="col-sm-8">{{ $user->profile?->city ?? '—' }}</dd>
                <dt class="col-sm-4">Address</dt>
                <dd class="col-sm-8">{{ $user->profile?->address ?? '—' }}</dd>
                <dt class="col-sm-4">Email Verified</dt>
                <dd class="col-sm-8">{{ $user->email_verified_at ? $user->email_verified_at->format('M d, Y') : 'Not verified' }}</dd>
            </dl>
        </div>
    </div>
@endsection