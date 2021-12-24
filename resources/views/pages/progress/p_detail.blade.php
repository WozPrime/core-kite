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

        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card" style="height: 375px">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            {{-- @if ($instance->logo_instansi)
                                <img src="#" alt="#" class="rounded-circle" width="150" height="150">
                            @else --}}
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a2/Logo_of_Ministry_of_Communication_and_Information_Technology_of_the_Republic_of_Indonesia.svg/1024px-Logo_of_Ministry_of_Communication_and_Information_Technology_of_the_Republic_of_Indonesia.svg.png"
                                alt="Logo Instansi" class="rounded-circle" width="150">
                            {{-- @endif --}}
                            <div class="mt-3">
                                {{-- <h4>{{$instance->nama_instansi}}</h4> --}}
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
                        <p class="text-muted font-size-sm"> {{ date('D, d M Y', strtotime($data->project_start_date)) }}
                            <b>s/d</b> {{ date('D, d M Y', strtotime($data->project_deadline)) }} </p>
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

        {{-- <div class="row gutters-sm">
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
                                        <select name="users_id" id="users_id" class="form-control select2">
                                            <div class="form-group no-border">
                                                @foreach ($users as $karyawan)
                                                <select name="user_id" id="user_id" class="form-control select2">

                                                    @if (count($part_user) == 0)
                                                    <option value="">Karyawan Tidak Tersedia
                                                    </option>

                                                    @endif
                                                    @foreach ($part_user as $karyawan)
                                                    <option value="{{ $karyawan->id }}">{{ $karyawan->name }}
                                                    </option>

                                                    @endforeach
                                                </select>
                                                <input type="hidden" name="project_id" id="project_id"
                                                    value="{{ $data->id }}">
                                            </div>
                                    </div>
                                    <div class="col-3">
                                        <button @if (count($part_user)==0) disabled @endif type="submit"
                                            class="btn btn-block btn-info">Tambah</button>
                                    </div>
                                </div>
                            </form>
                            <table class="table table-responsive-sm table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th style="min-width: 20px; max-width: 20px;" class="text-center">No.</th>
                                        <th style="min-width: 100px; max-width: 100px;" class="text-center">Prof &
                                            Hak
                                            Akses</th>
                                        <th class="text-center">Nama</th>
                                        <th style="min-width: 40px; max-width: 40px;" class="text-center">Foto</th>
                                        <th style="min-width: 70px; max-width: 70px;" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($participant as $list)
                                    <tr>
                                        {{-- {{dd($list)}} --}}
                                        {{-- <td>{{ $loop->iteration }}</td>
                                        <td class="text-center">
                                            <a href="#insert{{$list->user_id}}" data-toggle="modal"
                                                class="btn btn-block">
                                                <div style="display: flex;
                                                                    flex-direction:column;
                                                                    justify-content:center;">
                                                    @foreach ($project_task as $prof_task)
                                                    @if ($prof_task->user_id == $list->user_id && $prof_task->prof_id !=
                                                    '')
                                                    <div style="padding: 3px">
                                                        <span class="badge @if (fmod($prof_task->prof_id,2) == 0)
                                                                                bg-success
                                                                                @else
                                                                                bg-warning                                                                    
                                                                            @endif">
                                                            {{ $prof_part->find($prof_task->id)->profUser()->first()->prof_name }}
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
                                        <td>
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
                                                href="#edit{{ $list->user_id }}"><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-danger" data-toggle="modal"
                                                href="#delete{{ $list->user_id }}"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="insert{{$list->user_id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Input New Prof and Task</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="/admin/project_task" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="Profession">Profession</label>
                                                            <select name="prof_id" id="prof_id" class="form-control">
                                                                @if ($prof_part->profUser()->first())
                                                                <option value="" @if ($prof_part->
                                                                    profUser()->first()->id == '')
                                                                    selected
                                                                    @endif disabled hidden>Pilih
                                                                    Profesi
                                                                </option>
                                                                @foreach ($profs as $prof)
                                                                <option value="{{ $prof->id }}" @if ($prof_part->
                                                                    profUser()->first()->id == $prof->id) selected
                                                                    @endif>{{ $prof->prof_name }}
                                                                </option>
                                                                @endforeach
                                                                @else
                                                                <option value="" selected disabled hidden>Pilih Profesi
                                                                </option>
                                                                @foreach ($profs as $prof)
                                                                <option value="{{ $prof->id }}">{{ $prof->prof_name }}
                                                                </option>
                                                                @endforeach
                                                                @endif
                                                            </select>
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
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div> --}}

        <br>

        <div class="row gutters-sm">
            <div class="col-12">
                <div class="card">
                    <div class="card-orange">
                        <div class="card-header">
                            <h3 class="card-title text-light">Riwayat Pembayaran</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="mb-2">
                                <a href="#addpembayaran" class="badge bg-primary" data-toggle="modal"><i
                                        class="fas fa-plus-circle"> Tambah Pembayaran</i></a>
                            </div>
                            <table class="table table-responsive-sm table-bordered" id="myTable">
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
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$p->tanggal_pembayaran}}</td>
                                            <td>{{$p->jenis_pembayaran}}</td>
                                            <td>{{$p->deskripsi_pembayaran}}</td>
                                            <td>{{$p->nilai_pembayaran}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
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
                        <input type="text" name="userpembayaran" value="{{$data->client->id}}" hidden>
                    </div>

                    <div class="form-group">
                        <input type="text" name="proyekpembayaran" value="{{$data->id}}" hidden>
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
                        <input class="input-currency form-control" type="text" type-currency="IDR" placeholder="Rp" name="nilaipembayaran" required>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-success float-right">Save Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer')
@endsection

@endsection

