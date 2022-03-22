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
                                <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png"
                                    alt="Logo Instansi" class="rounded-circle" width="150" height="150">
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
                                    : <a href="/admin/instansi/{{$klien->instance->id}}">{{$klien->instance->nama_instansi}}</a>
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
                <div class="card-body">
                    <div class="mb-2">
                        <b> Proyek Klien </b>
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
                                        <a href="/admin/proyek/{{$p->id}}" class="badge bg-info mr-1"><i class="fa fa-eye"></i></a>
                                        <a href="#editproyek{{$p->id}}" data-toggle="modal" class="badge bg-warning mr-1"><i class="fas fa-pencil-alt"></i></a>
                                        <form class="d-inline" action="/admin/proyek/{{$p->id}}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="badge bg-danger" style="border:none" onclick="return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini?')"><i class="fas fa-trash"></i></button>
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
                                                <form autocomplete="off" action="/admin/proyek/{{ $p->id }}" method="POST" enctype="multipart/form-data">
                                                    @method('put')
                                                    @csrf
                                                    <div class="content">
                                                        <div class="form-group" hidden>
                                                            <label for="seeAnotherFieldInstance">Pilih
                                                                Instansi</label>
                                                            <select class="form-select" aria-label="Disable" name="instance_id" required>
                                                                    <option selected hidden value="{{ $p->instance_id }}">{{ $p->instance->nama_instansi }}</option>
                                                            </select>
                                                        </div>
                            
                                                        <div class="form-group" hidden>
                                                            <label for="seeAnotherFieldClient">Pilih Klien</label>
                                                            <select class="form-select" name="client_id" required>
                                                                <option selected hidden value="{{ $p->client_id }}">{{ $p->client->name }}</option>
                                                            </select>
                                                        </div>
                            
                                                        <div class="form-group">
                                                            <label>Kode Proyek</label>
                                                            <input name="project_code" class="form-control" value="{{ $p->project_code }}">
                                                        </div>
                            
                                                        <div class="form-group">
                                                            <label>Nama Proyek</label>
                                                            <input name="project_name" class="form-control" value="{{ $p->project_name }}">
                                                            <div class="text-danger">
                                                                @error('project_name')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </div>
                            
                                                        <div class="form-group">
                                                            <label for="seeAnotherFieldClient">Pilih Kategori Proyek</label>
                                                            <select class="form-select" name="project_category" required>
                                                                <option selected hidden value="{{ $p->project_category }}">{{ $p->project_category }}</option>
                                                                    <option value="Web">Web</option>
                                                                    <option value="Mobile App">Mobile App</option>
                                                            </select>
                                                        </div>
                            
                                                        <div class="form-group">
                                                            <label>Detail Proyek</label>
                                                            <textarea name="project_detail" class="form-control" type="date" >{{ $p->project_detail }}</textarea>
                                                        </div>
                            
                                                        <div class="form-group">
                                                            <label for="seeAnotherFieldClient">Pilih Status Proyek</label>
                                                            <select class="form-select" name="project_status" required>
                                                                <option selected hidden value="{{ $p->project_status }}">{{ $p->project_status }}</option>
                                                                    <option value="Baru">Baru</option>
                                                                    <option value="Sedang Berjalan">Sedang Berjalan</option>
                                                                    <option value="Tertunda">Tertunda</option>
                                                                    <option value="Selesai">Selesai</option>
                                                            </select>
                                                        </div>
                            
                                                        <div class="form-group">
                                                            <label>Starting Date</label>
                                                            <input name="project_start_date" class="form-control" type="date" value="{{ $p->project_start_date }}">
                                                        </div>
                            
                                                        <div class="form-group">
                                                            <label>Deadline</label>
                                                            <input name="project_deadline" class="form-control" type="date" value="{{ $p->project_deadline }}">
                                                        </div>
                            
                                                        <div>
                                                            <label>Total Project</label>
                                                            <input class="input-currency form-control" type="text" type-currency="IDR" placeholder="Rp" name="project_value" value="{{ $p->project_value }}">
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
                                                <a href="#editpembayaran{{$p->id}}" data-toggle="modal" class="badge bg-warning mr-1"><i class="fas fa-pencil-alt"></i></a>
                                                <form onclick="return confirm('yakin untuk menghapus data ini')" action="/admin/payment/{{$p->id}}" class="d-inline" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="badge bg-danger" style="border: none"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
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
