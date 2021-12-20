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
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool pt-3" data-card-widget="collapse"
                                    title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-responsive-sm table-bordered" id="myTable" width="100%">
                                <thead>
                                    <tr>
                                        <th class="col-1">No</th>
                                        <th class="col-3">Status</th>
                                        <th class="col-3">Date</th>
                                        <th class="col-3">Project Name</th>
                                        <th class="col-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td>1</td>
                                    <td>Selesai</td>
                                    <td>18 Des 2021</td>
                                    <td>Advanced Package Tool</td>
                                    <td></td>
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
                    <h4 class="card-title">Send New Report</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="card-body">
                    <form autocomplete="off" action="#" method="post"
                        enctype="multipart/form-data">

                        <div class="content">

                            <div class="form-group">
                                <label>Kode Proyek</label>
                                <select name="instance_model" id="instance_model" class="form-control" required>
                                    <option value="1">APT</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <select name="instance_model" id="instance_model" class="form-control" required>
                                    <option value="1">Selesai</option>
                                    <option value="1">Tertunda</option>
                                    <option value="1">Bermasalah</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="seeAnotherFieldClient">Detail Laporan</label>
                                <textarea name="instance_address" id="instance_address" class="form-control" cols="30" rows="3" placeholder="Isikan Detail Disini"></textarea>
                            </div>

                            <br>

                            <div class="form-group">
                                <button class="btn btn-success float-right">Save
                                    Data</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <!--Nothing Goes Here but is needed! -->
                </div>
            </div>
        </div>
    </div>
@endsection
