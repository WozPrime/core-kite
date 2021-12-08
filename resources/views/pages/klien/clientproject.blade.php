@extends('pages.ui_client.main')
@section('title')
Dashboard
@endsection
@section('body')
@section('navbar')
@endsection
@section('sidebar')
@endsection
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">My Projects</h1>
            </div><!-- /.col -->
            
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-lg-12 col sm-12 mx-auto">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="mb-2">
                            <b> My Projects </b>
                        </div>
                        <table class="table table-bordered table-hover">
                            <thead class="bg-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Proyek</th>
                                    <th>Jenis Proyek</th>
                                    <th>Nilai Proyek</th>
                                    <th>Status Proyek</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Aplikasi Judi Online Berbasis Website</td>
                                    <td>Aplikasi Website</td>
                                    <td>Rp 69.420.000</td>
                                    <td>In Progress</td>
                                    <td>
                                        <a href="#" class="badge bg-info mr-1"><i class="fa fa-eye"></i></a>
                                        <a href="#" class="badge bg-warning mr-1"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="#" class="badge bg-green mr-1" data-toggle="modal" data-target="#add-data"><i class="fa fa-clock"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
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