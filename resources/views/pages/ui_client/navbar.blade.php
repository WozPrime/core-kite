<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('home') }}" class="nav-link">Home</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                @if (Auth::user()->pp == '')
                    <img src="{{ url('pp/default.jpg') }}" class="user-image img-circle elevation-2"
                        alt="{{ Auth::user()->name }}">
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
                        <img src="{{ url('pp/default.jpg') }}" class="user-image img-circle elevation-2"
                            alt="{{ Auth::user()->name }}">
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
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
