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
                    <span class="text-[10px] font-bold text-indigo-600 uppercase tracking-widest">Contact Intelligence</span>
                </div>
                <span class="text-slate-300">/</span>
                <a href="{{ route('admin.crm-contacts.index') }}" class="text-[10px] font-bold text-slate-400 hover:text-indigo-600 uppercase tracking-widest transition-colors">Directory</a>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-indigo-600 flex items-center justify-center text-white shadow-xl shadow-indigo-100">
                    <i class="fas fa-id-card text-xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 tracking-tight">{{ $crmContact->contact_first_name }} {{ $crmContact->contact_last_name }}</h1>
                    <p class="text-slate-500 font-medium text-sm mt-1 max-w-xl leading-relaxed">
                        Relationship profile and professional intelligence for <span class="text-indigo-600 font-bold">{{ $crmContact->company ?? 'Independent Expert' }}</span>.
                    </p>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('admin.crm-contacts.index') }}" class="inline-flex items-center gap-2.5 px-5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-600 shadow-sm hover:border-slate-300 hover:text-slate-900 transition-all active:scale-95">
                <i class="fas fa-arrow-left text-slate-400"></i>
                <span>Back to Directory</span>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 animate-in fade-in slide-in-from-bottom-4 duration-1000 delay-150">
        <!-- Main Content (2/3) -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Professional Identity -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100 bg-slate-50/30">
                    <h2 class="text-sm font-black text-slate-900 uppercase tracking-widest flex items-center gap-2">
                        <i class="fas fa-building text-indigo-500"></i>
                        Corporate Identity
                    </h2>
                </div>
                <div class="p-6 md:p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                        <div class="space-y-1">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ trans('cruds.crmContact.fields.contact_first_name') }}</p>
                            <p class="text-base font-bold text-slate-900">{{ $crmContact->contact_first_name }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ trans('cruds.crmContact.fields.contact_last_name') }}</p>
                            <p class="text-base font-bold text-slate-900">{{ $crmContact->contact_last_name }}</p>
                        </div>
                        <div class="space-y-1 md:col-span-2">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ trans('cruds.crmContact.fields.company') }}</p>
                            <div class="flex items-center gap-3 pt-1">
                                <div class="w-12 h-12 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-600 border border-indigo-100 shadow-sm">
                                    <i class="fas fa-building"></i>
                                </div>
                                <div>
                                    <p class="text-lg font-black text-slate-900 tracking-tight">{{ $crmContact->company ?? 'Individual Professional' }}</p>
                                    <p class="text-[11px] text-slate-400 font-bold uppercase tracking-widest">Primary Organization</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Communication Channels -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100 bg-slate-50/30">
                    <h2 class="text-sm font-black text-slate-900 uppercase tracking-widest flex items-center gap-2">
                        <i class="fas fa-at text-indigo-500"></i>
                        Communication Hub
                    </h2>
                </div>
                <div class="p-6 md:p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                        <div class="space-y-1">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ trans('cruds.crmContact.fields.contact_email') }}</p>
                            <div class="flex items-center gap-2 pt-1">
                                <i class="fas fa-envelope text-indigo-500 text-xs"></i>
                                <span class="text-sm font-bold text-slate-900">{{ $crmContact->contact_email ?? 'No email associated' }}</span>
                            </div>
                        </div>
                        <div class="space-y-1">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ trans('cruds.crmContact.fields.contact_phone_1') }}</p>
                            <div class="flex items-center gap-2 pt-1">
                                <i class="fas fa-phone text-indigo-500 text-xs"></i>
                                <span class="text-sm font-bold text-slate-900">{{ $crmContact->contact_phone_1 ?? 'Not recorded' }}</span>
                            </div>
                        </div>
                        <div class="space-y-1">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ trans('cruds.crmContact.fields.contact_phone_2') }}</p>
                            <div class="flex items-center gap-2 pt-1">
                                <i class="fas fa-mobile-alt text-indigo-500 text-xs"></i>
                                <span class="text-sm font-bold text-slate-900">{{ $crmContact->contact_phone_2 ?? 'Not recorded' }}</span>
                            </div>
                        </div>
                        <div class="space-y-1">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ trans('cruds.crmContact.fields.contact_address') }}</p>
                            <div class="flex items-start gap-2 pt-1">
                                <i class="fas fa-map-marker-alt text-indigo-500 text-xs mt-1"></i>
                                <span class="text-sm font-bold text-slate-900 leading-tight">{{ $crmContact->contact_address ?? 'No physical address' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notes & Background -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100 bg-slate-50/30">
                    <h2 class="text-sm font-black text-slate-900 uppercase tracking-widest flex items-center gap-2">
                        <i class="fas fa-sticky-note text-indigo-500"></i>
                        Strategic Notes
                    </h2>
                </div>
                <div class="p-8 prose prose-slate max-w-none">
                    @if($crmContact->contact_description)
                        <div class="text-slate-600 leading-relaxed font-medium bg-slate-50 p-6 rounded-2xl border border-slate-100">
                            {{ $crmContact->contact_description }}
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center py-12 text-slate-400 italic">
                            <i class="fas fa-comment-slash text-3xl mb-4 opacity-20"></i>
                            <p class="text-sm">No strategic background has been recorded for this relationship.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar (1/3) -->
        <div class="space-y-8">
            <!-- Quick Outreach Actions -->
            <div class="bg-indigo-600 rounded-2xl p-6 text-white shadow-xl shadow-indigo-100 relative overflow-hidden group">
                <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-white/10 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700"></div>
                <div class="relative z-10">
                    <h3 class="text-sm font-black uppercase tracking-widest mb-4">Quick Outreach</h3>
                    <div class="grid grid-cols-2 gap-3">
                        <a href="mailto:{{ $crmContact->contact_email }}" class="flex flex-col items-center gap-2 p-3 bg-white/10 rounded-xl hover:bg-white/20 transition-colors">
                            <i class="fas fa-envelope"></i>
                            <span class="text-[10px] font-bold uppercase tracking-widest">Email</span>
                        </a>
                        <a href="tel:{{ $crmContact->contact_phone_1 }}" class="flex flex-col items-center gap-2 p-3 bg-white/10 rounded-xl hover:bg-white/20 transition-colors">
                            <i class="fas fa-phone"></i>
                            <span class="text-[10px] font-bold uppercase tracking-widest">Call</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Relationship Engagement Card (Timeline & Delete) -->
            <div class="bg-slate-900 rounded-2xl p-6 text-white shadow-xl shadow-slate-200">
                <div class="space-y-4">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-white/60">
                            <i class="fas fa-history text-lg"></i>
                        </div>
                        <div>
                            <p class="text-[9px] font-black text-white/40 uppercase tracking-widest">Engagement Timeline</p>
                            <p class="text-xs font-bold">Relationship Age</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 gap-4 pt-4 border-t border-white/10">
                        <div>
                            <p class="text-[9px] font-black text-white/40 uppercase tracking-widest mb-1">{{ trans('cruds.crmContact.fields.created_at') }}</p>
                            <p class="text-[11px] font-bold">{{ $crmContact->created_at ? $crmContact->created_at->format('M d, Y') : 'N/A' }}</p>
                        </div>
                    </div>

                    @can('crm_contact_delete')
                        <form action="{{ route('admin.crm-contacts.destroy', $crmContact->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" class="pt-4">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="w-full py-3 rounded-xl bg-rose-500/10 border border-rose-500/20 text-rose-500 text-xs font-bold hover:bg-rose-500 hover:text-white transition-all duration-300">
                                <i class="fas fa-trash-alt mr-2"></i>
                                Terminate Relationship
                            </button>
                        </form>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
