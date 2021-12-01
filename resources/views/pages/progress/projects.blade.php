@extends('pages.ui_admin.admin')
@section('title')
    Tabel Proyek
@endsection
<style>
    .floating-btn {
        width: 50px;
        height: 50px;
        background: var(--gray-dark);
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        border-radius: 50%;
        color: var(--white);
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.25);
        position: fixed;
        right: 20px;
        bottom: 20px;
        transition: background 0.25s;

        /* button */
        outline: gray;
        border: none;
        cursor: pointer;
    }

    .floating-btn:hover {
        color: lawngreen;
    }

    .floating-btn:active {
        background: var(--gray);
    }

</style>
@section('body')
@section('navbar')
@endsection
@section('sidebar')
@endsection
@section('content')
    {{-- content --}}
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Projects</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                        <li class="breadcrumb-item active">Projects</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-lime">
                        <div class="card-header">
                            <h3 class="card-title pt-1">List of Projects</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-responsive-sm table-bordered" id="myTable" width="100%">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">No</th>
                                        <th class="col-3">Project Name</th>
                                        <th class="col-1">Project Code</th>
                                        <th class="col-2">Status</th>
                                        <th class="col-2">Kategori</th>
                                        <th class="col-2">Progress</th>
                                        <th width="10%" style="text-align: center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $tbl_project)
                                        <tr>
                                            <td style="text-align: center">{{ $loop->iteration }}</td>
                                            <td>{{ $tbl_project->project_name }}</td>
                                            <td>{{ $tbl_project->project_code }}</td>
                                            <td></td>
                                            <td>{{ $tbl_project->project_category }}</td>
                                            <td></td>
                                            <td style="text-align: center">

                                                <a class="btn btn-primary"
                                                    href="/admin/proyek/{{ $tbl_project->project_id }}"><i
                                                        class="fa fa-eye"></i></a>
                                                <a class="btn btn-success" data-toggle="modal"
                                                    href="#edit{{ $tbl_project->project_id }}"><i
                                                        class="fa fa-edit"></i></a>
                                                <a class="btn btn-danger" data-toggle="modal"
                                                    href="#delete{{ $tbl_project->project_id }}"><i
                                                        class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <!-- /.modal -->
                                        <div class="modal fade" id="edit{{ $tbl_project->project_id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="card-header bg-orange">
                                                        <h3 class="card-title">Add New Project Data</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <form action="/admin/projects/" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="content">
                                    
                                                                <div class="form-group">
                                                                    <label for="seeAnotherFieldInstance">Pilih Instansi</label>
                                                                    <select class="form-select" aria-label="Disable" id="seeAnotherFieldInstance"
                                                                        name="instansi_instance_id">
                                                                        <option selected hidden>Pilih Instansi</option>
                                                                        @foreach ($instansi as $i)
                                                                            <option value="{{ $i->id }}"> {{ $i->nama_instansi }} </option>
                                                                        @endforeach
                                                                        <option value="yes"> Tambah Instansi Baru </option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group" id="otherFieldDivInstance">
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
                                    
                                                                <hr style="height:5px">
                                    
                                                                <div class="form-group">
                                                                    <label for="seeAnotherFieldClient">Pilih Klien</label>
                                                                    <select class="form-select" name="klien_pilihklien" id="seeAnotherFieldClient">
                                                                        <option selected hidden> Pilih Klien </option>
                                                                        @foreach ($klien as $k)
                                                                            {{-- @if ($k->id = $ambilId) --}}
                                    
                                                                                <option value=" {{ $k->id }} "> {{ $k->name }} </option>
                                                                            {{-- @endif --}}
                                                                        @endforeach
                                    
                                                                        <option value="yes"> Tambah Klien Baru </option>
                                                                    </select>
                                                                </div>
                                    
                                                                <div class="form-group" id="otherFieldDivClient">
                                                                    <div class="form-group">
                                                                        <label>ID_instansi</label>
                                                                        <input name="klien_idinstansi" class="form-control"
                                                                            value="{{ old('klien_idinstansi') }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Nama Klien</label>
                                                                        <input name="klien_namaklien" class="form-control"
                                                                            value="{{ old('klien_namaklien') }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Email Klien</label>
                                                                        <input name="klien_emailklien" class="form-control"
                                                                            value="{{ old('klien_emailklien') }}">
                                                                    </div>
                                    
                                                                    <div class="form-group">
                                                                        <label>Nomor Telepon Klien</label>
                                                                        <input name="klien_nomorteleponklien" class="form-control"
                                                                            value="{{ old('klien_nomorteleponklien') }}">
                                                                    </div>
                                                                </div>
                                    
                                                                <hr style="height:5px">
                                    
                                                                <div class="form-group">
                                                                    <label>Project Code</label>
                                                                    <input name="project_code" class="form-control" value="{{ old('project_code') }}">
                                                                </div>
                                    
                                                                <div class="form-group">
                                                                    <label>Project Name</label>
                                                                    <input name="project_name" class="form-control" value="{{ old('project_name') }}">
                                                                    <div class="text-danger">
                                                                        @error('project_name')
                                                                            {{ $message }}
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                    
                                                                <div class="form-group">
                                                                    <label>Starting Date</label>
                                                                    <input name="project_start_date" class="form-control"
                                                                        value="{{ old('project_start_date') }}">
                                                                </div>
                                    
                                                                <div class="form-group">
                                                                    <label>Deadline</label>
                                                                    <input name="project_deadline" class="form-control"
                                                                        value="{{ old('project_deadline') }}">
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
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    <!-- /.card-body -->
                    <!-- /.card -->
                    <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
    <button class="material-icons floating-btn" data-toggle="modal" data-target="#add-data">add</button>
    <div class="modal fade" id="add-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card-header bg-orange">
                    <h3 class="card-title">Add New Project Data</h3>
                </div>
                <div class="card-body">
                    <form action="/admin/projects/" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="content">

                            <div class="form-group">
                                <label for="seeAnotherFieldInstance">Pilih Instansi</label>
                                <select class="form-select" aria-label="Disable" id="seeAnotherFieldInstance"
                                    name="instansi_instance_id">
                                    <option selected hidden>Pilih Instansi</option>
                                    @foreach ($instansi as $i)
                                        <option value="{{ $i->id }}"> {{ $i->nama_instansi }} </option>
                                    @endforeach
                                    <option value="yes"> Tambah Instansi Baru </option>
                                </select>
                            </div>
                            <div class="form-group" id="otherFieldDivInstance">
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

                            <hr style="height:5px">

                            <div class="form-group">
                                <label for="seeAnotherFieldClient">Pilih Klien</label>
                                <select class="form-select" name="klien_pilihklien" id="seeAnotherFieldClient">
                                    <option selected hidden> Pilih Klien </option>
                                    @foreach ($klien as $k)
                                        {{-- @if ($k->id = $ambilId) --}}

                                            <option value=" {{ $k->id }} "> {{ $k->name }} </option>
                                        {{-- @endif --}}
                                    @endforeach

                                    <option value="yes"> Tambah Klien Baru </option>
                                </select>
                            </div>

                            <div class="form-group" id="otherFieldDivClient">
                                <div class="form-group">
                                    <label>ID_instansi</label>
                                    <input name="klien_idinstansi" class="form-control"
                                        value="{{ old('klien_idinstansi') }}">
                                </div>
                                <div class="form-group">
                                    <label>Nama Klien</label>
                                    <input name="klien_namaklien" class="form-control"
                                        value="{{ old('klien_namaklien') }}">
                                </div>
                                <div class="form-group">
                                    <label>Email Klien</label>
                                    <input name="klien_emailklien" class="form-control"
                                        value="{{ old('klien_emailklien') }}">
                                </div>

                                <div class="form-group">
                                    <label>Nomor Telepon Klien</label>
                                    <input name="klien_nomorteleponklien" class="form-control"
                                        value="{{ old('klien_nomorteleponklien') }}">
                                </div>
                            </div>

                            <hr style="height:5px">

                            <div class="form-group">
                                <label>Project Code</label>
                                <input name="project_code" class="form-control" value="{{ old('project_code') }}">
                            </div>

                            <div class="form-group">
                                <label>Project Name</label>
                                <input name="project_name" class="form-control" value="{{ old('project_name') }}">
                                <div class="text-danger">
                                    @error('project_name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Starting Date</label>
                                <input name="project_start_date" class="form-control"
                                    value="{{ old('project_start_date') }}">
                            </div>

                            <div class="form-group">
                                <label>Deadline</label>
                                <input name="project_deadline" class="form-control"
                                    value="{{ old('project_deadline') }}">
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
    </div>
    <!-- /.content -->

@section('footer')
@endsection
@endsection
