@php
use Carbon\Carbon;
@endphp
@extends('pages.ui_admin.admin')

@section('title')
    Profil Proyek
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
                                    <b class="text-secondary-bold"> {{ $data->project_name }} </b>
                                    <p class="text-muted font-size-sm"> [{{ $data->project_code }}] </p>
                                    <b class="text-secondary-bold"> Nilai Proyek </b>
                                    <p class="text-muted font-size-sm"> {{ $data->project_value }} </p>
                                    <b class="text-secondary-bold"> Jenis Proyek </b>
                                    <p class="text-muted font-size-sm"> {{ $data->project_category }} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card mb-3" style="height: 375px">
                        <div class="card-body">
                            <b class="text-secondary-bold"> Detail Proyek </b>
                            <p class="text-muted font-size-sm"> {{ $data->project_detail }} </p>
                            <b class="text-secondary-bold"> Perkiraan Waktu Pengerjaan Proyek</b>
                            <p class="text-muted font-size-sm"> {{ date('D, d M Y', strtotime($data->project_start_date)) }}
                                <b>s/d</b> {{ date('D, d M Y', strtotime($data->project_deadline)) }} </p>
                            <b class="text-secondary-bold"> Rentang Pengerjaan Waktu </b>
                            <p class="text-muted font-size-sm">
                                {{ Carbon::parse($data->project_deadline)->diffInDays($data->project_start_date) }} Hari
                            </p>
                            <b class="text-secondary-bold"> Klien </b>
                            <p class="text-muted font-size-sm"> {{ $data->client->name }} </p>
                            <b class="text-secondary-bold"> Instansi </b>
                            <p class="text-muted font-size-sm"> {{ $data->instance->nama_instansi }} </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row gutters-sm">
                <div class="col-12">
                    <div class="card">
                        <div class="card-orange">
                            <div class="card-header">
                                <h3 class="card-title text-light">Anggota Proyek</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{ route('upload_emp') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-9">
                                            <div class="form-group no-border">
                                                <select name="user_id" id="user_id" class="form-control">
                                                    <option value="" selected disabled hidden>Pilih
                                                    Karyawan
                                                    </option>
                                                    @if (count($part_user) == 0)
                                                        <option value="">Karyawan Tidak Tersedia
                                                        </option>

                                                    @endif
                                                    @foreach ($part_user as $karyawan)
                                                        <option value="{{ $karyawan->id }}">{{ $karyawan->name }}
                                                        </option>

                                                    @endforeach
                                                </select>
                                                <input type="hidden" name="project_id" id="project_id"
                                                    value="{{ $data->id }}">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <button @if (count($part_user) == 0)
                                                disabled
                                                @endif type="submit" class="btn btn-block btn-info">Tambah</button>
                                        </div>
                                    </div>
                                    
                                </form>
                                <table class="table table-responsive-sm table-bordered" id="myTable2">
                                    <thead>
                                        <tr>
                                            <th style="min-width: 20px; max-width: 20px;" class="text-center">No.</th>
                                            <th style="min-width: 100px; max-width: 100px;" class="text-center">Role</th>
                                            <th class="text-center">Nama</th>
                                            <th style="min-width: 40px; max-width: 40px;" class="text-center">Foto</th>
                                            <th style="min-width: 70px; max-width: 70px;" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($participant as $list)
                                            @php
                                                $prof_part = [];
                                            @endphp 
                                            <tr>
                                                {{-- {{dd($list)}} --}}
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="text-center">
                                                    <a href="#insert{{$list->user_id}}" data-toggle="modal" class="btn btn-block">
                                                        <div style="display: flex;
                                                                    flex-direction:column;
                                                                    justify-content:center;">
                                                                @foreach ($project_all as $prof_task)
                                                                    @if ($prof_task->user_id == $list->user_id && $prof_task->prof_id != '')
                                                                        <div style="padding: 3px">
                                                                            <span class="badge @if (fmod($prof_task->prof_id,3) == 0)
                                                                                bg-danger
                                                                                @elseif(fmod($prof_task->prof_id,2) == 0)
                                                                                bg-warning 
                                                                                @else
                                                                                bg-success                                                                   
                                                                            @endif">
                                                                                {{ $project_all->find($prof_task->id)->profUser()->first()->prof_name }}
                                                                                @php
                                                                                    $prof_part[] = $prof_task->prof_id
                                                                                @endphp
                                                                            </span>
                                                                        </div>
                                                                    @else
                                                                        @continue
                                                                    @endif
                                                                @endforeach   
                                                        </div>
                                                    </a>
                                                </td>
                                                <td>{{ $user_task->find($list->user_id)->name }}</td>
                                                <td class="text-center">
                                                    @if ($user_task->find($list->user_id)->pp == '')
                                                        <img src="{{ url('pp/default.jpg') }}" class="img-circle"
                                                            width="70">
                                                    @else
                                                        <img src="{{ url('pp/' . $user_task->find($list->user_id)->pp) }}" class="img-circle"
                                                            width="70">
                                                    @endif
                                                </td>
                                                <td style="text-align: center">

                                                    <a class="btn btn-primary" data-toggle="modal"
                                                        href="#detail{{ $list->user_id }}"><i
                                                            class="fa fa-eye"></i></a>
                                                    <a class="btn btn-success" data-toggle="modal"
                                                        href="#tambah{{ $list->user_id }}"><i
                                                            class="fa fa-edit"></i></a>
                                                    <a class="btn btn-danger" data-toggle="modal"
                                                        href="#delete{{ $list->user_id }}"><i
                                                            class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="insert{{$list->user_id}}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Tambah Role</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="/admin/project_all" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="Profession">Profession</label>
                                                                    <div class="select2-primary">
                                                                        <select class="select2" name="profs[]" data-dropdown-css-class="select2-primary"
                                                                                multiple="multiple" data-placeholder="Select a Profession" style="width: 100%;" autocomplete="off">
                                                                                @foreach ($profs as $prof)
                                                                                <option @if (in_array($prof->id, $prof_part))
                                                                                    selected @endif
                                                                                    value="{{ $prof->id }}">{{ $prof->prof_name }}
                                                                                </option>
                                                                                @endforeach
                                                                            </select>
                                                                    </div>
                                                                    
                                                                    {{-- <select name="prof_id" id="prof_id" class="form-control">
                                                                        <option value="" selected disabled hidden>Pilih
                                                                            Profesi </option>
                                                                            @foreach ($profs as $prof)
                                                                                @if (in_array($prof->id, $prof_part))
                                                                                    @continue
                                                                                @endif
                                                                                <option value="{{ $prof->id }}">{{ $prof->prof_name }}
                                                                                </option>
                                                                            @endforeach 
                                                                            not this part
                                                                             <option value="{{ $profession->id }}">{{ $profession->prof_name }}
                                                                            </option> 
                                                                            </select> --}}
                                                                </div>
                                                                
                                                                <input type="hidden" name="project_id" id="project_id"
                                                                                value="{{ $data->id }}">
                                                                <input type="hidden" name="user_id" id="user_id"
                                                                                value="{{ $list->user_id }}">

                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->

                                            </div>
                                            
                                            <div class="modal fade" id="tambah{{$list->user_id}}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Tambah Task</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="/admin/project/task/add" method="POST" enctype="multipart/form-data">
                                                            @csrf    
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="Profession">Task</label>
                                                                    <div class="select2-success">
                                                                        <select class="select2" name="tags[]" data-dropdown-css-class="select2-success"
                                                                            multiple="multiple" data-placeholder="Select a Task" style="width: 100%;" autocomplete="off">
                                                                            @foreach ($job_list->get() as $task)
                                                                            @if ($job_list->find($task->id)->profs()->first() == '')
                                                                                @continue    
                                                                            @else
                                                                                @if (in_array($task->profs()->first()->id, $prof_part))
                                                                                <option
                                                                                @if ($project_task->where(['user_id' => $list->user_id, 'project_id' => $data->id])->where('task_id',$task->id)->exists())
                                                                                    selected
                                                                                @endif
                                                                                value="{{$task->id}}">{{$task->task_name}}</option>
                                                                                @endif
                                                                            @endif
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                {{-- <div class="form-group">
                                                                    <label>Hak Akses</label>
                                                                    <select class="js-example-basic-multiple select2-hidden-accessible" id="hak_akses" name="hak_akses[]" multiple="" tabindex="-1" aria-hidden="true">
                                                                        <option value="1">Menambah dan menghapus kolom</option>
                                                                        <option value="2">Menambah task dan menghapus task</option>
                                                                        <option value="3">Mengubah poin</option>
                                                                        <option value="4">Melalukan assignee &amp; checking ke pengerja</option>
                                                                      </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: auto;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1"><ul class="select2-selection__rendered"><span class="select2-selection__clear">×</span><li class="select2-selection__choice" title="Menambah dan menghapus kolom"><span class="select2-selection__choice__remove" role="presentation">×</span>Menambah dan menghapus kolom</li><li class="select2-selection__choice" title="Menambah task dan menghapus task"><span class="select2-selection__choice__remove" role="presentation">×</span>Menambah task dan menghapus task</li><li class="select2-selection__choice" title="Melalukan assignee &amp; checking ke pengerja"><span class="select2-selection__choice__remove" role="presentation">×</span>Melalukan assignee &amp; checking ke pengerja</li><li class="select2-search select2-search--inline"><input class="select2-search__field" type="search" tabindex="0" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" role="textbox" aria-autocomplete="list" placeholder="" style="width: 0.75em;"></li></ul></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                                </div> --}}
                                                                <input type="hidden" name="project_id" id="project_id"
                                                                                value="{{ $data->id }}">
                                                                <input type="hidden" name="user_id" id="user_id"
                                                                                value="{{ $list->user_id }}">

                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->

                                            </div>
                                            {{-- DELETE MODAL --}}
                                            {{-- <form autocomplete="off" action="/admin/project_all/{{ $list->user_id }}" method="POST" class="d-inline">
                                                @method('delete')
                                                @csrf --}}
                                            <div class="modal fade" id="delete{{ $list->user_id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content bg-danger">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Hapus Data User</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah anda yakin ingin Menghapus data dari {{  $user_task->find($list->user_id)->name }} ini?
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                                            <a href="/admin/project_all/delete/{{ $list->user_id }}" type="submit"
                                                                class="btn btn-outline-light">Hapus Data</a>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
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

            <br>

            <div class="row gutters-sm">
                <div class="col-12">
                    <div class="card">
                        <div class="card-orange">
                            <div class="card-header">
                                <h2 class="card-title text-light pt-2">Riwayat Pembayaran</h2>
                                <div class="col-xs-3" style="float: right">
                                    <a href="#addpembayaran" class="btn btn-block btn-info text-light" data-toggle="modal"><i class="fas fa-plus-circle mr-2"></i> Tambah Pembayaran</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" >
                                
                                <table class="table table-responsive-sm table-bordered" id="myTable1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No.</th>
                                            <th class="text-center">Tanggal Pembayaran</th>
                                            <th class="text-center">Jenis Pembayaran</th>
                                            <th class="text-center">Deskripsi Pembayaran</th>
                                            <th class="text-center">Nilai Pembayaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
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

    <div class="modal fade" id="addpembayaran">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card-header bg-orange">
                    <h3 class="card-title">Tambah Data Pembayaran</h3>
                </div>
                <div class="card-body">
                    <form action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="content">
                            <div class="form-group">
                                <label>Tanggal Pembayaran</label>
                                <input type="date" name="Tanggalpembayaran" class="form-control" value="#" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Jenis Pembayaran</label>
                                <select name="jenispembayaran" id="jenispembayaran" class="form-select">
                                    <option value="" selected hidden>Pilih Jenis Pembayaran</option>
                                    <option value="Tunai">Tunai</option>
                                    <option value="Transfer">Transfer</option>
                                    <option value="Cek">Cek</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Deskripsi Pembayaran</label>
                                <textarea name="deskripsipembayaran" class="form-control" value="#" required></textarea>
                                </div>

                            <div class="form-group">
                                <label>Nilai Pembayaran</label>
                                <input name="Nilai Pembayaran" class="form-control" value="#" type="text" required>
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
@section('script')
<script>
    $(document).ready(function() {
        $('#myTable1').DataTable();
    });
</script>
<script>
    $(document).ready(function() {
        $('#myTable2').DataTable();
    });
</script>
@endsection
@endsection
