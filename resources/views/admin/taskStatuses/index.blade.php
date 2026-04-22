@extends('layouts.admin')
@section('content')

<div class="max-w-[1200px] mx-auto px-4 md:px-6 lg:px-8 pt-2 md:pt-4 lg:pt-6 space-y-8">
    <!-- Premium Header Section -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 pb-8 border-b border-slate-200/60 animate-in fade-in slide-in-from-top-4 duration-700">
        <div class="space-y-3">
            <div class="flex items-center gap-2">
                <div class="flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-indigo-50 border border-indigo-100/50">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                    </span>
                    <span class="text-[10px] font-bold text-indigo-600 uppercase tracking-widest">System Configuration</span>
                </div>
                <span class="text-slate-300">/</span>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Workflow Engine</span>
            </div>

            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-indigo-600 flex items-center justify-center text-white shadow-xl shadow-indigo-100">
                    <i class="fas fa-stream text-xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 tracking-tight">{{ trans('cruds.taskStatus.title') }}</h1>
                    <p class="text-slate-500 font-medium text-sm mt-1 max-w-xl">
                        Define and manage lifecycle stages for project execution.
                    </p>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            @can('task_status_create')
                <button class="inline-flex items-center gap-2.5 px-5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-600 shadow-sm hover:border-slate-300 hover:text-slate-900 transition-all active:scale-95" data-toggle="modal" data-target="#csvImportModal">
                    <i class="fas fa-file-import text-slate-400"></i>
                    <span>Import CSV</span>
                </button>
                <a href="{{ route('admin.task-statuses.create') }}" class="inline-flex items-center gap-2.5 px-6 py-2.5 bg-indigo-600 rounded-xl text-sm font-bold text-white shadow-lg shadow-indigo-100 hover:bg-indigo-700 hover:-translate-y-0.5 transition-all">
                    <i class="fas fa-plus"></i>
                    <span>Create Status</span>
                </a>
            @endcan
        </div>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden animate-in fade-in slide-in-from-bottom-4 duration-1000 delay-150">
        <div class="p-6 md:p-8 border-b border-slate-100 bg-slate-50/30 flex items-center justify-between">
            <div>
                <h2 class="text-lg font-bold text-slate-900">Status Matrix</h2>
                <p class="text-slate-500 text-sm mt-1 font-medium text-slate-400">Inventory of available workflow states.</p>
            </div>
            <div class="flex items-center gap-2">
                <div class="relative group">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-xs transition-colors group-focus-within:text-indigo-500"></i>
                    <input type="text" id="statusSearch" placeholder="Filter states..." class="pl-10 pr-4 py-2 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-900 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 w-64 transition-all">
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse datatable-TaskStatus">
                <tbody class="divide-y divide-slate-100">
                    @foreach($taskStatuses as $key => $taskStatus)
                        <tr data-entry-id="{{ $taskStatus->id }}" class="hover:bg-slate-50/50 transition-all group">
                            <td class="px-8 py-5">
                                <div class="flex items-center justify-center">
                                    <div class="w-4 h-4 rounded border-2 border-slate-200 group-hover:border-indigo-500 transition-all cursor-pointer"></div>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-3">
                                    @php
                                        $sColor = 'slate';
                                        if(stripos($taskStatus->name, 'open') !== false) $sColor = 'blue';
                                        elseif(stripos($taskStatus->name, 'progress') !== false) $sColor = 'amber';
                                        elseif(stripos($taskStatus->name, 'close') !== false || stripos($taskStatus->name, 'done') !== false) $sColor = 'emerald';
                                    @endphp
                                    <div class="w-8 h-8 rounded-lg bg-{{ $sColor }}-50 border border-{{ $sColor }}-100 flex items-center justify-center text-{{ $sColor }}-600 font-black text-[10px] group-hover:scale-110 transition-transform shadow-sm">
                                        {{ substr($taskStatus->name, 0, 1) }}
                                    </div>
                                    <span class="text-sm font-bold text-slate-700">{{ $taskStatus->name ?? '' }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    @can('task_status_show')
                                        <a href="{{ route('admin.task-statuses.show', $taskStatus->id) }}" class="w-9 h-9 rounded-xl flex items-center justify-center text-slate-400 bg-white border border-slate-100 shadow-sm hover:text-indigo-600 hover:border-indigo-100 hover:shadow-md transition-all" title="Review Intelligence">
                                            <i class="fas fa-eye text-xs"></i>
                                        </a>
                                    @endcan
                                    @can('task_status_edit')
                                        <a href="{{ route('admin.task-statuses.edit', $taskStatus->id) }}" class="w-9 h-9 rounded-xl flex items-center justify-center text-slate-400 bg-white border border-slate-100 shadow-sm hover:text-blue-600 hover:border-blue-100 hover:shadow-md transition-all" title="Refine Configuration">
                                            <i class="fas fa-edit text-xs"></i>
                                        </a>
                                    @endcan
                                    @can('task_status_delete')
                                        <form action="{{ route('admin.task-statuses.destroy', $taskStatus->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" class="inline-block">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="w-9 h-9 rounded-xl flex items-center justify-center text-slate-400 bg-white border border-slate-100 shadow-sm hover:text-rose-600 hover:border-rose-100 hover:shadow-md transition-all" title="Terminate State">
                                                <i class="fas fa-trash-alt text-xs"></i>
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="px-8 py-4 bg-slate-50/50 border-t border-slate-100 flex items-center justify-between">
            <div id="dt-info" class="text-[10px] font-black text-slate-400 uppercase tracking-widest"></div>
            <div id="dt-pagination" class="flex items-center gap-2"></div>
        </div>
    </div>
</div>

@can('task_status_create')
    @include('csvImport.modal', ['model' => 'TaskStatus', 'route' => 'admin.task-statuses.parseCsvImport'])
@endcan

@endsection

@section('scripts')
@parent
<script>
$(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('task_status_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.task-statuses.massDestroy') }}",
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

  let table = $('.datatable-TaskStatus:not(.ajaxTable)').DataTable({
      buttons: dtButtons,
      pageLength: 25,
      bLengthChange: false,
      autoWidth: false,
      scrollX: false,
      dom: 'rtip',
      columnDefs: [
          { orderable: false, className: 'select-checkbox', targets: 0 },
          { orderable: false, searchable: false, targets: -1 }
      ],
      select: { style: 'multi+shift', selector: 'td:first-child' },
      order: [[ 1, 'asc' ]],
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

  $('#statusSearch').on('keyup', function() {
      table.search(this.value).draw();
  });
})
</script>

<style>
    /* Premium Table Styling */
    table.dataTable { border-collapse: collapse !important; border: none !important; }
    .dataTables_paginate .paginate_button {
        padding: 6px 14px !important; margin: 0 2px !important; border-radius: 10px !important;
        border: 1px solid #e2e8f0 !important; background: white !important; font-size: 11px !important; 
        font-weight: 800 !important; cursor: pointer; transition: all 0.2s; color: #64748b !important;
        text-transform: uppercase !important; letter-spacing: 0.025em !important;
    }
    .dataTables_paginate .paginate_button.current { background: #4f46e5 !important; color: white !important; border-color: #4f46e5 !important; }
    .dataTables_paginate .paginate_button:hover:not(.current) { background: #f8fafc !important; color: #4f46e5 !important; }
    .dataTables_paginate .paginate_button.disabled { opacity: 0.4; cursor: not-allowed; }
    
    table.dataTable tbody td.select-checkbox:before, 
    table.dataTable tr.selected td.select-checkbox:after {
        display: none !important;
    }
    
    tr.selected td { background-color: #f5f3ff !important; }
    tr.selected td:first-child .w-4 { background-color: #4f46e5 !important; border-color: #4f46e5 !important; }
</style>
@endsection
