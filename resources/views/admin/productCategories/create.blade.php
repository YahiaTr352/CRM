@extends('layouts.admin')
@section('content')

<div class="max-w-[800px] mx-auto px-4 md:px-6 lg:px-8 pt-2 md:pt-4 lg:pt-6 space-y-8">
    <!-- Premium Header Section -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 pb-8 border-b border-slate-200/60 animate-in fade-in slide-in-from-top-4 duration-700">
        <div class="space-y-3">
            <div class="flex items-center gap-2">
                <div class="flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-50 border border-emerald-100/50">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                    <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-widest">Category Definition</span>
                </div>
                <span class="text-slate-300">/</span>
                <a href="{{ route('admin.product-categories.index') }}" class="text-[10px] font-bold text-slate-400 hover:text-indigo-600 uppercase tracking-widest transition-colors">Category Matrix</a>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-indigo-600 flex items-center justify-center text-white shadow-xl shadow-indigo-100">
                    <i class="fas fa-plus text-xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 tracking-tight">Define New Category</h1>
                    <p class="text-slate-500 font-medium text-sm mt-1 max-w-xl leading-relaxed">
                        Establish a new operational segment for your product catalog.
                    </p>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('admin.product-categories.index') }}" class="inline-flex items-center gap-2.5 px-5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-600 shadow-sm hover:border-slate-300 hover:text-slate-900 transition-all active:scale-95">
                <i class="fas fa-arrow-left text-slate-400"></i>
                <span>Back to Matrix</span>
            </a>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden animate-in fade-in slide-in-from-bottom-4 duration-1000 delay-150">
        <div class="p-6 md:p-8 border-b border-slate-100 bg-slate-50/30">
            <h2 class="text-lg font-bold text-slate-900">Category Specifications</h2>
            <p class="text-slate-500 text-sm mt-1 font-medium">Core information for segment classification.</p>
        </div>

        <form method="POST" action="{{ route("admin.product-categories.store") }}" enctype="multipart/form-data" class="p-6 md:p-8 space-y-10">
            @csrf
            
            <!-- Category Name -->
            <div class="space-y-3">
                <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2" for="name">
                    {{ trans('cruds.productCategory.fields.name') }}
                    <span class="text-rose-500">*</span>
                </label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors group-focus-within:text-indigo-500 text-slate-400">
                        <i class="fas fa-layer-group text-sm"></i>
                    </div>
                    <input class="w-full pl-11 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-900 placeholder:text-slate-400 placeholder:font-medium focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all {{ $errors->has('name') ? 'border-rose-300 bg-rose-50/30' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" placeholder="Enter unique category name" required>
                </div>
                @if($errors->has('name'))
                    <p class="text-[11px] font-bold text-rose-500 mt-1 flex items-center gap-1">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $errors->first('name') }}
                    </p>
                @endif
                @if(trans('cruds.productCategory.fields.name_helper'))
                    <p class="text-[10px] text-slate-400 font-medium ml-1 italic">{{ trans('cruds.productCategory.fields.name_helper') }}</p>
                @endif
            </div>

            <!-- Active Status Toggle -->
            <div class="space-y-3 p-6 bg-slate-50/50 rounded-2xl border border-slate-100">
                <div class="flex items-center justify-between">
                    <div class="space-y-1">
                        <label class="text-[11px] font-black text-slate-900 uppercase tracking-widest" for="active">
                            {{ trans('cruds.productCategory.fields.active') }}
                        </label>
                        <p class="text-[10px] text-slate-500 font-bold uppercase tracking-tight">Should this segment be immediately operational?</p>
                    </div>
                    
                    <div class="relative inline-flex items-center cursor-pointer">
                        <input type="hidden" name="active" value="0">
                        <input type="checkbox" name="active" id="active" value="1" class="sr-only peer" {{ old('active', 0) == 1 || old('active') === null ? 'checked' : '' }}>
                        <div onclick="document.getElementById('active').click()" class="w-12 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500 transition-colors shadow-inner"></div>
                    </div>
                </div>
                @if($errors->has('active'))
                    <p class="text-[11px] font-bold text-rose-500 mt-1">
                        {{ $errors->first('active') }}
                    </p>
                @endif
                @if(trans('cruds.productCategory.fields.active_helper'))
                    <p class="text-[10px] text-slate-400 font-medium italic mt-1">{{ trans('cruds.productCategory.fields.active_helper') }}</p>
                @endif
            </div>

            <!-- Submit Section -->
            <div class="pt-8 border-t border-slate-100 flex items-center justify-end gap-4">
                <a href="{{ route('admin.product-categories.index') }}" class="px-6 py-3 text-sm font-bold text-slate-500 hover:text-slate-800 transition-colors">
                    Discard Changes
                </a>
                <button class="inline-flex items-center gap-2.5 px-8 py-3 bg-indigo-600 rounded-xl text-sm font-bold text-white shadow-xl shadow-indigo-100 hover:bg-indigo-700 hover:-translate-y-0.5 hover:shadow-indigo-200 transition-all active:scale-95" type="submit">
                    <i class="fas fa-check-circle"></i>
                    <span>Securely Save Category</span>
                </button>
            </div>
        </form>
    </div>
</div>

@endsection