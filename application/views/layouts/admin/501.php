    <!-- auth-page wrapper -->
    <div style="padding-top:0px!important;" class="auth-page-wrapper py-5 d-flex justify-content-center align-items-center min-vh-100">

        <!-- auth-page content -->
        <div class="auth-page-content overflow-hidden p-0">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xl-4 text-center">
                        <div class="error-500 position-relative">
                            <img src="<?php base_url(); ?>velzon/images/error500.png" alt="" class="img-fluid error-500-img error-img" />
                            <h1 class="title text-muted">501</h1>
                        </div>
                        <div>
                            <h4>Access Denied!</h4>
                            <p class="text-muted w-75 mx-auto">Halaman ini tidak diizinkan untuk <b>{{ $data['session']['level_name']}}</b>.</p>
                            <a href="#" class="btn btn-success"><i class="mdi mdi-home me-1"></i>Kembali</a>
                        </div>
                    </div><!-- end col-->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth-page content -->
    </div>
    <!-- end auth-page-wrapper -->