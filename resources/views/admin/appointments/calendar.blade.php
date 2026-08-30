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
                const events = @json($events);

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