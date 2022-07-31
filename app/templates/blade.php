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
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed " dir="ltr" data-theme="theme-default" data-assets-path="{{ base_url }}public/" data-template="vertical-menu-template">

  <head>
    <meta charset="utf-8" />

    <base href="{{ base_url }}">
    <title> {{ $title }} | {{ $_ENV['APP_NAME'] }} </title>
    <meta charset="utf-8" />
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 5" />
    <meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="base_url" content="{{ base_url }}" />

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/fonts/flag-icons.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Core CSS -->
    <!-- <link rel="stylesheet" href="{{ asset('vendor/css/rtl/core.css') }}" class="template-customizer-core-css" /> -->
    <link rel="stylesheet" href="{{ asset('vendor/css/rtl/theme-semi-dark.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/libs/animate-css/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('vendor/libs/fullcalendar/fullcalendar.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/libs/quill/editor.css') }}" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/css/pages/app-calendar.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('vendor/js/helpers.js') }}"></script>

    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link rel="stylesheet" href="{{ asset('framework/vendor/cute-alert/style.css') }}">
    <!--end::Global Stylesheets Bundle-->

    <script src="{{ asset('vendor/js/template-customizer.js') }}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('js/config.js') }}"></script>

    <!-- jquery -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script src="{{ asset('vendor/libs/jquery/jquery.js') }}"></script> 
    
    <!--begin::Javascript-->
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="{{ asset('framework/js/axios.min.js') }}"></script>
    <script src="{{ asset('framework/js/html2canvas.js') }}"></script>
    <script src="{{ asset('framework/js/common.js') }}"></script>
    <script src="{{ asset('framework/js/printThis.js') }}"></script> 
    <script src="{{ asset('framework/vendor/cute-alert/cute-alert.js') }}"></script>
    <script src="https://cdn.ckeditor.com/4.18.0/basic/ckeditor.js"></script>
    <!--end::Global Javascript Bundle-->

</head>

<body>

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar  ">
        <div class="layout-container">

            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

                <div class="app-brand demo ">
                    <a href="javascript:void(0)" class="app-brand-link">
                        <!-- <span class="app-brand-logo demo">
                            <svg width="26px" height="26px" viewBox="0 0 26 26" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>icon</title>
                                <defs>
                                    <linearGradient x1="50%" y1="0%" x2="50%" y2="100%" id="linearGradient-1">
                                        <stop stop-color="#5A8DEE" offset="0%"></stop>
                                        <stop stop-color="#699AF9" offset="100%"></stop>
                                    </linearGradient>
                                    <linearGradient x1="0%" y1="0%" x2="100%" y2="100%" id="linearGradient-2">
                                        <stop stop-color="#FDAC41" offset="0%"></stop>
                                        <stop stop-color="#E38100" offset="100%"></stop>
                                    </linearGradient>
                                </defs>
                                <g id="Pages" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="Login---V2" transform="translate(-667.000000, -290.000000)">
                                        <g id="Login" transform="translate(519.000000, 244.000000)">
                                            <g id="Logo" transform="translate(148.000000, 42.000000)">
                                                <g id="icon" transform="translate(0.000000, 4.000000)">
                                                    <path d="M13.8863636,4.72727273 C18.9447899,4.72727273 23.0454545,8.82793741 23.0454545,13.8863636 C23.0454545,18.9447899 18.9447899,23.0454545 13.8863636,23.0454545 C8.82793741,23.0454545 4.72727273,18.9447899 4.72727273,13.8863636 C4.72727273,13.5423509 4.74623858,13.2027679 4.78318172,12.8686032 L8.54810407,12.8689442 C8.48567157,13.19852 8.45300462,13.5386269 8.45300462,13.8863636 C8.45300462,16.887125 10.8856023,19.3197227 13.8863636,19.3197227 C16.887125,19.3197227 19.3197227,16.887125 19.3197227,13.8863636 C19.3197227,10.8856023 16.887125,8.45300462 13.8863636,8.45300462 C13.5386269,8.45300462 13.19852,8.48567157 12.8689442,8.54810407 L12.8686032,4.78318172 C13.2027679,4.74623858 13.5423509,4.72727273 13.8863636,4.72727273 Z" id="Combined-Shape" fill="#4880EA"></path>
                                                    <path d="M13.5909091,1.77272727 C20.4442608,1.77272727 26,7.19618701 26,13.8863636 C26,20.5765403 20.4442608,26 13.5909091,26 C6.73755742,26 1.18181818,20.5765403 1.18181818,13.8863636 C1.18181818,13.540626 1.19665566,13.1982714 1.22574292,12.8598734 L6.30410592,12.859962 C6.25499466,13.1951893 6.22958398,13.5378796 6.22958398,13.8863636 C6.22958398,17.8551125 9.52536149,21.0724191 13.5909091,21.0724191 C17.6564567,21.0724191 20.9522342,17.8551125 20.9522342,13.8863636 C20.9522342,9.91761479 17.6564567,6.70030817 13.5909091,6.70030817 C13.2336969,6.70030817 12.8824272,6.72514561 12.5388136,6.77314791 L12.5392575,1.81561642 C12.8859498,1.78721495 13.2366963,1.77272727 13.5909091,1.77272727 Z" id="Combined-Shape2" fill="url(#linearGradient-1)"></path>
                                                    <rect id="Rectangle" fill="url(#linearGradient-2)" x="0" y="0" width="7.68181818" height="7.68181818"></rect>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>

                        </span> -->
                        <img src="<?= base_url; ?>public/upload/school_logo/{{ session()->get('schoolLogo') }}"  alt class="img-fluid">
                        <!-- <img src="<?= base_url; ?>public/upload/school_logo/{{ session()->get('schoolLogo') }}"  alt class="app-brand-logo demo rounded-circle">  -->
                        <!-- <span class="app-brand-text demo menu-text ms-2">Tadika Suria </span> -->
                    </a>

                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                        <i class="bx menu-toggle-icon d-none d-xl-block fs-4 align-middle"></i>
                        <i class="bx bx-x d-block d-xl-none bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-divider mt-0  ">
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Dashboards -->
                    <li class="menu-item <?= ($currentSidebar == 'dashboard') ? 'active' : '' ?>">
                        <a href="{{ url('dashboard') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div>Dashboard</div>
                        </a>
                    </li>

                    <!-- General -->
                    <li class="menu-header small text-uppercase"><span class="menu-header-text"> General </span></li>
                    <!-- <li class="menu-item <?= ($currentSidebar == 'calendar') ? 'active' : '' ?>">
                        <a href="{{ url('calendar') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-calendar"></i>
                            <div>Calendar</div>
                        </a>
                    </li> -->

                    <?php if (session()->get('roleID') == 1) { ?>
                        @include('app.templates.menu.superadmin_menu')
                    <?php } else if (session()->get('roleID') == 2) { ?>
                        @include('app.templates.menu.administrator_menu')
                    <?php } else if (session()->get('roleID') == 3) { ?>
                        @include('app.templates.menu.admission_menu')
                    <?php } else if (session()->get('roleID') == 4) { ?>
                        @include('app.templates.menu.teacher_menu')
                    <?php } else if (session()->get('roleID') == 5) { ?>
                        @include('app.templates.menu.parent_menu')
                    <?php }  ?>

                </ul>

            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">

                <!-- Navbar -->
                <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
                    <div class="container-fluid">

                        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0   d-xl-none ">
                            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                                <i class="bx bx-menu bx-sm"></i>
                            </a>
                        </div>

                        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

                            <ul class="navbar-nav flex-row align-items-center ms-auto">

                                <!-- Style Switcher -->
                                <li class="nav-item me-2 me-xl-0">
                                    <a class="nav-link style-switcher-toggle hide-arrow" href="javascript:void(0);">
                                        <i class='bx bx-sm'></i>
                                    </a>
                                </li>
                                <!--/ Style Switcher -->

                                <?php if (session()->get('roleID') == 1 || session()->get('roleID') == 2 || session()->get('roleID') == 3) { ?>
                                    <!-- Quick links  -->
                                    <li class="nav-item dropdown-shortcuts navbar-dropdown dropdown me-2 me-xl-0">
                                        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                            <i class='bx bx-grid-alt bx-sm'></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end py-0">
                                            <div class="dropdown-menu-header border-bottom">
                                                <div class="dropdown-header d-flex align-items-center py-3">
                                                    <h5 class="text-body mb-0 me-auto">Shortcuts</h5>
                                                    <!-- <a href="javascript:void(0)" class="dropdown-shortcuts-add text-body" data-bs-toggle="tooltip" data-bs-placement="top" title="Add shortcuts"><i class="bx bx-sm bx-plus-circle"></i></a> -->
                                                </div>
                                            </div>
                                            <div class="dropdown-shortcuts-list scrollable-container">
                                                <div class="row row-bordered overflow-visible g-0">
                                                    <div class="dropdown-shortcuts-item col">
                                                        <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                                                            <i class="bx bx-calendar fs-4"></i>
                                                        </span>
                                                        <a href="{{ url('calendar') }}" class="stretched-link">Calendar</a>
                                                        <small class="text-muted mb-0">Appointments</small>
                                                    </div>
                                                    <div class="dropdown-shortcuts-item col">
                                                        <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                                                            <i class="bx bx-food-menu fs-4"></i>
                                                        </span>
                                                        <a href="{{ url('billing/invoice') }}" class="stretched-link">Invoice App</a>
                                                        <small class="text-muted mb-0">Manage Accounts</small>
                                                    </div>
                                                </div>
                                                <div class="row row-bordered overflow-visible g-0">
                                                    <div class="dropdown-shortcuts-item col">
                                                        <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                                                            <i class="bx bx-user fs-4"></i>
                                                        </span>
                                                        <a href="{{ url('user/parent') }}" class="stretched-link">Parent App</a>
                                                        <small class="text-muted mb-0">Manage Users</small>
                                                    </div>

                                                    @if(session()->get('roleID') == 1)
                                                    <div class="dropdown-shortcuts-item col">
                                                        <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                                                            <i class="bx bx-check-shield fs-4"></i>
                                                        </span>
                                                        <a href="{{ url('management/role') }}" class="stretched-link">Role Management</a>
                                                        <small class="text-muted mb-0">Permission</small>
                                                    </div>
                                                    @endif

                                                </div>
                                               <!--  <div class="row row-bordered overflow-visible g-0">
                                                    <div class="dropdown-shortcuts-item col">
                                                        <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                                                            <i class="bx bx-pie-chart-alt-2 fs-4"></i>
                                                        </span>
                                                        <a href="{{ url('dashboard') }}" class="stretched-link">Dashboard</a>
                                                        <small class="text-muted mb-0">User Profile</small>
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
                                    </li>
                                    <!-- Quick links -->
                                <?php }  ?>

                                <!-- Notification -->
                                @include('app.templates.notification')
                                <!--/ Notification -->

                                <!-- User -->
                                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                        <div class="avatar avatar-online">
                                            <img id="profileImageBladeAvatar" src="<?= base_url; ?>{{ session()->get('avatar') }}"  alt class="rounded-circle">
                                        </div>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0)">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar avatar-online">
                                                            <img id="profileImageMenuBladeAvatar" src="<?= base_url; ?>{{ session()->get('avatar') }}"  alt class="rounded-circle">
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <span class="fw-semibold d-block lh-1">{{ session()->get('userSalutation') }}. {{ session()->get('userPreferredName') }}</span>
                                                        <small>{{ session()->get('roleName') }}</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider"></div>
                                        </li>
                                        @if(session()->get('roleID') == 5)
                                        <li>
                                            <a class="dropdown-item" href="{{ url('profile/personal') }}">
                                                <i class="bx bx-user me-2"></i>
                                                <span class="align-middle">My Profile</span>
                                            </a>
                                        </li> 
                                        <li>
                                            <div class="dropdown-divider"></div>
                                        </li> 
                                        @endif
                                        <li>
                                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#logoutModal" class="dropdown-item">
                                                <i class="bx bx-power-off me-2"></i>
                                                <span class="align-middle">Log Out</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <!--/ User -->

                            </ul>
                        </div>

                    </div>
                </nav>
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">

                    <!-- Content -->
                    <div class="container-fluid flex-grow-1 container-p-y">
                        @yield('content')
                    </div>
                    <!-- /Content -->

                    <!-- Modal Preview PDF -->
                    <div class="modal fade" id="previewPdfModal" tabindex="-1" aria-hidden="true" data-backdrop="true">
                        <div class="modal-dialog modal-lg">
                            <div id="showNotFoundPDF" class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"></div>
                            <div id="showPDF" style="display: none;"></div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-fluid d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                            <div class="mb-2 mb-md-0">
                                © <script>
                                    document.write(new Date().getFullYear())
                                </script>,
                                Develop by <a href="javascript:void(0)" class="footer-link fw-semibold">CanThink Solution</a>
                            </div>
                            <div>
                                <a href="javascript:void(0)" class="footer-link me-4" >License</a>
                                <a href="javascript:void(0)" class="footer-link d-none d-sm-inline-block">Support</a>
                            </div>
                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <!-- <script src="{{ asset('vendor/libs/hammer/hammer.js') }}"></script> -->
    <!-- <script src="{{ asset('vendor/libs/i18n/i18n.js') }}"></script> -->
    <!-- <script src="{{ asset('vendor/libs/typeahead-js/typeahead.js') }}"></script> -->

    <script src="{{ asset('vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('vendor/libs/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('vendor/libs/datatables-responsive/datatables.responsive.js') }}"></script>
    <script src="{{ asset('vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js') }}"></script>
    <script src="{{ asset('vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.js') }}"></script>
    <script src="{{ asset('vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('vendor/libs/fullcalendar/fullcalendar.js') }}"></script>
    <script src="{{ asset('vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('vendor/libs/block-ui/block-ui.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('js/app-calendar.js') }}"></script>

    <script>
        $(document).ready(function() {
            getNotification();
        });

        async function markAllRead()
        {
            const res = await callApi('post', "notification/markAllRead");
            if(isSuccess(res.status))
            {
                getNotification();
            }
        }

        async function getNotification()
        {
            const res = await callApi('post', "notification/getListNotiByUser");

            if(isSuccess(res.status))
            {
                const data = res.data;
                const count = data.countUnread;
                const notiArr = data.listNoti;
                $('#countUnreadNoti').text(count);
                if(count > 0){
                    $('#listnotification').empty(); // reset list
                    notiArr.forEach(function(data) {
                        var typeDisplay = '';
                        var notiID = data.noti_id;
                        var type = data.noti_type;
                        var text = data.noti_text;
                        var name = data.user_preferred_name;
                        // var date = moment(data.created_at).format("DD/MM/YYYY");
                        var date = '';

                        if(type == 1) {
                            typeDisplay = '<span class="avatar-initial rounded-circle bg-label-danger">APP</span>';
                        } else if(type == 2) {
                            typeDisplay = '<span class="avatar-initial rounded-circle bg-label-warning">INV</span>';
                        } else if(type == 3) {
                            typeDisplay = '<span class="avatar-initial rounded-circle bg-label-success">REC</span>';
                        } else {
                            typeDisplay = '<span class="avatar-initial rounded-circle bg-label-info">NOTI</span>';
                        }

                        var url = 'redirectNoti("'+data.noti_redirect+'",'+notiID+')';
                        var redirect = (data.noti_redirect != null) ? 'style="cursor: pointer;" onclick='+url : '';

                        var noti = '<li class="list-group-item list-group-item-action dropdown-notifications-item">\
                                        <div class="d-flex" '+redirect+'>\
                                            <div class="flex-shrink-0 me-3">\
                                                <div class="avatar">\
                                                    '+typeDisplay+'\
                                                </div>\
                                            </div>\
                                            <div class="flex-grow-1">\
                                                <h6 class="mb-1">'+ucfirst(name)+'</h6>\
                                                <p class="mb-0">'+text+'</p>\
                                                <small class="text-muted"> '+date+'</small>\
                                            </div>\
                                            <div class="flex-shrink-0 dropdown-notifications-actions">\
                                                <a href="javascript:void(0)" onclick="readNoti('+notiID+')" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>\
                                                <a href="javascript:void(0)" onclick="removeNoti('+notiID+')"  class="dropdown-notifications-archive"><span class="bx bx-x"></span></a>\
                                            </div>\
                                        </div>\
                                    </li>';

                        $('#listnotification').append(noti);
                    });
                }else{
                    $('#listnotification').empty();
                    var noti = '<li class="list-group-item list-group-item-action dropdown-notifications-item">\
                                    <div class="d-flex">\
                                        No new notification\
                                    </div>\
                                </li>';
                    $('#listnotification').append(noti);
                }
            }
        }

        async function readNoti(id)
        {
            const res = await callApi('post', "notification/read", id);
            if(isSuccess(res.status))
            {
                getNotification();
            }
        }

        function redirectNoti(url, id)
        {
            readNoti(id);
            setTimeout(function() {
                window.location.href = url;
            }, 250);

        }

        async function removeNoti(id)
        {
            const res = await callApi('post', "notification/delete", id);

            if(isSuccess(res.status))
            {
                getNotification();
            }
        }

        function previewPDF(fileLoc, fileType) {
            $('#showPDF').empty();
            $('#previewPdfModal').modal('show');
            $('#previewPdfModal').css('z-index', 1500);
            $('#showPDF').css('display', 'block');
            $('#showPDF').append('<object type="application/' + fileType + '" data="' + fileLoc + '" width="100%" height="500" style="height: 85vh;"></object>');
        }

        function downloadPDF(fileLoc, fileType) {
            var a = document.createElement('a');
            a.href = fileLoc;
            a.download = "Payment";
            document.body.append(a);
            a.click();
            a.remove();
        }

        function printData(idToPrint = null, idBtn = 'printBtn') {
            var btnText = $("#" + idBtn).html();

            if(idToPrint !=null){
                $("#" + idToPrint).printThis({
                    debug: false,
                    importCSS: true,
                    importStyle: true,
                    pageTitle: "",
                    beforePrintEvent: $("#" + idBtn).html('<i class="fas fa-spinner"> </i> Being processed...'),
                    beforePrint: $("#" + idBtn).attr('disabled', true),
                });

                setTimeout(function() {
                    $("#" + idBtn).html(btnText);
                    $("#" + idBtn).attr('disabled', false);
                }, 800);
            }
        }
    </script>
</body>

</html>


@include('app.views.modals._modalLogout')
@include('app.views.modals._modalGeneral')
@include('public.framework.php.general')