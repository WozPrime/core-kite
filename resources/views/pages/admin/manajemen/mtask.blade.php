@extends('pages.ui_admin.admin')
@section('title')
    Manage Task List on Project
@endsection
@section('body')
@section('navbar')
@endsection
@section('sidebar')
@endsection
@section('content')
    @error('deadline')
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Peringatan!</strong>  Data Masih Kosong.
    </div>
    @enderror
    {{-- content --}}
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Task</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Task Manager</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    {{-- alert --}}



    {{-- content --}}
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-fuchsia">
                        <div class="card-header">
                            <h3 class="card-title pt-1">List of Tasks</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool mt-1" data-card-widget="collapse"
                                    title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-responsive-sm table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No</th>
                                        <th class="col-3">Task</th>
                                        <th class="col-2">User</th>
                                        <th class="col-3">Project</th>
                                        <th class="col-2">Deadline</th>
                                        <th class="col-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($projectTask->get() as $ptask)
                                        <tr>
                                            <td style="text-align: center">{{ $loop->iteration }}</td>
                                            <td>{{ $Task->find($ptask->task_id)->task_name }}</td>
                                            <td>{{ $User->find($ptask->user_id)->name }}</td>
                                            <td>{{ $Project->find($ptask->project_id)->project_name }}</td>
                                            <td>
                                                @if ($ptask->expired_at != '')
                                                {{ date('D, d M Y, H:i', strtotime($ptask->expired_at)) }}
                                                @endif
                                            </td>
                                            <td style="text-align: center">
                                                <a class="btn btn-success" data-toggle="modal"
                                                    data-target="#deadline{{ $ptask->id }}"><i
                                                        class="fa fa-calendar-minus"></i></a>
                                                <a class="btn btn-primary" data-toggle="modal"
                                                    data-target="#details{{ $ptask->id }}"><i
                                                        class="fa fa-info-circle"></i></a>
                                                <a class="btn btn-danger" data-toggle="modal"
                                                    data-target="#delete{{ $ptask->id }}"><i
                                                        class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <!-- /.modal -->
                                        <div class="modal fade" id="deadline{{ $ptask->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Add Deadline</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="/admin/project_all/{{ $ptask->id }}/edit" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="expired_at">Add Task Deadline</label>
                                                                <input name="expired_at" class="form-control" type="datetime-local" value="{{ (new DateTime($ptask->expired_at))->format('Y-m-d').'T'.(new DateTime($ptask->expired_at))->format('H:i')}}">
                                                              </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                        </form>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                                <!-- /.modal -->
                                            </div>
                                        <div class="modal fade" id="delete{{ $ptask->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content bg-danger">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Hapus Task</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah anda yakin ingin Menghapus data ini?
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-outline-light"
                                                            data-dismiss="modal">Close</button>
                                                        <a href="/admin/task/delete/{{ $ptask->id }}" type="button"
                                                            class="btn btn-outline-light">Hapus
                                                            Data</a>
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

@endsection
<!-- /.content -->
@section('footer')
@endsection
@section('script')
<script>
    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    console.log($('#reservationdatetime').find('input[name="expired_at"]').val());
    //Date and time picker
    $('#reservationdatetime').datetimepicker({
        icons: {
            time: 'far fa-clock',
        },
        defaultDate: $('#reservationdatetime').find('input[name="expired_at"]').val()
    });
</script>
@endsection
@endsection
