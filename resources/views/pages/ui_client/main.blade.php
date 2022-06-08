<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    {{-- Tombol Tambah di Table --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ secure_asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ secure_asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ secure_asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ secure_asset('dist/css/adminlte.min.css') }}">
    {{-- One Template --}}
    <link rel="stylesheet" href="{{ secure_asset('dist/css/application.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ secure_asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ secure_asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ secure_asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ secure_asset('plugins/summernote/summernote-bs4.min.css') }}">
    <!-- show-hide-fields-form -->
    <link rel="stylesheet" href="{{ secure_asset('plugins/hsff/hide-show-field-form.css') }}">
    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{ secure_asset('plugins/fullcalendar/main.css') }}">


</head>

<body class="hold-transition layout-fixed sidebar-collapse">
    @yield('body')
    <div class="wrapper">

        @include('pages.ui_client.navbar')
        {{-- @include('pages.ui_client.sidebar') --}}
        @include('sweetalert::alert')
        

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            @yield('footer')
            2021-2022 CV. Idekite Indonesia
            <div class="float-right d-none d-sm-inline-block">
                <b>CV IDEKITE INDONESIA</b> 2021-2022
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ secure_asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ secure_asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ secure_asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ secure_asset('plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ secure_asset('plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ secure_asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ secure_asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ secure_asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ secure_asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ secure_asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ secure_asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ secure_asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ secure_asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ secure_asset('dist/js/adminlte.js') }}"></script>
    <script src="{{ secure_asset('dist/js/pages/dashboard.js') }}"></script>
    <!-- hide-show-fields-form -->
    <script src="{{ secure_asset('dist/js/hide-show-fields-form.js') }}"></script>
    <script src="{{ secure_asset('dist/js/checkpasswordvalidity.js') }}"></script>
    <script src="{{ secure_asset('dist/js/selectclientbasedoption.js') }}"></script>
    {{-- Get Current Date and Time --}}
    <script src="{{ secure_asset('dist/js/currentdatetime.js') }}"></script>
    <!-- fullCalendar 2.2.5 -->
    <script src="{{ secure_asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ secure_asset('plugins/fullcalendar/main.js') }}"></script>

    <script src="{{ secure_asset('dist/js/settings.js') }}"></script>
    <script src="{{ secure_asset('dist/js/app.js') }}"></script>


    {{-- script gambar preview --}}
    <script type="text/javascript">
        function Image_preview(event){
            var image= URL.createObjectURL(event.target.files[0]);
            var imagediv = document.getElementById('pp');
            var newimg = document.createElement('img');
            newimg.src = image;
            newimg.width = 100;
            newimg.height = 100;
            imagediv.appendChild(newimg);
        }
    </script>
    

</body>

</html>
