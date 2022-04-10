@extends('pages.emp.ui_emp.empmaster')
@section('title')
    Dashboard Karyawan
@endsection
@section('content')
    <br>
    @if (Auth::user()->code == '' || Auth::user()->stats == '' || Auth::user()->gender == '')
        <div class="container-fluid">
            @include('pages.misc.alert')
        </div>
    @endif
    @if (Auth::user()->pp == '')
        <div class="container-fluid">
            @include('pages.misc.alert2')
        </div>
    @endif


    <section class="content">
        <section class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                @if ($data_user->pp == '')
                                    <img src="{{ url('pp/default.jpg') }}" class="profile-user-img img-fluid img-circle">
                                @else
                                    <img src="{{ url('pp/' . $data_user->pp) }}"
                                        class="profile-user-img img-fluid img-circle">
                                @endif
                            </div>

                            <h3 class="profile-username text-center">{{ $data_user->name }}</h3>

                            <p class="text-muted text-center">
                                @if ($data_user->profs()->first())
                                    {{ $data_user->profs()->first()->prof_name }}
                                @else
                                    -
                                @endif
                            </p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Task Completed</b> <a
                                        class="float-right text-dark">{{ $task_list->where('user_id', $data_user->id)->where('status', 2)->count() }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Task Ongoing</b> <a
                                        class="float-right text-dark">{{ $task_list->where('user_id', $data_user->id)->where('status', '<>', 2)->count() }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Project Involved</b> <a
                                        class="float-right text-dark">{{ $task_list->where('user_id', $data_user->id)->groupBy('project_id')->count('project_id') }}</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->


                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#bio"
                                        data-toggle="tab">Biodata</a></li>
                                {{-- <li class="nav-item"><a class="nav-link" href="#timeline"
                                    data-toggle="tab">Timeline</a></li> --}}
                                <li class="nav-item"><a class="nav-link" href="#settings"
                                        data-toggle="tab">Edit</a></li>
                                <li class="nav-item"><a class="nav-link" href="#changepass"
                                        data-toggle="tab">Change Password</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="bio">
                                    <!-- Post -->
                                    <strong><i class="fas fa-at mr-1"></i> Email</strong>
                                    <p class="text-muted">
                                        {{ $data_user->email }}
                                    </p>
                                    <hr>
                                    <strong><i class="fas fa-signature mr-1"></i> Full Name</strong>
                                    <p class="text-muted">{{ $data_user->name }}</p>

                                    <hr>

                                    <strong><i class="fas fa-list-ol mr-1"></i> Employee Code</strong>
                                    <p class="text-muted">
                                        @if ($data_user->code == null)
                                            -
                                        @endif
                                        {{ $data_user->code }}
                                    </p>
                                    <hr>

                                    <strong><i class="fas fa-user-tie mr-1"></i> Status</strong>
                                    <p class="text-muted">
                                        @if ($data_user->stats == null)
                                            -
                                        @endif
                                        @if ($data_user->stats == 'KM')
                                            Karyawan Magang
                                        @elseif($data_user->stats == 'KT')
                                            Karyawan Tetap
                                        @endif
                                    </p>

                                    <hr>
                                    <strong><i class="fas fa-venus-mars mr-1"></i> Gender</strong>
                                    <p class="text-muted">
                                        @if ($data_user->gender == null)
                                            -
                                        @endif
                                        @if ($data_user->gender == 'L')
                                            Male
                                        @elseif($data_user->gender == 'P')
                                            Female
                                        @endif
                                    </p>
                                    <hr>
                                    <strong><i class="fas fa-map-pin mr-1"></i> Address</strong>
                                    <p class="text-muted">
                                        @if ($data_user->address == null)
                                            -
                                        @endif
                                        {{ $data_user->address }}
                                    </p>


                                    <!-- /.post -->
                                </div>
                                <!-- /.tab-pane -->
                                {{-- <div class="tab-pane" id="timeline">
                                <!-- The timeline -->
                                <div class="timeline timeline-inverse">
                                    <!-- timeline time label -->
                                    <div class="time-label">
                                        <span class="bg-danger">
                                            10 Feb. 2014
                                        </span>
                                    </div>
                                    <!-- /.timeline-label -->
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-envelope bg-primary"></i>

                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-clock"></i> 12:05</span>

                                            <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email
                                            </h3>

                                            <div class="timeline-body">
                                                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                                weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                                jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                                quora plaxo ideeli hulu weebly balihoo...
                                            </div>
                                            <div class="timeline-footer">
                                                <a href="#" class="btn btn-primary btn-sm">Read more</a>
                                                <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-user bg-info"></i>

                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-clock"></i> 5 mins
                                                ago</span>

                                            <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted
                                                your friend request
                                            </h3>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-comments bg-warning"></i>

                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-clock"></i> 27 mins
                                                ago</span>

                                            <h3 class="timeline-header"><a href="#">Jay White</a> commented on your
                                                post</h3>

                                            <div class="timeline-body">
                                                Take me to your leader!
                                                Switzerland is small and neutral!
                                                We are more like Germany, ambitious and misunderstood!
                                            </div>
                                            <div class="timeline-footer">
                                                <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                    <!-- timeline time label -->
                                    <div class="time-label">
                                        <span class="bg-success">
                                            3 Jan. 2014
                                        </span>
                                    </div>
                                    <!-- /.timeline-label -->
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-camera bg-purple"></i>

                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-clock"></i> 2 days
                                                ago</span>

                                            <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos
                                            </h3>

                                            <div class="timeline-body">
                                                <img src="https://placehold.it/150x100" alt="...">
                                                <img src="https://placehold.it/150x100" alt="...">
                                                <img src="https://placehold.it/150x100" alt="...">
                                                <img src="https://placehold.it/150x100" alt="...">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                    <div>
                                        <i class="far fa-clock bg-gray"></i>
                                    </div>
                                </div>
                            </div> --}}
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="settings">
                                    <form action="/admin/profile/edit/{{ $data_user->id }}" method="POST"
                                        enctype="multipart/form-data" class="form-horizontal">
                                        @csrf
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="card-body">
                                                    <div class="form-group row">
                                                        <label for="Name">Full Name</label>
                                                        <input type="text" class="form-control" id="name" name="name"
                                                            value="{{ $data_user->name }}">
                                                        <div class="text-danger">
                                                            @error('name')
                                                                {{ $message }}
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="Code">Employee Code</label>
                                                        <input type="text" class="form-control" id="code" name="code"
                                                            value="{{ $data_user->code }}">
                                                        <div class="text-danger">
                                                            @error('code')
                                                                {{ $message }}
                                                            @enderror
                                                        </div>

                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="Gender">Gender</label>
                                                        <select name="gender" id="gender" class="form-control">
                                                            <option value=""
                                                                @if ($data_user->gender == '') selected @endif disabled
                                                                hidden>
                                                                Pilih jenis kelamin
                                                            </option>
                                                            <option value="L"
                                                                @if ($data_user->gender == 'L') selected @endif>Laki-laki
                                                            </option>
                                                            <option value="P"
                                                                @if ($data_user->gender == 'P') selected @endif>Perempuan
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="Status">Status</label>
                                                        <select name="stats" id="stats" class="form-control">
                                                            <option value=""
                                                                @if ($data_user->stats == '') selected @endif disabled
                                                                hidden>
                                                                Pilih Status
                                                            </option>
                                                            <option value="KT"
                                                                @if ($data_user->stats == 'KT') selected @endif>Karyawan
                                                                Tetap
                                                            </option>
                                                            <option value="KM"
                                                                @if ($data_user->stats == 'KM') selected @endif>Karyawan
                                                                Magang
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="Profession">Profession</label>
                                                        <select name="prof_id" id="prof_id" class="form-control">
                                                            @if ($data_user->profs()->first())
                                                                <option value=""
                                                                    @if ($data_user->profs()->first()->id == '') selected @endif
                                                                    disabled hidden>Pilih
                                                                    Profesi
                                                                </option>
                                                                @foreach ($prof_list as $prof)
                                                                    <option value="{{ $prof->id }}"
                                                                        @if ($data_user->profs()->first()->id == $prof->id) selected @endif>
                                                                        {{ $prof->prof_name }}
                                                                    </option>
                                                                @endforeach
                                                            @else
                                                                <option value="" selected disabled hidden>Pilih Profesi
                                                                </option>
                                                                @foreach ($prof_list as $prof)
                                                                    <option value="{{ $prof->id }}">
                                                                        {{ $prof->prof_name }}</option>
                                                                @endforeach
                                                            @endif

                                                        </select>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="card-body">
                                                    <div class="form-group row">
                                                        <label>Alamat</label>
                                                        <textarea class="form-control" id="address" name="address" rows="3"
                                                            placeholder="Enter Your Address ...">{{ $data_user->address }}</textarea>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="ProfilePicture" class="col-12">Profile Picture/Avatar</label>
                                                        <div style="margin-bottom: 20px">
                                                            <div id="pp" class="mb-1"></div>
                                                            <input type="file" name="pp" onchange="Image_preview(event)">
                                                            <div class="text-danger">
                                                                @error('pp')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <label class="col-12">Saved Photo</label>
                                                        <div>
                                                            @if ($data_user->pp == '')
                                                                <img src="{{ url('pp/default.jpg') }}"
                                                                    class="img-circle" width="150">
                                                            @else
                                                                <img src="{{ url('pp/' . $data_user->pp) }}"
                                                                    class="img-circle" width="150">
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary float-right">Submit</button>

                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="changepass">
                                    <div class="card-body">
                                        <form action="/admin/profile/cpass/{{ $data_user->id }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" required autocomplete="new-password"
                                                    placeholder="Password">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="password-confirm">Confirm Password</label>
                                                <input id="password-confirm" type="password" class="form-control"
                                                    name="password_confirmation" required autocomplete="new-password"
                                                    placeholder="Confirm Password">
                                            </div>
                                            <br>
                                            <button type="submit" class="btn btn-warning float-left">Change
                                                Password</button>
                                        </form>
                                    </div>
                                </div>
                                {{-- TAB PANE --}}
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
        </section>
    </section>
@endsection
