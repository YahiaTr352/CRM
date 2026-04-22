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
                    <span class="text-[10px] font-bold text-indigo-600 uppercase tracking-widest">Event Intelligence</span>
                </div>
                <span class="text-slate-300">/</span>
                <a href="{{ route('admin.audit-logs.index') }}" class="text-[10px] font-bold text-slate-400 hover:text-indigo-600 uppercase tracking-widest transition-colors">Operation Ledger</a>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-slate-900 flex items-center justify-center text-white shadow-xl shadow-slate-200">
                    <i class="fas fa-fingerprint text-xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 tracking-tight">Audit Insight</h1>
                    <p class="text-slate-500 font-medium text-sm mt-1 max-w-xl leading-relaxed">
                        Deep-dive analysis of system event <span class="text-indigo-600 font-bold">#{{ $auditLog->id }}</span> and its associated state transitions.
                    </p>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('admin.audit-logs.index') }}" class="inline-flex items-center gap-2.5 px-5 py-2.5 bg-slate-900 rounded-xl text-sm font-bold text-white shadow-lg shadow-slate-200 hover:bg-slate-800 transition-all active:scale-95">
                <i class="fas fa-arrow-left opacity-50"></i>
                <span>Back to Ledger</span>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 animate-in fade-in slide-in-from-bottom-4 duration-1000 delay-150">
        <!-- Main Content (2/3) -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Event Detail Card -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100 bg-slate-50/30">
                    <h2 class="text-sm font-black text-slate-900 uppercase tracking-widest flex items-center gap-2">
                        <i class="fas fa-info-circle text-indigo-500"></i>
                        Event Intelligence
                    </h2>
                </div>
                <div class="p-6 md:p-8 space-y-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-1">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ trans('cruds.auditLog.fields.description') }}</p>
                            <p class="text-base font-bold text-slate-900">{{ $auditLog->description }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ trans('cruds.auditLog.fields.subject_type') }}</p>
                            <div class="pt-1">
                                <span class="inline-flex items-center px-3 py-1 rounded-xl text-[10px] font-black uppercase tracking-wider bg-slate-900 text-white shadow-sm">
                                    {{ $auditLog->subject_type }}
                                </span>
                            </div>
                        </div>
                        <div class="space-y-1">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ trans('cruds.auditLog.fields.subject_id') }}</p>
                            <p class="text-base font-mono font-bold text-indigo-600">ID-{{ str_pad($auditLog->subject_id, 6, '0', STR_PAD_LEFT) }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Internal Hash</p>
                            <p class="text-[11px] font-mono font-bold text-slate-500 break-all">{{ md5($auditLog->id . $auditLog->created_at) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Properties / Payload Card -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100 bg-slate-50/30 flex items-center justify-between">
                    <h2 class="text-sm font-black text-slate-900 uppercase tracking-widest flex items-center gap-2">
                        <i class="fas fa-code text-indigo-500"></i>
                        Payload Transparency
                    </h2>
                    <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest bg-slate-100 px-2 py-0.5 rounded">JSON Structure</span>
                </div>
                <div class="p-0">
                    <div class="bg-slate-900 p-6 md:p-8">
                        <pre class="text-emerald-400 font-mono text-xs leading-relaxed overflow-x-auto"><code>{{ json_encode(json_decode($auditLog->properties), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</code></pre>
                    </div>
                </div>
                <div class="p-4 bg-slate-50 border-t border-slate-100 text-center">
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tight">Immutable state transition data captured at source</p>
                </div>
            </div>
        </div>

        <!-- Sidebar Content (1/3) -->
        <div class="space-y-8">
            <!-- Context Card -->
            <div class="bg-slate-900 rounded-2xl p-6 text-white shadow-xl shadow-slate-200">
                <div class="space-y-6">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-white/60">
                            <i class="fas fa-network-wired text-lg"></i>
                        </div>
                        <div>
                            <p class="text-[9px] font-black text-white/40 uppercase tracking-widest">Audit Context</p>
                            <p class="text-xs font-bold">Trace Parameters</p>
                        </div>
                    </div>
                    
                    <div class="space-y-5 pt-6 border-t border-white/10">
                        <div class="flex items-center justify-between">
                            <p class="text-[9px] font-black text-white/40 uppercase tracking-widest">{{ trans('cruds.auditLog.fields.user_id') }}</p>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-user-circle text-white/20 text-xs"></i>
                                <span class="text-[11px] font-bold">Operator #{{ $auditLog->user_id }}</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="text-[9px] font-black text-white/40 uppercase tracking-widest">{{ trans('cruds.auditLog.fields.host') }}</p>
                            <span class="text-[10px] font-mono font-bold text-indigo-400 bg-white/5 px-2 py-0.5 rounded border border-white/5">{{ $auditLog->host }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="text-[9px] font-black text-white/40 uppercase tracking-widest">{{ trans('cruds.auditLog.fields.created_at') }}</p>
                            <div class="flex items-center gap-2">
                                <i class="far fa-clock text-white/20 text-xs"></i>
                                <span class="text-[11px] font-bold">{{ $auditLog->created_at }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-white/10">
                        <div class="p-4 rounded-xl bg-indigo-500/10 border border-indigo-500/20 text-center">
                            <i class="fas fa-shield-alt text-indigo-400 mb-2"></i>
                            <p class="text-[9px] font-black text-indigo-300 uppercase tracking-widest">Secure Entry</p>
                            <p class="text-[10px] text-white/60 font-medium mt-1">This record is protected by immutable architecture.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection