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

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-9 center">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title pt-1">List of Reports</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool pt-3" data-card-widget="collapse" title="Collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-responsive-sm table-bordered" id="myTable" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No</th>
                                        <th class="col-2">Status</th>
                                        <th class="col-3">Date</th>
                                        <th class="col-2">Job</th>
                                        <th class="col-2">Project Name</th>
                                        <th class="col-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $tbl_report)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td></td>
                                            <td>{{ $tbl_report->report_status }}</td>
                                            <td>{{ $tbl_report->report_date }}</td>
                                            <td></td>
                                            <td>{{ $tbl_report->project_name }}</td>
                                            <td style="text-align: center">
                                                <a class="btn btn-primary"
                                                    href="/admin/proyek/{{ $tbl_project->report_id }}"><i
                                                        class="fa fa-eye"></i></a>
                                                <a class="btn btn-success" data-toggle="modal"
                                                    href="#edit{{ $tbl_project->report_id }}"><i
                                                        class="fa fa-edit"></i></a>
                                                <a class="btn btn-danger" data-toggle="modal"
                                                    href="#delete{{ $tbl_project->report_id }}"><i
                                                        class="fa fa-trash"></i></a>
                                            </td>
                                            <!-- /.modal -->
                                            <div class="modal fade" id="edit{{ $tbl_project->report_id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="card-header bg-orange">
                                                            <h3 class="card-title">Add New Project Data</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <form action="/admin/projects/" method="post"
                                                                enctype="multipart/form-data">
                                                                @csrf

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
    <button class="material-icons floating-btn" data-toggle="modal" data-target="#add-data">add</button>
    <div class="modal fade" id="add-data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">

            <div class="modal-content card-primary">
                <div class="card-header">
                    <h4 class="card-title">Modal title</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>

                <div class="card-body">

                </div>

                <div class="modal-footer">
                    <!--Nothing Goes Here but is needed! -->
                </div>
            </div>
        </div>
    </div>
@endsection
<button class="material-icons floating-btn" data-toggle="modal" data-target="#add-report">add</button>
