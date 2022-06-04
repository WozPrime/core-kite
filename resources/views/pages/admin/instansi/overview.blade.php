@extends('pages.ui_admin.admin')
@section('title')
    Overview Instansi
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
                <h1 class="m-0">Overview Instansi</h1>
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
                            <h3 class="card-title">Tabel Instansi</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="myTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Instansi</th>
                                        <th>Nama Instansi</th>
                                        <th>Kota Instansi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($instance as $i)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td> {{$i->instances_model->jenis_instansi}} </td>
                                            <td> {{$i->nama_instansi}} </td>
                                            <td> {{$i->kota_instansi}} </td>
                                            <td><a href="/admin/instansi/{{$i->id}}" class="badge bg-info mr-1"><i class="fa fa-eye"></i></a>
                                                <a href="#edit{{$i->id}}" class="badge bg-warning mr-1" data-toggle="modal"><i class="fas fa-pencil-alt"></i></a>
                                                <a>
                                                    <form autocomplete="off" action="/admin/instansi/{{ $i->id }}" method="POST" class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="badge bg-danger" onclick="return confirm('Yakin untuk menghapus data {{ $i->nama_instansi }}?')">
                                                            <span class="fas fa-trash"></span>
                                                        </button>
                                                    </form>
                                                </a>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="edit{{ $i->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="card-header bg-orange">
                                                        <h3 class="card-title">Edit Data Klien : {{ $i->name }}</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <form autocomplete="off" action="/admin/instansi/{{ $i->id }}" method="POST" enctype="multipart/form-data">
                                                            @method('put')
                                                            @csrf
                                                            <div class="content">
                                                                
                                                                <div class="form-group">
                                                                    <label>Nama Instansi</label>
                                                                    <input type="text" name="namainstansi" class="form-control" value="{{ $i->nama_instansi }}" required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Alamat Instansi</label>
                                                                    <textarea class="form-control" name="alamatinstansi" id="alamatinstansi" cols="30" rows="3">{{$i->alamat_instansi}}</textarea>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Kota Instansi</label>
                                                                    <input type="text" class="form-control" name="kotainstansi" id="kotainstansi" value="{{$i->kota_instansi}}" required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Jenis Instansi</label>
                                                                    <select name="jenisinstansi" class="form-control" value="{{$i->instances_model->jenis_instansi}}" >
                                                                        <option value="1" @if ($i->instances_model->jenis_instansi == 'Pemerintah') selected @endif>Pemerintah</option>
                                                                        <option value="2" @if ($i->instances_model->jenis_instansi == 'Swasta') selected @endif>Swasta</option>
                                                                        <option value="3" @if ($i->instances_model->jenis_instansi == 'Perorangan') selected @endif>Perorangan</option>
                                                                    </select>
                                                                </div>
                                        
                                                                <div class="form-group">
                                                                    <label>Logo Instansi</label>
                                                                    <div>
                                                                        <input type="file" name="logoinstansi" id="logoinstansi">
                                                                        <div class="text-danger">
                                                                            @error('logoinstansi')
                                                                                {{ $message }}
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>

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
