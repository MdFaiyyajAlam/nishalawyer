@extends('layouts.admin')
@section('title', 'Revenue Report')
@section('header', 'Revenue Report')

@section('content')
    <div class="admin-card rounded-xl p-6">
        <h5 class="mb-3">Revenue Overview</h5>
        <p class="text-muted small">Revenue figures derived from case billing data.</p>
        <table class="table table-sm">
            <thead><tr><th>Case Status</th><th class="text-end">Count</th></tr></thead>
            <tbody>
                @forelse ($revenueData as $row)
                    <tr>
                        <td>{{ ucfirst(str_replace('_', ' ', $row->status ?? $row['status'] ?? '—')) }}</td>
                        <td class="text-end fw-semibold">{{ $row->count ?? $row['count'] ?? 0 }}</td>
                    </tr>
                @empty
                    <tr><td colspan="2" class="text-muted text-center">No data available.</td></tr>
                @endforelse
            </tbody>
        </table>
        @if (isset($revenueData['total_revenue']) || isset($revenueData->total_revenue))
            <div class="alert alert-success mt-3">
                <strong>Total Revenue:</strong> ₹{{ number_format($revenueData['total_revenue'] ?? $revenueData->total_revenue, 2) }}
            </div>
        @endif
    </div>

    <div class="mt-4"><a href="{{ route('admin.reports.index') }}" class="btn btn-outline-secondary">Back to Reports</a></div>
@endsection