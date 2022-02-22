@php
use Illuminate\Support\Carbon;
@endphp
@extends('pages.ui_admin.admin')
@section('title')
    To Do List
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
                    <h1>To Do List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">TO DO List</li>
                    </ol>
                </div>
            </div>
            @error('upload_details')
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Peringatan!</strong> Data Masih Kosong.
                </div>
            @enderror
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header ui-sortable-handle">
                            <h3 class="card-title">
                                <i class="ion ion-clipboard mr-1"></i>
                                To Do List
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <ul class="todo-list ui-sortable" data-widget="todo-list">
                                <input type="hidden" id="idJobs"
                                    value="{{ json_encode($project_task->pluck('id')->toArray()) }}">
                                @php
                                    $nearestDeadline = new stdClass();
                                    $nearestDeadline->time = null;
                                    $diffMinutes = null;
                                @endphp
                                @foreach ($project_task as $job)
                                    @php
                                        $subsDate = floor((strtotime($job->expired_at) - strtotime(Carbon::now())) / 86400);
                                        if ($subsDate > 0) {
                                            $diffMinutes = Carbon::parse($job->expired_at)->diffInRealMinutes();
                                            $deadlineMinutes = Carbon::parse($nearestDeadline->time)->diffInRealMinutes();
                                            if (!$job->post_date){
                                            if ($nearestDeadline->time == null || $deadlineMinutes > $diffMinutes) {
                                                $nearestDeadline->time = date('F d, Y H:i:s', strtotime($job->expired_at));
                                                $nearestDeadline->task = $tasks
                                                    ->where('id', $job->task_id)
                                                    ->pluck('task_name')
                                                    ->implode(' ');
                                            }
                                            }
                                        }
                                        
                                    @endphp
                                    <li>
                                        <span class="handle ui-sortable-handle">
                                            <i class="fas fa-ellipsis-v"></i>
                                            <i class="fas fa-ellipsis-v"></i>
                                        </span>
                                        <div class="icheck-primary d-inline ml-2">
                                            <input type="checkbox" value="" disabled name="todo{{ $job->id }}"
                                                id="todoCheck{{ $job->id }}" 
                                                @if ($job->upload_details && ($file_task->where('pt_id',$job->id)->count() > 0))
                                                    checked
                                                @endif>
                                            <label for="todoCheck{{ $job->id }}"></label>
                                        </div>
                                        <span
                                            class="text">{{ $tasks->where('id', $job->task_id)->pluck('task_name')->implode(' ') }}</span>
                                        <small
                                            class="badge 
                                        @if ($subsDate > 0)
                                            @if ($diffMinutes > 7 * 1440)
                                            badge-success
                                            @elseif ($diffMinutes <= 7 * 1440 && $diffMinutes > 4 * 1440)
                                            badge-primary
                                            @elseif ($diffMinutes <= 4 * 1440 && $diffMinutes > 1 * 1440)
                                            badge-warning
                                            @endif
                                        @else
                                          badge-danger
                                        @endif
                                          "
                                            id='deadline'><i class="far fa-clock"></i>
                                            @if ($subsDate > 0)
                                                @if ($diffMinutes > 1440)
                                                    {{ floor($diffMinutes / 1440) }} Days
                                                @else
                                                    {{ floor($diffMinutes / 60) }} Hours
                                                @endif
                                            @else
                                                EXPIRED
                                            @endif
                                        </small>
                                        <div style="float: right; margin-left: 15px">
                                            <a data-toggle="modal" data-target="#assignment{{ $job->id }}">
                                                <i class="fas fa-paper-plane" style="color: var(--primary)"></i></a>
                                        </div>
                                        <div style="float: right">
                                            <a data-toggle="modal" data-target="#edit_file{{ $job->id }}">
                                                <i class="fas fa-edit" style="color: var(--gray)"></i></a>
                                        </div>

                                    </li>
                                    <meta name="token" content="{{ csrf_token() }}">
                                    <input type="hidden" id="routeSend{{ $job->id }}"
                                        value="{{ route('add_docs', $job->id) }}">
                                    <div class="modal fade" id="assignment{{ $job->id }}">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">{{$tasks->where('id', $job->task_id)->pluck('task_name')->implode(' ')}}</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div id="action{{ $job->id }}" class="row">
                                                            <div class="col-lg-6">
                                                                <div class="btn-group w-100">
                                                                    <span
                                                                        class="btn btn-success col fileinput-button{{ $job->id }}">
                                                                        <i class="fas fa-plus"></i>
                                                                        <span>Add files</span>
                                                                    </span>
                                                                    <button type="submit" class="btn btn-primary col start">
                                                                        <i class="fas fa-upload"></i>
                                                                        <span>Start upload</span>
                                                                    </button>
                                                                    <button type="reset" class="btn btn-warning col cancel">
                                                                        <i class="fas fa-times-circle"></i>
                                                                        <span>Cancel upload</span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 d-flex align-items-center">
                                                                <div class="fileupload-process w-100">
                                                                    <div id="total-progress{{ $job->id }}"
                                                                        class="progress progress-striped active"
                                                                        role="progressbar" aria-valuemin="0"
                                                                        aria-valuemax="100" aria-valuenow="0">
                                                                        <div class="progress-bar progress-bar-success"
                                                                            style="width:0%;" data-dz-uploadprogress></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="table table-striped files"
                                                            id="preview{{ $job->id }}">
                                                            <div id="template{{ $job->id }}" class="row mt-2">
                                                                <div class="col-auto">
                                                                    <span class="preview"><img src="data:," alt=""
                                                                            data-dz-thumbnail /></span>
                                                                </div>
                                                                <div class="col d-flex align-items-center">
                                                                    <p class="mb-0">
                                                                        <span class="lead" data-dz-name></span>
                                                                        (<span data-dz-size></span>)
                                                                    </p>
                                                                    <strong class="error text-danger"
                                                                        data-dz-errormessage></strong>
                                                                </div>
                                                                <div class="col-4 d-flex align-items-center">
                                                                    <div class="progress progress-striped active w-100"
                                                                        role="progressbar" aria-valuemin="0"
                                                                        aria-valuemax="100" aria-valuenow="0">
                                                                        <div class="progress-bar progress-bar-success"
                                                                            style="width:0%;" data-dz-uploadprogress></div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-auto d-flex align-items-center">
                                                                    <div class="btn-group">
                                                                        <button class="btn btn-primary start">
                                                                            <i class="fas fa-upload"></i>
                                                                            <span>Start</span>
                                                                        </button>
                                                                        <button data-dz-remove
                                                                            class="btn btn-warning cancel">
                                                                            <i class="fas fa-times-circle"></i>
                                                                            <span>Cancel</span>
                                                                        </button>
                                                                        <button data-dz-remove
                                                                            class="btn btn-danger delete">
                                                                            <i class="fas fa-trash"></i>
                                                                            <span>Delete</span>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <form action="{{ route('up_details', $job->id) }}" method="POST"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label>Detail Pengumpulan</label>
                                                                <textarea class="form-control" id="upload_details"
                                                                    name="upload_details" rows="3"
                                                                    placeholder="Enter Task Details ..."></textarea>
                                                                <div class="text-danger">
                                                                    @error('upload_details')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-4 float-right">
                                                                <button type="submit"
                                                                    class="btn btn-primary btn-block">Finish</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="edit_file{{ $job->id }}">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Edit "{{$tasks->where('id', $job->task_id)->pluck('task_name')->implode(' ')}}"</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <table class="table table-responsive-sm table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>File Name</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($file_task->where('pt_id',$job->id) as $file)
                                                                <tr>
                                                                    <th>{{$loop->iteration}}</th>
                                                                    <th style="font-weight: 400">{{Illuminate\Support\Str::limit($file->file_name, 80) }}</th>
                                                                    <th style="text-align: center">
                                                                        <a class="btn btn-danger" data-toggle="modal"
                                                                            data-target="#delete{{$loop->index}}"><i
                                                                                class="fa fa-trash"></i></a>
                                                                    </th>
                                                                </tr>
                                                                <div class="modal fade" id="delete{{$loop->index}}">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content bg-danger">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title">Hapus File {{$loop->index + 1}}</h4>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                Apakah anda yakin ingin Menghapus File ini?
                                                                            </div>
                                                                            <div class="modal-footer justify-content-between">
                                                                                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                                                                <a href="/admin/file/delete/{{ $file->file_name }}" type="button" class="btn btn-outline-light">Hapus
                                                                                    File</a>
                                                                            </div>
                                                                        </div>
                                                                        <!-- /.modal-content -->
                                                                    </div>
                                                                    <!-- /.modal-dialog -->
                                                                </div> 
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="row">
                                                        <form action="{{ route('up_details', $job->id) }}" method="POST"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label>Edit Detail Pengumpulan</label>
                                                                <textarea class="form-control" id="upload_details"
                                                                    name="upload_details" rows="3"
                                                                    placeholder="Enter Task Details ...">{{$job->upload_details}}</textarea>
                                                                <div class="text-danger">
                                                                    @error('upload_details')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-4 float-right">
                                                                <button type="submit"
                                                                    class="btn btn-primary btn-block">Finish</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="row">
                                                        
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </ul>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <button type="button" class="btn btn-success float-right"><i class="fas fa-tasks"></i> Save Task</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" style="text-align: center">
                    <div class="info-box bg-warning">
                        <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">@isset($nearestDeadline->task)
                                    {{ $nearestDeadline->task }}
                                @endisset</span>
                            <h4 id="demo" style="text-align: center"></h4>
                            <input type="hidden" id="nearded" name="nearded" value="{{ json_encode($nearestDeadline) }}">
                            <div class="progress">
                                <div class="progress-bar" style="width: 70%"></div>
                            </div>
                            <span class="progress-description">
                                70% Increase in 30 Days
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
            </div>

        </div>
    </section>


@section('footer')
@endsection

@section('script')
    <script>
        // DropzoneJS Demo Code Start
        Dropzone.autoDiscover = false;

        var idJobs = JSON.parse(document.getElementById('idJobs').value)
        // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
        idJobs.forEach(idJob => {
            var previewNode = document.querySelector("#template" + idJob)
            previewNode.id = ""
            var previewTemplate = previewNode.parentNode.innerHTML
            previewNode.parentNode.removeChild(previewNode)

            var routeName = (document.getElementById('routeSend' + idJob).value)
            var parentDropzone = document.getElementById('assignment' + idJob);
            var myDropzone = new Dropzone(parentDropzone, { // Make the whole body a dropzone
                url: routeName, // Set the url
                thumbnailWidth: 80,
                thumbnailHeight: 80,
                parallelUploads: 20,
                previewTemplate: previewTemplate,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
                },
                autoQueue: false, // Make sure the files aren't queued until manually added
                previewsContainer: "#preview" + idJob, // Define the container to display the previews
                clickable: ".fileinput-button" +
                    idJob // Define the element that should be used as click trigger to select files.

            })

            myDropzone.on("addedfile", function(file) {
                // Hookup the start button
                file.previewElement.querySelector(".start").onclick = function() {
                    myDropzone.enqueueFile(file)
                }
            })

            // Update the total progress bar
            myDropzone.on("totaluploadprogress", function(progress) {
                document.querySelector("#total-progress" + idJob + " .progress-bar").style.width =
                    progress + "%"
            })

            myDropzone.on("sending", function(file) {
                // Show the total progress bar when upload starts
                document.querySelector("#total-progress" + idJob).style.opacity = "1"
                // And disable the start button
                file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
            })

            // Hide the total progress bar when nothing's uploading anymore
            myDropzone.on("queuecomplete", function(progress) {
                document.querySelector("#total-progress" + idJob).style.opacity = "0"
                Swal.fire(
                    'Berhasil!',
                    'Data berhasil diupload!',
                    'success'
                ).then((result) => {
                    // location.reload();
                })
            })

            // Setup the buttons for all transfers
            // The "add files" button doesn't need to be setup because the config
            // `clickable` has already been specified.
            document.querySelector("#action" + idJob + " .start").onclick = function() {
                myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
            }
            document.querySelector("#action" + idJob + " .cancel").onclick = function() {
                myDropzone.removeAllFiles(true)
            }
            // DropzoneJS Demo Code End
        });

        // Set the date we're counting down to
        var nearded = JSON.parse(document.getElementById("nearded").value);
        var countDownDate = new Date(nearded.time).getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            document.getElementById("demo").innerHTML = days + "d " + hours + "h " +
                minutes + "m " + seconds + "s ";

            // If the count down is over, write some text 
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "EXPIRED";
            }
        }, 1000);
    </script>
@endsection
@endsection
