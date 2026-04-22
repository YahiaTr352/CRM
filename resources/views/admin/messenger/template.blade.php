@extends('layouts.admin')

@section('content')

<div class="max-w-[1400px] mx-auto px-4 md:px-6 lg:px-8 pt-2 md:pt-4 lg:pt-6 space-y-8 pb-12">
    <!-- Premium Header Section -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 pb-8 border-b border-slate-200/60 animate-in fade-in slide-in-from-top-4 duration-700">
        <div class="space-y-3">
            <div class="flex items-center gap-2">
                <div class="flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-indigo-50 border border-indigo-100/50">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                    </span>
                    <span class="text-[10px] font-bold text-indigo-600 uppercase tracking-widest">Internal Communications</span>
                </div>
                <span class="text-slate-300">/</span>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Secure Messaging</span>
            </div>

            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-indigo-600 flex items-center justify-center text-white shadow-xl shadow-indigo-100">
                    <i class="fas fa-paper-plane text-xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 tracking-tight">Intelligence Messenger</h1>
                    <p class="text-slate-500 font-medium text-sm mt-1 max-w-xl leading-relaxed">
                        Secure internal communication node for operational coordination and knowledge sharing.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col lg:flex-row gap-8 animate-in fade-in slide-in-from-bottom-4 duration-1000 delay-150">
        <!-- Sidebar Navigation (1/4 approx) -->
        <div class="lg:w-80 flex-shrink-0 space-y-6">
            <div class="space-y-3">
                <a href="{{ route('admin.messenger.createTopic') }}" class="flex items-center justify-center gap-2.5 w-full px-6 py-3.5 bg-indigo-600 rounded-2xl text-sm font-black text-white shadow-lg shadow-indigo-100 hover:bg-indigo-700 hover:-translate-y-0.5 transition-all active:scale-95 group">
                    <i class="fas fa-plus-circle text-indigo-200 group-hover:rotate-90 transition-transform"></i>
                    <span>{{ trans('global.new_message') }}</span>
                </a>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-4 border-b border-slate-50 bg-slate-50/30">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Communication Channels</p>
                </div>
                <div class="p-2 space-y-1">
                    <a href="{{ route('admin.messenger.index') }}" class="flex items-center justify-between px-4 py-3 rounded-xl transition-all group {{ request()->is('admin/messenger') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-600 hover:bg-slate-50' }}">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-layer-group text-sm {{ request()->is('admin/messenger') ? 'text-indigo-500' : 'text-slate-300' }}"></i>
                            <span class="text-sm font-bold">{{ trans('global.all_messages') }}</span>
                        </div>
                    </a>
                    
                    <a href="{{ route('admin.messenger.showInbox') }}" class="flex items-center justify-between px-4 py-3 rounded-xl transition-all group {{ request()->is('admin/messenger/inbox') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-600 hover:bg-slate-50' }}">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-inbox text-sm {{ request()->is('admin/messenger/inbox') ? 'text-indigo-500' : 'text-slate-300' }}"></i>
                            <span class="text-sm font-bold">{{ trans('global.inbox') }}</span>
                        </div>
                        @if($unreads['inbox'] > 0)
                            <span class="px-2 py-0.5 rounded-lg bg-indigo-600 text-white text-[10px] font-black shadow-sm">{{ $unreads['inbox'] }}</span>
                        @endif
                    </a>

                    <a href="{{ route('admin.messenger.showOutbox') }}" class="flex items-center justify-between px-4 py-3 rounded-xl transition-all group {{ request()->is('admin/messenger/outbox') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-600 hover:bg-slate-50' }}">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-paper-plane text-sm {{ request()->is('admin/messenger/outbox') ? 'text-indigo-500' : 'text-slate-300' }}"></i>
                            <span class="text-sm font-bold">{{ trans('global.outbox') }}</span>
                        </div>
                        @if($unreads['outbox'] > 0)
                            <span class="px-2 py-0.5 rounded-lg bg-slate-900 text-white text-[10px] font-black shadow-sm">{{ $unreads['outbox'] }}</span>
                        @endif
                    </a>
                </div>
            </div>

            <!-- Optional: Messenger Stats / Info -->
            <div class="bg-slate-900 rounded-2xl p-6 text-white shadow-xl shadow-slate-200">
                <div class="space-y-4">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-white/60 border border-white/5">
                            <i class="fas fa-shield-alt text-lg"></i>
                        </div>
                        <div>
                            <p class="text-[9px] font-black text-white/40 uppercase tracking-widest">End-to-End</p>
                            <p class="text-xs font-bold uppercase tracking-tight">Encryption Active</p>
                        </div>
                    </div>
                    <p class="text-[10px] text-white/40 leading-relaxed italic">Your communications are prioritized and protected by high-level security protocols.</p>
                </div>
            </div>
        </div>

        <!-- Main Messenger Content -->
        <div class="flex-grow space-y-8 min-w-0">
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-6 md:p-8 border-b border-slate-100 bg-slate-50/30">
                    <h2 class="text-lg font-bold text-slate-900">@yield('title')</h2>
                    <p class="text-slate-500 text-sm mt-1 font-medium">Internal message intelligence feed.</p>
                </div>
                <div class="p-0">
                    @yield('messenger-content')
                </div>
            </div>
        </div>
    </div>
</div>

@stop