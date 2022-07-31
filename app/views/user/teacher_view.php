@extends('app.templates.blade')

@section('content')

<style>
    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        color: white;
        background-color: #5a8dee;
    }
</style>

<!-- Page CSS -->
<link rel="stylesheet" href="{{ asset('vendor/css/pages/page-profile.css') }}" />

<!-- Header -->
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="user-profile-header-banner">
                <img src="{{ asset('img/pages/profile-banner.png') }}" alt="Banner image" class="rounded-top img-fluid">
                <a href="{{ url('teacher/list') }}" class="btn btn-default p-2 border-all" style="position: absolute; top: 12px; left: -10px; z-index: 1;background-color:#FC3131;box-shadow:0 10px 20px -10px #FC3131;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left" style="color: white;">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    <span style="color: white;">Back to list</span>
                </a>
            </div>
            <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                    <div style="position: relative; display:inline-block;">
                        <img src="" id="user_avatar_view" alt="user image" class="d-block h-auto ms-0 ms-sm-4 rounded-3 user-profile-img">
                        <a href="javascript:void(0)" onclick="updateProfile('{{$userID}}')" class="btn rounded-pill btn-icon btn-label-info" style="position: absolute; top: 5px; right: -15px;" title="Change profile">
                            <i class="fa fa-camera" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <div class="flex-grow-1 mt-3 mt-sm-5">
                    <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                        <div class="user-profile-info">
                            <h4 id="user_fullname"></h4>
                            <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                <li class="list-inline-item fw-semibold">
                                    <i class="fa fa-id-card" aria-hidden="true"></i>
                                    <span id="user_nric" style="color : #b3b3cc"></span>
                                </li>
                                <li class="list-inline-item fw-semibold">
                                    <i class="bx bx-envelope"></i>
                                    <span id="user_email" style="color : #b3b3cc"></span>
                                </li>
                                <li class="list-inline-item fw-semibold">
                                    <i class="bx bx-phone"></i>
                                    <span id="user_contact_no" style="color : #b3b3cc"></span>
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
        <div class="card mb-4">
            <div class="card-body">
                <small class="text-muted text-uppercase">About</small>
                <ul class="list-unstyled mb-4 mt-3">
                    <li class="d-flex align-items-center mb-3">
                        <i class="bx bx-user"></i>
                        <span class="fw-semibold mx-2"> Preferred Name:</span>
                        <span id="user_preferred_name_view">-</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="bx bx-check"></i>
                        <span class="fw-semibold mx-2">Status:</span>
                        <span id="user_status_view">-</span>
                    </li>
                    <li class="d-flex align-items-center mb-3"><i class="bx bx-star"></i>
                        <span class="fw-semibold mx-2">Role:</span>
                        <span id="role_name_view">-</span>
                    </li>
                    <li class="d-flex align-items-center mb-3"><i class="bx bx-flag"></i>
                        <span class="fw-semibold mx-2">State:</span>
                        <span id="user_state_view">-</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-xl-8 col-md-12 col-xs-12">
        <div class="nav-align-top mb-4">
            <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-education" aria-controls="navs-pills-justified-profile" aria-selected="true">
                        <i class="fa fa-university" aria-hidden="true"></i>
                        Education / Qualifications
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-training" aria-controls="navs-pills-justified-messages" aria-selected="false">
                        <i class="fa fa-sticky-note-o" aria-hidden="true"></i>
                        Training
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-files" aria-controls="navs-pills-justified-messages" aria-selected="false">
                        <i class="fa fa-files-o" aria-hidden="true"></i>
                        Files Cabinet
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-account" aria-controls="navs-pills-justified-messages" aria-selected="false">
                        <i class="fa fa-gear fa-spin"></i>
                        Account Settings
                    </button>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade active show" id="navs-pills-justified-education" role="tabpanel">
                    <div class="row">
                        <div class="col-12">
                            <button type="button" class="btn btn-warning btn-sm float-end ms-2" title="Refresh" onclick="getListEdu('{{$userID}}')">
                                <i class="fa fa-refresh"></i>
                            </button>
                            @if(session()->get('roleID') != 4)
                            <button type="button" onclick="addEdu()" class="btn btn-secondary btn-sm float-end">
                                <i class="fa fa-plus"></i> Add Education
                            </button>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div id="nodatadivEducation"> {{ nodata() }} </div>
                            <div id="dataListEducationDiv" class="card-datatable table-responsive" style="display: none;">
                                <table id="dataListEducation" class="table border-top" width="100%">
                                    <thead class="table-dark table border-top">
                                        <tr>
                                            <th> Institution Name </th>
                                            <th> Education Level </th>
                                            <th> Qualification </th>
                                            <th> Study Dates </th>
                                            <th width="2%"> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-pills-justified-training" role="tabpanel">

                    <div class="row">
                        <div class="col-12">
                            <button type="button" class="btn btn-warning btn-sm float-end ms-2" title="Refresh" onclick="getListTrain('{{$userID}}')">
                                <i class="fa fa-refresh"></i>
                            </button>
                            @if(session()->get('roleID') != 4)
                            <button type="button" onclick="addTrain()" class="btn btn-secondary btn-sm float-end">
                                <i class="fa fa-plus"></i> Add Training
                            </button>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div id="nodatadivTraining"> {{ nodata() }} </div>
                            <div id="dataListTrainingDiv" class="card-datatable table-responsive" style="display: none;">
                                <table id="dataListTraining" class="table border-top" width="100%">
                                    <thead class="table-dark table border-top">
                                        <tr>
                                            <th> Training Course </th>
                                            <th> Course Details </th>
                                            <th> Training Dates </th>
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
                            <button type="button" class="btn btn-warning btn-sm float-end ms-2" title="Refresh" onclick="getListFiles('{{$userID}}')">
                                <i class="fa fa-refresh"></i>
                            </button>
                            <!-- <button type="button" class="btn btn-secondary btn-sm float-end">
                                <i class="fa fa-upload"></i> Upload Files
                            </button> -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div id="nodataFilesdiv"> {{ nodata() }} </div>
                            <div id="dataListFilesDiv" style="display: none;"></div>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="navs-pills-justified-account" role="tabpanel">
                    <h5 class="card-header">Change Password</h5>
                    <form id="formAccountSettings" method="POST" action="user/save" class="fv-plugins-bootstrap5 fv-plugins-framework">
                        <div class="row">
                            <div class="mb-3 col-md-6 form-password-toggle fv-plugins-icon-container">
                                <label class="form-label" for="newPassword">New Password</label>
                                <div class="input-group input-group-merge has-validation">
                                    <input class="form-control" type="password" id="newPassword" name="user_password" placeholder="············">
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>

                            <div class="mb-3 col-md-6 form-password-toggle fv-plugins-icon-container">
                                <label class="form-label" for="confirmPassword">Confirm New Password</label>
                                <div class="input-group input-group-merge has-validation">
                                    <input class="form-control" type="password" name="confirmPassword" id="confirmPassword" placeholder="············">
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <div class="col-12 mb-4">
                                <p class="fw-semibold mt-2">Password Requirements:</p>
                                <ul class="ps-3 mb-0">
                                    <li class="mb-1">
                                        Minimum 8 characters long - the more, the better
                                    </li>
                                    <li class="mb-1">At least one lowercase character</li>
                                    <li>At least one number, symbol, or whitespace character</li>
                                </ul>
                            </div>
                            <div class="col-12 mt-1">
                                <input type="hidden" name="user_id" id="user_id" value="{{ $userID }}">
                                <button type="submit" id="submitBtn" class="btn btn-info"> <i class='fa fa-save'></i> Save changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        getUserData('{{$userID}}');
        setTimeout(function() {
            getListEdu('{{$userID}}');
            getListTrain('{{$userID}}');
            getListFiles('{{$userID}}');
        }, 500);
    });

    async function getUserData(id) {

        const res = await callApi('post', "teacher/getTeacherByID", id);

        $('#user_nric').text(res.data.user_nric);
        $('#user_fullname').text(res.data.user_fullname);
        $('#user_email').text(res.data.user_email);
        $('#user_contact_no').text(res.data.user_contact_no);
        $("#user_avatar_view").attr("src", "{{ asset('/') }}" + res.data.user_avatar);

        $('#user_preferred_name_view').text(res.data.user_preferred_name);
        $('#user_job').text(res.data.user_job);
        $('#user_city').text(res.data.user_city);
        $('#user_status_view').text((res.data.user_status == '1') ? 'Active' : 'Inactive');
        // $('#role_name_view').text(res.data.role_id);
        $('#role_name_view').text('Teacher');
        $('#user_state_view').text(res.data.user_state);

        var myDate = new Date(res.data.created_at);
        $('#created_at').text("Joined " + moment(myDate).format("MMMM YYYY"));

    }

    async function updateProfile(id, data = null) {
        var current_userid = "{{ session()->get('userID') }}";
        data = {
            role_id: 4,
            user_id: id,
            current_userid: "{{ session()->get('userID') }}"
        };
        // loadFormContent('application/application_form.php', null, null, 'application/addNewApplication', 'New Application', data, 'offcanvas');
        loadFileContent('user/_upload.php', 'generalContent', null, 'Upload Profile', data, 'offcanvas');
    }

    $("#formAccountSettings").submit(function(event) {
        event.preventDefault();

        const form = $(this);
        const url = form.attr('action');
        var errorMessage = "";

        if (errorMessage = validatePassword()) {
            return noti(500, errorMessage);
        }

        cuteAlert({
            type: 'question',
            title: 'Are you sure?',
            message: 'Password will be change!',
            closeStyle: 'circle',
            cancelText: 'Abort',
            confirmText: 'Yes, Confirm!',
        }).then(
            async (e) => {
                if (e == 'confirm') {
                    const res = await submitApi(url, form.serializeArray(), 'formAccountSettings');
                    if (res.status == 200) {
                        setTimeout(function() {
                            $('#formAccountSettings').each(function() {
                                this.reset();
                            });
                        }, 200);
                    }
                }
            }
        );
    });

    function validatePassword() {

        var newPass = $('#newPassword').val();
        var confirmPass = $('#confirmPassword').val();

        if (newPass != confirmPass)
            return 'Your passwords does not match.';
        if (newPass.length < 8)
            return 'Your password must be at least 8 characters.';
        if (newPass.search(/[a-z]/) < 0)
            return "Your password must contain at least one lowercase letter.";
        if (newPass.search(/[0-9]/) < 0 && newPass.search(/[!@#$%^&* ]/) < 0)
            return "Your password must contain at least one digit, symbol, or whitespace.";
    }

    function addEdu(type = 'create', data = null) {
        const modalTitle = (type == 'create') ? 'Add Education / Training' : 'Update Education / Training';
        const urlForm = (type == 'create') ? 'teacher/saveEdu' : 'teacher/saveEdu';
        if (data == null) {
            data = {
                'user_id': '{{$userID}}',
            };
        }

        loadFormContent('user/_educationForm.php', 'generalContent', 'xl', urlForm, modalTitle, data);
    }

    function addTrain(type = 'create', data = null) {
        const modalTitle = (type == 'create') ? 'Add Education / Training' : 'Update Education / Training';
        const urlForm = (type == 'create') ? 'teacher/saveTrain' : 'teacher/saveTrain';

        if (data == null) {
            data = {
                'user_id': '{{$userID}}',
            };
        }

        loadFormContent('user/_trainingForm.php', 'generalContent', 'xl', urlForm, modalTitle, data);
    }

    // server side datatable
    async function getListEdu(id) {
        generateDatatable('dataListEducation', 'serverside', 'teacher/getListEducationByUserIdDt', 'nodatadivEducation', {
            'id': id
        });
    }

    async function updateRecord(id, type) {
        console.log(type);
        const url = (type == 'education') ? "teacher/getEduByID" : "teacher/getTrainByID";
        const res = await callApi('post', url, id);

        if (isSuccess(res)) {
            (type == 'education') ? addEdu('update', res.data): addTrain('update', res.data)
        } else {
            noti(res.status);
        }
    }

    function deleteRecord(id, type) {
        const url = (type == 'education') ? 'teacher/deleteEdu' : 'teacher/deleteTrain';
        cuteAlert({
            type: 'question',
            title: 'Are you sure?',
            message: 'Records will be permanently deleted !',
            closeStyle: 'circle',
            cancelText: 'Abort',
            confirmText: 'Yes, Confirm!',
        }).then(
            async (e) => {
                if (e == 'confirm') {
                    const res = await deleteApi(id, url, getDataList);
                }
            }
        );
    }

    // server side datatable
    async function getListTrain(id) {
        generateDatatable('dataListTraining', 'serverside', 'teacher/getListTrainingByUserIdDt', 'nodatadivTraining', {
            'id': id
        });
    }

    async function getListFiles(id) {
        const res = await callApi('post', "teacher/getFiles", id);

        if (isSuccess(res)) {
            $('#dataListFilesDiv').empty(); // reset

            $("#dataListFilesDiv").html(res.data);
            $("#nodataFilesdiv").hide();
            $("#dataListFilesDiv").show();
        } else {
            noti(res.status);
        }
    }
</script>

@endsection