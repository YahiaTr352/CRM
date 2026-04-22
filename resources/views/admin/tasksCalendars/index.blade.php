@extends('layouts.admin')
@section('content')

<div class="max-w-[1200px] mx-auto px-4 md:px-6 lg:px-8 pt-2 md:pt-4 lg:pt-6 space-y-8 pb-12">
    <!-- Premium Header Section -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 pb-8 border-b border-slate-200/60 animate-in fade-in slide-in-from-top-4 duration-700">
        <div class="space-y-3">
            <div class="flex items-center gap-2">
                <div class="flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-indigo-50 border border-indigo-100/50">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                    </span>
                    <span class="text-[10px] font-bold text-indigo-600 uppercase tracking-widest">Chronology Intelligence</span>
                </div>
                <span class="text-slate-300">/</span>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Schedule Optimization</span>
            </div>

            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-indigo-600 flex items-center justify-center text-white shadow-xl shadow-indigo-100">
                    <i class="fas fa-calendar-alt text-xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 tracking-tight">{{ trans('cruds.tasksCalendar.title') }}</h1>
                    <p class="text-slate-500 font-medium text-sm mt-1 max-w-xl">
                        Optimize execution timelines and monitor upcoming milestones.
                    </p>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            @can('task_create')
                <a href="{{ route('admin.tasks.create') }}" class="inline-flex items-center gap-2.5 px-6 py-2.5 bg-indigo-600 rounded-xl text-sm font-bold text-white shadow-lg shadow-indigo-100 hover:bg-indigo-700 hover:-translate-y-0.5 transition-all">
                    <i class="fas fa-plus"></i>
                    <span>Register New Task</span>
                </a>
            @endcan
        </div>
    </div>

    <!-- Calendar Card -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden animate-in fade-in slide-in-from-bottom-4 duration-1000 delay-150">
        <div class="p-6 md:p-8 border-b border-slate-100 bg-slate-50/30">
            <h2 class="text-lg font-bold text-slate-900">Task Schedule Matrix</h2>
            <p class="text-slate-500 text-sm mt-1 font-medium text-slate-400">Interactive visual timeline of project obligations.</p>
        </div>

        <div class="p-6 md:p-8">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css" />
            <div id="calendar" class="fc-modern"></div>
        </div>
    </div>
</div>

@endsection

@section('styles')
<style>
    /* Premium FullCalendar Styling */
    .fc-modern.fc {
        font-family: inherit;
    }

    .fc-modern .fc-toolbar {
        margin-bottom: 2rem !important;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .fc-modern .fc-toolbar h2 {
        font-size: 1.25rem !important;
        font-weight: 800 !important;
        color: #0f172a !important;
        text-transform: uppercase !important;
        letter-spacing: 0.05em !important;
    }

    .fc-modern .fc-button-group {
        display: flex !important;
        gap: 8px !important;
        background: transparent !important;
        border: none !important;
    }

    .fc-modern .fc-button-group > .fc-button {
        border-radius: 0.75rem !important;
        border: 1px solid #e2e8f0 !important;
    }

    .fc-modern .fc-button-group > .fc-button.fc-state-active {
        background: #4f46e5 !important;
        color: #ffffff !important;
        border-color: #4f46e5 !important;
    }

    .fc-modern .fc-button-group > .fc-button:focus {
        outline: none !important;
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1) !important;
    }

    .fc-modern .fc-button {
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        color: #64748b !important;
        text-shadow: none !important;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important;
        padding: 0.5rem 1rem !important;
        height: auto !important;
        font-size: 0.75rem !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.025em !important;
        border-radius: 0.75rem !important;
        transition: all 0.2s !important;
    }

    .fc-modern .fc-button:hover {
        background: #f8fafc !important;
        color: #0f172a !important;
        border-color: #cbd5e1 !important;
    }

    .fc-modern .fc-button.fc-state-active {
        background: #4f46e5 !important;
        color: #ffffff !important;
        border-color: #4f46e5 !important;
    }

    .fc-modern .fc-head-container {
        border: none !important;
        padding-bottom: 1rem !important;
    }

    .fc-modern th.fc-day-header {
        border: none !important;
        padding: 1rem 0 !important;
        font-size: 0.7rem !important;
        font-weight: 800 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.1em !important;
        color: #94a3b8 !important;
    }

    .fc-modern .fc-body {
        border-radius: 1rem !important;
        overflow: hidden !important;
    }

    .fc-modern .fc-widget-content {
        border: 1px solid #f1f5f9 !important;
    }

    .fc-modern .fc-day-number {
        font-size: 0.75rem !important;
        font-weight: 700 !important;
        color: #64748b !important;
        padding: 0.75rem !important;
    }

    .fc-modern .fc-today {
        background: #f8fafc !important;
    }

    .fc-modern .fc-event {
        border: none !important;
        padding: 4px 8px !important;
        border-radius: 6px !important;
        font-size: 10px !important;
        font-weight: 700 !important;
        background: #eef2ff !important;
        color: #4f46e5 !important;
        border-left: 3px solid #4f46e5 !important;
        margin: 2px 4px !important;
        transition: all 0.2s !important;
    }

    .fc-modern .fc-event:hover {
        background: #4f46e5 !important;
        color: #ffffff !important;
        transform: translateY(-1px) !important;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1) !important;
    }

    .fc-icon-left-single-arrow:after { content: "\f053"; font-family: "Font Awesome 5 Free"; font-weight: 900; }
    .fc-icon-right-single-arrow:after { content: "\f054"; font-family: "Font Awesome 5 Free"; font-weight: 900; }
</style>
@endsection

@section('scripts')
@parent
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
<script>
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events : [
@foreach($events as $event)
@if($event->due_date)
                {
                    title : '{{ $event->name }}',
                    start : '{{ \Carbon\Carbon::createFromFormat(config('panel.date_format'),$event->due_date)->format('Y-m-d') }}',
                    url : '{{ url('admin/tasks').'/'.$event->id.'/edit' }}',
                    @php
                        $color = '#4f46e5';
                        if($event->priority === 'urgent') $color = '#e11d48';
                        elseif($event->priority === 'high') $color = '#d97706';
                        elseif($event->priority === 'low') $color = '#059669';
                    @endphp
                    color: '{{ $color }}'
                },
@endif
@endforeach
            ],
            eventRender: function(event, element) {
                element.css('border-left-color', event.color);
                element.css('color', event.color);
                element.css('background-color', event.color + '10'); // 10% opacity
            }
        })
    });
</script>
@stop
