<!DOCTYPE html>
<!-- =========================================================
* Frest - Bootstrap Admin Template | v1.0.0
==============================================================

* Product Page: https://1.envato.market/frest_admin
* Created by: PIXINVENT
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright PIXINVENT (https://pixinvent.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="{{ base_url }}public/" data-template="vertical-menu-template">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title> {{ $title }} | {{ $_ENV['APP_NAME'] }} </title>

    <meta name="description" content="Start your development with a Dashboard for Bootstrap 5" />
    <meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
	<meta name="base_url" content="{{ base_url }}" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/libs/typeahead-js/typeahead.css') }}" />
    <!-- Vendor -->

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('vendor/css/pages/page-auth.css') }}">
    <!-- Helpers -->
    <script src="{{ asset('vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ asset('vendor/js/template-customizer.js') }}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('js/config.js') }}"></script>

    <script src="{{ asset('framework/vendor/cute-alert/cute-alert.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('framework/vendor/cute-alert/style.css') }}">

    <script src="{{ asset('framework/js/axios.min.js') }}"></script>
    <script src="{{ asset('framework/js/common.js') }}"></script>

    <!-- beautify ignore:end -->

<style>
    body {
        background-size: contain;
        background-attachment: fixed;
        background-position-y: bottom;
        background-repeat: no-repeat;
        /* font-family: 'Quicksand', sans-serif !important;
        line-height: 1.5;
        letter-spacing: 0.0312rem !important; */
    }
</style>

</head>

<body style="background-image: url({{ asset('img/pages/bg4.png') }});">

    <!-- Content -->
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">

                <!-- Register -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <img src="{{ asset('upload/school_logo/logo2.png') }}" class="img-fluid" width="40%">
                            <!-- <img src="{{ asset('upload/school_logo/logo.png') }}" class="img-fluid" width="100%"> -->
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2">Welcome to Suria Intelek kindergarten! 👋</h4>
                        <!-- <h4 class="mb-2">Welcome to SchoolScan! 👋</h4> -->
                        <p class="mb-4">Please sign-in to your account</p>

                        <form id="formAuthentication" method="POST" action="{{ url('auth/authorize') }}" class="mb-3">
                            <div class="mb-3">
                                <label for="username" class="form-label">Email or Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your email or username" autofocus>
                                <span class="help-block text-danger" id="usernameErr" style="display: none;">
                                    Email / Username are Required
                                </span>
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Password</label>
                                    <!-- <a href="{{ url('auth/forgot') }}">
                                        <small>Forgot Password?</small>
                                    </a> -->
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" name="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                                    <!-- <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span> -->
                                </div>
                            </div>
                            <div class="mb-3">
                                <button type="submit" id="loginBtn" class="btn btn-primary d-grid w-100">Sign in <i class="fa fa-sign-in"></i></button>
                            </div>
                        </form>
                        <button onclick="location.href='{{ url('home') }}'" id="homeBtn" class="btn btn-outline-danger form-control mb-2"> <i class="fa fa-home"></i> Homepage </button>
                        <p class="text-center">
                            <span>New on our school?</span>
                            <a href="{{ url('application/form') }}">
                                <span>Create an account</span>
                            </a>
                        </p>

                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('vendor/js/bootstrap.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>

    <!-- Page JS -->
    <!-- <script src="{{ asset('js/pages-auth.js') }}"></script> -->

    <script>
        $("#formAuthentication").submit(function(event) {
            event.preventDefault();
            var username = $('#username').val();
            var password = $('#password').val();

            if (username != '' && password != '') {
                var form = $(this);
                var url = form.attr('action');

                $.ajax({
                    type: "POST",
                    url: url,
                    headers: {
                        "Authorization": `Bearer ${$('meta[name="csrf-token"]').attr('content')}`,
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: form.serialize(),
                    dataType: "JSON",
                    beforeSend: function() {
                        $("#loginBtn").text('Being processed...');
                        $("#loginBtn").attr('disabled', true);
                    },
                    success: function(data) {
                        if (data.response == 200) {
                            setTimeout(function() {
                                window.location.href = data.redirectUrl;
                            }, 5);
                        } else {
                            noti(500, data.message);
                        }
                    },
                    complete: function() {
                        $("#loginBtn").html('Log In <i class="fa fa-sign-in"></i>');
                        $("#loginBtn").attr('disabled', false);
                    }
                });
            } else {
                if (username == '' && password == '') {
                    noti(500, 'Please enter your email/username & password');
                } else if (username == '') {
                    noti(500, 'Please enter your email/username');
                } else if (password == '') {
                    noti(500, 'Please enter your password');
                }
            }
        });
    </script>

</body>

</html>