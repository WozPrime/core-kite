@extends('pages.ui_client.main')
@section('title')
Dashboard
@endsection
@section('body')
@section('navbar')
@endsection

@section('content')

<!-- Content Header (Page header) -->


<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" alt="User profile picture">
                        </div>

                        <p class="text-muted text-center">Selamat Datang,</p>
                        <h3 class="profile-username text-center">{{$klien->name}}</h3>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Proyek Berjalan : </b> <a class="float-right">{{$proyekberjalan}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Proyek Selesai : </b> <a class="float-right">{{$proyekselesai}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Proyek Terkendala : </b> <a class="float-right">{{$proyektertunda}}</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- About Me Box -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">About Me</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <strong><i class="fas fa-building mr-1"></i> Instansi</strong>

                        <p class="text-muted">
                            {{$klien->instance->nama_instansi}}
                        </p>

                        <hr>

                        <strong><i class="fas fa-envelope mr-1"></i> Email</strong>

                        <p class="text-muted">{{$klien->email}}</p>

                        <hr>

                        <strong><i class="fas fa-pencil-alt mr-1"></i> Nomor Telepon</strong>

                        <p class="text-muted">{{$klien->phone_number}}</p>

                        <hr>

                        <strong><i class="fas fa-lock mr-1"></i> Ganti Password</strong> <br>
                        <form action="/client/gantipassword/{{auth()->user()->id}}" method="POST">
                            @csrf
                            <input type="password" name="plama" id="plama" placeholder="isi password lama" class="form-control my-1" required>
                            <input type="password" name="pbaru" id="pbaru" placeholder="isi password baru" class="form-control mb-1" required>
                            <input type="password" name="pulang" id="pulang" placeholder="ulangi password baru" class="form-control mb-1" required>
                            <button class="mt-2">Save Data</button>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card" style="height: 98%">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#project" data-toggle="tab">Proyek
                                    Saya</a></li>
                            <li class="nav-item"><a class="nav-link" href="#mymeeting" data-toggle="tab">Meeting
                                    Saya</a></li>
                            <li class="nav-item"><a class="nav-link" href="#mypayments" data-toggle="tab">Riwayat
                                    Pembayaran</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="project">

                                <div class="mb-2">
                                    <b> Proyek Saya </b>
                                </div>
                                <table class="table table-bordered table-hover">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Proyek</th>
                                            <th>Jenis Proyek</th>
                                            <th>Nilai Proyek</th>
                                            <th>Status Proyek</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($proyek as $p)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$p->project_name}}</td>
                                            <td>{{$p->project_category}}</td>
                                            <td>{{$p->project_value}}</td>
                                            <td>{{$p->project_status}}</td>
                                            <td>
                                                <a href="/client/project/{{$p->id}}" class="btn btn-info mr-1"><i class="fa fa-eye"></i></a>
                                                <a href="#" class="btn btn-success mr-1" data-toggle="modal"
                                                    data-target="#add-data"><i class="fa fa-clock"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mb-2">
                                    <b> Proyek Selesai </b>
                                </div>
                                <table class="table table-bordered table-hover">
                                    <thead class="bg-primary">
                                        @if ($pselesai->count()==0)
                                            <tr class="text-center">
                                                <th>Belum ada proyek selesai</th>
                                            </tr>
                                        @else      
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Proyek</th>
                                            <th>Jenis Proyek</th>
                                            <th>Nilai Proyek</th>
                                            <th>Status Proyek</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pselesai as $p)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$p->project_name}}</td>
                                                <td>{{$p->project_category}}</td>
                                                <td>{{$p->project_value}}</td>
                                                <td>{{$p->project_status}}</td>
                                                <td>
                                                    <a href="/client/project/{{$p->id}}" class="btn btn-info mr-1"><i class="fa fa-eye"></i></a>
                                                    <a href="#" class="btn btn-success mr-1" data-toggle="modal"
                                                        data-target="#add-data"><i class="fa fa-clock"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="mymeeting">
                                <section class="content">
                                    <p><b>Meeting Saya</b></p>
                                    @if ($meeting->count()==0)
                                        <div class="text-muted">Belum Ada Jadwal Pertemuan Aktif</div><br>
                                    @endif <br>
                                    <a href="#add-data" data-toggle="modal" class="btn btn-success"><i class="fas fa-plus-circle"></i> Ajukan Jadwal Pertemuan Dengan Perusahaan</a>      
                                    <div class="card">
                                        <div class="card-body">
                                            <b>Riwayat Meeting</b>
                                            <table class="table table-bordered table-hover">
                                                <thead class="bg-primary">
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Tanggal Pertemuan</th>
                                                        <th>Proyek Pertemuan</th>
                                                        <th>Status Pertemuan</th>
                                                        <th>Deskripsi Pertemuan</th>
                                                        <th>Catatan dari Admin</th>
                                                        <th>Hasil Pertemuan</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($meeting as $m)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{$m->tanggal_pertemuan}}</td>
                                                            <td>{{$m->project->project_name}}</td>
                                                            @if ($m->status_pertemuan == 'MENUNGGU VERIFIKASI')
                                                            <td class="badge bg-warning my-2 mx-2">{{$m->status_pertemuan}}</td>
                                                            @endif
                                                            @if ($m->status_pertemuan == 'DISETUJUI')
                                                            <td class="badge bg-success my-2 mx-2">{{$m->status_pertemuan}}</td>
                                                            @endif
                                                            @if ($m->status_pertemuan == 'SELESAI')
                                                            <td class="badge bg-primary my-2 mx-2">{{$m->status_pertemuan}}</td>
                                                            @endif
                                                            @if ($m->status_pertemuan == 'DITOLAK')
                                                            <td class="badge bg-danger my-2 mx-2">{{$m->status_pertemuan}}</td>
                                                            @endif
                                                            <td>{{$m->deskripsi_pertemuan}}</td>
                                                            <td>@if ($m->catatan_admin=="")
                                                                <div class="text-muted">Belum ada catatan dari admin</div>
                                                            @else
                                                                {{$m->catatan_admin}}
                                                            @endif</td>
                                                            <td>
                                                                @if ($m->hasil_pertemuan=="")
                                                                    <div class="text-muted">Belum ada hasil pertemuan</div>
                                                                @else
                                                                {{$m->hasil_pertemuan}}
                                                                @endif</td>
                                                            <td>
                                                                
                                                                @if ($m->status_pertemuan == 'MENUNGGU VERIFIKASI' || $m->status_pertemuan == 'DITOLAK')
                                                                    <a href="#" class="btn btn-warning mr-1" data-toggle="modal" data-target="#edit-data{{$m->id}}"><i class="fas fa-pencil-alt"></i></a>
                                                                    <a>
                                                                        <form autocomplete="off" action="/meetings/{{ $m->id }}" method="POST" class="d-inline">
                                                                            @method('delete')
                                                                            @csrf
                                                                            <button class="btn btn-danger" onclick="return confirm('Yakin untuk menghapus data?')">
                                                                                <span class="fas fa-trash"></span>
                                                                            </button>
                                                                        </form>
                                                                    </a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <div class="modal fade" id="edit-data{{$m->id}}">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="card-header bg-orange">
                                                                        <h3 class="card-title">Atur Jadwal Pertemuan</h3>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <form action="/meetings/{{$m->id}}" method="POST" enctype="multipart/form-data">
                                                                            @csrf
                                                                            @method('put')
                                                                            <div class="form-group">
                                                                                <label>Proyek</label>
                                                                                <select name="pilihproyek" id="pilihproyek" class="form-select" required>
                                                                                    <option hidden selected value="{{$m->project->id}}">{{$m->project->project_name}}</option>
                                                                                    @foreach ($proyek as $p)
                                                                                        <option value="{{$p->id}}">{{$p->project_name}}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                        
                                                                            <div class="form-group">
                                                                                <label>Pilih Tanggal Pertemuan</label>
                                                                                <input type="datetime-local" class="form-control" name="tanggalpertemuan" required>
                                                                            </div>
                                                        
                                                                            <div class="form-group">
                                                                                <label for="deskripsipertemuan">Deskripsi Pertemuan</label>
                                                                                <textarea name="deskripsipertemuan" id="deskripsipertemuan" class="form-control" placeholder="Contoh : Saya ingin membahas mengenai penambahan fitur pada proyek ini. Bisakah kita bertemu pukul 16.00 di Kantor IdeKite?">{{$m->deskripsi_pertemuan}}</textarea>
                                                                            </div>
                                                        
                                                                            <input type="text" name="idklien" id="idklien" value="{{$klien->id}}" hidden>
                                                        
                                                                            <div class="form-group">
                                                                                <button class="btn btn-success float-right">Save Data</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                                <!-- /.modal-content -->
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="mypayments">
                                <div class="mb-2">
                                    <b> Riwayat Pembayaran </b>
                                </div>
                                <table class="table table-bordered table-hover">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal Pembayaran</th>
                                            <th>Nama Proyek</th>
                                            <th>Nilai Pembayaran</th>
                                            <th>Deskripsi</th>
                                            <th>Jenis Pembayaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pembayaran as $p)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$p->tanggal_pembayaran}}</td>
                                            <td>{{$p->project->project_name}}</td>
                                            <td>{{$p->nilai_pembayaran}}</td>
                                            <td>{{$p->deskripsi_pembayaran}}</td>
                                            <td>{{$p->jenis_pembayaran}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<div class="modal fade" id="add-data">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card-header bg-orange">
                <h3 class="card-title">Atur Jadwal Pertemuan</h3>
            </div>
            <div class="card-body">
                <form action="/meetings" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label>Pilih Proyek</label>
                        <select name="pilihproyek" id="pilihproyek" class="form-select" required>
                            <option hidden selected value="">Pilih Proyek</option>
                            @foreach ($proyek as $p)
                                <option value="{{$p->id}}">{{$p->project_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Pilih Tanggal Pertemuan</label>
                        <input type="datetime-local" class="form-control" name="tanggalpertemuan" required>
                    </div>

                    <div class="form-group">
                        <label for="deskripsipertemuan">Deskripsi Pertemuan</label>
                        <textarea name="deskripsipertemuan" id="deskripsipertemuan" class="form-control" placeholder="Contoh : Saya ingin membahas mengenai penambahan fitur pada proyek ini. Bisakah kita bertemu pukul 16.00 di Kantor IdeKite?"></textarea>
                    </div>

                    <input type="text" name="idklien" id="idklien" value="{{$klien->id}}" hidden>

                    <div class="form-group">
                        <button class="btn btn-success float-right">Save Data</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>
@endsection
@section('footer')
@endsection
@endsection
