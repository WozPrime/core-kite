<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <!-- Left navbar links -->
    <ul class="navbar-nav">
        {{-- <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li> --}}
        <a href="/client" class="brand-link">
            <img src="{{ secure_asset('dist/img/idekitelogo.png') }}" alt="Idekite Logo"
                class="brand-image img-circle elevation-3" style="opacity: .8">
                <img src="{{ secure_asset('images/ikcore2.png') }}" width="150px" height="auto">
        </a>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                @if (Auth::user()->pp == '')
                <img class="user-image img-circle elevation-2" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" alt="User profile picture">
                @else
                    <img src="{{ url('pp/' . Auth::user()->pp) }}" class="user-image img-circle elevation-2"
                        alt="{{ Auth::user()->name }}">
                @endif
                <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-orange">
                    @if (Auth::user()->pp == '')
                    <img class="user-image img-circle elevation-2" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" alt="User profile picture">
                    @else
                        <img src="{{ url('pp/' . Auth::user()->pp) }}" class="user-image img-circle elevation-2"
                            alt="{{ Auth::user()->name }}">
                    @endif

                    <p class="text-light">
                        {{ Auth::user()->name }}
                        <small>Member since {{Auth::user()->created_at}}</small>
                    </p>
                </li>
                <!-- Menu Body -->
                {{-- <li class="user-body">
                    <div class="row">
                        <div class="col-4 text-center">
                            <a href="#">Followers</a>
                        </div>
                        <div class="col-4 text-center">
                            <a href="#">Sales</a>
                        </div>
                        <div class="col-4 text-center">
                            <a href="#">Friends</a>
                        </div>
                    </div>
                    <!-- /.row -->
                </li> --}}
                <!-- Menu Footer-->
                <li class="user-footer">
                    <a href="/admin/profile/{{ Auth::user()->id }}" class="btn btn-default btn-flat">Profile</a>
                    <a href="{{ route('logout') }}" class="btn btn-default btn-flat float-right">Sign out</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
