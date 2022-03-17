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

</style>

<body>

</body>
<header>

    <table>
        <tbody>
            <tr>
                <td rowspan="3" style="max-width: 30px; max-height: 70px;"><img
                        src="{{ asset('dist/img/idekitelogo.png') }}" alt="Idekite Logo" style="opacity: .8; border-radius:50%; max-width: 50px; max-height: 50px;
                        margin-left: 60px; margin-right: 20px; margin-top: 20px;">
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
                        <p>LAPORAN PERBULAN PERPROYEK</p>
                    </h3>
                </td>
                <td>Tanggal Terbit : <p style="float: right;"> {{ date('D, d M Y', strtotime(Carbon::now())) }}</p>
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
<table>
    <tbody>
        <tr>
            <td>Penanggung Jawab Proyek: </td>
            <td style="width:137px"></td>
        </tr>
        <tr>
            <td>Anggota Kelompok: </td>
            <td></td>
        </tr>
    </tbody>
</table>
<br>
<table>
    <tbody>
        <tr>
            <td>Deskripsi Proyek</td>
            <td style="width:137px"></td>
        </tr>
    </tbody>
</table>
<br>
<br>
<table>
    <thead>
        <tr>
            <td style="width: 5%; font-weight: 1000" >No</td>
            <td style="font-weight: 1000">Penanggung Jawab</td>
            <td style="font-weight: 1000">Tugas</td>
            <td style="font-weight: 1000">Kategori</td>
            <td style="font-weight: 1000">Lama Pengerjaan</td>
            <td style="font-weight: 1000">Nama Proyek</td>
            <td style="font-weight: 1000">Poin</td>
        </tr>
    </thead>
    <tbody>

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
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
