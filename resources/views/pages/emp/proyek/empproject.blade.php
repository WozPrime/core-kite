@extends('pages.emp.ui_emp.empmaster')
@section('title')
    Laporan Karyawan
@endsection
@section('emphead')
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>My Projects</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                        <li class="breadcrumb-item ">To Do List</li>
                        <li class="breadcrumb-item active">Projects</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                @if ($data->count() > 0)
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title pt-1">List of Projects</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool pt-3" data-card-widget="collapse"
                                    title="Collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-responsive-sm table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th style="text-align: center" width="2%">No</th>
                                        <th class="col-4">Project Name</th>
                                        <th class="col-1">Project Code</th>
                                        <th class="col-1">Status</th>
                                        <th class="col-1">Kategori</th>
                                        <th class="col-2">Progress</th>
                                        <th width="10%" style="text-align: center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $tbl_project)
                                        <tr>
                                            <td style="text-align: center">{{ $loop->iteration }}</td>
                                            <td>{{ $tbl_project->project_name }}</td>
                                            <td>{{ $tbl_project->project_code }}</td>
                                            <td style="text-align: center">
                                                <span class="badge @if ($tbl_project->project_status == 'Baru') bg-primary
                                                    @elseif ($tbl_project->project_status == 'Tertunda') bg-danger
                                                    @elseif ($tbl_project->project_status == 'Sedang Berjalan') bg-warning
                                                    @elseif ($tbl_project->project_status == 'Selesai') bg-success @endif">
                                                    {{ $tbl_project->project_status }}
                                                </span>
                                            </td>
                                            <td>{{ $tbl_project->project_category }}</td>
                                            <td style="text-align: center">
                                                {{-- <div class="row"> --}}
                                                    <div 
                                                    @php
                                                    $pcount = $ptask->where('project_id', $tbl_project->id)->count('id');
                                                    $pstatus = $ptask->where('project_id', $tbl_project->id)->where('status', '==', 2)->count('id');
                                                    if($pcount == 0) {$progress = 0;}
                                                    elseif($pcount > 0) {$progress = floor(($pstatus / $pcount) * 100);}
                                                    @endphp 
                                                    @if($pcount == 0) class="badge bg-danger" 
                                                    @elseif ($pcount > 0 && $progress < 100)  class="progress progress-xs pb-3" 
                                                    @elseif($pcount > 0 && $progress == 100) class="badge bg-success" 
                                                    @endif>
                                                    <div @if($pcount > 0 && $progress >= 0 && $progress < 25) class="progress-bar bg-danger pb-3"
                                                        @elseif($pcount > 0 && $progress >= 25 && $progress < 50) class="progress-bar bg-warning pb-3"
                                                        @elseif($pcount > 0 && $progress >= 50 && $progress < 75) class="progress-bar bg-primary pb-3"
                                                        @elseif($pcount > 0 && $progress >= 75 && $progress < 100) class="progress-bar bg-bar-success pb-3"
                                                        @endif
                                                        @if($pcount > 0 && $progress <= 25) style="background-color:red !important;width:{{ $progress }}%;"
                                                        @elseif($pcount > 0 && $progress >= 25 && $progress < 100) style="width:{{ $progress }}%"
                                                        @endif>
                                                        @if($pcount == 0) Belum ada tugas yang disiapkan
                                                        @elseif($pcount > 0 && $progress == 100) Seluruh tugas proyek sudah terselesaikan
                                                        @endif
                                                    </div>
                                                </div>

                                                @if($pcount > 0 && $progress >= 0 && $progress < 100) <span class="badge 
                                                    @if($pcount > 0 && $progress >= 0 && $progress < 25) bg-danger float-left
                                                    @elseif($pcount > 0 && $progress >= 25 && $progress < 50) bg-warning 
                                                    @elseif($pcount > 0 && $progress >= 50 && $progress < 75) bg-primary 
                                                    @elseif($pcount > 0 && $progress >= 75 && $progress < 100) bg-success float-right
                                                    @endif col-2" 
                                                    @if($pcount > 0 && $progress >= 25 && $progress < 50) style="margin-right:130px"
                                                    @elseif($pcount > 0 && $progress > 50 && $progress <= 75) style="margin-left:130px"
                                                    @endif>{{ $progress }}%</span>
                                                @endif
                                                {{-- </div> --}}
                                            </td>
                                            <td style="text-align: center">
                                                <a class="btn btn-primary mr-1 mb-1" href="/emp/project/{{ $tbl_project->id }}"><i
                                                        class="fa fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <br>
                    <h2 style="text-align: center">NO PROJECT ADDED</h2>
                @endif
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
@section('empscript')
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
    {{-- <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script> --}}
@endsection
