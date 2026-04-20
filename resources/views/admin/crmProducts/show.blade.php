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
                    <span class="text-[10px] font-bold text-indigo-600 uppercase tracking-widest">Product Intelligence</span>
                </div>
                <span class="text-slate-300">/</span>
                <a href="{{ route('admin.crm-products.index') }}" class="text-[10px] font-bold text-slate-400 hover:text-indigo-600 uppercase tracking-widest transition-colors">Catalog</a>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-slate-900 flex items-center justify-center text-white shadow-xl shadow-slate-200">
                    <i class="fas fa-box text-xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 tracking-tight">{{ $crmProduct->product_name }}</h1>
                    <p class="text-slate-500 font-medium text-sm mt-1 max-w-xl leading-relaxed">
                        Comprehensive asset specifications and market valuation for <span class="text-indigo-600 font-bold">{{ $crmProduct->product_code ?? 'ID-'.str_pad($crmProduct->id, 5, '0', STR_PAD_LEFT) }}</span>.
                    </p>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            @can('crm_product_edit')
                <a href="{{ route('admin.crm-products.edit', $crmProduct->id) }}" class="inline-flex items-center gap-2.5 px-5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-600 shadow-sm hover:border-indigo-200 hover:text-indigo-600 transition-all active:scale-95">
                    <i class="fas fa-edit text-slate-400"></i>
                    <span>Modify Asset</span>
                </a>
            @endcan
            <a href="{{ route('admin.crm-products.index') }}" class="inline-flex items-center gap-2.5 px-5 py-2.5 bg-slate-900 rounded-xl text-sm font-bold text-white shadow-lg shadow-slate-200 hover:bg-slate-800 transition-all active:scale-95">
                <i class="fas fa-arrow-left opacity-50"></i>
                <span>Back to Catalog</span>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 animate-in fade-in slide-in-from-bottom-4 duration-1000 delay-150">
        <!-- Sidebar / Visual Section (1/3) -->
        <div class="lg:col-span-1 space-y-8">
            <!-- Asset Identity Card -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="aspect-square relative group bg-slate-50">
                    @if($crmProduct->product_image)
                        <img src="{{ $crmProduct->product_image->getUrl() }}" class="w-full h-full object-cover" alt="{{ $crmProduct->product_name }}">
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center text-slate-300 gap-4">
                            <div class="w-20 h-20 rounded-2xl bg-slate-100 flex items-center justify-center">
                                <i class="fas fa-image text-4xl"></i>
                            </div>
                            <span class="text-xs font-black uppercase tracking-widest text-slate-400">No Visual Data</span>
                        </div>
                    @endif
                    
                    <div class="absolute top-4 right-4">
                        <span class="px-3 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg {{ $crmProduct->product_active ? 'bg-emerald-500 text-white shadow-emerald-200' : 'bg-rose-500 text-white shadow-rose-200' }}">
                            {{ $crmProduct->product_active ? 'Active Status' : 'Inactive Asset' }}
                        </span>
                    </div>
                </div>
                
                <div class="p-6 space-y-6">
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Commercial Value</p>
                        <div class="flex items-baseline gap-1">
                            <span class="text-3xl font-black text-slate-900 tracking-tight">{{ number_format($crmProduct->unit_price, 2) }}</span>
                            <span class="text-sm font-bold text-slate-400">USD/Unit</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Asset Code</p>
                            <p class="text-xs font-bold text-slate-700 tracking-wider uppercase">{{ $crmProduct->product_code ?? 'N/A' }}</p>
                        </div>
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Classification</p>
                            <p class="text-xs font-bold text-slate-700">{{ $crmProduct->product_category->name ?? 'None' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="bg-slate-900 rounded-2xl p-6 text-white shadow-xl shadow-slate-200">
                <h3 class="text-xs font-black uppercase tracking-widest text-slate-400 mb-6 flex items-center gap-2">
                    <i class="fas fa-history text-indigo-400"></i>
                    Audit & Timeline
                </h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between py-3 border-b border-slate-800">
                        <span class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Registered</span>
                        <span class="text-xs font-bold">{{ $crmProduct->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="flex items-center justify-between py-3">
                        <span class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Last Update</span>
                        <span class="text-xs font-bold text-indigo-400">{{ $crmProduct->updated_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content (2/3) -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Strategic Overview -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100 bg-slate-50/30">
                    <h2 class="text-sm font-black text-slate-900 uppercase tracking-widest flex items-center gap-2">
                        <i class="fas fa-align-left text-indigo-500"></i>
                        Strategic Specifications
                    </h2>
                </div>
                <div class="p-6 md:p-8">
                    <div class="prose prose-slate max-w-none prose-p:text-slate-600 prose-p:leading-relaxed prose-strong:text-slate-900 prose-p:font-medium">
                        @if($crmProduct->description)
                            {!! $crmProduct->description !!}
                        @else
                            <div class="flex flex-col items-center justify-center py-12 text-slate-400 bg-slate-50 rounded-2xl border-2 border-dashed border-slate-200">
                                <i class="fas fa-file-alt text-3xl mb-3 opacity-20"></i>
                                <p class="text-sm font-bold uppercase tracking-widest">No detailed description available</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Asset Parameters -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100 bg-slate-50/30">
                    <h2 class="text-sm font-black text-slate-900 uppercase tracking-widest flex items-center gap-2">
                        <i class="fas fa-sliders-h text-indigo-500"></i>
                        Technical Parameters
                    </h2>
                </div>
                <div class="p-6 md:p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <div class="group">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 flex items-center gap-2">
                                <i class="fas fa-tag text-indigo-500 opacity-50"></i>
                                Asset Name
                            </p>
                            <p class="text-lg font-black text-slate-900 tracking-tight">{{ $crmProduct->product_name }}</p>
                        </div>
                        
                        <div class="group">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 flex items-center gap-2">
                                <i class="fas fa-barcode text-indigo-500 opacity-50"></i>
                                Product Code
                            </p>
                            <p class="text-lg font-black text-slate-900 tracking-tight uppercase">{{ $crmProduct->product_code ?? 'UNCODED' }}</p>
                        </div>

                        <div class="group">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 flex items-center gap-2">
                                <i class="fas fa-layer-group text-indigo-500 opacity-50"></i>
                                Category Assignment
                            </p>
                            <div class="flex items-center gap-2">
                                <span class="px-3 py-1 rounded-lg bg-indigo-50 border border-indigo-100 text-xs font-bold text-indigo-600">
                                    {{ $crmProduct->product_category->name ?? 'Unassigned' }}
                                </span>
                            </div>
                        </div>

                        <div class="group">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 flex items-center gap-2">
                                <i class="fas fa-dollar-sign text-indigo-500 opacity-50"></i>
                                Market Valuation
                            </p>
                            <p class="text-lg font-black text-slate-900 tracking-tight">{{ number_format($crmProduct->unit_price, 2) }} <span class="text-xs font-bold text-slate-400 uppercase ml-1">USD</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection