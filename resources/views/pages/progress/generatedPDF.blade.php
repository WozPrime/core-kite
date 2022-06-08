<!DOCTYPE html>
<html>
@php
use Illuminate\Support\Carbon;
@endphp
<style>
    table,
    td,
    th {
        border: 1px solid #595959;
        border-collapse: collapse;
        width: 100%;
    }

    td,
    th {
        width: 30px;
        height: 25px;
    }

    h4,
    p {
        text-align: center;
    }

    th {
        background: #f0e6cc;
    }

    .even {
        background: #fbf8f0;
    }

    .odd {
        background: #fefcf9;
    }

    .wrapper {
        margin-right: auto;
        margin-left: auto;

        padding-right: 100px;
        padding-left: 100px;
    }
    .center {
                text-align: center;
            }
            .center img {
                display: block;
                margin-left: auto;
                margin-right: auto;
            }

</style>

<body>

</body>
<header>

    <table>
        <tbody>
            <tr>
                <td rowspan="3" style="max-width: 30px; max-height: 70px;">
                    <div class="center">
                        <img
                        src="{{ public_path('dist/img/idekitelogo.png') }}" alt="Idekite Logo" style="opacity: .8; border-radius:50%; max-width: 50px; max-height: 50px;">
                        </div>
                    <p>IDEKITE<br>INDONESIA</p>
                </td>
                <td>
                    <h3 style="text-align: center;">LAPORAN HASIL PEKERJAAN
                        <br><i style="font-weight: 100">JOB RESULT REPORT</i>
                    </h3>
                </td>
                <td>
                    <p style="text-align: left">Ref No.</p>
                    <p style="text-align: right">JR-IDEKITE-</p>
                </td>
            </tr>
            <tr>
                <td rowspan="2" style="width:100px">
                    <h3>
                        @if ($report_opt == "Proyek")
                            <p>LAPORAN PROYEK :<br>
                                <h2 style="text-align: center">{{$project_task->where('project_id',$input)->first()->project()->first()->project_name}}</h2 style="text-align: center">
                            </p>
                        @elseif ($report_opt == "Karyawan")
                            <p>LAPORAN KARYAWAN :<br>
                                <h2 style="text-align: center">{{$project_task->where('user_id',$input)->first()->users()->first()->name}}</h2 style="text-align: center">
                            </p>
                        @elseif ($report_opt == "Tanggal")
                            <p>LAPORAN PER :<br>
                                <h2 style="text-align: center">{{date('d/m/Y',strtotime($input[0]))}} - {{date('d/m/Y',strtotime($input[1]))}}</h2 style="text-align: center">
                            </p>
                        @elseif ($report_opt == "Profesi")
                            <p>LAPORAN PEKERJAAN :<br>
                                <h2 style="text-align: center">{{$prof_name}}</h2 style="text-align: center">
                            </p>
                        @elseif ($report_opt == "All")
                            <p>LAPORAN :<br>
                                <h2 style="text-align: center">KESELURUHAN PROYEK DAN TUGAS</h2 style="text-align: center">
                            </p>
                        @endif
                    </h3>
                </td>
                <td>Tanggal Terbit : <br><p style="float: right;"> {{ date('D, d M Y', strtotime(Carbon::now())) }}</p>
                </td>
            </tr>
            <tr>
                <td>Halaman :
                    <p></p>
                </td>
            </tr>
        </tbody>
    </table>

</header>
<br>
<table>
    <tbody>
        <tr>
            <td style="text-align:center;background-color:#d7d7d7;font-family:arial;"><b>URAIAN PEKERJAAN</b></td>
        </tr>
    </tbody>
</table>
<br>
@if ($report_opt == "Proyek")
<table>
    <tbody>
        <tr>
            <td style="width:15%">Penanggung Jawab Proyek: </td>
            <td></td>
        </tr>
    </tbody>
</table>
<br>
<table>
    <tbody>
        <tr>
            <td style="text-align: center">Anggota Kelompok: </td>
        </tr>
        @foreach ( $project_task->where('project_id',$input) as $listKaryawan)
        <tr>
            <td colspan="2">  {{$listKaryawan->users()->first()->name}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<br>
<table>
    <tbody>
        <tr>
            <td style="width:15%">Deskripsi Proyek</td>
            <td>{{$project_task->where('project_id',$input)->first()->project()->first()->project_detail}}</td>
        </tr>
    </tbody>
</table>
<br>
@endif
<br>
<table>
    <thead>
        <tr style="text-align: center">
            <td style="width: 5%; font-weight: 1000" >No</td>
            @if ($report_opt <> "Karyawan")
                <td style="font-weight: 1000">Penanggung Jawab</td>
            @endif
            <td style="font-weight: 1000">Tugas</td>
            @if ($report_opt <> "Profesi")
                <td style="font-weight: 1000">Kategori</td>
            @endif
            <td style="font-weight: 1000">Lama Pengerjaan</td>
            @if ($report_opt <> "Proyek")
                <td style="font-weight: 1000">Nama Proyek</td>
            @endif
            <td style="font-weight: 1000">Poin</td>
        </tr>
    </thead>
    <tbody>
        @php
            $totalPts = null;
            $totalExp = null;
        @endphp
        @foreach ($project_task->where('status',2) as $p_task)
            <tr>
                <td rowspan="2" style="text-align: center">{{$loop->iteration}}</td>
                @if ($report_opt <> "Karyawan")
                    <td rowspan="2">{{$p_task->users()->first()->name}}</td>
                @endif
                <td>{{$p_task->details}}</td>
                @if ($report_opt <> "Profesi")
                    <td>{{ $p_task->tasks()->first()->task_name }}</td>
                @endif
                <td>{{ date('D, d M Y H:i', strtotime($p_task->created_at)) }} - {{ date('D, d M Y H:i', strtotime($p_task->post_date)) }}</td>
                @if ($report_opt <> "Proyek")
                    <td>{{ $p_task->project()->first()->project_name }}</td>
                @endif
                <td style="text-align: center">{{$p_task->points}}/{{$p_task->tasks()->first()->points}}</td>
            </tr>
            <tr>
                <td colspan="7">
                Feedback : <br>{{$p_task->feedback}}
                </td>
            </tr>
            @php
                $totalPts += $p_task->points;
                $totalExp += $p_task->tasks()->first()->points;
            @endphp
        @endforeach
        <tr>
            <td colspan="@if ($report_opt == "All" || $report_opt == "Tanggal")
                6
            @else
                5
            @endif">
                Total Points / Total Expected Points =
            </td>
            <td style="text-align: center">
                {{$totalPts}}/{{$totalExp}}
            </td>
        </tr>
    </tbody>
</table>

{{-- <head>
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head> --}}

{{-- <head>
    <title>PDF Create</title>
    <style type="text/css">
        th,
        td {
            border: solid 1px #777;
            padding: 2px;
            margin: 2px;
        }

    </style>
</head>
<body>
    <table class="table table-responsive-sm table-bordered" id="myTable" width="100%">
        <thead>
            <tr>
                <th style="width: 10px">No</th>
                <th class="col-3">Submitter</th>
                <th class="col-2">Status</th>
                <th class="col-3">Date</th>
                <th class="col-2">Job</th>
                <th class="col-2">Project Name</th>
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
                </tr>
            @endforeach
        </tbody>
    </table>
</body> --}}

</html>
