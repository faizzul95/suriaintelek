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
<html lang="en" class="light-style " dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('') }}" data-template="vertical-menu-template">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title> {{ $title }} | {{ $_ENV['APP_NAME'] }} </title>
    
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 5" />
    <meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">

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
    <!-- <link rel="stylesheet" href="{{ asset('vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css" /> -->
    <link rel="stylesheet" href="{{ asset('css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/libs/typeahead-js/typeahead.css') }}" />
    

    <!-- Page CSS -->
    <!-- Page -->
<link rel="stylesheet" href="{{ asset('vendor/css/pages/page-misc.css') }}">
    <!-- Helpers -->
    <script src="{{ asset('vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ asset('vendor/js/template-customizer.js') }}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('js/config.js') }}"></script>
    
    <!-- Custom notification for demo -->
    <!-- beautify ignore:end -->

</head>

<body>

  <!-- Content -->

  <!-- Not Authorized -->
  <div class="container-xxl container-p-y">
    <div class="misc-wrapper">
      <h1 class="mb-2 mx-2">You are not authorized!</h1>
      <p class="mb-4 mx-2">You don???t have permission to access this page. Go Home!!</p>
      <a href="{{ url('dashboard') }}" class="btn btn-primary">Back to home</a>
      <div class="mt-5">
        <img src="{{ asset('img/illustrations/girl-hacking-site-light.png') }}" alt="page-misc-error-light" width="450" class="img-fluid" data-app-light-img="illustrations/girl-hacking-site-light.png" data-app-dark-img="illustrations/girl-hacking-site-dark.png">
      </div>
    </div>
  </div>
  <!-- /Not Authorized -->

  <!-- / Content -->

  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="{{ asset('vendor/libs/jquery/jquery.js') }}"></script>
  <script src="{{ asset('vendor/libs/popper/popper.js') }}"></script>
  <script src="{{ asset('vendor/js/bootstrap.js') }}"></script>
  <script src="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
  <!-- endbuild -->

  <!-- Vendors JS -->

</body>

</html>