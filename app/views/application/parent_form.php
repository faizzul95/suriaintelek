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
<html lang="en" class="light-style  customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="{{ base_url }}public/" data-template="vertical-menu-template">

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
    <!-- Vendor -->
    <link rel="stylesheet" href="{{ asset('vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/libs/spinkit/spinkit.css') }}" />

    <!-- Page CSS -->
    
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('vendor/css/pages/page-auth.css') }}">
    <!-- Helpers -->
    <!-- <script src="{{ asset('vendor/js/helpers.js') }}"></script> -->

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <!-- <script src="{{ asset('vendor/js/template-customizer.js') }}"></script> -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <!-- <script src="{{ asset('js/config.js') }}"></script> -->

    <script src="{{ asset('framework/vendor/cute-alert/cute-alert.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('framework/vendor/cute-alert/style.css') }}">

    <script src="{{ asset('framework/js/axios.min.js') }}"></script>
    <script src="{{ asset('framework/js/common.js') }}"></script>
    <!-- beautify ignore:end -->

</head>

<body>

    <!-- Content -->

    <div class="authentication-wrapper authentication-cover">
        <div class="authentication-inner row m-0">

            <!-- Left Text -->
            <div class="d-none d-lg-flex col-lg-5 align-items-center justify-content-end" style='background-image:url("{{ asset('img/illustrations/create-account-light.png') }}");background-repeat: no-repeat; background-size: cover;background-position: center;'>
                <div class="row justify-content-center gap-sm-0 gap-3">
                    <div class="col-12 text-center mb-4">
                        <!-- <img src="{{ asset('upload/school_logo/logo.png') }}" class="img-fluid" width="50%"> -->
                        <img src="{{ asset('upload/school_logo/logo2.png') }}" class="img-fluid" width="20%">
                    </div>
                    <div class="col-12 text-center mb-4">
                        <div class="badge bg-label-primary">Question?</div>
                        <h4 class="my-2">You still have a question?</h4>
                        <p>You can always contact us. We will answer to you shortly!</p>
                    </div>
                    <div class="col-sm-6">
                        <div class=" py-3 rounded bg-faq-section text-center">
                            <span class="badge bg-label-primary rounded-3 p-2 my-3">
                                <i class="bx bx-phone bx-sm"></i>
                            </span>
                            <h4 class="mb-2"><a class="h4" href="tel:+(60)13178899">03-2093 1740</a></h4>
                            <p>We are always happy to help</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class=" py-3 rounded bg-faq-section text-center">
                            <span class="badge bg-label-primary rounded-3 p-2 my-3">
                                <i class="bx bx-envelope bx-sm"></i>
                            </span>
                            <h4 class="mb-2"><a class="h4" href="mailto:help@help.com">help@help.com</a></h4>
                            <p>Best way to get a quick answer</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Left Text -->

            <!-- Registration -->
            <div id="formDiv" class="d-flex col-lg-7 authentication-bg p-sm-5 p-3" style="overflow:auto; max-height:100%;position:relative;margin:auto;">
                <div class="d-flex flex-column w-px-700 mx-auto">
                    <!-- Logo -->
                    <div class="app-brand border-bottom mx-3 mb-4">
                        <a href="javascript:void(0)" class="app-brand-link gap-2 mb-3">
                            <img src="{{ asset('upload/school_logo/logo2.png') }}" class="img-fluid" width="7%">
                            <!-- <img src="{{ asset('img/favicon/favicon.ico') }}" class="img-fluid" width="5%"> -->
                            <span class="app-brand-text demo h3 mb-0 fw-bold"> Application Form </span>
                        </a>
                        <span class="app-brand-text h6 mb-0 fw-bold float-end"> {{ date('l') }}, {{ date('F d, Y') }} </span>
                    </div>
                    <!-- /Logo -->

                    <div class="my-auto">
                        <form id="applicationForm" class="mb-4">

                            <!-- Personal Details -->
                            <div class="row g-2">
                                <span class="text-danger">* Indicates a required field</span>
                                <h6 class="fw-bold">1. Personal / Parent / Guardian Details</h6>
                                <div class="col-md-2">
                                    <label class="form-label">Salutation <span class="text-danger">*</span> </label>
                                    <select id="user_salutation" name="user_salutation" class="form-control" required>
                                        <option value=""> - Select - </option>
                                        <option value="MR"> Encik / Mr </option>
                                        <option value="MRS"> Puan / Mrs </option>
                                        <option value="MS"> Cik / Ms </option>
                                        <option value="DR"> Dr </option>
                                        <option value="DATO"> Dato' </option>
                                        <option value="DATIN"> Datin </option>
                                        <option value="TAN SRI"> Tan Sri </option>
                                        <option value="PUAN SRI"> Puan Sri </option>
                                    </select>
                                </div>
                                <div class="col-md-10">
                                    <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" id="user_fullname" name="user_fullname" class="form-control maxlength-input" maxlength="100" autocomplete="off" onKeyUP="this.value = this.value.toUpperCase();" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Preferred Name <span class="text-danger">*</span></label>
                                    <input type="text" id="user_preferred_name" name="user_preferred_name" class="form-control maxlength-input" maxlength="15" autocomplete="off" onKeyUP="ucfirstVal(this.value, 'user_preferred_name');" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">NRIC No.<span class="text-danger">*</span></label>
                                    <input type="text" id="user_nric" name="user_nric" class="form-control maxlength-input" maxlength="15" autocomplete="off" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" id="user_email" name="user_email" class="form-control maxlength-input" maxlength="50" autocomplete="off" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Contact / HP No <span class="text-danger">*</span></label>
                                    <input type="text" id="user_contact_no" name="user_contact_no" class="form-control maxlength-input" maxlength="13" autocomplete="off" onkeypress="return isNumberKey(event)" required>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label"> Address <span class="text-danger">*</span></label>
                                    <textarea id="user_address" name="user_address" class="form-control maxlength-input" maxlength="250" autocomplete="off" rows="3" onKeyUP="this.value = this.value.toUpperCase();" required></textarea>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label"> Postal Code <span class="text-danger">*</span></label>
                                    <input type="text" id="user_postcode" name="user_postcode" class="form-control maxlength-input" maxlength="8" autocomplete="off" onkeypress="return isNumberKey(event)" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label"> City <span class="text-danger">*</span></label>
                                    <input type="text" id="user_city" name="user_city" class="form-control maxlength-input" maxlength="25" autocomplete="off" onKeyUP="this.value = this.value.toUpperCase();" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label"> State <span class="text-danger">*</span></label>
                                    <select id="user_state" name="user_state" class="form-control" required>
                                        <option value=""> - Select - </option>
                                        <option value="JOHOR">Johor</option>
                                        <option value="KEDAH">Kedah</option>
                                        <option value="KELANTAN">Kelantan</option>
                                        <option value="KUALA LUMPUR">Kuala Lumpur</option>
                                        <option value="LABUAN">Labuan</option>
                                        <option value="MELAKA">Melaka</option>
                                        <option value="NEGERI SEMBILAN">Negeri Sembilan</option>
                                        <option value="PAHANG">Pahang</option>
                                        <option value="PULAU PINANG">Pulau Pinang</option>
                                        <option value="PERAK">Perak</option>
                                        <option value="PERLIS">Perlis</option>
                                        <option value="PUTRAJAYA">Putrajaya</option>
                                        <option value="SABAH">Sabah</option>
                                        <option value="SARAWAK">Sarawak</option>
                                        <option value="SELANGOR">Selangor</option>
                                        <option value="TERENGGANU">Terengganu</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label"> Gender <span class="text-danger">*</span></label>
                                    <select id="user_gender" name="user_gender" class="form-control" required>
                                        <option value=""> - Select - </option>
                                        <option value="Male"> Male </option>
                                        <option value="Female"> Female </option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label"> Religion </label>
                                    <select id="user_religion" name="user_religion" class="form-control">
                                        <option value=""> - Select - </option>
                                        <option value="Islam"> Islam </option>
                                        <option value="Buddhism"> Buddhism </option>
                                        <option value="Christianity"> Christianity </option>
                                        <option value="Hinduism"> Hinduism </option>
                                        <option value="Sikhism "> Sikhism </option>
                                        <option value="Others"> Others </option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label"> Race </label>
                                    <select id="user_race" name="user_race" class="form-control">
                                        <option value=""> - Select - </option>
                                        <option value="Melayu"> Melayu </option>
                                        <option value="Chinese"> Chinese </option>
                                        <option value="Indian"> Indian </option>
                                        <option value="Others"> Others </option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label"> Occupation <span class="text-danger">*</span></label>
                                    <input type="text" id="user_job" name="user_job" class="form-control maxlength-input" maxlength="100" onKeyUP="ucfirstVal(this.value, 'user_job');" autocomplete="off" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label"> Salary (RM) <span class="text-danger">*</span></label>
                                    <input type="text" id="user_salary" name="user_salary" class="form-control maxlength-input" maxlength="8" autocomplete="off" onkeypress="return isNumberKey(event)" required>
                                </div>
                            </div>

                            <!-- Student Details -->
                            <div class="row g-2 mt-3">
                                <h6 class="fw-bold">2. Student Details</h6>

                                <div class="alert alert-primary d-flex align-items-center" role="alert">
                                    <i class="bx bx-xs bx-detail me-2"></i>
                                    <b>Info!</b> &nbsp; Click the "+" button to add more students. Maximum allowed students is 3 people
                                </div>

                                <ul class="nav nav-tabs" id="studentForm" role="tablist">
                                    <li class="nav-item" id="addButtonLi" role="presentation">
                                        <button class="nav-link" id="addBtn" onclick="dynamicStudentField()" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                            </svg>
                                        </button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="contentPanel"></div>
                            </div>

                            <!-- Button Action -->
                            <div class="row g-2 mt-3">
                                <div class="col-md-12">
                                    <input id="acceptTerms" name="termscondition" type="checkbox" value="true" required>
                                    I agree and accept the
                                    <a href="javascript:void(0)" onclick="viewTnC()" class="text-info">
                                        <u> Terms & Conditions </u>
                                    </a>
                                    and
                                    <a href="javascript:void(0)" onclick="viewPrivacy()" class="text-info">
                                        <u> Privacy Policy </u>
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <!-- <a href="{{ url('home') }}" id="homeBtn" class="btn btn-outline-success form-control"> <i class="fa fa-home"></i> Homepage </a> -->
                                    <button onclick="location.href='{{ url('home') }}'" id="homeBtn" class="btn btn-outline-success form-control"> <i class="fa fa-home"></i> Homepage </button>
                                </div>
                                <div class="col-md-3">
                                    <!-- <a href="{{ url('auth/login') }}" id="loginBtn" class="btn btn-danger form-control"> <i class="fa fa-arrow-left"></i> Back to Login </a> -->
                                    <button onclick="location.href='{{ url('auth/login') }}'" id="loginBtn" class="btn btn-danger form-control"> <i class="fa fa-arrow-left"></i> Back to Login </button>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" id="submitBtn" class="btn btn-info form-control"> <i class="fa fa-save"></i> Submit </button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Registration -->
        </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
    <script src="{{ asset('/vendor/libs/block-ui/block-ui.js') }}"></script>

    <script type="text/javascript">
        // bootstrap-maxlength & repeater (jquery)
        $(function() {
            var maxlengthInput = $('.maxlength-input'),
                formRepeater = $('.form-repeater');

            // Bootstrap Max Length
            // --------------------------------------------------------------------
            if (maxlengthInput.length) {
                maxlengthInput.each(function() {
                    $(this).maxlength({
                        warningClass: 'label label-success bg-success text-white',
                        limitReachedClass: 'label label-danger',
                        separator: ' out of ',
                        preText: 'You typed ',
                        postText: ' chars available.',
                        validate: true,
                        threshold: +this.getAttribute('maxlength')
                    });
                });
            }
        });

        $(document).ready(function() {
            dynamicStudentField();
        });

        function dynamicStudentField() {
            var count = $('input[name="stud_name[]"]').length;
            var currentNo = count + 1;
            var maxChild = 3;

            $('.nav-link').removeClass('active');
            $('.tab-pane').removeClass('active');
            $('.tab-pane').removeClass('show');

            if (currentNo <= maxChild) {

                var tab = '<li class="nav-item" id="liStud' + currentNo + '" data-count="' + currentNo + '" role="presentation">\
                                    <button class="nav-link" id="studentTab' + currentNo + '-tab" data-bs-toggle="tab" data-bs-target="#studentTab' + currentNo + '" type="button" role="tab" aria-controls="studentTab' + currentNo + '" aria-selected="true">\
                                        <span id="studentName' + currentNo + '">Student #' + currentNo + '</span>\
                                        <svg id="#studentSVG' + currentNo + '" onclick="removeStudent(' + currentNo + ')" xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-2 text-danger feather feather-x">\
                                            <line x1="18" y1="6" x2="6" y2="18"></line>\
                                            <line x1="6" y1="6" x2="18" y2="18"></line>\
                                        </svg>\
                                    </button>\
                                </li>';

                var form = '<div class="tab-pane fade p-0" id="studentTab' + currentNo + '" role="tabpanel" aria-labelledby="studentTab' + currentNo + '-tab">\
                                <div class="row tab">\
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">\
                                        <div class="row">\
                                            <div class="col-md-12">\
                                                <label class="form-label" for="username"> Student Full Name <span class="text-danger">*</span></label>\
                                                <input type="text" id="stud_name' + currentNo + '" name="stud_name[]" class="form-control maxlength-input" maxlength="80" autocomplete="off" onKeyUP="this.value = this.value.toUpperCase();" required>\
                                            </div>\
                                            <div class="col-md-6 mt-2">\
                                                <label class="form-label" for="username"> Preferred Name <span class="text-danger">*</span></label>\
                                                <input type="text" id="stud_preferred_name' + currentNo + '" name="stud_preferred_name[]" class="form-control maxlength-input" maxlength="20" autocomplete="off" onKeyUP="changeTabName(' + currentNo + ', this.value)" placeholder="(used as the student name for the card matric)" required>\
                                            </div>\
                                            <div class="col-md-6 mt-2">\
                                                <label class="form-label" for="username"> NRIC / Passport <span class="text-danger">*</span></label>\
                                                <input type="text" id="stud_nric' + currentNo + '" name="stud_nric[]" class="form-control maxlength-input" maxlength="15" autocomplete="off" required>\
                                            </div>\
                                            <div class="col-md-4 mt-2">\
                                                <label class="form-label"> Gender <span class="text-danger">*</span></label>\
                                                <select id="stud_gender' + currentNo + '" name="stud_gender[]" class="form-control" required>\
                                                    <option value=""> - Select - </option>\
                                                    <option value="Male"> Male </option>\
                                                    <option value="Female"> Female </option>\
                                                </select>\
                                            </div>\
                                            <div class="col-md-4 mt-2">\
                                                <label class="form-label"> Race </label>\
                                                <select id="stud_race' + currentNo + '" name="stud_race[]" class="form-control">\
                                                    <option value=""> - Select - </option>\
                                                    <option value="Melayu"> Melayu </option>\
                                                    <option value="Chinese"> Chinese </option>\
                                                    <option value="Indian"> Indian </option>\
                                                    <option value="Others"> Others </option>\
                                                </select>\
                                            </div>\
                                            <div class="col-md-4 mt-2">\
                                                <label class="form-label"> Birth Date <span class="text-danger">*</span></label>\
                                                <input type="date" id="stud_dob' + currentNo + '" name="stud_dob[]" class="form-control" max="<?= date('Y-12-31', strtotime('-3 years')); ?>" min="<?= date('Y-01-01', strtotime('-6 years')); ?>" value="<?= date('Y-01-01', strtotime('-6 years')); ?>" required>\
                                            </div>\
                                            <div class="col-md-6 mt-2">\
                                                <label class="form-label"> Level <span class="text-danger">*</span></label>\
                                                <select id="level_id' + currentNo + '" name="level_id[]" class="form-control" required>\
                                                    <option value=""> - Select - </option>\
                                                </select>\
                                            </div>\
                                            <div class="col-md-6 mt-2">\
                                                <label class="form-label">Relationship <span class="text-danger">*</span></label>\
                                                <select id="user_relation' + currentNo + '" name="user_relation[]" class="form-control" required>\
                                                    <option value=""> - Select - </option>\
                                                    <option value="Mother"> Ibu Kandung / Mother </option>\
                                                    <option value="Father"> Bapa Kandung / Father </option>\
                                                    <option value="Adoptive Mother"> Ibu Angkat / Adoptive Mother </option>\
                                                    <option value="Adoptive Father"> Bapa Angkat / Adoptive Father </option>\
                                                    <option value="Brother"> Abang / Brother </option>\
                                                    <option value="Kakak"> Kakak / Sister </option>\
                                                    <option value="Uncle"> Ibu Saudara / Auntie </option>\
                                                    <option value="Uncle"> Bapa Saudara / Uncle </option>\
                                                    <option value="Cousin"> Sepupu / Cousin </option>\
                                                    <option value="Guardian"> Penjaga / Guardian </option>\
                                                </select>\
                                            </div>\
                                        </div>\
                                    </div>\
                                </div>\
                            </div>';

                $('#contentPanel').append(form);
                $('#studentForm').find(' > li:nth-last-child(1)').before(tab);

                levelSelect(currentNo);
                console.log('student', currentNo);
            } else {
                currentNo = $('#studentForm').find(' > li:nth-last-child(2)').attr('data-count');
                noti(500, 'Only ' + maxChild + ' children can be registered!');
            }

            $('#studentTab' + currentNo + '-tab').addClass('active');
            $('#studentTab' + currentNo).addClass('active');
            $('#studentTab' + currentNo).addClass('show');
        }

        function removeStudent(id) {

            $('#liStud' + id).remove();
            $('#studentTab' + id).remove();
            var count = $('input[name="stud_name[]"]').length;


            // this.enquiry_students.splice(index, 1);
            // if (this.enquiry_students.length == 0) {
            //   this.add();
            // }
            // this.currentTab = 0;

            var currentNo = 1;
            $('#studentForm li').each(function() {
                var currentID = this.id;
                var buttonID = $(this).find('button').attr('id')

                // if (buttonID != "addBtn") {

                //     $('#' + currentID).attr("data-count", currentNo);
                //     $('#' + currentID).attr("id", "liStud" + currentNo);

                //     $('#' + buttonID).attr("data-bs-target", "#studentTab" + currentNo);
                //     $('#' + buttonID).attr("aria-controls", "studentTab" + currentNo);
                //     $('#' + buttonID).attr("id", "studentTab" + currentNo + "-tab");
                //     $('#studentTab' + currentNo).attr("id", "studentTab" + currentNo);

                //     $('#studentSVG' + currentNo).attr("onclick", "removeStudent(" + currentNo + ")");

                //     // var testID = $('#' + buttonID).attr("id");
                //     // console.log('testID', buttonID)
                //     // console.log('buttonID', buttonID)
                //     // console.log('currentID', currentID);
                //     // currentNo++;
                //     // console.log('current No : ', currentNo);
                // }

            });

            if (count < 1) {
                dynamicStudentField();
            } else {
                $('.nav-link').removeClass('active');
                $('.tab-pane').removeClass('active');
                $('.tab-pane').removeClass('show');

                var currentNo = id - 1;

                $('#studentTab' + currentNo + '-tab').addClass('active');
                $('#studentTab' + currentNo).addClass('active');
                $('#studentTab' + currentNo).addClass('show');
            }
        }

        function changeTabName(tabid, text) {
            let textUpper = text.toUpperCase();

            // console.log(tabid + '_' + text);
            if (text != '') {
                $('#studentName' + tabid).html(textUpper);
                $('#stud_preferred_name' + tabid).val(textUpper);
            } else {
                $('#studentName' + tabid).html('Student #' + tabid);
            }
        }

        function ucfirstVal(value, id) {
            let textUpper = capitalize(value);
            $('#' + id).val(textUpper);
        }

        async function levelSelect(id) {
            const res = await callApi('post', "application/getSelectLevel");
            if (isSuccess(res)) {
                $('#level_id' + id).html(res.data);
            } else {
                noti(res.status); // show error message
            }
        }

        async function viewTnC() {
            const res = await callApi('post', "application/getTnC");
            if (isSuccess(res)) {
                if (res.data != null) {
                    loadFileContent('auth/_modalView.php', 'generalContent', null, 'Term & Condition', res.data, 'offcanvas');
                } else {
                    noti(500, 'No Term & Condition found'); // show error message
                }
            } else {
                noti(res.status); // show error message
            }
        }

        async function viewPrivacy() {
            const res = await callApi('post', "application/getPrivacy");
            if (isSuccess(res)) {
                if (res.data != null) {
                    loadFileContent('auth/_modalView.php', 'generalContent', null, 'Privacy Policy', res.data, 'offcanvas');
                } else {
                    noti(500, 'No Privacy Policy found'); // show error message
                }
            } else {
                noti(res.status); // show error message
            }
        }

        $("#applicationForm").submit(function(event) {
            event.preventDefault();
            cuteAlert({
                type: 'question',
                title: 'Are you sure?',
                message: 'Your application will be submitted',
                closeStyle: 'circle',
                cancelText: 'Cancel',
                confirmText: 'Yes, Confirm!',
            }).then(
                async (e) => {
                    if (e == 'confirm') {

                        $.blockUI({
                            message: '<div class="d-flex justify-content-center"><p class="mb-0">Please wait...</p> <div class="sk-wave m-0"><div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div></div> </div>',
                            // timeout: 1500,
                            css: {
                                backgroundColor: 'transparent',
                                color: '#fff',
                                border: '0'
                            },
                            overlayCSS: {
                                opacity: 0.35
                            }
                        });

                        disableBtn('homeBtn', true);
                        disableBtn('loginBtn', true);
                        const res = await submitApi('application/addNewApplication', $(this).serializeArray(), 'applicationForm', null, false);
                        disableBtn('homeBtn', false);
                        disableBtn('loginBtn', false);
                        document.getElementById("applicationForm").reset();
                        $.unblockUI();
                    }
                }
            );

        });
    </script>
</body>

</html>

@include('app.views.modals._modalGeneral')
@include('public.framework.php.general')