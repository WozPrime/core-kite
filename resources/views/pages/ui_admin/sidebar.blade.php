<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-orange elevation-4">
    @yield('sidebar')
    <!-- Brand Logo -->
    <a href="/admin" class="brand-link">
        <img src="{{ asset('dist/img/idekitelogo.png') }}" alt="Idekite Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <h4 class="brand-text font-weight-bold">IDEKITE<span class="text-orange">CORE</span> </h4>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <br>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="/admin"
                        class="nav-link  {{ \Request::route()->getName() == 'admin' ? 'active text-light' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>

                </li>
                <li class="nav-item">
                    <a href="/admin/profile/"
                        class="nav-link  {{ \Request::route()->getName() == 'profile' ? 'active text-light' : '' }}">
                        <i class="nav-icon fas fa-address-card"></i>
                        <p>
                            Profile
                        </p>
                    </a>
                </li>
                <li
                    class="nav-item {{ \Request::route()->getName() == 'manage_user' || \Request::route()->getName() == 'prof' || \Request::route()->getName() == 'joblist' ? 'menu-open' : 'menu-closed' }}">
                    <a 
                        class="nav-link {{ \Request::route()->getName() == 'manage_user' || \Request::route()->getName() == 'prof' || \Request::route()->getName() == 'joblist' ? 'active text-light' : '' }}">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>
                            Management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/manage_user/"
                                class="nav-link {{ \Request::route()->getName() == 'manage_user' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-users-cog"></i>
                                <p>
                                    Users
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/prof/"
                                class="nav-link  {{ \Request::route()->getName() == 'prof' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user-tie"></i>
                                <p>
                                    Profession
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/joblist/"
                                class="nav-link  {{ \Request::route()->getName() == 'joblist' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-clipboard-list"></i>
                                <p>
                                    Joblist
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="/admin/project_task"
                        class="nav-link  {{ request()->is('admin/project_task*') ? 'active text-light' : '' }}">
                        <i class="nav-icon fas fa-clipboard-check"></i>
                        <p>
                            To Do List
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    {{-- <a href="/admin/instansi"
                        class="nav-link  {{ request()->is('admin/instansi*') ? 'active text-light' : '' }}"> --}}
                    <a href="/admin/client"
                        class="nav-link  {{ request()->is('admin/client*') ? 'active text-light' : '' }}">
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>
                            Client
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    {{-- <a href="/admin/instansi"
                        class="nav-link  {{ request()->is('admin/instansi*') ? 'active text-light' : '' }}"> --}}
                    <a href="/admin/instansi"
                        class="nav-link  {{ request()->is('admin/instansi*') ? 'active text-light' : '' }}">
                        <i class="nav-icon fas fa-building"></i>
                        <p>
                            Instansi
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/proyek"
                        class="nav-link  {{ request()->is('admin/proyek*') ? 'active text-light' : '' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Project
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/reports"
                        class="nav-link  {{ request()->is('admin/reports*') ? 'active text-light' : '' }}">
                        <i class="nav-icon fas fa-fax"></i>
                        <p>
                            Reports
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
