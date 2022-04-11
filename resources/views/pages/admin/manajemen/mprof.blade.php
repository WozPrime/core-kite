@extends('pages.ui_admin.admin')
@section('title')
    Kelola Profesi
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
                    <h1>Kelola Profesi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Kelola Profesi</li>
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
                    <div class="card card-gray-dark">
                        <div class="card-header">
                            <h3 class="card-title pt-1">Daftar Profesi</h3>
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
                                        <th class="col-2">Kode Profesi</th>
                                        <th class="col-2">Nama Profesi</th>
                                        <th class="col-3">Detail</th>
                                        <th style="text-align: center">Ilustrasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($prof_list as $prof)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $prof['prof_code'] }}</td>
                                            <td>{{ $prof['prof_name'] }}</td>
                                            <td>{{ $prof['detail'] }}</td>
                                            <td style="text-align: center">
                                                @if ($prof['prof_img'] == '')
                                                    <img src="{{ url('prof/default.png') }}" class="img-circle"
                                                        width="70" height="70">
                                                @else
                                                    <img src="{{ url('prof/' . $prof['prof_img']) }}"
                                                        class="img-circle" width="70" height="70">
                                                @endif
                                            </td>
                                            <td style="text-align: center">

                                                <a class="btn btn-primary" data-toggle="modal"
                                                    href="#detail{{ $prof->id }}"><i
                                                        class="fa fa-eye"></i></a>
                                                <a class="btn btn-success" data-toggle="modal"
                                                    data-target="#edit{{ $prof->id }}"><i
                                                        class="fa fa-edit"></i></a>
                                                <a class="btn btn-danger" data-toggle="modal"
                                                    data-target="#delete{{ $prof->id }}"><i
                                                        class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="detail{{ $prof->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Lihat Detail Profesi</h4>
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
                                                                        @if ($prof->prof_img == '')
                                                                            <img src="{{ url('prof/default.png') }}"
                                                                                class="profile-user-img img-fluid img-circle" width="150"
                                                                                height="150">
                                                                        @else
                                                                            <img src="{{ url('prof/' . $prof->prof_img) }}"
                                                                                class="profile-user-img img-fluid img-circle" width="150"
                                                                                height="150">
                                                                        @endif
                                                                    </div>

                                                                    <h3 class="profile-username text-center">{{ $prof->prof_name }}
                                                                    </h3>

                                                                    <p class="text-muted text-center">{{ $prof->prof_code }}</p>

                                                                    <ul class="list-group list-group-unbordered mb-3">
                                                                        <li class="list-group-item">
                                                                            <b>Detail</b>
                                                                            <br>
                                                                            <a class="text-dark">{{ $prof->detail }}</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <!-- /.card-body -->
                                                            </div>
                                                        </section>

                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.modal -->
                                        <div class="modal fade" id="edit{{ $prof->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Detail Profesi</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="/admin/edit_prof/{{ $prof->id }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="Prof_code">Kode Profesi</label>
                                                                <input type="text" class="form-control" id="prof_code" name="prof_code"
                                                                    value="{{ $prof->prof_code }}">
                                                                <div class="text-danger">
                                                                    @error('prof_code')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="Prof_name">Nama Profesi</label>
                                                                <input type="text" class="form-control" id="prof_name" name="prof_name"
                                                                    value="{{ $prof->prof_name }}">
                                                                <div class="text-danger">
                                                                    @error('prof_name')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="Detail">Detail</label>
                                                                <input type="text" class="form-control" id="detail" name="detail"
                                                                    value="{{ $prof->detail }}">
                                                                <div class="text-danger">
                                                                    @error('detail')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="Profession_Img">Ilustrasi</label>
                                                                <div>
                                                                    <div id="prof_img" class="mb-1"></div>
                                                                    <input type="file" name="prof_img" onchange="Image_preview(event)">
                                                                    <div class="text-danger">
                                                                        @error('prof_img')
                                                                            {{ $message }}
                                                                        @enderror
                                                                    </div>
                                                                    <label>Foto yang tersimpan</label>
                                                                    <div>
                                                                        @if ($prof->prof_img == '')
                                                                            <img src="{{ url('prof/default.png') }}"
                                                                                class="img-circle" width="150">
                                                                        @else
                                                                            <img src="{{ url('prof/' . $prof->prof_img) }}"
                                                                                class="img-circle" width="150">
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                        </div>
                                                    </form>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.modal -->
                                        </div>
                                        <div class="modal fade" id="delete{{ $prof->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content bg-danger">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Hapus Data Profesi</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah anda yakin ingin Menghapus data dari {{ $prof->prof_name }} ini?
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-outline-light"
                                                            data-dismiss="modal">Tutup</button>
                                                        <a href="/admin/delete_prof/{{ $prof->id }}" type="button"
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
        <button class="material-icons floating-btn" data-toggle="modal" data-target="#insert">add</button>


        <div class="modal fade" id="insert">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Profesi Baru</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/admin/ins_prof" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="Prof_code">Kode Profesi</label>
                                <input type="text" class="form-control" id="prof_code" name="prof_code">
                                <div class="text-danger">
                                    @error('prof_code')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Prof_name">Nama Profesi</label>
                                <input type="text" class="form-control" id="prof_name" name="prof_name">
                                <div class="text-danger">
                                    @error('prof_name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Detail">Detail</label>
                                <input type="text" class="form-control" id="detail" name="detail">
                                <div class="text-danger">
                                    @error('detail')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Profession_Img">Ilustrasi</label>
                                <div>
                                    <div id="prof_img" class="mb-1"></div>
                                    <input type="file" name="prof_img" onchange="Image_preview(event)">
                                    <div class="text-danger">
                                        @error('prof_img')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->

        </div>
    </section>

@endsection
<!-- /.content -->
@section('footer')
@endsection

@endsection
