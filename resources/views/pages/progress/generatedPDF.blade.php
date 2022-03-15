<!DOCTYPE html>
<html>

<style>
table , td, th {
	border: 1px solid #595959;
	border-collapse: collapse;
    width: 100%;
}
td, th {
	padding: 3px;
	width: 30px;
	height: 25px;
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
  margin-left:  auto; 

  padding-right: 100px; 
  padding-left:  100px; 
}
</style>
<body>
    
</body>
<header>
    <div class="wrapper">
        <table>
            <tbody>
                <tr>
                    <td rowspan="3"></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td rowspan="2" style="width:100px"></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</header>
<br>
<div class="wrapper">
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
            <td></td>
            <td style="width:137px"></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
    </tbody>
    </table>
    <br>
    <table>
        <tbody>
            <tr>
                <td></td>
                <td style="width:137px"></td>
            </tr>
        </tbody>
    </table>
</div>

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
