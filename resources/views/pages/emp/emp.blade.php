<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{ asset('/emp/images/icon/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('/emp/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/emp/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/emp/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('/emp/css/metisMenu.css">') }}">
    <link rel="stylesheet" href="{{ asset('/emp/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/emp/css/slicknav.min.css') }}">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="{{ asset('/emp/css/typography.css">') }}">
    <link rel="stylesheet" href="{{ asset('/emp/css/default-css.css') }}">
    <link rel="stylesheet" href="{{ asset('/emp/css/styles.css">') }}">
    <link rel="stylesheet" href="{{ asset('/emp/css/responsive.css">') }}">
    <!-- modernizr css -->
    <script src="{{ asset('/emp/js/vendor/modernizr-2.8.3.min.js') }}"></script>
</head>
<body class="body-bg">
    <!-- preloader area start -->
    {{-- <div id="preloader">
        <div class="loader"></div>
    </div> --}}
    <!-- preloader area end -->
    @yield('body')
    <div class="wrapper">
        <div class="horizontal-main-wrapper">
            @include('pages.emp.ui_emp.topnav')
        </div>
    </div>
    <!-- offset area end -->
    <!-- jquery latest version -->
    <script src="{{ asset('/emp/js/vendor/jquery-2.2.4.min.js"') }}"></script>
    <!-- bootstrap 4 js -->
    <script src="{{ asset('/emp/js/popper.min.js') }}"></script>
    <script src="{{ asset('/emp/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/emp/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('/emp/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('/emp/js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('/emp/js/jquery.slicknav.min.js') }}"></script>

    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <!-- start amcharts -->
    <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="https://www.amcharts.com/lib/3/ammap.js"></script>
    <script src="https://www.amcharts.com/lib/3/maps/js/worldLow.js"></script>
    <script src="https://www.amcharts.com/lib/3/serial.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
    <!-- all line chart activation -->
    <script src="{{ asset('/emp/js/line-chart.js') }}"></script>
    <!-- all pie chart -->
    <script src="{{ asset('/emp/js/pie-chart.js') }}"></script>
    <!-- all bar chart -->
    <script src="{{ asset('/emp/js/bar-chart.js') }}"></script>
    <!-- all map chart -->
    <script src="{{ asset('/emp/js/maps.js') }}"></script>
    <!-- others plugins -->
    <script src="{{ asset('/emp/js/plugins.js') }}"></script>
    <script src="{{ asset('/emp/js/scripts.js') }}"></script>
</body>

</html>