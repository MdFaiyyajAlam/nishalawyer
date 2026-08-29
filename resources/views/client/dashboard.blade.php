@extends('layouts.client')
@section('title', 'Dashboard')
@section('header', 'Welcome, {{ auth()->user()->first_name }}')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-auto-hide d-flex align-items-center">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 mb-8">
        <div class="client-card rounded-xl p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Cases</p>
                    <p class="text-2xl font-bold text-primary mt-1">{{ $stats['total_cases'] ?? 0 }}</p>
                </div>
                <div class="w-12 h-12 gold-bg bg-opacity-10 rounded-lg flex items-center justify-center"><i class="bi bi-folder2-open text-2xl text-gold"></i></div>
            </div>
        </div>
        <div class="client-card rounded-xl p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Active Cases</p>
                    <p class="text-2xl font-bold text-primary mt-1">{{ $stats['active_cases'] ?? 0 }}</p>
                </div>
                <div class="w-12 h-12 gold-bg bg-opacity-10 rounded-lg flex items-center justify-center"><i class="bi bi-fire text-2xl text-gold"></i></div>
            </div>
        </div>
        <div class="client-card rounded-xl p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Appointments</p>
                    <p class="text-2xl font-bold text-primary mt-1">{{ $stats['total_appointments'] ?? 0 }}</p>
                </div>
                <div class="w-12 h-12 gold-bg bg-opacity-10 rounded-lg flex items-center justify-center"><i class="bi bi-calendar-check text-2xl text-gold"></i></div>
            </div>
        </div>
        <div class="client-card rounded-xl p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Upcoming Appointments</p>
                    <p class="text-2xl font-bold text-primary mt-1">{{ $stats['upcoming_appointments'] ?? 0 }}</p>
                </div>
                <div class="w-12 h-12 gold-bg bg-opacity-10 rounded-lg flex items-center justify-center"><i class="bi bi-hourglass-split text-2xl text-gold"></i></div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="client-card rounded-xl p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-display text-lg font-bold text-primary">Recent Cases</h3>
                <a href="{{ route('client.cases.index') }}" class="text-sm text-gold">View All</a>
            </div>
            @forelse ($recentCases as $case)
                <div class="document-item p-3 rounded-lg mb-2">
                    <a href="{{ route('client.cases.show', $case) }}" class="flex items-center justify-between">
                        <div>
                            <p class="font-semibold text-gray-800">{{ $case->title }}</p>
                            <p class="text-xs text-gray-500">{{ $case->case_number }}</p>
                        </div>
                        <span class="status-badge bg-primary text-white">{{ $case->status }}</span>
                    </a>
                </div>
            @empty
                <p class="text-gray-500 text-sm">No cases assigned yet.</p>
            @endforelse
        </div>

        <div class="client-card rounded-xl p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-display text-lg font-bold text-primary">Upcoming Appointments</h3>
                <a href="{{ route('client.appointments.create') }}" class="text-sm text-gold">+ Book</a>
            </div>
            @forelse ($upcomingAppointments as $apt)
                <div class="document-item p-3 rounded-lg mb-2">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-semibold text-gray-800">{{ $apt->type }}</p>
                            <p class="text-xs text-gray-500">{{ \Illuminate\Support\Carbon::parse($apt->date)->format('M d, Y') }} &middot; {{ $apt->start_time?->format('H:i') }}</p>
                        </div>
                        <span class="status-badge bg-gold text-white">{{ $apt->status }}</span>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-sm">No upcoming appointments.</p>
            @endforelse
        </div>
    </div>

    <div class="mt-8">
        <a href="{{ route('client.appointments.create') }}" class="btn btn-primary mb-2"><i class="bi bi-calendar-plus me-1"></i> Book Appointment</a>
        <a href="{{ route('client.documents.create') }}" class="btn btn-outline-primary mb-2"><i class="bi bi-upload me-1"></i> Upload Document</a>
    </div>
@endsection
