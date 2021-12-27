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
                                                {{ date('D, d M Y, h:i', strtotime($ptask->expired_at)) }}
                                                @endif
                                            </td>
                                            <td style="text-align: center">
                                                <a class="btn btn-primary" data-toggle="modal"
                                                    data-target="#deadline{{ $ptask->id }}"><i
                                                        class="fa fa-calendar-minus"></i></a>
                                                <a class="btn btn-danger" data-toggle="modal"
                                                    data-target="#delete{{ $ptask->id }}"><i
                                                        class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <!-- /.modal -->
                                        {{-- <div class="modal fade" id="edit{{ $job->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Job Details</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="/admin/edit_task/{{ $job->id }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="Job_code">Job Code</label>
                                                                <input type="text" class="form-control" id="code"
                                                                    name="code" value="{{ $job->code }}">
                                                                <div class="text-danger">
                                                                    @error('code')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="Task">Task</label>
                                                                <input type="text" class="form-control" id="task_name"
                                                                    name="task_name" value="{{ $job->task_name }}">
                                                                <div class="text-danger">
                                                                    @error('task_name')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="Points">Points</label>
                                                                <input type="text" class="form-control" id="points"
                                                                    name="points" value="{{ $job->points }}">
                                                                <div class="text-danger">
                                                                    @error('points')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="Profession">Profession</label>
                                                                <select name="prof_id" id="prof_id" class="form-control">
                                                                    @if ($job->profs()->first())
                                                                            <option value="" @if ($job->profs()->first()->id == '')
                                                                                selected
                                                                        @endif disabled hidden>Pilih
                                                                        Profesi
                                                                        </option>
                                                                        @foreach ($prof_list as $prof)
                                                                            <option value="{{ $prof->id }}" @if ($job->profs()->first()->id == $prof->id) selected @endif>{{ $prof->prof_name }}
                                                                        </option>
                                                                        @endforeach
                                                                    @else
                                                                        <option value="" selected disabled hidden>Pilih Profesi</option>
                                                                        @foreach ($prof_list as $prof)
                                                                            <option value="{{ $prof->id }}">{{ $prof->prof_name }}</option>
                                                                        @endforeach
                                                                        @endif

                                                                        </select>
                                                                
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
                                            </div> --}}
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

@endsection
