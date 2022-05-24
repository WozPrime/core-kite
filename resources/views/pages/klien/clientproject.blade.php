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
                        <b class="text-secondary-bold"> Instansi </b>
                        <p class="text-muted font-size-sm"> {{ $data->instance->nama_instansi }} </p>
                        <b class="text-secondary-bold">Persentase Proyek</b>
                        <div>
                            {{-- <div class="row"> --}}
                                <div 
                                @php
                                $pcount = $ptask->where('project_id', $data->id)->count('id');
                                $pstatus = $ptask->where('project_id', $data->id)->where('status', '==', 2)->count('id');
                                if($pcount == 0) {$progress = 0;}
                                elseif($pcount > 0) {$progress = floor(($pstatus / $pcount) * 100);}
                                @endphp 
                                @if($pcount == 0) class="badge bg-danger" 
                                @elseif ($pcount > 0 && $progress < 100)  class="progress progress-xs pb-3" 
                                @elseif($pcount > 0 && $progress == 100) class="badge bg-success" 
                                @endif>
                                <div @if($pcount > 0 && $progress >= 0 && $progress < 25) class="progress-bar bg-danger pb-3"
                                    @elseif($pcount > 0 && $progress >= 25 && $progress < 50) class="progress-bar bg-warning pb-3"
                                    @elseif($pcount > 0 && $progress >= 50 && $progress < 75) class="progress-bar bg-primary pb-3"
                                    @elseif($pcount > 0 && $progress >= 75 && $progress < 100) class="progress-bar bg-bar-success pb-3"
                                    @endif
                                    @if($pcount > 0 && $progress <= 25) style="background-color:red !important;width:{{ $progress }}%;"
                                    @elseif($pcount > 0 && $progress >= 25 && $progress < 100) style="width:{{ $progress }}%"
                                    @endif>
                                    @if($pcount == 0) Belum ada tugas yang disiapkan
                                    @elseif($pcount > 0 && $progress == 100) Seluruh tugas proyek sudah terselesaikan
                                    @endif
                                </div>
                            </div>

                            @if($pcount > 0 && $progress >= 0 && $progress < 100) <span class="badge 
                                @if($pcount > 0 && $progress >= 0 && $progress < 25) bg-danger float-left
                                @elseif($pcount > 0 && $progress >= 25 && $progress < 50) bg-warning 
                                @elseif($pcount > 0 && $progress >= 50 && $progress < 75) bg-primary 
                                @elseif($pcount > 0 && $progress >= 75 && $progress < 100) bg-success float-right
                                @endif col-2" 
                                @if($pcount > 0 && $progress >= 25 && $progress < 50) style="margin-right:130px"
                                @elseif($pcount > 0 && $progress > 50 && $progress <= 75) style="margin-left:130px"
                                @endif>{{ $progress }}%</span>
                            @endif
                            {{-- </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    
    
        <div class="row gutters-sm">
            <div class="col-12">
                <div class="card">
                    <div class="card">
                        {{-- RIWAYAT PEMBAYARAN --}}
                        <div class="card-header bg-primary">
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
<br>
        <div class="row gutters-sm">
            <div class="col-12">
                <div class="card">
                    <div class="card">
                        {{-- RIWAYAT PEMBAYARAN --}}
                        
                        <div class="card-header bg-primary">
                            <h2 class="card-title text-light pt-2">Perkembangan Proyek</h2>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-responsive-sm table-bordered" id="myTable1">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th class="text-center">Tugas</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ptask as $p)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $p->details }}</td>

                                            @if ($p->status == '2')
                                                <td class="badge bg-success m-2">Selesai</td>
                                            @else
                                                <td class="badge bg-warning m-2">Dalam Pengerjaan</td>
                                            @endif
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
    </div>
</div>

@endsection
@section('footer')
@endsection
@endsection