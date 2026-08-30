@extends('layouts.admin')
@section('title', 'Calendar')
@section('header', 'Appointment Calendar')

@section('content')
    <div class="admin-card rounded-xl p-6">
        <div id="calendar"></div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const calendarEl = document.getElementById('calendar');
                const events = @json($appointments->map(function ($a) {
                    return [
                        'id' => $a->id,
                        'title' => $a->appointment_number . ($a->type ? ' · ' . $a->type : ''),
                        'start' => $a->date->toDateString() . 'T' . $a->start_time,
                        'end' => $a->date->toDateString() . 'T' . $a->end_time,
                        'color' => $a->status === 'confirmed' ? '#1d4ed8' : ($a->status === 'pending' ? '#d97706' : '#16a34a'),
                    ];
                }));

                const calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    height: 650,
                    headerToolbar: { left: 'prev,next today', center: 'title', right: 'dayGridMonth,listWeek' },
                    events: events,
                    eventClick: function (info) {
                        window.location = '{{ url('/admin/appointments') }}/' + info.event.id;
                    },
                });
                calendar.render();
            });
        </script>
    @endpush
@endsection