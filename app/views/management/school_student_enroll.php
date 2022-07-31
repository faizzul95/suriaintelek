@extends('app.templates.blade')

@section('content')

<style>
    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        color: white;
        background-color: #5a8dee;
    }
</style>

<h4 class="py-3 breadcrumb-wrapper mb-4">
    <span class="text-muted fw-light"> Management /</span> Enrollment
</h4>

<!-- List Table -->
<div class="row">

    <!-- table classroom -->
    <div class="col-xl-2 col-lg-2 col-md-12 fill border-right psbar" style="overflow:auto;max-height:80vh!important;position:relative!important">
        <h5> List Levels </h5>
        <div id="dataListLevel" class="row"></div>

        <input type="hidden" id="levelStudent">
    </div>

    <div class="col-lg-10 col-md-12 fill border-right psbar" style="overflow:auto;max-height:80vh!important;position:relative!important">
        <div id="nodatadiv"> {{ noSelectDataLeft('level') }} </div>
        <div id="showData" style="display: none">
            <div class="row g-4">
                <div class="col-xl-7 col-lg-7 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                List student for academic {{ session()->get('academicName') }}
                                <button type="button" class="btn btn-warning btn-sm float-end ms-2" onclick="getDataStudentList()" title="Refresh">
                                    <i class="fa fa-refresh"></i>
                                </button>
                                <!-- <button type="button" class="btn btn-secondary btn-sm float-end" onclick="formRolloverModal()">
                                    <i class="fa fa-clone"></i> Rollover
                                </button> -->
                            </h5>
                            <div id="dataListStud"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-5 col-md-12">
                    <div class="row g-4">
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        List Subject
                                        <button type="button" class="btn btn-warning btn-sm float-end ms-2" onclick="getDataSubjectList()" title="Refresh">
                                            <i class="fa fa-refresh"></i>
                                        </button>
                                        <button type="button" class="btn btn-secondary btn-sm float-end" onclick="formAssignModal()">
                                            <i class="fa fa-plus"></i> Assign Subject
                                        </button>
                                    </h5>
                                    <div id="dataListSubject"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        List Teacher
                                        <button type="button" class="btn btn-warning btn-sm float-end ms-2" onclick="getDataTeacherList()" title="Refresh">
                                            <i class="fa fa-refresh"></i>
                                        </button>
                                    </h5>
                                    <div id="dataListTeacher"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Row-->

<script type="text/javascript">
    $(document).ready(function() {
        getDataListLevel();
        // getDataListClassroom();
    });

    async function getDataListLevel() {
        const res = await callApi('post', "level/getListLevelDiv");

        // check if request is success
        if (isSuccess(res)) {
            $('#dataListLevel').append(res.data);
        } else {
            noti(res.status); // show error message
        }
    }

    async function getData(id) {
        $('#showData').show();
        $('#nodatadiv').hide();

        $('.cardColor').removeClass("bg-primary text-white");
        $('#card-' + id).addClass("bg-primary text-white");

        $('.textColor').removeClass("text-white");
        $('#text-' + id).addClass("text-white");

        $('#levelStudent').val(id);

        getDataTeacherList();
        getDataStudentList();
        getDataSubjectList();
    }

    async function getDataSubjectList() {
        $('#dataListSubject').empty();
        var level_id = $('#levelStudent').val();
        const res = await callApi('post', "subject/getListSubjectAssign", {
            'level_id': level_id,
        });

        if (isSuccess(res)) {
            $('#dataListSubject').html(res.data);
        } else {
            noti(res.status); // show error message
        }
    }

    async function getDataTeacherList() {
        $('#dataListTeacher').empty();
        var level_id = $('#levelStudent').val();
        const res = await callApi('post', "teacher/getListTeacherAssign", {
            'level_id': level_id,
        });

        if (isSuccess(res)) {
            $('#dataListTeacher').html(res.data);
        } else {
            noti(res.status); // show error message
        }
    }

    async function getDataStudentList() {
        $('#dataListStud').empty();

        var level_id = $('#levelStudent').val();
        const res = await callApi('post', "student/getListCurrentEnrollStudentBylevelID", {
            'level_id': level_id,
        });

        if (isSuccess(res)) {
            $('#dataListStud').html(res.data);
        } else {
            noti(res.status); // show error message
        }

    }

    function formAssignModal(type = 'create', data = null) {
        var level_id = $('#levelStudent').val();
        loadFormContent('management/_assignForm.php', 'generalContent', 'md', 'subject/assignSave', 'Assign Subject', {
            'level_id': level_id
        });
    }

    function formRolloverModal(type = 'create', data = null) {
        noti(500, 'Only for extend module!')
    }

    async function removeAssign(assignID) {
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
                    const res = await deleteApi(assignID, 'subject/assignDelete', getDataTeacherList);
                    getDataSubjectList();
                }
            }
        );
    }
</script>

@endsection