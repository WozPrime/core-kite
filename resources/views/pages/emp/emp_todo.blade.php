@php
    use Carbon\Carbon;
@endphp
@extends('pages.emp.ui_emp.empmaster')
@section('title')
    Laporan Karyawan
@endsection
@section('emphead')
@endsection
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>To Do List</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/emp">Home</a></li>
                    <li class="breadcrumb-item active">To Do List</li>
                </ol>
            </div>
        </div>
        @error('upload_details')
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Peringatan!</strong> Data Masih Kosong.
            </div>
        @enderror
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header ui-sortable-handle">
                        <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            Yang Harus Diselesaikan
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <ul class="todo-list ui-sortable" data-widget="todo-list" style="max-height: 220px">
                            <input type="hidden" id="idJobs"
                                value="{{ json_encode($project_task->pluck('id')->toArray()) }}">
                            @php
                                $nearestDeadline = new stdClass();
                                $nearestDeadline->time = null;
                                $diffMinutes = null;
                            @endphp
                            @foreach ($project_task as $job)
                                @php
                                    $subsDate = floor((strtotime($job->expired_at) - strtotime(Carbon::now())) / 86400);
                                    if ($subsDate > 0) {
                                        $diffMinutes = Carbon::parse($job->expired_at)->diffInRealMinutes();
                                        $deadlineMinutes = Carbon::parse($nearestDeadline->time)->diffInRealMinutes();
                                        if (!$job->post_date) {
                                            if ($nearestDeadline->time == null || $deadlineMinutes > $diffMinutes) {
                                                $nearestDeadline->time = date('F d, Y H:i:s', strtotime($job->expired_at));
                                                $nearestDeadline->task = $tasks
                                                    ->where('id', $job->task_id)
                                                    ->pluck('task_name')
                                                    ->implode(' ');
                                            }
                                        }
                                    }
                                    
                                @endphp
                                <li>
                                    <div class="icheck-primary d-inline ml-2">
                                        <input type="checkbox" value="" disabled name="todo{{ $job->id }}"
                                            id="todoCheck{{ $job->id }}"
                                            @if ($job->upload_details && $file_task->where('pt_id', $job->id)->count() > 0) checked @endif>
                                        <label for="todoCheck{{ $job->id }}"></label>
                                    </div>
                                    <span
                                        class="text">{{ $tasks->where('id', $job->task_id)->pluck('task_name')->implode(' ') }}</span>
                                    <small
                                        class="badge 
                                    @if ($subsDate > 0) @if ($diffMinutes > 7 * 1440)
                                        badge-success
                                        @elseif ($diffMinutes <= 7 * 1440 && $diffMinutes > 4 * 1440)
                                        badge-primary
                                        @elseif ($diffMinutes <= 4 * 1440 && $diffMinutes > 1 * 1440)
                                        badge-warning @endif
                                        @else
                                        badge-danger
                                    @endif
                                      "
                                        id='deadline'><i class="far fa-clock"></i>
                                        @if ($subsDate > 0)
                                            @if ($diffMinutes > 1440)
                                                {{ floor($diffMinutes / 1440) }} Hari
                                            @else
                                                {{ floor($diffMinutes / 60) }} Jam
                                            @endif
                                        @else
                                            Terlewati
                                        @endif
                                    </small>
                                    <div style="float: right; margin-left: 15px">
                                        <a data-toggle="modal" data-target="#assignment{{ $job->id }}">
                                            <i class="fas fa-paper-plane" style="color: var(--primary)"></i></a>
                                    </div>
                                    <div style="float: right">
                                        <a data-toggle="modal" data-target="#edit_file{{ $job->id }}">
                                            <i class="fas fa-edit" style="color: var(--gray)"></i></a>
                                    </div>

                                </li>
                                <meta name="token" content="{{ csrf_token() }}">
                                <input type="hidden" id="routeSend{{ $job->id }}"
                                    value="{{ route('emp_add_docs', $job->id) }}">
                                <div class="modal fade" id="assignment{{ $job->id }}">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">
                                                    {{ $tasks->where('id', $job->task_id)->pluck('task_name')->implode(' ') }}
                                                </h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div id="action{{ $job->id }}" class="row">
                                                            <div class="col-lg-6">
                                                                <div class="btn-group w-100">
                                                                    <span
                                                                        class="btn btn-success col fileinput-button{{ $job->id }}">
                                                                        <i class="fas fa-plus"></i>
                                                                        <span>Tambah Berkas</span>
                                                                    </span>
                                                                    <button type="submit" class="btn btn-primary col start">
                                                                        <i class="fas fa-upload"></i>
                                                                        <span>Mulai Unggah</span>
                                                                    </button>
                                                                    <button type="reset" class="btn btn-warning col cancel">
                                                                        <i class="fas fa-times-circle"></i>
                                                                        <span>Batal Unggah</span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 d-flex align-items-center">
                                                                <div class="fileupload-process w-100">
                                                                    <div id="total-progress{{ $job->id }}"
                                                                        class="progress progress-striped active"
                                                                        role="progressbar" aria-valuemin="0"
                                                                        aria-valuemax="100" aria-valuenow="0">
                                                                        <div class="progress-bar progress-bar-success"
                                                                            style="width:0%;" data-dz-uploadprogress></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="table table-striped files"
                                                            id="preview{{ $job->id }}">
                                                            <div id="template{{ $job->id }}" class="row mt-2">
                                                                <div class="col-auto">
                                                                    <span class="preview"><img src="data:," alt=""
                                                                            data-dz-thumbnail /></span>
                                                                </div>
                                                                <div class="col d-flex align-items-center">
                                                                    <p class="mb-0">
                                                                        <span class="lead" data-dz-name></span>
                                                                        (<span data-dz-size></span>)
                                                                    </p>
                                                                    <strong class="error text-danger"
                                                                        data-dz-errormessage></strong>
                                                                </div>
                                                                <div class="col-4 d-flex align-items-center">
                                                                    <div class="progress progress-striped active w-100"
                                                                        role="progressbar" aria-valuemin="0"
                                                                        aria-valuemax="100" aria-valuenow="0">
                                                                        <div class="progress-bar progress-bar-success"
                                                                            style="width:0%;" data-dz-uploadprogress></div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-auto d-flex align-items-center">
                                                                    <div class="btn-group">
                                                                        <button class="btn btn-primary start">
                                                                            <i class="fas fa-upload"></i>
                                                                            <span>Mulai</span>
                                                                        </button>
                                                                        <button data-dz-remove
                                                                            class="btn btn-warning cancel">
                                                                            <i class="fas fa-times-circle"></i>
                                                                            <span>Batal</span>
                                                                        </button>
                                                                        <button data-dz-remove
                                                                            class="btn btn-danger delete">
                                                                            <i class="fas fa-trash"></i>
                                                                            <span>Hapus</span>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <form action="{{ route('emp_up_details', $job->id) }}" method="POST"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label>Detail Pengumpulan</label>
                                                                <textarea class="form-control" id="upload_details"
                                                                    name="upload_details" rows="3"
                                                                    placeholder="Enter Task Details ..."></textarea>
                                                                <div class="text-danger">
                                                                    @error('upload_details')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-4 float-right">
                                                                <button type="submit"
                                                                    class="btn btn-primary btn-block">Selesai</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="edit_file{{ $job->id }}">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit
                                                    "{{ $tasks->where('id', $job->task_id)->pluck('task_name')->implode(' ') }}"
                                                </h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <table class="table table-responsive-sm table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Nama Berkas</th>
                                                                    <th>Aksi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($file_task->where('pt_id',$job->id) as $file)
                                                                <tr>
                                                                    <th>{{$loop->iteration}}</th>
                                                                    <th style="font-weight: 400">{{Illuminate\Support\Str::limit($file->file_name, 80) }}</th>
                                                                    <th style="text-align: center">
                                                                        <a class="btn btn-danger" data-toggle="modal"
                                                                            data-target="#delete{{$loop->index}}"><i
                                                                                class="fa fa-trash"></i></a>
                                                                    </th>
                                                                </tr>
                                                                <div class="modal fade" id="delete{{$loop->index}}">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content bg-danger">
                                                                            <form action="{{ route('emp_delete_file') }}" method="POST"
                                                                                enctype="multipart/form-data">
                                                                                @csrf
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title">Hapus Berkas {{$loop->index + 1}}</h4>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                Apakah anda yakin ingin Menghapus Berkas ini?
                                                                            </div>
                                                                            <input type="hidden" name="file_name" value="{{ strval($file->file_name) }}">
                                                                            <div class="modal-footer justify-content-between">
                                                                                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                                                                <button class="btn btn-outline-light">Hapus
                                                                                    Berkas</button>
                                                                            </div>
                                                                            </form>
                                                                            <!-- /.modal-content -->
                                                                        </div>
                                                                        <!-- /.modal-dialog -->
                                                                    </div>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <form action="{{ route('emp_up_details', $job->id) }}" method="POST"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label>Edit Detail Pengumpulan</label>
                                                                <textarea class="form-control" id="upload_details"
                                                                    name="upload_details" rows="3"
                                                                    placeholder="Enter Task Details ...">{{ $job->upload_details }}</textarea>
                                                                <div class="text-danger">
                                                                    @error('upload_details')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-4 float-right">
                                                                <button type="submit"
                                                                    class="btn btn-primary btn-block">Selesai</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-4" style="text-align: center">
                <div class="info-box bg-white mb-4" style="height: 130px;">
                    <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">
                            @isset($nearestDeadline->task)
                                {{ $nearestDeadline->task }}
                            @endisset
                        </span>
                        <h4 id="demo" class="bg-primary" style="text-align: center; border-radius: 5px;"></h4>
                        <input type="hidden" id="nearded" name="nearded" value="{{ json_encode($nearestDeadline) }}">
                        <div class="progress">
                            <div class="progress-bar bg-dark" style="width: 70%"></div>
                        </div>
                        <span class="progress-description">
                            Tugas dengan Tenggat Waktu Terdekat
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
                <div class="info-box bg-gradient-info" style="text-align: left; height: 130px;">
                    <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Tugas yang Terselesaikan Bulan Ini</span>
                            <span class="info-box-number">{{$check}}</span>
                            <span class="progress-description">
                                Work Hard Play Hard!
                            </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title pt-1">Daftar Laporan Tugas</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool pt-3" data-card-widget="collapse"
                                title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-sm table-bordered" id="myTable" width="100%">
                            <thead>
                                <tr>
                                    <th style="width: 10px">No</th>
                                    <th class="col-3">Tugas</th>
                                    <th class="col-2">Status</th>
                                    <th class="col-3">Tanggal Diperiksa</th>
                                    <th class="col-2">Nama Proyek</th>
                                    <th class="col-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($task_list as $tl)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$tl->details}}</td>
                                    <td>
                                        <small
                                                class="badge 
                                                @if ($tl->status == 2)
                                                badge-success
                                                @elseif ($tl->status == 3)
                                                badge-danger 
                                                @else
                                                badge-warning @endif
                                                "
                                                id='deadline'>
                                                @if ($tl->status == 2)
                                                    Telah Diperiksa
                                                @elseif ($tl->status == 3)
                                                    Belum Memenuhi Persyaratan
                                                @endif
                                            </small>
                                    </td>
                                    <td>
                                        {{ date('D, d M Y H:i', strtotime($tl->checked_at)) }}
                                    </td>
                                    <td>
                                        {{ $tl->project()->first()->project_name }}
                                    </td>
                                    <td>
                                        <a class="btn btn-primary mr-1 mb-1" data-toggle="modal"
                                                href="#detail{{ $tl->id }}"><i class="fa fa-eye"></i></a>
                                    </td>
                                </tr>
                                <div class="modal fade" id="detail{{ $tl->id }}">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Detail Tugas</h4>
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
                                                                {{-- @if ($tl->project()->first()->project_logo == '')
                                                                    <img src="{{ url('pp/default.jpg') }}"
                                                                        class="profile-user-img img-fluid img-circle">
                                                                @else
                                                                    <img src="{{ url('pp/' . $tl->project()->first()->project_name) }}"
                                                                        class="profile-user-img img-fluid img-circle">
                                                                @endif --}}
                                                            </div>

                                                            <h3 class="profile-username text-center">
                                                                {{ $tl->project()->first()->project_name }}
                                                            </h3>

                                                            <p class="text-muted text-center">
                                                                {{-- {{ $tl->instance()->first()->nama_instansi }} --}}
                                                            </p>

                                                            <ul class="list-group list-group-unbordered mb-3">
                                                                <li class="list-group-item">
                                                                    <b>Tugas</b> <a
                                                                        class="float-right text-dark">
                                                                        {{ $tl->details }}
                                                                    </a>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <b>PJ</b> <a class="float-right text-dark">
                                                                        {{ $tl->users()->first()->name }}
                                                                    </a>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <b>Kategori</b> <a
                                                                        class="float-right text-dark">
                                                                        {{ $tl->tasks()->first()->task_name }}
                                                                    </a>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <b>Tanggal Diunggah</b> <a
                                                                        class="float-right 
                                                                        @if ($tl->post_date) text-dark
                                                                        @else
                                                                            text-red @endif
                                                                        ">
                                                                        @if ($tl->post_date)
                                                                            {{ date('D, d M Y H:i', strtotime($tl->post_date)) }}
                                                                        @else
                                                                            Belum Diunggah
                                                                        @endif
                                                                    </a>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <b>Tenggat Waktu</b> <a
                                                                        class="float-right 
                                                                        @if ($tl->post_date) text-success
                                                                        @else
                                                                            text-red @endif
                                                                        ">
                                                                        {{ date('D, d M Y H:i', strtotime($tl->expired_at)) }}
                                                                    </a>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <b>Jarak Tenggat Waktu</b>
                                                                    <a
                                                                        class="float-right
                                                                    @if ($tl->post_date) text-dark
                                                                        @else
                                                                            text-red @endif
                                                                        ">
                                                                        @if ($tl->post_date)
                                                                            @php
                                                                                $diff = strtotime($tl->expired_at) - strtotime($tl->post_date);
                                                                                $days = ($diff / 86400);
                                                                            @endphp
                                                                            @if ($days >= 1)
                                                                                {{ floor($days) }} Hari
                                                                            @else
                                                                                @if ($days > 0 && $days < 1)
                                                                                    @php
                                                                                        $jam = floor($diff / 3600);
                                                                                        $menit = floor($diff / 60);
                                                                                    @endphp
                                                                                    @if ($jam > 0)
                                                                                        {{$jam}} Jam
                                                                                    @else
                                                                                        {{$menit}} Menit
                                                                                    @endif
                                                                                @else
                                                                                    Tenggat Waktu Terlewati
                                                                                @endif
                                                                            @endif
                                                                        @else
                                                                            Belum Diunggah
                                                                        @endif
                                                                    </a>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <b>Detail Unggahan</b> <a
                                                                        class="float-right 
                                                                        @if ($tl->upload_details) text-dark
                                                                        @else
                                                                            text-red @endif
                                                                        ">
                                                                        @if ($tl->upload_details)
                                                                            {{ $tl->upload_details }}
                                                                        @else
                                                                            Belum Diunggah
                                                                        @endif
                                                                    </a>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <b>Nilai</b> <a class="@if ($tl->points/$tl->tasks()->first()->points > 0.7)
                                                                        text-success
                                                                    @else
                                                                        text-orange
                                                                    @endif float-right" style="font-weight: bold">
                                                                        {{ $tl->points}}/{{$tl->tasks()->first()->points}}
                                                                    </a>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <b>Masukan (Feedback):</b> 
                                                                    <br>
                                                                    <a class="text-dark" style="display:block;text-overflow: ellipsis;width: 700px;overflow: hidden; white-space: nowrap;text-align: right">
                                                                        {{ $tl->feedback }}
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <!-- /.card-body -->
                                                    </div>


                                                    <div class="card card-secondary">
                                                        <div class="card-header">
                                                            <h3 class="card-title">Unduh Berkas</h3>
                                                        </div>
                                                        <!-- /.card-header -->
                                                        <div class="card-body">
                                                            @if ($file_task->where('pt_id', $tl->id)->count() == 0)
                                                                <strong class="text-red">Belum Ada Berkas yang diunggah</strong>
                                                            @else
                                                                @foreach ($file_task->where('pt_id', $tl->id) as $file)
                                                                    <strong>{{ $file->file_name }}</strong>
                                                                    <a class="btn btn-primary mr-1 float-right"
                                                                        href="/admin/file/download/{{ $file->file_name }}"><i
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
                                                    data-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>


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
    <script>
        // DropzoneJS Demo Code Start
        Dropzone.autoDiscover = false;

        var idJobs = JSON.parse(document.getElementById('idJobs').value)
        // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
        idJobs.forEach(idJob => {
            var previewNode = document.querySelector("#template" + idJob)
            previewNode.id = ""
            var previewTemplate = previewNode.parentNode.innerHTML
            previewNode.parentNode.removeChild(previewNode)

            var routeName = (document.getElementById('routeSend' + idJob).value)
            var parentDropzone = document.getElementById('assignment' + idJob);
            var myDropzone = new Dropzone(parentDropzone, { // Make the whole body a dropzone
                url: routeName, // Set the url
                thumbnailWidth: 80,
                thumbnailHeight: 80,
                parallelUploads: 20,
                previewTemplate: previewTemplate,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
                },
                autoQueue: false, // Make sure the files aren't queued until manually added
                previewsContainer: "#preview" + idJob, // Define the container to display the previews
                clickable: ".fileinput-button" +
                    idJob // Define the element that should be used as click trigger to select files.

            })

            myDropzone.on("addedfile", function(file) {
                // Hookup the start button
                file.previewElement.querySelector(".start").onclick = function() {
                    myDropzone.enqueueFile(file)
                }
            })

            // Update the total progress bar
            myDropzone.on("totaluploadprogress", function(progress) {
                document.querySelector("#total-progress" + idJob + " .progress-bar").style.width =
                    progress + "%"
            })

            myDropzone.on("sending", function(file) {
                // Show the total progress bar when upload starts
                document.querySelector("#total-progress" + idJob).style.opacity = "1"
                // And disable the start button
                file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
            })

            // Hide the total progress bar when nothing's uploading anymore
            myDropzone.on("queuecomplete", function(progress) {
                document.querySelector("#total-progress" + idJob).style.opacity = "0"
                Swal.fire(
                    'Berhasil!',
                    'Data berhasil diupload!',
                    'success'
                ).then((result) => {
                    // location.reload();
                })
            })

            // Setup the buttons for all transfers
            // The "add files" button doesn't need to be setup because the config
            // `clickable` has already been specified.
            document.querySelector("#action" + idJob + " .start").onclick = function() {
                myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
            }
            document.querySelector("#action" + idJob + " .cancel").onclick = function() {
                myDropzone.removeAllFiles(true)
            }
            // DropzoneJS Demo Code End
        });

        // Set the date we're counting down to
        var nearded = JSON.parse(document.getElementById("nearded").value);
        var countDownDate = new Date(nearded.time).getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            document.getElementById("demo").innerHTML = days + "d " + hours + "h " +
                minutes + "m " + seconds + "s ";

            // If the count down is over, write some text 
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = " - ";
            }
        }, 1000);
    </script>
@endsection