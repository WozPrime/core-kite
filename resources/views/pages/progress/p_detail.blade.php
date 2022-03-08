@php
use Carbon\Carbon;
@endphp
@extends('pages.ui_admin.admin')

@section('title')
    Profil Proyek
@endsection

@section('body')
@section('navbar')
@endsection

@section('sidebar')
@endsection

@section('content')
    <div class="container pt-3">
        <div class="main-body">
            @error('profs')
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Peringatan!</strong> Data Masih Kosong.
                </div>
            @enderror
            @error('task_id')
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Peringatan!</strong> Data Masih Kosong.
                </div>
            @enderror
            @error('details')
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Peringatan!</strong> Data Masih Kosong.
                </div>
            @enderror
            @error('expired_at')
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Peringatan!</strong> Data Masih Kosong.
                </div>
            @enderror
            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card" style="height: 375px">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                @if ($data->project_logo)
                                    <img src="/projectLogo/{{ $data->project_logo }}" alt="logo {{ $data->project_name }}"
                                        class="rounded-circle" width="150" height="150">
                                @else
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a2/Logo_of_Ministry_of_Communication_and_Information_Technology_of_the_Republic_of_Indonesia.svg/1024px-Logo_of_Ministry_of_Communication_and_Information_Technology_of_the_Republic_of_Indonesia.svg.png"
                                        alt="Logo Instansi" class="rounded-circle" width="150">
                                @endif
                                <div class="mt-3">
                                    <b class="text-secondary-bold"> {{ $data->project_name }} </b>
                                    <p class="text-muted font-size-sm"> [{{ $data->project_code }}] </p>
                                    <b class="text-secondary-bold"> Nilai Proyek </b>
                                    <p class="text-muted font-size-sm"> {{ $data->project_value }} </p>
                                    <b class="text-secondary-bold"> Jenis Proyek </b>
                                    <p class="text-muted font-size-sm"> {{ $data->project_category }} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mb-3" style="height: 375px">
                        <div class="card-body">
                            <b class="text-secondary-bold"> Detail Proyek </b>
                            <p class="text-muted font-size-sm"> {{ $data->project_detail }} </p>
                            <b class="text-secondary-bold"> Perkiraan Waktu Pengerjaan Proyek</b>
                            <p class="text-muted font-size-sm">
                                {{ date('D, d M Y', strtotime($data->project_start_date)) }}
                                <b>s/d</b> {{ date('D, d M Y', strtotime($data->project_deadline)) }}
                            </p>
                            <b class="text-secondary-bold"> Rentang Pengerjaan Waktu </b>
                            <p class="text-muted font-size-sm">
                                {{ Carbon::parse($data->project_deadline)->diffInDays($data->project_start_date) }} Hari
                            </p>
                            <b class="text-secondary-bold"> Klien </b>
                            <p class="text-muted font-size-sm"> {{ $data->client->name }} </p>
                            <b class="text-secondary-bold"> Instansi </b>
                            <p class="text-muted font-size-sm"> {{ $data->instance->nama_instansi }} </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gutters-sm">
                <div class="col-12">
                    <div class="card">
                        <div class="card-orange">
                            <div class="card-header">
                                <h3 class="card-title text-light">Anggota Proyek</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{ route('upload_emp') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-9">
                                            <div class="form-group no-border">
                                                <select name="user_id" id="user_id" class="form-control">
                                                    <option value="" selected disabled hidden>Pilih Karyawan
                                                    </option>
                                                    @php
                                                        $pusers = array();
                                                        foreach ($project_all->where('project_id',$data->id) as $p) {
                                                            $pusers[]=$p->user_id;
                                                        }
                                                        $part_user = $users->whereNotIn('id',$pusers);
                                                    @endphp
                                                    @if (count($part_user) == 0)
                                                        <option value="">Karyawan Tidak Tersedia
                                                        </option>
        
                                                    @endif
                                                    @foreach ($part_user as $karyawan)
                                                        <option value="{{ $karyawan->id }}">{{ $karyawan->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" name="project_id" id="project_id" value="{{ $data->id }}">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <button @if (count($part_user) == 0) disabled @endif type="submit"
                                                class="btn btn-block btn-info">Tambah</button>
                                        </div>
                                    </div>
        
                                </form>
                                <table class="table table-responsive-sm table-bordered" id="myTable">
                                    <thead>
                                        <tr>
                                            <th style="min-width: 20px; max-width: 20px;" class="text-center">No.</th>
                                            <th style="min-width: 100px; max-width: 100px;" class="text-center">Role</th>
                                            <th class="text-center">Nama</th>
                                            <th style="min-width: 40px; max-width: 40px;" class="text-center">Foto</th>
                                            <th style="min-width: 70px; max-width: 70px;" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($participant->where('project_id',$data->id)->get() as $list)
                                            @php
                                                $prof_part = [];
                                                $saved_task = [];
                                            @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="text-center">
                                                    <a href="#insert{{ $list->user_id }}" data-toggle="modal"
                                                        class="btn btn-block">
                                                        <div style="display: flex;
                                                                                    flex-direction:column;
                                                                                    justify-content:center;">
                                                            @foreach ($project_all as $prof_task)
                                                                @if ($prof_task->user_id == $list->user_id && $prof_task->prof_id != '')
                                                                    <div style="padding: 3px">
                                                                        <span
                                                                            class="badge @if (fmod($prof_task->prof_id, 3) == 0) bg-danger
                                                                                        @elseif(fmod($prof_task->prof_id, 2) == 0)
                                                                                        bg-warning 
                                                                                        @else
                                                                                        bg-success @endif">
                                                                            {{ $project_all->find($prof_task->id)->profUser()->first()->prof_name }}
                                                                            @php
                                                                                $prof_part[] = $prof_task->prof_id;
                                                                            @endphp
                                                                        </span>
                                                                    </div>
                                                                @else
                                                                    @continue
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </a>
                                                </td>
                                                <td>{{ $user_task->find($list->user_id)->name }}</td>
                                                <td class="text-center">
                                                    @if ($user_task->find($list->user_id)->pp == '')
                                                        <img src="{{ url('pp/default.jpg') }}" class="img-circle" width="70">
                                                    @else
                                                        <img src="{{ url('pp/' . $user_task->find($list->user_id)->pp) }}"
                                                            class="img-circle" width="70">
                                                    @endif
                                                </td>
                                                <td style="text-align: center">
        
                                                    <a class="btn btn-primary" data-toggle="modal"
                                                        href="#detail{{ $list->user_id }}"><i class="fa fa-eye"></i></a>
                                                    <a class="btn btn-success" data-toggle="modal"
                                                        href="#tambah{{ $list->user_id }}"><i class="fa fa-edit"></i></a>
                                                    <a class="btn btn-danger" data-toggle="modal"
                                                        href="#delete{{ $list->user_id }}"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="detail{{ $list->user_id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Detail Anggota</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                            <div class="modal-body">
                                                                <div class="card card-primary card-outline">
                                                                    <div class="card-body box-profile">
                                                                        <div class="text-center">
                                                                        @if ($user_task->find($list->user_id)->pp == '')
                                                                                <img src="{{ url('pp/default.jpg') }}"
                                                                                    class="profile-user-img img-fluid img-circle">
                                                                            @else
                                                                            <img src="{{ url('pp/' . $user_task->find($list->user_id)->pp) }}"
                                                                                    class="profile-user-img img-fluid img-circle">
                                                                            @endif
                                                                        </div>
    
                                                                        <h3 class="profile-username text-center">
                                                                        {{ $user_task->find($list->user_id)->name }}
                                                                        </h3>
    
                                                                        <p class="text-muted text-center">Software Engineer</p>
    
                                                                        <ul class="list-group list-group-unbordered mb-3">
                                                                            <li class="list-group-item">
                                                                                <b>Email</b> <a
                                                                                class="float-right">{{ $user_task->find($list->user_id)->email }}</a>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <b>Employee Code</b> <a
                                                                                class="float-right text-dark">{{ $user_task->find($list->user_id)->code }}</a>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <b>Prof</b> <a
                                                                                class="float-right text-dark">@if ($user_task->find($list->user_id)->profs()->first())
                                                                                {{ $user_task->find($list->user_id)->profs()->first()->prof_code }}
                                                                                @endif</a>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <b>Profession</b> <a
                                                                                    class="float-right text-dark">
                                                                                @if ($user_task->find($list->user_id)->profs()->first())
                                                                                    {{ $user_task->find($list->user_id)->profs()->first()->prof_name }}
                                                                                    @endif
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <!-- /.card-body -->
                                                                </div>
                                                                <h3>Task List</h3>
                                                                <div class="card card-success card-outline">
                                                                    <div class="card-body box-profile">
                                                                        @if ($project_task->where('user_id',$list->user_id)->where('project_id',$data->id)->exists())
                                                                            <ul class="list-group list-group-unbordered mb-3">
                                                                                @foreach ($project_task->where('user_id',$list->user_id)->where('project_id',$data->id)->get() as $pt)
                                                                                <li class="list-group-item">
                                                                                    <b class="font-weight-normal">{{$loop->iteration}}. {{$pt->details}}</b>
                                                                                    <a class="float-right text-dark font-weight-bold">({{$job_list->find($pt->task_id)->task_name}})</a>
                                                                                </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        @else
                                                                            <h4 style="text-align: center" class="text-red">No Task Added</h4>
                                                                        @endif
                                                                    </div>
                                                                </div>
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
                                            <div class="modal fade" id="insert{{ $list->user_id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Tambah Role</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="/admin/project_all" method="POST"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="Profession">Profession</label>
                                                                    <div class="select2-primary">
                                                                        <select class="select2" name="profs[]"
                                                                            data-dropdown-css-class="select2-primary"
                                                                            multiple="multiple"
                                                                            data-placeholder="Select a Profession"
                                                                            style="width: 100%;" autocomplete="off">
                                                                            @foreach ($profs as $prof)
                                                                                <option
                                                                                    @if (in_array($prof->id, $prof_part)) selected @endif
                                                                                    value="{{ $prof->id }}">
                                                                                    {{ $prof->prof_name }}
                                                                                </option>
                                                                            @endforeach
        
                                                                        </select>
        
                                                                    </div>
                                                                    {{-- <select name="prof_id" id="prof_id" class="form-control">
                                                                                <option value="" selected disabled hidden>Pilih
                                                                                    Profesi </option>
                                                                                    @foreach ($profs as $prof)
                                                                                        @if (in_array($prof->id, $prof_part))
                                                                                            @continue
                                                                                        @endif
                                                                                        <option value="{{ $prof->id }}">{{ $prof->prof_name }}
                                                                                        </option>
                                                                                    @endforeach 
                                                                                    not this part
                                                                                     <option value="{{ $profession->id }}">{{ $profession->prof_name }}
                                                                                    </option> 
                                                                                    </select> --}}
                                                                </div>
                                                                <input type="hidden" name="project_id" id="project_id"
                                                                    value="{{ $data->id }}">
                                                                <input type="hidden" name="user_id" id="user_id"
                                                                    value="{{ $list->user_id }}">
        
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-default"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save
                                                                    changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <div class="modal fade" id="tambah{{ $list->user_id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Tambah Task</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="/admin/project/task/add" method="POST"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="list_task">Task yang telah Dipilih</label>
                                                                    <div class="select2-success">
                                                                        <select class="select2"
                                                                            data-dropdown-css-class="select2-success"
                                                                            multiple="multiple" data-placeholder="Select a Task"
                                                                            style="width: 100%;" autocomplete="off" disabled>
                                                                            @foreach ($job_list->get() as $task)
                                                                                @if ($job_list->find($task->id)->profs()->first() == '')
                                                                                    @continue
                                                                                @else
                                                                                    @if (in_array($task->profs()->first()->id, $prof_part))
                                                                                        <option
                                                                                            @if ($project_task->where(['user_id' => $list->user_id, 'project_id' => $data->id])->where('task_id', $task->id)->exists()) @php
                                                                                                $saved_task[] = $task->id @endphp
                                                                                            selected value="{{ $task->id }}">
                                                                                            {{ $task->task_name }}
                                                                                            @endif
                                                                                    @endif
                                                                                    </option>
                                                                                @endif
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="add_task">Add new Task</label>
                                                                    <select name="task_id" id="task_id" class="form-control">
                                                                        <option value="" selected disabled hidden>Pilih Task Baru</option>
                                                                        @foreach ($job_list->get() as $task)
                                                                            @if ($job_list->find($task->id)->profs()->first() == '')
                                                                                @continue
                                                                            @else
                                                                                @if (in_array($task->profs()->first()->id, $prof_part))
                                                                                    @if (in_array($task->id, $saved_task))
                                                                                        @continue
                                                                                    @else
                                                                                        <option value="{{ $task->id }}">{{ $task->task_name }}</option>
                                                                                    @endif
                                                                                @endif
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Details</label>
                                                                    <textarea class="form-control" id="details" name="details" rows="3"
                                                                        placeholder="Enter Task Details ..."></textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="expired_at">Add Task Deadline</label>
                                                                    <input name="expired_at" class="form-control" type="datetime-local">
                                                                </div>
                                            
                                                                <input type="hidden" name="project_id" id="project_id" value="{{ $data->id }}">
                                                                <input type="hidden" name="user_id" id="user_id" value="{{ $list->user_id }}">
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="delete{{ $list->user_id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content bg-danger">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Hapus Data User</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah anda yakin ingin Menghapus data dari {{ $user_task->find($list->user_id)->name }} ini?
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                                            <a href="/admin/project_all/delete/{{ $list->user_id }}" type="submit"
                                                                class="btn btn-outline-light">Hapus Data</a>
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
                    <!-- /.modal-content -->
                </div>
                
                
            </div>
        
        
        
            <div class="row gutters-sm">
                <div class="col-12">
                    <div class="card">
                        <div class="card-orange">
                            {{-- RIWAYAT PEMBAYARAN --}}
                            <div class="card-header">
                                <h2 class="card-title text-light pt-2">Riwayat Pembayaran</h2>
                                <div class="col-xs-3" style="float: right">
                                    <a href="#addpembayaran" class="btn btn-block btn-info text-light" data-toggle="modal"><i class="fas fa-plus-circle mr-2"></i> Tambah Pembayaran</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-responsive-sm table-bordered" id="myTable1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No.</th>
                                            <th class="text-center">Tanggal Pembayaran</th>
                                            <th class="text-center">Jenis Pembayaran</th>
                                            <th class="text-center">Deskripsi Pembayaran</th>
                                            <th class="text-center">Nilai Pembayaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pembayaran as $p)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $p->tanggal_pembayaran }}</td>
                                                <td>{{ $p->jenis_pembayaran }}</td>
                                                <td>{{ $p->deskripsi_pembayaran }}</td>
                                                <td>{{ $p->nilai_pembayaran }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- /.modal-dialog -->
        
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        
        
        
        
            <div class="modal fade" id="edit-data-instansi">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="card-header bg-orange">
                            <h3 class="card-title">Edit Data Instansi</h3>
                        </div>
                        <div class="card-body">
                            <form action="#" method="POST" enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <div class="content">
                                    <div class="form-group">
                                        <label>Nama Instansi</label>
                                        <input name="namainstansi" class="form-control" value="#" required>
                                        <div class="text-danger">
                                            @error('namainstansi')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
        
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Alamat Instansi</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                        name="alamatinstansi"> # </textarea>
                                </div>
        
                                <div class="form-group">
                                    <label>Kota Instansi</label>
                                    <input name="kotainstansi" class="form-control" value="#" required>
                                    <div class="text-danger">
                                        @error('namainstansi')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group">
                                    <label>Jenis Instansi</label>
                                    <select name="jenisinstansi" class="form-control" value="#">
        
                                    </select>
                                </div>
        
                                <div class="form-group">
                                    <button class="btn btn-success float-right">Save Data</button>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            
        
            <div class="modal fade" id="addpembayaran">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="card-header bg-orange">
                            <h3 class="card-title">Tambah Data Pembayaran</h3>
                        </div>
                        <div class="card-body">
                            <form action="/admin/payment" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="content">
                                    <div class="form-group">
                                        <label>Tanggal Pembayaran</label>
                                        <input type="date" name="tanggalpembayaran" class="form-control" value="" required>
                                    </div>
                                </div>
        
                                <div class="form-group">
                                    <input type="text" name="userpembayaran" value="{{ $data->client->id }}" hidden>
                                </div>
        
                                <div class="form-group">
                                    <input type="text" name="proyekpembayaran" value="{{ $data->id }}" hidden>
                                </div>
        
                                <div class="form-group">
                                    <label>Jenis Pembayaran</label>
                                    <select name="jenispembayaran" id="jenispembayaran" class="form-select">
                                        <option value="" selected hidden>Pilih Jenis Pembayaran</option>
                                        <option value="Tunai">Tunai</option>
                                        <option value="Transfer">Transfer</option>
                                        <option value="Cek">Cek</option>
                                    </select>
                                </div>
        
                                <div class="form-group">
                                    <label>Deskripsi Pembayaran</label>
                                    <textarea name="deskripsipembayaran" class="form-control" value="#" required></textarea>
                                </div>
        
                                <div class="form-group">
                                    <label>Nilai Pembayaran</label>
                                    <input class="input-currency form-control" type="text" type-currency="IDR" placeholder="Rp"
                                        name="nilaipembayaran" required>
                                </div>
        
                                <div class="form-group">
                                    <button class="btn btn-success float-right">Save Data</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    

@endsection

@section('footer')
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#myTable1').DataTable();
        });
    </script>
@endsection
@endsection
