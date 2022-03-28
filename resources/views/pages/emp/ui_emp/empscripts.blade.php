<!-- jquery latest version -->
<script src="{{ asset('assetemp/js/vendor/jquery-2.2.4.min.js') }}"></script>
<!-- bootstrap 4 js -->
<script src="{{ asset('assetemp/js/popper.min.js') }}"></script>
<script src="{{ asset('assetemp/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assetemp/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assetemp/js/metisMenu.min.js') }}"></script>
<script src="{{ asset('assetemp/js/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('assetemp/js/jquery.slicknav.min.js') }}"></script>

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
<script src="{{ asset('assetemp/js/line-chart.js') }}"></script>
<!-- all pie chart -->
<script src="{{ asset('assetemp/js/pie-chart.js') }}"></script>
<!-- all bar chart -->
<script src="{{ asset('assetemp/js/bar-chart.js') }}"></script>
<!-- all map chart -->
<script src="{{ asset('assetemp/js/maps.js') }}"></script>
<!-- others plugins -->
<script src="{{ asset('assetemp/js/plugins.js') }}"></script>
<script src="{{ asset('assetemp/js/scripts.js') }}"></script>
{{-- non srtdash --}}
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
{{-- DataTables --}}
<script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<!-- dropzonejs -->
<script src="{{ asset('/plugins/dropzone/min/dropzone.min.js') }}"></script>
<!-- hide-show-fields-form -->
<script src="{{ asset('dist/js/hide-show-fields-form.js') }}"></script>
<script src="{{ asset('dist/js/hide-show-fields-form-float.js') }}"></script>
<script src="{{ asset('dist/js/selectclientbasedoption.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>

<script type="text/javascript">
    function Image_preview(event) {
        var image = URL.createObjectURL(event.target.files[0]);
        var imagediv = document.getElementById('pp');
        var newimg = document.createElement('img');
        newimg.src = image;
        newimg.width = 150;
        newimg.height = 150;
        imagediv.appendChild(newimg);
    }
</script>
@yield('empscript')