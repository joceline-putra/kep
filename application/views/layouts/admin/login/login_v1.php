
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Welcome to Kepooin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/velzon/images/favicon.png">

    <!-- Layout config Js -->
    <script src="<?php echo base_url();?>assets/velzon/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="<?php echo base_url();?>assets/velzon/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?php echo base_url();?>assets/velzon/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?php echo base_url();?>assets/velzon/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="<?php echo base_url();?>assets/velzon/css/custom.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>core/jconfirm-3.3.4/dist/jquery-confirm.min.css" rel="stylesheet" type="text/css"/>
    <!-- Sweet Alert css-->
    <link href="<?php echo base_url();?>assets/velzon/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

</head>

<body>

    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="index.html" class="d-inline-block auth-logo">
                                    <img src="<?php echo base_url();?>assets/velzon/images/logo-light.png" alt="" height="20">
                                </a>
                            </div>
                            <p class="mt-3 fs-15 fw-medium">Smart platform for Education</p>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Welcome Back !</h5>
                                    <p class="text-muted">Sign in to continue to Edu Smart.</p>
                                </div>
                                <div class="p-2 mt-4">
                                    <form action="">

                                        <div class="mb-3">
                                            <label for="userEmail" class="form-label">Email</label>
                                            <input type="text" class="form-control"  id="userEmail" placeholder="Enter Email">
                                        </div>

                                        <div class="mb-3">
                                            <div class="float-end">
                                                <!-- <a href="auth-pass-reset-basic.html" class="text-muted">Forgot password?</a> -->
                                            </div>
                                            <label class="form-label" for="password-input">Password</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" class="form-control pe-5 password-input" id="userPassword" placeholder="Enter password">
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                        </div>

                                        <!-- <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">
                                            <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                        </div> -->

                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" id="btn_login" type="submit">Sign In</button>
                                        </div>

                                        <!-- <div class="mt-4 text-center">
                                            <div class="signin-other-title">
                                                <h5 class="fs-13 mb-4 title">Sign In with</h5>
                                            </div>
                                            <div>
                                                <button type="button" class="btn btn-primary btn-icon waves-effect waves-light"><i class="ri-facebook-fill fs-16"></i></button>
                                                <button type="button" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-google-fill fs-16"></i></button>
                                                <button type="button" class="btn btn-dark btn-icon waves-effect waves-light"><i class="ri-github-fill fs-16"></i></button>
                                                <button type="button" class="btn btn-info btn-icon waves-effect waves-light"><i class="ri-twitter-fill fs-16"></i></button>
                                            </div>
                                        </div> -->
                                    </form>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <!-- <div class="mt-4 text-center">
                            <p class="mb-0">Dont have an account ? <a href="auth-signup-basic.html" class="fw-semibold text-primary text-decoration-underline"> Signup </a> </p>
                        </div> -->

                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">&copy;
                                Edu Smart. Crafted with <i class="mdi mdi-heart text-danger"></i> by WBN
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="<?php echo base_url();?>assets/velzon/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url();?>assets/velzon/libs/simplebar/simplebar.min.js"></script>
    <script src="<?php echo base_url();?>assets/velzon/libs/node-waves/waves.min.js"></script>
    <script src="<?php echo base_url();?>assets/velzon/libs/feather-icons/feather.min.js"></script>
    <script src="<?php echo base_url();?>assets/velzon/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="<?php echo base_url();?>assets/velzon/js/plugins.js"></script>
    <script src="<?php echo base_url();?>assets/core/jquery/jquery-1.11.3.min.js" type="text/javascript"></script>

    <!-- particles js -->
    <script src="<?php echo base_url();?>assets/velzon/libs/particles.js/particles.js"></script>
    <!-- particles app js -->
    <script src="<?php echo base_url();?>assets/velzon/js/pages/particles.app.js"></script>
    <!-- password-addon init -->
    <script src="<?php echo base_url();?>assets/velzon/js/pages/password-addon.init.js"></script>
    <!-- Additional Core -->
    <script src="<?php echo base_url();?>core/jconfirm-3.3.4/dist/jquery-confirm.min.js"></script>

    <script src="<?php echo base_url();?>assets/velzon/libs/sweetalert2/sweetalert2.min.js"></script>    
    <script>
        $(document).ready(function() {   
            let dashboard_url = "<?= base_url('login'); ?>";
            // $("#userEmail").focus();
            $("#userEmail").val('super@user.com');
            $("#userPassword").val('demo'); 
            
            $(document).on("click","#btn_login", (e) => {
                e.preventDefault();
                e.stopPropagation();
                // window.open(dashboard_url,'_self');
                var user = $("#userEmail").val();
                var password = $("#userPassword").val();                    
                let form = new FormData();
                form.append('user_email', user);
                form.append('user_password', password);                    
                
                $.ajax({
                    type: "post",
                    url: url,
                    data: form, 
                    dataType: 'json', cache: 'false', 
                    contentType: false, processData: false,
                    beforeSend:function(){},
                    success:function(d){
                        let s = d.status;
                        let m = d.message;
                        let r = d.result;
                        if(parseInt(s) == 1){                   
                            localStorage.setItem('lms-userdata', JSON.stringify(r));
                            notif(s,m); 
                            window.open(dashboard_url,'_self');
                        }else{
                            notif(s,m);
                        }
                    },
                    error:function(xhr,status,err){
                        notif(0,err);
                    }
                });
            });
        });
        
        function notif(status, title, text = null) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                customClass: {
                    title: 'mb-0'
                }
            });
            if (parseInt(status) === 1) {
                Toast.fire({
                    icon: 'success',
                    title: title,
                    text: text
                });
            } else if (parseInt(status) === 2) {
                Toast.fire({
                    icon: 'info',
                    title: title,
                    text: text
                });
            } else if (parseInt(status) === 0) {
                Toast.fire({
                    icon: 'error',
                    title: title,
                    text: text
                });
            }
        };
        
    </script>    
</body>

</html>