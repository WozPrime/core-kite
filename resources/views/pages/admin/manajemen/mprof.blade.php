@extends('pages.ui_admin.admin')
@section('title')
    Manage Profession
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
                    <h1>Manage Profession</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Manage Profession</li>
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
                            <h3 class="card-title pt-1">List of Professions</h3>
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
                                        <th class="col-2">Profession Code</th>
                                        <th class="col-2">Profession Name</th>
                                        <th class="col-3">Detail</th>
                                        <th style="text-align: center">Illustration</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($role_list as $role)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $role['role_code'] }}</td>
                                            <td>{{ $role['role_name'] }}</td>
                                            <td>{{ $role['detail'] }}</td>
                                            <td style="text-align: center">
                                                @if ($role['role_img'] == '')
                                                    <img src="{{ url('role/default.png') }}" class="img-circle"
                                                        width="70" height="70">
                                                @else
                                                    <img src="{{ url('role/' . $role['role_img']) }}"
                                                        class="img-circle" width="70" height="70">
                                                @endif
                                            </td>
                                            <td style="text-align: center">

                                                <a class="btn btn-primary" data-toggle="modal"
                                                    href="#detail{{ $role->id }}"><i
                                                        class="fa fa-eye"></i></a>
                                                <a class="btn btn-success" data-toggle="modal"
                                                    data-target="#edit{{ $role->id }}"><i
                                                        class="fa fa-edit"></i></a>
                                                <a class="btn btn-danger" data-toggle="modal"
                                                    data-target="#delete{{ $role->id }}"><i
                                                        class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="detail{{ $role->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">View Profession Detail</h4>
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
                                                                        @if ($role->role_img == '')
                                                                            <img src="{{ url('role/default.png') }}"
                                                                                class="profile-user-img img-fluid img-circle" width="150"
                                                                                height="150">
                                                                        @else
                                                                            <img src="{{ url('role/' . $role->role_img) }}"
                                                                                class="profile-user-img img-fluid img-circle" width="150"
                                                                                height="150">
                                                                        @endif
                                                                    </div>

                                                                    <h3 class="profile-username text-center">{{ $role->role_name }}
                                                                    </h3>

                                                                    <p class="text-muted text-center">{{ $role->role_code }}</p>

                                                                    <ul class="list-group list-group-unbordered mb-3">
                                                                        <li class="list-group-item">
                                                                            <b>Detail</b>
                                                                            <br>
                                                                            <a class="text-dark">{{ $role->detail }}</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <!-- /.card-body -->
                                                            </div>
                                                        </section>

                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.modal -->
                                        <div class="modal fade" id="edit{{ $role->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Profession Details</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="/admin/edit_role/{{ $role->id }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="Prof_code">Profession Code</label>
                                                                <input type="text" class="form-control" id="role_code" name="role_code"
                                                                    value="{{ $role->role_code }}">
                                                                <div class="text-danger">
                                                                    @error('role_code')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="Prof_name">Profession Name</label>
                                                                <input type="text" class="form-control" id="role_name" name="role_name"
                                                                    value="{{ $role->role_name }}">
                                                                <div class="text-danger">
                                                                    @error('role_name')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="Detail">Details</label>
                                                                <input type="text" class="form-control" id="detail" name="detail"
                                                                    value="{{ $role->detail }}">
                                                                <div class="text-danger">
                                                                    @error('detail')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="Profession_Img">Profession Image</label>
                                                                <div>
                                                                    <div id="role_img" class="mb-1"></div>
                                                                    <input type="file" name="role_img" onchange="Image_preview(event)">
                                                                    <div class="text-danger">
                                                                        @error('role_img')
                                                                            {{ $message }}
                                                                        @enderror
                                                                    </div>
                                                                    <label>Saved Photo</label>
                                                                    <div>
                                                                        @if ($role->role_img == '')
                                                                            <img src="{{ url('role/default.png') }}"
                                                                                class="img-circle" width="150">
                                                                        @else
                                                                            <img src="{{ url('role/' . $role->role_img) }}"
                                                                                class="img-circle" width="150">
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </form>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.modal -->
                                        </div>
                                        <div class="modal fade" id="delete{{ $role->id }}">
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
                                                        Apakah anda yakin ingin Menghapus data dari {{ $role->role_name }} ini?
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-outline-light"
                                                            data-dismiss="modal">Close</button>
                                                        <a href="/admin/delete_role/{{ $role->id }}" type="button"
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
                        <h4 class="modal-title">Input New Profession</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/admin/ins_role" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="Prof_code">Profession Code</label>
                                <input type="text" class="form-control" id="role_code" name="role_code">
                                <div class="text-danger">
                                    @error('role_code')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Prof_name">Profession Name</label>
                                <input type="text" class="form-control" id="role_name" name="role_name">
                                <div class="text-danger">
                                    @error('role_name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Detail">Details</label>
                                <input type="text" class="form-control" id="detail" name="detail">
                                <div class="text-danger">
                                    @error('detail')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Profession_Img">Profession Image</label>
                                <div>
                                    <div id="role_img" class="mb-1"></div>
                                    <input type="file" name="role_img" onchange="Image_preview(event)">
                                    <div class="text-danger">
                                        @error('role_img')
                                            {{ $message }}
                                        @enderror
                                    </div>
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
    </section>

@endsection
<!-- /.content -->
@section('footer')
@endsection

@endsection
