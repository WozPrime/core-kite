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
                                    <b class="text-secondary-bold"> {{$data->project_name}} </b>
                                    <p class="text-muted font-size-sm"> [{{$data->project_code}}] </p>
                                    <b class="text-secondary-bold"> Nilai Proyek </b>
                                    <p class="text-muted font-size-sm"> {{$data->project_value}} </p>
                                    <b class="text-secondary-bold"> Jenis Proyek </b>
                                    <p class="text-muted font-size-sm"> {{$data->project_category}} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mb-3" style="height: 375px">
                        <div class="card-header">
                            <h3 class="card-title">Detail Proyek</h3>
                        </div>
                        <div class="card-body">
                            <b class="text-secondary-bold"> Detail Proyek </b>
                            <p class="text-muted font-size-sm"> {{$data->project_detail}} </p>
                            <b class="text-secondary-bold"> Perkiraan Waktu Pengerjaan Proyek- </b>
                            <p class="text-muted font-size-sm"> {{$data->project_start_date}} s/d {{$data->project_deadline}} </p>
                            <p class="text-muted font-size-sm"> -total waktu- </p>
                            <b class="text-secondary-bold"> Klien </b>
                            <p class="text-muted font-size-sm"> {{$data->client->name}} </p>
                            <b class="text-secondary-bold"> Instansi </b>
                            <p class="text-muted font-size-sm"> {{$data->instance->nama_instansi}} </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gutters-sm">
                <div class="col-12">
                    <div class="card">
                        <div class="card card-orange">
                            <div class="card-header">
                                <h3 class="card-title text-light">Anggota Proyek</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form role="form" method="POST" enctype="multipart/form-data" id="formTambahAnggota">
                                    <div class="row">
                                        <div class="col-9">
                                            <div class="form-group no-border">
                                                <select name="id_karyawan" id="tambah-anggota" class="form-control select2">
                                                    <option value="10">Ahmad Syahroni, A. Md</option>
                                                    <option value="12">Dean El&#039;Ilmi Kasyaif Nasution, S. Kom</option>
                                                    <option value="13">David Hasibuan, S. Pd</option>
                                                    <option value="15">David Simarmata, S. Kom</option>
                                                    <option value="16">Indra Jatmika</option>
                                                    <option value="17">Leonardus Fernando, S.Kom</option>
                                                    <option value="18">Muhammad Sabiran, S.Kom</option>
                                                    <option value="19">Syarif Irfan Yudha Ardian, S.Kom</option>
                                                    <option value="20">Reno Anthus, S.Kom</option>
                                                    <option value="22">Rangga Saputra, A.Md</option>
                                                    <option value="23">Fathuzzikri, S.Kom</option>
                                                    <option value="25">Izza Ulfa Dwiyanti</option>
                                                    <option value="26">Andika Eka Putra</option>
                                                    <option value="27">Alvian Teddy Cahya Putra</option>
                                                    <option value="28">Alexander Hasibuan</option>
                                                    <option value="29">Ikhwan Ruslianto</option>
                                                    <option value="30">Parian Pilata</option>
                                                    <option value="31">Syahru</option>
                                                    <option value="32">Hendro Pratama</option>
                                                    <option value="33">Irvan Denata</option>
                                                    <option value="34">Weldi</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <button type="submit" class="btn btn-block btn-info">Tambah</button>
                                        </div>
                                    </div>
                                </form>
                                <table class="table table-bordered table-striped dt-responsive no-wrap" id="tAnggota">
                                    <thead>
                                        <tr>
                                            <th style="min-width: 50px; max-width: 50px;" class="text-center">No.</th>
                                            <th style="min-width: 35px; max-width: 35px;" class="text-center">Aksi</th>
                                            <th style="min-width: 150px; max-width: 150px;" class="text-center">Role & Hak
                                                Akses</th>
                                            <th class="text-center">Nama</th>
                                            <th style="min-width: 100px; max-width: 100px;" class="text-center">Foto</th>
                                        </tr>
                                    </thead>
                                    <tbody>

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

                            {{-- <div class="form-group">
                            <label>Logo Instansi</label>
                            <div>
                                <input type="file" name="logoinstansi" id="logoinstansi">
                                <div class="text-danger">
                                    @error('logoinstansi')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div> --}}

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
