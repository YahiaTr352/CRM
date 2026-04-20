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
                    <span class="text-[10px] font-bold text-indigo-600 uppercase tracking-widest">Network Live</span>
                </div>
                <span class="text-slate-300">/</span>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">CRM Directory</span>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-indigo-600 flex items-center justify-center text-white shadow-xl shadow-indigo-100">
                    <i class="fas fa-address-book text-xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 tracking-tight">Contact Intelligence</h1>
                    <p class="text-slate-500 font-medium text-sm mt-1 max-w-xl">
                        Manage your professional relationships and corporate connections with a centralized intelligence hub.
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

            <button class="group inline-flex items-center gap-2.5 px-5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-600 shadow-sm hover:border-slate-300 hover:text-indigo-600 transition-all active:scale-95" data-toggle="modal" data-target="#csvImportModal">
                <i class="fas fa-file-import text-slate-400 group-hover:text-indigo-500 transition-colors"></i>
                <span>Import Contacts</span>
            </button>
            
            @can('crm_contact_create')
                <a href="{{ route('admin.crm-contacts.create') }}" class="inline-flex items-center gap-2.5 px-6 py-2.5 bg-indigo-600 rounded-xl text-sm font-bold text-white shadow-lg shadow-indigo-100 hover:bg-indigo-700 hover:-translate-y-0.5 hover:shadow-indigo-200 transition-all active:scale-95">
                    <i class="fas fa-plus-circle"></i>
                    <span>Register New Contact</span>
                </a>
            @endcan
        </div>
    </div>

    <!-- Stats Section -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 animate-in fade-in slide-in-from-bottom-4 duration-1000 delay-150">
        <div class="group relative bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-xl hover:shadow-indigo-500/5 hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-1 group-hover:text-indigo-600 transition-colors">Total Contacts</p>
                    <h3 class="text-3xl font-black text-slate-900 tracking-tight">{{ $crmContacts->count() }}</h3>
                    <p class="text-[10px] font-medium text-slate-400 mt-2 flex items-center gap-1">
                        Active in directory
                    </p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-indigo-50 border border-indigo-100/50 flex items-center justify-center text-indigo-600 shadow-sm transition-transform duration-300 group-hover:scale-110">
                    <i class="fas fa-users text-xl"></i>
                </div>
            </div>
        </div>

        <div class="group relative bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-xl hover:shadow-blue-500/5 hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-1 group-hover:text-blue-600 transition-colors">Total Companies</p>
                    <h3 class="text-3xl font-black text-slate-900 tracking-tight">{{ $crmContacts->unique('company')->count() }}</h3>
                    <p class="text-[10px] font-medium text-slate-400 mt-2 flex items-center gap-1">
                        Corporate entities
                    </p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-blue-50 border border-blue-100/50 flex items-center justify-center text-blue-600 shadow-sm transition-transform duration-300 group-hover:scale-110">
                    <i class="fas fa-building text-xl"></i>
                </div>
            </div>
        </div>

        <div class="group relative bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-xl hover:shadow-amber-500/5 hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-1 group-hover:text-amber-600 transition-colors">New This Month</p>
                    <h3 class="text-3xl font-black text-slate-900 tracking-tight">{{ $crmContacts->where('created_at', '>=', now()->startOfMonth())->count() }}</h3>
                    <p class="text-[10px] font-medium text-slate-400 mt-2 flex items-center gap-1">
                        Recent registrations
                    </p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-amber-50 border border-amber-100/50 flex items-center justify-center text-amber-600 shadow-sm transition-transform duration-300 group-hover:scale-110">
                    <i class="fas fa-user-plus text-xl"></i>
                </div>
            </div>
        </div>

        <div class="group relative bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-xl hover:shadow-purple-500/5 hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-1 group-hover:text-purple-600 transition-colors">Locations</p>
                    <h3 class="text-3xl font-black text-slate-900 tracking-tight">{{ $crmContacts->unique('contact_address')->count() }}</h3>
                    <p class="text-[10px] font-medium text-slate-400 mt-2 flex items-center gap-1">
                        Unique regional hubs
                    </p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-purple-50 border border-purple-100/50 flex items-center justify-center text-purple-600 shadow-sm transition-transform duration-300 group-hover:scale-110">
                    <i class="fas fa-map-marker-alt text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-5 py-4 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white">
            <h2 class="text-base font-bold text-slate-900">Active Relationships</h2>
            <div class="flex items-center gap-2">
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" id="contactSearch" placeholder="Filter relationships..." class="pl-9 pr-4 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500/10 focus:border-indigo-500 w-full sm:w-60 transition-all">
                </div>
            </div>
        </div>

        <div class="overflow-x-auto min-h-[400px]">
            <table class="w-full text-left border-collapse datatable-CrmContact">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200/60">
                        <th width="10" class="px-5 py-4"></th>
                        <th class="px-5 py-4 text-[10px] font-extrabold text-slate-500 uppercase tracking-widest whitespace-nowrap">Identity</th>
                        <th class="px-5 py-4 text-[10px] font-extrabold text-slate-500 uppercase tracking-widest whitespace-nowrap">Organization</th>
                        <th class="px-5 py-4 text-[10px] font-extrabold text-slate-500 uppercase tracking-widest whitespace-nowrap">Communication</th>
                        <th class="px-5 py-4 text-[10px] font-extrabold text-slate-500 uppercase tracking-widest whitespace-nowrap">Location</th>
                        <th class="px-5 py-4 text-[10px] font-extrabold text-slate-500 uppercase tracking-widest whitespace-nowrap text-right">Management</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200/50">
                    @forelse($crmContacts as $key => $crmContact)
                        <tr data-entry-id="{{ $crmContact->id }}" class="hover:bg-white hover:shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:-translate-y-0.5 transition-all duration-300 group relative z-0 hover:z-10">
                            <td class="px-5 py-4.5"></td>
                            <td class="px-5 py-4.5">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-slate-50 to-slate-100 flex items-center justify-center text-[11px] font-black text-slate-600 border border-slate-200 group-hover:from-indigo-50 group-hover:to-white group-hover:border-indigo-100 transition-all duration-300">
                                        {{ substr($crmContact->contact_first_name ?? 'U', 0, 1) }}{{ substr($crmContact->contact_last_name ?? '', 0, 1) }}
                                    </div>
                                    <div>
                                        <span class="text-sm font-bold text-slate-800 block leading-tight group-hover:text-indigo-600 transition-colors">{{ $crmContact->contact_first_name ?? '' }} {{ $crmContact->contact_last_name ?? '' }}</span>
                                        <span class="text-[10px] text-slate-400 font-semibold lowercase tracking-tight">{{ $crmContact->contact_email ?? 'no email' }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-4.5">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-2 h-2 rounded-full bg-slate-200 group-hover:bg-blue-400 transition-colors"></div>
                                    <span class="text-xs font-bold text-slate-600">{{ $crmContact->company ?? 'Independent' }}</span>
                                </div>
                            </td>
                            <td class="px-5 py-4.5">
                                <div class="space-y-1">
                                    <div class="flex items-center gap-2 text-[11px] font-bold text-slate-500">
                                        <i class="fas fa-phone-alt opacity-50 w-3 text-center"></i>
                                        <span>{{ $crmContact->contact_phone_1 ?? 'N/A' }}</span>
                                    </div>
                                    @if($crmContact->contact_phone_2)
                                        <div class="flex items-center gap-2 text-[10px] font-semibold text-slate-400">
                                            <i class="fas fa-mobile-alt opacity-50 w-3 text-center"></i>
                                            <span>{{ $crmContact->contact_phone_2 }}</span>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-5 py-4.5">
                                <div class="flex items-start gap-2 max-w-[200px]">
                                    <i class="fas fa-map-marker-alt text-slate-300 mt-1 text-[10px]"></i>
                                    <span class="text-xs font-medium text-slate-500 leading-tight">{{ $crmContact->contact_address ?? 'Not recorded' }}</span>
                                </div>
                            </td>
                            <td class="px-5 py-4.5 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    @can('crm_contact_show')
                                        <a href="{{ route('admin.crm-contacts.show', $crmContact->id) }}" class="w-9 h-9 rounded-xl flex items-center justify-center text-slate-400 bg-slate-50 border border-slate-100 hover:bg-white hover:text-indigo-600 hover:border-indigo-100 hover:shadow-md hover:shadow-indigo-500/10 transition-all duration-300">
                                            <i class="fas fa-eye text-xs"></i>
                                        </a>
                                    @endcan
                                    @can('crm_contact_edit')
                                        <a href="{{ route('admin.crm-contacts.edit', $crmContact->id) }}" class="w-9 h-9 rounded-xl flex items-center justify-center text-slate-400 bg-slate-50 border border-slate-100 hover:bg-white hover:text-blue-600 hover:border-blue-100 hover:shadow-md hover:shadow-blue-500/10 transition-all duration-300">
                                            <i class="fas fa-edit text-xs"></i>
                                        </a>
                                    @endcan
                                    @can('crm_contact_delete')
                                        <form action="{{ route('admin.crm-contacts.destroy', $crmContact->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" class="inline-block">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="w-9 h-9 rounded-xl flex items-center justify-center text-slate-400 bg-slate-50 border border-slate-100 hover:bg-white hover:text-rose-600 hover:border-rose-100 hover:shadow-md hover:shadow-rose-500/10 transition-all duration-300">
                                                <i class="fas fa-trash-alt text-xs"></i>
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-16 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-12 h-12 rounded-full bg-slate-50 flex items-center justify-center text-slate-300 mb-3">
                                        <i class="fas fa-users-slash text-xl"></i>
                                    </div>
                                    <p class="text-slate-400 font-bold text-sm uppercase tracking-widest">Directory Empty</p>
                                    <p class="text-slate-400/60 text-xs mt-1">No professional relationships found.</p>
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
            <div id="dt-pagination" class="flex items-center justify-between"></div>
        </div>
    </div>
</div>

@include('csvImport.modal', ['model' => 'CrmContact', 'route' => 'admin.crm-contacts.parseCsvImport'])

@endsection

@section('scripts')
@parent
<script>
$(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('crm_contact_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.crm-contacts.massDestroy') }}",
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

  let table = $('.datatable-CrmContact:not(.ajaxTable)').DataTable({ 
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

  $('#contactSearch').on('keyup', function() {
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
    table.dataTable tbody td.select-checkbox:after {
        top: 50% !important;
        left: 50% !important;
        transform: translate(-50%, -50%) !important;
        margin-top: 0 !important;
        margin-left: 0 !important;
        width: 16px !important;
        height: 16px !important;
        border-radius: 4px !important;
    }

    table.dataTable tr.selected td.select-checkbox:after {
        content: '\2713';
        text-shadow: none;
        margin-top: -10px !important;
        margin-left: -6px !important;
        font-size: 14px;
        color: #6366f1;
    }

    .dataTables_paginate .paginate_button {
        padding: 5px 12px !important;
        margin: 0 2px !important;
        border-radius: 6px !important;
        border: 1px solid #e2e8f0 !important;
        background: white !important;
        font-size: 12px !important;
        font-weight: 600 !important;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .dataTables_paginate .paginate_button.current {
        background: #6366f1 !important;
        color: white !important;
        border-color: #6366f1 !important;
    }

    .dataTables_paginate .paginate_button:hover:not(.current) {
        background: #f8fafc !important;
        color: #6366f1 !important;
    }

    .dataTables_info, .dataTables_paginate { padding: 0 !important; }
</style>
@endsection
