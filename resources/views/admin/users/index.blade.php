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
                    <span class="text-[10px] font-bold text-indigo-600 uppercase tracking-widest">Access Control</span>
                </div>
                <span class="text-slate-300">/</span>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">System Architecture</span>
            </div>

            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-indigo-600 flex items-center justify-center text-white shadow-xl shadow-indigo-100">
                    <i class="fas fa-users-cog text-xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 tracking-tight">{{ trans('cruds.user.title') }}</h1>
                    <p class="text-slate-500 font-medium text-sm mt-1 max-w-xl leading-relaxed">
                        Manage system operators, define authority levels, and oversee administrative access protocols.
                    </p>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            @can('user_create')
                <a href="{{ route('admin.users.create') }}" class="inline-flex items-center gap-2.5 px-6 py-2.5 bg-indigo-600 rounded-xl text-sm font-bold text-white shadow-lg shadow-indigo-100 hover:bg-indigo-700 hover:-translate-y-0.5 transition-all active:scale-95">
                    <i class="fas fa-plus"></i>
                    <span>Register New Operator</span>
                </a>
            @endcan
        </div>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden animate-in fade-in slide-in-from-bottom-4 duration-1000 delay-150">
        <div class="p-6 md:p-8 border-b border-slate-100 bg-slate-50/30 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-lg font-bold text-slate-900">Operator Directory</h2>
                <p class="text-slate-500 text-sm mt-1 font-medium">Inventory of registered system users and their security profiles.</p>
            </div>
            <div class="flex items-center gap-2">
                <div class="relative group">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-xs transition-colors group-focus-within:text-indigo-500"></i>
                    <input type="text" id="userSearch" placeholder="Filter operators..." class="pl-10 pr-4 py-2 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-900 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 w-full sm:w-64 transition-all">
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse datatable-User">
                <tbody class="divide-y divide-slate-100">
                    @foreach($users as $key => $user)
                        <tr data-entry-id="{{ $user->id }}" class="hover:bg-slate-50/50 transition-all group">
                            <td class="px-8 py-5">
                                <div class="flex items-center justify-center">
                                    <div class="w-4 h-4 rounded border-2 border-slate-200 group-hover:border-indigo-500 transition-all cursor-pointer"></div>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 font-black text-sm group-hover:scale-110 transition-transform shadow-sm">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <span class="text-sm font-bold text-slate-900 block leading-tight group-hover:text-indigo-600 transition-colors">{{ $user->name ?? '' }}</span>
                                        <span class="text-[11px] font-medium text-slate-500 mt-0.5 block italic">{{ $user->email ?? '' }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex flex-wrap gap-1.5">
                                    @foreach($user->roles as $key => $item)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-lg text-[9px] font-black uppercase tracking-wider bg-slate-900 text-white shadow-sm">
                                            {{ $item->title }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex flex-col gap-2">
                                    <div class="flex items-center gap-2">
                                        @if($user->approved)
                                            <span class="text-[9px] font-black uppercase tracking-widest text-emerald-500 flex items-center gap-1.5">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                                Approved
                                            </span>
                                        @else
                                            <span class="text-[9px] font-black uppercase tracking-widest text-amber-500 flex items-center gap-1.5">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                                Pending
                                            </span>
                                        @endif
                                    </div>
                                    <div class="flex items-center gap-2">
                                        @if($user->verified)
                                            <span class="text-[9px] font-black uppercase tracking-widest text-blue-500 flex items-center gap-1.5">
                                                <i class="fas fa-check-circle text-[10px]"></i>
                                                Verified
                                            </span>
                                        @else
                                            <span class="text-[9px] font-black uppercase tracking-widest text-slate-400 flex items-center gap-1.5">
                                                <i class="fas fa-clock text-[10px]"></i>
                                                Unverified
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <span class="text-[10px] font-bold text-slate-400 block uppercase tracking-tight">Registered</span>
                                <span class="text-[11px] font-bold text-slate-700 block mt-0.5">{{ $user->created_at ? $user->created_at->format('M d, Y') : 'N/A' }}</span>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    @can('user_show')
                                        <a href="{{ route('admin.users.show', $user->id) }}" class="w-9 h-9 rounded-xl flex items-center justify-center text-slate-400 bg-white border border-slate-100 shadow-sm hover:text-indigo-600 hover:border-indigo-100 hover:shadow-md transition-all active:scale-90" title="Review Intelligence">
                                            <i class="fas fa-eye text-xs"></i>
                                        </a>
                                    @endcan
                                    @can('user_edit')
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="w-9 h-9 rounded-xl flex items-center justify-center text-slate-400 bg-white border border-slate-100 shadow-sm hover:text-blue-600 hover:border-blue-100 hover:shadow-md transition-all active:scale-90" title="Refine Configuration">
                                            <i class="fas fa-edit text-xs"></i>
                                        </a>
                                    @endcan
                                    @can('user_delete')
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" class="inline-block">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="w-9 h-9 rounded-xl flex items-center justify-center text-slate-400 bg-white border border-slate-100 shadow-sm hover:text-rose-600 hover:border-rose-100 hover:shadow-md transition-all active:scale-90" title="Terminate Access">
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

@endsection

@section('scripts')
@parent
<script>
$(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('user_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.users.massDestroy') }}",
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

  let table = $('.datatable-User:not(.ajaxTable)').DataTable({
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

  $('#userSearch').on('keyup', function() {
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
