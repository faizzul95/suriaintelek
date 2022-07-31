@extends('app.templates.blade')

@section('content')

<h4 class="py-3 breadcrumb-wrapper mb-4">
    <span class="text-muted fw-light"> Attendance </span>
</h4>

<!-- List Table -->
<div class="row">

    <!-- table classroom -->
    <div class="col-xl-2 col-lg-2 col-md-12">
        <a id="scanner" href="javascript:void(0)" class="btn btn-secondary btn-sm float-end px-1">
            <i class="fa fa-plus"></i> Scan QR
        </a>
        <h5> List Levels </h5>
        <div id="dataListLevel" class="row"></div>
        <input type="hidden" id="levelStudent">
    </div>

    <!-- table student -->
    <div class="col-lg-10 col-md-12">
        <div id="nodatadiv"> {{ noSelectDataLeft('level') }} </div>
        <div id="showData" style="display: none">
            <div class="row mt-4">
                <div class="col-12">
                    <div id="dataListDiv" class="card-datatable table-responsive"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Row-->

<script type="text/javascript">
    $(document).ready(function() {
        getDataListLevel();
        $('#generaloffcanvas-right').on('hidden.bs.offcanvas', function(e) {
            stopScanner();
        });
    });

    async function getDataListLevel() {
        const res = await callApi('post', "level/getListLevelTeacherDiv");

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

        setTimeout(function() {
            getDataStudentList();
        }, 10);

    }

    async function getDataStudentList() {
        var level_id = $('#levelStudent').val();
        const res = await callApi('post', "attendance/getListAttendanceRecordBylevelID", {
            'level_id': level_id,
        });

        if (isSuccess(res)) {
            $('#dataListDiv').html(res.data);

            setTimeout(function() {
                focusInput();
            }, 200);

        } else {
            noti(res.status); // show error message
        }

    }

    $("#scanner").click(function() {
        var levelID = $('#levelStudent').val();
        if (levelID != '') {
            const scanner = null;
            const video = null;
            const videoContainer = null;
            const camHasCamera = null;
            var camList = null;
            const flashToggle = null;
            const flashState = null;
            const camQrResult = null;
            const camQrResultTimestamp = null;
            loadFileContent('attendance/_scanner.php', 'generalContent', null, 'QR Scanner', {
                'levelID': levelID,
            }, 'offcanvas');
        } else {
            noti(500, 'Please choose level student first!');
        }
    });

    async function recordData(matricNo = null, status = 1, studID = null) {
        const res = await callApi('post', "attendance/recordAttendance", {
            'stud_matric_no': matricNo,
            'stud_id': studID,
            'attendance_status': status,
        });

        if (isSuccess(res)) {
            noti(res.status, 'Attendance record');
            getDataStudentList();
        } else {
            noti(res.status); // show error message
        }
    }

    function focusInput() {
        $("#scannerInput").css("background", "#FFFECE");
        $("#scannerInput").focus();
        setTimeout(function() {
            focusInput();
        }, 8000);
    }

    async function saveAttendance() {

        var studNo = $('#scannerInput').val();

        if (studNo.length == 19) {

            $('#scannerInput').prop('disabled', true);
            const res = await callApi('post', "attendance/recordAttendance", {
                'stud_matric_no': studNo,
                'attendance_status': 1,
            });

            if (isSuccess(res)) {
                var resCode = parseInt(res.data.resCode);
                var message = (resCode == 500) ? res.data.message : 'Attendance record';
                noti(resCode, message);
                $('#scannerInput').prop('disabled', false);
                $('#scannerInput').val('');
                getDataStudentList();
            } else {
                noti(res.status); // show error message
            }
        }
    }
</script>

@endsection