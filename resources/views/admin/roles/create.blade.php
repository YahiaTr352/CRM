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
                    <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-widest">Authority Definition</span>
                </div>
                <span class="text-slate-300">/</span>
                <a href="{{ route('admin.roles.index') }}" class="text-[10px] font-bold text-slate-400 hover:text-indigo-600 uppercase tracking-widest transition-colors">Authority Matrix</a>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-indigo-600 flex items-center justify-center text-white shadow-xl shadow-indigo-100">
                    <i class="fas fa-plus text-xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 tracking-tight">Establish New Authority</h1>
                    <p class="text-slate-500 font-medium text-sm mt-1 max-w-xl leading-relaxed">
                        Configure a new security profile to regulate system capabilities and operator access.
                    </p>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('admin.roles.index') }}" class="inline-flex items-center gap-2.5 px-5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-600 shadow-sm hover:border-slate-300 hover:text-slate-900 transition-all active:scale-95">
                <i class="fas fa-arrow-left text-slate-400"></i>
                <span>Back to Matrix</span>
            </a>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden animate-in fade-in slide-in-from-bottom-4 duration-1000 delay-150">
        <div class="p-6 md:p-8 border-b border-slate-100 bg-slate-50/30">
            <h2 class="text-lg font-bold text-slate-900">Authority Specifications</h2>
            <p class="text-slate-500 text-sm mt-1 font-medium">Core information for security profile classification.</p>
        </div>

        <form method="POST" action="{{ route("admin.roles.store") }}" enctype="multipart/form-data" class="p-6 md:p-8 space-y-10">
            @csrf
            
            <!-- Role Title -->
            <div class="space-y-3">
                <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2" for="title">
                    {{ trans('cruds.role.fields.title') }}
                    <span class="text-rose-500">*</span>
                </label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors group-focus-within:text-indigo-500 text-slate-400">
                        <i class="fas fa-shield-alt text-sm"></i>
                    </div>
                    <input class="w-full pl-11 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-900 placeholder:text-slate-400 placeholder:font-medium focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all {{ $errors->has('title') ? 'border-rose-300 bg-rose-50/30' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" placeholder="Enter authority profile name" required>
                </div>
                @if($errors->has('title'))
                    <p class="text-[11px] font-bold text-rose-500 mt-1 flex items-center gap-1">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $errors->first('title') }}
                    </p>
                @endif
                @if(trans('cruds.role.fields.title_helper'))
                    <p class="text-[10px] text-slate-400 font-medium ml-1 italic">{{ trans('cruds.role.fields.title_helper') }}</p>
                @endif
            </div>

            <!-- Permissions Selection -->
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2" for="permissions">
                        {{ trans('cruds.role.fields.permissions') }}
                        <span class="text-rose-500">*</span>
                    </label>
                    <div class="flex gap-2">
                        <button type="button" class="select-all text-[10px] font-black text-indigo-600 uppercase tracking-widest hover:text-indigo-700 transition-colors">Select All</button>
                        <span class="text-slate-300">|</span>
                        <button type="button" class="deselect-all text-[10px] font-black text-slate-400 uppercase tracking-widest hover:text-slate-600 transition-colors">Deselect All</button>
                    </div>
                </div>
                <div class="relative group">
                    <select class="form-control select2 w-full" name="permissions[]" id="permissions" multiple required>
                        @foreach($permissions as $id => $permission)
                            <option value="{{ $id }}" {{ in_array($id, old('permissions', [])) ? 'selected' : '' }}>{{ $permission }}</option>
                        @endforeach
                    </select>
                </div>
                @if($errors->has('permissions'))
                    <p class="text-[11px] font-bold text-rose-500 mt-1 flex items-center gap-1">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $errors->first('permissions') }}
                    </p>
                @endif
                @if(trans('cruds.role.fields.permissions_helper'))
                    <p class="text-[10px] text-slate-400 font-medium ml-1 italic">{{ trans('cruds.role.fields.permissions_helper') }}</p>
                @endif
            </div>

            <!-- Submit Section -->
            <div class="pt-8 border-t border-slate-100 flex items-center justify-end gap-4">
                <a href="{{ route('admin.roles.index') }}" class="px-6 py-3 text-sm font-bold text-slate-500 hover:text-slate-800 transition-colors">
                    Discard Changes
                </a>
                <button class="inline-flex items-center gap-2.5 px-8 py-3 bg-indigo-600 rounded-xl text-sm font-bold text-white shadow-xl shadow-indigo-100 hover:bg-indigo-700 hover:-translate-y-0.5 hover:shadow-indigo-200 transition-all active:scale-95" type="submit">
                    <i class="fas fa-check-circle"></i>
                    <span>Securely Save Authority</span>
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
@parent
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Map system capabilities...",
            allowClear: true
        });

        $('.select-all').click(function () {
            let $select2 = $(this).parent().parent().find('.select2')
            $select2.find('option').prop('selected', 'selected')
            $select2.trigger('change')
        })
        $('.deselect-all').click(function () {
            let $select2 = $(this).parent().parent().find('.select2')
            $select2.find('option').prop('selected', false)
            $select2.trigger('change')
        })
    });
</script>
<style>
    .select2-container--default .select2-selection--multiple {
        border: 1px solid #e2e8f0 !important;
        border-radius: 0.75rem !important;
        padding: 6px 12px !important;
        min-height: 48px !important;
    }
    .select2-container--default.select2-container--focus .select2-selection--multiple {
        border-color: #4f46e5 !important;
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1) !important;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #0f172a !important;
        border: none !important;
        color: white !important;
        font-size: 10px !important;
        font-weight: 900 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.05em !important;
        border-radius: 6px !important;
        padding: 2px 8px !important;
        margin-top: 4px !important;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: white !important;
        margin-right: 5px !important;
    }
</style>
@endsection
