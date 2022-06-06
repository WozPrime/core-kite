@extends('pages.ui_admin.admin')

@section('title')
Profil Klien
@endsection

@section('body')
@section('navbar')
@endsection

@section('sidebar')
@endsection

@section('content')
<div class="container pt-3">
    <div class="main-body">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="d-flex flex-column align-items-center my-2 ml-2">
                                @if ($klienuser->pp!='')
                                    <img src="{{ url('pp/' . $klienuser->pp) }}" alt="Profil Klien" class="rounded-circle" width="150" height="150">
                                @else    
                                    <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" alt="Profil Klien" class="rounded-circle" width="150" height="150">
                                @endif
                            </div>
                            <div class="text-center mb-1 ml-2">
                                {{$klien->name}}
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-sm-3 pt-1">
                                    <h6 class="mb-0">Nama Klien</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    : {{$klien->name}}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Nomor Telepon</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    : {{$klien->phone_number}}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    : {{$klien->email}}
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Asal Instansi</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    : <a
                                        href="/admin/instansi/{{$klien->instance->id}}">{{$klien->instance->nama_instansi}}</a>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-lg-12 col sm-12 mx-auto">
            <div class="card mb-3">
                <div class="card-header bg-primary">
                    <div class="mb-2">
                        Proyek Klien
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
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
                            @foreach ($projekklien as $p)
                            <tr>
                                {{-- <td>1</td>
                                    <td>Aplikasi Judi Online Berbasis Website</td>
                                    <td>Aplikasi Website</td>
                                    <td>Rp 69.420.000</td>
                                    <td>In Progress</td> --}}
                                <td>{{$loop->iteration}}</td>
                                <td>{{$p->project_name}}</td>
                                <td>{{$p->project_category}} </td>
                                <td>{{$p->project_value}} </td>
                                <td>{{$p->project_status}} </td>
                                <td>
                                    <a href="/admin/proyek/{{$p->id}}" class="badge bg-info mr-1"><i
                                            class="fa fa-eye"></i></a>
                                    <a href="#editproyek{{$p->id}}" data-toggle="modal" class="badge bg-warning mr-1"><i
                                            class="fas fa-pencil-alt"></i></a>
                                    <form class="d-inline" action="/admin/proyek/{{$p->id}}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="badge bg-danger" style="border:none"
                                            onclick="return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini?')"><i
                                                class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            <div class="modal fade" id="editproyek{{ $p->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="card-header bg-orange">
                                            <h3 class="card-title">Edit Proyek {{ $p->project_name }}</h3>
                                        </div>
                                        <div class="card-body">
                                            <form autocomplete="off" action="/admin/proyek/{{ $p->id }}" method="POST"
                                                enctype="multipart/form-data">
                                                @method('put')
                                                @csrf
                                                <div class="content">
                                                    <div class="form-group" hidden>
                                                        <label for="seeAnotherFieldInstance">Pilih
                                                            Instansi</label>
                                                        <select class="form-select" aria-label="Disable"
                                                            name="instance_id" required>
                                                            <option selected hidden value="{{ $p->instance_id }}">
                                                                {{ $p->instance->nama_instansi }}</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group" hidden>
                                                        <label for="seeAnotherFieldClient">Pilih Klien</label>
                                                        <select class="form-select" name="client_id" required>
                                                            <option selected hidden value="{{ $p->client_id }}">
                                                                {{ $p->client->name }}</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Kode Proyek</label>
                                                        <input name="project_code" class="form-control"
                                                            value="{{ $p->project_code }}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Nama Proyek</label>
                                                        <input name="project_name" class="form-control"
                                                            value="{{ $p->project_name }}">
                                                        <div class="text-danger">
                                                            @error('project_name')
                                                            {{ $message }}
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="seeAnotherFieldClient">Pilih Kategori Proyek</label>
                                                        <select class="form-select" name="project_category" required>
                                                            <option selected hidden value="{{ $p->project_category }}">
                                                                {{ $p->project_category }}</option>
                                                            <option value="Web">Web</option>
                                                            <option value="Mobile App">Mobile App</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Detail Proyek</label>
                                                        <textarea name="project_detail" class="form-control"
                                                            type="date">{{ $p->project_detail }}</textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="seeAnotherFieldClient">Pilih Status Proyek</label>
                                                        <select class="form-select" name="project_status" required>
                                                            <option selected hidden value="{{ $p->project_status }}">
                                                                {{ $p->project_status }}</option>
                                                            <option value="Baru">Baru</option>
                                                            <option value="Sedang Berjalan">Sedang Berjalan</option>
                                                            <option value="Tertunda">Tertunda</option>
                                                            <option value="Selesai">Selesai</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Starting Date</label>
                                                        <input name="project_start_date" class="form-control"
                                                            type="date" value="{{ $p->project_start_date }}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Deadline</label>
                                                        <input name="project_deadline" class="form-control" type="date"
                                                            value="{{ $p->project_deadline }}">
                                                    </div>

                                                    <div>
                                                        <label>Total Project</label>
                                                        <input class="input-currency form-control" type="text"
                                                            type-currency="IDR" placeholder="Rp" name="project_value"
                                                            value="{{ $p->project_value }}">
                                                    </div>

                                                    <br>

                                                    <div class="form-group">
                                                        <button class="btn btn-success float-right">Save
                                                            Data</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row gutters-sm">
            <div class="col-12">
                <div class="card">
                    <div class="card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Riwayat Pembayaran</h3>
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
                                        <th class="text-center">Nama Proyek</th>
                                        <th class="text-center">Tanggal Pembayaran</th>
                                        <th class="text-center">Jenis Pembayaran</th>
                                        <th class="text-center">Deskripsi Pembayaran</th>
                                        <th class="text-center">Nilai Pembayaran</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pembayaranklien as $p)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$p->project->project_name}}</td>
                                        <td>{{$p->tanggal_pembayaran}}</td>
                                        <td>{{$p->jenis_pembayaran}}</td>
                                        <td>{{$p->deskripsi_pembayaran}}</td>
                                        <td>{{$p->nilai_pembayaran}}</td>
                                        <td>
                                            <a href="#editpembayaran{{$p->id}}" data-toggle="modal"
                                                class="badge bg-warning mr-1"><i class="fas fa-pencil-alt"></i></a>
                                            <form onclick="return confirm('yakin untuk menghapus data ini')"
                                                action="/admin/payment/{{$p->id}}" class="d-inline" method="post">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="badge bg-danger" style="border: none"><i
                                                        class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="editpembayaran{{$p->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="card-header bg-orange">
                                                    <h3 class="card-title">Edit Data Pembayaran</h3>
                                                </div>
                                                <div class="card-body">
                                                    <form action="/admin/payment/{{$p->id}}" method="POST" enctype="multipart/form-data">
                                                        @method('put')
                                                        @csrf
                                                        <div class="content">
                                                            <div class="form-group">
                                                                <label>Tanggal Pembayaran</label>
                                                                <input type="date" name="tanggalpembayaran" class="form-select" value="{{$p->tanggal_pembayaran}}" required>
                                                            </div>
                                                        </div>
                                    
                                                        <div class="form-group">
                                                            <input type="text" name="userpembayaran" value="{{$klien->id}}" hidden>
                                                        </div>
                                    
                                                        <div class="form-group">
                                                            <label for="proyekpembayaran">Proyek</label>
                                                            <input type="text" class="form-control" value="{{$p->project->project_name}}" disabled>
                                                        </div>
                                    
                                                        <div class="form-group">
                                                            <label>Jenis Pembayaran</label>
                                                            <select name="jenispembayaran" id="jenispembayaran" class="form-select">
                                                                <option value="{{$p->jenis_pembayaran}}" selected hidden>{{$p->jenis_pembayaran}}</option>
                                                                <option value="Tunai">Tunai</option>
                                                                <option value="Transfer">Transfer</option>
                                                                <option value="Cek">Cek</option>
                                                            </select>
                                                        </div>
                                    
                                                        <div class="form-group">
                                                            <label>Deskripsi Pembayaran</label>
                                                            <textarea name="deskripsipembayaran" class="form-control" required>{{$p->deskripsi_pembayaran}}</textarea>
                                                        </div>
                                    
                                                        <div class="form-group">
                                                            <label>Nilai Pembayaran</label>
                                                            <input class="input-currency form-control" type="text" type-currency="IDR" placeholder="Rp" name="nilaipembayaran" value="{{$p->nilai_pembayaran}}" required>
                                                        </div>
                                    
                                                        <div class="form-group">
                                                            <button class="btn btn-success float-right">Save Data</button>
                                                        </div>
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
                    </div>
                </div>
            </div>
        </div>

        <div class="row gutters-sm">
            <div class="col-12">
                <div class="card">
                    <div class="card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Riwayat Pertemuan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <a href="#add-data" data-toggle="modal" class="btn btn-success"><i class="fas fa-plus-circle"></i>Tambahkan Meeting dengan Klien</a>  
                            <table class="table table-responsive-sm table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th class="text-center">Nama Proyek</th>
                                        <th class="text-center">Tanggal Pertemuan</th>
                                        <th class="text-center">Status Pertemuan</th>
                                        <th class="text-center">Deskripsi Pertemuan</th>
                                        <th class="text-center">Hasil Pertemuan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($meetingklien as $p)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$p->project->project_name}}</td>
                                        <td>{{$p->tanggal_pertemuan}}</td>
                                        @if ($p->status_pertemuan == 'MENUNGGU VERIFIKASI')
                                        <td class="badge bg-warning my-2 mx-2">{{$p->status_pertemuan}}</td>
                                        @endif
                                        @if ($p->status_pertemuan == 'DISETUJUI')
                                        <td class="badge bg-success my-2 mx-2">{{$p->status_pertemuan}}</td>
                                        @endif
                                        @if ($p->status_pertemuan == 'SELESAI')
                                        <td class="badge bg-primary my-2 mx-2">{{$p->status_pertemuan}}</td>
                                        @endif
                                        @if ($p->status_pertemuan == 'DITOLAK')
                                        <td class="badge bg-danger my-2 mx-2">{{$p->status_pertemuan}}</td>
                                        @endif
                                        <td>{{$p->deskripsi_pertemuan}}</td>
                                        <td>{{$p->hasil_pertemuan}}</td>
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
                        <input type="text" name="userpembayaran" value="{{$klien->id}}" hidden>
                    </div>

                    <div class="form-group">
                        <label for="proyekpembayaran">Pilih Proyek</label>
                        <select name="proyekpembayaran" id="proyekpembayaran" required class="form-select">
                            <option value="" hidden>Pilih Proyek</option>
                            @foreach ($projekklien as $p)
                            <option value="{{$p->id}}">{{$p->project_name}}</option>
                            @endforeach
                        </select>
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

<div class="modal fade" id="add-data">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card-header bg-orange">
                <h3 class="card-title">Tambah Jadwal Pertemuan</h3>
            </div>
            <div class="card-body">
                <form action="/admin/meetings" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label>Nama Klien</label>
                       <select name="idklien" id="" class="form-control">
                           <option value="{{$klien->id}}" selected>{{$klien->name}}</option>
                       </select>
                    </div>

                    <div class="form-group">
                        <label>Pilih Proyek</label>
                        <select name="pilihproyek" id="pilihproyek" class="form-select" required>
                            <option hidden selected value="">Pilih Proyek</option>
                            @foreach ($projekklien as $p)
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

                    <div class="form-group">
                        <label for="catatanadmin">Catatan dari Admin</label>
                        <textarea name="catatanadmin" id="catatanadmin" class="form-control" cols="30" rows="3" placeholder="Contoh : Selamat Siang, untuk pertemuan tanggal 10 april 2022 bisa dilaksanakan sekitar pukul 13.30, Terima Kasih"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="analispertemuan">Analis Pertemuan</label>
                        <select name="analispertemuan" id="analispertemuan" class="form-select">
                            <option value="" selected hidden><div class="text-muted">Pilih Analis</div></option>
                            @foreach ($karyawan as $k)
                                <option value="{{$k->name}}">{{$k->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="hasilpertemuan">Hasil Pertemuan</label>
                        <textarea name="hasilpertemuan" id="hasilpertemuan" cols="30" rows="3" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <input type="radio" value="DISETUJUI" name="persetujuanadmin" id="adminsetuju" required>
                        <label for="adminsetuju">Tandai Setuju Permintaan</label>
                        <input type="radio" value="SELESAI" name="persetujuanadmin" id="adminselesai" required>
                        <label for="adminselesai">Tandai selesai</label>
                    </div>

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
