@php
    use Carbon\Carbon;
@endphp
@extends('pages.emp.ui_emp.empmaster')
@section('title')
    Laporan Karyawan
@endsection
@section('emphead')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
@endsection
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Project Detail</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/emp">Home</a></li>
                    <li class="breadcrumb-item ">To Do List</li>
                    <li class="breadcrumb-item ">Project</li>
                    <li class="breadcrumb-item active">{{$data->project_name}}</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="container pt-3">
    <div class="main-body">
        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card" style="height: 375px">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            @if ($data->project_logo)
                                <img src="/projectLogo/{{ $data->project_logo }}" alt="logo {{ $data->project_name }}"
                                    class="rounded-circle" width="150" height="150">
                            @else
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a2/Logo_of_Ministry_of_Communication_and_Information_Technology_of_the_Republic_of_Indonesia.svg/1024px-Logo_of_Ministry_of_Communication_and_Information_Technology_of_the_Republic_of_Indonesia.svg.png"
                                    alt="Logo Instansi" class="rounded-circle" width="150">
                            @endif
                            <div class="mt-3">
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
                        <p class="text-muted font-size-sm">
                            {{ date('D, d M Y', strtotime($data->project_start_date)) }}
                            <b>s/d</b> {{ date('D, d M Y', strtotime($data->project_deadline)) }}
                        </p>
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
                            <h3 class="card-title text-light pt-2">Anggota Proyek</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-responsive-sm table-bordered" id="myTable">
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
                                    @foreach ($participant->where('project_id',$data->id)->get() as $list)
                                        @php
                                            $prof_part = [];
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="text-center">
                                                <div style="display: flex;
                                                                            flex-direction:column;
                                                                            justify-content:center;">
                                                    @foreach ($project_all->where('project_id',$data->id) as $prof_task)
                                                        @if ($prof_task->user_id == $list->user_id && $prof_task->prof_id != '')
                                                            <div style="padding: 3px">
                                                                <span
                                                                    class="badge @if (fmod($loop->index, 3) == 0) bg-danger
                                                                                @elseif(fmod($loop->index, 2) == 0)
                                                                                bg-warning 
                                                                                @else
                                                                                bg-success @endif">
                                                                    {{ $project_all->find($prof_task->id)->profUser()->first()->prof_name }}
                                                                    @php
                                                                        $prof_part[] = $prof_task->prof_id;
                                                                    @endphp
                                                                </span>
                                                            </div>
                                                        @else
                                                            @continue
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td>{{ $user_task->find($list->user_id)->name }}</td>
                                            <td class="text-center">
                                                @if ($user_task->find($list->user_id)->pp == '')
                                                    <img src="{{ url('pp/default.jpg') }}" class="img-circle" width="70">
                                                @else
                                                    <img src="{{ url('pp/' . $user_task->find($list->user_id)->pp) }}"
                                                        class="img-circle" width="70">
                                                @endif
                                            </td>
                                            <td style="text-align: center">
    
                                                <a class="btn btn-primary" data-toggle="modal"
                                                    href="#detail{{ $list->user_id }}"><i class="fa fa-eye"></i></a>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="detail{{ $list->user_id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Detail Anggota</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                        <div class="modal-body">
                                                            <div class="card card-primary card-outline">
                                                                <div class="card-body box-profile">
                                                                    <div class="text-center">
                                                                    @if ($user_task->find($list->user_id)->pp == '')
                                                                            <img src="{{ url('pp/default.jpg') }}"
                                                                                class="profile-user-img img-fluid img-circle">
                                                                        @else
                                                                        <img src="{{ url('pp/' . $user_task->find($list->user_id)->pp) }}"
                                                                                class="profile-user-img img-fluid img-circle">
                                                                        @endif
                                                                    </div>

                                                                    <h3 class="profile-username text-center">
                                                                    {{ $user_task->find($list->user_id)->name }}
                                                                    </h3>

                                                                    <p class="text-muted text-center">Software Engineer</p>

                                                                    <ul class="list-group list-group-unbordered mb-3">
                                                                        <li class="list-group-item">
                                                                            <b>Email</b> <a
                                                                            class="float-right">{{ $user_task->find($list->user_id)->email }}</a>
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <b>Employee Code</b> <a
                                                                            class="float-right text-dark">{{ $user_task->find($list->user_id)->code }}</a>
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <b>Prof</b> <a
                                                                            class="float-right text-dark">@if ($user_task->find($list->user_id)->profs()->first())
                                                                            {{ $user_task->find($list->user_id)->profs()->first()->prof_code }}
                                                                            @endif</a>
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <b>Profession</b> <a
                                                                                class="float-right text-dark">
                                                                            @if ($user_task->find($list->user_id)->profs()->first())
                                                                                {{ $user_task->find($list->user_id)->profs()->first()->prof_name }}
                                                                                @endif
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <!-- /.card-body -->
                                                            </div>
                                                            <h3>Task List</h3>
                                                            <div class="card card-success card-outline">
                                                                <div class="card-body box-profile">
                                                                    @if ($project_task->where('user_id',$list->user_id)->where('project_id',$data->id)->exists())
                                                                        <ul class="list-group list-group-unbordered mb-3">
                                                                            @foreach ($project_task->where('user_id',$list->user_id)->where('project_id',$data->id)->get() as $pt)
                                                                            <li class="list-group-item">
                                                                                <b class="font-weight-normal">{{$loop->iteration}}. {{$pt->details}}</b>
                                                                                <a class="float-right text-dark font-weight-bold">({{$job_list->find($pt->task_id)->task_name}})</a>
                                                                            </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    @else
                                                                        <h4 style="text-align: center" class="text-red">No Task Added</h4>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Close</button>
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
                        
    
                    </div>
                    
                    
                </div>
                <!-- /.modal-content -->
            </div>
        </div>
    </div>
</div>
@endsection
@section('empscript')
    <script>
        $(document).ready(function() {
            $("#myTable").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#myTable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    {{-- <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script> --}}
@endsection