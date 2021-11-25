<?php
use Carbon\Carbon;
?>

@extends('pages.ui_admin.admin')
@section('title')
    Tabel Laporan
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
                    <h1>Reports</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                        <li class="breadcrumb-item active">Reports</li>
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

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title text-light">Employee Report</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <a class="badge bg-primary mb-3" data-toggle="modal" data-target="#add-data"><i
                                class="fa fa-plus-circle mr-1"></i> Add New Report</a>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No</th>
                                        <th class="col-3">Submitter</th>
                                        <th class="col-2">Status</th>
                                        <th class="col-3">Date</th>
                                        <th class="col-2">Job</th>
                                        <th class="col-2">Project Name</th>
                                        <th class="col-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $tbl_report)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td></td>
                                        <td>{{ $tbl_report->report_status}}</td>
                                        <td>{{ $tbl_report->report_date}}</td>
                                        <td></td>
                                        <td>{{ $tbl_report->project_name }}</td>
                                        <td>
                                        <a href="#">
                                            <button type="button" class="btn btn-success">
                                                Detail
                                            </button>
                                        </a>
                                        <a>
                                            <button type="button"
                                                class="btn btn-warning toastsDefaultWarning" data-toggle="modal"
                                                data-target="#edit">
                                                Edit
                                            </button>
                                        </a>
                                        <a>
                                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                                data-target="#delete">
                                                Delete
                                            </button>
                                        </a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                                <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.card -->
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="add-data">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="card-header bg-orange">
                    <h3 class="card-title">Submit New Report</h3>
                </div>
                <div class="card-body">
                    <form action="/admin/projects/" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="content">

                            <div class="form-group">
                                <label>Project Name</label>
                                <input class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label>Joblist Name</label>
                                <input class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Project Status</label>
                                <select class="form-control" name="report_status" required="required">
                                    <option value="" hidden> Pilih Status : </option>
                                    <option value="Selesai"> Finish </option>
                                    <option value="Bermasalah"> Problematic </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Report Date</label>
                                <input name="report_date" class="form-control" value="{{ \Carbon\Carbon::now() }}" disabled>
                            </div>

                            {{-- <div class="form-group">
                                <label>Project Picture/Logo</label>
                                <div>
                                    <input type="file" name="foto_karyawan">
                                    <div class="text-danger">
                                        @error('foto_karyawan')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div> --}}

                            <div class="form-group">
                                <button class="btn btn-success float-right">Save Data</button>
                            </div>
                        </div>
                </div>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.content -->
@section('footer')
@endsection
@endsection
