@extends('pages.ui_admin.admin')
@section('title')
    Tabel Proyek
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
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
                    <h1>Proyek</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                        <li class="breadcrumb-item active">Proyek</li>
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
                            <h3 class="card-title pt-1">Daftar Proyek</h3>
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
                                        <th class="col-4">Nama Proyek</th>
                                        <th class="col-1">Kode Proyek</th>
                                        <th class="col-1">Status</th>
                                        <th class="col-1">Kategori</th>
                                        <th class="col-2">Persentase Proyek</th>
                                        <th width="11%" style="text-align: center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $tbl_project)
                                        <tr>
                                            <td style="text-align: center">{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="d-flex flex-column align-items-center text-center col-3">
                                                        @if ($tbl_project->project_logo)
                                                            <img src="/projectLogo/{{ $tbl_project->project_logo }}" alt="logo {{ $tbl_project->project_name }}"
                                                                class="border border-dark img-fluid img-circle" width="50px" height="50px">
                                                        @else
                                                            <img src="https://images.tokopedia.net/img/cache/215-square/shops-1/2021/7/27/11968180/11968180_a9344c7d-9e89-4310-8ce8-f7053152571c.jpg"
                                                                alt="Logo Instansi" class="border border-dark img-fluid img-circle" width="50px" height="50px">
                                                        @endif
                                                    </div>
                                                    <div class="col-9">
                                                        {{ $tbl_project->project_name }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $tbl_project->project_code }}</td>
                                            <td style="text-align: center">
                                                <span class="badge @if ($tbl_project->project_status == 'Baru') bg-primary
                                                    @elseif ($tbl_project->project_status == 'Tertunda') bg-danger
                                                    @elseif ($tbl_project->project_status == 'Dalam Pengerjaan') bg-warning
                                                    @elseif ($tbl_project->project_status == 'Selesai') bg-success @endif">
                                                    {{ $tbl_project->project_status }}
                                                </span>
                                            </td>
                                            <td>{{ $tbl_project->project_category }}</td>
                                            <td style="text-align: center">
                                                {{-- <div class="row"> --}}
                                                    <div 
                                                    @php
                                                    $pcount = $ptask->where('project_id', $tbl_project->id)->count('id');
                                                    $pstatus = $ptask->where('project_id', $tbl_project->id)->where('status', '==', 2)->count('id');
                                                    if($pcount == 0) {$progress = 0;}
                                                    elseif($pcount > 0) {$progress = floor(($pstatus / $pcount) * 100);}
                                                    @endphp 
                                                    @if($pcount == 0 && $tbl_project->project_status <> 'Selesai') class="badge bg-danger" 
                                                        {{-- @elseif ($pcount > 0 && $progress < 100 && $tbl_project->project_status <> 'Selesai')  class="progress progress-xs pb-3"  --}}
                                                        @elseif ($pcount > 0 && $progress < 100)  class="progress progress-xs pb-3" 
                                                        @elseif(($pcount == 0 && $tbl_project->project_status == 'Selesai') || ($pcount > 0 && $progress == 100 && $tbl_project->project_status == 'Selesai')) class="badge bg-success" 
                                                    @endif>
                                                    <div @if($pcount > 0 && $progress >= 0 && $progress < 25) class="progress-bar bg-danger pb-3"
                                                            @elseif($pcount > 0 && $progress >= 25 && $progress < 50) class="progress-bar bg-warning pb-3"
                                                            @elseif($pcount > 0 && $progress >= 50 && $progress < 75) class="progress-bar bg-primary pb-3"
                                                            @elseif($pcount > 0 && $progress >= 75 && $progress < 100) class="progress-bar bg-bar-success pb-3"
                                                        @endif
                                                        @if($pcount > 0 && $progress <= 25) style="background-color:red !important;width:{{ $progress }}%;"
                                                            @elseif($pcount > 0 && $progress >= 25 && $progress < 100) style="width:{{ $progress }}%"
                                                        @endif>
                                                        @if(($pcount == 0 && $tbl_project->project_status == 'Selesai') || ($pcount > 0 && $progress == 100 && $tbl_project->project_status == 'Selesai')) Proyek sudah selesai
                                                            @elseif($pcount == 0 && $tbl_project->project_status <> 'Selesai') Belum ada tugas yang disiapkan
                                                            @elseif($pcount > 0 && $progress == 100 && $tbl_project->project_status <> 'Selesai') Seluruh tugas proyek sudah terselesaikan
                                                        @endif
                                                    </div>
                                                </div>

                                                @if($pcount > 0 && $progress >= 0 && $progress < 100) <span class="badge 
                                                    @if($pcount > 0 && $progress >= 0 && $progress < 25) bg-danger float-left
                                                        @elseif($pcount > 0 && $progress >= 25 && $progress < 50) bg-warning 
                                                        @elseif($pcount > 0 && $progress >= 50 && $progress < 75) bg-primary 
                                                        @elseif($pcount > 0 && $progress >= 75 && $progress < 100) bg-success float-right
                                                    @endif col-2" 
                                                    @if($pcount > 0 && $progress >= 25 && $progress < 50) style="margin-right:130px"
                                                        @elseif($pcount > 0 && $progress > 50 && $progress <= 75) style="margin-left:130px"
                                                    @endif>{{ $progress }}%</span>
                                                @endif
                                                {{-- </div> --}}
                                            </td>
                                            <td style="text-align: center">
                                                <a class="btn btn-primary mr-1 mb-1" href="/admin/proyek/{{ $tbl_project->id }}"><i
                                                        class="fa fa-eye"></i></a>
                                                <a class="btn btn-success mr-1 mb-1" data-toggle="modal"
                                                    href="#edit{{ $tbl_project->id }}"><i class="fa fa-edit"></i></a>
                                                <form autocomplete="off" action="/admin/proyek/{{ $tbl_project->id }}" method="POST" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-danger" onclick="return confirm('Yakin untuk menghapus data {{ $tbl_project->project_name }}?')">
                                                        <span class="fa fa-trash"></span>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        <!-- /.modal -->
                                        <div class="modal fade" id="edit{{ $tbl_project->id }}">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="card-header bg-orange">
                                                        <h3 class="card-title">Edit Proyek {{ $tbl_project->project_name }}</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <form autocomplete="off" action="/admin/proyek/{{ $tbl_project->id }}" method="POST" enctype="multipart/form-data">
                                                            @method('put')
                                                            @csrf
                                                            <div class="content">
                                                                <div class="form-group row">
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label>Pilih Instansi</label>
                                                                            <select class="form-select" aria-label="Disable" name="instance_id" onchange="pilihInstansiEdit()" id="instance_id_edit" required>
                                                                                    <option selected hidden value="{{ $tbl_project->instance_id }}">{{ $tbl_project->instance->nama_instansi }}</option>
                                                                                @foreach ($instansi as $i)
                                                                                    <option value="{{ $i->id }}">
                                                                                        {{ $i->nama_instansi }} </option>
                                                                                @endforeach
                                                                            </select>
                                                                            @error('project_name')
                                                                                {{ $message }}
                                                                            @enderror
                                                                        </div>
                                            
                                                                        <div class="form-group">
                                                                            <label>Pilih Klien</label>
                                                                           
                                                                            <select class='form-select' name='client_id' id='client_id_edit' required>
                                                                                <option selected hidden value="{{ $tbl_project->client_id }}">{{ $tbl_project->client->name }}</option>
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
                                                                            <label>Pilih Kategori Proyek</label>
                                                                            <select class="form-select" name="project_category" required>
                                                                                <option selected hidden value="{{ $tbl_project->project_category }}">{{ $tbl_project->project_category }}</option>
                                                                                    <option value="Web">Web</option>
                                                                                    <option value="Aplikasi">Aplikasi</option>
                                                                                    <option value="Mobile App">Mobile App</option>
                                                                            </select>
                                                                        </div>
                                                                        
                                                                        <div class="form-group">
                                                                            <label>Detail Proyek</label>
                                                                            <textarea name="project_detail" class="form-control" >{{ $tbl_project->project_detail }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group" id="seeAnotherFieldStatus">
                                                                            <label for="seeAnotherFieldStatus">Pilih Status Proyek</label>
                                                                                <select class="form-select" name="project_status" id="project_status" required>
                                                                                <option selected hidden value="{{ $tbl_project->project_status }}">{{ $tbl_project->project_status }}</option>
                                                                                    <option value="Baru">Baru</option>
                                                                                    <option value="Dalam Pengerjaan">Dalam Pengerjaan</option>
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

                                                                        <div class="form-group" id="otherFieldStatus">
                                                                            <label for="otherFieldStatus">Finished Date</label>
                                                                            <input name="project_finished" id="project_finished" class="form-control" type="date" value="{{ $tbl_project->project_finished }}">
                                                                            {{-- @if($tbl_project->project_status == 'Selesai') 
                                                                            <input name="project_finished" id="project_finished" class="form-control" type="date" value="{{ $tbl_project->project_finished }}">
                                                                            @else <input name="project_finished" id="project_finished" class="form-control" type="date">                                                                        </div>
                                                                            @endif --}}
                                                                        </div>
                                            
                                                                        <div>
                                                                            <label>Total Project</label>
                                                                            <input class="input-currency form-control" type="text" type-currency="IDR" placeholder="Rp" name="project_value" value="{{ $tbl_project->project_value }}">
                                                                        </div>
                                            
                                                                        <div class="form-group my-2">
                                                                            <label>Logo Instansi</label>
                                                                            <input type="file" class="form-control" name="project_logo" id="project_logo" value="{{ $tbl_project->project_logo }}" onchange="Image_preview(event)">
                                                                        </div>
                                                                    </div>
                                                                </div>  

                                                                <br>
                                    
                                                                <div class="form-group">
                                                                    <button class="btn btn-success float-right">Simpan Data</button>
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
                        <h3 class="card-title">Tambah Data Instansi</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
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
                                    <label>Alamat Instansi</label>
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
                                    <input type="file" class="form-control" name="instance_logo" id="instance_logo" onchange="Image_preview(event)">
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
                        <h3 class="card-title">Tambah Data Klien</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
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
                                    <button class="btn btn-success float-right">Simpan Data</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="modal fade" id="add-data">
            <div class="modal-dialog" style="width:100%;max-width:1500px;">
                <div class="modal-content">
                    <div class="card-header bg-orange">
                        <h3 class="card-title">Menambah Data proyek</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <form autocomplete="off" action="/admin/proyek/" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="content">
    
                                <div class="form-group row">
                                    <div class="col-4">
                                        <div class="form-group" id="seeAnotherFieldInstance">
                                            <label for="seeAnotherFieldInstance">Pilih Instansi</label>
                                            <select class="form-select" aria-label="Disable" name="instance_id" onchange="pilihInstansi()" id="instance_id" required>
                                                <option selected hidden value="">Pilih Instansi</option>
                                                @foreach ($instansi as $i)
                                                    <option value="{{ $i->id }}">
                                                        {{ $i->nama_instansi }} </option>
                                                @endforeach
                                                <option value="yes">Tambah Instansi Baru</option>
                                            </select>
                                            @error('project_name')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                        
                                        <div id="otherFieldDivInstance">
                                            <div class="form-group">
                                                <label for="newnamainstansi">Nama Instansi</label>
                                                <input type="text" name="newnamainstansi" id="newnamainstansi" class="form-control" placeholder="Wajib Diisi">
                                            </div>
            
                                            <div class="form-group">
                                                <label for="newkotainstansi">Kota Instansi</label>
                                                <input type="text" name="newkotainstansi" id="newkotainstansi" class="form-control" placeholder="Wajib Diisi">
                                            </div>
            
                                            <div class="form-group">
                                                <label for="newjenisinstansi">Jenis Instansi</label>
                                                <select name="newjenisinstansi" id="newjenisinstansi" class="form-select">
                                                    <option selected hidden value=""> Pilih Jenis Instansi </option>
                                                    <option value="1">Pemerintah</option>
                                                    <option value="2">Swasta</option>
                                                    <option value="3">Perorangan</option>
                                                </select>
                                            </div>
            
                                            <div class="form-group">
                                                <label for="newalamatinstansi">Alamat Instansi</label>
                                                <textarea name="newalamatinstansi" id="newalamatinstansi" class="form-control" cols="30" rows="3" placeholder="Isikan alamat instansi (opsional)"></textarea>
                                            </div>
            
                                            <div class="form-group">
                                                <label for="newlogoinstansi">Logo Instansi (opsional)</label>
                                                <input type="file" class="form-control" id="newlogoinstansi" name="newlogoinstansi" onchange="Image_preview(event)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group" id="seeAnotherFieldClient">
                                            <label for="seeAnotherFieldClient">Pilih Klien</label>
                                            <select class='form-select' name='client_id' id='client_id' required>
                                                <option selected hidden value="">Pilih Klien</option>
                                                <option value="yes">Tambah Klien Baru</option>
                                            </select>
                                        </div>
                                        
                                        <div id="otherFieldDivClient">
                                            <div class="form-group">
                                                <label>Nama Klien</label>
                                                <input type="text" name="newnamaklien" id="newnamaklien" class="form-control" placeholder="Wajib Diiisi!">
                                            </div>
                                            <div class="form-group">
                                                <label>Email Klien</label>
                                                <input type="email" name="newemailklien" id="newemailklien" class="form-control" placeholder="Wajib Diisi!">
                                            </div>
                                            <div class="form-group">
                                                <label for="newnomorteleponklien">Nomor Telepon</label>
                                                <input type="text" id="newnomorteleponklien" name="newnomorteleponklien" class="form-control" placeholder="Wajib Diisi!">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Kode Proyek</label>
                                            <input name="project_code" class="form-control" required>
                                            @error('project_name')
                                                {{ $message }}
                                            @enderror
                                        </div>
            
                                        <div class="form-group">
                                            <label>Nama Proyek</label>
                                            <input name="project_name" class="form-control" required>
                                            <div class="text-danger">
                                                @error('project_name')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
            
                                        <div class="form-group">
                                            <label>Pilih Kategori Proyek</label>
                                            <select class="form-select" name="project_category" required>
                                                <option selected hidden value=""> Pilih Kategori </option>
                                                    <option value="Web">Web</option>
                                                    <option value="Aplikasi">Aplikasi</option>
                                                    <option value="Mobile App">Mobile App</option>
                                            </select>
                                        </div>
            
                                        <div class="form-group">
                                            <label>Detail Proyek</label>
                                            <textarea name="project_detail" class="form-control" type="date" required></textarea>
                                        </div>
            
                                        <div class="form-group">
                                            <label>Pilih Status Proyek</label>
                                            <select class="form-select" name="project_status" required>
                                                <option selected hidden value=""> Pilih Status </option>
                                                    <option value="Baru">Baru</option>
                                                    <option value="Dalam Pengerjaan">Dalam Pengerjaan</option>
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
                                            <label>Total Proyek</label>
                                            <input class="input-currency form-control" type="text" type-currency="IDR" placeholder="Rp" name="project_value" required>
                                        </div>

                                        <div class="form-group my-2">
                                            <label>Logo Proyek</label>
                                            <input type="file" class="form-control" name="project_logo" id="project_logo" onchange="Image_preview(event)">
                                        </div>

                                    </div>
                                </div>
    
                                <br>
    
                                <div class="form-group">
                                    <button class="btn btn-success float-right">Simpan Data</button>
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
        baris += '<option value="yes">Tambah Klien Baru</option>'
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
<script>
    function pilihInstansiEdit() {
    var data = 'id=' +document.getElementById('instance_id_edit').value;

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
        $('#client_id_edit').html(baris);
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
