<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show bg-slate-900 border-r border-slate-800">

    <div class="c-sidebar-brand d-md-down-none bg-slate-900 py-6 px-6">
        <a class="flex items-center gap-3 no-underline" href="#">
            <div class="w-8 h-8 bg-indigo-500 rounded-lg flex items-center justify-center shadow-lg shadow-indigo-500/20">
                <i class="fas fa-rocket text-white text-sm"></i>
            </div>
            <span class="text-white font-bold tracking-tight text-lg">{{ trans('panel.site_title') }}</span>
        </a>
    </div>

    <ul class="c-sidebar-nav mt-4 px-3 space-y-1">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-slate-400 font-medium hover:text-white hover:bg-slate-800/50 transition-all group {{ request()->is("admin") ? "bg-slate-800 text-white shadow-sm" : "" }}">
                <i class="fas fa-fw fa-tachometer-alt text-sm group-hover:scale-110 transition-transform {{ request()->is("admin") ? "text-indigo-400" : "" }}"></i>
                <span>{{ trans('global.dashboard') }}</span>
            </a>
        </li>

        @can('deal_access')
            <li class="pt-4 pb-1 px-4">
                <span class="text-[10px] font-bold text-slate-500 uppercase tracking-[0.2em]">Sales Pipeline</span>
            </li>
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.kanban.index") }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-slate-400 font-medium hover:text-white hover:bg-slate-800/50 transition-all group {{ request()->is("admin/kanban") || request()->is("admin/kanban/*") ? "bg-slate-800 text-white shadow-sm" : "" }}">
                    <i class="fas fa-columns text-sm group-hover:scale-110 transition-transform {{ request()->is("admin/kanban") || request()->is("admin/kanban/*") ? "text-indigo-400" : "" }}"></i>
                    <span>Kanban</span>
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.deals.index") }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-slate-400 font-medium hover:text-white hover:bg-slate-800/50 transition-all group {{ request()->is("admin/deals") || request()->is("admin/deals/*") ? "bg-slate-800 text-white shadow-sm" : "" }}">
                    <i class="fas fa-filter text-sm group-hover:scale-110 transition-transform {{ request()->is("admin/deals") || request()->is("admin/deals/*") ? "text-indigo-400" : "" }}"></i>
                    <span>{{ trans('cruds.deal.title') }}</span>
                </a>
            </li>
            @can('deal_stage_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.deal-stages.index") }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-slate-400 font-medium hover:text-white hover:bg-slate-800/50 transition-all group {{ request()->is("admin/deal-stages") || request()->is("admin/deal-stages/*") ? "bg-slate-800 text-white shadow-sm" : "" }}">
                        <i class="fas fa-layer-group text-sm group-hover:scale-110 transition-transform {{ request()->is("admin/deal-stages") || request()->is("admin/deal-stages/*") ? "text-indigo-400" : "" }}"></i>
                        <span>{{ trans('cruds.dealStage.title') }}</span>
                    </a>
                </li>
            @endcan
            @can('deal_source_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.deal-sources.index") }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-slate-400 font-medium hover:text-white hover:bg-slate-800/50 transition-all group {{ request()->is("admin/deal-sources") || request()->is("admin/deal-sources/*") ? "bg-slate-800 text-white shadow-sm" : "" }}">
                        <i class="fas fa-share-alt text-sm group-hover:scale-110 transition-transform {{ request()->is("admin/deal-sources") || request()->is("admin/deal-sources/*") ? "text-indigo-400" : "" }}"></i>
                        <span>{{ trans('cruds.dealSource.title') }}</span>
                    </a>
                </li>
            @endcan
        @endcan

        @can('crm_contact_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.crm-contacts.index") }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-slate-400 font-medium hover:text-white hover:bg-slate-800/50 transition-all group {{ request()->is("admin/crm-contacts") || request()->is("admin/crm-contacts/*") ? "bg-slate-800 text-white shadow-sm" : "" }}">
                    <i class="fas fa-user-friends text-sm group-hover:scale-110 transition-transform {{ request()->is("admin/crm-contacts") || request()->is("admin/crm-contacts/*") ? "text-indigo-400" : "" }}"></i>
                    <span>{{ trans('cruds.crmContact.title') }}</span>
                </a>
            </li>
        @endcan

        @can('crm_product_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.crm-products.index") }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-slate-400 font-medium hover:text-white hover:bg-slate-800/50 transition-all group {{ request()->is("admin/crm-products") || request()->is("admin/crm-products/*") ? "bg-slate-800 text-white shadow-sm" : "" }}">
                    <i class="fas fa-box text-sm group-hover:scale-110 transition-transform {{ request()->is("admin/crm-products") || request()->is("admin/crm-products/*") ? "text-indigo-400" : "" }}"></i>
                    <span>{{ trans('cruds.crmProduct.title') }}</span>
                </a>
            </li>
        @endcan
        @can('product_category_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.product-categories.index") }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-slate-400 font-medium hover:text-white hover:bg-slate-800/50 transition-all group {{ request()->is("admin/product-categories") || request()->is("admin/product-categories/*") ? "bg-slate-800 text-white shadow-sm" : "" }}">
                    <i class="fas fa-tags text-sm group-hover:scale-110 transition-transform {{ request()->is("admin/product-categories") || request()->is("admin/product-categories/*") ? "text-indigo-400" : "" }}"></i>
                    <span>{{ trans('cruds.productCategory.title') }}</span>
                </a>
            </li>
        @endcan

        @can('task_management_access')
            <li class="pt-4 pb-1 px-4">
                <span class="text-[10px] font-bold text-slate-500 uppercase tracking-[0.2em]">Operations</span>
            </li>
            <li class="c-sidebar-nav-dropdown">
                <a class="flex items-center justify-between px-4 py-2.5 rounded-xl text-slate-400 font-medium hover:text-white hover:bg-slate-800/50 transition-all group c-sidebar-nav-dropdown-toggle" href="#">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-tasks text-sm group-hover:scale-110 transition-transform"></i>
                        <span>{{ trans('cruds.taskManagement.title') }}</span>
                    </div>
                </a>
                <ul class="c-sidebar-nav-dropdown-items mt-1 space-y-1 pl-9">
                    @can('task_status_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.task-statuses.index") }}" class="block px-4 py-2 rounded-lg text-sm text-slate-500 hover:text-white hover:bg-slate-800/50 transition-all {{ request()->is("admin/task-statuses") || request()->is("admin/task-statuses/*") ? "text-indigo-400 font-bold" : "" }}">
                                {{ trans('cruds.taskStatus.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('task_tag_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.task-tags.index") }}" class="block px-4 py-2 rounded-lg text-sm text-slate-500 hover:text-white hover:bg-slate-800/50 transition-all {{ request()->is("admin/task-tags") || request()->is("admin/task-tags/*") ? "text-indigo-400 font-bold" : "" }}">
                                {{ trans('cruds.taskTag.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('task_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.tasks.index") }}" class="block px-4 py-2 rounded-lg text-sm text-slate-500 hover:text-white hover:bg-slate-800/50 transition-all {{ request()->is("admin/tasks") || request()->is("admin/tasks/*") ? "text-indigo-400 font-bold" : "" }}">
                                {{ trans('cruds.task.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('tasks_calendar_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.tasks-calendars.index") }}" class="block px-4 py-2 rounded-lg text-sm text-slate-500 hover:text-white hover:bg-slate-800/50 transition-all {{ request()->is("admin/tasks-calendars") || request()->is("admin/tasks-calendars/*") ? "text-indigo-400 font-bold" : "" }}">
                                <i class="fas fa-calendar-alt text-xs mr-2"></i>
                                {{ trans('cruds.tasksCalendar.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan

        <li class="pt-4 pb-1 px-4">
            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-[0.2em]">Communication</span>
        </li>
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.messenger.index") }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-slate-400 font-medium hover:text-white hover:bg-slate-800/50 transition-all group {{ request()->is("admin/messenger") || request()->is("admin/messenger/*") ? "bg-slate-800 text-white shadow-sm" : "" }}">
                <i class="fas fa-envelope text-sm group-hover:scale-110 transition-transform {{ request()->is("admin/messenger") || request()->is("admin/messenger/*") ? "text-indigo-400" : "" }}"></i>
                <span>{{ trans('global.messages') }}</span>
                @php($unread = \App\Models\QaTopic::unreadCount())
                @if($unread > 0)
                    <span class="ml-auto bg-indigo-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full shadow-lg shadow-indigo-500/30">{{ $unread }}</span>
                @endif
            </a>
        </li>

        <li class="pt-4 pb-1 px-4 border-t border-slate-800/50 mt-4">
            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-[0.2em]">System</span>
        </li>
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown">
                <a class="flex items-center justify-between px-4 py-2.5 rounded-xl text-slate-400 font-medium hover:text-white hover:bg-slate-800/50 transition-all group c-sidebar-nav-dropdown-toggle" href="#">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-shield-alt text-sm group-hover:scale-110 transition-transform"></i>
                        <span>{{ trans('cruds.userManagement.title') }}</span>
                    </div>
                </a>
                <ul class="c-sidebar-nav-dropdown-items mt-1 space-y-1 pl-9">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="block px-4 py-2 rounded-lg text-sm text-slate-500 hover:text-white hover:bg-slate-800/50 transition-all {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "text-indigo-400 font-bold" : "" }}">
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="block px-4 py-2 rounded-lg text-sm text-slate-500 hover:text-white hover:bg-slate-800/50 transition-all {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "text-indigo-400 font-bold" : "" }}">
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="block px-4 py-2 rounded-lg text-sm text-slate-500 hover:text-white hover:bg-slate-800/50 transition-all {{ request()->is("admin/users") || request()->is("admin/users/*") ? "text-indigo-400 font-bold" : "" }}">
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('audit_log_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.audit-logs.index") }}" class="block px-4 py-2 rounded-lg text-sm text-slate-500 hover:text-white hover:bg-slate-800/50 transition-all {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "text-indigo-400 font-bold" : "" }}">
                                {{ trans('cruds.auditLog.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan

        <li class="c-sidebar-nav-item mt-auto pb-4">
            <a href="#" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-rose-400 font-medium hover:text-rose-300 hover:bg-rose-500/10 transition-all group" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="fas fa-sign-out-alt text-sm group-hover:translate-x-1 transition-transform"></i>
                <span>{{ trans('global.logout') }}</span>
            </a>
        </li>
    </ul>

</div>