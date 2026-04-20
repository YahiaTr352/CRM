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
                    <span class="text-[10px] font-bold text-indigo-600 uppercase tracking-widest">Opportunity Intelligence</span>
                </div>
                <span class="text-slate-300">/</span>
                <a href="{{ route('admin.deals.index') }}" class="text-[10px] font-bold text-slate-400 hover:text-indigo-600 uppercase tracking-widest transition-colors">Pipeline</a>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-slate-900 flex items-center justify-center text-white shadow-xl shadow-slate-200">
                    <i class="fas fa-eye text-xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 tracking-tight">{{ $deal->deal_name }}</h1>
                    <p class="text-slate-500 font-medium text-sm mt-1 max-w-xl leading-relaxed">
                        Comprehensive overview of the <span class="text-indigo-600 font-bold">ID-{{ str_pad($deal->id, 5, '0', STR_PAD_LEFT) }}</span> sales opportunity.
                    </p>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            @can('deal_edit')
                <a href="{{ route('admin.deals.edit', $deal->id) }}" class="inline-flex items-center gap-2.5 px-5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-600 shadow-sm hover:border-indigo-200 hover:text-indigo-600 transition-all active:scale-95">
                    <i class="fas fa-edit text-slate-400"></i>
                    <span>Edit Deal</span>
                </a>
            @endcan
            <a href="{{ route('admin.deals.index') }}" class="inline-flex items-center gap-2.5 px-5 py-2.5 bg-slate-900 rounded-xl text-sm font-bold text-white shadow-lg shadow-slate-200 hover:bg-slate-800 transition-all active:scale-95">
                <i class="fas fa-arrow-left opacity-50"></i>
                <span>Back to Pipeline</span>
            </a>
        </div>
    </div>

    <!-- Stage Progress Tracker -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 animate-in fade-in slide-in-from-bottom-4 duration-1000 delay-75">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-[11px] font-black text-slate-400 uppercase tracking-widest">Current Pipeline Stage</h3>
            <div class="flex items-center gap-2">
                @php
                    $stageName = $deal->stage->name ?? 'Unassigned';
                    $color = 'indigo';
                    if (stripos($stageName, 'won') !== false || stripos($stageName, 'closed') !== false) $color = 'emerald';
                    elseif (stripos($stageName, 'lost') !== false) $color = 'rose';
                    elseif (stripos($stageName, 'negotiation') !== false) $color = 'amber';
                @endphp
                <span class="px-3 py-1 rounded-lg bg-{{ $color }}-50 text-[10px] font-black text-{{ $color }}-600 uppercase tracking-widest border border-{{ $color }}-100/50">
                    {{ $stageName }}
                </span>
            </div>
        </div>
        
        <div class="relative px-4">
            <div class="absolute top-1/2 left-0 w-full h-0.5 bg-slate-100 -translate-y-1/2"></div>
            <div class="relative flex justify-between">
                @foreach($stages as $id => $name)
                    @php
                        $isCompleted = ($deal->stage->id ?? 0) >= $id;
                        $isCurrent = ($deal->stage->id ?? 0) == $id;
                    @endphp
                    <div class="flex flex-col items-center gap-3 group relative">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center z-10 transition-all duration-500 {{ $isCompleted ? 'bg-'.$color.'-600 text-white shadow-lg shadow-'.$color.'-100' : 'bg-white border-2 border-slate-200 text-slate-400' }} {{ $isCurrent ? 'ring-4 ring-'.$color.'-50' : '' }}">
                            @if($isCompleted && !$isCurrent)
                                <i class="fas fa-check text-[10px]"></i>
                            @else
                                <span class="text-[10px] font-bold">{{ $loop->iteration }}</span>
                            @endif
                        </div>
                        <span class="text-[9px] font-black uppercase tracking-tighter transition-colors {{ $isCompleted ? 'text-'.$color.'-600' : 'text-slate-400' }}">{{ $name }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 animate-in fade-in slide-in-from-bottom-4 duration-1000 delay-150">
        <!-- Main Content (2/3) -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Core Deal Intelligence -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100 bg-slate-50/30">
                    <h2 class="text-sm font-black text-slate-900 uppercase tracking-widest flex items-center gap-2">
                        <i class="fas fa-info-circle text-indigo-500"></i>
                        Core Specifications
                    </h2>
                </div>
                <div class="p-6 md:p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                        <div class="space-y-1">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ trans('cruds.deal.fields.deal_name') }}</p>
                            <p class="text-base font-bold text-slate-900">{{ $deal->deal_name }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ trans('cruds.deal.fields.amount') }}</p>
                            <p class="text-2xl font-black text-slate-900 tracking-tight">${{ number_format($deal->amount, 2) }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ trans('cruds.deal.fields.contact_name') }}</p>
                            <div class="flex items-center gap-3 pt-1">
                                <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-600 font-black text-xs border border-indigo-100">
                                    {{ substr($deal->contact_name->contact_first_name ?? 'U', 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-900">{{ $deal->contact_name->contact_first_name ?? 'N/A' }} {{ $deal->contact_name->contact_last_name ?? '' }}</p>
                                    <p class="text-[11px] text-slate-400 font-medium">{{ $deal->contact_name->contact_email ?? 'No email associated' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-1">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ trans('cruds.deal.fields.closing_date') }}</p>
                            <div class="flex items-center gap-2 pt-1 text-slate-900 font-bold">
                                <i class="far fa-calendar-check text-indigo-500"></i>
                                <span>{{ $deal->closing_date ?? 'Not Set' }}</span>
                            </div>
                        </div>
                        <div class="space-y-1">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ trans('cruds.deal.fields.source') }}</p>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-slate-100 text-[11px] font-bold text-slate-600 border border-slate-200/50">
                                {{ $deal->source->name ?? 'Direct Entry' }}
                            </span>
                        </div>
                        <div class="space-y-1">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ trans('cruds.deal.fields.created_by') }}</p>
                            <p class="text-sm font-bold text-slate-900">{{ $deal->created_by->name ?? 'System' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description & Strategic Notes -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100 bg-slate-50/30">
                    <h2 class="text-sm font-black text-slate-900 uppercase tracking-widest flex items-center gap-2">
                        <i class="fas fa-file-alt text-indigo-500"></i>
                        Strategic Intelligence
                    </h2>
                </div>
                <div class="p-8 prose prose-slate max-w-none">
                    @if($deal->description)
                        <div class="text-slate-600 leading-relaxed font-medium">
                            {!! $deal->description !!}
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center py-12 text-slate-400 italic">
                            <i class="fas fa-comment-slash text-3xl mb-4 opacity-20"></i>
                            <p class="text-sm">No strategic description has been recorded for this deal.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar Content (1/3) -->
        <div class="space-y-8">
            <!-- Products Card -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-5 border-b border-slate-100 bg-slate-50/30 flex items-center justify-between">
                    <h2 class="text-[10px] font-black text-slate-900 uppercase tracking-widest">Target Products</h2>
                    <span class="w-6 h-6 rounded-lg bg-indigo-600 text-white flex items-center justify-center text-[10px] font-black">{{ $deal->products->count() }}</span>
                </div>
                <div class="p-5">
                    <div class="flex flex-wrap gap-2">
                        @forelse($deal->products as $product)
                            <div class="group flex items-center gap-2 px-3 py-2 rounded-xl bg-slate-50 border border-slate-100 hover:border-indigo-200 hover:bg-white transition-all duration-300 w-full">
                                <div class="w-2 h-2 rounded-full bg-indigo-400 group-hover:scale-125 transition-transform"></div>
                                <span class="text-xs font-bold text-slate-700">{{ $product->product_name }}</span>
                            </div>
                        @empty
                            <p class="text-xs font-medium text-slate-400 italic">No products associated.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Attachments Card -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-5 border-b border-slate-100 bg-slate-50/30">
                    <h2 class="text-[10px] font-black text-slate-900 uppercase tracking-widest">Supporting Assets</h2>
                </div>
                <div class="p-5 space-y-3">
                    @forelse($deal->attachments as $media)
                        <a href="{{ $media->getUrl() }}" target="_blank" class="flex items-center justify-between p-3 rounded-xl bg-slate-50 border border-slate-100 hover:bg-white hover:border-indigo-200 hover:shadow-md hover:shadow-indigo-500/5 transition-all group">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-white border border-slate-100 flex items-center justify-center text-slate-400 group-hover:text-indigo-600 transition-colors">
                                    <i class="fas fa-file-download text-sm"></i>
                                </div>
                                <div class="overflow-hidden">
                                    <p class="text-xs font-bold text-slate-700 truncate max-w-[140px]">{{ $media->name }}</p>
                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">{{ $media->human_readable_size }}</p>
                                </div>
                            </div>
                            <i class="fas fa-chevron-right text-[10px] text-slate-300 group-hover:text-indigo-500 group-hover:translate-x-1 transition-all"></i>
                        </a>
                    @empty
                        <div class="text-center py-6">
                            <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest">No Attachments</p>
                        </div>
                    @endforelse
                </div>
            </div>

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
                            <p class="text-[9px] font-black text-white/40 uppercase tracking-widest mb-1">{{ trans('cruds.deal.fields.created_at') }}</p>
                            <p class="text-[11px] font-bold">{{ $deal->created_at ? $deal->created_at->format('M d, Y') : 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-[9px] font-black text-white/40 uppercase tracking-widest mb-1">{{ trans('cruds.deal.fields.updated_at') }}</p>
                            <p class="text-[11px] font-bold">{{ $deal->updated_at ? $deal->updated_at->format('M d, Y') : 'N/A' }}</p>
                        </div>
                    </div>

                    @can('deal_delete')
                        <form action="{{ route('admin.deals.destroy', $deal->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" class="pt-4">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="w-full py-3 rounded-xl bg-rose-500/10 border border-rose-500/20 text-rose-500 text-xs font-bold hover:bg-rose-500 hover:text-white transition-all duration-300">
                                <i class="fas fa-trash-alt mr-2"></i>
                                Terminate Opportunity
                            </button>
                        </form>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
