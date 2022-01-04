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
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/1234.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="/student/class"
                        class="nav-link  {{ request()->is('student/class') ? 'active text-light' : '' }}">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Kelas
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/student/profile"
                        class="nav-link  {{ request()->is('student/profile') ? 'active text-light' : '' }}">
                        <i class="nav-icon fas fa-address-card"></i>
                        <p>
                            Presensi
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
