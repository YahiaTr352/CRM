@extends('layouts.admin')
@section('content')

<div class="max-w-[1600px] mx-auto px-4 md:px-6 lg:px-8 pt-2 md:pt-4 lg:pt-6 space-y-8">
    <!-- Premium Header Section -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 pb-8 border-b border-slate-200/60 animate-in fade-in slide-in-from-top-4 duration-700">
        <div class="space-y-3">
            <div class="flex items-center gap-2">
                <div class="flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-indigo-50 border border-indigo-100/50">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                    </span>
                    <span class="text-[10px] font-bold text-indigo-600 uppercase tracking-widest">Tasks Live</span>
                </div>
                <span class="text-slate-300">/</span>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Project Management</span>
            </div>

            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-indigo-600 flex items-center justify-center text-white shadow-xl shadow-indigo-100">
                    <i class="fas fa-tasks text-xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 tracking-tight">Task Dashboard</h1>
                    <p class="text-slate-500 font-medium text-sm mt-1 max-w-xl">
                        Monitor, assign, and track progress of your project tasks in real-time.
                    </p>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <!-- Export Dropdown -->
            <div class="relative group">
                <button class="inline-flex items-center gap-2.5 px-5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-600 shadow-sm hover:border-slate-300 hover:text-slate-900 transition-all active:scale-95">
                    <i class="fas fa-download text-slate-400 group-hover:text-indigo-500 transition-colors"></i>
                    <span>Export</span>
                    <i class="fas fa-chevron-down text-[10px] ml-1 opacity-50"></i>
                </button>
                <div class="absolute right-0 mt-2 w-48 bg-white/95 backdrop-blur-xl border border-slate-100 rounded-2xl shadow-xl shadow-slate-200/60 py-3 hidden group-hover:block z-50 animate-in fade-in zoom-in-95 duration-200">
                    <div class="px-4 pb-2 mb-2 border-b border-slate-50">
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Select Format</span>
                    </div>
                    <button class="export-link w-full flex items-center gap-3 px-4 py-2.5 text-xs font-bold text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 transition-colors text-left" data-type="copy">
                        <div class="w-8 h-8 rounded-lg bg-slate-50 flex items-center justify-center">
                            <i class="fas fa-copy opacity-50"></i>
                        </div>
                        <span>Copy Table</span>
                    </button>
                    <button class="export-link w-full flex items-center gap-3 px-4 py-2.5 text-xs font-bold text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 transition-colors text-left" data-type="csv">
                        <div class="w-8 h-8 rounded-lg bg-slate-50 flex items-center justify-center">
                            <i class="fas fa-file-csv opacity-50"></i>
                        </div>
                        <span>Download CSV</span>
                    </button>
                    <button class="export-link w-full flex items-center gap-3 px-4 py-2.5 text-xs font-bold text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 transition-colors text-left" data-type="excel">
                        <div class="w-8 h-8 rounded-lg bg-slate-50 flex items-center justify-center">
                            <i class="fas fa-file-excel opacity-50"></i>
                        </div>
                        <span>Download Excel</span>
                    </button>
                    <button class="export-link w-full flex items-center gap-3 px-4 py-2.5 text-xs font-bold text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 transition-colors text-left" data-type="pdf">
                        <div class="w-8 h-8 rounded-lg bg-slate-50 flex items-center justify-center">
                            <i class="fas fa-file-pdf opacity-50"></i>
                        </div>
                        <span>Download PDF</span>
                    </button>
                </div>
            </div>

            @can('task_create')
                <a href="{{ route('admin.tasks.create') }}" class="inline-flex items-center gap-2.5 px-6 py-2.5 bg-indigo-600 rounded-xl text-sm font-bold text-white shadow-lg shadow-indigo-100 hover:bg-indigo-700 hover:-translate-y-0.5 hover:shadow-indigo-200 transition-all active:scale-95">
                    <i class="fas fa-plus-circle"></i>
                    <span>Create New Task</span>
                </a>
            @endcan
        </div>
    </div>

    <!-- Stats Section -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 animate-in fade-in slide-in-from-bottom-4 duration-1000 delay-150">
        <!-- Total Tasks Card -->
        <div class="group relative bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-xl hover:shadow-indigo-500/5 hover:-translate-y-1 transition-all duration-300">       
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-1 group-hover:text-indigo-600 transition-colors">Total Tasks</p>
                    <h3 class="text-3xl font-black text-slate-900 tracking-tight">{{ $tasks->count() }}</h3>
                    <p class="text-[10px] font-medium text-slate-400 mt-2 flex items-center gap-1">
                        Total workload
                    </p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-indigo-50 border border-indigo-100/50 flex items-center justify-center text-indigo-600 shadow-sm transition-transform duration-300 group-hover:scale-110">
                    <i class="fas fa-tasks text-xl"></i>
                </div>
            </div>
            <div class="absolute bottom-0 left-6 right-6 h-0.5 bg-gradient-to-r from-transparent via-indigo-500/20 to-transparent scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>
        </div>

        <!-- Pending Tasks Card -->
        <div class="group relative bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-xl hover:shadow-amber-500/5 hover:-translate-y-1 transition-all duration-300">      
            <div class="flex items-center justify-between">
                @php $pendingCount = $tasks->where('status.name', '!=', 'Closed')->count(); @endphp
                <div>
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-1 group-hover:text-amber-600 transition-colors">Pending</p>
                    <h3 class="text-3xl font-black text-slate-900 tracking-tight">{{ $pendingCount }}</h3>
                    <p class="text-[10px] font-medium text-slate-400 mt-2 flex items-center gap-1">
                        Requiring attention
                    </p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-amber-50 border border-amber-100/50 flex items-center justify-center text-amber-600 shadow-sm transition-transform duration-300 group-hover:scale-110">
                    <i class="fas fa-clock text-xl"></i>
                </div>
            </div>
            <div class="absolute bottom-0 left-6 right-6 h-0.5 bg-gradient-to-r from-transparent via-amber-500/20 to-transparent scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>
        </div>

        <!-- High Priority Card -->
        <div class="group relative bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-xl hover:shadow-rose-500/5 hover:-translate-y-1 transition-all duration-300">        
            <div class="flex items-center justify-between">
                @php $urgentCount = $tasks->whereIn('priority', ['high', 'urgent'])->count(); @endphp
                <div>
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-1 group-hover:text-rose-600 transition-colors">Urgent / High</p>
                    <h3 class="text-3xl font-black text-slate-900 tracking-tight">{{ $urgentCount }}</h3>
                    <p class="text-[10px] font-medium text-slate-400 mt-2 flex items-center gap-1">
                        Critical priority items
                    </p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-rose-50 border border-rose-100/50 flex items-center justify-center text-rose-600 shadow-sm transition-transform duration-300 group-hover:scale-110">
                    <i class="fas fa-exclamation-triangle text-xl"></i>
                </div>
            </div>
            <div class="absolute bottom-0 left-6 right-6 h-0.5 bg-gradient-to-r from-transparent via-rose-500/20 to-transparent scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>
        </div>

        <!-- Completed Card -->
        <div class="group relative bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-xl hover:shadow-emerald-500/5 hover:-translate-y-1 transition-all duration-300">       
            <div class="flex items-center justify-between">
                @php $completedCount = $tasks->where('status.name', 'Closed')->count(); @endphp
                <div>
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-1 group-hover:text-emerald-600 transition-colors">Completed</p>
                    <h3 class="text-3xl font-black text-slate-900 tracking-tight">{{ $completedCount }}</h3>
                    <p class="text-[10px] font-medium text-slate-400 mt-2 flex items-center gap-1">
                        Successfully finished
                    </p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-emerald-50 border border-emerald-100/50 flex items-center justify-center text-emerald-600 shadow-sm transition-transform duration-300 group-hover:scale-110">
                    <i class="fas fa-check-circle text-xl"></i>
                </div>
            </div>
            <div class="absolute bottom-0 left-6 right-6 h-0.5 bg-gradient-to-r from-transparent via-emerald-500/20 to-transparent scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <!-- Table Control Header -->
        <div class="px-5 py-4 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white">
            <h2 class="text-base font-bold text-slate-900">Task Management</h2>
            <div class="flex items-center gap-2">
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" id="taskSearch" placeholder="Filter tasks..." class="pl-9 pr-4 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500/10 focus:border-indigo-500 w-full sm:w-60 transition-all">
                </div>
            </div>
        </div>

        <div class="overflow-x-auto min-h-[400px]">
            <table class="w-full text-left border-collapse datatable-Task">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200/60">
                        <th width="10" class="px-5 py-4">
                        </th>
                        <th class="px-5 py-4 text-[10px] font-extrabold text-slate-500 uppercase tracking-widest whitespace-nowrap">Task Details</th>
                        <th class="px-5 py-4 text-[10px] font-extrabold text-slate-500 uppercase tracking-widest whitespace-nowrap">Priority</th>
                        <th class="px-5 py-4 text-[10px] font-extrabold text-slate-500 uppercase tracking-widest whitespace-nowrap text-center">Status</th>
                        <th class="px-5 py-4 text-[10px] font-extrabold text-slate-500 uppercase tracking-widest whitespace-nowrap">Assigned To</th>
                        <th class="px-5 py-4 text-[10px] font-extrabold text-slate-500 uppercase tracking-widest whitespace-nowrap">Due Date</th>
                        <th class="px-5 py-4 text-[10px] font-extrabold text-slate-500 uppercase tracking-widest whitespace-nowrap text-right">Management</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200/50">
                    @forelse($tasks as $key => $task)
                        <tr data-entry-id="{{ $task->id }}" class="hover:bg-white hover:shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:-translate-y-0.5 transition-all duration-300 group relative z-0 hover:z-10">
                            <td class="px-5 py-4.5">
                            </td>
                            <td class="px-5 py-4.5">
                                <div class="flex flex-col">
                                    <span class="font-extrabold text-slate-900 text-sm block group-hover:text-indigo-600 transition-colors">{{ $task->name ?? 'Untitled Task' }}</span>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="text-[9px] text-slate-400 uppercase font-black tracking-widest inline-flex items-center px-2 py-0.5 bg-slate-100 rounded-md group-hover:bg-indigo-50 group-hover:text-indigo-500 transition-colors">T-{{ str_pad($task->id, 5, '0', STR_PAD_LEFT) }}</span>
                                        @foreach($task->tags as $tag)
                                            <span class="text-[8px] font-bold text-indigo-500 uppercase px-1.5 py-0.5 bg-indigo-50/50 rounded border border-indigo-100/50">{{ $tag->name }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-4.5">
                                @php
                                    $priority = $task->priority ?? 'medium';
                                    $pColor = 'slate';
                                    $pIcon = 'circle';
                                    if ($priority === 'urgent') { $pColor = 'rose'; $pIcon = 'fire'; }
                                    elseif ($priority === 'high') { $pColor = 'amber'; $pIcon = 'exclamation-circle'; }
                                    elseif ($priority === 'medium') { $pColor = 'indigo'; $pIcon = 'dot-circle'; }
                                    elseif ($priority === 'low') { $pColor = 'emerald'; $pIcon = 'arrow-down'; }
                                @endphp
                                <div class="flex items-center gap-2">
                                    <div class="w-7 h-7 rounded-lg bg-{{ $pColor }}-50 border border-{{ $pColor }}-100 flex items-center justify-center text-{{ $pColor }}-600 shadow-sm">
                                        <i class="fas fa-{{ $pIcon }} text-[10px]"></i>
                                    </div>
                                    <span class="text-[11px] font-black uppercase text-{{ $pColor }}-700 tracking-tight">{{ App\Models\Task::PRIORITY_RADIO[$priority] ?? $priority }}</span>
                                </div>
                            </td>
                            <td class="px-5 py-4.5 text-center">
                                @php
                                    $statusName = $task->status->name ?? 'Open';
                                    $sColor = 'slate';
                                    if ($statusName === 'Open') $sColor = 'blue';
                                    elseif ($statusName === 'In progress') $sColor = 'amber';
                                    elseif ($statusName === 'Closed') $sColor = 'emerald';
                                @endphp
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-wider bg-{{ $sColor }}-50 text-{{ $sColor }}-700 border border-{{ $sColor }}-200 shadow-sm">
                                    {{ $statusName }}
                                </span>
                            </td>
                            <td class="px-5 py-4.5">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-slate-50 to-slate-100 flex items-center justify-center text-[10px] font-black text-slate-600 border border-slate-200 group-hover:from-indigo-50 group-hover:to-white group-hover:border-indigo-100 transition-all duration-300">
                                        {{ substr($task->assigned_to->name ?? 'U', 0, 1) }}
                                    </div>
                                    <span class="text-xs font-bold text-slate-700">{{ $task->assigned_to->name ?? 'Unassigned' }}</span>
                                </div>
                            </td>
                            <td class="px-5 py-4.5">
                                <div class="flex flex-col">
                                    <span class="text-xs font-black text-slate-800 tracking-tight">{{ $task->due_date ?? 'No Date' }}</span>
                                    <span class="text-[9px] text-slate-400 font-bold uppercase tracking-widest mt-0.5">Deadline</span>
                                </div>
                            </td>
                            <td class="px-5 py-4.5 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    @can('task_show')
                                        <a href="{{ route('admin.tasks.show', $task->id) }}" class="w-9 h-9 rounded-xl flex items-center justify-center text-slate-400 bg-slate-50 border border-slate-100 hover:bg-white hover:text-indigo-600 hover:border-indigo-100 hover:shadow-md hover:shadow-indigo-500/10 transition-all duration-300" title="View Details">
                                            <i class="fas fa-eye text-xs"></i>
                                        </a>
                                    @endcan
                                    @can('task_edit')
                                        <a href="{{ route('admin.tasks.edit', $task->id) }}" class="w-9 h-9 rounded-xl flex items-center justify-center text-slate-400 bg-slate-50 border border-slate-100 hover:bg-white hover:text-blue-600 hover:border-blue-100 hover:shadow-md hover:shadow-blue-500/10 transition-all duration-300" title="Edit Task">
                                            <i class="fas fa-edit text-xs"></i>
                                        </a>
                                    @endcan
                                    @can('task_delete')
                                        <form action="{{ route('admin.tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" class="inline-block">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="w-9 h-9 rounded-xl flex items-center justify-center text-slate-400 bg-slate-50 border border-slate-100 hover:bg-white hover:text-rose-600 hover:border-rose-100 hover:shadow-md hover:shadow-rose-500/10 transition-all duration-300" title="Delete Task">
                                                <i class="fas fa-trash-alt text-xs"></i>
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-16 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-12 h-12 rounded-full bg-slate-50 flex items-center justify-center text-slate-300 mb-3">
                                        <i class="fas fa-clipboard-list text-xl"></i>
                                    </div>
                                    <p class="text-slate-400 font-bold text-sm uppercase tracking-widest">No Tasks Found</p>
                                    <p class="text-slate-400/60 text-xs mt-1">Get started by creating your first task.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Footer / Pagination -->
        <div class="px-5 py-4 border-t border-slate-100 bg-slate-50/30">
            <div id="dt-info" class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-4"></div>
            <div id="dt-pagination" class="flex items-center justify-between">
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
@parent
<script>
$(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('task_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.tasks.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')
        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  let table = $('.datatable-Task:not(.ajaxTable)').DataTable({
      buttons: dtButtons,
      pageLength: 25,
      bLengthChange: false,
      autoWidth: false,
      scrollX: false,
      dom: 'rtip',
      columnDefs: [
          {
              orderable: false,
              className: 'select-checkbox',
              targets: 0
          },
          {
              orderable: false,
              searchable: false,
              targets: -1
          }
      ],
      select: {
          style:    'multi+shift',
          selector: 'td:first-child'
      },
      order: [[ 5, 'asc' ]],
      language: {
          search: "",
          paginate: {
              previous: '<i class="fas fa-chevron-left"></i>',
              next: '<i class="fas fa-chevron-right"></i>'
          }
      },
      initComplete: function() {
          $('.dataTables_info').appendTo('#dt-info');
          $('.dataTables_paginate').appendTo('#dt-pagination');
      }
  })

  $('#taskSearch').on('keyup', function() {
      table.search(this.value).draw();
  });

  $('.export-link').on('click', function(e) {
      e.preventDefault();
      let type = $(this).data('type');
      table.button('.buttons-' + type).trigger();
  });
})
</script>
<style>
    table.dataTable { width: 100% !important; margin: 0 !important; border-collapse: collapse !important; }
    table.dataTable thead th { border-bottom: none !important; white-space: nowrap; }
    table.dataTable.no-footer { border-bottom: 1px solid #d6d6d6 !important; }
    table.dataTable tbody td.select-checkbox:before,
    table.dataTable tbody td.select-checkbox:after,
    table.dataTable thead th.select-checkbox:before,
    table.dataTable thead th.select-checkbox:after {
        top: 50% !important; left: 50% !important; transform: translate(-50%, -50%) !important;
        margin-top: 0 !important; margin-left: 0 !important; width: 16px !important; height: 16px !important; border-radius: 4px !important;
    }
    table.dataTable tr.selected td.select-checkbox:after {
        content: '\2713'; text-shadow: none; margin-top: -10px !important; margin-left: -6px !important; font-size: 14px; color: #4f46e5;
    }
    .dataTables_paginate .paginate_button {
        padding: 5px 12px !important; margin: 0 2px !important; border-radius: 6px !important;
        border: 1px solid #e2e8f0 !important; background: white !important; font-size: 12px !important; font-weight: 600 !important;
        cursor: pointer; transition: all 0.2s;
    }
    .dataTables_paginate .paginate_button.current { background: #4f46e5 !important; color: white !important; border-color: #4f46e5 !important; }
    .dataTables_paginate .paginate_button:hover:not(.current) { background: #f8fafc !important; color: #4f46e5 !important; }
    .dataTables_paginate .paginate_button.disabled { opacity: 0.5; cursor: not-allowed; }
    .dataTables_info, .dataTables_paginate { padding: 0 !important; }
</style>
@endsection
