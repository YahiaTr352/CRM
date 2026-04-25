@extends('layouts.admin')
@section('content')

<div class="max-w-[1600px] mx-auto px-4 md:px-6 lg:px-8 pt-2 md:pt-4 lg:pt-6 space-y-8 pb-10">
    <!-- Premium Header Section -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 pb-8 border-b border-slate-200/60 animate-in fade-in slide-in-from-top-4 duration-1000">
        <div class="space-y-3">
            <div class="flex items-center gap-2">
                <div class="flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-indigo-50 border border-indigo-100/50 shadow-sm">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                    </span>
                    <span class="text-[10px] font-bold text-indigo-600 uppercase tracking-widest">Global Pipeline</span>
                </div>
                <span class="text-slate-300">/</span>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Visual Strategy</span>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-indigo-600 flex items-center justify-center text-white shadow-2xl shadow-indigo-100">
                    <i class="fas fa-layer-group text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-4xl font-black text-slate-900 tracking-tight">Sales Kanban</h1>
                    <p class="text-slate-500 font-medium text-sm mt-1 max-w-xl leading-relaxed">
                        Strategize and move deals through your ecosystem with a <span class="text-indigo-600 font-bold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-violet-600">high-fidelity visual interface</span>.
                    </p>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-500 transition-colors">
                    <i class="fas fa-search text-xs"></i>
                </div>
                <input type="text" id="kanbanSearch" placeholder="Find a deal..." class="pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-2xl text-sm font-bold text-slate-900 placeholder:text-slate-400 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 w-72 transition-all shadow-sm group-hover:border-slate-300">
            </div>
            
            @can('deal_create')
                <a href="{{ route('admin.deals.create') }}" class="inline-flex items-center gap-2.5 px-6 py-3 bg-indigo-600 rounded-2xl text-sm font-bold text-white shadow-xl shadow-indigo-100 hover:bg-indigo-700 hover:-translate-y-1 hover:shadow-indigo-200 transition-all active:scale-95">
                    <i class="fas fa-plus"></i>
                    <span>New Deal</span>
                </a>
            @endcan
        </div>
    </div>

    <!-- Kanban Board Section -->
    <div class="overflow-x-auto pb-8 -mx-4 px-4 md:-mx-6 md:px-6 lg:-mx-8 lg:px-8 custom-scrollbar">
        <div class="flex flex-nowrap gap-8 min-h-[calc(100vh-340px)]">
            @foreach ($deal_stage as $stage)
                @php
                    $stageName = strtolower($stage->name);
                    $colorClass = 'indigo';
                    if (strpos($stageName, 'won') !== false || strpos($stageName, 'closed') !== false) $colorClass = 'emerald';
                    elseif (strpos($stageName, 'lost') !== false) $colorClass = 'rose';
                    elseif (strpos($stageName, 'negotiation') !== false) $colorClass = 'amber';
                    elseif (strpos($stageName, 'discovery') !== false) $colorClass = 'blue';
                    
                    $stageDeals = $deals->where('stage_id', $stage->id);
                    $stageTotal = $stageDeals->sum('amount');
                @endphp
                <div class="flex-none w-[340px] flex flex-col group/column animate-in fade-in slide-in-from-bottom-6 duration-1000" style="animation-delay: {{ $loop->index * 150 }}ms">
                    <!-- Column Header -->
                    <div class="mb-6 flex flex-col gap-2 px-1">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-2 h-6 rounded-full bg-{{ $colorClass }}-500 shadow-[0_0_12px_rgba(var(--tw-color-{{ $colorClass }}-500),0.4)]"></div>
                                <h3 class="text-xs font-black text-slate-900 uppercase tracking-[0.15em]">{{ $stage->name }}</h3>
                            </div>
                            <span class="flex items-center justify-center px-2 py-0.5 rounded-lg bg-white border border-slate-200 text-[10px] font-black text-slate-500 shadow-sm">
                                {{ $stageDeals->count() }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between pt-1 border-t border-slate-100 mt-1">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Volume</span>
                            <span class="text-xs font-black text-slate-900 tracking-tight">${{ number_format($stageTotal, 0) }}</span>
                        </div>
                    </div>

                    <!-- Cards Container -->
                    <div class="flex-1 bg-slate-50/40 rounded-[2rem] border border-slate-200/60 p-4 space-y-4 transition-all group-hover/column:bg-slate-50/80 items-container" data-stage-id="{{ $stage->id }}">
                        @foreach ($stageDeals as $deal)
                            <div class="deal-card group/card bg-white p-5 rounded-2xl border border-slate-200 shadow-sm hover:shadow-2xl hover:shadow-{{ $colorClass }}-500/10 hover:-translate-y-1.5 transition-all duration-500 cursor-grab active:cursor-grabbing relative overflow-hidden" 
                                 id="deal-{{ $deal->id }}" 
                                 draggable="true" 
                                 ondragstart="drag(event)"
                                 data-search="{{ strtolower($deal->deal_name . ' ' . $deal->name) }}">
                                
                                <!-- Status Pulse Accent -->
                                <div class="absolute top-0 right-0 p-3">
                                    <div class="w-1.5 h-1.5 rounded-full bg-{{ $colorClass }}-400 animate-pulse"></div>
                                </div>

                                <div class="space-y-4">
                                    <div class="space-y-1">
                                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">ID-{{ str_pad($deal->id, 5, '0', STR_PAD_LEFT) }}</p>
                                        <a href="{{ route('admin.deals.show', ['deal' => $deal->id ]) }}" class="text-base font-black text-slate-900 leading-snug hover:text-indigo-600 transition-colors block">
                                            {{ $deal->deal_name }}
                                        </a>
                                    </div>

                                    <div class="grid grid-cols-2 gap-3 p-3 rounded-xl bg-slate-50/50 border border-slate-100 group-hover/card:bg-white group-hover/card:border-{{ $colorClass }}-100 transition-colors">
                                        <div class="space-y-0.5">
                                            <p class="text-[8px] font-black text-slate-400 uppercase tracking-tighter">Value</p>
                                            <p class="text-xs font-black text-slate-900">${{ number_format($deal->amount, 0) }}</p>
                                        </div>
                                        <div class="space-y-0.5">
                                            <p class="text-[8px] font-black text-slate-400 uppercase tracking-tighter">Source</p>
                                            <p class="text-[10px] font-bold text-slate-600 truncate uppercase">{{ $deal->name }}</p>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between gap-3 pt-1">
                                        <div class="flex items-center gap-2">
                                            <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center text-[10px] font-black text-slate-600 border border-white group-hover/card:from-{{ $colorClass }}-50 group-hover/card:to-{{ $colorClass }}-100 group-hover/card:text-{{ $colorClass }}-600 transition-all duration-500">
                                                {{ substr($deal->deal_name, 0, 1) }}
                                            </div>
                                            @if($deal->closing_date)
                                                <div class="space-y-0.5">
                                                    <p class="text-[8px] font-black text-slate-400 uppercase tracking-tighter leading-none">Close Date</p>
                                                    <p class="text-[10px] font-bold text-slate-500">{{ \Carbon\Carbon::parse($deal->closing_date)->format('M d') }}</p>
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <div class="flex items-center gap-1.5 opacity-0 group-hover/card:opacity-100 transition-all duration-300 translate-x-2 group-hover/card:translate-x-0">
                                            <a href="{{ route('admin.deals.edit', ['deal' => $deal->id ]) }}" class="w-8 h-8 rounded-xl bg-white flex items-center justify-center text-slate-400 hover:text-blue-600 hover:shadow-lg hover:shadow-blue-500/10 transition-all border border-slate-100">
                                                <i class="fas fa-edit text-[10px]"></i>
                                            </a>
                                            <a href="{{ route('admin.deals.show', ['deal' => $deal->id ]) }}" class="w-8 h-8 rounded-xl bg-white flex items-center justify-center text-slate-400 hover:text-indigo-600 hover:shadow-lg hover:shadow-indigo-500/10 transition-all border border-slate-100">
                                                <i class="fas fa-eye text-[10px]"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="dropzone h-2 rounded-xl border-2 border-transparent transition-all" ondrop="drop(event)" ondragover="allowDrop(event)" ondragleave="clearDrop(event)"></div>
                        @endforeach
                        
                        @if($stageDeals->isEmpty())
                             <div class="dropzone h-32 rounded-3xl border-2 border-dashed border-slate-200 flex flex-col items-center justify-center gap-3 group/empty transition-all hover:border-{{ $colorClass }}-300 hover:bg-{{ $colorClass }}-50/30" ondrop="drop(event)" ondragover="allowDrop(event)" ondragleave="clearDrop(event)">
                                <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-300 group-hover/empty:bg-white group-hover/empty:text-{{ $colorClass }}-400 transition-all">
                                    <i class="fas fa-plus text-sm"></i>
                                </div>
                                <span class="text-[10px] font-black text-slate-300 uppercase tracking-widest group-hover/empty:text-{{ $colorClass }}-500 transition-colors">Move Here</span>
                             </div>
                        @else
                             <div class="dropzone h-12 rounded-xl border-2 border-transparent transition-all" ondrop="drop(event)" ondragover="allowDrop(event)" ondragleave="clearDrop(event)"></div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<style>
    /* Premium Scrollbar */
    .custom-scrollbar::-webkit-scrollbar {
        height: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f8fafc;
        border-radius: 20px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #e2e8f0;
        border-radius: 20px;
        border: 3px solid #f8fafc;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #cbd5e1;
    }

    /* Drag & Drop Visuals */
    .droppable {
        background-color: rgba(79, 70, 229, 0.08) !important;
        border-color: #4f46e5 !important;
        border-style: dashed !important;
        height: 80px !important;
        margin: 10px 0 !important;
        box-shadow: inset 0 0 20px rgba(79, 70, 229, 0.05);
    }

    .deal-card.dragging {
        opacity: 0.3;
        transform: scale(0.9) rotate(2deg);
        cursor: grabbing;
        filter: grayscale(1);
    }
</style>

@endsection

@section('scripts')
@parent
<script>
const drag = (event) => {
  event.dataTransfer.setData("text/plain", event.target.id);
  setTimeout(() => {
    event.target.classList.add('dragging');
  }, 0);
}

document.addEventListener('dragend', (event) => {
    if (event.target.classList.contains('deal-card')) {
        event.target.classList.remove('dragging');
    }
});

const allowDrop = (ev) => {
  ev.preventDefault();
  let target = ev.target.closest('.dropzone');
  if (target) {
    target.classList.add("droppable");
  }
}

const clearDrop = (ev) => {
    let target = ev.target.closest('.dropzone');
    if (target) {
        target.classList.remove("droppable");
    }
}

const drop = (event) => {
  event.preventDefault();
  let dropzone = event.target.closest('.dropzone');
  if (!dropzone) return;

  dropzone.classList.remove("droppable");
  
  const data = event.dataTransfer.getData("text/plain");
  const element = document.getElementById(data);
  
  if (!element) return;

  try {
    element.style.opacity = "0";
    dropzone.parentNode.insertBefore(element, dropzone);
    
    if (!element.nextElementSibling || !element.nextElementSibling.classList.contains('dropzone')) {
        let newDz = document.createElement('div');
        newDz.className = 'dropzone h-2 rounded-xl border-2 border-transparent transition-all';
        newDz.setAttribute('ondrop', 'drop(event)');
        newDz.setAttribute('ondragover', 'allowDrop(event)');
        newDz.setAttribute('ondragleave', 'clearDrop(event)');
        element.parentNode.insertBefore(newDz, element.nextSibling);
    }

    setTimeout(() => {
        element.style.opacity = "1";
    }, 50);

    const newStageId = dropzone.closest('.items-container').dataset.stageId;
    console.info(`%c Kanban Update %c Deal ${data.replace('deal-', '')} -> Stage ${newStageId}`, 'background: #4f46e5; color: white; font-weight: bold; border-radius: 4px 0 0 4px; padding: 2px 6px;', 'background: #f1f5f9; color: #1e293b; padding: 2px 6px; border-radius: 0 4px 4px 0;');
    
  } catch (error) {
    console.error("Board orchestration error:", error);
  }
};

document.getElementById('kanbanSearch').addEventListener('input', function(e) {
    let term = e.target.value.toLowerCase();
    document.querySelectorAll('.deal-card').forEach(card => {
        let content = card.dataset.search;
        let isMatch = content.includes(term);
        
        card.style.display = isMatch ? 'block' : 'none';
        if (card.nextElementSibling && card.nextElementSibling.classList.contains('dropzone')) {
            card.nextElementSibling.style.display = isMatch ? 'block' : 'none';
        }
        
        if (isMatch && term !== "") {
            card.classList.add('ring-2', 'ring-indigo-500/20', 'border-indigo-300');
        } else {
            card.classList.remove('ring-2', 'ring-indigo-500/20', 'border-indigo-300');
        }
    });
});
</script>
@endsection
