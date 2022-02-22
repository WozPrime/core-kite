@extends('pages.ui_client.main')
@section('title')
Dashboard
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
                                Halo, {{auth()->user()->name}}
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-sm-3 pt-1">
                                    <h6 class="mb-0">Asal Instansi</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    : {{$klien->instance->nama_instansi}}
                                </div>
                            </div>
                            <hr>
                            <div class="row pb-xl-4">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Alamat</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    :
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Nomor Telepon</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    :
                                </div>
                            </div>
                            
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Jumlah Proyek</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    :
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
                        <b> My Projects </b>
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
                                    <a href="#" class="badge bg-info mr-1"><i class="fa fa-eye"></i></a>
                                    <a href="#" class="badge bg-warning mr-1"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="#" class="badge bg-green mr-1" data-toggle="modal" data-target="#add-data"><i class="fa fa-clock"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-lg-12 col sm-12 mx-auto">
            <div class="card mb-3">
                <div class="card-body">
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
            </div>
        </div>
        
    </div>
</div>

<div class="modal fade" id="add-data">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="card-header bg-orange">
                <h3 class="card-title">Atur Jadwal Pertemuan</h3>
            </div>
            <div class="card-body">
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Pilih Tanggal Pertemuan</label>
                        <input type="date" name="tanggalpertemuan" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="deskripsipertemuan">Deskripsi Pertemuan</label>
                        <textarea name="deskripsipertemuan" id="deskripsipertemuan" class="form-control"></textarea>
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
