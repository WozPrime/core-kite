@extends('pages.ui_admin.admin')
@section('title')
    Tabel Proyek
@endsection
{{-- <style>
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
</style> --}}

<style>
    * {
        margin: 0;
        padding: 0;

    }

    .action {
        width: 50px;
        height: 50px;
        background: var(--white);
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        border-radius: 50%;
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.25);
        position: fixed;
        right: 20px;
        bottom: 20px;
        transition: background 0.25s;

        /* button */
        outline: gray;
        border: none;
        cursor: pointer;

        /*
        position: fixed;
        bottom: 50px;
        left: 1800px;
        width: 50px;
        height: 50px;
        background: #fff;
        border-radius: 50%;
        cursor: pointer;
        box-shadow: 0 5px 5px rgba(0,0,0,0.1);
        */
    }

    .action span {
        position: relative;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #a13dea;
        font-size: 2em;
        transition: 0.3s ease-in-out;
    }

    .action.active span {
        transform: rotate(135deg);
    }

    .action ul {
        position: fixed;
        bottom: 55px;
        right: 20px;
        background: #fff;
        min-width: 250px;
        padding: 20px;
        border-radius: 20px;
        opacity: 0;
        visibility: hidden;
        transition: 0.3s;
    }

    .action.active ul {
        bottom: 65px;
        opacity: 1;
        visibility: visible;
        transition: 0.3s;
    }

    .action ul li {
        list-style: none;
        display: flex;
        justify-content: flex-start;
        align-items: center;
        padding: 10px 0;
        transition: 0.3s;
    }

    .action ul li:hover {
        font-weight: 600;
    }

    .action ul li:not(:last-child) {
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
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
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title pt-1">List of Projects</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool pt-3" data-card-widget="collapse"
                                    title="Collapse">
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
                                            <td>{{ $tbl_project->project_status }}</td>
                                            <td>{{ $tbl_project->project_category }}</td>
                                            <td></td>
                                            <td style="text-align: center">
                                                <a class="btn btn-primary" href="/admin/proyek/{{ $tbl_project->id }}"><i
                                                        class="fa fa-eye"></i></a>
                                                <a class="btn btn-success" data-toggle="modal"
                                                    href="#edit{{ $tbl_project->id }}"><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-danger" data-toggle="modal"
                                                    href="#delete{{ $tbl_project->id }}"><i
                                                        class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <!-- /.modal -->
                                        <div class="modal fade" id="edit{{ $tbl_project->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="card-header bg-orange">
                                                        <h3 class="card-title">Edit Project Detail</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <form action="/admin/proyek/" method="post"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="content">

                                                                <div class="form-group">
                                                                    <label for="seeAnotherFieldInstance">Pilih
                                                                        Instansi</label>
                                                                    <select class="form-select" aria-label="Disable"
                                                                        name="instansi_instance_id">
                                                                        <option selected hidden>Pilih Instansi</option>
                                                                        @foreach ($instansi as $i)
                                                                            <option value="{{ $i->id }}">
                                                                                {{ $i->nama_instansi }} </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="seeAnotherFieldClient">Pilih Klien</label>
                                                                    <select class="form-select" name="klien_pilihklien">
                                                                        <option selected hidden> Pilih Klien </option>
                                                                        @foreach ($klien as $k)
                                                                            <option value=" {{ $k->id }} ">
                                                                                {{ $k->name }} </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Project Code</label>
                                                                    <input name="project_code" class="form-control"
                                                                        value="{{ old('project_code') }}">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Project Name</label>
                                                                    <input name="project_name" class="form-control"
                                                                        value="{{ old('project_name') }}">
                                                                    <div class="text-danger">
                                                                        @error('project_name')
                                                                            {{ $message }}
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Starting Date</label>
                                                                    <input name="project_start_date" class="form-control"
                                                                        type="date"
                                                                        value="{{ old('project_start_date') }}">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Deadline</label>
                                                                    <input name="project_deadline" class="form-control"
                                                                        type="date"
                                                                        value="{{ old('project_deadline') }}">
                                                                </div>

                                                                <div>
                                                                    <label>Total Project</label>
                                                                    <input class="input-currency form-control" type="text"
                                                                        type-currency="IDR" placeholder="Rp" />
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
                                        <div class="modal fade" id="delete{{ $tbl_project->id }}">
                                            <form action="/admin/proyek/{{ $tbl_project->id }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <div class="modal-dialog">
                                                    <div class="modal-content bg-danger">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Hapus Data User</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah anda yakin ingin Menghapus data dari
                                                            {{ $tbl_project->project_name }} ini?
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-outline-light"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-outline-light">Hapus Data</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <!-- /.card -->
                        <!-- /.card-body -->
                        <div class="action" onclick="actionToggle();">
                            <span>+</span>
                            <ul>
                                <li>Tambah Instansi Baru</li>
                                <li>Tambah Klien Baru</li>
                                <li data-toggle="modal" data-target="#add-data">Tambah Proyek Baru</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
    <div class="modal fade" id="add-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card-header bg-orange">
                    <h3 class="card-title">Add New Project</h3>
                </div>
                <div class="card-body">
                    <form action="/admin/proyek/" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="content">

                            <div class="form-group">
                                <label for="seeAnotherFieldInstance">Pilih
                                    Instansi</label>
                                <select class="form-select" aria-label="Disable"
                                    name="instance_id">
                                    <option selected hidden>Pilih Instansi</option>
                                    @foreach ($instansi as $i)
                                        <option value="{{ $i->id }}">
                                            {{ $i->nama_instansi }} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="seeAnotherFieldClient">Pilih Klien</label>
                                <select class="form-select" name="client_id">
                                    <option selected hidden> Pilih Klien </option>
                                    @foreach ($klien as $k)
                                        <option value=" {{ $k->id }} ">
                                            {{ $k->name }} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Kode Proyek</label>
                                <input name="project_code" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Name Proyek</label>
                                <input name="project_name" class="form-control">
                                <div class="text-danger">
                                    @error('project_name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="seeAnotherFieldClient">Pilih Kategori Proyek</label>
                                <select class="form-select" name="project_category">
                                    <option selected hidden> Pilih Klien </option>
                                        <option value="Web">Web</option>
                                        <option value="Mobile App">Mobile App</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Detail Proyek</label>
                                <textarea name="project_detail" class="form-control"
                                    type="date"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="seeAnotherFieldClient">Pilih Kategori Proyek</label>
                                <select class="form-select" name="project_status">
                                    <option selected hidden> Pilih Klien </option>
                                        <option value="Sedang Berjalan">Sedang Berjalan</option>
                                        <option value="Tertunda">Tertunda</option>
                                        <option value="Selesai">Selesai</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Starting Date</label>
                                <input name="project_start_date" class="form-control"
                                    type="date">
                            </div>

                            <div class="form-group">
                                <label>Deadline</label>
                                <input name="project_deadline" class="form-control"
                                    type="date">
                            </div>

                            <div>
                                <label>Total Project</label>
                                <input class="input-currency form-control" type="text"
                                    type-currency="IDR" placeholder="Rp" name="project_value">
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
    



@section('footer')
@endsection
<script type="text/javascript">
    function actionToggle() {
        var action = document.querySelector('.action')
        action.classList.toggle('active')
    }
</script>
@endsection
