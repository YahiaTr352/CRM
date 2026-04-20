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
                    <span class="text-[10px] font-bold text-indigo-600 uppercase tracking-widest">New Relationship</span>
                </div>
                <span class="text-slate-300">/</span>
                <a href="{{ route('admin.crm-contacts.index') }}" class="text-[10px] font-bold text-slate-400 hover:text-indigo-600 uppercase tracking-widest transition-colors">Directory</a>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-indigo-600 flex items-center justify-center text-white shadow-xl shadow-indigo-100">
                    <i class="fas fa-user-plus text-xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 tracking-tight">Register Contact</h1>
                    <p class="text-slate-500 font-medium text-sm mt-1 max-w-xl leading-relaxed">
                        Initialize a new professional connection within your centralized intelligence hub.
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

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden animate-in fade-in slide-in-from-bottom-4 duration-1000 delay-150">
        <div class="p-6 md:p-8 border-b border-slate-100 bg-slate-50/30">
            <h2 class="text-lg font-bold text-slate-900">Contact Specifications</h2>
            <p class="text-slate-500 text-sm mt-1 font-medium">Please provide the identification and communication details for this relationship.</p>
        </div>

        <form method="POST" action="{{ route("admin.crm-contacts.store") }}" enctype="multipart/form-data" class="p-6 md:p-8 space-y-10">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-10">
                <!-- Company Name -->
                <div class="space-y-3 md:col-span-2">
                    <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2" for="company">
                        {{ trans('cruds.crmContact.fields.company') }}
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors group-focus-within:text-indigo-500 text-slate-400">
                            <i class="fas fa-building text-sm"></i>
                        </div>
                        <input class="w-full h-12 pl-11 pr-4 bg-slate-50/50 border border-slate-200 rounded-xl text-sm font-bold text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:bg-white transition-all {{ $errors->has('company') ? 'border-rose-300 bg-rose-50/30' : '' }}" type="text" name="company" id="company" value="{{ old('company', '') }}" placeholder="Organization or Company name">
                    </div>
                    @if($errors->has('company'))
                        <p class="text-[11px] font-bold text-rose-500 mt-1 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('company') }}
                        </p>
                    @endif
                </div>

                <!-- First Name -->
                <div class="space-y-3">
                    <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2" for="contact_first_name">
                        {{ trans('cruds.crmContact.fields.contact_first_name') }}
                        <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors group-focus-within:text-indigo-500 text-slate-400">
                            <i class="fas fa-user text-sm"></i>
                        </div>
                        <input class="w-full h-12 pl-11 pr-4 bg-slate-50/50 border border-slate-200 rounded-xl text-sm font-bold text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:bg-white transition-all {{ $errors->has('contact_first_name') ? 'border-rose-300 bg-rose-50/30' : '' }}" type="text" name="contact_first_name" id="contact_first_name" value="{{ old('contact_first_name', '') }}" placeholder="Given name" required>
                    </div>
                    @if($errors->has('contact_first_name'))
                        <p class="text-[11px] font-bold text-rose-500 mt-1">
                            {{ $errors->first('contact_first_name') }}
                        </p>
                    @endif
                </div>

                <!-- Last Name -->
                <div class="space-y-3">
                    <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2" for="contact_last_name">
                        {{ trans('cruds.crmContact.fields.contact_last_name') }}
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors group-focus-within:text-indigo-500 text-slate-400">
                            <i class="fas fa-user-tag text-sm"></i>
                        </div>
                        <input class="w-full h-12 pl-11 pr-4 bg-slate-50/50 border border-slate-200 rounded-xl text-sm font-bold text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:bg-white transition-all {{ $errors->has('contact_last_name') ? 'border-rose-300 bg-rose-50/30' : '' }}" type="text" name="contact_last_name" id="contact_last_name" value="{{ old('contact_last_name', '') }}" placeholder="Family name">
                    </div>
                    @if($errors->has('contact_last_name'))
                        <p class="text-[11px] font-bold text-rose-500 mt-1">
                            {{ $errors->first('contact_last_name') }}
                        </p>
                    @endif
                </div>

                <!-- Phone 1 -->
                <div class="space-y-3">
                    <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2" for="contact_phone_1">
                        {{ trans('cruds.crmContact.fields.contact_phone_1') }}
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors group-focus-within:text-indigo-500 text-slate-400">
                            <i class="fas fa-phone text-sm"></i>
                        </div>
                        <input class="w-full h-12 pl-11 pr-4 bg-slate-50/50 border border-slate-200 rounded-xl text-sm font-bold text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:bg-white transition-all {{ $errors->has('contact_phone_1') ? 'border-rose-300 bg-rose-50/30' : '' }}" type="text" name="contact_phone_1" id="contact_phone_1" value="{{ old('contact_phone_1', '') }}" placeholder="Primary phone number">
                    </div>
                    @if($errors->has('contact_phone_1'))
                        <p class="text-[11px] font-bold text-rose-500 mt-1">
                            {{ $errors->first('contact_phone_1') }}
                        </p>
                    @endif
                </div>

                <!-- Phone 2 -->
                <div class="space-y-3">
                    <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2" for="contact_phone_2">
                        {{ trans('cruds.crmContact.fields.contact_phone_2') }}
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors group-focus-within:text-indigo-500 text-slate-400">
                            <i class="fas fa-mobile-alt text-sm"></i>
                        </div>
                        <input class="w-full h-12 pl-11 pr-4 bg-slate-50/50 border border-slate-200 rounded-xl text-sm font-bold text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:bg-white transition-all {{ $errors->has('contact_phone_2') ? 'border-rose-300 bg-rose-50/30' : '' }}" type="text" name="contact_phone_2" id="contact_phone_2" value="{{ old('contact_phone_2', '') }}" placeholder="Secondary/Mobile number">
                    </div>
                    @if($errors->has('contact_phone_2'))
                        <p class="text-[11px] font-bold text-rose-500 mt-1">
                            {{ $errors->first('contact_phone_2') }}
                        </p>
                    @endif
                </div>

                <!-- Email -->
                <div class="space-y-3">
                    <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2" for="contact_email">
                        {{ trans('cruds.crmContact.fields.contact_email') }}
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors group-focus-within:text-indigo-500 text-slate-400">
                            <i class="fas fa-envelope text-sm"></i>
                        </div>
                        <input class="w-full h-12 pl-11 pr-4 bg-slate-50/50 border border-slate-200 rounded-xl text-sm font-bold text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:bg-white transition-all {{ $errors->has('contact_email') ? 'border-rose-300 bg-rose-50/30' : '' }}" type="email" name="contact_email" id="contact_email" value="{{ old('contact_email', '') }}" placeholder="name@example.com">
                    </div>
                    @if($errors->has('contact_email'))
                        <p class="text-[11px] font-bold text-rose-500 mt-1">
                            {{ $errors->first('contact_email') }}
                        </p>
                    @endif
                </div>

                <!-- Address -->
                <div class="space-y-3">
                    <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2" for="contact_address">
                        {{ trans('cruds.crmContact.fields.contact_address') }}
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors group-focus-within:text-indigo-500 text-slate-400">
                            <i class="fas fa-map-marker-alt text-sm"></i>
                        </div>
                        <input class="w-full h-12 pl-11 pr-4 bg-slate-50/50 border border-slate-200 rounded-xl text-sm font-bold text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:bg-white transition-all {{ $errors->has('contact_address') ? 'border-rose-300 bg-rose-50/30' : '' }}" type="text" name="contact_address" id="contact_address" value="{{ old('contact_address', '') }}" placeholder="Full business or personal address">
                    </div>
                    @if($errors->has('contact_address'))
                        <p class="text-[11px] font-bold text-rose-500 mt-1">
                            {{ $errors->first('contact_address') }}
                        </p>
                    @endif
                </div>

                <!-- Description -->
                <div class="space-y-3 md:col-span-2">
                    <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2" for="contact_description">
                        {{ trans('cruds.crmContact.fields.contact_description') }}
                    </label>
                    <div class="relative group">
                        <div class="absolute top-4 left-0 pl-4 flex items-start pointer-events-none transition-colors group-focus-within:text-indigo-500 text-slate-400">
                            <i class="fas fa-align-left text-sm"></i>
                        </div>
                        <textarea class="w-full pl-11 pr-4 py-3 bg-slate-50/50 border border-slate-200 rounded-xl text-sm font-bold text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:bg-white transition-all min-h-[120px] {{ $errors->has('contact_description') ? 'border-rose-300 bg-rose-50/30' : '' }}" name="contact_description" id="contact_description" placeholder="Strategic background or notes on this connection...">{{ old('contact_description') }}</textarea>
                    </div>
                    @if($errors->has('contact_description'))
                        <p class="text-[11px] font-bold text-rose-500 mt-1">
                            {{ $errors->first('contact_description') }}
                        </p>
                    @endif
                </div>
            </div>

            <!-- Submit Section -->
            <div class="pt-10 border-t border-slate-100 flex items-center justify-end gap-6">
                <a href="{{ route('admin.crm-contacts.index') }}" class="text-sm font-bold text-slate-400 hover:text-slate-600 transition-colors">
                    Discard Entry
                </a>
                <button class="inline-flex items-center gap-2.5 px-8 py-4 bg-indigo-600 rounded-xl text-sm font-bold text-white shadow-xl shadow-indigo-200 hover:bg-indigo-700 hover:-translate-y-0.5 transition-all active:scale-95" type="submit">
                    <i class="fas fa-plus-circle"></i>
                    <span>Register New Relationship</span>
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
