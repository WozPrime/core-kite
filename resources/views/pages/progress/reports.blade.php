@extends('pages.ui_admin.admin')
@section('title')
    Tabel Laporan
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
                    <h1>Reports</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                        <li class="breadcrumb-item active">Reports</li>
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
                            <h2 class="card-title pt-2">Daftar Laporan</h2>
                            <div class="col-xs-3" style="float: right">
                                <a href="#pdf" class="btn btn-block btn-info text-light" data-toggle="modal"><i
                                        class="fas fa-file-alt mr-2"></i>Cetak PDF</a>
                                {{-- <a href="generate-pdf" target="_blank" class="btn btn-block btn-info"><i class="fas fa-file-alt mr-2"></i>Generate PDF</a> --}}
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-responsive-sm table-bordered" id="myTable" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No</th>
                                        <th class="col-3">Pengirim</th>
                                        <th class="col-2">Status</th>
                                        <th class="col-3">Tanggal Pengiriman</th>
                                        <th class="col-2">Tugas</th>
                                        <th class="col-2">Nama Proyek</th>
                                        <th class="col-2">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($project_task as $p_task)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $p_task->users()->first()->name }}</td>
                                            <td>
                                                <small
                                                    class="badge 
                                                    @if ($p_task->status == 1) badge-warning
                                                    @elseif ($p_task->status == 2)
                                                    badge-success
                                                    @elseif ($p_task->status == 3)
                                                    badge-danger 
                                                    @else
                                                    badge-secondary @endif
                                                    "
                                                    id='deadline'>
                                                    @if ($p_task->status == 1)
                                                        Belum Diperiksa
                                                    @elseif ($p_task->status == 2)
                                                        Telah Diperiksa
                                                    @elseif ($p_task->status == 3)
                                                        Belum Memenuhi Persyaratan
                                                    @else
                                                        Laporan Masih Kosong
                                                    @endif
                                                </small>
                                            </td>
                                            <td class="@if ($p_task->post_date == null) text-red @endif">
                                                @if ($p_task->post_date == null)
                                                    Belum Diunggah
                                                @else
                                                    {{ date('D, d M Y H:i', strtotime($p_task->post_date)) }}
                                                @endif
                                            </td>
                                            <td>{{ $p_task->details }}</td>
                                            <td>{{ $p_task->project()->first()->project_name }}</td>
                                            <td style="text-align: center">
                                                <a class="btn btn-primary mr-1 mb-1" data-toggle="modal"
                                                    href="#detail{{ $p_task->id }}"><i class="fa fa-eye"></i></a>
                                                @if (Auth::user()->id != $p_task->user_id)
                                                    <a class="btn btn-success mr-1 mb-1" data-toggle="modal"
                                                        href="#edit{{ $p_task->id }}"><i class="fa fa-edit"></i></a>
                                                @endif
                                            </td>
                                            <div class="modal fade" id="detail{{ $p_task->id }}">
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
                                                                            @if ($p_task->project()->first()->project_logo == '')
                                                                                <img src="{{ url('prof/default.png') }}"
                                                                                    class="profile-user-img img-fluid img-circle">
                                                                            @else
                                                                                <img src="{{ url('pp/' . $p_task->project()->first()->project_name) }}"
                                                                                    class="profile-user-img img-fluid img-circle">
                                                                            @endif
                                                                        </div>

                                                                        <h3 class="profile-username text-center">
                                                                            {{ $p_task->project()->first()->project_name }}
                                                                        </h3>

                                                                        <p class="text-muted text-center">
                                                                            {{-- {{ $p_task->instance()->first()->nama_instansi }} --}}
                                                                        </p>

                                                                        <ul class="list-group list-group-unbordered mb-3">
                                                                            <li class="list-group-item">
                                                                                <b>Tugas</b> <a
                                                                                    class="float-right text-dark">
                                                                                    {{ $p_task->details }}
                                                                                </a>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <b>Penanggung Jawab</b> <a
                                                                                    class="float-right text-dark">
                                                                                    {{ $p_task->users()->first()->name }}
                                                                                </a>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <b>Kategori</b> <a
                                                                                    class="float-right text-dark">
                                                                                    {{ $p_task->tasks()->first()->task_name }}
                                                                                </a>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <b>Tanggal Pengunggahan</b> <a
                                                                                    class="float-right 
                                                                                    @if ($p_task->post_date) text-dark
                                                                                    @else
                                                                                        text-red @endif
                                                                                    ">
                                                                                    @if ($p_task->post_date)
                                                                                        {{ date('D, d M Y H:i', strtotime($p_task->post_date)) }}
                                                                                    @else
                                                                                        Belum Diunggah
                                                                                    @endif
                                                                                </a>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <b>Tenggat Waktu</b> <a
                                                                                    class="float-right 
                                                                                    @if ($p_task->post_date) text-success
                                                                                    @else
                                                                                        text-red @endif
                                                                                    ">
                                                                                    {{ date('D, d M Y H:i', strtotime($p_task->start_at)) }} - <br>
                                                                                    {{ date('D, d M Y H:i', strtotime($p_task->expired_at)) }}
                                                                                </a>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <b>Jarak Tenggat Waktu</b>
                                                                                <a
                                                                                    class="float-right
                                                                                @if ($p_task->post_date) text-dark
                                                                                    @else
                                                                                        text-red @endif
                                                                                    ">
                                                                                    @if ($p_task->post_date)
                                                                                        @php
                                                                                            $diff = strtotime($p_task->expired_at) - strtotime($p_task->post_date);
                                                                                            $days = $diff / 86400;
                                                                                        @endphp
                                                                                        @if ($days >= 1)
                                                                                            {{ floor($days) }} Hari
                                                                                        @else
                                                                                            @if ($days > 0 && $days < 1)
                                                                                                @php
                                                                                                    $jam = floor($diff / 3600);
                                                                                                    $menit = floor($diff / 60);
                                                                                                @endphp
                                                                                                @if ($jam > 0)
                                                                                                    {{ $jam }} Jam
                                                                                                @else
                                                                                                    {{ $menit }}
                                                                                                    Menit
                                                                                                @endif
                                                                                            @else
                                                                                                Tenggat Waktu Terlewati
                                                                                            @endif
                                                                                        @endif
                                                                                    @else
                                                                                        Belum Diunggah
                                                                                    @endif
                                                                                </a>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <b>Detail Pengunggahan</b> <a
                                                                                    class="float-right 
                                                                                    @if ($p_task->upload_details) text-dark
                                                                                    @else
                                                                                        text-red @endif
                                                                                    ">
                                                                                    @if ($p_task->upload_details)
                                                                                        {{ $p_task->upload_details }}
                                                                                    @else
                                                                                        Belum Diunggah
                                                                                    @endif
                                                                                </a>
                                                                            </li>
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
                                                                        @if ($doc->where('pt_id', $p_task->id)->count() == 0)
                                                                            <strong class="text-red">Tidak Ada File
                                                                                yang Ditambahkan</strong>
                                                                        @else
                                                                            @foreach ($doc->where('pt_id', $p_task->id) as $file)
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
                                            <div class="modal fade" id="edit{{ $p_task->id }}">
                                                <form action="/admin/reports/grade/{{ $p_task->id }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            @csrf
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Tambah Nilai</h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <section class="container-fluid">
                                                                    @if ($p_task->status == null)
                                                                        <h3 class="text-red"
                                                                            style="text-align: center">Tugas Belum Diunggah
                                                                        </h3>
                                                                    @else
                                                                        <div class="form-group">
                                                                            <label for="rate">Nilai Tugas</label>
                                                                            <select name="task_points" id="task_points"
                                                                                class="form-control" required>
                                                                                <option value="" selected disabled hidden>
                                                                                    Beri
                                                                                    Nilai
                                                                                    Tugas yang telah dikerjakan</option>
                                                                                @for ($i = 0; $i < $p_task->tasks()->first()->points + 1; $i++)
                                                                                    @if ($i == 0)
                                                                                        <option value="{{ $i }}"
                                                                                            @if ($i === $p_task->points) selected @endif
                                                                                            class="text-red">
                                                                                            {{ $i }} (Gagal)
                                                                                        </option>
                                                                                    @else
                                                                                        <option value="{{ $i }}"
                                                                                            @if ($i == $p_task->points) selected @endif>
                                                                                            {{ $i }}</option>
                                                                                    @endif
                                                                                @endfor
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Masukan</label>
                                                                            <textarea class="form-control" id="feedback" name="feedback" rows="3" required
                                                                                placeholder="Enter Task Feedbacks ...">{{ $p_task->feedback }}</textarea>
                                                                        </div>
                                                                    @endif
                                                                </section>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-default"
                                                                    data-dismiss="modal">Close</button>
                                                                @if ($p_task->status != null)
                                                                    <button type="submit" class="btn btn-primary">Simpan
                                                                        Perubahan</button>
                                                                @endif
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
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="pdf">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="card-header bg-orange">
                        <h3 class="card-title">Tambah Data Instansi</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form autocomplete="off" action="/admin/generate-pdf" method="post" enctype="multipart/form-data"
                        target="_blank">
                        @csrf
                        <div class="card-body">

                            <div class="content">
                                <div class="form-group" id="seeAnotherFieldReport">
                                    <label for="seeAnotherFieldReport">Pilih Data Laporan</label>
                                    <select class="form-select" aria-label="Disable" name="reportList" id="reportList"
                                        required>
                                        <option value="" selected hidden>Pilih Asal Data</option>
                                        <option value="Karyawan">Pilih Berdasarkan Karyawan</option>
                                        <option value="Tanggal">Pilih Berdasarkan Waktu</option>
                                        <option value="Proyek">Pilih Berdasarkan Proyek</option>
                                        <option value="Profesi">Pilih Berdasarkan Profesi</option>
                                        <option value="All"> Seluruh Data</option>
                                    </select>
                                    @error('project_name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <div class="form-group" id="otherFieldReportEmp">
                                    <label for="otherFieldReportEmp">Pilih Karyawan</label>
                                    <select name="dataKaryawan" id="dataKaryawan" class="form-select">
                                        <option value="" selected hidden>Pilih Data Karyawan</option>
                                        @foreach ($project_task->where('status', 2) as $data)
                                            <option value="{{ $data->user_id }}">{{ $data->users->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" id="otherFieldReportDate">
                                    <label for="otherFieldReportDate">Tentukan Tanggal</label>
                                    <div id="reportrange"
                                        style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                        <i class="fa fa-calendar"></i>&nbsp;
                                        <span></span> <i class="fa fa-caret-down"></i>
                                    </div>
                                    <input type="hidden" name="startDate" value="" />
                                    <input type="hidden" name="endDate" value="" />
                                </div>
                                <div class="form-group" id="otherFieldReportProj">
                                    <label for="otherFieldReportProj">Pilih Proyek</label>
                                    <select name="dataProyek" id="dataProyek" class="form-select">
                                        <option value="" selected hidden>Pilih Data Proyek</option>
                                        @foreach ($proyek as $data)
                                            <option value="{{ $data->id }}">{{ $data->project_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" id="otherFieldReportProf">
                                    <label for="otherFieldReportProf">Pilih Profesi</label>
                                    <select name="dataProfesi" id="dataProfesi" class="form-select">
                                        <option value="" selected hidden>Pilih Data Profesi</option>
                                        @foreach ($profesi as $data)
                                            <option value="{{ $data->id }}">{{ $data->prof_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            <button type="submit" id="saveBtn" class="btn btn-primary"><i
                                    class="fas fa-file-alt mr-2"></i>Print
                                PDF</a></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->



@section('footer')
@endsection
@section('script')
    <script type="text/javascript">
        $(function() {
            var start = moment().subtract(29, 'days');
            var end = moment();

            function cb(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                $('input[name="startDate"]').val(start.format('MM/DD/YYYY'));
                $('input[name="endDate"]').val(end.format('MM/DD/YYYY'));
            }
            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                }
            }, cb);

            cb(start, end);


        });
    </script>
@endsection
@endsection
