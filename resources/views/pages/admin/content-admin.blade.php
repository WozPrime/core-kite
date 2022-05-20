@extends('pages.ui_admin.admin')
@section('title')
    Admin Dashboard
@endsection
@section('body')
@section('navbar')
@endsection
@section('sidebar')
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            @php
                                $comp = $task->where('status',2)->count();
                                $sumt = $task->count();
                                if ($sumt != 0) {
                                    $ct = (round($comp/$sumt,2) * 100);
                                }
                                else {
                                    $ct = 0;
                                }
                            @endphp
                            <h3>{{$ct}}<sup style="font-size: 20px">%</sup></h3>

                            <p>Tugas Terselesaikan</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-clipboard"></i>
                        </div>
                        <a href="/admin/tables" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            @php
                                $pdone = $project->where('project_status','Selesai')->count();
                                $psum = $project->count();
                            @endphp
                            <h3>{{$pdone}} / {{$psum}}</sup></h3>

                            <p>Proyek Terselesaikan</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="/admin/tables" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$user->count()}}</h3>

                            <p>Total Pengguna</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="/admin/tables" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{$client}}</h3>

                            <p>Total Klien</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="/admin/tables" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-7 connectedSortable">
                    <div class="card">
                        <div class="card-header border-0">
                            
                            <h3 class="card-title">
                            <i class="far fa-calendar-alt"></i>
                            Calendar
                            </h3>
                            <!-- tools card -->
                            <div class="card-tools">
                            <!-- button with a dropdown -->
                            <div class="btn-group">
                                <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                                <i class="fas fa-bars"></i>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                <a href="/admin/testCal" class="dropdown-item">View calendar</a>
                                </div>
                            </div>
                            <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                            </div>
                            <!-- /. tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body pt-0">
                            <!--The calendar -->
                            <div id="calendar" style="width: 100%"></div>
                        </div>
                        <!-- /.card-body -->
                            <!-- /.Left col -->
                            <!-- right col (We are only adding the ID to make the widgets sortable)-->
                            <section class="col-lg-5 connectedSortable">
                                <div id="evoCal"></div>
                            </section>
                            <!-- right col -->
                            
                    </div>
                </section>
                <section class="col-lg-5 connectedSortable">
                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">Proyek</h3>
                            <div class="card-tools">
                                <a href="#" class="btn btn-tool btn-sm">
                                    <i class="fas fa-bars"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped table-valign-middle">
                                <thead>
                                    <tr>
                                        <th>Nama Proyek</th>
                                        <th style="text-align: center">Status</th>
                                        <th style="text-align: center">Persentase Proyek</th>
                                        <th style="text-align: center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $list_project = DB::table('projects')->where('project_status', '!=', 'Selesai')->orderBy('id', 'desc')->take(4)->get();
                                    @endphp
                                    @foreach ($list_project as $tbl_project)
                                    <tr>
                                        <td>{{ $tbl_project->project_name }}</td>
                                        <td style="text-align: center">
                                            <span class="badge @if ($tbl_project->project_status == 'Baru') bg-primary
                                                @elseif ($tbl_project->project_status == 'Tertunda') bg-danger
                                                @elseif ($tbl_project->project_status == 'Sedang Berjalan') bg-warning
                                                @elseif ($tbl_project->project_status == 'Selesai') bg-success @endif">
                                                {{ $tbl_project->project_status }}
                                            </span>
                                        </td>
                                        <td style="text-align: center">
                                            {{-- <div class="row"> --}}
                                            <div 
                                                @php
                                                $pcount = $task->where('project_id', $tbl_project->id)->count('id');
                                                $pstatus = $task->where('project_id', $tbl_project->id)->where('status', '==', 2)->count('id');
                                                if($pcount == 0) {$progress = 0;}
                                                elseif($pcount > 0) {$progress = floor(($pstatus / $pcount) * 100);}
                                                @endphp 
                                                @if($pcount == 0) class="badge bg-danger" 
                                                @elseif ($pcount > 0 && $progress < 100)  class="progress progress-xs pb-3" 
                                                @elseif($pcount > 0 && $progress == 100) class="badge bg-success" 
                                                @endif>
                                                <div @if($pcount > 0 && $progress >= 0 && $progress <= 25) class="progress-bar bg-danger pb-3"
                                                    @elseif($pcount > 0 && $progress > 25 && $progress <= 50) class="progress-bar bg-warning pb-3"
                                                    @elseif($pcount > 0 && $progress > 50 && $progress <= 75) class="progress-bar bg-danger pb-3"
                                                    @elseif($pcount > 0 && $progress > 75 && $progress < 100) class="progress-bar bg-bar-success pb-3"
                                                    @endif
                                                    @if($pcount > 0 && $progress <= 25) style="background-color:red !important;width:{{ $progress }}%;"
                                                    @elseif($pcount > 0 && $progress >= 25 && $progress < 100) style="width:{{ $progress }}%"
                                                    @endif>
                                                    @if($pcount == 0) Belum ada tugas yang disiapkan
                                                    @elseif($pcount > 0 && $progress == 100) Seluruh tugas proyek sudah terselesaikan
                                                    @endif
                                                </div>
                                            </div>

                                            @if($pcount > 0 && $progress >= 0 && $progress < 100) <span class="badge 
                                                @if($pcount > 0 && $progress >= 0 && $progress < 25) bg-danger float-left
                                                @elseif($pcount > 0 && $progress >= 25 && $progress < 50) bg-warning 
                                                @elseif($pcount > 0 && $progress >= 50 && $progress < 75) bg-primary 
                                                @elseif($pcount > 0 && $progress >= 75 && $progress < 100) bg-success float-right
                                                @endif col-2" 
                                                @if($pcount > 0 && $progress >= 25 && $progress < 50) style="margin-right:130px; margin-top:5px"
                                                @elseif($pcount > 0 && $progress > 50 && $progress <= 75) style="margin-left:130px; margin-top:5px"
                                                @endif>{{ $progress }}%</span>
                                            @endif
                                            {{-- </div> --}}
                                        </td>
                                        <td style="text-align: center">
                                            <a href="/admin/proyek/{{ $tbl_project->id }}">
                                                <i class="fas fa-search"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
                <!-- Calendar -->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
<!-- /.content -->
@section('footer')
@endsection
@section('script')
<script>
    $(function() {


        /* initialize the calendar
         -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)
        var date = new Date()
        var d = date.getDate(),
            m = date.getMonth(),
            y = date.getFullYear()

        var Calendar = FullCalendar.Calendar;
        var Draggable = FullCalendar.Draggable;

        var calendarEl = document.getElementById('calendar');
        var agenda = @json($agenda);
        // initialize the external events
        // -----------------------------------------------------------------

        

        var calendar = new Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            themeSystem: 'bootstrap',
            //Random default events
            events: agenda,
            editable: false,
            droppable: true, // this allows things to be dropped onto the calendar !!!
            drop: function(info) {
                // is the "remove after drop" checkbox checked?
                if (checkbox.checked) {
                    // if so, remove the element from the "Draggable Events" list
                    info.draggedEl.parentNode.removeChild(info.draggedEl);
                }
            }
        });

        calendar.render();
        // $('#calendar').fullCalendar()
        

        
    })
</script>
@endsection
@endsection
