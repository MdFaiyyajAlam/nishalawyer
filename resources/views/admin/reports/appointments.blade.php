@extends('layouts.admin')
@section('title', 'Appointment Reports')
@section('header', 'Appointment Reports')

@section('content')
    <div class="row g-4">
        <div class="col-lg-5">
            <div class="admin-card rounded-xl p-5">
                <h5 class="mb-3">By Status</h5>
                <table class="table table-sm">
                    <thead><tr><th>Status</th><th class="text-end">Count</th></tr></thead>
                    <tbody>
                        @forelse ($appointmentData as $row)
                            <tr>
                                <td>{{ ucfirst($row->status ?? $row['status'] ?? '—') }}</td>
                                <td class="text-end fw-semibold">{{ $row->count ?? $row['count'] ?? 0 }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="2" class="text-muted text-center">No data.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="admin-card rounded-xl p-5">
                <h5 class="mb-3">Monthly Appointments</h5>
                <table class="table table-sm">
                    <thead><tr><th>Month</th><th class="text-end">Appointments</th></tr></thead>
                    <tbody>
                        @forelse ($monthlyAppointments as $row)
                            <tr>
                                <td>{{ $row->month ?? $row['month'] ?? '—' }}</td>
                                <td class="text-end fw-semibold">{{ $row->count ?? $row['count'] ?? 0 }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="2" class="text-muted text-center">No data.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-4"><a href="{{ route('admin.reports.index') }}" class="btn btn-outline-secondary">Back to Reports</a></div>
@endsection