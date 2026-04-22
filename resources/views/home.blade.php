@extends('layouts.admin')
@section('content')

<div class="max-w-[1600px] mx-auto px-4 md:px-6 lg:px-8 pt-2 md:pt-4 lg:pt-6 space-y-8 pb-12">
    <!-- Premium Dashboard Header -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 pb-8 border-b border-slate-200/60 animate-in fade-in slide-in-from-top-4 duration-700">
        <div class="space-y-3">
            <div class="flex items-center gap-2">
                <div class="flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-indigo-50 border border-indigo-100/50">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                    </span>
                    <span class="text-[10px] font-bold text-indigo-600 uppercase tracking-widest">System Operational</span>
                </div>
                <span class="text-slate-300">/</span>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest tracking-[0.2em]">Command Center</span>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-indigo-600 flex items-center justify-center text-white shadow-xl shadow-indigo-100">
                    <i class="fas fa-th-large text-xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 tracking-tight">Intelligence Dashboard</h1>
                    <p class="text-slate-500 font-medium text-sm mt-1 max-w-xl leading-relaxed">
                        Welcome back, <span class="text-indigo-600 font-bold">{{ Auth::user()->name }}</span>. Here is your enterprise performance overview for today.
                    </p>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <div class="hidden md:flex flex-col items-end mr-4">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Local Server Time</p>
                <p class="text-sm font-bold text-slate-700">{{ now()->format('l, M d, Y') }}</p>
            </div>
            <a href="{{ route('admin.deals.create') }}" class="inline-flex items-center gap-2.5 px-6 py-2.5 bg-indigo-600 rounded-xl text-sm font-bold text-white shadow-lg shadow-indigo-100 hover:bg-indigo-700 hover:-translate-y-0.5 transition-all active:scale-95">
                <i class="fas fa-plus-circle"></i>
                <span>Create Opportunity</span>
            </a>
        </div>
    </div>

    <!-- Statistical Pulse Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 animate-in fade-in slide-in-from-bottom-4 duration-1000 delay-150">
        <!-- Total Contacts -->
        <div class="group relative bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-xl hover:shadow-indigo-500/5 hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-1 group-hover:text-indigo-600 transition-colors">CRM Entities</p>
                    <h3 class="text-3xl font-black text-slate-900 tracking-tight">{{ number_format($settings1['total_number']) }}</h3>
                    <p class="text-[10px] font-medium text-emerald-500 mt-2 flex items-center gap-1 font-bold">
                        <i class="fas fa-users mr-1"></i>
                        {{ $settings1['chart_title'] }}
                    </p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-indigo-50 border border-indigo-100/50 flex items-center justify-center text-indigo-600 shadow-sm transition-transform duration-300 group-hover:scale-110">
                    <i class="fas fa-user-friends text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Deals -->
        <div class="group relative bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-xl hover:shadow-blue-500/5 hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-1 group-hover:text-blue-600 transition-colors">Sales Pipeline</p>
                    <h3 class="text-3xl font-black text-slate-900 tracking-tight">{{ number_format($settings2['total_number']) }}</h3>
                    <p class="text-[10px] font-medium text-blue-500 mt-2 flex items-center gap-1 font-bold">
                        <i class="fas fa-briefcase mr-1"></i>
                        {{ $settings2['chart_title'] }}
                    </p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-blue-50 border border-blue-100/50 flex items-center justify-center text-blue-600 shadow-sm transition-transform duration-300 group-hover:scale-110">
                    <i class="fas fa-chart-line text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Active Products -->
        <div class="group relative bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-xl hover:shadow-amber-500/5 hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-1 group-hover:text-amber-600 transition-colors">Inventory Assets</p>
                    <h3 class="text-3xl font-black text-slate-900 tracking-tight">{{ number_format($settings_products['total_number']) }}</h3>
                    <p class="text-[10px] font-medium text-amber-500 mt-2 flex items-center gap-1 font-bold">
                        <i class="fas fa-box mr-1"></i>
                        {{ $settings_products['chart_title'] }}
                    </p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-amber-50 border border-amber-100/50 flex items-center justify-center text-amber-600 shadow-sm transition-transform duration-300 group-hover:scale-110">
                    <i class="fas fa-boxes text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Pending Tasks -->
        <div class="group relative bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-xl hover:shadow-rose-500/5 hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-1 group-hover:text-rose-600 transition-colors">Operational Queue</p>
                    <h3 class="text-3xl font-black text-slate-900 tracking-tight">{{ number_format($settings_tasks['total_number']) }}</h3>
                    <p class="text-[10px] font-medium text-rose-500 mt-2 flex items-center gap-1 font-bold">
                        <i class="fas fa-tasks mr-1"></i>
                        {{ $settings_tasks['chart_title'] }}
                    </p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-rose-50 border border-rose-100/50 flex items-center justify-center text-rose-600 shadow-sm transition-transform duration-300 group-hover:scale-110">
                    <i class="fas fa-clipboard-list text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Analytical Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 animate-in fade-in slide-in-from-bottom-4 duration-1000 delay-300">
        <!-- Sales Performance Chart -->
        <div class="lg:col-span-2 bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden flex flex-col">
            <div class="p-6 border-b border-slate-100 flex items-center justify-between bg-slate-50/30">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-indigo-600 flex items-center justify-center text-white shadow-lg shadow-indigo-100">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest">Opportunity Pipeline</h3>
                        <p class="text-[10px] font-bold text-slate-400 mt-0.5 uppercase tracking-widest">Volume by Stage</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="px-2.5 py-1 rounded-lg bg-emerald-50 text-[10px] font-bold text-emerald-600 border border-emerald-100/50 uppercase tracking-wider">Live View</span>
                </div>
            </div>
            <div class="p-8 flex-grow">
                {!! $chart3->renderHtml() !!}
            </div>
        </div>

        <!-- System Task Queue -->
        <div class="bg-slate-900 rounded-3xl shadow-2xl shadow-slate-200 overflow-hidden flex flex-col">
            <div class="p-6 border-b border-white/5 bg-white/5 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-white/60">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-black text-white uppercase tracking-widest">{{ $settings4['chart_title'] }}</h3>
                        <p class="text-[10px] font-bold text-slate-500 mt-0.5 uppercase tracking-widest">Active priorities</p>
                    </div>
                </div>
                <a href="{{ route('admin.tasks.index') }}" class="w-8 h-8 rounded-lg bg-white/5 hover:bg-white/10 flex items-center justify-center text-white transition-colors">
                    <i class="fas fa-arrow-right text-[10px]"></i>
                </a>
            </div>
            <div class="p-6 flex-grow space-y-4">
                @forelse($settings4['data'] as $task)
                    <div class="group p-4 rounded-2xl bg-white/5 border border-white/5 hover:bg-white/10 transition-all duration-300">
                        <div class="flex items-center justify-between mb-2">
                            <span class="px-2 py-0.5 rounded text-[8px] font-black uppercase tracking-[0.2em] {{ $task->status && $task->status->name == 'Closed' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : 'bg-amber-500/10 text-amber-400 border border-amber-500/20' }}">
                                {{ $task->status->name ?? 'Pending' }}
                            </span>
                            <span class="text-[10px] font-bold text-slate-500">{{ $task->created_at->diffForHumans() }}</span>
                        </div>
                        <h4 class="text-sm font-bold text-white group-hover:text-indigo-400 transition-colors truncate">{{ $task->name }}</h4>
                        <div class="flex items-center gap-3 mt-3">
                            <div class="flex -space-x-2">
                                <div class="w-6 h-6 rounded-full bg-indigo-500 border-2 border-slate-900 flex items-center justify-center text-[8px] font-black">OP</div>
                            </div>
                            <span class="text-[9px] font-black text-slate-500 uppercase tracking-widest">Priority: <span class="text-slate-300">{{ $task->priority ?? 'Medium' }}</span></span>
                        </div>
                    </div>
                @empty
                    <div class="flex flex-col items-center justify-center py-12 text-slate-600 italic">
                        <i class="fas fa-check-double text-3xl mb-4 opacity-20"></i>
                        <p class="text-sm font-bold uppercase tracking-widest">All Clear</p>
                    </div>
                @endforelse
            </div>
            <div class="p-6 mt-auto">
                <button class="w-full py-4 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-black uppercase tracking-widest shadow-xl shadow-indigo-900/20 transition-all active:scale-95">
                    Operational Insights
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
@parent
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>{!! $chart3->renderJs() !!}
@endsection
