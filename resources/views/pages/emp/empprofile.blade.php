@extends('pages.emp.ui_emp.empmaster')
@section('title')
    Dashboard Karyawan
@endsection
@section('emphead')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
@endsection
@section('empscript')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
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
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Fill Your Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/emp/home">Home</a></li>
                        <li class="breadcrumb-item active">Your Profile</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    @if (Auth::user()->code == '' || Auth::user()->stats == '' || Auth::user()->gender == '')
        <div class="container-fluid">
            <section class="content">
                <div class="col-12">
                    <div class="alert alert-warning alert-dismissible ">
                        <button type="button" class="close" data-dismiss="alert"
                            aria-hidden="true">&times;</button>
                        <div class="row">
                            <div class="col-md-1">
                                <i class="icon fa fa-exclamation-triangle fa-3x ml-2 mt-2"></i>
                            </div>
                            <div class="col-md-11">
                                <h3>Data Masih Kosong!!!</h3>
                                <span>Silahkan Isi Data yang Kosong!!!</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    @endif
    @if (Auth::user()->pp == '')
        <div class="container-fluid">
            <section class="content">
                <div class="col-12">
                    <div class="alert alert-warning alert-dismissible ">
                        <button type="button" class="close" data-dismiss="alert"
                            aria-hidden="true">&times;</button>
                        <div class="row">
                            <div class="col-md-1">
                                <i class="icon fa fa-exclamation-triangle fa-3x ml-2 mt-2"></i>
                            </div>
                            <div class="col-md-11">
                                <h3> Foto Masih Default!</h3>
                                <span>Silahkan ganti ke foto profil yang baru!!</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    @endif


    <section class="content">
        <section class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h3 class="card-title pt-1">Data Profile</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body">
                            <form action="/admin/profile/edit/{{ $data_user->id }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="Name">Full Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $data_user->name }}">
                                    <div class="text-danger">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Code">Employee Code</label>
                                    <input type="text" class="form-control" id="code" name="code"
                                        value="{{ $data_user->code }}">
                                    <div class="text-danger">
                                        @error('code')
                                            {{ $message }}
                                        @enderror
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="Gender">Gender</label>
                                    <select name="gender" id="gender" class="form-control">
                                        <option value="" @if ($data_user->gender == '')
                                            selected @endif disabled hidden>Pilih jenis kelamin
                                        </option>
                                        <option value="L" @if ($data_user->gender == 'L')
                                            selected @endif>Laki-laki</option>
                                        <option value="P" @if ($data_user->gender == 'P')
                                            selected @endif>Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Status">Status</label>
                                    <select name="stats" id="stats" class="form-control">
                                        <option value="" @if ($data_user->stats == '')
                                            selected @endif di sabled hidden>Pilih Status
                                        </option>
                                        <option value="KT" @if ($data_user->stats == 'KT')
                                            selected @endif>Karyawan Tetap</option>
                                        <option value="KM" @if ($data_user->stats == 'KM')
                                            selected @endif>Karyawan Magang</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="Profession">Profession</label>
                                    <select name="prof_id" id="prof_id" class="form-control">
                                        <option value="" @if ($data_user->prof_id == '')
                                            selected @endif disabled hidden>Pilih Profesi
                                        </option>
                                        @foreach ($prof_list as $prof)
                                            <option value="{{ $prof->id }}" @if ($data_user->prof_id == $prof->id)
                                                selected
                                        @endif>{{ $prof->prof_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea class="form-control" id="address" name="address" rows="3"
                                        placeholder="Enter Your Address ...">{{ $data_user->address }}</textarea>
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
                                        @if ($data_user->pp == '')
                                            <img src="{{ url('pp/default.jpg') }}" class="img-circle" width="150">
                                        @else
                                            <img src="{{ url('pp/' . $data_user->pp) }}" class="img-circle"
                                                width="150">
                                        @endif
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary float-right">Submit</button>

                            </form>
                        </div>
                        <!-- /.card-body -->



                    </div>
                </div>
                <div class="col-4">
                    <div class="card card-danger">
                        <div class="card-header bg-warning">
                            <h3 class="card-title">Change Your Password</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="/admin/profile/cpass/{{ $data_user->id }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password" placeholder="Password">
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
                                <button type="submit" class="btn btn-warning float-left">Change Password</button>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </section>
    </section>
@endsection
