@extends('pages.ui_admin.admin')
@section('title')
    Kelola Pengguna
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
                    <h1>Kelola Pengguna</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Kelola Pengguna</li>
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
                            <h3 class="card-title pt-1">Daftar Pengguna</h3>
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
                                        <th>Nama Lengkap</th>
                                        <th>Alamat Email</th>
                                        <th>Profesi</th>
                                        <th>Kode Karyawan</th>
                                        <th>Foto Profil</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user['name'] }}</td>
                                            <td>{{ $user['email'] }}</td>
                                            <td>
                                                @if ($user->profs()->first())
                                                    {{ $user->profs()->first()->prof_code }}
                                                @endif
                                            </td>
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
                                                        <h4 class="modal-title">Lihat Profil</h4>
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

                                                                    <p class="text-muted text-center">@if (Auth::user()->profs()->first())
                                                                        {{ Auth::user()->profs()->first()->prof_name }}
                                                                    @else
                                                                        -
                                                                    @endif</p>

                                                                    <ul class="list-group list-group-unbordered mb-3">
                                                                        <li class="list-group-item">
                                                                            <b>Email</b> <a
                                                                                class="float-right">{{ $user->email }}</a>
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <b>Kode Karyawan</b> <a
                                                                                class="float-right text-dark">{{ $user->code }}</a>
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <b>Kode Profesi</b> <a class="float-right text-dark">
                                                                                @if ($user->profs()->first())
                                                                                    {{ $user->profs()->first()->prof_code }}
                                                                                @endif
                                                                            </a>
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <b>Nama Profesi</b> <a
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
                                                                    <h3 class="card-title">Tentang Saya</h3>
                                                                </div>
                                                                <!-- /.card-header -->
                                                                <div class="card-body">
                                                                    <strong><i class="fas fa-venus-mars mr-1"></i>
                                                                        Jenis Kelamin</strong>
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
                                                                        Alamat</strong>
                                                                    <p class="text-muted">
                                                                        @if ($user->address == '')
                                                                            -
                                                                        @else
                                                                            {{ $user->address }}
                                                                        @endif
                                                                    </p>

                                                                    <hr>

                                                                    <strong><i class="fas fa-user-circle mr-1"></i>
                                                                        Status</strong>

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
                                                            data-dismiss="modal">Tutup</button>
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
                                                        <h4 class="modal-title">Edit Data Pengguna</h4>
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
                                                                <label for="Name">Nama Lengkap</label>
                                                                <input type="text" class="form-control" id="name"
                                                                    name="name" value="{{ $user->name }}">
                                                                <div class="text-danger">
                                                                    @error('name')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="Code">Kode Karyawan</label>
                                                                <input type="text" class="form-control" id="code"
                                                                    name="code" value="{{ $user->code }}">
                                                                <div class="text-danger">
                                                                    @error('code')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </div>

                                                            </div>
                                                            <div class="form-group">
                                                                <label for="Gender">Jenis Kelamin</label>
                                                                <select name="gender" id="gender" class="form-control">
                                                                    <option value=""
                                                                        @if ($user->gender == '') selected @endif
                                                                        disabled hidden>Pilih jenis kelamin
                                                                    </option>
                                                                    <option value="L"
                                                                        @if ($user->gender == 'L') selected @endif>
                                                                        Laki-laki
                                                                    </option>
                                                                    <option value="P"
                                                                        @if ($user->gender == 'P') selected @endif>
                                                                        Perempuan
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="Status">Status</label>
                                                                <select name="stats" id="stats" class="form-control">
                                                                    <option value=""
                                                                        @if ($user->stats == '') selected @endif
                                                                        di sabled hidden>Pilih Status </option>
                                                                    <option value="KT"
                                                                        @if ($user->stats == 'KT') selected @endif>
                                                                        Karyawan
                                                                        Tetap</option>
                                                                    <option value="KM"
                                                                        @if ($user->stats == 'KM') selected @endif>
                                                                        Karyawan
                                                                        Magang</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="Role">Role</label>
                                                                <select name="role" id="role" class="form-control">
                                                                    <option value="member"
                                                                        @if ($user->role == 'member') selected @endif
                                                                        >Karyawan </option>
                                                                    <option value="admin"
                                                                        @if ($user->role == 'admin') selected @endif>
                                                                        Admin</option>
                                                                    <option value="client"
                                                                        @if ($user->role == 'client') selected @endif>
                                                                        Klien</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="Profession">Profesi</label>
                                                                <select name="prof_id" id="prof_id" class="form-control">
                                                                    @if ($user->profs()->first())
                                                                        <option value=""
                                                                            @if ($user->profs()->first()->id == '') selected @endif
                                                                            disabled hidden>Pilih
                                                                            Profesi
                                                                        </option>
                                                                        @foreach ($prof_list as $prof)
                                                                            <option value="{{ $prof->id }}"
                                                                                @if ($user->profs()->first()->id == $prof->id) selected @endif>
                                                                                {{ $prof->prof_name }}
                                                                            </option>
                                                                        @endforeach
                                                                    @else
                                                                        <option value="" selected disabled hidden>Pilih
                                                                            Profesi</option>
                                                                        @foreach ($prof_list as $prof)
                                                                            <option value="{{ $prof->id }}">
                                                                                {{ $prof->prof_name }}</option>
                                                                        @endforeach
                                                                    @endif

                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Alamat</label>
                                                                <textarea class="form-control" id="address" name="address"
                                                                    rows="3"
                                                                    placeholder="Enter Your Address ...">{{ $user->address }}</textarea>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="ProfilePicture">Foto Profil</label>
                                                                <div>
                                                                    <div id="pp" class="mb-1"></div>
                                                                    <input type="file" name="pp"
                                                                        onchange="Image_preview(event)">
                                                                    <div class="text-danger">
                                                                        @error('pp')
                                                                            {{ $message }}
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <label>Foto yang tersimpan</label>
                                                                <div>
                                                                    @if ($user->pp == '')
                                                                        <img src="{{ url('pp/default.jpg') }}"
                                                                            class="img-circle" width="150">
                                                                    @else
                                                                        <img src="{{ url('pp/' . $user->pp) }}"
                                                                            class="img-circle" width="150">
                                                                    @endif
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Tutup</button>
                                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah anda yakin ingin Menghapus data dari {{ $user->name }}
                                                        ini?
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-outline-light"
                                                            data-dismiss="modal">Tutup</button>
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
    <button class="material-icons floating-btn" data-toggle="modal" data-target="#insert">add</button>
    <div class="modal fade" id="insert">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Pengguna</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/admin/manage_user/new" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="Name">Nama Lengkap</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                                <div class="text-danger">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required>
                            </div>
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
                                <label for="password-confirm">Konfirmasi Password</label>
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password"
                                    placeholder="Confirm Password">
                            </div>
                            <div class="form-group">
                                <label for="Code">Kode Karyawan</label>
                                <input type="text" class="form-control" id="code" name="code" required>
                            </div>
                            <div class="form-group">
                                <label for="Gender">Jenis Kelamin</label>
                                <select name="gender" id="gender" class="form-control" required>
                                    <option selected disabled hidden>Pilih jenis kelamin
                                    </option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="Status">Status</label>
                                <select name="stats" id="stats" class="form-control" required>
                                    <option selected disabled hidden>Pilih Status
                                    </option>
                                    <option value="KT">Karyawan Tetap</option>
                                    <option value="KM">Karyawan Magang</option>
                                </select>
                            </div>
    
                            <div class="form-group">
                                <label for="Profession">Profesi</label>
                                <select name="prof_id" id="prof_id" class="form-control" required>
                                <option selected disabled hidden>Pilih Profesi</option>
                                    @foreach ($prof_list as $prof)
                                        <option value="{{ $prof->id }}">{{ $prof->prof_name }}</option>
                                    @endforeach
                                </select>
                            </div>
    
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea class="form-control" id="address" name="address" rows="3"
                                    placeholder="Enter Your Address ..."></textarea>
                            </div>
    
                            <div class="form-group">
                                <label for="ProfilePicture">Foto Profil</label>
                                <div>
                                    <div id="ava" class="mb-1"></div>
                                    <input type="file" name="ava" onchange="Image_preview2(event)">
                                    <div class="text-danger">
                                        @error('pp')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->

    </div>


@section('footer')
@endsection
@section('script')
    
<script type="text/javascript">
    function Image_preview2(event) {
        var image = URL.createObjectURL(event.target.files[0]);
        var imagediv = document.getElementById('ava');
        var newimg = document.createElement('img');
        newimg.src = image;
        newimg.width = 100;
        newimg.height = 100;
        imagediv.appendChild(newimg);
    }
</script>
@endsection
@endsection
