@extends('pages.ui_admin.admin')

@section('title')
    Finance Reports
@endsection
<style>
    .select2-container .select2-selection--single {
        height: 38px !important;
    }

</style>
<style>
    * {
        margin: 0;
        padding: 0;

    }

    .action {
        width: 50px;
        height: 50px;
        background: var(--white);
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        border-radius: 50%;
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.25);
        position: fixed;
        right: 20px;
        bottom: 20px;
        transition: background 0.25s;

        /* button */
        outline: gray;
        border: none;
        cursor: pointer;

        /*
        position: fixed;
        bottom: 50px;
        left: 1800px;
        width: 50px;
        height: 50px;
        background: #fff;
        border-radius: 50%;
        cursor: pointer;
        box-shadow: 0 5px 5px rgba(0,0,0,0.1);
        */
    }

    .action span {
        position: relative;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #a13dea;
        font-size: 2em;
        transition: 0.3s ease-in-out;
    }

    .action.active span {
        transform: rotate(135deg);
    }

    .action ul {
        position: fixed;
        bottom: 55px;
        right: 20px;
        background: #fff;
        min-width: 250px;
        padding: 20px;
        border-radius: 20px;
        opacity: 0;
        visibility: hidden;
        transition: 0.3s;
    }

    .action.active ul {
        bottom: 65px;
        opacity: 1;
        visibility: visible;
        transition: 0.3s;
    }

    .action ul li {
        list-style: none;
        display: flex;
        justify-content: flex-start;
        align-items: center;
        padding: 10px 0;
        transition: 0.3s;
    }

    .action ul li:hover {
        font-weight: 600;
    }

    .action ul li:not(:last-child) {
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }

</style>

@section('body')
@section('navbar')
@endsection

@section('sidebar')
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Finance</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/emp/home">Home</a></li>
                        <li class="breadcrumb-item active">Finance Reports</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    {{-- End Content Header --}}
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title pt-1">Laporan Pemasukan</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool pt-3" data-card-widget="collapse"
                                    title="Collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-responsive-sm table-bordered" id="myTable" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width: 2%">No</th>
                                        {{-- <th style="width: 8%">Code</th> --}}
                                        <th style="width: 15%">Income Name</th>
                                        <th style="width: 12%">Category</th>
                                        <th style="width: 15%">Project</th>
                                        <th style="width: 13%">Income Nominal</th>
                                        <th style="width: 10%">Date</th>
                                        <th style="width: 12%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($finance->where('inout_finance', 'Pemasukan') as $tbl_finansial)
                                        <tr>
                                            <td style="text-align: center">{{ $loop->iteration }}</td>
                                            <td>{{ $tbl_finansial->name_finance }}</td>
                                            <td>{{ $tbl_finansial->category_finance }}</td>
                                            <td>{{ $tbl_finansial->type_finance }}</td>
                                            <td>{{ $tbl_finansial->nominal_finance }}</td>
                                            <td>{{ $tbl_finansial->date_finance }}</td>
                                            <td style="text-align: center">
                                                <a class="btn btn-primary mr-1" href="#"><i
                                                        class="fa fa-eye"></i></a>
                                                <a class="btn btn-success mr-1" data-toggle="modal"
                                                    href="#edit{{ $tbl_finansial->id }}"><i class="fa fa-edit"></i></a>
                                                <a>
                                                    <form autocomplete="off" action="/admin/manage/finance/{{ $tbl_finansial->id }}" method="POST" class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="btn btn-danger mr-1" onclick="return confirm('Yakin untuk menghapus data {{ $tbl_finansial->name_finance }}?')">
                                                            <span class="fas fa-trash"></span>
                                                        </button>
                                                    </form>
                                                </a>
                                            </td>
                                        </tr>
                                        <!-- /.modal -->
                                        <div class="modal fade" id="edit{{ $tbl_finansial->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="card-header bg-orange">
                                                        <h3 class="card-title">Edit Data Pemasukan {{ $tbl_finansial->name_finance }}</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <form autocomplete="off" action="/admin/manage/finance/{{ $tbl_finansial->id }}" method="POST" class="d-inline">
                                                            @method('put')
                                                            @csrf
                                                            <div class="content">
                                    
                                                                <br>
                                    
                                                                <div class="form-group">
                                                                    <button class="btn btn-success float-right">Save
                                                                        Data</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title pt-1">Laporan Pengeluaran</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool pt-3" data-card-widget="collapse"
                                    title="Collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-responsive-sm table-bordered" id="myTable1" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width: 2%">No</th>
                                        {{-- <th style="width: 8%">Code</th> --}}
                                        <th style="width: 15%">Outcome Name</th>
                                        <th style="width: 12%">Category</th>
                                        <th style="width: 15%">Project</th>
                                        <th style="width: 13%">Outcome Nominal</th>
                                        <th style="width: 10%">Date</th>
                                        <th style="width: 12%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($finance->where('inout_finance', 'Pengeluaran') as $tbl_finansial)
                                        <tr>
                                            <td style="text-align: center">{{ $loop->iteration }}</td>
                                            <td>{{ $tbl_finansial->name_finance }}</td>
                                            <td>{{ $tbl_finansial->category_finance }}</td>
                                            <td>{{ $tbl_finansial->type_finance }}</td>
                                            <td>{{ $tbl_finansial->nominal_finance }}</td>
                                            <td>{{ $tbl_finansial->date_finance }}</td>
                                            <td style="text-align: center">
                                                <a class="btn btn-primary mr-1" href="#"><i
                                                        class="fa fa-eye"></i></a>
                                                <a class="btn btn-success mr-1" data-toggle="modal"
                                                    href="#edit{{ $tbl_finansial->id }}"><i class="fa fa-edit"></i></a>
                                                <a>
                                                    <form autocomplete="off" action="/admin/manage/finance/{{ $tbl_finansial->id }}" method="POST" class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <a class="btn btn-danger" onclick="return confirm('Yakin untuk menghapus data {{ $tbl_finansial->name_finance }}?')">
                                                            <span class="fa fa-trash"></span>
                                                        </a>
                                                    </form>
                                                </a>
                                            </td>
                                        </tr>
                                        <!-- /.modal -->
                                        <div class="modal fade" id="edit{{ $tbl_finansial->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="card-header bg-orange">
                                                        <h3 class="card-title">Edit Data Pengeluaran {{ $tbl_finansial->name_finance }}</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <form autocomplete="off" action="/admin/manage/finance/{{ $tbl_finansial->id }}" method="POST" class="d-inline">
                                                            @method('put')
                                                            @csrf
                                                            <div class="content">

                                                                <div class="form-group" hidden>
                                                                    <input required name="inout_finance" class="form-control" value="Pemasukan">
                                                                </div>
                                    
                                                                <div class="form-group">
                                                                    <label>Nama Pemasukan</label>
                                                                    <input name="name_finance" class="form-control" required>
                                                                </div>
                                    
                                                                <div class="form-group">
                                                                    <label>Tanggal Pemasukan</label>
                                                                    <input type="Date" name="date_finance" class="form-control" required>
                                                                </div>
                                    
                                                                <div class="form-group row">
                                                                    <label>Kategori Pemasukan</label>
                                                                    <div class="select2-primary col-12">
                                                                        <select name="category_finance" class="select2 select2-success"
                                                                            data-dropdown-css-class="select2-success" style="width: 100%;"
                                                                            data-placeholder="Pilih Jenis Kategori">
                                                                            <option></option>
                                                                            @foreach ($category->where('jenis_kategori', 'Pemasukan') as $i)
                                                                                <option value="{{ $i->nama_kategori }}">{{ $i->nama_kategori }} </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                    
                                                                <div class="form-group">
                                                                    <label>Proyek</label>
                                                                    <select name="type_finance" class="select2 select2-success"
                                                                        data-dropdown-css-class="select2-success" style="width: 100%;"
                                                                        data-placeholder="Pilih Proyek" required>
                                                                        <option></option>
                                                                        <option value="Non-Proyek">Non-Proyek</option>
                                                                        @foreach ($project as $i)
                                                                            <option value="{{ $i->project_name }}">{{ $i->project_name }} </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                    
                                                                <div class="form-group">
                                                                    <label>Tujuan Saldo</label>
                                                                    <select name="balance_finance" class="select2 select2-success"
                                                                        data-dropdown-css-class="select2-success" style="width: 100%;"
                                                                        data-placeholder="Pilih Tujuan Saldo" required>
                                                                        <option></option>
                                                                        <option value="KAS-UTAMA">KAS-UTAMA (Kas Besar)</option>
                                                                        <option value="KAS-ADMIN">KAS-ADMIN (Kas Kecil)</option>
                                                                        <option value="KAS-PEMASARAN">KAS-PEMASARAN</option>
                                                                    </select>
                                                                </div>
                                    
                                                                <div>
                                                                    <label>Nominal Pemasukan</label>
                                                                    <input class="input-currency form-control" type="text" type-currency="IDR" placeholder="Rp"
                                                                        name="nominal_finance" required>
                                                                </div>
                                    
                                                                <div class="form-group">
                                                                    <label>Detail Pemasukan</label>
                                                                    <textarea name="detail_finance" class="form-control"></textarea>
                                                                </div>
                                    
                                                                <div class="form-group my-2">
                                                                    <label for="nota_finance">Bukti Nota</label>
                                                                    <br>
                                                                    <input type="file" class="form-control" name="nota_finance" id="nota_finance"
                                                                        onchange="Image_preview(event)">
                                                                </div>
                                    
                                                                <br>
                                    
                                                                <div class="form-group">
                                                                    <button class="btn btn-success float-right">Save Data</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
            <div class="action" onclick="actionToggle();">
                <span>+</span>
                <ul>
                    <li data-toggle="modal" data-target="#add-income">Tambah Laporan Pemasukan</li>
                    <li data-toggle="modal" data-target="#add-outcome">Tambah Laporan Pengeluaran</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- /.content -->

    <div class="modal fade" id="add-income" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card-header bg-green">
                    <h3 class="card-title">Tambah Laporan Pemasukan</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="card-body">
                    <form autocomplete="off" action="/admin/manage/finance" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="content">

                            <div class="form-group" hidden>
                                <input required name="inout_finance" class="form-control" value="Pemasukan">
                            </div>

                            <div class="form-group">
                                <label>Nama Pemasukan</label>
                                <input name="name_finance" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Tanggal Pemasukan</label>
                                <input type="Date" name="date_finance" class="form-control" required>
                            </div>

                            <div class="form-group row">
                                <label>Kategori Pemasukan</label>
                                <div class="select2-primary col-10">
                                    <select name="category_finance" class="select2 select2-success"
                                        data-dropdown-css-class="select2-success" style="width: 100%;"
                                        data-placeholder="Pilih Jenis Kategori">
                                        <option></option>
                                        @foreach ($category->where('jenis_kategori', 'Pemasukan') as $i)
                                            <option value="{{ $i->nama_kategori }}">{{ $i->nama_kategori }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-2">
                                    <button class="btn btn-success float-right" data-toggle="modal"
                                        data-target="#categoryIncome">Tambah</button>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Proyek</label>
                                <select name="type_finance" class="select2 select2-success"
                                    data-dropdown-css-class="select2-success" style="width: 100%;"
                                    data-placeholder="Pilih Proyek" required>
                                    <option></option>
                                    <option value="Non-Proyek">Non-Proyek</option>
                                    @foreach ($project as $i)
                                        <option value="{{ $i->project_name }}">{{ $i->project_name }} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Tujuan Saldo</label>
                                <select name="balance_finance" class="select2 select2-success"
                                    data-dropdown-css-class="select2-success" style="width: 100%;"
                                    data-placeholder="Pilih Tujuan Saldo" required>
                                    <option></option>
                                    <option value="KAS-UTAMA">KAS-UTAMA (Kas Besar)</option>
                                    <option value="KAS-ADMIN">KAS-ADMIN (Kas Kecil)</option>
                                    <option value="KAS-PEMASARAN">KAS-PEMASARAN</option>
                                </select>
                            </div>

                            <div>
                                <label>Nominal Pemasukan</label>
                                <input class="input-currency form-control" type="text" type-currency="IDR" placeholder="Rp"
                                    name="nominal_finance" required>
                            </div>

                            <div class="form-group">
                                <label>Detail Pemasukan</label>
                                <textarea name="detail_finance" class="form-control"></textarea>
                            </div>

                            <div class="form-group my-2">
                                <label for="nota_finance">Bukti Nota</label>
                                <br>
                                <input type="file" class="form-control" name="nota_finance" id="nota_finance"
                                    onchange="Image_preview(event)">
                            </div>

                            <br>

                            <div class="form-group">
                                <button class="btn btn-success float-right">Save Data</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add-outcome" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true" cd>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card-header bg-danger">
                    <h3 class="card-title">Tambah Laporan Pengeluaran</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="card-body">
                    <form autocomplete="off" action="/admin/manage/finance/" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="content">

                            <div class="form-group" hidden>
                                <input name="inout_finance" class="form-control" value="Pengeluaran">
                            </div>

                            <div class="form-group">
                                <label>Nama Pengeluaran</label>
                                <input name="name_finance" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Tanggal Pengeluaran</label>
                                <input type="Date" name="date_finance" class="form-control" required>
                            </div>

                            <div class="form-group row">
                                <label>Kategori Pengeluaran</label>
                                <div class="col-10">
                                    <select name="category_finance" class="select2 select2-danger"
                                        data-dropdown-css-class="select2-danger" style="width: 100%;"
                                        data-placeholder="Pilih Jenis Kategori">
                                        <option></option>
                                        @foreach ($category->where('jenis_kategori', 'Pengeluaran') as $i)
                                            <option value="{{ $i->nama_kategori }}">{{ $i->nama_kategori }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-2">
                                    <button class="btn btn-success float-right" data-toggle="modal"
                                        data-target="#categoryOutcome">Tambah</button>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Proyek</label>
                                <select name="type_finance" class="select2 select2-danger"
                                    data-dropdown-css-class="select2-danger" style="width: 100%;"
                                    data-placeholder="Pilih Proyek" required>
                                    <option></option>
                                    <option value="Non-Proyek">Non-Proyek</option>
                                    @foreach ($project as $i)
                                        <option value="{{ $i->project_name }}">{{ $i->project_name }} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Asal Saldo</label>
                                <select name="balance_finance" class="select2 select2-danger"
                                    data-dropdown-css-class="select2-danger" style="width: 100%;"
                                    data-placeholder="Pilih Asal Saldo" required>
                                    <option></option>
                                    <option value="KAS-UTAMA">KAS-UTAMA (Kas Besar)</option>
                                    <option value="KAS-ADMIN">KAS-ADMIN (Kas Kecil)</option>
                                    <option value="KAS-PEMASARAN">KAS-PEMASARAN</option>
                                </select>
                            </div>

                            <div>
                                <label>Nominal Pengeluaran</label>
                                <input class="input-currency form-control" type="text" type-currency="IDR" placeholder="Rp"
                                    name="nominal_finance" required>
                            </div>

                            <div class="form-group">
                                <label>Detail Pengeluaran</label>
                                <textarea name="detail_finance" class="form-control"></textarea>
                            </div>

                            <div class="form-group my-2">
                                <label for="nota_finance">Bukti Nota</label>
                                <br>
                                <input type="file" class="form-control" name="nota_finance" id="nota_finance"
                                    onchange="Image_preview(event)">
                            </div>

                            <br>

                            <div class="form-group">
                                <button class="btn btn-success float-right">Save Data</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="categoryOutcome" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true" cd>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card-header bg-danger">
                    <h3 class="card-title">Tambah Kategori Pengeluaran</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="card-body">
                    <form autocomplete="off" action="/admin/manage/ficategory" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="content">

                            <div class="form-group" hidden>
                                <label>Jenis Kategori</label>
                                <input name="jenis_kategori" class="form-control" value="Pengeluaran">
                            </div>

                            <div class="form-group">
                                <label>Nama Kategori</label>
                                <input name="nama_kategori" class="form-control" required>
                            </div>

                            {{-- <div>
                                <label>Kategori baru yang dibuat merupakan kategori pengeluaran!</label>
                            </div> --}}

                            <br>

                            <div class="form-group">
                                <button class="btn btn-success float-right">Save Data</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="categoryIncome" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true" cd>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card-header bg-success">
                    <h3 class="card-title">Tambah Kategori Pemasukan</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="card-body">
                    <form autocomplete="off" action="/admin/manage/ficategory" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="content">

                            <div class="form-group" hidden>
                                <label>Jenis Kategori</label>
                                <input required name="jenis_kategori" class="form-control" value="Pemasukan">
                            </div>

                            <div class="form-group">
                                <label>Nama Kategori</label>
                                <input name="nama_kategori" class="form-control" required>
                            </div>

                            {{-- <div>
                                <label>Kategori baru yang dibuat merupakan kategori pemasukan!</label>
                            </div> --}}

                            <br>

                            <div class="form-group">
                                <button class="btn btn-success float-right">Save Data</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#myTable1').DataTable();
        });
    </script>
    <script type="text/javascript">
        function actionToggle() {
            var action = document.querySelector('.action')
            action.classList.toggle('active')
        }
    </script>
@endsection
@endsection
