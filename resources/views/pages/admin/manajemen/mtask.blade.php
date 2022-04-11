@extends('pages.ui_admin.admin')
@section('title')
    Kelola Tugas
@endsection
@section('body')
@section('navbar')
@endsection
@section('sidebar')
@endsection
@section('content')
    @error('deadline')
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Peringatan!</strong>  Data Masih Kosong.
    </div>
    @enderror
    {{-- content --}}
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kelola Tugas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Kelola Tugas</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    {{-- alert --}}



    {{-- content --}}
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-fuchsia">
                        <div class="card-header">
                            <h3 class="card-title pt-1">Daftar Tugas</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool mt-1" data-card-widget="collapse"
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
                                        <th style="width: 10px">No</th>
                                        <th class="col-3">Tugas</th>
                                        <th class="col-2">Karyawan</th>
                                        <th class="col-2">Proyek</th>
                                        <th class="col-2">Tenggat Waktu</th>
                                        <th class="col-1">Status</th>
                                        <th class="col-2">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($projectTask->get() as $ptask)
                                        <tr>
                                            <td style="text-align: center">{{ $loop->iteration }}</td>
                                            <td>{{ $Task->find($ptask->task_id)->task_name }}</td>
                                            <td>{{ $User->find($ptask->user_id)->name }}</td>
                                            <td>{{ $Project->find($ptask->project_id)->project_name }}</td>
                                            <td>
                                                @if ($ptask->expired_at != '')
                                                {{ date('D, d M Y, H:i', strtotime($ptask->expired_at)) }}
                                                @endif
                                            </td>
                                            <td>
                                                <small
                                                    class="badge 
                                                    @if ($ptask->status == 1) badge-warning
                                                    @elseif ($ptask->status == 2)
                                                    badge-success
                                                    @elseif ($ptask->status == 3)
                                                    badge-danger 
                                                    @else
                                                    badge-secondary @endif
                                                    "
                                                    id='deadline'>
                                                    @if ($ptask->status == 1)
                                                        Belum Diperiksa
                                                    @elseif ($ptask->status == 2)
                                                        Telah Diperiksa
                                                    @elseif ($ptask->status == 3)
                                                        Belum Memenuhi Persyaratan
                                                    @else
                                                        Laporan Masih Kosong 
                                                    @endif
                                                </small>
                                            </td>
                                            <td style="text-align: center">
                                                <a class="btn btn-success" data-toggle="modal"
                                                    data-target="#deadline{{ $ptask->id }}"><i
                                                        class="fa fa-edit"></i></a>
                                                <a class="btn btn-primary" data-toggle="modal"
                                                    data-target="#details{{ $ptask->id }}"><i
                                                        class="fa fa-info-circle"></i></a>
                                                <a class="btn btn-danger" data-toggle="modal"
                                                    data-target="#delete{{ $ptask->id }}"><i
                                                        class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <!-- /.modal -->
                                        <div class="modal fade" id="deadline{{ $ptask->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Tugas</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="/admin/project_all/{{ $ptask->id }}/edit" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="expired_at">Edit Tugas Deadline</label>
                                                                <input @if ($ptask->status == 2)
                                                                    disabled
                                                                @endif 
                                                                name="expired_at" class="form-control" type="datetime-local" value="{{ (new DateTime($ptask->expired_at))->format('Y-m-d').'T'.(new DateTime($ptask->expired_at))->format('H:i')}}">
                                                              </div>
                                                            <div class="form-group">
                                                                <label for="user_id">Edit Karyawan</label>
                                                                <select name="user_id" id="user_id" class="form-control" 
                                                                @if ($ptask->status == 2)
                                                                    disabled
                                                                @endif >
                                                                    @foreach ($User->where('role','<>','client')->whereIn('id', $projectAll->get('user_id'))->get() as $karyawan)
                                                                        <option value="{{ $karyawan->id }}"@if ($ptask->user_id == $karyawan->id)
                                                                            selected
                                                                        @endif>{{ $karyawan->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="task_id">Edit Kategori Tugas</label>
                                                                <select name="task_id" id="task_id" class="form-control"
                                                                @if ($ptask->status == 2)
                                                                    disabled
                                                                @endif 
                                                                >
                                                                    @foreach ($Task->get() as $tugas)
                                                                        <option value="{{ $tugas->id }}"@if ($ptask->task_id == $tugas->id)
                                                                            selected
                                                                        @endif>{{ $tugas->task_name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="details">Edit Detail</label>
                                                                <textarea class="form-control" id="details"
                                                                    name="details" rows="3" required
                                                                    placeholder="Masukkan Detail Tugas ...">{{$ptask->details}}</textarea>

                                                            </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                        </div>
                                                        </form>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                                <!-- /.modal -->
                                            </div>
                                        </div>
                                        <div class="modal fade" id="details{{ $ptask->id }}">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Detail Tugas</h4>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <section class="container-fluid">
                                                            <div class="card card-primary card-outline">
                                                                <div class="card-body box-profile">
                                                                    <div class="text-center">
                                                                        {{-- @if ($ptask->project()->first()->project_logo == '')
                                                                            <img src="{{ url('pp/default.jpg') }}"
                                                                                class="profile-user-img img-fluid img-circle">
                                                                        @else
                                                                            <img src="{{ url('pp/' . $ptask->project()->first()->project_name) }}"
                                                                                class="profile-user-img img-fluid img-circle">
                                                                        @endif --}}
                                                                    </div>

                                                                    <h3 class="profile-username text-center">
                                                                        {{ $ptask->project()->first()->project_name }}
                                                                    </h3>

                                                                    <p class="text-muted text-center">
                                                                        {{ $ptask->instance()->first()->nama_instansi }}
                                                                    </p>

                                                                    <ul class="list-group list-group-unbordered mb-3">
                                                                        <li class="list-group-item">
                                                                            <b>Tugas</b> <a
                                                                                class="float-right text-dark">
                                                                                {{ $ptask->details }}
                                                                            </a>
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <b>PJ</b> <a class="float-right text-dark">
                                                                                {{ $ptask->users()->first()->name }}
                                                                            </a>
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <b>Kategori</b> <a
                                                                                class="float-right text-dark">
                                                                                {{ $ptask->tasks()->first()->task_name }}
                                                                            </a>
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <b>Tanggal Diunggah</b> <a
                                                                                class="float-right 
                                                                                @if ($ptask->post_date) text-dark
                                                                                @else
                                                                                    text-red @endif
                                                                                ">
                                                                                @if ($ptask->post_date)
                                                                                    {{ date('D, d M Y H:i', strtotime($ptask->post_date)) }}
                                                                                @else
                                                                                    Belum Diunggah
                                                                                @endif
                                                                            </a>
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <b>Tenggat Waktu</b> <a
                                                                                class="float-right 
                                                                                @if ($ptask->post_date) text-success
                                                                                @else
                                                                                    text-red @endif
                                                                                ">
                                                                                    {{ date('D, d M Y H:i', strtotime($ptask->expired_at)) }}
                                                                            </a>
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <b>Jarak Tenggat Waktu</b>
                                                                            <a class="float-right
                                                                            @if ($ptask->post_date) text-dark
                                                                                @else
                                                                                    text-red @endif
                                                                                ">
                                                                                @if ($ptask->post_date)
                                                                                    @php
                                                                                        $diff =  floor((strtotime($ptask->expired_at)- strtotime($ptask->post_date)) / 86400);
                                                                                    @endphp
                                                                                    @if ($diff >= 1)
                                                                                        {{$diff}} Days
                                                                                    @else
                                                                                        @if ($diff > 0 && $diff < 1)
                                                                                            {{floor((strtotime($ptask->expired_at)- strtotime($ptask->post_date)) / 1440)}} Minutes
                                                                                        @else
                                                                                            Batas Waktu Berakhir
                                                                                        @endif
                                                                                    @endif
                                                                                @else
                                                                                    Belum Diunggah
                                                                                @endif
                                                                            </a>
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <b>Detail Unggahan</b> <a
                                                                                class="float-right 
                                                                                @if ($ptask->upload_details) text-dark
                                                                                @else
                                                                                    text-red @endif
                                                                                ">
                                                                                @if ($ptask->upload_details)
                                                                                    {{ $ptask->upload_details }}
                                                                                @else
                                                                                    Belum Diunggah
                                                                                @endif
                                                                            </a>
                                                                        </li>
                                                                        @if ($ptask->status == 2)
                                                                            <li class="list-group-item">
                                                                                <b>Nilai</b> <a class="@if ($ptask->points/$ptask->tasks()->first()->points > 0.7)
                                                                                    text-success
                                                                                @else
                                                                                    text-orange
                                                                                @endif float-right" style="font-weight: bold">
                                                                                    {{ $ptask->points}}/{{$ptask->tasks()->first()->points}}
                                                                                </a>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <b>Masukan (Feedback):</b> 
                                                                                <br>
                                                                                <a class="text-dark" style="display:block;text-overflow: ellipsis;width: 700px;overflow: hidden; white-space: nowrap;text-align: right">
                                                                                    {{ $ptask->feedback }}
                                                                                </a>
                                                                            </li> 
                                                                        @endif
                                                                    </ul>
                                                                </div>
                                                                <!-- /.card-body -->
                                                            </div>


                                                            <div class="card card-secondary">
                                                                <div class="card-header">
                                                                    <h3 class="card-title">Unduh Berkas</h3>
                                                                </div>
                                                                <!-- /.card-header -->
                                                                <div class="card-body">
                                                                    @if ($Doc->where('pt_id', $ptask->id)->count() == 0)
                                                                        <strong class="text-red">Berkas masih Kosong</strong>
                                                                    @else
                                                                        @foreach ($Doc->where('pt_id', $ptask->id)->get() as $file)
                                                                            <strong>{{ $file->file_name }}</strong>
                                                                            <a class="btn btn-primary mr-1 float-right"
                                                                                href="/admin/file/download/{{ $file->file_name }}"><i
                                                                                    class="fas fa-download"></i></a>
                                                                            <hr>
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                                <!-- /.card-body -->
                                                            </div>


                                                        </section>

                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.modal -->
                                        <div class="modal fade" id="delete{{ $ptask->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content bg-danger">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Hapus Tugas</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah anda yakin ingin Menghapus data ini?
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-outline-light"
                                                            data-dismiss="modal">Close</button>
                                                        <a href="/admin/task/delete/{{ $ptask->id }}" type="button"
                                                            class="btn btn-outline-light">Hapus
                                                            Data</a>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.modal -->
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

@endsection
<!-- /.content -->
@section('footer')
@endsection
@section('script')
<script>
    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    console.log($('#reservationdatetime').find('input[name="expired_at"]').val());
    //Date and time picker
    $('#reservationdatetime').datetimepicker({
        icons: {
            time: 'far fa-clock',
        },
        defaultDate: $('#reservationdatetime').find('input[name="expired_at"]').val()
    });
</script>
@endsection
@endsection
