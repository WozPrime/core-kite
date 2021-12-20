<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{ asset('assetemp/images/icon/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('assetemp/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assetemp/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assetemp/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assetemp/css/metisMenu.css') }}">
    <link rel="stylesheet" href="{{ asset('assetemp/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assetemp/css/slicknav.min.css') }}">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="{{ asset('assetemp/css/typography.css') }}">
    <link rel="stylesheet" href="{{ asset('assetemp/css/default-css.css') }}">
    <link rel="stylesheet" href="{{ asset('assetemp/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assetemp/css/responsive.css') }}">
    <!-- modernizr css -->
    <script src="{{ asset('assetemp/js/vendor/modernizr-2.8.3.min.js') }}"></script>
    <!-- Font Awesome -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    {{-- AdminLTE --}}
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <style>
        .floating-btn {
            width: 50px;
            height: 50px;
            background: var(--gray-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            border-radius: 50%;
            color: var(--white);
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.25);
            position: fixed;
            right: 20px;
            bottom: 20px;
            transition: background 0.25s;
    
            /* button */
            outline: gray;
            border: none;
            cursor: pointer;
        }
    
        .floating-btn:hover {
            color: lawngreen;
        }
    
        .floating-btn:active {
            background: var(--gray);
        }
    </style>
    @yield('emphead')
</head>
