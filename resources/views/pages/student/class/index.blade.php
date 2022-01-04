@extends('pages.ui_student.student')
@section('title')
    Student  |  Kelas
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
                    <h1 class="m-0">Kelas</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
            </div>

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>Judul Course<sup style="font-size: 20px"></sup></h3>
                        <p>keterangan course</p></p>
                    </div>
                    <div class="icon">
                        <i class="ion-ios-book"></i>
                    </div>
                    <a href="/student/class/courses" class="small-box-footer">Menuju course <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

        </div>
    </section>
@endsection

<script>
    error=false
    function validate()
    {
        if(document.custForm.name.value !='' && document.custForm.email.value !=''
        && document.custForm.address.value !=''
        document.custForm.btnsave.disabled=false
        else
        document.custForm.btnsave.disabled=true)
    }
</script>

@section('footer')
@endsection

@endsection
<!-- Modal -->
