<!-- main header area start -->
<div class="mainheader-area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-3">
                <a href="/emp" class="brand-link">
                    <img src="{{ asset('dist/img/idekitelogo.png') }}" alt="Idekite Logo"
                        class="brand-image img-circle elevation-3" style="opacity: .8">
                        <img src="{{ asset('images/ikcore2.png') }}" width="150px" height="auto">
                </a>
            </div>
            <!-- profile info & task notification -->
            <div class="col-md-9 clearfix text-right">
                <div class="d-md-inline-block d-block mr-md-4">
                    <ul class="notification-area">
                        {{-- <li id="full-view"><i class="ti-fullscreen"></i></li>
                        <li id="full-view-exit"><i class="ti-zoom-out"></i></li> --}}
                        {{-- <li class="dropdown">
                            <i class="ti-bell dropdown-toggle" data-toggle="dropdown">
                                <span>2</span>
                            </i>
                            <div class="dropdown-menu bell-notify-box notify-box">
                                <span class="notify-title">You have 3 new notifications <a href="#">view
                                        all</a></span>
                                <div class="nofity-list">
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb"><i class="ti-key btn-danger"></i></div>
                                        <div class="notify-text">
                                            <p>You have Changed Your Password</p>
                                            <span>Just Now</span>
                                        </div>
                                    </a>
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb"><i class="ti-comments-smiley btn-info"></i>
                                        </div>
                                        <div class="notify-text">
                                            <p>New Commetns On Post</p>
                                            <span>30 Seconds ago</span>
                                        </div>
                                    </a>
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb"><i class="ti-key btn-primary"></i></div>
                                        <div class="notify-text">
                                            <p>Some special like you</p>
                                            <span>Just Now</span>
                                        </div>
                                    </a>
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb"><i class="ti-comments-smiley btn-info"></i>
                                        </div>
                                        <div class="notify-text">
                                            <p>New Commetns On Post</p>
                                            <span>30 Seconds ago</span>
                                        </div>
                                    </a>
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb"><i class="ti-key btn-primary"></i></div>
                                        <div class="notify-text">
                                            <p>Some special like you</p>
                                            <span>Just Now</span>
                                        </div>
                                    </a>
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb"><i class="ti-key btn-danger"></i></div>
                                        <div class="notify-text">
                                            <p>You have Changed Your Password</p>
                                            <span>Just Now</span>
                                        </div>
                                    </a>
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb"><i class="ti-key btn-danger"></i></div>
                                        <div class="notify-text">
                                            <p>You have Changed Your Password</p>
                                            <span>Just Now</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown">
                            <i class="fa fa-envelope-o dropdown-toggle" data-toggle="dropdown"><span>3</span></i>
                            <div class="dropdown-menu notify-box nt-enveloper-box">
                                <span class="notify-title">You have 3 new notifications <a href="#">view
                                        all</a></span>
                                <div class="nofity-list">
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb">
                                            <img src="{{ asset('assetemp/images/author/author-img1.jpg') }}"
                                                alt="image">
                                        </div>
                                        <div class="notify-text">
                                            <p>Aglae Mayer</p>
                                            <span class="msg">Hey I am waiting for you...</span>
                                            <span>3:15 PM</span>
                                        </div>
                                    </a>
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb">
                                            <img src="{{ asset('assetemp/images/author/author-img2.jpg') }}"
                                                alt="image">
                                        </div>
                                        <div class="notify-text">
                                            <p>Aglae Mayer</p>
                                            <span class="msg">When you can connect with me...</span>
                                            <span>3:15 PM</span>
                                        </div>
                                    </a>
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb">
                                            <img src="{{ asset('assetemp/images/author/author-img3.jpg') }}"
                                                alt="image">
                                        </div>
                                        <div class="notify-text">
                                            <p>Aglae Mayer</p>
                                            <span class="msg">I missed you so much...</span>
                                            <span>3:15 PM</span>
                                        </div>
                                    </a>
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb">
                                            <img src="{{ asset('assetemp/images/author/author-img4.jpg') }}"
                                                alt="image">
                                        </div>
                                        <div class="notify-text">
                                            <p>Aglae Mayer</p>
                                            <span class="msg">Your product is completely
                                                Ready...</span>
                                            <span>3:15 PM</span>
                                        </div>
                                    </a>
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb">
                                            <img src="{{ asset('assetemp/images/author/author-img2.jpg') }}"
                                                alt="image">
                                        </div>
                                        <div class="notify-text">
                                            <p>Aglae Mayer</p>
                                            <span class="msg">Hey I am waiting for you...</span>
                                            <span>3:15 PM</span>
                                        </div>
                                    </a>
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb">
                                            <img src="{{ asset('assetemp/images/author/author-img1.jpg') }}"
                                                alt="image">
                                        </div>
                                        <div class="notify-text">
                                            <p>Aglae Mayer</p>
                                            <span class="msg">Hey I am waiting for you...</span>
                                            <span>3:15 PM</span>
                                        </div>
                                    </a>
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb">
                                            <img src="{{ asset('assetemp/images/author/author-img3.jpg') }}"
                                                alt="image">
                                        </div>
                                        <div class="notify-text">
                                            <p>Aglae Mayer</p>
                                            <span class="msg">Hey I am waiting for you...</span>
                                            <span>3:15 PM</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="settings-btn">
                            <i class="ti-settings"></i>
                        </li> --}}
                    </ul>
                </div>
                <div class="clearfix d-md-inline-block d-block">
                    <div class="user-profile m-0">
                        @if (Auth::user()->pp == '')
                            <img src="{{ url('pp/default.jpg') }}" class="avatar user-thumb" alt="avatar">
                        @else
                            <img src="{{ url('pp/' . Auth::user()->pp) }}"
                                class="avatar user-thumb" alt="avatar">
                        @endif
                        <h4 class="user-name dropdown-toggle pt-2" data-toggle="dropdown">{{ Auth::user()->name }}<i class="fa fa-angle-down pb-1"></i></h4>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href={{ request()->is('emp/profile') ? 'javascript:void(0)' : '/emp/profile/' }}>Pengaturan Profil</a>
                            {{-- <a class="dropdown-item" href="#">Settings</a> --}}
                            <a class="dropdown-item" href="{{ route('logout') }}">Log Out</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- main header area end -->
<!-- header area start -->
<div class="header-area header-bottom">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-9 d-none d-lg-block">
                <div class="horizontal-menu">
                    <nav>
                        <ul id="nav_menu">
                            <li class="{{ request()->is('emp') ? 'active' : '' }}"><a href={{ request()->is('emp') ? 'javascript:void(0)' : '/emp' }}><i class="ti-dashboard"></i><span>Dashboard</span></a></li>
                            <li class="{{ request()->is('emp/joblist') || request()->is('emp/project*') ? 'active' : '' }}"><a href="javascript:void(0)"><i class="ti-check-box"></i><span>To Do List</span></a>
                                <ul class="submenu">
                                    <li><a href={{ request()->is('emp/joblist') ? 'javascript:void(0)' : '/emp/joblist' }}>Joblist</a></li>
                                    <li><a href={{ request()->is('emp/project') ? 'javascript:void(0)' : '/emp/project' }}>Project</a></li>
                                </ul>
                            </li>
                            <li class="{{ request()->is('emp/reports') ? 'active' : '' }}"><a href={{ request()->is('emp/reports') ? 'javascript:void(0)' : '/emp/reports' }}><i class="ti-printer"></i><span>Report</span></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- mobile_menu -->
            <div class="col-12 d-block d-lg-none">
                <div id="mobile_menu"></div>
            </div>
        </div>
    </div>
</div>
<!-- header area end -->
