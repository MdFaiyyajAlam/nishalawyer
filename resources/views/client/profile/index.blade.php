@extends('layouts.client')
@section('title', 'My Profile')
@section('header', 'My Profile')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-auto-hide d-flex align-items-center">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="client-card rounded-xl p-6">
            <h5 class="font-display font-bold text-primary mb-4">Profile Information</h5>
            <form method="POST" action="{{ route('client.profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Profile Photo</label>
                    <input type="file" name="avatar" accept="image/*" class="form-control">
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label">First Name *</label>
                        <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Last Name *</label>
                        <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}" class="form-control" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email *</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="form-control">
                </div>
                <button class="btn btn-primary"><i class="bi bi-check-circle me-1"></i> Save Changes</button>
            </form>
        </div>

        <div class="client-card rounded-xl p-6">
            <h5 class="font-display font-bold text-primary mb-4">Change Password</h5>
            <form method="POST" action="{{ route('client.profile.update-password') }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Current Password *</label>
                    <input type="password" name="current_password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">New Password *</label>
                    <input type="password" name="password" class="form-control" required minlength="8">
                </div>
                <div class="mb-3">
                    <label class="form-label">Confirm New Password *</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
                <button class="btn btn-primary"><i class="bi bi-shield-check me-1"></i> Update Password</button>
            </form>
        </div>
    </div>
@endsection