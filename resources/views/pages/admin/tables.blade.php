@extends('pages.ui_admin.admin')
@section('title')
    Tabel Admin
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
                    <h1>DataTables</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">DataTables</li>
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
                    <div class="card">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title text-light">Bordered Table</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered table-responsive-lg">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">Id</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th style="width: 40px">Level</th>
                                            <th>Join</th>
                                            <th>Option</th>
                                            {{-- <th>Photo</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                        <tr>
                                            <td>UA2021-{{$user->id}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->role}}</td>
                                            <td>{{$user->email_verified_at}}</td>
                                            <td>
                                                {{-- < action="{{ route('admin_destroy', $user->id) }}" method="POST"> --}}

                                                    {{-- <a href="{{ route('admin.show', $user->id) }}" title="show">
                                                        <i class="fas fa-eye text-success  fa-lg"></i>
                                                    </a> --}}

                                                    <a href="{{ route('admin.edit', $user->id) }}">
                                                        <i class="fas fa-edit  fa-lg"></i>

                                                    </a>

                                                    <form action="{{ route('admin.destroy', $user->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" title="delete" style="border: none; background-color:transparent;">
                                                            <i class="fas fa-trash fa-lg text-danger"></i>

                                                        </button>
                                                    </form>
                                            </td>
                                            {{-- <td>{{$user->avatar}}</td> --}}
                                        </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            {{-- <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-right">
                                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                                </ul>
                            </div> --}}
                        </div>
                        <!-- /.card -->
                        <!-- /.card-body -->
                    </div>
    </section>



@section('footer')
@endsection
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
@endsection

