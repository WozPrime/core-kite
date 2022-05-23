@php
use Carbon\Carbon;
@endphp
@extends('pages.emp.ui_emp.empmaster')
@section('title')
    Dashboard Karyawan
@endsection

@section('content')
    <div class="main-content-inner">
        <div class="container">
            <div class="row">
                <!-- Social Campain area start -->
                <div class="col-lg-4 mt-5">
                    <!-- TO DO List -->

                    <!-- Profile Image -->
                    <div class="card card-orange card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                @if (Auth::user()->pp == '')
                                    <img src="{{ url('pp/default.jpg') }}" class="profile-user-img img-fluid img-circle">
                                @else
                                    <img src="{{ url('pp/' . $data_user->pp) }}"
                                        class="profile-user-img img-fluid img-circle">
                                @endif
                            </div>

                            <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

                            <p class="text-muted text-center">
                                @if (Auth::user()->profs()->first())
                                    {{ Auth::user()->profs()->first()->prof_name }}
                                @else
                                    -
                                @endif
                            </p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <strong><i class="fas fa-at mr-1"></i> Email</strong> <a
                                        class="float-right">{{ Auth::user()->email }}</a>
                                </li>
                                <li class="list-group-item">
                                    <strong><i class="fas fa-user-tie mr-1"></i> Status</strong> <a class="float-right">
                                        @if (Auth::user()->stats == null)
                                            -
                                        @endif
                                        @if (Auth::user()->stats == 'KM')
                                            Karyawan Magang
                                        @elseif(Auth::user()->stats == 'KT')
                                            Karyawan Tetap
                                        @endif
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <strong><i class="fas fa-map-pin mr-1"></i> Alamat</strong> <a class="float-right">
                                        @if (Auth::user()->address == null)
                                            -
                                        @endif
                                        {{ Auth::user()->address }}
                                    </a>
                                </li>
                            </ul>

                            <a href="/emp/profile" class="btn btn-dark btn-block"><b>Profil Saya</b></a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <!-- /.card -->
                </div>
                <!-- Social Campain area end -->
                <!-- seo fact area start -->
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-md-6 mt-5 mb-3">
                            <div class="card">
                                <div class="seo-fact sbg1">
                                    <div class="p-4 d-flex justify-content-between align-items-center">
                                        <div class="seofct-icon"><i class="ti-layers"></i> Proyek yang Terlibat
                                        </div>
                                        <h2>{{ $involved }}</h2>
                                    </div>
                                    <canvas id="seolinechart1" height="50"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-md-5 mb-3">
                            <div class="card">
                                <div class="seo-fact sbg2">
                                    <div class="p-4 d-flex justify-content-between align-items-center">
                                        <div class="seofct-icon"><i class="ti-check-box"></i> Tingkat Penyelesaian
                                        </div>
                                        <h2>{{ $ct }} %</h2>
                                    </div>
                                    <canvas id="seolinechart2" height="50"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3 mb-lg-0">
                            <div class="card">
                                <div class="seo-fact sbg3">
                                    <div class="p-4 d-flex justify-content-between align-items-center">
                                        <div class="seofct-icon"><i class="ti-layout-list-thumb-alt"></i> Total Tugas
                                            Bulan Ini</div>
                                        <h2>{{ $sumMonth }}</h2>
                                    </div>
                                    <canvas id="seolinechart3" height="60"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="seo-fact sbg4">
                                    <div class="p-4 d-flex justify-content-between align-items-center">
                                        <div class="seofct-icon"><i class="ti-cup"></i> Total Poin Bulan Ini
                                        </div>
                                        <h2>{{ $ptsMonth }} pts</h2>
                                    </div>
                                    <canvas id="seolinechart4" height="60"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- seo fact area end -->
                <!-- Statistics area start -->
                <div class="col-lg-8 mt-5">
                    <div class="card">
                        <div class="card-header border-0">

                            <h3 class="card-title">
                                <i class="far fa-calendar-alt"></i>
                                Calendar
                            </h3>
                            <!-- tools card -->
                            
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
                </div>
                <!-- Statistics area end -->
                <!-- Advertising area start -->
                <div class="col-lg-4 mt-5">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="ion ion-clipboard mr-1"></i>
                                To Do List
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <ul class="todo-list ui-sortable" data-widget="todo-list">
                                <input type="hidden" id="idJobs"
                                    value="{{ json_encode($project_task->pluck('id')->toArray()) }}">
                                @php
                                    $nearestDeadline = new stdClass();
                                    $nearestDeadline->time = null;
                                    $diffMinutes = null;
                                    $firstDayofMonth = Carbon::now()->startOfMonth()->toDateString();
                                    $lastDayofMonth = Carbon::now()->endOfMonth()->toDateString();
                                    $date = [$firstDayofMonth,$lastDayofMonth];
                                @endphp
                                @foreach ($project_task as $job)
                                    @php
                                        $subsDate = floor((strtotime($job->expired_at) - strtotime(Carbon::now())) / 86400);
                                        if ($subsDate > 0) {
                                            $diffMinutes = Carbon::parse($job->expired_at)->diffInRealMinutes();
                                            $deadlineMinutes = Carbon::parse($nearestDeadline->time)->diffInRealMinutes();
                                            if (!$job->post_date) {
                                                if ($nearestDeadline->time == null || $deadlineMinutes > $diffMinutes) {
                                                    $nearestDeadline->time = date('F d, Y H:i:s', strtotime($job->expired_at));
                                                    $nearestDeadline->task = $tasks
                                                        ->where('id', $job->task_id)
                                                        ->pluck('task_name')
                                                        ->implode(' ');
                                                }
                                            }
                                        }
                                        
                                    @endphp
                                    <li>
                                        <div class="icheck-primary d-inline ml-2">
                                            <input type="checkbox" value="" disabled name="todo{{ $job->id }}"
                                                id="todoCheck{{ $job->id }}"
                                                @if ($job->upload_details && $file_task->where('pt_id', $job->id)->count() > 0) checked @endif>
                                            <label for="todoCheck{{ $job->id }}"></label>
                                        </div>
                                        <span
                                            class="text">{{ $tasks->where('id', $job->task_id)->pluck('task_name')->implode(' ') }}</span>
                                        <small
                                            class="badge 
                                        @if ($subsDate > 0) @if ($diffMinutes > 7 * 1440)
                                            badge-success
                                            @elseif ($diffMinutes <= 7 * 1440 && $diffMinutes > 4 * 1440)
                                            badge-primary
                                            @elseif ($diffMinutes <= 4 * 1440 && $diffMinutes > 1 * 1440)
                                            badge-warning @endif
                                            @else
                                            badge-danger
                                        @endif
                                        "
                                            id='deadline'><i class="far fa-clock"></i>
                                            @if ($subsDate > 0)
                                                @if ($diffMinutes > 1440)
                                                    {{ floor($diffMinutes / 1440) }} Hari
                                                @else
                                                    {{ floor($diffMinutes / 60) }} Jam
                                                @endif
                                            @else
                                                Terlewati
                                            @endif
                                        </small>
                                        <div style="float: right">
                                                <i class="fas fa-award" style="color: var(--gray)"></i>  {{$tasks->where('id', $job->task_id)->pluck('points')->implode(' ')}} pts
                                        </div>
    
                                    </li>
                                    
                                @endforeach
                            </ul>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                        <a type="button" href="/emp/joblist" class="btn btn-primary float-right"><i class="fas fa-tasks"></i> Lihat Selengkapnya</a>
                        </div>
                    </div>
                    <div class="info-box bg-primary">
                        <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">
                                @isset($nearestDeadline->task)
                                    {{ $nearestDeadline->task }}
                                @endisset
                            </span>
                            <h4 id="demo" class="mt-3 mb-3" style="text-align: left; border-radius: 5px;"></h4>
                            <input type="hidden" id="nearded" name="nearded" value="{{ json_encode($nearestDeadline) }}">
                            <div class="progress">
                                <div class="progress-bar bg-light" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                                Tugas Yang Harus Diselesaikan Sebelum Tenggat Waktu
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </div>
                {{-- <!-- Advertising area end -->
            </div>
            <!-- sales area start -->
            <div class="col-xl-8 col-lg-8 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Sales</h4>
                        <div id="salesanalytic"></div>
                    </div>
                </div>
            </div>
            <!-- sales area end -->
            <!-- timeline area start -->
            <div class="col-xl-4 col-lg-4 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Timeline</h4>
                        <div class="timeline-area">
                            <div class="timeline-task">
                                <div class="icon bg1">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <div class="tm-title">
                                    <h4>Rashed sent you an email</h4>
                                    <span class="time"><i class="ti-time"></i>09:35</span>
                                </div>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                                </p>
                            </div>
                            <div class="timeline-task">
                                <div class="icon bg2">
                                    <i class="fa fa-exclamation-triangle"></i>
                                </div>
                                <div class="tm-title">
                                    <h4>Rashed sent you an email</h4>
                                    <span class="time"><i class="ti-time"></i>09:35</span>
                                </div>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                                </p>
                            </div>
                            <div class="timeline-task">
                                <div class="icon bg2">
                                    <i class="fa fa-exclamation-triangle"></i>
                                </div>
                                <div class="tm-title">
                                    <h4>Rashed sent you an email</h4>
                                    <span class="time"><i class="ti-time"></i>09:35</span>
                                </div>
                            </div>
                            <div class="timeline-task">
                                <div class="icon bg3">
                                    <i class="fa fa-bomb"></i>
                                </div>
                                <div class="tm-title">
                                    <h4>Rashed sent you an email</h4>
                                    <span class="time"><i class="ti-time"></i>09:35</span>
                                </div>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                                </p>
                            </div>
                            <div class="timeline-task">
                                <div class="icon bg3">
                                    <i class="ti-signal"></i>
                                </div>
                                <div class="tm-title">
                                    <h4>Rashed sent you an email</h4>
                                    <span class="time"><i class="ti-time"></i>09:35</span>
                                </div>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- timeline area end -->
            <!-- map area start -->
            <div class="col-lg-5 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Marketing Area</h4>
                        <div id="seomap"></div>
                    </div>
                </div>
            </div>
            <!-- map area end -->
            <!-- testimonial area start -->
            <div class="col-lg-7 mt-5">
                <div class="card">
                    <div class="card-body bg1">
                        <h4 class="header-title text-white">Client Feadback</h4>
                        <div class="testimonial-carousel owl-carousel">
                            <div class="tst-item">
                                <div class="tstu-img">
                                    <img src="assets/images/team/team-author1.jpg" alt="author image">
                                </div>
                                <div class="tstu-content">
                                    <h4 class="tstu-name">Abel Franecki</h4>
                                    <span class="profsn">Designer</span>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae laborum ut nihil numquam a aliquam alias necessitatibus ipsa soluta quam!</p>
                                </div>
                            </div>
                            <div class="tst-item">
                                <div class="tstu-img">
                                    <img src="assets/images/team/team-author2.jpg" alt="author image">
                                </div>
                                <div class="tstu-content">
                                    <h4 class="tstu-name">Abel Franecki</h4>
                                    <span class="profsn">Designer</span>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae laborum ut nihil numquam a aliquam alias necessitatibus ipsa soluta quam!</p>
                                </div>
                            </div>
                            <div class="tst-item">
                                <div class="tstu-img">
                                    <img src="assets/images/team/team-author3.jpg" alt="author image">
                                </div>
                                <div class="tstu-content">
                                    <h4 class="tstu-name">Abel Franecki</h4>
                                    <span class="profsn">Designer</span>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae laborum ut nihil numquam a aliquam alias necessitatibus ipsa soluta quam!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- testimonial area end --> --}}
            </div>
        </div>
    </div>
@section('empscript')
    <script>
        
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


            // Set the date we're counting down to
            var nearded = JSON.parse(document.getElementById("nearded").value);
            var countDownDate = new Date(nearded.time).getTime();
            // Update the count down every 1 second
            var x = setInterval(function() {

                // Get today's date and time
                var now = new Date().getTime();

                // Find the distance between now and the count down date
                var distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Output the result in an element with id="demo"
                document.getElementById("demo").innerHTML = days + "d " + hours + "h " +
                    minutes + "m " + seconds + "s ";

                // If the count down is over, write some text 
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("demo").innerHTML = " - ";
                }
            }, 1000);
    </script>
@endsection
@endsection
