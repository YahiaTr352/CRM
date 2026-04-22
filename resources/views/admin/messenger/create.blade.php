@extends('admin.messenger.template')

@section('title', trans('global.new_message'))

@section('messenger-content')
<div class="p-6 md:p-8">
    <form action="{{ route("admin.messenger.storeTopic") }}" method="POST" class="space-y-8">
        @csrf
        
        <!-- Recipient Selection -->
        <div class="space-y-3">
            <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2" for="recipient">
                <i class="fas fa-user-plus text-indigo-500"></i>
                {{ trans('global.recipient') }}
                <span class="text-rose-500">*</span>
            </label>
            <div class="relative group">
                <select name="recipient" id="recipient" class="w-full pl-4 pr-10 py-3 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-900 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all appearance-none">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->email }}</option>
                    @endforeach
                </select>
                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-500 transition-colors">
                    <i class="fas fa-chevron-down text-xs"></i>
                </div>
            </div>
        </div>

        <!-- Message Subject -->
        <div class="space-y-3">
            <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2" for="subject">
                <i class="fas fa-heading text-indigo-500"></i>
                {{ trans('global.subject') }}
                <span class="text-rose-500">*</span>
            </label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors group-focus-within:text-indigo-500 text-slate-400">
                    <i class="fas fa-pencil-alt text-sm"></i>
                </div>
                <input type="text" name="subject" id="subject" class="w-full pl-11 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-900 placeholder:text-slate-400 placeholder:font-medium focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all" placeholder="Brief descriptive subject..." required />
            </div>
        </div>

        <!-- Message Content -->
        <div class="space-y-3">
            <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2" for="content">
                <i class="fas fa-align-left text-indigo-500"></i>
                {{ trans('global.content') }}
                <span class="text-rose-500">*</span>
            </label>
            <div class="relative group">
                <textarea name="content" id="content" rows="6" class="w-full px-4 py-4 bg-white border border-slate-200 rounded-2xl text-sm font-medium text-slate-700 placeholder:text-slate-400 placeholder:font-medium focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all leading-relaxed" placeholder="Compose your intelligence brief here..." required></textarea>
            </div>
        </div>

        <!-- Action Bar -->
        <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-4">
            <a href="{{ route('admin.messenger.index') }}" class="px-6 py-3 text-sm font-bold text-slate-500 hover:text-slate-800 transition-colors">
                Discard Draft
            </a>
            <button type="submit" class="inline-flex items-center gap-2.5 px-8 py-3 bg-indigo-600 rounded-xl text-sm font-black text-white shadow-xl shadow-indigo-100 hover:bg-indigo-700 hover:-translate-y-0.5 hover:shadow-indigo-200 transition-all active:scale-95">
                <i class="fas fa-paper-plane text-indigo-200"></i>
                <span>{{ trans('global.submit') }}</span>
            </button>
        </div>
    </form>
</div>
@stop