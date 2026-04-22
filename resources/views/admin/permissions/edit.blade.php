@extends('layouts.admin')
@section('content')

<div class="max-w-[800px] mx-auto px-4 md:px-6 lg:px-8 pt-2 md:pt-4 lg:pt-6 space-y-8">
    <!-- Premium Header Section -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 pb-8 border-b border-slate-200/60 animate-in fade-in slide-in-from-top-4 duration-700">
        <div class="space-y-3">
            <div class="flex items-center gap-2">
                <div class="flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-amber-50 border border-amber-100/50">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                    </span>
                    <span class="text-[10px] font-bold text-amber-600 uppercase tracking-widest">Refinement Mode</span>
                </div>
                <span class="text-slate-300">/</span>
                <a href="{{ route('admin.permissions.index') }}" class="text-[10px] font-bold text-slate-400 hover:text-indigo-600 uppercase tracking-widest transition-colors">Permission Matrix</a>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-indigo-600 flex items-center justify-center text-white shadow-xl shadow-indigo-100">
                    <i class="fas fa-edit text-xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 tracking-tight">Refine Capability</h1>
                    <p class="text-slate-500 font-medium text-sm mt-1 max-w-xl leading-relaxed">
                        Updating the atomic system capability <span class="text-indigo-600 font-bold uppercase tracking-tight">{{ $permission->title }}</span> specifications.
                    </p>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('admin.permissions.index') }}" class="inline-flex items-center gap-2.5 px-5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-600 shadow-sm hover:border-slate-300 hover:text-slate-900 transition-all active:scale-95">
                <i class="fas fa-arrow-left text-slate-400"></i>
                <span>Back to Matrix</span>
            </a>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden animate-in fade-in slide-in-from-bottom-4 duration-1000 delay-150">
        <div class="p-6 md:p-8 border-b border-slate-100 bg-slate-50/30">
            <h2 class="text-lg font-bold text-slate-900">Capability Refinement</h2>
            <p class="text-slate-500 text-sm mt-1 font-medium">Modify core specifications for atomic access control.</p>
        </div>

        <form method="POST" action="{{ route("admin.permissions.update", [$permission->id]) }}" enctype="multipart/form-data" class="p-6 md:p-8 space-y-10">
            @method('PUT')
            @csrf
            
            <!-- Permission Title -->
            <div class="space-y-3">
                <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2" for="title">
                    {{ trans('cruds.permission.fields.title') }}
                    <span class="text-rose-500">*</span>
                </label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors group-focus-within:text-indigo-500 text-slate-400">
                        <i class="fas fa-key text-sm"></i>
                    </div>
                    <input class="w-full pl-11 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-900 placeholder:text-slate-400 placeholder:font-medium focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all {{ $errors->has('title') ? 'border-rose-300 bg-rose-50/30' : '' }}" type="text" name="title" id="title" value="{{ old('title', $permission->title) }}" placeholder="Enter unique capability name" required>
                </div>
                @if($errors->has('title'))
                    <p class="text-[11px] font-bold text-rose-500 mt-1 flex items-center gap-1">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $errors->first('title') }}
                    </p>
                @endif
                @if(trans('cruds.permission.fields.title_helper'))
                    <p class="text-[10px] text-slate-400 font-medium ml-1 italic">{{ trans('cruds.permission.fields.title_helper') }}</p>
                @endif
            </div>

            <!-- Submit Section -->
            <div class="pt-8 border-t border-slate-100 flex items-center justify-end gap-4">
                <a href="{{ route('admin.permissions.index') }}" class="px-6 py-3 text-sm font-bold text-slate-500 hover:text-slate-800 transition-colors">
                    Discard Changes
                </a>
                <button class="inline-flex items-center gap-2.5 px-8 py-3 bg-indigo-600 rounded-xl text-sm font-bold text-white shadow-xl shadow-indigo-100 hover:bg-indigo-700 hover:-translate-y-0.5 hover:shadow-indigo-200 transition-all active:scale-95" type="submit">
                    <i class="fas fa-check-circle"></i>
                    <span>Commit Refinement</span>
                </button>
            </div>
        </form>
    </div>
</div>

@endsection