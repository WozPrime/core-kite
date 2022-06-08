<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    {{-- Tombol Tambah di Table --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ secure_asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ secure_asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ secure_asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ secure_asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ secure_asset('dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ secure_asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ secure_asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ secure_asset('plugins/summernote/summernote-bs4.min.css') }}">
    {{-- DataTables --}}
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    {{-- Material Design Icon --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    {{-- DROPZONE --}}
    <link rel="stylesheet" href="{{ secure_asset('/plugins/dropzone/min/dropzone.min.css') }}">

    {{-- select2 --}}
    <link rel="stylesheet" href="{{ secure_asset('/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    
        
    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{ secure_asset('/plugins/fullcalendar/main.css')}}">

    <!-- show-hide-fields-form -->
    <link rel="stylesheet" href="{{ secure_asset('plugins/hsff/hide-show-field-form.css') }}">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    @yield('body')
    <div class="wrapper">

        @include('pages.ui_admin.navbar')
        @include('pages.ui_admin.sidebar')

        @include('sweetalert::alert')


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" @yield('size')>
            @yield('content')
        </div>
        <!-- /.content-wrapper -->
        <footer style="text-align: center" class="main-footer">
            @yield('footer')
            <strong>{{Carbon\Carbon::now()->format('Y') }}  Ⓒ  <a href="https://idekite.id/">IdeKite Indonesia</a></strong>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <script src="{{secure_asset('plugins/sweetalert2/sweetalert2.all.min.js')}}"></script>
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
    {{-- DataTables --}}
    <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <!-- hide-show-fields-form -->
    <script src="{{ secure_asset('dist/js/hide-show-fields-form.js') }}"></script>
    <script src="{{ secure_asset('dist/js/hide-show-fields-form-float.js') }}"></script>
    <script src="{{ secure_asset('dist/js/selectclientbasedoption.js') }}"></script>
    {{-- Get Current Date and Time --}}
    <script src="{{ secure_asset('dist/js/currentdatetime.js') }}"></script>
    <!-- dropzonejs -->
    <script src="{{ secure_asset('/plugins/dropzone/min/dropzone.min.js') }}"></script>
    {{-- Select2 --}}
    <script src="{{ secure_asset('/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- fullCalendar 2.2.5 -->
    <script src="{{ secure_asset('/plugins/moment/moment.min.js')}}"></script>
    <script src="{{ secure_asset('/plugins/fullcalendar/main.js')}}"></script>


    {{-- Multi Page Modal --}}
    <script src="{{ secure_asset('dist/js/multipagemodal.js') }}"></script>
    {{-- Currency Input --}}
    <script src="{{ secure_asset('dist/js/currencyinput.js') }}"></script>
    {{-- script gambar preview --}}
    <script type="text/javascript">
        function Image_preview(event) {
            var image = URL.createObjectURL(event.target.files[0]);
            var imagediv = document.getElementById('pp');
            var newimg = document.createElement('img');
            newimg.src = image;
            newimg.width = 100;
            newimg.height = 100;
            imagediv.appendChild(newimg);
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
    <script>
        jQuery(document).ready(function() {
            // executes when HTML-Document is loaded and DOM is ready
            console.log("document is ready");


            jQuery('.btn[href^=#insert]').click(function(e) {
                e.preventDefault();
                var href = jQuery(this).attr('href');
                jQuery(href).modal('toggle');
            });

        });
    </script>
    <script>
        $(function () {
             // Select2
                //Initialize Select2 Elements
                $('.select2').select2()

                //Initialize Select2 Elements
                $('.select2bs4').select2({
                    theme: 'bootstrap4'
                })

        })
    </script>
    
    @yield('script')

</body>

</html>
