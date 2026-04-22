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
                    <span class="text-[10px] font-bold text-amber-600 uppercase tracking-widest">Operator Refinement</span>
                </div>
                <span class="text-slate-300">/</span>
                <a href="{{ route('admin.users.index') }}" class="text-[10px] font-bold text-slate-400 hover:text-indigo-600 uppercase tracking-widest transition-colors">Operator Directory</a>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-indigo-600 flex items-center justify-center text-white shadow-xl shadow-indigo-100">
                    <i class="fas fa-user-edit text-xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 tracking-tight">Refine Operator Access</h1>
                    <p class="text-slate-500 font-medium text-sm mt-1 max-w-xl">
                        Updating security credentials and authority levels for <span class="text-indigo-600 font-bold">{{ $user->name }}</span>.
                    </p>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-2.5 px-5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-600 shadow-sm hover:border-slate-300 hover:text-slate-900 transition-all active:scale-95">
                <i class="fas fa-arrow-left text-slate-400"></i>
                <span>Back to Directory</span>
            </a>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden animate-in fade-in slide-in-from-bottom-4 duration-1000 delay-150">
        <div class="p-6 md:p-8 border-b border-slate-100 bg-slate-50/30">
            <h2 class="text-lg font-bold text-slate-900">Security Specifications</h2>
            <p class="text-slate-500 text-sm mt-1 font-medium">Modify identity and access control parameters.</p>
        </div>

        <form method="POST" action="{{ route("admin.users.update", [$user->id]) }}" enctype="multipart/form-data" class="p-6 md:p-8 space-y-10">
            @method('PUT')
            @csrf
            
            <!-- Basic Identity -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-3">
                    <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2" for="name">
                        {{ trans('cruds.user.fields.name') }}
                        <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors group-focus-within:text-indigo-500 text-slate-400">
                            <i class="fas fa-user text-sm"></i>
                        </div>
                        <input class="w-full pl-11 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-900 placeholder:text-slate-400 placeholder:font-medium focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all {{ $errors->has('name') ? 'border-rose-300 bg-rose-50/30' : '' }}" type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                    </div>
                    @if($errors->has('name'))
                        <p class="text-[11px] font-bold text-rose-500 mt-1 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>

                <div class="space-y-3">
                    <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2" for="email">
                        {{ trans('cruds.user.fields.email') }}
                        <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors group-focus-within:text-indigo-500 text-slate-400">
                            <i class="fas fa-envelope text-sm"></i>
                        </div>
                        <input class="w-full pl-11 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-900 placeholder:text-slate-400 placeholder:font-medium focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all {{ $errors->has('email') ? 'border-rose-300 bg-rose-50/30' : '' }}" type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
                    </div>
                    @if($errors->has('email'))
                        <p class="text-[11px] font-bold text-rose-500 mt-1 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                </div>
            </div>

            <!-- Password Refinement -->
            <div class="space-y-3">
                <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2" for="password">
                    {{ trans('cruds.user.fields.password') }}
                    <span class="text-[10px] text-slate-400 font-bold lowercase tracking-normal">(Leave blank to keep current)</span>
                </label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors group-focus-within:text-indigo-500 text-slate-400">
                        <i class="fas fa-key text-sm"></i>
                    </div>
                    <input class="w-full pl-11 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-900 placeholder:text-slate-400 placeholder:font-medium focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all {{ $errors->has('password') ? 'border-rose-300 bg-rose-50/30' : '' }}" type="password" name="password" id="password" placeholder="••••••••">
                </div>
                @if($errors->has('password'))
                    <p class="text-[11px] font-bold text-rose-500 mt-1 flex items-center gap-1">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $errors->first('password') }}
                    </p>
                @endif
            </div>

            <!-- Role Assignment -->
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2" for="roles">
                        {{ trans('cruds.user.fields.roles') }}
                        <span class="text-rose-500">*</span>
                    </label>
                    <div class="flex gap-2">
                        <button type="button" class="select-all text-[10px] font-black text-indigo-600 uppercase tracking-widest hover:text-indigo-700 transition-colors">Select All</button>
                        <span class="text-slate-300">|</span>
                        <button type="button" class="deselect-all text-[10px] font-black text-slate-400 uppercase tracking-widest hover:text-slate-600 transition-colors">Deselect All</button>
                    </div>
                </div>
                <div class="relative group">
                    <select class="form-control select2 w-full" name="roles[]" id="roles" multiple required>
                        @foreach($roles as $id => $role)
                            <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || $user->roles->contains($id)) ? 'selected' : '' }}>{{ $role }}</option>
                        @endforeach
                    </select>
                </div>
                @if($errors->has('roles'))
                    <p class="text-[11px] font-bold text-rose-500 mt-1 flex items-center gap-1">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $errors->first('roles') }}
                    </p>
                @endif
            </div>

            <!-- Approval Status Toggle -->
            <div class="p-6 bg-slate-50/50 rounded-2xl border border-slate-100">
                <div class="flex items-center justify-between">
                    <div class="space-y-1">
                        <label class="text-[11px] font-black text-slate-900 uppercase tracking-widest" for="approved">
                            {{ trans('cruds.user.fields.approved') }}
                        </label>
                        <p class="text-[10px] text-slate-500 font-bold uppercase tracking-tight">Grant operational authority to this operator.</p>
                    </div>
                    
                    <div class="relative inline-flex items-center cursor-pointer">
                        <input type="hidden" name="approved" value="0">
                        <input type="checkbox" name="approved" id="approved" value="1" class="sr-only peer" {{ $user->approved || old('approved', 0) === 1 ? 'checked' : '' }}>
                        <div onclick="document.getElementById('approved').click()" class="w-12 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500 transition-colors shadow-inner"></div>
                    </div>
                </div>
            </div>

            <!-- Submit Section -->
            <div class="pt-8 border-t border-slate-100 flex items-center justify-end gap-4">
                <a href="{{ route('admin.users.index') }}" class="px-6 py-3 text-sm font-bold text-slate-500 hover:text-slate-800 transition-colors">
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

@section('scripts')
@parent
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Assign security roles...",
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