@extends('app.templates.blade')

@section('content')

<style>
    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        color: white !important;
        background-color: #5a8dee !important;
    }
</style>

<!-- Page CSS -->
<link rel="stylesheet" href="{{ asset('vendor/css/pages/page-profile.css') }}" />

<!-- Header -->
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="user-profile-header-banner">
                <img src="{{ asset('img/pages/bgpersonal2.jpg') }}" alt="Banner image" class="rounded-top img-fluid">
                <a href="{{ (session()->get('roleID') == 5) ? url('profile/personal') : ((session()->get('roleID') == 4) ? url('student/wards') : url('student/enrol')) }}" class="btn btn-default p-2 border-all" style="position: absolute; top: 12px; left: -10px; z-index: 1;background-color:#FC3131;box-shadow:0 10px 20px -10px #FC3131;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left" style="color: white;">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    <span style="color: white;">Back to {{ (session()->get('roleID') == 5) ? 'profile' : 'list' }} </span>
                </a>
            </div>
            <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                    <div style="position: relative; display:inline-block;">
                        <img src="" id="student_avatar_view" alt="user image" class="d-block h-auto ms-0 ms-sm-4 rounded-3 user-profile-img">
                        <a href="javascript:void(0)" onclick="updateProfile('{{$studentID}}')" class="btn rounded-pill btn-icon btn-label-info" style="position: absolute; top: 5px; right: -15px;" title="Change profile">
                            <i class="fa fa-camera" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <div class="flex-grow-1 mt-3 mt-sm-5">
                    <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                        <div class="user-profile-info">
                            <h4 id="stud_name_view"></h4>
                            <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                <li class="list-inline-item fw-semibold">
                                    <i class="fa fa-id-card" aria-hidden="true"></i>
                                    <span id="stud_matric_no_view" style="color : #b3b3cc"></span>
                                </li>
                                <li class="list-inline-item fw-semibold">
                                    <i class="fa fa-registered" aria-hidden="true"></i>
                                    <span id="enroll_date_view" style="color : #b3b3cc"></span>
                                </li>
                                <li class="list-inline-item fw-semibold">
                                    <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                                    <span id="graduate_date_view" style="color : #b3b3cc"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ Header -->

<!-- detail here -->
<div class="row">

    <div class="col-xl-4 col-md-12 col-xs-12">

        <!-- student info -->
        <div class="card mb-2">
            <div class="card-body">

                @if (session()->get('roleID') != 5)
                <a href="javascript:void(0)" onclick="editInfo(1)" id="studEditInfo" class="btn rounded-pill btn-icon btn-label-info float-end" title="Edit Info">
                    <i class="fa fa-edit" aria-hidden="true"></i>
                </a>
                <a href="javascript:void(0)" onclick="editInfo(2)" id="studCloseInfo" class="btn rounded-pill btn-icon btn-label-danger float-end ms-1" title="Close" style="display: none;">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </a>
                <a href="javascript:void(0)" onclick="saveInfo('{{$studentID}}')" id="studSaveInfo" class="btn rounded-pill btn-icon btn-label-success float-end" title="Save Info" style="display: none;">
                    <i class="fa fa-save" aria-hidden="true"></i>
                </a>
                @endif

                <small class="text-muted text-uppercase">Student Information</small>
                <ul id="studInfoView" class="list-unstyled mb-4 mt-3">
                    <li class="d-flex align-items-center mb-3">
                        <i class="bx bx-user"></i>
                        <span class="fw-semibold mx-2"> Preferred Name:</span>
                        <span id="student_preferred_name_view">-</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="bx bx-check"></i>
                        <span class="fw-semibold mx-2">Status:</span>
                        <span id="application_status_view">-</span> <span id="withdraw_date_view">-</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                        <span class="fw-semibold mx-2">Birth Date:</span>
                        <span id="student_dob_view">-</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="fa fa-venus-mars"></i>
                        <span class="fw-semibold mx-2">Gender:</span>
                        <span id="student_gender_view">-</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="fa fa-flag" aria-hidden="true"></i>
                        <span class="fw-semibold mx-2">Race:</span>
                        <span id="student_race_view">-</span>
                    </li>
                </ul>

                <div id="studInfoForm" class="mb-4 mt-3" style="display: none;">

                    <div class="col-12 mb-2">
                        <span class="text-danger">* Indicates a required field</span>
                    </div>

                    <div class="col-12 mb-2">
                        <label style="color : #b3b3cc"> Full Name <span class="text-danger">*</span> </label>
                        <input type="text" id="stud_name_form" name="stud_name_form" class="form-control" maxlength="250" autocomplete="off" onKeyUP="this.value = this.value.toUpperCase();">
                    </div>

                    <div class="col-12 mb-2">
                        <label style="color : #b3b3cc"> Preferred Name <span class="text-danger">*</span> </label>
                        <input type="text" id="student_preferred_name_form" name="student_preferred_name_form" class="form-control maxlength-input" maxlength="20" autocomplete="off" onKeyUP="this.value = this.value.toUpperCase();">
                    </div>

                    <div class="row">
                        <div id="statusField" class="col-6 mb-2">
                            <label style="color : #b3b3cc">Status <span class="text-danger">*</span></label>
                            <select id="application_status_form" name="application_status_form" onchange="showDateField(this.value)" class="form-control">
                                <option value="6"> Enrolled </option>
                                <option value="7"> Graduate </option>
                                <option value="8"> Withdraw </option>
                            </select>
                        </div>
                        <div id="graduateField" class="col-6 mb-2" style="display: none;">
                            <label style="color : #b3b3cc"> Graduate Date <span class="text-danger">*</span></label>
                            <input type="date" id="graduate_date_form" name="graduate_date_form" class="form-control">
                        </div>
                        <div id="withdrawField" class="col-6 mb-2" style="display: none;">
                            <label style="color : #b3b3cc"> Withdraw Date <span class="text-danger">*</span></label>
                            <input type="date" id="withdraw_date_form" name="withdraw_date_form" class="form-control">
                        </div>
                    </div>

                    <div id="withdrawReasonField" class="col-12 mb-2">
                        <label style="color : #b3b3cc"> Reason Withdraw <span class="text-danger">*</span></label>
                        <input type="text" id="withdraw_reason_form" name="withdraw_reason_form" class="form-control" maxlength="100" autocomplete="off" onKeyUP="this.value = this.value.toUpperCase();">
                    </div>

                    <div class="row">

                        <div class="col-4 mb-2">
                            <label style="color : #b3b3cc"> Birth Date <span class="text-danger">*</span></label>
                            <input type="date" id="student_dob_form" name="student_dob_form" class="form-control">
                        </div>

                        <div class="col-4 mb-2">
                            <label style="color : #b3b3cc"> Gender <span class="text-danger">*</span></label>
                            <select id="student_gender_form" name="student_gender_form" class="form-control">
                                <option value="">- Select -</option>
                                <option value="Male"> Male </option>
                                <option value="Female"> Female </option>
                            </select>
                        </div>

                        <div class="col-4 mb-2">
                            <label style="color : #b3b3cc"> Race <span class="text-danger">*</span></label>
                            <select id="student_race_form" name="student_race_form" class="form-control">
                                <option value=""> - Select - </option>
                                <option value="Melayu"> Melayu </option>
                                <option value="Chinese"> Chinese </option>
                                <option value="Indian"> Indian </option>
                                <option value="Others"> Others </option>
                            </select>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="accordion accordion-header-info mb-5" id="accordionStyle1">

            <div class="accordion-item card active">
                <h2 class="accordion-header">
                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionStyle1-1" aria-expanded="true">
                        PARENT / GUARDIAN INFORMATION
                    </button>
                </h2>
                <div id="accordionStyle1-1" class="accordion-collapse collapse show" data-bs-parent="#accordionStyle1" style="">
                    <div class="accordion-body">
                        <ul class="list-unstyled mb-4 mt-3">
                            <li class="d-flex align-items-center mb-3">
                                <i class="fa fa-user"></i>
                                <span class="fw-semibold mx-2"> Name:</span>
                                <span id="user_fullname_view">-</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <span class="fw-semibold mx-2">Phone: </span>
                                <span id="user_contact_no_view">-</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <span class="fw-semibold mx-2">Email: </span>
                                <span id="user_email_view">-</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <span class="fw-semibold mx-2">Address: </span>
                                <span id="user_address_view">-</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <i class="fa fa-link" aria-hidden="true"></i>
                                <span class="fw-semibold mx-2">Relationship: </span>
                                <span id="user_relation_view">-</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <i class="fa fa-tasks" aria-hidden="true"></i>
                                <span class="fw-semibold mx-2">Occupation: </span>
                                <span id="user_job_view">-</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="accordion-item card">
                <h2 class="accordion-header">
                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionStyle1-2" aria-expanded="false">
                        SIBLINGS INFORMATION
                    </button>
                </h2>
                <div id="accordionStyle1-2" class="accordion-collapse collapse" data-bs-parent="#accordionStyle1">
                    <div class="accordion-body">
                        <div class="row" id="noSiblings"></div>
                        <div class="row" id="siblings" style="display: none;">
                            <div class="accordion mb-2 accordion-header-info" id="siblingsData"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card accordion-item">
                <h2 class="accordion-header">
                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionStyle1-3" aria-expanded="false">
                        QR Code
                    </button>
                </h2>
                <div id="accordionStyle1-3" class="accordion-collapse collapse" data-bs-parent="#accordionStyle1" style="">
                    <div class="accordion-body">
                        <div class="row col-12">
                            <center>
                                <img src="" id="student_qr_view" alt="qr student image" class="img-fluid" width="50%">
                            </center>
                        </div>
                        <div class="row col-12 mt-2 mb-2">
                            <center>
                                <button id="qrcodeBtn" class="btn btn-sm btn-info" onclick="saveQRImage('QR_CODE')" style="width: 40%;">
                                    <i class="fa fa-download"></i> Download
                                </button>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-8 col-md-12 col-xs-12">
        <div class="nav-align-top mb-4">
            <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-subject" aria-controls="navs-pills-justified-messages" aria-selected="false">
                        <i class="fa fa-book" aria-hidden="true"></i>
                        Syllabus
                    </button>
                </li>

                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-attendance" aria-controls="navs-pills-justified-profile" aria-selected="true">
                        <i class="fa fa-qrcode" aria-hidden="true"></i>
                        Attendance
                    </button>
                </li>

                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-report" aria-controls="navs-pills-justified-report" aria-selected="false">
                        <i class="fa fa-file-word-o" aria-hidden="true"></i>
                        Report
                    </button>
                </li>

                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-files" aria-controls="navs-pills-justified-files" aria-selected="false">
                        <i class="fa fa-files-o" aria-hidden="true"></i>
                        Files Cabinet
                    </button>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade active show" id="navs-pills-justified-subject" role="tabpanel">

                    <div class="row">
                        <div class="col-12">
                            <div id="nodataSubjectdiv"> {{ nodata() }} </div>
                            <div id="dataListSubjectDiv" class="card-datatable table-responsive" style="display: none;">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="tab-pane fade" id="navs-pills-justified-attendance" role="tabpanel">
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-dark" role="alert">
                                <strong> INDICATOR : </strong> &nbsp;&nbsp;
                                <i class="fa fa-check-circle fa-lg" style="color: #6EBF23;"></i> - Present &nbsp;&nbsp;&nbsp;
                                <i class="fa fa-exclamation-triangle fa-lg" style="color: #C6C343;"></i> - Absence &nbsp;&nbsp;&nbsp;
                                <i class="fa fa-times-circle fa-lg" style="color: #F23535;"></i> - No Record &nbsp;&nbsp;&nbsp;
                                <i class="fa fa-question-circle fa-lg" style="color: #868e96;"></i> - Others
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="button" class="btn btn-warning btn-sm float-end ms-2" title="Refresh">
                                <i class="fa fa-refresh"></i>
                            </button>
                            <select id="year_filter" class="form-control form-control-sm float-end ms-2" onchange="getListAtt('{{$studentID}}')" style="width: 12%!important;">
                            </select>

                            <select id="month_filter" class="form-control form-control-sm float-end" onchange="getListAtt('{{$studentID}}')" style="width: 12%!important;">
                                <option value="01"> 01 - January </option>
                                <option value="02"> 02 - Febuary </option>
                                <option value="03"> 03 - March </option>
                                <option value="04"> 04 - April </option>
                                <option value="05"> 05 - May </option>
                                <option value="06"> 06 - June </option>
                                <option value="07"> 07 - July </option>
                                <option value="08"> 08 - August </option>
                                <option value="09"> 09 - September </option>
                                <option value="10"> 10 - October </option>
                                <option value="11"> 11 - November </option>
                                <option value="12"> 12 - December </option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <div id="nodataAttendanceDiv"> {{ nodata() }} </div>
                            <div id="dataAttendanceDiv" style="display: none;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="navs-pills-justified-report" role="tabpanel">

                    <div class="row">
                        <div class="col-12">
                            <button type="button" class="btn btn-warning btn-sm float-end ms-2" title="Refresh" onclick="getDataListReport('{{$studentID}}')">
                                <i class="fa fa-refresh"></i>
                            </button>
                            <!-- <button type="button" class="btn btn-secondary btn-sm float-end">
                                <i class="fa fa-upload"></i> Upload Files
                            </button> -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div id="nodatadiv"> {{ nodata() }} </div>
                            <div id="dataListDiv" class="card-datatable table-responsive" style="display: none;">
                                <table id="dataList" class="table border-top" width="100%">
                                    <thead class="table-dark table border-top">
                                        <tr>
                                            <th> Report Card Date </th>
                                            <th> Verify Status </th>
                                            <th> Verifiy At </th>
                                            <th width="2%"> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="tab-pane fade" id="navs-pills-justified-files" role="tabpanel">

                    <div class="row">
                        <div class="col-12">
                            <button type="button" class="btn btn-warning btn-sm float-end ms-2" title="Refresh" onclick="getListFiles('{{$studentID}}')">
                                <i class="fa fa-refresh"></i>
                            </button>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <div id="nodatafilediv"> {{ nodata() }} </div>
                            <div id="showdatafile"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        getSelectAcademic();
        getStudentData('{{$studentID}}');
        setTimeout(function() {
            getListAtt('{{$studentID}}');
            getListSubject('{{$studentID}}');
            getDataListReport('{{$studentID}}');
            getListFiles('{{$studentID}}')
        }, 500);
    });

    async function getStudentData(id) {

        const res = await callApi('post', "student/getStudentByID", id);

        if (isSuccess(res)) {

            if (res.data != '') {

                const data = res.data;
                $("#student_avatar_view").attr("src", data.stud_image);
                $("#student_qr_view").attr("src", data.stud_qrcode);
                $('#stud_name_view').text(data.stud_name);
                $('#stud_name_form').val(data.stud_name);
                $('#stud_matric_no_view').text(data.stud_matric_no);
                $('#level_name_view').text(data.level_name);
                $('#class_name_view').text(data.class_name);
                $('#class_name_view').text(data.class_name);

                $('#enroll_date_view').text((data.enroll_date != '') ? moment(data.enroll_date).format("MMMM YYYY") : '-');
                $('#graduate_date_view').text((data.graduate_date != '') ? moment(data.graduate_date).format("MMMM YYYY") : '-');

                $('#student_preferred_name_view').text(data.stud_preferred_name);
                $('#student_preferred_name_form').val(data.stud_preferred_name);
                var status = data.application_status;
                var dateWithdraw = null;

                if (status == 6) {
                    status = '<span class="badge bg-label-info me-1">Enrolled</span>';
                } else if (status == 7) {
                    status = '<span class="badge bg-label-success me-1">Graduate</span>';
                } else if (status == 8) {
                    status = '<span class="badge bg-label-danger me-1">Withdraw</span>';
                    dateWithdraw = ' - ' + moment(data.withdraw_date).format("DD/MM/YYYY");
                }

                $('#application_status_view').html(status);
                $('#withdraw_date_view').html(dateWithdraw);

                $('#application_status_form').val(data.application_status);
                $('#graduate_date_form').val(data.graduate_date);
                $('#withdraw_date_form').val(data.withdraw_date);
                $('#withdraw_reason_form').val(data.withdraw_reason);
                showDateField(data.application_status);

                $('#student_dob_view').text(moment(data.stud_dob).format("DD/MM/YYYY"));
                $('#student_dob_form').val(data.stud_dob);

                $('#student_gender_view').text(data.stud_gender);
                $('#student_gender_form').val(data.stud_gender);
                $('#student_race_view').text(data.stud_race);
                $('#student_race_form').val(data.stud_race);

                getSiblings(data.user_id, data.stud_id);

                $('#user_fullname_view').text(data.user_fullname);
                $('#user_preferred_name_view').text(data.user_preferred_name);
                $('#user_contact_no_view').text(data.user_contact_no);
                $('#user_email_view').text(data.user_email);
                $('#user_address_view').html(data.user_address + ", " + data.user_postcode + " " + data.user_city + ", " + data.user_state);
                $('#user_relation_view').text(data.user_relation);
                $('#user_job_view').text(data.user_job);

            } else {
                window.location.href = "url('student/enrol')"; // redirect if no data to display
            }

        } else {
            noti(res.status)
        }
    }

    async function updateProfile(id, data = null) {
        data = {
            role_id: 6,
            stud_id: id,
        };
        loadFileContent('student/_uploadProfile.php', 'generalContent', null, 'Upload Profile', data, 'offcanvas');
    }

    async function getSiblings(user_id, stud_id) {

        const res = await callApi('post', "student/getStudentSibling", {
            user_id: user_id,
            stud_id: stud_id,
        });

        if (isSuccess(res)) {

            if (res.data.length > 0) {

                $('#noSiblings').empty();
                $('#siblingsData').empty(); // reset
                const data = res.data;
                for (i = 0; i < data.length; i++) {

                    var studDOB = moment(data[i].stud_dob).format("DD/MM/YYYY");
                    var studImage = data[i].stud_image;
                    var status = studStatus = data[i].application_status;

                    if (status == 6) {
                        studStatus = '<span class="badge bg-label-primary">Enroled</span>';
                    } else if (status == 7) {
                        studStatus = '<span class="badge bg-label-success">Graduated</span>';
                    } else if (status == 8) {
                        studStatus = '<span class="badge bg-label-danger">Withdraw</span>';
                    }

                    $('#siblingsData').append('<div class="card accordion-item">\
                                        <h2 class="accordion-header d-flex align-items-center">\
                                            <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#student-' + i + '" aria-expanded="true">\
                                                <i class="bx bx-user me-2"></i>\
                                                ' + data[i].stud_name + '\
                                            </button>\
                                        </h2>\
                                        <div id="student-' + i + '" class="accordion-collapse collapse">\
                                            <div class="accordion-body">\
                                                <div class="row">\
                                                    <div class="alert alert-primary" role="alert">\
                                                        <h6 class="alert-heading fw-bold mb-1"> Student Details </h6>\
                                                    </div>\
                                                </div>\
                                                <div class="row">\
                                                    <div class="col-lg-12">\
                                                        <div class="row">\
                                                            <label style="color : #b3b3cc"> Student Full Name</label><br>\
                                                            <span style="font-weight:bold"> ' + data[i].stud_name + ' </span>\
                                                        </div>\
                                                        <div class="row mt-2">\
                                                            <div class="col-lg-6">\
                                                                <label style="color : #b3b3cc"> Preferred Name</label><br>\
                                                                <span style="font-weight:bold"> ' + data[i].stud_preferred_name + ' </span>\
                                                            </div>\
                                                            <div class="col-lg-6">\
                                                                <label style="color : #b3b3cc">NRIC / Passport</label><br>\
                                                                <span style="font-weight:bold"> ' + data[i].stud_nric + ' </span>\
                                                            </div>\
                                                        </div>\
                                                        <div class="row mt-2">\
                                                            <div class="col-lg-4">\
                                                                <label style="color : #b3b3cc"> Gender </label><br>\
                                                                <span style="font-weight:bold"> ' + data[i].stud_gender + ' </span>\
                                                            </div>\
                                                            <div class="col-lg-4">\
                                                                <label style="color : #b3b3cc"> Race </label><br>\
                                                                <span style="font-weight:bold"> ' + data[i].stud_race + ' </span>\
                                                            </div>\
                                                            <div class="col-lg-4">\
                                                                <label style="color : #b3b3cc"> Birth Date </label><br>\
                                                                <span id="stud_dob" style="font-weight:bold"> ' + studDOB + ' </span>\
                                                            </div>\
                                                        </div>\
                                                    </div>\
                                                </div>\
                                                <div class="row mt-2">\
                                                    <div class="alert alert-primary" role="alert">\
                                                        <h6 class="alert-heading fw-bold mb-1"> Academic Information </h6>\
                                                    </div>\
                                                </div>\
                                                <div class="row mt-2">\
                                                    <div class="col-lg-6">\
                                                        <label style="color : #b3b3cc"> Matric No </label><br>\
                                                        <span style="font-weight:bold"> ' + data[i].stud_matric_no + ' </span>\
                                                    </div>\
                                                    <div class="col-lg-6">\
                                                        <label style="color : #b3b3cc">Status </label><br>\
                                                        <span style="font-weight:bold"> ' + studStatus + ' </span>\
                                                    </div>\
                                                    <div class="col-lg-6 mt-2">\
                                                        <label style="color : #b3b3cc">Class</label><br>\
                                                        <span style="font-weight:bold"> ' + data[i].class_name + ' </span>\
                                                    </div>\
                                                    <div class="col-lg-6 mt-2">\
                                                        <label style="color : #b3b3cc">Level </label><br>\
                                                        <span style="font-weight:bold"> ' + data[i].level_name + ' </span>\
                                                    </div>\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </div>');
                }

                $('#siblings').show();

            } else {
                $('#siblings').hide();
                $('#noSiblings').show();

                var nodataimg = "{{ asset('framework/img/nodata/5.png') }}";

                $('#noSiblings').html("<div id='nodata' class='col-lg-12 mb-2 mt-5'>\
                            <center>\
                                <img src='" + nodataimg + "' class='img-fluid mb-4' width='50%'>\
                                <h6 style='letter-spacing :2px; font-family: Quicksand, sans-serif !important;margin-bottom:25px'>\
                                <strong> NO INFORMATION FOUND </strong>\
                                </h6>\
                            </center>\
                            </div>");
            }

        }
    }

    async function getSelectAcademic() {
        const res = await callApi('post', "academicyear/getSelectAcademic");

        if (isSuccess(res)) {
            $('#year_filter').html(res.data);

            date = new Date();
            $('#month_filter option:eq(' + date.getMonth() + ')').prop('selected', true);
        }
    }

    async function getListAtt(id) {
        var month = $('#month_filter').val();
        var year = $('#year_filter').find(':selected').text();
        const res = await callApi('post', 'attendance/getAttendanceListByStudID', {
            'id': id,
            'month': month,
            'year': $.trim(year),
        });

        if (isSuccess(res)) {
            $('#dataAttendanceDiv').empty(); // reset

            $("#dataAttendanceDiv").html(res.data);
            $("#nodataAttendanceDiv").hide();
            $("#dataAttendanceDiv").show();
        }
    }

    // server side datatable
    async function getDataListReport(id) {
        generateDatatable('dataList', 'serverside', 'reportcard/getListReportByStudIdDt', 'nodatadiv', {
            'id': id
        });
    }

    async function getListSubject(id) {
        const res = await callApi('post', 'student/getListAccordionSubjectByStudID', id);

        if (isSuccess(res)) {
            $("#dataListSubjectDiv").html(res.data);
            $("#nodataSubjectdiv").hide();
            $("#dataListSubjectDiv").show();
        }
    }

    async function getListFiles(id) {
        const res = await callApi('post', 'student/getListAccordionFilesByStudID', id);

        if (isSuccess(res) && res.data != '') {
            $("#showdatafile").html(res.data);
            $("#nodatafilediv").hide();
        } else {
            $("#showdatafile").empty();
            $("#nodatafilediv").show();
        }
    }

    function saveCardImage(type, studID, fileName) {
        const generateBtnText = $('#generate' + type).html();
        loadingBtn('generate' + type, true, generateBtnText);

        var idCanvas = "matric" + type;

        html2canvas(document.querySelector("#" + idCanvas), {
            useCORS: true,
        }).then(function(canvas) {
            var fileContents = canvas.toDataURL("image/png");
            const saveContent = (fileContents, fileName) => {
                const link = document.createElement('a');
                link.download = fileName;
                link.href = fileContents;
                link.click();
            }
            var typeCard = type == 1 ? 'FRONT' : 'BACK';
            var fileNameSave = fileName + '_' + typeCard + '.png';
            saveContent(fileContents, fileNameSave);
            loadingBtn('generate' + type, false, generateBtnText);
        });
    }

    function saveQRImage(fileName) {
        const generateBtnText = $('#qrcodeBtn').html();
        loadingBtn('qrcodeBtn', true, generateBtnText);
        html2canvas(document.querySelector("#student_qr_view"), {
            useCORS: true,
        }).then(function(canvas) {
            var fileContents = canvas.toDataURL("image/png");
            const saveContent = (fileContents, fileName) => {
                const link = document.createElement('a');
                link.download = fileName;
                link.href = fileContents;
                link.click();
            }
            saveContent(fileContents, fileName + '.png');
            loadingBtn('qrcodeBtn', false, generateBtnText);
        });
    }

    async function viewReport(id) {
        const res = await callApi('post', "reportcard/getReportByID", id);
        loadFileContent('reportcard/_parentView.php', 'generalContent', 'fullscreen', 'Assessment View', res.data);
    }

    function editInfo(type) {
        if (type == 1) {
            $('#studSaveInfo').show();
            $('#studCloseInfo').show();
            $('#studEditInfo').hide();
            $('#studInfoForm').show();
            $('#studInfoView').hide();
        } else {
            $('#studEditInfo').show();
            $('#studSaveInfo').hide();
            $('#studCloseInfo').hide();
            $('#studInfoView').show();
            $('#studInfoForm').hide();
        }
    }

    async function saveInfo(id) {

        var applicationStatus = $('#application_status_form').val();
        var graduateDate = (applicationStatus == 7) ? $('#graduate_date_form').val() : '';
        var withdrawReason = (applicationStatus == 8) ? $('#withdraw_reason_form').val() : '';
        var withdrawDate = (applicationStatus == 8) ? $('#withdraw_date_form').val() : '';

        const res = await callApi('post', 'student/update', {
            'stud_id': id,
            'stud_name': $('#stud_name_form').val(),
            'stud_preferred_name': $('#student_preferred_name_form').val(),
            'application_status': applicationStatus,
            'graduate_date': graduateDate,
            'withdraw_date': withdrawDate,
            'withdraw_reason': withdrawReason,
            'stud_dob': $('#student_dob_form').val(),
            'stud_gender': $('#student_gender_form').val(),
            'stud_race': $('#student_race_form').val(),
        });

        if (isSuccess(res)) {
            var data = res.data.data;

            $('#stud_name_view').text(data.stud_name);
            $('#stud_name_form').val(data.stud_name);
            $('#student_preferred_name_view').text(data.stud_preferred_name);
            $('#student_preferred_name_form').val(data.stud_preferred_name);

            $('#graduate_date_form').val(graduateDate);
            $('#withdraw_date_form').val(withdrawDate);
            $('#withdraw_reason_form').val(withdrawReason);

            $('#graduate_date_view').text((graduateDate != '') ? moment(graduateDate).format("MMMM YYYY") : '-');

            var status = data.application_status;
            var dateWithdraw = null;

            if (status == 6) {
                status = '<span class="badge bg-label-info me-1">Enrolled</span>';
            } else if (status == 7) {
                status = '<span class="badge bg-label-success me-1">Graduate</span>';
            } else if (status == 8) {
                status = '<span class="badge bg-label-danger me-1">Withdraw</span>';
                dateWithdraw = ' - ' + moment(data.withdraw_date).format("DD/MM/YYYY");
            }

            $('#application_status_view').html(status);
            $('#withdraw_date_view').html(dateWithdraw);

            $('#application_status_form').val(data.application_status);
            $('#student_dob_view').text(moment(data.stud_dob).format("DD/MM/YYYY"));
            $('#student_dob_form').val(data.stud_dob);

            $('#student_gender_view').text(data.stud_gender);
            $('#student_gender_form').val(data.stud_gender);
            $('#student_race_view').text(data.stud_race);
            $('#student_race_form').val(data.stud_race);

            noti(res.status, 'Updated');
            editInfo(2);
        } else {
            noti(res.status);
        }
    }

    function showDateField(type) {

        $('#graduateField').hide();
        $('#withdrawField').hide();
        $('#withdrawReasonField').hide();

        if (type == 6) {
            $('#statusField').removeClass('col-6').addClass('col-12');
        } else {
            $('#statusField').removeClass('col-12').addClass('col-6');

            if (type == 7) {
                $('#graduateField').show();
            } else {
                $('#withdrawField').show();
                $('#withdrawReasonField').show();
            }
        }
    }
</script>

@endsection