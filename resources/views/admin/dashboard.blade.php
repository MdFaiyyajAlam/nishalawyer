@extends('layouts.admin')
@section('title', 'Dashboard')
@section('header', 'Dashboard Overview')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-auto-hide d-flex align-items-center">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 mb-8">
        <div class="admin-card rounded-xl p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Clients</p>
                    <p class="text-2xl font-bold text-primary mt-1">{{ $stats['total_clients'] ?? 0 }}</p>
                </div>
                <div class="w-12 h-12 gold-bg bg-opacity-10 rounded-lg flex items-center justify-center"><i class="bi bi-people text-2xl text-gold"></i></div>
            </div>
        </div>
        <div class="admin-card rounded-xl p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Cases</p>
                    <p class="text-2xl font-bold text-primary mt-1">{{ $stats['total_cases'] ?? 0 }}</p>
                </div>
                <div class="w-12 h-12 gold-bg bg-opacity-10 rounded-lg flex items-center justify-center"><i class="bi bi-folder2-open text-2xl text-gold"></i></div>
            </div>
        </div>
        <div class="admin-card rounded-xl p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Active Cases</p>
                    <p class="text-2xl font-bold text-primary mt-1">{{ $stats['active_cases'] ?? 0 }}</p>
                </div>
                <div class="w-12 h-12 gold-bg bg-opacity-10 rounded-lg flex items-center justify-center"><i class="bi bi-fire text-2xl text-gold"></i></div>
            </div>
        </div>
        <div class="admin-card rounded-xl p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Appointments</p>
                    <p class="text-2xl font-bold text-primary mt-1">{{ $stats['total_appointments'] ?? 0 }}</p>
                </div>
                <div class="w-12 h-12 gold-bg bg-opacity-10 rounded-lg flex items-center justify-center"><i class="bi bi-calendar-check text-2xl text-gold"></i></div>
            </div>
        </div>
        <div class="admin-card rounded-xl p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Pending Appointments</p>
                    <p class="text-2xl font-bold text-primary mt-1">{{ $stats['pending_appointments'] ?? 0 }}</p>
                </div>
                <div class="w-12 h-12 gold-bg bg-opacity-10 rounded-lg flex items-center justify-center"><i class="bi bi-hourglass-split text-2xl text-gold"></i></div>
            </div>
        </div>
        <div class="admin-card rounded-xl p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Unread Messages</p>
                    <p class="text-2xl font-bold text-primary mt-1">{{ $stats['unread_contacts'] ?? 0 }}</p>
                </div>
                <div class="w-12 h-12 gold-bg bg-opacity-10 rounded-lg flex items-center justify-center"><i class="bi bi-envelope-exclamation text-2xl text-gold"></i></div>
            </div>
        </div>
        <div class="admin-card rounded-xl p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Revenue</p>
                    <p class="text-2xl font-bold text-primary mt-1">&#8377;{{ number_format($stats['total_revenue'] ?? 0) }}</p>
                </div>
                <div class="w-12 h-12 gold-bg bg-opacity-10 rounded-lg flex items-center justify-center"><i class="bi bi-currency-rupee text-2xl text-gold"></i></div>
            </div>
        </div>
        <div class="admin-card rounded-xl p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Completed Cases</p>
                    <p class="text-2xl font-bold text-primary mt-1">{{ $stats['completed_cases'] ?? 0 }}</p>
                </div>
                <div class="w-12 h-12 gold-bg bg-opacity-10 rounded-lg flex items-center justify-center"><i class="bi bi-check2-circle text-2xl text-gold"></i></div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="admin-card rounded-xl p-6">
            <h3 class="font-display text-lg font-bold text-primary mb-4">Case Distribution</h3>
            <table class="table table-sm">
                <thead><tr><th>Status</th><th class="text-end">Count</th></tr></thead>
                <tbody>
                    @foreach (['active','pending','settled','closed','won','lost'] as $st)
                        <tr>
                            <td class="text-capitalize">{{ $st }}</td>
                            <td class="text-end"><span class="badge status-badge bg-primary">{{ $caseStatusData[$st] ?? 0 }}</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="admin-card rounded-xl p-6">
            <h3 class="font-display text-lg font-bold text-primary mb-4">Appointment Status</h3>
            <table class="table table-sm">
                <thead><tr><th>Status</th><th class="text-end">Count</th></tr></thead>
                <tbody>
                    @foreach (['pending','confirmed','completed','cancelled','rejected'] as $st)
                        <tr>
                            <td class="text-capitalize">{{ $st }}</td>
                            <td class="text-end"><span class="badge status-badge bg-gold">{{ $appointmentStatusData[$st] ?? 0 }}</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-8 admin-card rounded-xl p-6">
        <h3 class="font-display text-lg font-bold text-primary mb-4">Quick Actions</h3>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.cases.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i> New Case</a>
            <a href="{{ route('admin.appointments.index') }}" class="btn btn-outline-primary"><i class="bi bi-calendar3 me-1"></i> Appointments</a>
            <a href="{{ route('admin.blog.create') }}" class="btn btn-outline-primary"><i class="bi bi-journal-plus me-1"></i> Write Post</a>
            <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-primary"><i class="bi bi-envelope me-1"></i> Messages</a>
        </div>
    </div>
@endsection
