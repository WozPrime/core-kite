@extends('pages.ui_admin.admin')

@section('title')
Profil Instansi
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
                <div class="card" style="height: 340px">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            @if ($instance->logo_instansi)
                            <img src="/logoinstansi/{{$instance->logo_instansi}}"
                                alt="logo {{$instance->nama_instansi}}" class="rounded-circle" width="150" height="150">
                            @else
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a2/Logo_of_Ministry_of_Communication_and_Information_Technology_of_the_Republic_of_Indonesia.svg/1024px-Logo_of_Ministry_of_Communication_and_Information_Technology_of_the_Republic_of_Indonesia.svg.png"
                                alt="Logo Instansi" class="rounded-circle" width="150">
                            @endif
                            <div class="mt-3">
                                <h4>{{$instance->nama_instansi}}</h4>
                                <p class="text-secondary mb-1"> {{$instance->alamat_instansi}} </p>
                                <p class="text-muted font-size-sm"> {{$instance->kota_instansi}} </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-3" style="height: 340px">
                    <div class="card-body">
                        <div class="row">
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
                                <a class="btn btn-rounded bg-primary mb-1" data-toggle="modal"
                                    data-target="#edit-data-instansi"> Edit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row gutters-sm">
            <div class="col-12">
                <div class="card">
                    <div class="card-orange">
                        <div class="card-header">
                            <h3 class="card-title text-light">Proyek Dengan Instansi</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <a href="#add-proyek" data-toggle="modal" class="badge bg-success mb-3"><i class="fa fa-plus-circle mr-1"></i> Tambah
                                Proyek Baru</a>
                            <table id="myTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Persetujuan</th>
                                        <th>Nama Proyek</th>
                                        <th>Klien</th>
                                        <th>Status Proyek</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($proyekinstansi as $p)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$p->project_start_date}}</td>
                                        <td>{{$p->project_name}}</td>
                                        <td>{{$p->client->name}}</td>
                                        <td>{{$p->project_status}}</td>
                                        {{-- <td>1</td>
                                                <td>31 Februari 2069</td>
                                                <td>Aplikasi Smart Pipel</td>
                                                <td>Husni Ramadhan Ishan</td>
                                                <td>Proyek Sedang Berjalan</td> --}}
                                        <td>
                                            <a href="/admin/proyek/{{$p->id}}" class="badge bg-info mr-1"><i
                                                    class="fa fa-eye"></i></a>
                                            <a href="#editproyek{{$p->id}}" data-toggle="modal" class="badge bg-warning mr-1"><i
                                                    class="fas fa-pencil-alt"></i></a>
                                            <form class="d-inline" action="/admin/proyek/{{$p->id}}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button class="badge bg-danger mr-1" onclick=" return confirm('Yakin ingin menghapus data ini?')"><i class="fa fa-eraser"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="editproyek{{ $p->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="card-header bg-orange">
                                                    <h3 class="card-title">Edit Proyek {{ $p->project_name }}</h3>
                                                </div>
                                                <div class="card-body">
                                                    <form autocomplete="off" action="/admin/proyek/{{ $p->id }}" method="POST" enctype="multipart/form-data">
                                                        @method('put')
                                                        @csrf
                                                        <div class="content">
                                                            <div class="form-group" hidden>
                                                                <label for="seeAnotherFieldInstance">Pilih
                                                                    Instansi</label>
                                                                <select class="form-select" aria-label="Disable" name="instance_id" required>
                                                                        <option selected hidden value="{{ $p->instance_id }}">{{ $p->instance->nama_instansi }}</option>
                                                                </select>
                                                            </div>
                                
                                                            <div class="form-group" hidden>
                                                                <label for="seeAnotherFieldClient">Pilih Klien</label>
                                                                <select class="form-select" name="client_id" required>
                                                                    <option selected hidden value="{{ $p->client_id }}">{{ $p->client->name }}</option>
                                                                </select>
                                                            </div>
                                
                                                            <div class="form-group">
                                                                <label>Kode Proyek</label>
                                                                <input name="project_code" class="form-control" value="{{ $p->project_code }}">
                                                            </div>
                                
                                                            <div class="form-group">
                                                                <label>Nama Proyek</label>
                                                                <input name="project_name" class="form-control" value="{{ $p->project_name }}">
                                                                <div class="text-danger">
                                                                    @error('project_name')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </div>
                                                            </div>
                                
                                                            <div class="form-group">
                                                                <label for="seeAnotherFieldClient">Pilih Kategori Proyek</label>
                                                                <select class="form-select" name="project_category" required>
                                                                    <option selected hidden value="{{ $p->project_category }}">{{ $p->project_category }}</option>
                                                                        <option value="Web">Web</option>
                                                                        <option value="Mobile App">Mobile App</option>
                                                                </select>
                                                            </div>
                                
                                                            <div class="form-group">
                                                                <label>Detail Proyek</label>
                                                                <textarea name="project_detail" class="form-control" type="date" >{{ $p->project_detail }}</textarea>
                                                            </div>
                                
                                                            <div class="form-group">
                                                                <label for="seeAnotherFieldClient">Pilih Status Proyek</label>
                                                                <select class="form-select" name="project_status" required>
                                                                    <option selected hidden value="{{ $p->project_status }}">{{ $p->project_status }}</option>
                                                                        <option value="Baru">Baru</option>
                                                                        <option value="Sedang Berjalan">Sedang Berjalan</option>
                                                                        <option value="Tertunda">Tertunda</option>
                                                                        <option value="Selesai">Selesai</option>
                                                                </select>
                                                            </div>
                                
                                                            <div class="form-group">
                                                                <label>Starting Date</label>
                                                                <input name="project_start_date" class="form-control" type="date" value="{{ $p->project_start_date }}">
                                                            </div>
                                
                                                            <div class="form-group">
                                                                <label>Deadline</label>
                                                                <input name="project_deadline" class="form-control" type="date" value="{{ $p->project_deadline }}">
                                                            </div>
                                
                                                            <div>
                                                                <label>Total Project</label>
                                                                <input class="input-currency form-control" type="text" type-currency="IDR" placeholder="Rp" name="project_value" value="{{ $p->project_value }}">
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
                    </div>
                </div>
            </div>
        </div>

        <div class="row gutters-sm">
            <div class="col-12">
                <div class="card">
                    <div class="card-orange">
                        <div class="card-header">
                            <h3 class="card-title text-light">Klien Dari Instansi : {{$instance->nama_instansi}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="myTable" class="table table-responsive-sm table-bordered" width="100%">
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
                                    @foreach ($klieninstansi as $c)
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
                                                                    <input type="text" name="client_instance" id="client_instance" value="{{$c->instance_id}}" class="form-control" hidden>
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
                <form action="/admin/instansi/{{$instance->id}}" method="POST" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="content">
                        <div class="form-group">
                            <label>Nama Instansi</label>
                            <input name="namainstansi" class="form-control" value="{{ $instance->nama_instansi }}"
                                required>
                            <div class="text-danger">
                                @error('namainstansi')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Alamat Instansi</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                name="alamatinstansi"> {{$instance->alamat_instansi}} </textarea>
                        </div>

                        <div class="form-group">
                            <label>Kota Instansi</label>
                            <input name="kotainstansi" class="form-control" value="{{ $instance->kota_instansi }}"
                                required>
                            <div class="text-danger">
                                @error('namainstansi')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Jenis Instansi</label>
                            <select name="jenisinstansi" class="form-control"
                                value="{{$instance->instances_model->jenis_instansi}}">
                                <option value="1" @if ($instance->instances_model->jenis_instansi == 'Pemerintah')
                                    selected @endif>Pemerintah</option>
                                <option value="2" @if ($instance->instances_model->jenis_instansi == 'Swasta') selected
                                    @endif>Swasta</option>
                                <option value="3" @if ($instance->instances_model->jenis_instansi == 'Perorangan')
                                    selected @endif>Perorangan</option>
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

<div class="modal fade" id="add-proyek">
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
                            <select class="form-select" aria-label="Disable" name="instance_id" onclick="pilihInstansi()" id="instance_id" required>
                                <option selected value="{{$instance->id}}">{{$instance->nama_instansi}}</option>
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

@endsection

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
@endsection
