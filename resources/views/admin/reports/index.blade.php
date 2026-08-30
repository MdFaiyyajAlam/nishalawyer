@extends('layouts.admin')
@section('title', 'Reports')
@section('header', 'Reports & Analytics')

@section('content')
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="admin-card rounded-xl p-4 text-center">
                <div class="text-muted small mb-1">Total Users</div>
                <div class="font-display fs-3 fw-bold text-primary">{{ $stats['total_users'] ?? 0 }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="admin-card rounded-xl p-4 text-center">
                <div class="text-muted small mb-1">Total Cases</div>
                <div class="font-display fs-3 fw-bold text-primary">{{ $stats['total_cases'] ?? 0 }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="admin-card rounded-xl p-4 text-center">
                <div class="text-muted small mb-1">Appointments</div>
                <div class="font-display fs-3 fw-bold text-primary">{{ $stats['total_appointments'] ?? 0 }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="admin-card rounded-xl p-4 text-center">
                <div class="text-muted small mb-1">Active Cases</div>
                <div class="font-display fs-3 fw-bold text-primary">{{ $stats['active_cases'] ?? 0 }}</div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-6">
            <div class="admin-card rounded-xl p-5 h-100">
                <h5 class="mb-3">Cases by Status</h5>
                @forelse ($caseStatusData as $row)
                    @php $total = array_sum(array_column($caseStatusData, 'count') ?: array_column($caseStatusData, 'total') ?: []); @endphp
                    <div class="mb-2">
                        <div class="d-flex justify-content-between small mb-1">
                            <span class="fw-semibold">{{ ucfirst(str_replace('_', ' ', $row->status ?? $row['status'] ?? 'Unknown')) }}</span>
                            <span>{{ $row->count ?? $row['count'] ?? $row->total ?? 0 }}</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-primary" style="width: {{ $total ? round((($row->count ?? $row['count'] ?? 0) / $total) * 100) : 0 }}%"></div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted small">No data.</p>
                @endforelse
            </div>
        </div>
        <div class="col-lg-6">
            <div class="admin-card rounded-xl p-5 h-100">
                <h5 class="mb-3">Appointments by Status</h5>
                @forelse ($appointmentStatusData as $row)
                    @php $atotal = array_sum(array_column($appointmentStatusData, 'count') ?: array_column($appointmentStatusData, 'total') ?: []); @endphp
                    <div class="mb-2">
                        <div class="d-flex justify-content-between small mb-1">
                            <span class="fw-semibold">{{ ucfirst($row->status ?? $row['status'] ?? 'Unknown') }}</span>
                            <span>{{ $row->count ?? $row['count'] ?? $row->total ?? 0 }}</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-success" style="width: {{ $atotal ? round((($row->count ?? $row['count'] ?? 0) / $atotal) * 100) : 0 }}%"></div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted small">No data.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="d-flex gap-2 mt-4">
        <a href="{{ route('admin.reports.cases') }}" class="btn btn-outline-primary"><i class="bi bi-folder2 me-1"></i> Case Reports</a>
        <a href="{{ route('admin.reports.appointments') }}" class="btn btn-outline-primary"><i class="bi bi-calendar-check me-1"></i> Appointment Reports</a>
        <a href="{{ route('admin.reports.revenue') }}" class="btn btn-outline-primary"><i class="bi bi-cash-coin me-1"></i> Revenue</a>
    </div>
@endsection