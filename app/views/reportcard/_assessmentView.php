<!-- application details -->
<div class="row">

    <div class="col-lg-3 col-xs-12 col-md-12 p-4 fill border-right psbar" style="overflow:auto;max-height:82vh!important;position:relative!important">

        <!-- student Details -->
        <div class="row">

            <div class="col-lg-12">
                <center>
                    <img src="" id="student_avatar_view" alt="student image" class="img-fluid" style="width: 60%;">
                </center>
            </div>

            <div class="col-lg-12 mt-4">
                <div class="alert alert-primary" role="alert">
                    <h6 class="alert-heading fw-bold mb-1">Student Info</h6>
                </div>
            </div>

            <div class="col-lg-12">
                <label style="color : #b3b3cc"> Student Full Name</label><br>
                <span id="stud_name_view" style="font-weight:bold"></span>
            </div>

            <div class="row mt-2">
                <div class="col-lg-4">
                    <label style="color : #b3b3cc"> Preferred Name</label><br>
                    <span id="stud_preferred_name_view" style="font-weight:bold"></span>
                </div>
                <div class="col-lg-8">
                    <label style="color : #b3b3cc">NRIC / Passport</label><br>
                    <span id="stud_nric_view" style="font-weight:bold"></span>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-lg-4">
                    <label style="color : #b3b3cc"> Race </label><br>
                    <span id="stud_race_view" style="font-weight:bold"></span>
                </div>
                <div class="col-lg-4">
                    <label style="color : #b3b3cc"> Birth Date </label><br>
                    <span id="stud_dob_view" style="font-weight:bold"></span>
                </div>
                <div class="col-lg-4">
                    <label style="color : #b3b3cc"> Gender </label><br>
                    <span id="stud_gender_view" style="font-weight:bold"></span>
                </div>
            </div>
        </div>

        <!-- Academic details -->
        <div class="row mt-2">
            <div class="col-lg-12">
                <div class="alert alert-primary" role="alert">
                    <h6 class="alert-heading fw-bold mb-1">Academic Info</h6>
                </div>
            </div>
            <div class="col-lg-4">
                <label style="color : #b3b3cc">Academic Year</label><br>
                <span id="academic_name_view" style="font-weight:bold"></span>
            </div>
            <div class="col-lg-4">
                <label style="color : #b3b3cc"> Level </label><br>
                <span id="level_name_view" style="font-weight:bold"></span>
            </div>
            <div class="col-lg-4">
                <label style="color : #b3b3cc">Class</label><br>
                <span id="class_name_view" style="font-weight:bold"></span>
            </div>
        </div>

    </div>

    <div class="col-lg-3 col-xs-12 col-md-12 p-4 fill border-right psbar" style="overflow:auto;max-height:80vh!important;position:relative!important">

        <!-- Assessment Details -->
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-primary" role="alert">
                    <h6 class="alert-heading fw-bold mb-1">Assessment Info</h6>
                </div>
            </div>
            <div class="col-lg-6">
                <label style="color : #b3b3cc"> Year </label><br>
                <span id="report_year_view" style="font-weight:bold"></span>
            </div>
            <div class="col-lg-6">
                <label style="color : #b3b3cc"> Month </label><br>
                <span id="report_month_view" style="font-weight:bold"></span>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-lg-6">
                <label style="color : #b3b3cc"> Date </label><br>
                <span id="report_date_view" style="font-weight:bold"></span>
            </div>
            <div class="col-lg-6">
                <label style="color : #b3b3cc"> Status </label><br>
                <span id="report_status_view" style="font-weight:bold"></span>
            </div>
        </div>

        <!-- Subject Details -->
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="alert alert-primary" role="alert">
                    <h6 class="alert-heading fw-bold mb-1">Subject List</h6>
                </div>
                <div id="dataListSubject" class="row"></div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-xs-12 col-md-12 p-4 fill border-right psbar" style="overflow:auto;max-height:80vh!important;position:relative!important">

        <!-- Assessment form -->
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-primary" role="alert">
                    <h6 class="alert-heading fw-bold mb-1">Assessment Form</h6>
                </div>

                <form id="formAssessement" action="reportcard/assessmentSave" method="POST">
                    <div id="nodataSubjectDiv"></div>
                    <input type="hidden" id="stud_id_form" name="report_id" placeholder="stud_id">
                    <input type="hidden" id="report_id_form" name="report_id" placeholder="report_id">
                    <input type="hidden" id="subject_id_form" name="subject_id" placeholder="subject_id">
                    <input type="hidden" id="level_id_form" name="level_id" placeholder="level_id">
                </form>
            </div>
        </div>
    </div>

</div>


<script>
    // get data array from general function
    function getPassData(baseUrl, token, data) {

        $('#report_date_view').text(moment(data.report_date).format("dddd, DD/MM/YYYY"));
        $('#report_month_view').text(toMonthName(data.report_month));
        $('#report_year_view').text(data.report_year);
        $('#report_id_form').val(data.report_id);
        $('#stud_id_form').val(data.stud_id);
        $('#level_id_form').val(data.level_id);

        var status;
        if (data.report_status == 0) {
            status = '<span class="badge bg-label-danger"> DRAFT </span>';
        } else {
            status = '<span class="badge bg-label-success"> POSTED </span>';
        }

        $('#report_status_view').html(status);

        getStudentInfo(baseUrl, data.stud_id);
        getDataListSubject(data.level_id);
        getAssessmentForm();
    }

    async function getDataListSubject(level_id) {

        const res = await callApi('post', "subject/getListStudSubjectAssessmentDiv", {
            'level_id': level_id,
            'subject_id': $('#subject_id_form').val(),
            'report_id': $('#report_id_form').val(),
            'stud_id': $('#stud_id_form').val(),
        });

        // check if request is success
        if (isSuccess(res)) {
            $('#dataListSubject').html(res.data);
        } else {
            noti(res.status); // show error message
        }
    }

    async function getStudentInfo(baseUrl, id) {
        const res = await callApi('post', "student/getStudentByID", id);
        if (isSuccess(res)) {
            const data = res.data;
            $("#student_avatar_view").attr("src", baseUrl + '/' + data.stud_image);

            $('#stud_name_view').text(data.stud_name);
            $('#stud_preferred_name_view').text(data.stud_preferred_name);
            $('#stud_nric_view').text(data.stud_nric);
            $('#stud_gender_view').text(data.stud_gender);
            $('#stud_race_view').text(data.stud_race);
            $('#stud_dob_view').text(moment(data.stud_dob).format("DD/MM/YYYY"));
            $('#user_relation_view').text(data.user_relation);

            $('#academic_name_view').text(data.academic_name);
            $('#class_name_view').text(data.class_name);
            $('#level_name_view').text(data.level_name);
        }
    }

    async function getAssessmentForm(id = '') {

        $('#subject_id_form').val(id);

        if (id != '') {
            $.blockUI({
                message: '<div class="d-flex justify-content-center"><p class="mb-0">Please wait...</p></div>',
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
        }

        const res = await callApi('post', "reportcard/getAssessmentFormBySubjectReportID", {
            'subject_id': id,
            'report_id': $('#report_id_form').val(),
            'stud_id': $('#stud_id_form').val(),
            'level_id': $('#level_id_form').val()
        });

        $('#nodataSubjectDiv').html(res.data);
        getDataListSubject($('#levelStudent').val());
        $.unblockUI();
        highlightSubjectDiv(id);
    }

    async function reloadAssessmentForm() {

        $('#reloadFormBtn').hide();

        $.blockUI({
            message: '<div class="d-flex justify-content-center"><p class="mb-0">Please wait...</p></div>',
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

        const res = await callApi('post', "reportcard/getAssessmentItemFormByIds", {
            'subject_id': $('#subject_id_form').val(),
            'report_id': $('#report_id_form').val(),
            'stud_id': $('#stud_id_form').val(),
            'level_id': $('#level_id_form').val()
        });

        $('#nodataSubjectDiv').html(res.data);
        $.unblockUI();
        highlightSubjectDiv($('#subject_id_form').val());
    }

    function highlightSubjectDiv(subjectID) {
        setTimeout(function() {
            $('.cardSubjectColor').removeClass("bg-primary text-white");
            $('#cardSubject-' + subjectID).addClass("bg-primary text-white");

            $('.textSubjectColor').removeClass("text-white");
            $('#textSubject-' + subjectID).addClass("text-white");
        }, 280);
    }

    $("#formAssessement").submit(function(event) {
        event.preventDefault();

        const form = $(this);
        const url = form.attr('action');

        cuteAlert({
            type: 'question',
            title: 'Are you sure?',
            message: 'Submitted assessment cannot be edit!',
            closeStyle: 'circle',
            cancelText: 'Abort',
            confirmText: 'Yes, Confirm!',
        }).then(
            async (e) => {
                if (e == 'confirm') {
                    const res = await submitApi(url, form.serializeArray(), 'formAssessement');
                    if (isSuccess(res)) {
                        reloadAssessmentForm();
                        getDataStudentList();
                        getDataListSubject($('#levelStudent').val());

                        const resReport = await callApi('post', "reportcard/getReportIDByFilter", {
                            'level_id': $('#levelStudent').val(),
                            'report_date': $('#date_filter').val(),
                        });

                        if (isSuccess(resReport)) {
                            var status;
                            if (resReport.data.report_status == 0) {
                                status = '<span class="badge bg-label-danger"> DRAFT </span>';
                            } else {
                                status = '<span class="badge bg-label-success"> POSTED </span>';
                            }
                        }

                        $('#report_status_view').html(status);
                    }
                }
            }
        );
    });

    function toMonthName(monthNumber) {
        const date = new Date();
        date.setMonth(monthNumber - 1);

        return date.toLocaleString('en-US', {
            month: 'long',
        });
    }
</script>