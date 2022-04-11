@php
use Carbon\Carbon;
@endphp
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

<div class="container pt-3">
    <div class="main-body">
        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card" style="height: 375px">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            @if ($data->project_logo)
                                <img src="/projectLogo/{{ $data->project_logo }}" alt="logo {{ $data->project_name }}"
                                    class="rounded-circle" width="150" height="150">
                            @else
                                <img src="https://images.tokopedia.net/img/cache/215-square/shops-1/2021/7/27/11968180/11968180_a9344c7d-9e89-4310-8ce8-f7053152571c.jpg"
                                    alt="Logo Instansi" class="rounded-circle" width="150">
                            @endif
                            <div class="mt-3">
                                <b class="text-secondary-bold"> {{ $data->project_name }} </b>
                                <p class="text-muted font-size-sm"> [{{ $data->project_code }}] </p>
                                <b class="text-secondary-bold"> Nilai Proyek </b>
                                <p class="text-muted font-size-sm"> {{ $data->project_value }} </p>
                                <b class="text-secondary-bold"> Jenis Proyek </b>
                                <p class="text-muted font-size-sm"> {{ $data->project_category }} </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-3" style="height: 375px">
                    <div class="card-body">
                        <b class="text-secondary-bold"> Detail Proyek </b>
                        <p class="text-muted font-size-sm"> {{ $data->project_detail }} </p>
                        <b class="text-secondary-bold"> Perkiraan Waktu Pengerjaan Proyek</b>
                        <p class="text-muted font-size-sm">
                            {{ date('D, d M Y', strtotime($data->project_start_date)) }}
                            <b>s/d</b> {{ date('D, d M Y', strtotime($data->project_deadline)) }}
                        </p>
                        <b class="text-secondary-bold"> Rentang Pengerjaan Waktu </b>
                        <p class="text-muted font-size-sm">
                            {{ Carbon::parse($data->project_deadline)->diffInDays($data->project_start_date) }} Hari
                        </p>
                        <b class="text-secondary-bold"> Klien </b>
                        <p class="text-muted font-size-sm"> {{ $data->client->name }} </p>
                        <b class="text-secondary-bold"> Instansi </b>
                        <p class="text-muted font-size-sm"> {{ $data->instance->nama_instansi }} </p>
                    </div>
                </div>
            </div>
        </div>
    
    
    
        <div class="row gutters-sm">
            <div class="col-12">
                <div class="card">
                    <div class="card-orange">
                        {{-- RIWAYAT PEMBAYARAN --}}
                        <div class="card-header">
                            <h2 class="card-title text-light pt-2">Riwayat Pembayaran</h2>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-responsive-sm table-bordered" id="myTable1">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th class="text-center">Tanggal Pembayaran</th>
                                        <th class="text-center">Jenis Pembayaran</th>
                                        <th class="text-center">Deskripsi Pembayaran</th>
                                        <th class="text-center">Nilai Pembayaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pembayaran as $p)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $p->tanggal_pembayaran }}</td>
                                            <td>{{ $p->jenis_pembayaran }}</td>
                                            <td>{{ $p->deskripsi_pembayaran }}</td>
                                            <td>{{ $p->nilai_pembayaran }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- /.modal-dialog -->
    
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    
    
    
    
        <div class="modal fade" id="edit-data-instansi">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="card-header bg-orange">
                        <h3 class="card-title">Ubah Data Instansi</h3>
                    </div>
                    <div class="card-body">
                        <form action="#" method="POST" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="content">
                                <div class="form-group">
                                    <label>Nama Instansi</label>
                                    <input name="namainstansi" class="form-control" value="#" required>
                                    <div class="text-danger">
                                        @error('namainstansi')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
    
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Alamat Instansi</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                    name="alamatinstansi"> # </textarea>
                            </div>
    
                            <div class="form-group">
                                <label>Kota Instansi</label>
                                <input name="kotainstansi" class="form-control" value="#" required>
                                <div class="text-danger">
                                    @error('namainstansi')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group">
                                <label>Jenis Instansi</label>
                                <select name="jenisinstansi" class="form-control" value="#">
    
                                </select>
                            </div>
    
                            <div class="form-group">
                                <button class="btn btn-success float-right">Simpan Data</button>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        
    
        <div class="modal fade" id="addpembayaran">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="card-header bg-orange">
                        <h3 class="card-title">Tambah Data Pembayaran</h3>
                    </div>
                    <div class="card-body">
                        <form action="/admin/payment" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="content">
                                <div class="form-group">
                                    <label>Tanggal Pembayaran</label>
                                    <input type="date" name="tanggalpembayaran" class="form-control" value="" required>
                                </div>
                            </div>
    
                            <div class="form-group">
                                <input type="text" name="userpembayaran" value="{{ $data->client->id }}" hidden>
                            </div>
    
                            <div class="form-group">
                                <input type="text" name="proyekpembayaran" value="{{ $data->id }}" hidden>
                            </div>
    
                            <div class="form-group">
                                <label>Jenis Pembayaran</label>
                                <select name="jenispembayaran" id="jenispembayaran" class="form-select">
                                    <option value="" selected hidden>Pilih Jenis Pembayaran</option>
                                    <option value="Tunai">Tunai</option>
                                    <option value="Transfer">Transfer</option>
                                    <option value="Cek">Cek</option>
                                </select>
                            </div>
    
                            <div class="form-group">
                                <label>Deskripsi Pembayaran</label>
                                <textarea name="deskripsipembayaran" class="form-control" value="#" required></textarea>
                            </div>
    
                            <div class="form-group">
                                <label>Nilai Pembayaran</label>
                                <input class="input-currency form-control" type="text" type-currency="IDR" placeholder="Rp"
                                    name="nilaipembayaran" required>
                            </div>
    
                            <div class="form-group">
                                <button class="btn btn-success float-right">Simpan Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
@section('footer')
@endsection
@endsection