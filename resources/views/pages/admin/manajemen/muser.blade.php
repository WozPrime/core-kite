@extends('pages.ui_admin.admin')
@section('title')
    Manage Users
@endsection
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
                    <h1>Manage Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Manage Users</li>
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
                    <div class="card card-lime">
                        <div class="card-header">
                            <h3 class="card-title pt-1">List of Users</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
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
                                        <th>Full Name</th>
                                        <th>Email Address</th>
                                        <th>Prof</th>
                                        <th>Employee Code</th>
                                        <th>Profile Pic</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user['name'] }}</td>
                                            <td>{{ $user['email'] }}</td>
                                            <td>@if ($user->profs()->first())
                                                {{ $user->profs()->first()->prof_code }}
                                            @endif</td>
                                            <td>{{ $user['code'] }}</td>
                                            <td style="text-align: center">
                                                @if ($user['pp'] == '')
                                                    <img src="{{ url('pp/default.jpg') }}" class="img-circle"
                                                        width="70">
                                                @else
                                                    <img src="{{ url('pp/' . $user['pp']) }}" class="img-circle"
                                                        width="70">
                                                @endif
                                            </td>
                                            <td style="text-align: center">

                                                <a class="btn btn-primary" data-toggle="modal"
                                                    href="#detail{{ $user->id }}"><i class="fa fa-eye"></i></a>
                                                <a class="btn btn-success" data-toggle="modal"
                                                    href="#edit{{ $user->id }}"><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-danger" data-toggle="modal"
                                                    href="#delete{{ $user->id }}"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="detail{{ $user->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">View Profile</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <section class="container-fluid">
                                                            <div class="card card-primary card-outline">
                                                                <div class="card-body box-profile">
                                                                    <div class="text-center">
                                                                        @if ($user->pp == '')
                                                                            <img src="{{ url('pp/default.jpg') }}"
                                                                                class="profile-user-img img-fluid img-circle">
                                                                        @else
                                                                            <img src="{{ url('pp/' . $user->pp) }}"
                                                                                class="profile-user-img img-fluid img-circle">
                                                                        @endif
                                                                    </div>

                                                                    <h3 class="profile-username text-center">
                                                                        {{ $user->name }}
                                                                    </h3>

                                                                    <p class="text-muted text-center">Software Engineer</p>

                                                                    <ul class="list-group list-group-unbordered mb-3">
                                                                        <li class="list-group-item">
                                                                            <b>Email</b> <a
                                                                                class="float-right">{{ $user->email }}</a>
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <b>Employee Code</b> <a
                                                                                class="float-right text-dark">{{ $user->code }}</a>
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <b>Prof</b> <a
                                                                                class="float-right text-dark">@if ($user->profs()->first())
                                                                                {{ $user->profs()->first()->prof_code }}
                                                                            @endif</a>
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <b>Profession</b> <a
                                                                                class="float-right text-dark">
                                                                                @if ($user->profs()->first())
                                                                                    {{ $user->profs()->first()->prof_name }}
                                                                                @endif
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <!-- /.card-body -->
                                                            </div>


                                                            <div class="card card-primary">
                                                                <div class="card-header">
                                                                    <h3 class="card-title">About Me</h3>
                                                                </div>
                                                                <!-- /.card-header -->
                                                                <div class="card-body">
                                                                    <strong><i class="fas fa-venus-mars mr-1"></i>
                                                                        Gender</strong>
                                                                    <p class="text-muted">
                                                                        @if ($user->gender == 'L')
                                                                            Laki-laki
                                                                        @elseif ($user->gender == 'P')
                                                                            Perempuan
                                                                        @else
                                                                            -
                                                                        @endif
                                                                    </p>
                                                                    <hr>

                                                                    <strong><i class="fas fa-map-marker-alt mr-1"></i>
                                                                        Address</strong>
                                                                    <p class="text-muted">
                                                                        @if ($user->address == '')
                                                                            -
                                                                        @else
                                                                            {{ $user->address }}
                                                                        @endif
                                                                    </p>

                                                                    <hr>

                                                                    <strong><i class="fas fa-user-circle mr-1"></i>
                                                                        Position</strong>

                                                                    <p class="text-muted">
                                                                        @if ($user->stats == 'KT')
                                                                            Karyawan Tetap
                                                                        @elseif ($user->stats == 'KM')
                                                                            Karyawan Magang
                                                                        @else
                                                                            -
                                                                        @endif
                                                                    </p>

                                                                    <hr>

                                                                </div>
                                                                <!-- /.card-body -->
                                                            </div>


                                                        </section>

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
                                        <!-- /.modal -->
                                        <div class="modal fade" id="edit{{ $user->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit User Data</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="/admin/profile/edit2/{{ $user->id }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="Name">Full Name</label>
                                                                <input type="text" class="form-control" id="name"
                                                                    name="name" value="{{ $user->name }}">
                                                                <div class="text-danger">
                                                                    @error('name')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="Code">Employee Code</label>
                                                                <input type="text" class="form-control" id="code"
                                                                    name="code" value="{{ $user->code }}">
                                                                <div class="text-danger">
                                                                    @error('code')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </div>

                                                            </div>
                                                            <div class="form-group">
                                                                <label for="Gender">Gender</label>
                                                                <select name="gender" id="gender" class="form-control">
                                                                    <option value="" @if ($user->gender == '') selected @endif disabled
                                                                        hidden>Pilih jenis kelamin
                                                                    </option>
                                                                    <option value="L" @if ($user->gender == 'L') selected @endif>Laki-laki
                                                                    </option>
                                                                    <option value="P" @if ($user->gender == 'P') selected @endif>Perempuan
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="Status">Status</label>
                                                                <select name="stats" id="stats" class="form-control">
                                                                    <option value="" @if ($user->stats == '') selected @endif di sabled
                                                                        hidden>Pilih Status </option>
                                                                    <option value="KT" @if ($user->stats == 'KT') selected @endif>Karyawan
                                                                        Tetap</option>
                                                                    <option value="KM" @if ($user->stats == 'KM') selected @endif>Karyawan
                                                                        Magang</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="Profession">Profession</label>
                                                                <select name="prof_id" id="prof_id" class="form-control">
                                                                    @if ($user->profs()->first())
                                                                            <option value="" @if ($user->profs()->first()->id == '')
                                                                                selected
                                                                        @endif disabled hidden>Pilih
                                                                        Profesi
                                                                        </option>
                                                                        @foreach ($prof_list as $prof)
                                                                            <option value="{{ $prof->id }}" @if ($user->profs()->first()->id == $prof->id) selected @endif>{{ $prof->prof_name }}
                                                                        </option>
                                                                        @endforeach
                                                                    @else
                                                                        <option value="" selected disabled hidden>Pilih Profesi</option>
                                                                        @foreach ($prof_list as $prof)
                                                                            <option value="{{ $prof->id }}">{{ $prof->prof_name }}</option>
                                                                        @endforeach
                                                                        @endif

                                                                        </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Alamat</label>
                                                                <textarea class="form-control" id="address" name="address" rows="3"
                                                                    placeholder="Enter Your Address ...">{{ $user->address }}</textarea>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="ProfilePicture">Profile Picture/Avatar</label>
                                                                <div>
                                                                    <div id="pp" class="mb-1"></div>
                                                                    <input type="file" name="pp" onchange="Image_preview(event)">
                                                                    <div class="text-danger">
                                                                        @error('pp')
                                                                            {{ $message }}
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <label>Saved Photo</label>
                                                                <div>
                                                                    @if ($user->pp == '')
                                                                        <img src="{{ url('pp/default.jpg') }}" class="img-circle" width="150">
                                                                    @else
                                                                        <img src="{{ url('pp/' . $user->pp) }}" class="img-circle" width="150">
                                                                    @endif
                                                                </div>
                                                            </div>

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
                                            <!-- /.modal -->
                                            <div class="modal fade" id="delete{{ $user->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content bg-danger">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Hapus Data User</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah anda yakin ingin Menghapus data dari {{ $user->name }} ini?
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                                            <a href="/admin/profile/delete/{{ $user->id }}" type="button"
                                                                class="btn btn-outline-light">Hapus Data</a>
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
                                        <!-- /.content -->


@section('footer')
@endsection
@endsection
