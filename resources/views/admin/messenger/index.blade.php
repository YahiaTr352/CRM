@extends('admin.messenger.template')

@section('title', $title)

@section('messenger-content')
<div class="overflow-hidden">
    <div class="divide-y divide-slate-100">
        @forelse($topics as $topic)
            @php($receiverOrCreator = $topic->receiverOrCreator())
            <div class="group relative flex items-center gap-4 px-6 md:px-8 py-5 hover:bg-slate-50/80 transition-all cursor-pointer">
                <!-- User Avatar / Icon -->
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 rounded-xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 font-black text-sm group-hover:scale-110 transition-transform shadow-sm">
                        {{ substr($receiverOrCreator !== null ? $receiverOrCreator->email : '?', 0, 1) }}
                    </div>
                </div>

                <!-- Message Details -->
                <div class="flex-grow min-w-0">
                    <div class="flex items-center justify-between gap-4 mb-1">
                        <a href="{{ route('admin.messenger.showMessages', [$topic->id]) }}" class="block truncate">
                            <span class="text-sm font-black text-slate-900 {{ $topic->hasUnreads() ? 'text-indigo-600' : 'text-slate-900' }}">
                                {{ $receiverOrCreator !== null ? $receiverOrCreator->email : 'System Account' }}
                            </span>
                        </a>
                        <span class="text-[10px] font-bold text-slate-400 whitespace-nowrap">{{ $topic->created_at->diffForHumans() }}</span>
                    </div>
                    <a href="{{ route('admin.messenger.showMessages', [$topic->id]) }}" class="block">
                        <p class="text-sm {{ $topic->hasUnreads() ? 'font-extrabold text-slate-900' : 'font-medium text-slate-500' }} truncate">
                            {{ $topic->subject }}
                        </p>
                    </a>
                </div>

                <!-- Unread Indicator / Actions -->
                <div class="flex-shrink-0 flex items-center gap-3">
                    @if($topic->hasUnreads())
                        <div class="w-2.5 h-2.5 rounded-full bg-indigo-500 shadow-[0_0_8px_rgba(79,70,229,0.4)] animate-pulse"></div>
                    @endif
                    
                    <div class="opacity-0 group-hover:opacity-100 transition-opacity flex items-center gap-2">
                        <form action="{{ route('admin.messenger.destroyTopic', [$topic->id]) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" class="inline-block">
                            <input type="hidden" name="_method" value="DELETE">
                            @csrf
                            <button type="submit" class="w-9 h-9 rounded-xl flex items-center justify-center text-slate-400 bg-white border border-slate-100 shadow-sm hover:text-rose-600 hover:border-rose-100 hover:shadow-md transition-all active:scale-90" title="Terminate Thread">
                                <i class="fas fa-trash-alt text-xs"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Status Line -->
                @if($topic->hasUnreads())
                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-indigo-500 rounded-r-full"></div>
                @endif
            </div>
        @empty
            <div class="p-12 text-center">
                <div class="w-16 h-16 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-200 mx-auto mb-4">
                    <i class="fas fa-inbox text-2xl"></i>
                </div>
                <p class="text-sm font-bold text-slate-400 uppercase tracking-widest">{{ trans('global.you_have_no_messages') }}</p>
                <p class="text-xs text-slate-300 mt-1 font-medium italic">Communication channel currently inactive.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection