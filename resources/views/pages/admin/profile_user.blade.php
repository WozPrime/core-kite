@extends('pages.ui_admin.admin')
@section('title')
    Profile
@endsection
@section('body')
@section('navbar')
@endsection
@section('sidebar')
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
                        <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                        <li class="breadcrumb-item active">Your Profile</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    @if (Auth::user()->code == '' && Auth::user()->stats == '' && Auth::user()->gender == '')
        <div class="container-fluid">
            <section class="content">
                <div class="col-md-12">
                    <div class="alert alert-warning alert-dismissible ">
                        <button type="button" class="close" data-dismiss="alert"
                            aria-hidden="true">&times;</button>
                        <div class="row">
                            <div class="col-md-1">
                                <i class="icon fas fa-exclamation-triangle fa-3x ml-2 mt-2"></i>
                            </div>
                            <div class="col-md-11">
                                <h3> Data Kosong!</h3>
                                <span>Silahkan Isi data yang kosong!</span>
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
                <div class="col-md-12">
                    <div class="alert alert-warning alert-dismissible ">
                        <button type="button" class="close" data-dismiss="alert"
                            aria-hidden="true">&times;</button>
                        <div class="row">
                            <div class="col-md-1">
                                <i class="icon fas fa-exclamation-triangle fa-3x ml-2 mt-2"></i>
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
    @if (session('pesan'))
        <div class="container-fluid">
            <section class="content">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert"
                            aria-hidden="true">&times;</button>
                        <h3><i class="icon fas fa-check"></i> Success!</h3>
                        {{ session('pesan') }}
                    </div>
                </div>
            </section>
        </div>
    @endif
    @if (session('sama'))
    <div class="container-fluid">
        <section class="content">
            <div class="col-md-12">
                <div class="alert alert-secondary alert-dismissible ">
                    <button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true">&times;</button>
                    <div class="row">
                        <div class="col-md-1">
                            <i class="icon fas fa-exclamation-triangle fa-3x ml-2 mt-2"></i>
                        </div>
                        <div class="col-md-11">
                            <h3> {{session('sama')}}</h3>
                            <span>Periksa Kembali data!</span>
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
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title pt-1">Data Profile</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
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
                                    <label>Alamat</label>
                                    <textarea class="form-control" id="address" name="address" rows="3"
                                        placeholder="Enter Your Address ...">{{$data_user->address}}</textarea>
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
                <div class="col-md-4">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Password Setting</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <button type="submit" class="btn btn-warning float-left">Change Password</button>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </section>
    </section>
@endsection
<!-- /.content -->
@section('footer')
@endsection
@endsection
