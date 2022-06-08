<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-orange elevation-4">
    @yield('sidebar')
    <!-- Brand Logo -->
    <a href="/admin" class="brand-link">
        <img src="{{ secure_asset('dist/img/idekitelogo.png') }}" alt="Idekite Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
            <img src="{{ secure_asset('images/ikcore2.png') }}" width="150px" height="auto">
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
                        class="nav-link  {{ \Request::route()->getName() == 'admin' || \Request::route()->getName() == 'testCal' || \Request::route()->getName() == 'tables' ? 'active text-light' : '' }}">
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
                            Profil
                        </p>
                    </a>
                </li>
                <li
                    class="nav-item {{ \Request::route()->getName() == 'manage_user' || \Request::route()->getName() == 'prof' || \Request::route()->getName() == 'joblist' || \Request::route()->getName() == 'manage_task' || request()->is('admin/manage/finance*') || request()->is('admin/meetings*') ? 'menu-open' : 'menu-closed' }}">
                    <a 
                        class="nav-link {{ \Request::route()->getName() == 'manage_user' || \Request::route()->getName() == 'prof' || \Request::route()->getName() == 'joblist' || \Request::route()->getName() == 'manage_task' || request()->is('admin/manage/finance*') || request()->is('admin/meetings*') ? 'active text-light' : '' }}">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>
                            Manajemen
                        </p>
                        <i class="fas fa-angle-left right"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/manage_user/"
                                class="nav-link {{ \Request::route()->getName() == 'manage_user' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-users-cog"></i>
                                <p>
                                    Pengguna
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/prof/"
                                class="nav-link  {{ \Request::route()->getName() == 'prof' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user-tie"></i>
                                <p>
                                    Profesi
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
                        <li class="nav-item">
                            <a href="/admin/manage/project_all"
                                class="nav-link  {{ \Request::route()->getName() == 'manage_task' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-thumbtack"></i>
                                <p>
                                    Tugas
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/manage/finance"
                                class="nav-link  {{ request()->is('admin/manage/finance*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-money-check-alt"></i>
                                <p>
                                    Finansial
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/meetings"
                                class="nav-link  {{ request()->is('admin/meetings*') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-clock"></i>
                                <p>
                                    Meeting
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="/admin/project_all"
                        class="nav-link  {{ request()->is('admin/project_all*') ? 'active text-light' : '' }}">
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
                            Klien
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
                            Proyek
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/reports"
                        class="nav-link  {{ request()->is('admin/reports*') ? 'active text-light' : '' }}">
                        <i class="nav-icon fas fa-fax"></i>
                        <p>
                            Laporan
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
