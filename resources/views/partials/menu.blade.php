<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show bg-slate-900 border-r border-slate-800">

    <!-- Brand Section -->
    <div class="c-sidebar-brand d-md-down-none py-9 px-6 border-b border-slate-800/40 bg-gradient-to-b from-slate-900/50 to-transparent">
        @include('partials.logo')
    </div>

    <ul class="c-sidebar-nav mt-4 px-3 space-y-1">
        <!-- 1. Dashboard -->
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-slate-400 font-medium hover:text-white hover:bg-slate-800/50 transition-all group {{ request()->is("admin") ? "bg-slate-800 text-white shadow-sm" : "" }}">
                <i class="fas fa-fw fa-tachometer-alt text-sm group-hover:scale-110 transition-transform {{ request()->is("admin") ? "text-indigo-400" : "" }}"></i>
                <span>{{ trans('global.dashboard') }}</span>
            </a>
        </li>

        <!-- 2. Kanban -->
        @can('deal_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.kanban.index") }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-slate-400 font-medium hover:text-white hover:bg-slate-800/50 transition-all group {{ request()->is("admin/kanban") || request()->is("admin/kanban/*") ? "bg-slate-800 text-white shadow-sm" : "" }}">
                    <i class="fas fa-columns text-sm group-hover:scale-110 transition-transform {{ request()->is("admin/kanban") || request()->is("admin/kanban/*") ? "text-indigo-400" : "" }}"></i>
                    <span>Kanban</span>
                </a>
            </li>
        @endcan

        <!-- 3. Deals -->
        @can('deal_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.deals.index") }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-slate-400 font-medium hover:text-white hover:bg-slate-800/50 transition-all group {{ request()->is("admin/deals") || request()->is("admin/deals/*") ? "bg-slate-800 text-white shadow-sm" : "" }}">
                    <i class="fas fa-filter text-sm group-hover:scale-110 transition-transform {{ request()->is("admin/deals") || request()->is("admin/deals/*") ? "text-indigo-400" : "" }}"></i>
                    <span>{{ trans('cruds.deal.title') }}</span>
                </a>
            </li>
        @endcan

        <!-- 4. Contacts -->
        @can('crm_contact_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.crm-contacts.index") }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-slate-400 font-medium hover:text-white hover:bg-slate-800/50 transition-all group {{ request()->is("admin/crm-contacts") || request()->is("admin/crm-contacts/*") ? "bg-slate-800 text-white shadow-sm" : "" }}">
                    <i class="fas fa-user-friends text-sm group-hover:scale-110 transition-transform {{ request()->is("admin/crm-contacts") || request()->is("admin/crm-contacts/*") ? "text-indigo-400" : "" }}"></i>
                    <span>{{ trans('cruds.crmContact.title') }}</span>
                </a>
            </li>
        @endcan

        <!-- 5. Products -->
        @can('crm_product_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.crm-products.index") }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-slate-400 font-medium hover:text-white hover:bg-slate-800/50 transition-all group {{ request()->is("admin/crm-products") || request()->is("admin/crm-products/*") ? "bg-slate-800 text-white shadow-sm" : "" }}">
                    <i class="fas fa-box text-sm group-hover:scale-110 transition-transform {{ request()->is("admin/crm-products") || request()->is("admin/crm-products/*") ? "text-indigo-400" : "" }}"></i>
                    <span>{{ trans('cruds.crmProduct.title') }}</span>
                </a>
            </li>
        @endcan

        <!-- 6. Task Management -->
        @can('task_management_access')
            <li class="c-sidebar-nav-dropdown">
                <a class="flex items-center justify-between px-4 py-2.5 rounded-xl text-slate-400 font-medium hover:text-white hover:bg-slate-800/50 transition-all group c-sidebar-nav-dropdown-toggle" href="#">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-tasks text-sm group-hover:scale-110 transition-transform"></i>
                        <span>{{ trans('cruds.taskManagement.title') }}</span>
                    </div>
                </a>
                <ul class="c-sidebar-nav-dropdown-items mt-1 space-y-1 pl-9">
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
                                {{ trans('cruds.tasksCalendar.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan

        <!-- 7. User management -->
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown">
                <a class="flex items-center justify-between px-4 py-2.5 rounded-xl text-slate-400 font-medium hover:text-white hover:bg-slate-800/50 transition-all group c-sidebar-nav-dropdown-toggle" href="#">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-users text-sm group-hover:scale-110 transition-transform"></i>
                        <span>{{ trans('cruds.userManagement.title') }}</span>
                    </div>
                </a>
                <ul class="c-sidebar-nav-dropdown-items mt-1 space-y-1 pl-9">
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="block px-4 py-2 rounded-lg text-sm text-slate-500 hover:text-white hover:bg-slate-800/50 transition-all {{ request()->is("admin/users") || request()->is("admin/users/*") ? "text-indigo-400 font-bold" : "" }}">
                                {{ trans('cruds.user.title') }}
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
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="block px-4 py-2 rounded-lg text-sm text-slate-500 hover:text-white hover:bg-slate-800/50 transition-all {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "text-indigo-400 font-bold" : "" }}">
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan

        <!-- 8. Settings -->
        <li class="c-sidebar-nav-dropdown">
            <a class="flex items-center justify-between px-4 py-2.5 rounded-xl text-slate-400 font-medium hover:text-white hover:bg-slate-800/50 transition-all group c-sidebar-nav-dropdown-toggle" href="#">
                <div class="flex items-center gap-3">
                    <i class="fas fa-cogs text-sm group-hover:scale-110 transition-transform"></i>
                    <span>Settings</span>
                </div>
            </a>
            <ul class="c-sidebar-nav-dropdown-items mt-1 space-y-1 pl-9">
                @can('audit_log_access')
                    <li class="c-sidebar-nav-item">
                        <a href="{{ route("admin.audit-logs.index") }}" class="block px-4 py-2 rounded-lg text-sm text-slate-500 hover:text-white hover:bg-slate-800/50 transition-all {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "text-indigo-400 font-bold" : "" }}">
                            {{ trans('cruds.auditLog.title') }}
                        </a>
                    </li>
                @endcan
                @can('task_status_access')
                    <li class="c-sidebar-nav-item">
                        <a href="{{ route("admin.task-statuses.index") }}" class="block px-4 py-2 rounded-lg text-sm text-slate-500 hover:text-white hover:bg-slate-800/50 transition-all {{ request()->is("admin/task-statuses") || request()->is("admin/task-statuses/*") ? "text-indigo-400 font-bold" : "" }}">
                            {{ trans('cruds.taskStatus.title') }}
                        </a>
                    </li>
                @endcan
                @can('product_category_access')
                    <li class="c-sidebar-nav-item">
                        <a href="{{ route("admin.product-categories.index") }}" class="block px-4 py-2 rounded-lg text-sm text-slate-500 hover:text-white hover:bg-slate-800/50 transition-all {{ request()->is("admin/product-categories") || request()->is("admin/product-categories/*") ? "text-indigo-400 font-bold" : "" }}">
                            {{ trans('cruds.productCategory.title') }}
                        </a>
                    </li>
                @endcan
                @can('deal_stage_access')
                    <li class="c-sidebar-nav-item">
                        <a href="{{ route("admin.deal-stages.index") }}" class="block px-4 py-2 rounded-lg text-sm text-slate-500 hover:text-white hover:bg-slate-800/50 transition-all {{ request()->is("admin/deal-stages") || request()->is("admin/deal-stages/*") ? "text-indigo-400 font-bold" : "" }}">
                            {{ trans('cruds.dealStage.title') }}
                        </a>
                    </li>
                @endcan
                @can('deal_source_access')
                    <li class="c-sidebar-nav-item">
                        <a href="{{ route("admin.deal-sources.index") }}" class="block px-4 py-2 rounded-lg text-sm text-slate-500 hover:text-white hover:bg-slate-800/50 transition-all {{ request()->is("admin/deal-sources") || request()->is("admin/deal-sources/*") ? "text-indigo-400 font-bold" : "" }}">
                            {{ trans('cruds.dealSource.title') }}
                        </a>
                    </li>
                @endcan
            </ul>
        </li>

        <!-- 9. Messages -->
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

        <!-- 10. Change password -->
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('profile.password.edit') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-slate-400 font-medium hover:text-white hover:bg-slate-800/50 transition-all group {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'bg-slate-800 text-white shadow-sm' : '' }}">
                        <i class="fa-fw fas fa-key text-sm group-hover:scale-110 transition-transform {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'text-indigo-400' : '' }}"></i>
                        <span>{{ trans('global.change_password') }}</span>
                    </a>
                </li>
            @endcan
        @endif

        <!-- 11. Logout -->
        <li class="c-sidebar-nav-item mt-auto pb-4">
            <a href="#" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-rose-400 font-medium hover:text-rose-300 hover:bg-rose-500/10 transition-all group" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="fas fa-sign-out-alt text-sm group-hover:translate-x-1 transition-transform"></i>
                <span>{{ trans('global.logout') }}</span>
            </a>
        </li>
    </ul>

</div>