@extends('pages.ui_teacher.teacher')
@section('title')
    Teacher  |  Dashboard
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
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <form>

                    <div class="col-7">
                        <div class="form-group shadow-textarea"><br>
                        <label for="exampleFormControlTextarea6">Timeline kelas</label>
                        <textarea class="form-control z-depth-1" id="exampleFormControlTextarea6" rows="3" placeholder="Posting sesuatu untuk kelas anda...">
                        </textarea>
                        <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
                        <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
                      </div>
                    </div>
                    <div class="col-2">
                        <p for="myfile">Select files:    <input type="file" id="myfile" name="myfile" multiple><br><br></p>
                        <button type="submit" class="btn btn-info">Submit</button>
                    </div>
                  </form>
                <div class="card-body">
                    <div class="main-container col-10">
                        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<ol class="timeline">
	<li> membuat tugas aoufishnconc wscnsdcnscssdcsd
        ini adalah codingan tentangakfnjlsn ckjc s sdcds ssedfwesssssssssssssssssssswet vvvvvvv4ert4eercreceergergrgr
        <br>
        <button><i class='far fa-edit'></i></button>
        <button><i class='far fa-trash-alt'></i></button>
    </li>
	<li> membuat tugas aoufishnconc wscnsdcnscssdcsd
        ini adalah codingan tentangakfnjlsn ckjc s sdcds ssedfwesssssssssssssssssssswet vvvvvvv4ert4eercreceergergrgr
        <br>
        <button><i class='far fa-edit'></i></button>
        <button><i class='far fa-trash-alt'></i></button>
    </li>
	<li> membuat tugas aoufishnconc wscnsdcnscssdcsd
        ini adalah codingan tentangakfnjlsn ckjc s sdcds ssedfwesssssssssssssssssssswet vvvvvvv4ert4eercreceergergrgr
        <br>
        <button><i class='far fa-edit'></i></button>
        <button><i class='far fa-trash-alt'></i></button>
    </li>
	<li> membuat tugas aoufishnconc wscnsdcnscssdcsd
        ini adalah codingan tentangakfnjlsn ckjc s sdcds ssedfwesssssssssssssssssssswet vvvvvvv4ert4eercreceergergrgr
        <br>
        <button><i class='far fa-edit'></i></button>
        <button><i class='far fa-trash-alt'></i></button>
     </li>
</ol>

                </div>
            </div>
            <style>
                .timeline{
	position: relative;
}

/*Line*/
.timeline>li::before{
	content:'';
	position: absolute;
	width: 1px;
	background-color: #E7E7E7;
	top: 0;
	bottom: 0;
	left:-19px;
}

/*Circle*/
.timeline>li::after{
    text-align: center;
    padding-top:10px;
	z-index: 10;
	content:counter(item);
	position: absolute;
	width: 50px;
	height: 50px;
	border:3px solid white;
	background-color: #E7E7E7;
	border-radius: 50%;
	top:0;
	left:-43px;
}

/*Content*/
.timeline>li{
	counter-increment: item;
	padding: 10px 25px;
	margin-left: 100px;
	min-height: 200px;
	position: relative;
	background-color: white;
	list-style: none;
}
.timeline>li:nth-last-child(1)::before{
	width: 0px;
}
            </style>
        </div>
    </section>
@endsection
    <!-- /.content -->
@section('footer')
@endsection

@endsection
