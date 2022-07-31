@extends('app.templates.blade')

@section('content')

<h4 class="py-3 breadcrumb-wrapper mb-4">
    <span class="text-muted fw-light"> Student /</span> Graduate
</h4>

<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span>Enrolled</span>
                        <div class="d-flex align-items-end mt-2">
                            <h2 class="mb-0 me-2" id="enrollCount">0</h2>
                        </div>
                    </div>
                    <span class="badge bg-label-info rounded p-2">
                        <i class="fa fa-users" style="font-size: 4em;" aria-hidden="true"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span>Graduate</span>
                        <div class="d-flex align-items-end mt-2">
                            <h2 class="mb-0 me-2" id="graduateCount">0</h2>
                        </div>
                    </div>
                    <span class="badge bg-label-success rounded p-2">
                        <i class="fa fa-graduation-cap" style="font-size: 4em;" aria-hidden="true"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span>Withdrawal</span>
                        <div class="d-flex align-items-end mt-2">
                            <h2 class="mb-0 me-2" id="withdrawCount">0</h2>
                        </div>
                    </div>
                    <span class="badge bg-label-danger rounded p-2">
                        <i class="fas fa-user-minus" style="font-size: 4em;"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- List Table -->
<div class="card">
    <div class="card-header border-bottom">
        <h5 class="card-title">
            List Student Graduate
            <button type="button" class="btn btn-warning btn-sm float-end ms-2" onclick="getDataList()" title="Refresh">
                <i class="fa fa-refresh"></i>
            </button>
            <select id="academic_id" class="form-control form-control-sm float-end" onchange="getDataList()" style="width: 12%!important;">
                <option>- Select Academic -</option>
            </select>
        </h5>
    </div>
    <div id="nodatadiv" style="display: none;"> {{ nodata() }} </div>
    <div id="dataListDiv" class="card-datatable table-responsive" style="display: none;">
        <table id="dataList" class="table border-top" width="100%">
            <thead class="table-dark table border-top">
                <tr>
                    <th> Student Name </th>
                    <th> Matric No </th>
                    <th> Date </th>
                    <th width="2%"> Action </th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
<!--end::Row-->

<script type="text/javascript">
    $(document).ready(function() {
        academicSelect();
        countStudent();
        setTimeout(function() {
            getDataList();
        }, 120);
    });

    // server side datatable
    async function getDataList() {
        var academic = $('#academic_id').val();
        generateDatatable('dataList', 'serverside', 'student/getListGraduateDt', 'nodatadiv', {
            'academicID': academic
        });
    }

    async function viewStudent(id) {
        const res = await callApi('post', "student/getStudentByID", id);
        // check if request is success
        if (isSuccess(res)) {
            loadFileContent('student/_studentView.php', 'generalContent', 'fullscreen', 'Student Information', res.data);
        } else {
            noti(res.status); // show error message
        }
    }

    async function updateRecord(id) {
        const res = await callApi('post', "student/getStudentByID", id);
        // check if request is success
        if (isSuccess(res)) {
            formModal('update', res.data);
        } else {
            noti(res.status); // show error message
        }
    }

    function deleteRecord(id) {
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
                    const res = await deleteApi(id, 'student/delete', getDataList);
                }
            }
        );
    }

    async function academicSelect() {
        const res = await callApi('post', "academicyear/getSelectAcademic");
        $('#academic_id').html(res.data);
    }

    async function countStudent() {
        const res = await callApi('post', "student/countTotalStudent");
        // check if request is success
        if (isSuccess(res)) {
            const data = res.data;
            $('#enrollCount').html(data.enrol);
            $('#graduateCount').html(data.graduate);
            $('#withdrawCount').html(data.withdraw);
        } else {
            noti(res.status); // show error message
        }
    }

    function printCert(id) {
        loadFileContent('student/_cert.php', 'generalContent', 'xl', 'Certificate Preview', {
            'stud_id': id
        });
    }

    // function formModal(type = 'create', data = null) {
    //     const modalTitle = (type == 'create') ? 'Register Roles' : 'Update Roles';
    //     const urlForm = (type == 'create') ? 'roles/create' : 'roles/update';
    //     // loadFormContent(fileToLoad, modalBodyID, modalSize, urlForm, modalTitle, data, modalType);
    //     loadFormContent('student/_studentForm.php', 'generalContent', 'md', urlForm, modalTitle, data);
    // }
</script>

@endsection