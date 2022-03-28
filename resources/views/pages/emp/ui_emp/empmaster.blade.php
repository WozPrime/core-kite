<!DOCTYPE html>
<html lang="en">

@include('pages.emp.ui_emp.emphead')
<body class="body-bg">
    <!-- preloader area start -->
    {{-- <div id="preloader">
        <div class="loader"></div>
    </div> --}}
    <!-- preloader area end -->
    @yield('body')
        <div class="horizontal-main-wrapper">
            @include('pages.emp.ui_emp.topnav')
            @include('sweetalert::alert')
            <div class="main-content-inner">
                <div class="container">
                    @yield('content')
                </div>
            </div>
        </div>
        @include('pages.emp.ui_emp.empfooter')
    @include('pages.emp.ui_emp.empscripts')
</body>

</html>