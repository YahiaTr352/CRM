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
                    <span class="text-[10px] font-bold text-indigo-600 uppercase tracking-widest">Status Intelligence</span>
                </div>
                <span class="text-slate-300">/</span>
                <a href="{{ route('admin.task-statuses.index') }}" class="text-[10px] font-bold text-slate-400 hover:text-indigo-600 uppercase tracking-widest transition-colors">Workflow Matrix</a>
            </div>

            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-indigo-600 flex items-center justify-center text-white shadow-xl shadow-indigo-100">
                    <i class="fas fa-info-circle text-xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 tracking-tight">Status Details</h1>
                    <p class="text-slate-500 font-medium text-sm mt-1 max-w-xl">
                        In-depth analysis of the <span class="text-indigo-600 font-bold">{{ $taskStatus->name }}</span> state.
                    </p>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('admin.task-statuses.index') }}" class="inline-flex items-center gap-2.5 px-5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-600 shadow-sm hover:border-slate-300 hover:text-slate-900 transition-all active:scale-95">
                <i class="fas fa-arrow-left text-slate-400"></i>
                <span>Back to Matrix</span>
            </a>
            @can('task_status_edit')
                <a href="{{ route('admin.task-statuses.edit', $taskStatus->id) }}" class="inline-flex items-center gap-2.5 px-6 py-2.5 bg-indigo-600 rounded-xl text-sm font-bold text-white shadow-lg shadow-indigo-100 hover:bg-indigo-700 hover:-translate-y-0.5 transition-all">
                    <i class="fas fa-edit"></i>
                    <span>Edit Status</span>
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
                    <h2 class="text-2xl font-black text-slate-900 tracking-tight">{{ $taskStatus->name }}</h2>
                </div>
                <div class="p-6 md:p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-1">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ trans('cruds.taskStatus.fields.name') }}</p>
                            <p class="text-base font-bold text-slate-900">{{ $taskStatus->name }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Internal Identifier</p>
                            <p class="text-base font-mono font-bold text-indigo-600">STS-{{ str_pad($taskStatus->id, 4, '0', STR_PAD_LEFT) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar column -->
        <div class="space-y-8">
            <!-- Metadata Card -->
            <div class="bg-slate-900 rounded-2xl p-6 text-white shadow-xl shadow-slate-200">
                <div class="space-y-6">
                    <h3 class="text-[10px] font-black text-white/40 uppercase tracking-[0.2em] pb-4 border-b border-white/10">Engagement Timeline</h3>
                    
                    <div class="space-y-4">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-white/60">
                                <i class="fas fa-history text-lg"></i>
                            </div>
                            <div>
                                <p class="text-[9px] font-black text-white/40 uppercase tracking-widest">Temporal Intelligence</p>
                                <p class="text-xs font-bold">System Record</p>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4 pt-4 border-t border-white/10">
                            <div>
                                <p class="text-[9px] font-black text-white/40 uppercase tracking-widest mb-1">Created At</p>
                                <p class="text-[11px] font-bold">{{ $taskStatus->created_at ? $taskStatus->created_at->format('M d, Y') : 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-[9px] font-black text-white/40 uppercase tracking-widest mb-1">Updated At</p>
                                <p class="text-[11px] font-bold">{{ $taskStatus->updated_at ? $taskStatus->updated_at->format('M d, Y') : 'N/A' }}</p>
                            </div>
                        </div>

                        @can('task_status_delete')
                            <form action="{{ route('admin.task-statuses.destroy', $taskStatus->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" class="pt-4">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="w-full py-3 rounded-xl bg-rose-500/10 border border-rose-500/20 text-rose-500 text-xs font-bold hover:bg-rose-500 hover:text-white transition-all duration-300">
                                    <i class="fas fa-trash-alt mr-2"></i>
                                    Terminate Status
                                </button>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
