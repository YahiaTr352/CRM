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
                    <span class="text-[10px] font-bold text-indigo-600 uppercase tracking-widest">System Intelligence</span>
                </div>
                <span class="text-slate-300">/</span>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Security Monitoring</span>
            </div>

            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-indigo-600 flex items-center justify-center text-white shadow-xl shadow-indigo-100">
                    <i class="fas fa-history text-xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 tracking-tight">{{ trans('cruds.auditLog.title') }}</h1>
                    <p class="text-slate-500 font-medium text-sm mt-1 max-w-xl leading-relaxed">
                        Track system state transitions, operational events, and administrative activities across the infrastructure.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden animate-in fade-in slide-in-from-bottom-4 duration-1000 delay-150">
        <div class="p-6 md:p-8 border-b border-slate-100 bg-slate-50/30 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-lg font-bold text-slate-900">Operation Ledger</h2>
                <p class="text-slate-500 text-sm mt-1 font-medium text-slate-400">Immutable record of system-wide events and state transitions.</p>
            </div>
            <div class="flex items-center gap-2">
                <div class="relative group">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-xs transition-colors group-focus-within:text-indigo-500"></i>
                    <input type="text" id="auditSearch" placeholder="Filter operation ledger..." class="pl-10 pr-4 py-2 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-900 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 w-full sm:w-64 transition-all">
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse ajaxTable datatable datatable-AuditLog">
                <!-- No thead as requested -->
            </table>
        </div>

        <div class="px-8 py-4 bg-slate-50/50 border-t border-slate-100 flex items-center justify-between">
            <div id="dt-info" class="text-[10px] font-black text-slate-400 uppercase tracking-widest"></div>
            <div id="dt-pagination" class="flex items-center gap-2"></div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
@parent
<script>
$(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  
  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.audit-logs.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder', orderable: false, searchable: false, className: 'px-8 py-5 w-[10px]' },
      { data: 'id', name: 'id', visible: false },
      { 
        data: 'description', 
        name: 'description',
        render: function(data, type, row) {
            return `
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 font-black text-[10px] group-hover:scale-110 transition-transform shadow-sm">
                        ${row.id}
                    </div>
                    <div>
                        <span class="text-sm font-bold text-slate-900 block leading-tight group-hover:text-indigo-600 transition-colors">${data}</span>
                        <span class="text-[9px] font-black uppercase tracking-widest text-slate-400 mt-1 block">Subject ID: ${row.subject_id}</span>
                    </div>
                </div>
            `;
        }
      },
      { data: 'subject_id', name: 'subject_id', visible: false },
      { 
        data: 'subject_type', 
        name: 'subject_type',
        render: function(data) {
            return `<span class="inline-flex items-center px-2 py-0.5 rounded-lg text-[9px] font-black uppercase tracking-wider bg-slate-900 text-white shadow-sm">${data.split('\\').pop()}</span>`;
        }
      },
      { 
        data: 'user_id', 
        name: 'user_id',
        render: function(data, type, row) {
            return `
                <div class="flex items-center gap-2">
                    <i class="fas fa-user-circle text-slate-300 text-sm"></i>
                    <span class="text-[11px] font-bold text-slate-700">User #${data}</span>
                </div>
            `;
        }
      },
      { 
        data: 'host', 
        name: 'host',
        render: function(data) {
            return `<span class="text-[10px] font-mono font-bold text-slate-400 bg-slate-50 px-2 py-1 rounded-lg border border-slate-100">${data}</span>`;
        }
      },
      { 
        data: 'created_at', 
        name: 'created_at',
        render: function(data) {
            return `
                <div class="flex items-center gap-2 text-slate-500">
                    <i class="far fa-clock text-[10px] opacity-40"></i>
                    <span class="text-[11px] font-bold">${data}</span>
                </div>
            `;
        }
      },
      { data: 'actions', name: '{{ trans('global.actions') }}', orderable: false, searchable: false, className: 'px-8 py-5 text-right' }
    ],
    order: [[ 1, 'desc' ]],
    pageLength: 25,
    bLengthChange: false,
    autoWidth: false,
    scrollX: false,
    dom: 'rtip',
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
    },
    createdRow: function(row, data, dataIndex) {
        $(row).addClass('hover:bg-slate-50/50 transition-all group');
        $('td', row).addClass('px-8 py-5 align-middle border-none');
    }
  };
  let table = $('.datatable-AuditLog').DataTable(dtOverrideGlobals);

  $('#auditSearch').on('keyup', function() {
      table.search(this.value).draw();
  });

  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
  });
});
</script>

<style>
    /* Premium Table Styling */
    table.dataTable { border-collapse: collapse !important; border: none !important; margin-top: 0 !important; margin-bottom: 0 !important; }
    .dataTables_paginate .paginate_button {
        padding: 6px 14px !important; margin: 0 2px !important; border-radius: 10px !important;
        border: 1px solid #e2e8f0 !important; background: white !important; font-size: 11px !important; 
        font-weight: 800 !important; cursor: pointer; transition: all 0.2s; color: #64748b !important;
        text-transform: uppercase !important; letter-spacing: 0.025em !important;
    }
    .dataTables_paginate .paginate_button.current { background: #4f46e5 !important; color: white !important; border-color: #4f46e5 !important; }
    .dataTables_paginate .paginate_button:hover:not(.current) { background: #f8fafc !important; color: #4f46e5 !important; }
    .dataTables_paginate .paginate_button.disabled { opacity: 0.4; cursor: not-allowed; }
    
    .dataTables_processing {
        background: rgba(255, 255, 255, 0.9) !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 1rem !important;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1) !important;
        color: #4f46e5 !important;
        font-weight: 800 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.05em !important;
    }
</style>
@endsection
