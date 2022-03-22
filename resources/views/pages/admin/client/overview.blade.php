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
                <h1 class="m-0">Overview Klien</h1>
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
                    <div class="card-dark">
                        <div class="card-header">
                            <h3 class="card-title text-orange">Tabel Klien</h3>
                            <div class="text-right"><a href="/admin/instansi" class="text-orange">Lihat Tabel Instansi</a></div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-responsive-sm table-bordered" id="myTable" width="100%">
                                <thead>
                                    <tr>

                                        <th>Nama Klien</th>
                                        <th>Asal Instansi</th>
                                        <th>Nomor Telepon</th>
                                        <th>Email</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($client as $c)
                                        <tr>
                                            <td> {{$c->name}} </td>
                                            <td> <a href="/admin/instansi/{{$c->instance_id}} " style="color: black">{{$c->instance->nama_instansi}} </a></td>
                                            <td> {{$c->phone_number}} </td>
                                            <td> {{$c->email}} </td>
                                            <td>
                                                <a href="/admin/client/{{$c->id}}" class="badge bg-info mr-1"><i class="fa fa-eye"></i></a>

                                                <a href="#edit{{$c->id}}" class="badge bg-warning mr-1" data-toggle="modal"><i class="fas fa-pencil-alt"></i></a>

                                                <a>
                                                    <form autocomplete="off" action="/admin/client/{{ $c->id }}" method="POST" class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="badge bg-danger" onclick="return confirm('Yakin untuk menghapus data {{ $c->name }}?')">
                                                            <span class="fas fa-trash"></span>
                                                        </button>
                                                    </form>
                                                </a>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="edit{{ $c->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="card-header bg-orange">
                                                        <h3 class="card-title">Edit Data Klien</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <form action="/admin/client/{{ $c->id }}" method="POST" enctype="multipart/form-data">
                                                            @method('put')
                                                            @csrf
                                                            <div class="content">
                                                                <div class="form-group">
                                                                    <label for="seeAnotherFieldInstance">Pilih
                                                                        Instansi</label>
                                                                    <select class="form-select" aria-label="Disable"
                                                                        name="client_instance">
                                                                        <option hidden selected value="{{$c->instance->id}}">{{$c->instance->nama_instansi}}</option>
                                                                        @foreach ($instansi as $i)
                                                                            <option value="{{$i->id}}">{{$i->nama_instansi}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                    
                                                                <div class="form-group">
                                                                    <label for="seeAnotherFieldClient">Nama Klien</label>
                                                                    <input class="form-control" type="text" name="nama_klien" id="nama_klien" value="{{$c->name}}">
                                                                </div>
                                    
                                                                <div class="form-group">
                                                                    <label>email</label>
                                                                    <input name="email_klien" class="form-control" value="{{ $c->email }}">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Nomor Telepon</label>
                                                                    <input name="nomor_klien" class="form-control" value="{{ $c->phone_number }}">
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
                                    {{-- <tr>
                                        <td>1</td>
                                        <td>Pemerintah</td>
                                        <td>Dinas Teknologi dan Informasi Pontianak</td>
                                        <td>2</td>
                                        <td>
                                            <a href="/admin/instansi/detail" class="badge bg-info mr-1"><i class="fa fa-eye"></i></a>
                                            <a href="#" class="badge bg-warning mr-1"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="#" class="badge bg-danger mr-1"><i class="fa fa-eraser"></i></a>
                                        </td>
                                    </tr> --}}
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

{{-- Ini untuk fitur edit tapi belum bisa ambil id postingannya, harus pake javascript --}}
{{-- <div class="modal fade" id="add-data">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="card-header bg-orange">
                <h3 class="card-title">Edit Data Instansi</h3>
            </div>
            <div class="card-body">
                <form action="/admin/instansi/{{}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="content">

                        <div class="form-group">
                            <label for="seeAnotherFieldInstance">Pilih Instansi</label>
                            <select class="form-select" aria-label="Disable" id="seeAnotherFieldInstance"
                                name="instansi_instance_id">
                                <option selected hidden>Pilih Instansi</option>
                                @foreach ($instance as $i)
                                    <option value="{{ $i->id }}"> {{ $i->nama_instansi }} </option>
                                @endforeach
                                <option value="yes"> Tambah Instansi Baru </option>
                            </select>

                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label>Nama Instansi</label>
                                <input name="instansi_namainstansi" class="form-control"
                                    value="{{ old('instansi_namainstansi') }}">
                            </div>
                            <div class="form-group">
                                <label>Alamat Instansi</label>
                                <input name="instansi_alamatinstansi" class="form-control"
                                    value="{{ old('instansi_alamatinstansi') }}">
                            </div>

                            <div class="form-group">
                                <label>Kota Instansi</label>
                                <input name="instansi_kotainstansi" class="form-control"
                                    value="{{ old('instansi_kotainstansi') }}">
                            </div>

                            <div class="form-group">
                                <label>Jenis Instansi</label>
                                <input name="instansi_jenisinstansi" class="form-control"
                                    value="{{ old('instansi_jenisinstansi') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-success float-right">Save Data</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.modal-content -->
</div> --}}
@endsection
@section('footer')
@endsection

@endsection
