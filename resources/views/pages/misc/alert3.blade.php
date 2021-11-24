@if (session('pesan'))
    <div class="container-fluid">
        <section class="content">
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h3><i class="icon fas fa-check"></i> Success!</h3>
                    {{ session('pesan') }}
                </div>
            </div>
        </section>
    </div>
@endif
@if (session('sama'))
    <div class="container-fluid">
        <section class="content">
            <div class="col-md-12">
                <div class="alert alert-secondary alert-dismissible ">
                    <button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true">&times;</button>
                    <div class="row">
                        <div class="col-md-1">
                            <i class="icon fas fa-exclamation-triangle fa-3x ml-2 mt-2"></i>
                        </div>
                        <div class="col-md-11">
                            <h3> {{ session('sama') }}</h3>
                            <span>Periksa Kembali data!</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endif
