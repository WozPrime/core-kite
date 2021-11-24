@extends('pages.ui_admin.admin')

@section('title')
Edit Data Instansi
@endsection

@section('body')
@section('navbar')
@endsection

@section('sidebar')
@endsection

@section('content')
<div class="container pt-3">
    <div class="main-body">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="d-flex flex-column align-items-center text-center mb-5">
                                @if ($instance->logo_instansi)
                                <img src="/logoinstansi/logo{{$instance->logo_instansi}}.jpg" alt="">
                                @else
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a2/Logo_of_Ministry_of_Communication_and_Information_Technology_of_the_Republic_of_Indonesia.svg/1024px-Logo_of_Ministry_of_Communication_and_Information_Technology_of_the_Republic_of_Indonesia.svg.png" alt="Logo Instansi"
                                @endif
                                    class="rounded-circle" width="150">
                            </div>
                            <div class="col-sm-3 pt-1">
                                <h6 class="mb-0">Nama Instansi</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                : {{$instance->nama_instansi}}
                            </div>
                        </div> 
                        <hr>
                        <div class="row pb-xl-4">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Alamat</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                : {{$instance->alamat_instansi}}
                            </div>
                        </div>
                        <hr>
                        <div class="row pb-xl-4">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Kota Instansi</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                : {{$instance->kota_instansi}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Jenis Instansi</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                : {{$instance->instances_model->jenis_instansi}}
                            </div>
                        </div>
                        
                        <hr>
                        <div class="row">
                            <div class="col-sm-12 pb-1 pt-4">
                                <a class="btn btn-rounded bg-primary mb-1" data-toggle="modal" data-target="#edit-data-instansi"> Edit</a>
                            </div>
                        </div>
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
                <form action="/admin/klien/{{$instance->id}}" method="POST" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="content">
                        <div class="form-group">
                            <label>Nama Instansi</label>
                            <input name="namainstansi" class="form-control" value="{{ $instance->nama_instansi }}" required>
                            <div class="text-danger">
                                @error('namainstansi')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Alamat Instansi</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="alamatinstansi"> {{$instance->alamat_instansi}} </textarea>
                        </div>

                        <div class="form-group">
                            <label>Kota Instansi</label>
                            <input name="kotainstansi" class="form-control" value="{{ $instance->nama_instansi }}" required>
                            <div class="text-danger">
                                @error('namainstansi')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Jenis Instansi</label>
                            <select name="jenisinstansi" class="form-control" value="{{$instance->instances_model->jenis_instansi}}" >
                                <option value="1" @if ($instance->instances_model->jenis_instansi == 'Pemerintah') selected @endif>Pemerintah</option>
                                <option value="2" @if ($instance->instances_model->jenis_instansi == 'Swasta') selected @endif>Swasta</option>
                                <option value="3" @if ($instance->instances_model->jenis_instansi == 'Perorangan') selected @endif>Perorangan</option>
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
                            <button class="btn btn-success float-right">Save Data</button>
                        </div>
                    </div>
            </div>
        </div>
        </form>
    </div>
    <!-- /.modal-content -->
</div>

@endsection

@section('footer')
@endsection

@endsection
