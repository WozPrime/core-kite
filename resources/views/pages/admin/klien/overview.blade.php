@extends('pages.ui_admin.admin')
@section('title')
    Overview Klien
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
                <h1 class="m-0">Overview Klien</h1>
            </div><!-- /.col -->
            
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title text-orange">Tabel Instansi</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Instansi</th>
                                        <th>Nama Instansi</th>
                                        <th>Total Proyek</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($instance as $i)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td> {{$i->instances_model->jenis_instansi}} </td>
                                            <td> {{$i->nama_instansi}} </td>
                                            <td> masih kosong </td>
                                            <td><a href="/admin/klien/{{$i->id}}" class="badge bg-info mr-1"><i class="fa fa-eye"></i></a>
                                                <a href="/admin/klien/{{$i->id}}/edit" class="badge bg-warning mr-1"><i class="fas fa-pencil-alt"></i></a>
                                                <a href="#" class="badge bg-danger mr-1"><i class="fa fa-eraser"></i></a></td>
                                        </tr>
                                    @endforeach
                                    {{-- <tr>
                                        <td>1</td>
                                        <td>Pemerintah</td>
                                        <td>Dinas Teknologi dan Informasi Pontianak</td>
                                        <td>2</td>
                                        <td>
                                            <a href="/admin/klien/detail" class="badge bg-info mr-1"><i class="fa fa-eye"></i></a>
                                            <a href="#" class="badge bg-warning mr-1"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="#" class="badge bg-danger mr-1"><i class="fa fa-eraser"></i></a>
                                        </td>
                                    </tr> --}}
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Total</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
    
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
@endsection
@section('footer')
@endsection

@endsection
