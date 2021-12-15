@extends('pages.ui_admin.admin')
@section('title')
    Tabel Proyek
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
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
                            <table class="table table-responsive-sm table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th style="text-align: center" width="2%">No</th>
                                        <th class="col-4">Project Name</th>
                                        <th class="col-1">Project Code</th>
                                        <th class="col-1">Status</th>
                                        <th class="col-1">Kategori</th>
                                        <th class="col-2">Progress</th>
                                        <th width="10%" style="text-align: center">Action</th>
                                    </tr>
                                </thead>
                                <tbody height>
                                    @foreach ($data as $tbl_project)
                                        <tr>
                                            <td style="text-align: center">{{ $loop->iteration }}</td>
                                            <td>{{ $tbl_project->project_name }}</td>
                                            <td>{{ $tbl_project->project_code }}</td>
                                            <td style="text-align: center">
                                                <span class="badge @if ($tbl_project->project_status == 'Baru') bg-primary
                                                    @elseif ($tbl_project->project_status == 'Tertunda') bg-danger
                                                    @elseif ($tbl_project->project_status == 'Sedang Berjalan') bg-warning
                                                    @elseif ($tbl_project->project_status == 'Selesai') bg-success @endif">
                                                    {{ $tbl_project->project_status }}
                                                </span>
                                            </td>
                                            <td>{{ $tbl_project->project_category }}</td>
                                            <td></td>
                                            <td style="text-align: center">
                                                <a class="btn btn-primary mr-1" href="/admin/proyek/{{ $tbl_project->id }}"><i
                                                        class="fa fa-eye"></i></a>
                                                <a class="btn btn-success mr-1" data-toggle="modal"
                                                    href="#edit{{ $tbl_project->id }}"><i class="fa fa-edit"></i></a>
                                                <a>
                                                    <form autocomplete="off" action="/admin/proyek/{{ $tbl_project->id }}" method="POST" class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <a class="btn btn-danger" onclick="return confirm('Yakin untuk menghapus data {{ $tbl_project->project_name }}?')">
                                                            <span class="fa fa-trash"></span>
                                                        </a>
                                                    </form>
                                                </a>
                                            </td>
                                        </tr>
                                        <!-- /.modal -->
                                        <div class="modal fade" id="edit{{ $tbl_project->id }}">
                                            <div class="modalphp-dialog">
                                                <div class="modal-content">
                                                    <div class="card-header bg-orange">
                                                        <h3 class="card-title">Edit Proyek {{ $tbl_project->project_name }}</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <form autocomplete="off" action="/admin/proyek/{{ $tbl_project->id }}" method="POST" enctype="multipart/form-data">
                                                            @method('put')
                                                            @csrf
                                                            <div class="content">
                                                                <div class="form-group">
                                                                    <label for="seeAnotherFieldInstance">Pilih
                                                                        Instansi</label>
                                                                    <select class="form-select" aria-label="Disable" name="instance_id" required>
                                                                            <option selected hidden value="{{ $tbl_project->instance_id }}">{{ $tbl_project->instance->nama_instansi }}</option>
                                                                        @foreach ($instansi as $i)
                                                                            <option value="{{ $i->id }}">
                                                                                {{ $i->nama_instansi }} </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                    
                                                                <div class="form-group">
                                                                    <label for="seeAnotherFieldClient">Pilih Klien</label>
                                                                    <select class="form-select" name="client_id" required>
                                                                        <option selected hidden value="{{ $tbl_project->client_id }}">{{ $tbl_project->client->name }}</option>
                                                                        @foreach ($klien as $k)
                                                                            <option value=" {{ $k->id }} ">{{ $k->name }} </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                    
                                                                <div class="form-group">
                                                                    <label>Kode Proyek</label>
                                                                    <input name="project_code" class="form-control" value="{{ $tbl_project->project_code }}">
                                                                </div>
                                    
                                                                <div class="form-group">
                                                                    <label>Nama Proyek</label>
                                                                    <input name="project_name" class="form-control" value="{{ $tbl_project->project_name }}">
                                                                    <div class="text-danger">
                                                                        @error('project_name')
                                                                            {{ $message }}
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                    
                                                                <div class="form-group">
                                                                    <label for="seeAnotherFieldClient">Pilih Kategori Proyek</label>
                                                                    <select class="form-select" name="project_category" required>
                                                                        <option selected hidden value="{{ $tbl_project->project_category }}">{{ $tbl_project->project_category }}</option>
                                                                            <option value="Web">Web</option>
                                                                            <option value="Mobile App">Mobile App</option>
                                                                    </select>
                                                                </div>
                                    
                                                                <div class="form-group">
                                                                    <label>Detail Proyek</label>
                                                                    <textarea name="project_detail" class="form-control" type="date" >{{ $tbl_project->project_detail }}</textarea>
                                                                </div>
                                    
                                                                <div class="form-group">
                                                                    <label for="seeAnotherFieldClient">Pilih Status Proyek</label>
                                                                    <select class="form-select" name="project_status" required>
                                                                        <option selected hidden value="{{ $tbl_project->project_status }}">{{ $tbl_project->project_status }}</option>
                                                                            <option value="Baru">Baru</option>
                                                                            <option value="Sedang Berjalan">Sedang Berjalan</option>
                                                                            <option value="Tertunda">Tertunda</option>
                                                                            <option value="Selesai">Selesai</option>
                                                                    </select>
                                                                </div>
                                    
                                                                <div class="form-group">
                                                                    <label>Starting Date</label>
                                                                    <input name="project_start_date" class="form-control" type="date" value="{{ $tbl_project->project_start_date }}">
                                                                </div>
                                    
                                                                <div class="form-group">
                                                                    <label>Deadline</label>
                                                                    <input name="project_deadline" class="form-control" type="date" value="{{ $tbl_project->project_deadline }}">
                                                                </div>
                                    
                                                                <div>
                                                                    <label>Total Project</label>
                                                                    <input class="input-currency form-control" type="text" type-currency="IDR" placeholder="Rp" name="project_value" value="{{ $tbl_project->project_value }}">
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
                        <!-- /.card-body -->
                        <!-- /.card -->
                        <!-- /.card-body -->
                        <div class="action" onclick="actionToggle();">
                            <span>+</span>
                            <ul>
                                <li data-toggle="modal" data-target="#add-instance">Tambah Instansi Baru</li>
                                <li data-toggle="modal" data-target="#add-client">Tambah Klien Baru</li>
                                <li data-toggle="modal" data-target="#add-data">Tambah Proyek Baru</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="add-instance">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="card-header bg-orange">
                        <h3 class="card-title">Add New Instansi</h3>
                    </div>
                    <div class="card-body">
                        <form autocomplete="off" action="/admin/instansi/" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="content">
    
                                <div class="form-group">
                                    <label>Nama Instansi</label>
                                    <input required name="instance_name" class="form-control">
                                </div>
    
                                <div class="form-group">
                                    <label for="seeAnotherFieldClient">Alamat Klien</label>
                                    <textarea name="instance_address" id="instance_address" class="form-control" cols="30" rows="3" placeholder="Isikan Alamat Instansi Disini"></textarea>
                                </div>
    
                                <div class="form-group">
                                    <label>Kota Instansi</label>
                                    <input name="instance_city" class="form-control" required>
                                </div>
    
                                <div class="form-group">
                                    <label>Jenis Instansi</label>
                                    <select name="instance_model" id="instance_model" class="form-select" required>
                                        <option value="" selected hidden>Pilih Jenis Instansi</option>
                                        @foreach ($modelinstansi as $m)
                                            <option value="{{$m->id}}">{{$m->jenis_instansi}}</option>
                                        @endforeach
                                    </select>
                                </div>
    
                                <div class="form-group my-2">
                                    <label for="instance_logo">Logo Instansi</label>
                                    <br>
                                    <input type="file" name="instance_logo" id="instance_logo" onchange="Image_preview(event)">
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
    
        <div class="modal fade" id="add-client">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="card-header bg-orange">
                        <h3 class="card-title">Add New Client</h3>
                    </div>
                    <div class="card-body">
                        <form autocomplete="off" action="/admin/client/" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="content">
    
                                <div class="form-group">
                                    <label>Nama Klien</label>
                                    <input name="client_name" class="form-control" id="client_name" required>
                                </div>
    
                                <div class="form-group">
                                    <label>Pilih Instansi</label>
                                    <select class="form-select" aria-label="Disable"
                                        name="client_instance" required>
                                        <option selected hidden value="">Pilih Instansi</option>
                                        @foreach ($instansi as $i)
                                            <option value="{{ $i->id }}">
                                                {{ $i->nama_instansi }} </option>
                                        @endforeach
                                    </select>
                                </div>
    
                                <div class="form-group">
                                    <label>Email Klien</label>
                                    <input type="email" name="client_email" class="form-control" required>
                                </div>
    
                                <div class="form-group">
                                    <label>Nomor Telepon</label>
                                    <input name="client_phone_number" class="form-control" required>
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
    
        <div class="modal fade" id="add-data">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="card-header bg-orange">
                        <h3 class="card-title">Menambah Data proyek</h3>
                    </div>
                    <div class="card-body">
                        <form autocomplete="off" action="/admin/proyek/" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="content">
    
                                <div class="form-group">
                                    <label for="seeAnotherFieldInstance">Pilih Instansi</label>
                                    <select class="form-select" aria-label="Disable" name="instance_id" onchange="pilihInstansi()" id="instance_id" required>
                                        <option selected hidden>Pilih Instansi</option>
                                        @foreach ($instansi as $i)
                                            <option value="{{ $i->id }}">
                                                {{ $i->nama_instansi }} </option>
                                        @endforeach
                                    </select>
                                </div>
    
                                <div class="form-group">
                                    <label for="seeAnotherFieldClient">Pilih Klien</label>
                                   
                                    <select class='form-select' name='client_id' id='client_id' required>
                                    </select>
                                    {{-- <div id='listClient'> --}}
    
                                    {{-- </div> --}}
                                </div>
    
                                <div class="form-group">
                                    <label>Kode Proyek</label>
                                    <input name="project_code" class="form-control" required>
                                </div>
    
                                <div class="form-group">
                                    <label>Name Proyek</label>
                                    <input name="project_name" class="form-control" required>
                                    <div class="text-danger">
                                        @error('project_name')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
    
                                <div class="form-group">
                                    <label for="seeAnotherFieldClient">Pilih Kategori Proyek</label>
                                    <select class="form-select" name="project_category" required>
                                        <option selected hidden> Pilih Kategori </option>
                                            <option value="Web">Web</option>
                                            <option value="Mobile App">Mobile App</option>
                                    </select>
                                </div>
    
                                <div class="form-group">
                                    <label>Detail Proyek</label>
                                    <textarea name="project_detail" class="form-control" type="date" required></textarea>
                                </div>
    
                                <div class="form-group">
                                    <label for="seeAnotherFieldClient">Pilih Status Proyek</label>
                                    <select class="form-select" name="project_status" required>
                                        <option selected hidden> Pilih Status </option>
                                            <option value="Baru">Baru</option>
                                            <option value="Sedang Berjalan">Sedang Berjalan</option>
                                            <option value="Tertunda">Tertunda</option>
                                            <option value="Selesai">Selesai</option>
                                    </select>
                                </div>
    
                                <div class="form-group">
                                    <label>Starting Date</label>
                                    <input name="project_start_date" class="form-control" type="date" required>
                                </div>
    
                                <div class="form-group">
                                    <label>Deadline</label>
                                    <input name="project_deadline" class="form-control" type="date" required>
                                </div>
    
                                <div>
                                    <label>Total Project</label>
                                    <input class="input-currency form-control" type="text" type-currency="IDR" placeholder="Rp" name="project_value" required>
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
    </section>
    <!-- /.content -->

@section('footer')
@endsection
<script>
    function pilihInstansi() {
    var data = 'id=' +document.getElementById('instance_id').value;

    var baris = "";
    $.ajax({
      url: "{{ route('clientData') }}",
      data: data,
      cache: false,
      dataType: 'json',
      success: function(data) {
        //   alert(response.message);
        for (var i = 0; i < data.length; i++) {
            baris += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
        }
        // baris = baris + '</select>'
        // if(typeof(document.getElementById('selectDefault') != 'undefined' && document.getElementById('selectDefault') != null)){
        //     document.getElementById('selectDefault').remove();
        // }
        $('#client_id').html(baris);
      }
    });
    return false;
  }
</script>

<script type="text/javascript">
    function actionToggle() {
        var action = document.querySelector('.action')
        action.classList.toggle('active')
    }
</script>
@endsection
