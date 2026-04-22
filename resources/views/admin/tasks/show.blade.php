@extends('layouts.admin')
@section('content')

<div class="max-w-[1200px] mx-auto px-4 md:px-6 lg:px-8 pt-2 md:pt-4 lg:pt-6 space-y-8">
    <!-- Premium Header Section -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 pb-8 border-b border-slate-200/60 animate-in fade-in slide-in-from-top-4 duration-700">
        <div class="space-y-3">
            <div class="flex items-center gap-2">
                <div class="flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-indigo-50 border border-indigo-100/50">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                    </span>
                    <span class="text-[10px] font-bold text-indigo-600 uppercase tracking-widest">Task Intelligence</span>
                </div>
                <span class="text-slate-300">/</span>
                <a href="{{ route('admin.tasks.index') }}" class="text-[10px] font-bold text-slate-400 hover:text-indigo-600 uppercase tracking-widest transition-colors">Task Board</a>
            </div>

            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-indigo-600 flex items-center justify-center text-white shadow-xl shadow-indigo-100">
                    <i class="fas fa-info-circle text-xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 tracking-tight">Task Details</h1>
                    <p class="text-slate-500 font-medium text-sm mt-1 max-w-xl">
                        Comprehensive overview of task execution and status.
                    </p>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('admin.tasks.index') }}" class="inline-flex items-center gap-2.5 px-5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-600 shadow-sm hover:border-slate-300 hover:text-slate-900 transition-all active:scale-95">
                <i class="fas fa-arrow-left text-slate-400"></i>
                <span>Back to Tasks</span>
            </a>
            @can('task_edit')
                <a href="{{ route('admin.tasks.edit', $task->id) }}" class="inline-flex items-center gap-2.5 px-6 py-2.5 bg-indigo-600 rounded-xl text-sm font-bold text-white shadow-lg shadow-indigo-100 hover:bg-indigo-700 hover:-translate-y-0.5 transition-all">
                    <i class="fas fa-edit"></i>
                    <span>Edit Task</span>
                </a>
            @endcan
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 animate-in fade-in slide-in-from-bottom-4 duration-1000 delay-150">
        <!-- Main Info Column -->
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-6 md:p-8 border-b border-slate-100 bg-slate-50/30">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-[10px] font-black text-indigo-600 uppercase tracking-[0.2em] px-3 py-1 bg-indigo-50 rounded-lg border border-indigo-100/50">Core description</span>
                    </div>
                    <h2 class="text-2xl font-black text-slate-900 tracking-tight">{{ $task->name }}</h2>
                </div>
                <div class="p-6 md:p-8 prose prose-slate max-w-none">
                    {!! $task->description ?: '<p class="text-slate-400 italic font-medium">No description provided for this task.</p>' !!}
                </div>
            </div>

            <!-- Attachments Section -->
            @if(count($task->attachment) > 0)
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100 bg-slate-50/30">
                    <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest">Linked Assets</h3>
                </div>
                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($task->attachment as $media)
                        <a href="{{ $media->getUrl() }}" target="_blank" class="group flex items-center gap-4 p-4 rounded-xl border border-slate-100 hover:border-indigo-200 hover:bg-indigo-50/30 transition-all duration-300">
                            <div class="w-10 h-10 rounded-lg bg-white border border-slate-200 flex items-center justify-center text-slate-400 group-hover:text-indigo-500 transition-colors shadow-sm">
                                <i class="fas fa-file-download text-lg"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xs font-bold text-slate-700 truncate max-w-[150px]">{{ $media->file_name }}</span>
                                <span class="text-[10px] text-slate-400 font-semibold">{{ $media->human_readable_size }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar column -->
        <div class="space-y-8">
            <!-- Metadata Card -->
            <div class="bg-slate-900 rounded-2xl p-6 shadow-xl shadow-slate-200 space-y-6">
                <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] pb-4 border-b border-slate-800">Task Intelligence</h3>
                
                <div class="space-y-6">
                    <!-- Status -->
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-slate-500">Execution Status</span>
                        @php
                            $statusName = $task->status->name ?? 'Open';
                            $sColor = 'slate';
                            if ($statusName === 'Open') $sColor = 'blue';
                            elseif ($statusName === 'In progress') $sColor = 'amber';
                            elseif ($statusName === 'Closed') $sColor = 'emerald';
                        @endphp
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-wider bg-{{ $sColor }}-500/10 text-{{ $sColor }}-400 border border-{{ $sColor }}-500/20">
                            {{ $statusName }}
                        </span>
                    </div>

                    <!-- Priority -->
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-slate-500">Criticality</span>
                        @php
                            $priority = $task->priority ?? 'medium';
                            $pColor = 'slate';
                            if ($priority === 'urgent') $pColor = 'rose';
                            elseif ($priority === 'high') $pColor = 'amber';
                            elseif ($priority === 'medium') $pColor = 'indigo';
                            elseif ($priority === 'low') $pColor = 'emerald';
                        @endphp
                        <span class="inline-flex items-center text-{{ $pColor }}-400 text-[10px] font-black uppercase tracking-widest">
                            <i class="fas fa-circle text-[6px] mr-2"></i>
                            {{ App\Models\Task::PRIORITY_RADIO[$priority] ?? $priority }}
                        </span>
                    </div>

                    <!-- Due Date -->
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-slate-500">Deadline</span>
                        <span class="text-[11px] font-black text-white tabular-nums">{{ $task->due_date ?: 'Unscheduled' }}</span>
                    </div>

                    <!-- Assigned To -->
                    <div class="flex flex-col gap-3 pt-4 border-t border-slate-800">
                        <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Responsible Party</span>
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-slate-800 border border-slate-700 flex items-center justify-center text-xs font-black text-indigo-400">
                                {{ substr($task->assigned_to->name ?? 'U', 0, 1) }}
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xs font-bold text-white">{{ $task->assigned_to->name ?? 'Unassigned' }}</span>
                                <span class="text-[10px] text-slate-500 font-medium">Team Member</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tags Card -->
            @if(count($task->tags) > 0)
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Categorization</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($task->tags as $tag)
                        <span class="px-3 py-1.5 bg-indigo-50 text-indigo-600 text-[10px] font-extrabold rounded-lg border border-indigo-100 uppercase tracking-wider">
                            {{ $tag->name }}
                        </span>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Metadata Footer -->
            <div class="bg-slate-900 rounded-2xl p-6 text-white shadow-xl shadow-slate-200">
                <div class="space-y-4">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-white/60">
                            <i class="fas fa-history text-lg"></i>
                        </div>
                        <div>
                            <p class="text-[9px] font-black text-white/40 uppercase tracking-widest">Engagement Timeline</p>
                            <p class="text-xs font-bold">Pipeline Entry</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 pt-4 border-t border-white/10">
                        <div>
                            <p class="text-[9px] font-black text-white/40 uppercase tracking-widest mb-1">Created At</p>
                            <p class="text-[11px] font-bold">{{ $task->created_at ? $task->created_at->format('M d, Y') : 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-[9px] font-black text-white/40 uppercase tracking-widest mb-1">Updated At</p>
                            <p class="text-[11px] font-bold">{{ $task->updated_at ? $task->updated_at->format('M d, Y') : 'N/A' }}</p>
                        </div>
                    </div>

                    @can('task_delete')
                        <form action="{{ route('admin.tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" class="pt-4">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="w-full py-3 rounded-xl bg-rose-500/10 border border-rose-500/20 text-rose-500 text-xs font-bold hover:bg-rose-500 hover:text-white transition-all duration-300">
                                <i class="fas fa-trash-alt mr-2"></i>
                                Terminate Task
                            </button>
                        </form>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
