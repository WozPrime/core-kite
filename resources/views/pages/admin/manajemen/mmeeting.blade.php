@extends('pages.ui_admin.admin')
@section('title')
    Overview Klien
@endsection
@section('body')
@section('navbar')
@endsection
@section('sidebar')
@endsection
@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Manajemen Meeting</h1>
            </div><!-- /.col -->
            
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Menunggu Verifikasi</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-responsive-sm table-bordered" id="myTable1" width="100%">
                                <thead>
                                    <tr>    
                                        <th>Nama Klien</th>
                                        <th>Proyek</th>
                                        <th>Tempat Pertemuan</th>
                                        <th>Waktu Pertemuan</th>
                                        <th>Deskripsi Pertemuan</th>
                                        <th>Status Pertemuan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($meetingpending as $mp)
                                        <tr>
                                            <td>{{$mp->client->name}}</td>
                                            <td>{{$mp->project->project_name}}</td>
                                            <td>{{$mp->tempat_pertemuan}}</td>
                                            <td>{{$mp->tanggal_pertemuan}}</td>
                                            <td>{{$mp->deskripsi_pertemuan}}</td>
                                            <td class="badge bg-warning m-2">{{$mp->status_pertemuan}}</td>
                                            <td><a href="" class="btn btn-primary" data-toggle="modal" data-target="#edit-data{{$mp->id}}"><i class="fas fa-pencil-alt"></i></a></td>
                                        </tr>
                                        
                                        <div class="modal fade" id="edit-data{{$mp->id}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="card-header bg-orange">
                                                        <h3 class="card-title">Permintaan Pertemuan</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <form action="/admin/meetings/{{$mp->id}}" method="POST" enctype="multipart/form-data" autocomplete="off">
                                                            @method('put')
                                                            @csrf
    
                                                            <div class="content">
    
                                                                <div class="form-group">
                                                                    <label for="namaklien">Nama Klien</label>
                                                                    <input type="text" name="namaklien" id="namaklien" class="form-control" value="{{$mp->client->name}}" readonly>
                                                                </div>
        
                                                                <div class="form-group">
                                                                    <label for="namaproyek">Nama Proyek</label>
                                                                    <input type="text" name="namaproyek" id="namaproyek" class="form-control" value="{{$mp->project->project_name}}" readonly>
                                                                </div>
        
                                                                <div class="form-group">
                                                                    <label for="tanggalpertemuan">Tanggal Pertemuan</label>
                                                                    <input type="text" name="tanggalpertemuan" id="tanggalpertemuan" class="form-control" value="{{$mp->tanggal_pertemuan}}" readonly>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="tempatpertemuan">Tempat Pertemuan</label>
                                                                    <input type="text" name="tempatpertemuan" id="tempatpertemuan" class="form-control" value="{{$mp->tempat_pertemuan}}" readonly>
                                                                </div>
        
                                                                <div class="form-group">
                                                                    <label for="deskripsipertemuan">Deskripsi Pertemuan</label>
                                                                    <input type="text" name="deskripsi_pertemuan" id="deskripsi_pertemuan" class="form-control" value="{{$mp->deskripsi_pertemuan}}" readonly>
                                                                </div>
        
                                                                <div class="form-group">
                                                                    <label for="catatanadmin">Catatan dari Admin</label>
                                                                    <textarea name="catatanadmin" id="catatanadmin" class="form-control" cols="30" rows="3" placeholder="Contoh : Selamat Siang, untuk pertemuan tanggal 10 april 2022 bisa dilaksanakan sekitar pukul 13.30, Terima Kasih"></textarea>
                                                                </div>
        
                                                                <div class="form-group">
                                                                    <input type="radio" value="DISETUJUI" name="persetujuanadmin" id="adminsetuju" required>
                                                                    <label for="adminsetuju">Setujui Permintaan</label>
                                                                    <input type="radio" name="persetujuanadmin" id="adminditolak" value="DITOLAK" required>
                                                                    <label for="adminditolak">Tolak Permintaan</label>
                                                                </div>
                                                                <button class="btn-success rounded-top rounded-bottom"> Simpan Data</button>
    
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
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Riwayat Meeting</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-responsive-sm table-bordered" id="myTable" width="100%">
                                <thead>
                                    <tr>    
                                        <th>Nama Klien</th>
                                        <th>Proyek</th>
                                        <th>Waktu Pertemuan</th>
                                        <th>Analis</th>
                                        <th>Deskripsi Pertemuan</th>
                                        <th>Status Pertemuan</th>
                                        <th>Hasil Pertemuan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach ($meetingdiputuskan as $mp)
                                            <tr>
                                                <td>{{$mp->client->name}}</td>
                                                <td>{{$mp->project->project_name}}</td>
                                                <td>{{$mp->tanggal_pertemuan}}</td>
                                                <td>{{$mp->sistem_analis}}</td>
                                                <td>{{$mp->deskripsi_pertemuan}}</td>
                                                @if ($mp->status_pertemuan == 'MENUNGGU VERIFIKASI')
                                                <td class="badge bg-warning my-2 mx-2">{{$mp->status_pertemuan}}</td>
                                                @endif
                                                @if ($mp->status_pertemuan == 'DISETUJUI')
                                                <td class="badge bg-success my-2 mx-2">{{$mp->status_pertemuan}}</td>
                                                @endif
                                                @if ($mp->status_pertemuan == 'SELESAI')
                                                <td class="badge bg-primary my-2 mx-2">{{$mp->status_pertemuan}}</td>
                                                @endif
                                                @if ($mp->status_pertemuan == 'DITOLAK')
                                                <td class="badge bg-danger my-2 mx-2">{{$mp->status_pertemuan}}</td>
                                                @endif
                                                <td>@if ($mp->hasil_pertemuan == "")
                                                    <div class="text-muted">Belum Ada Hasil Pertemuan</div>
                                                @else
                                                    {{$mp->hasil_pertemuan}}
                                                @endif</td>
                                                <td><a href="" class="btn btn-primary" data-toggle="modal" data-target="#edit-data{{$mp->id}}"><i class="fas fa-pencil-alt"></i></a></td>
                                            </tr>
                                            
                                            <div class="modal fade" id="edit-data{{$mp->id}}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="card-header bg-orange">
                                                            <h3 class="card-title">Permintaan Pertemuan</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <form action="/admin/meetings/{{$mp->id}}" method="POST" enctype="multipart/form-data" autocomplete="off">
                                                                @method('put')
                                                                @csrf
        
                                                                <div class="content">
        
                                                                    <div class="form-group">
                                                                        <label for="namaklien">Nama Klien</label>
                                                                        <input type="text" name="namaklien" id="namaklien" class="form-control" value="{{$mp->client->name}}" readonly>
                                                                    </div>
            
                                                                    <div class="form-group">
                                                                        <label for="namaproyek">Nama Proyek</label>
                                                                        <input type="text" name="namaproyek" id="namaproyek" class="form-control" value="{{$mp->project->project_name}}" readonly>
                                                                    </div>
            
                                                                    <div class="form-group">
                                                                        <label for="tanggalpertemuan">Tanggal Pertemuan</label>
                                                                        <input type="text" name="tanggalpertemuan" id="tanggalpertemuan" class="form-control" value="{{$mp->tanggal_pertemuan}}" readonly>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="tempatpertemuan">Tempat Pertemuan</label>
                                                                        <input type="text" name="tempatpertemuan" id="tempatpertemuan" class="form-control" value="{{$mp->tempat_pertemuan}}" readonly>
                                                                    </div>
            
                                                                    <div class="form-group">
                                                                        <label for="deskripsipertemuan">Deskripsi Pertemuan</label>
                                                                        <input type="text" name="deskripsi_pertemuan" id="deskripsi_pertemuan" class="form-control" value="{{$mp->deskripsi_pertemuan}}" readonly>
                                                                    </div>
            
                                                                    @if ($mp->status_pertemuan == 'SELESAI')    
                                                                    
                                                                    <div class="form-group">
                                                                        <label for="analispertemuan">Analis Pertemuan</label>
                                                                        <select name="analispertemuan" id="analispertemuan" class="form-select">
                                                                            @if ($mp->sistem_analis)
                                                                                <option value="{{$mp->sistem_analis}}" selected hidden>{{$mp->sistem_analis}}</option>
                                                                            @else    
                                                                                <option value="" selected hidden><div class="text-muted">Pilih Analis</div></option>
                                                                            @endif
                                                                            @foreach ($karyawan as $k)
                                                                                <option value="{{$k->name}}">{{$k->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="hasilpertemuan">Hasil Pertemuan</label>
                                                                        <textarea name="hasilpertemuan" id="hasilpertemuan" cols="30" rows="3" class="form-control">{{$mp->hasil_pertemuan}}</textarea>
                                                                    </div>

                                                                    <input type="text" name="idproyek" hidden value="{{$mp->project->id}}">

                                                                    <div class="form-group">
                                                                        <label for="nilaiproyek">Nilai Proyek</label>
                                                                        <input class="input-currency form-control" type="text" type-currency="IDR" placeholder="Rp" name="nilaiproyek" value="{{$mp->project->project_value}}">
                                                                    </div>

                                                                    <input type="text" name="persetujuanadmin" hidden value="SELESAI">

                                                                    @else

                                                                    <div class="form-group">
                                                                        <label for="catatanadmin">Catatan dari Admin</label>
                                                                        <textarea name="catatanadmin" id="catatanadmin" class="form-control" cols="30" rows="3" placeholder="Contoh : Selamat Siang, untuk pertemuan tanggal 10 april 2022 bisa dilaksanakan sekitar pukul 13.30, Terima Kasih">{{$mp->catatan_admin}}</textarea>
                                                                    </div>
                                                                    
                                                                    <div class="form-group">
                                                                        <input type="radio" value="DISETUJUI" name="persetujuanadmin" id="adminsetuju" required>
                                                                        <label for="adminsetuju">Setujui Permintaan</label>
                                                                        <input type="radio" name="persetujuanadmin" id="adminditolak" value="DITOLAK" required>
                                                                        <label for="adminditolak">Tolak Permintaan</label>
                                                                        @if ($mp->status_pertemuan == 'DISETUJUI')
                                                                        <input type="radio" value="SELESAI" name="persetujuanadmin" id="adminselesai" required>
                                                                        <label for="adminselesai">Tandai selesai</label>
                                                                        @endif
                                                                    </div>

                                                                    @endif

                                                                    <button class="btn-success"> Simpan Data</button>
        
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
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>



@endsection
@section('footer')
@endsection

@endsection
