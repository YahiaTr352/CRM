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
                    <span class="text-[10px] font-bold text-indigo-600 uppercase tracking-widest">Capability Intelligence</span>
                </div>
                <span class="text-slate-300">/</span>
                <a href="{{ route('admin.permissions.index') }}" class="text-[10px] font-bold text-slate-400 hover:text-indigo-600 uppercase tracking-widest transition-colors">Permission Matrix</a>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-slate-900 flex items-center justify-center text-white shadow-xl shadow-slate-200">
                    <i class="fas fa-eye text-xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 tracking-tight">Permission Details</h1>
                    <p class="text-slate-500 font-medium text-sm mt-1 max-w-xl leading-relaxed">
                        Comprehensive overview of the atomic system capability <span class="text-indigo-600 font-bold uppercase tracking-tight">{{ $permission->title }}</span>.
                    </p>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            @can('permission_edit')
                <a href="{{ route('admin.permissions.edit', $permission->id) }}" class="inline-flex items-center gap-2.5 px-5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-600 shadow-sm hover:border-indigo-200 hover:text-indigo-600 transition-all active:scale-95">
                    <i class="fas fa-edit text-slate-400"></i>
                    <span>Edit Capability</span>
                </a>
            @endcan
            <a href="{{ route('admin.permissions.index') }}" class="inline-flex items-center gap-2.5 px-5 py-2.5 bg-slate-900 rounded-xl text-sm font-bold text-white shadow-lg shadow-slate-200 hover:bg-slate-800 transition-all active:scale-95">
                <i class="fas fa-arrow-left opacity-50"></i>
                <span>Back to Matrix</span>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 animate-in fade-in slide-in-from-bottom-4 duration-1000 delay-150">
        <!-- Main Content (2/3) -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Core Capability Card -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100 bg-slate-50/30">
                    <h2 class="text-sm font-black text-slate-900 uppercase tracking-widest flex items-center gap-2">
                        <i class="fas fa-info-circle text-indigo-500"></i>
                        Core Specification
                    </h2>
                </div>
                <div class="p-6 md:p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                        <div class="space-y-1">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ trans('cruds.permission.fields.title') }}</p>
                            <div class="flex items-center gap-3 pt-1">
                                <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-600 font-black text-xs border border-indigo-100">
                                    {{ substr($permission->title, 0, 1) }}
                                </div>
                                <p class="text-base font-bold text-slate-900 uppercase tracking-tight">{{ $permission->title }}</p>
                            </div>
                        </div>
                        <div class="space-y-1">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Internal Identifier</p>
                            <p class="text-base font-mono font-bold text-indigo-600 pt-1">PRM-{{ str_pad($permission->id, 5, '0', STR_PAD_LEFT) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Optional: Authority Mapping Placeholder -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden p-12 text-center">
                <div class="w-16 h-16 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-300 mx-auto mb-4">
                    <i class="fas fa-shield-alt text-2xl"></i>
                </div>
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-widest">Authority Mapping</h3>
                <p class="text-xs text-slate-400 mt-1">Cross-referencing authority roles associated with this capability.</p>
            </div>
        </div>

        <!-- Sidebar Content (1/3) -->
        <div class="space-y-8">
            <!-- Metadata Card -->
            <div class="bg-slate-900 rounded-2xl p-6 text-white shadow-xl shadow-slate-200">
                <div class="space-y-4">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-white/60">
                            <i class="fas fa-history text-lg"></i>
                        </div>
                        <div>
                            <p class="text-[9px] font-black text-white/40 uppercase tracking-widest">Capability Timeline</p>
                            <p class="text-xs font-bold">Protocol Record</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 gap-4 pt-4 border-t border-white/10">
                        <div>
                            <p class="text-[9px] font-black text-white/40 uppercase tracking-widest mb-1">Registration Date</p>
                            <p class="text-[11px] font-bold">{{ $permission->created_at ? $permission->created_at->format('M d, Y') : 'N/A' }}</p>
                        </div>
                    </div>

                    @can('permission_delete')
                        <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" class="pt-4">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="w-full py-3 rounded-xl bg-rose-500/10 border border-rose-500/20 text-rose-500 text-xs font-bold hover:bg-rose-500 hover:text-white transition-all duration-300">
                                <i class="fas fa-trash-alt mr-2"></i>
                                Terminate Capability
                            </button>
                        </form>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>

@endsection