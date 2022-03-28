@php
    use Carbon\Carbon;
@endphp
@extends('pages.emp.ui_emp.empmaster')
@section('title')
    Laporan Karyawan
@endsection
@section('emphead')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
@endsection
@section('empscript')
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Reports</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/emp/home">Home</a></li>
                        <li class="breadcrumb-item active">Reports</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    {{-- End Content Header --}}
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title pt-1">List of Reports</h3>
                            <div class="col-xs-3" style="float: right">
                                <a href="#pdf" class="btn btn-block btn-info text-light" data-toggle="modal"><i
                                        class="fas fa-file-alt mr-2"></i>Generate PDF</a>
                                {{-- <a href="generate-pdf" target="_blank" class="btn btn-block btn-info"><i class="fas fa-file-alt mr-2"></i>Generate PDF</a> --}}
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-responsive-sm table-bordered" id="myTable" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No</th>
                                        <th class="col-3">Submitter</th>
                                        <th class="col-2">Status</th>
                                        <th class="col-3">Date</th>
                                        <th class="col-2">Job</th>
                                        <th class="col-2">Project Name</th>
                                        <th class="col-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($project_task as $p_task)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $p_task->users()->first()->name }}</td>
                                            <td>
                                                <small
                                                    class="badge 
                                                    @if ($p_task->status == 1) badge-secondary
                                                    @elseif ($p_task->status == 2)
                                                    badge-success
                                                    @elseif ($p_task->status == 3)
                                                    badge-danger 
                                                    @else
                                                    badge-warning @endif
                                                    "
                                                    id='deadline'>
                                                    @if ($p_task->status == 1)
                                                        Unchecked
                                                    @elseif ($p_task->status == 2)
                                                        Checked
                                                    @elseif ($p_task->status == 3)
                                                        Not Passed
                                                    @else
                                                        Unsubmitted
                                                    @endif
                                                </small>
                                            </td>
                                            <td class="@if ($p_task->post_date == null) text-red @endif">
                                                @if ($p_task->post_date == null)
                                                    Not Uploaded Yet
                                                @else
                                                    {{ date('D, d M Y H:i', strtotime($p_task->post_date)) }}
                                                @endif
                                            </td>
                                            <td>{{ $p_task->details }}</td>
                                            <td>{{ $p_task->project()->first()->project_name }}</td>
                                            <td style="text-align: center">
                                                <a class="btn btn-primary mr-1 mb-1" data-toggle="modal"
                                                    href="#detail{{ $p_task->id }}"><i class="fa fa-eye"></i></a>
                                            </td>
                                            <div class="modal fade" id="detail{{ $p_task->id }}">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Task Detail</h4>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <section class="container-fluid">
                                                                <div class="card card-primary card-outline">
                                                                    <div class="card-body box-profile">
                                                                        <div class="text-center">
                                                                            @if ($p_task->project()->first()->project_logo == '')
                                                                                <img src="{{ url('prof/default.png') }}"
                                                                                    class="profile-user-img img-fluid img-circle">
                                                                            @else
                                                                                <img src="{{ url('pp/' . $p_task->project()->first()->project_name) }}"
                                                                                    class="profile-user-img img-fluid img-circle">
                                                                            @endif
                                                                        </div>

                                                                        <h3 class="profile-username text-center">
                                                                            {{ $p_task->project()->first()->project_name }}
                                                                        </h3>

                                                                        <p class="text-muted text-center">
                                                                            {{ $p_task->instance()->first()->nama_instansi }}
                                                                        </p>

                                                                        <ul class="list-group list-group-unbordered mb-3">
                                                                            <li class="list-group-item">
                                                                                <b>Task</b> <a
                                                                                    class="float-right text-dark">
                                                                                    {{ $p_task->details }}
                                                                                </a>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <b>PJ</b> <a class="float-right text-dark">
                                                                                    {{ $p_task->users()->first()->name }}
                                                                                </a>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <b>Category</b> <a
                                                                                    class="float-right text-dark">
                                                                                    {{ $p_task->tasks()->first()->task_name }}
                                                                                </a>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <b>Date Uploaded</b> <a
                                                                                    class="float-right 
                                                                                    @if ($p_task->post_date) text-dark
                                                                                    @else
                                                                                        text-red @endif
                                                                                    ">
                                                                                    @if ($p_task->post_date)
                                                                                        {{ date('D, d M Y H:i', strtotime($p_task->post_date)) }}
                                                                                    @else
                                                                                        Not Uploaded Yet
                                                                                    @endif
                                                                                </a>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <b>Deadline</b> <a
                                                                                    class="float-right 
                                                                                    @if ($p_task->post_date) text-success
                                                                                    @else
                                                                                        text-red @endif
                                                                                    ">
                                                                                    {{ date('D, d M Y H:i', strtotime($p_task->expired_at)) }}
                                                                                </a>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <b>Deadline Intervals</b>
                                                                                <a
                                                                                    class="float-right
                                                                                @if ($p_task->post_date) text-dark
                                                                                    @else
                                                                                        text-red @endif
                                                                                    ">
                                                                                    @if ($p_task->post_date)
                                                                                        @php
                                                                                            $diff = floor((strtotime($p_task->expired_at) - strtotime($p_task->post_date)) / 86400);
                                                                                        @endphp
                                                                                        @if ($diff >= 1)
                                                                                            {{ $diff }} Days
                                                                                        @else
                                                                                            @if ($diff > 0 && $diff < 1)
                                                                                                {{ floor((strtotime($p_task->expired_at) - strtotime($p_task->post_date)) / 1440) }}
                                                                                                Minutes
                                                                                            @else
                                                                                                Deadline Expired
                                                                                            @endif
                                                                                        @endif
                                                                                    @else
                                                                                        Not Uploaded Yet
                                                                                    @endif
                                                                                </a>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <b>Upload Details</b> <a
                                                                                    class="float-right 
                                                                                    @if ($p_task->upload_details) text-dark
                                                                                    @else
                                                                                        text-red @endif
                                                                                    ">
                                                                                    @if ($p_task->upload_details)
                                                                                        {{ $p_task->upload_details }}
                                                                                    @else
                                                                                        Not Uploaded Yet
                                                                                    @endif
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <!-- /.card-body -->
                                                                </div>


                                                                <div class="card card-secondary">
                                                                    <div class="card-header">
                                                                        <h3 class="card-title">Download File</h3>
                                                                    </div>
                                                                    <!-- /.card-header -->
                                                                    <div class="card-body">
                                                                        @if ($doc->where('pt_id', $p_task->id)->count() == 0)
                                                                            <strong class="text-red">No File
                                                                                Added</strong>
                                                                        @else
                                                                            @foreach ($doc->where('pt_id', $p_task->id) as $file)
                                                                                <strong>{{ $file->file_name }}</strong>
                                                                                <a class="btn btn-primary mr-1 float-right"
                                                                                    href="/emp/file/download/{{ $file->file_name }}"><i
                                                                                        class="fas fa-download"></i></a>
                                                                                <hr>
                                                                            @endforeach
                                                                        @endif
                                                                    </div>
                                                                    <!-- /.card-body -->
                                                                </div>


                                                            </section>

                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.modal -->
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <!-- /.card -->
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
    <div class="modal fade" id="pdf">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card-header bg-orange">
                    <h3 class="card-title">Cetak Laporan</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form autocomplete="off" action="/emp/generate-pdf" method="post" enctype="multipart/form-data"
                    target="_blank">
                    @csrf
                    <div class="card-body">

                        <div class="content">
                            <div class="form-group" id="seeAnotherFieldReport">
                                <label for="seeAnotherFieldReport">Pilih Data Laporan</label>
                                <select class="form-select" aria-label="Disable" name="reportList" id="reportList"
                                    required>
                                    <option value="" selected hidden>Pilih Asal Data</option>
                                    <option value="Tanggal">Pilih Berdasarkan Waktu</option>
                                    <option value="Proyek">Pilih Berdasarkan Proyek</option>
                                    <option value="All"> Seluruh Data</option>
                                </select>
                                @error('project_name')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div>
                            <div class="form-group" id="otherFieldReportDate">
                                <label for="otherFieldReportDate" class="col-form-label">Tentukan Tanggal Awal Periode</label>
                                <input class="form-control" type="date" name="startDate" value="{{date('Y-m-d',strtotime(Carbon::now()))}}">
                                <label for="otherFieldReportDate" class="col-form-label">Tentukan Tanggal Akhir Periode</label>
                                <input class="form-control" type="date" name="endDate" value="{{date('Y-m-d',strtotime(Carbon::now()))}}">
                                {{-- <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                    <i class="fa fa-calendar"></i>&nbsp;
                                    <span></span> <i class="fa fa-caret-down"></i>
                                </div> --}}
                            </div>
                            <div class="form-group" id="otherFieldReportProj">
                                <label for="otherFieldReportProj" class="col-form-label">Pilih Proyek</label>
                                <select name="dataProyek" id="dataProyek" class="form-select">
                                    <option value="" selected hidden>Pilih Data Proyek</option>
                                    @foreach ($proyek as $data)
                                        <option value="{{ $data->id }}">{{ $data->project_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="saveBtn" class="btn btn-primary"><i
                                class="fas fa-file-alt mr-2"></i>Generate
                            PDF</a></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $("#myTable").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#myTable').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
<script type="text/javascript">
    $(function() {
        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            $('input[name="startDate"]').val(start.format('MM/DD/YYYY'));
            $('input[name="endDate"]').val(end.format('MM/DD/YYYY'));
        }
        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end);
        
        
    });
</script>
@endsection
