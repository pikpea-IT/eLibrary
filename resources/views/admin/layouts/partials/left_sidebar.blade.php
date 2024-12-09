<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ assetUrl() }}assets/backend/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{env("APP_NAME")}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ assetUrl() }}assets/backend/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu"
            data-accordion="false">
            @can('user_management_access')
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}"
                    class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        {{ trans('global.dashboard') }}
                    </p>
                </a>
            </li>
            @endcan

            <li
                class="nav-item {{ Request::is('admin/permissions*') || Request::is('admin/roles*') || Request::is('admin/users*') ? 'active menu-is-opening menu-open' : '' }}">
                <a href="/"
                    class="nav-link {{ Request::is('admin/roles*') || Request::is('admin/users*') ? 'active' : '' }}">
                    <i class="nav-icon fas fas fa-user-cog"></i>
                    <p>
                        Manage Books
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">

                    <li class="nav-item">
                        <a href="{{ route('admin.permissions.index') }}"
                            class="nav-link {{ Request::is('admin/permissions*') ? 'active' : null }}">
                            <i class="nav-icon fas fa-briefcase"></i>
                            <p>Book List</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.roles.index') }}"
                            class="nav-link {{ Request::is('admin/roles*') ? 'active' : null }}">
                            <i class="nav-icon fas fa-briefcase"></i>
                            <p>Category</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}"
                            class="nav-link {{ Request::is('admin/users*') ? 'active' : null }}">
                            <i class="nav-icon fas fa-user"></i>
                            <p>Shiff</p>
                        </a>
                    </li>

                </ul>
            </li>

            <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
            @can('user_management_access')
            {{-- User Management --}}
            <li
                class="nav-item {{ Request::is('admin/permissions*') || Request::is('admin/roles*') || Request::is('admin/users*') ? 'active menu-is-opening menu-open' : '' }}">
                <a href="/"
                    class="nav-link {{ Request::is('admin/roles*') || Request::is('admin/users*') ? 'active' : '' }}">
                    <i class="nav-icon fas fas fa-user-cog"></i>
                    <p>
                        {{ trans('cruds.userManagement.title') }}
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @can('permission_access')
                    <li class="nav-item">
                        <a href="{{ route('admin.permissions.index') }}"
                            class="nav-link {{ Request::is('admin/permissions*') ? 'active' : null }}">
                            <i class="nav-icon fas fa-briefcase"></i>
                            <p>{{ trans('cruds.permission.title') }}</p>
                        </a>
                    </li>
                    @endcan
                    @can('role_access')
                    <li class="nav-item">
                        <a href="{{ route('admin.roles.index') }}"
                            class="nav-link {{ Request::is('admin/roles*') ? 'active' : null }}">
                            <i class="nav-icon fas fa-briefcase"></i>
                            <p>{{ trans('cruds.role.title') }}</p>
                        </a>
                    </li>
                    @endcan
                    @can('user_access')
                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}"
                            class="nav-link {{ Request::is('admin/users*') ? 'active' : null }}">
                            <i class="nav-icon fas fa-user"></i>
                            <p>{{ trans('cruds.user.title') }}</p>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
            <li class="nav-item">
                <a href="#" class="nav-link"
                    onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fas fa-fw fa-sign-out-alt"></i>
                    <p>
                        {{ trans('Logout') }}
                    </p>
                </a>
                <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>