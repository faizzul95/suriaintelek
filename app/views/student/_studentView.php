<!-- application details -->
<style>
    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        color: white;
        background-color: #5a8dee;
    }
</style>

<div class="row">

    <div class="col-lg-4 col-xs-12 col-md-12 p-4 fill border-right psbar" style="overflow:auto;max-height:80vh!important;position:relative!important">
        <!-- student Details -->
        <div class="row">
            <div class="alert alert-primary" role="alert">
                <h6 class="alert-heading fw-bold mb-1">Student Details</h6>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <img id="studentAvatar" src="" alt="student image" class="rounded-3 user-profile-img img-fluid">
            </div>
            <div class="col-lg-8">
                <div class="row">
                    <label style="color : #b3b3cc"> Student Full Name</label><br>
                    <span id="stud_name" style="font-weight:bold"></span>
                </div>
                <div class="row mt-2">
                    <div class="col-lg-6">
                        <label style="color : #b3b3cc"> Preferred Name</label><br>
                        <span id="stud_preferred_name" style="font-weight:bold"></span>
                    </div>
                    <div class="col-lg-6">
                        <label style="color : #b3b3cc">NRIC / Passport</label><br>
                        <span id="stud_nric" style="font-weight:bold"></span>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-lg-4">
                        <label style="color : #b3b3cc"> Gender </label><br>
                        <span id="stud_gender" style="font-weight:bold"></span>
                    </div>
                    <div class="col-lg-4">
                        <label style="color : #b3b3cc"> Race </label><br>
                        <span id="stud_race" style="font-weight:bold"></span>
                    </div>
                    <div class="col-lg-4">
                        <label style="color : #b3b3cc"> Birth Date </label><br>
                        <span id="stud_dob" style="font-weight:bold"></span>
                    </div>
                </div>
            </div>
        </div>

        <hr />

        <div class="row mt-4">
            <div class="col-xl-12">
                <div class="nav-align-top mb-4">
                    <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-guardian" aria-controls="navs-pills-justified-guardian" aria-selected="true"><i class="tf-icons bx bx-home"></i> Guardian </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-siblings" aria-controls="navs-pills-justified-siblings" aria-selected="false"><i class="tf-icons bx bx-user"></i> Siblings</button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-application" aria-controls="navs-pills-justified-application" aria-selected="false"><i class="tf-icons bx bx-message-square"></i> Application </button>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="navs-pills-justified-guardian" role="tabpanel">
                            <!-- parent / guardian details -->
                            <div class="row">
                                <div class="col-lg-4">
                                    <label style="color : #b3b3cc">Salutation</label><br>
                                    <span id="user_salutation" style="font-weight:bold"></span>
                                </div>
                                <div class="col-lg-8">
                                    <label style="color : #b3b3cc">Full Name</label><br>
                                    <span id="user_fullname" style="font-weight:bold"></span>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-lg-6">
                                    <label style="color : #b3b3cc">Preferred Name</label><br>
                                    <span id="user_preferred_name" style="font-weight:bold"></span>
                                </div>
                                <div class="col-lg-6">
                                    <label style="color : #b3b3cc">NRIC</label><br>
                                    <span id="user_nric" style="font-weight:bold"></span>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-lg-6">
                                    <label style="color : #b3b3cc">Email</label><br>
                                    <span id="user_email" style="font-weight:bold"></span>
                                </div>
                                <div class="col-lg-6">
                                    <label style="color : #b3b3cc">Contact No.</label><br>
                                    <span id="user_contact_no" style="font-weight:bold"></span>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-lg-4">
                                    <label style="color : #b3b3cc">Job</label><br>
                                    <span id="user_job" style="font-weight:bold"></span>
                                </div>
                                <div class="col-lg-4">
                                    <label style="color : #b3b3cc">Salary</label><br>
                                    <span id="user_salary" style="font-weight:bold"></span>
                                </div>
                                <div class="col-lg-4">
                                    <label style="color : #b3b3cc"> Relationship </label><br>
                                    <span id="user_relation" style="font-weight:bold"></span>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-lg-12">
                                    <label style="color : #b3b3cc">Address</label><br>
                                    <span id="user_address" style="font-weight:bold"></span>
                                </div>
                                <div class="col-lg-4 mt-2">
                                    <label style="color : #b3b3cc">Postal Code</label><br>
                                    <span id="user_postcode" style="font-weight:bold"></span>
                                </div>
                                <div class="col-lg-4 mt-2">
                                    <label style="color : #b3b3cc">City </label><br>
                                    <span id="user_city" style="font-weight:bold"></span>
                                </div>
                                <div class="col-lg-4 mt-2">
                                    <label style="color : #b3b3cc">State</label><br>
                                    <span id="user_state" style="font-weight:bold"></span>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="navs-pills-justified-siblings" role="tabpanel">

                            <div class="row" id="noSiblings"></div>

                            <div class="row" id="siblings" style="display: none;">
                                <div class="accordion mt-3 accordion-header-primary" id="siblingsData"></div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="navs-pills-justified-application" role="tabpanel">

                            <div class="row">
                                <div class="alert alert-primary" role="alert">
                                    <h6 class="alert-heading fw-bold mb-1">Application Information</h6>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <label style="color : #b3b3cc">Application No </label><br>
                                    <span id="application_no" style="font-weight:bold"></span>
                                </div>
                                <div class="col-lg-6">
                                    <label style="color : #b3b3cc">Application Date</label><br>
                                    <span id="application_date" style="font-weight:bold"></span> (<span id="application_day" style="font-weight:bold"></span>)
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="alert alert-primary" role="alert">
                                    <h6 class="alert-heading fw-bold mb-1">Application History</h6>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="card-body">
                                    <ul class="timeline timeline-dashed" id="logDetails"></ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="col-lg-4 col-xs-12 col-md-12 p-4 fill border-right psbar" style="overflow:auto;max-height:980vh!important;position:relative!important">

        <!-- billing info -->
        <div class="row">
            <div class="alert alert-primary" role="alert">
                <h6 class="alert-heading fw-bold mb-1"> Billings Information </h6>
            </div>
        </div>

        <div class="row">
            <div class="col-md">
                <!-- <small class="text-light fw-semibold">Accordion With Icon (Always Open)</small> -->
                <div class="accordion mt-3 accordion-header-primary">
                    <div class="card accordion-item">
                        <h2 class="accordion-header d-flex align-items-center">
                            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionWithIcon-1" aria-expanded="true">
                                <i class="bx bx-bar-chart-alt-2 me-2"></i>
                                Invoice
                            </button>
                        </h2>
                        <div id="accordionWithIcon-1" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <div class="row" id="noInvoice"></div>
                                <div class="row" id="dataInvoice"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card accordion-item">
                        <h2 class="accordion-header d-flex align-items-center">
                            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionWithIcon-2" aria-expanded="false">
                                <i class="bx bx-briefcase me-2"></i>
                                Payment History
                            </button>
                        </h2>
                        <div id="accordionWithIcon-2" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <div class="row" id="noPayment"></div>
                                <div class="row" id="dataPayment"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- academic info -->
    <div class="col-lg-4 col-xs-12 col-md-12 p-4 fill border-right psbar" style="overflow-y:auto;max-height:80vh!important;position:relative!important">
        <div class="row">
            <div class="alert alert-primary" role="alert">
                <h6 class="alert-heading fw-bold mb-1"> Academic Informations </h6>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-lg-6">
                <label style="color : #b3b3cc"> Matric No </label><br>
                <span id="stud_matric_no" style="font-weight:bold"></span>
            </div>
            <div class="col-lg-6">
                <label style="color : #b3b3cc">Status </label><br>
                <span id="status" style="font-weight:bold"></span>
            </div>
            <div class="col-lg-6 mt-2">
                <label style="color : #b3b3cc">Class</label><br>
                <span id="class" style="font-weight:bold"></span>
            </div>
            <div class="col-lg-6 mt-2">
                <label style="color : #b3b3cc">Level </label><br>
                <span id="level" style="font-weight:bold"></span>
            </div>
        </div>

        <div class="row mt-4">
            <div class="alert alert-primary" role="alert">
                <h6 class="alert-heading fw-bold mb-1"> QR Image </h6>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-12">
                <center>
                    <img id="studentQR" src="" alt="qr image" class="rounded-3 img-fluid" width='55%'>
                </center>
            </div>
        </div>


    </div>
</div>

<script>
    // get data array from general function
    function getPassData(baseUrl, token, data) {

        var studImage = data.stud_image;
        var studQR = data.stud_qrcode;
        var status = data.application_status;
        var errorNoData = "<div id='nodata' class='col-lg-12 mb-2 mt-5'>\
                        <center>\
                            <img src='" + baseUrl + "/public/framework/img/nodata/5.png' class='img-fluid mb-4' width='40%'>\
                            <h6 style='letter-spacing :2px; font-family: Quicksand, sans-serif !important;margin-bottom:30px'>\
                            <strong> NO INFORMATION FOUND </strong>\
                            </h6>\
                        </center>\
                        </div>";

        if (status == 6) {
            status = '<span class="badge bg-label-primary">Enroled</span>';
        } else if (status == 7) {
            status = '<span class="badge bg-label-success">Graduate</span>';
        } else if (status == 8) {
            status = '<span class="badge bg-label-danger">Withdraw</span>';
        }

        $('#status').html(status);
        $("#studentAvatar").attr("src", baseUrl + "/" + studImage);
        $("#studentQR").attr("src", baseUrl + "/" + studQR);

        // $('#application_id').val(data.application_id);
        $('#application_no').text(data.application_no);
        $('#level').text(data.level_name);
        $('#class').text(data.class_name);
        $('#stud_matric_no').text(data.stud_matric_no);

        var myDate = new Date(data.application_date);
        $('#application_date').text(moment(myDate).format("DD/MM/YYYY hh:mm A"));
        $('#application_day').text(moment(myDate).format("dddd"));

        $('#user_salutation').text(data.user_salutation);
        $('#user_fullname').text(data.user_fullname);
        $('#user_preferred_name').text(data.user_preferred_name);
        $('#user_nric').text(data.user_nric);
        $('#user_email').text(data.user_email);
        $('#user_contact_no').text(data.user_contact_no);
        $('#user_address').text(data.user_address);
        $('#user_postcode').text(data.user_postcode);
        $('#user_city').text(data.user_city);
        $('#user_state').text(data.user_state);

        $('#user_job').text(data.user_job);
        $('#user_salary').text('RM ' + data.user_salary);

        $('#stud_name').text(data.stud_name);
        $('#stud_preferred_name').text(data.stud_preferred_name);
        $('#stud_nric').text(data.stud_nric);
        $('#stud_gender').text(data.stud_gender);
        $('#stud_race').text(data.stud_race);
        $('#stud_dob').text(moment(data.stud_dob).format("DD/MM/YYYY"));
        $('#user_relation').text(data.user_relation);

        'use strict';

        document.addEventListener('DOMContentLoaded', function() {
            (function() {
                const scrollBar = document.getElementsByClassName('psbar');
                new PerfectScrollbar(scrollBar, {
                    suppressScrollX: true,
                    suppressScrollY: true,
                    maxScrollbarLength: 200,
                    theme: 'dark',
                    handlers: ['click-rail', 'drag-scrollbar', 'wheel', 'touch'],
                    wheelPropagation: false,
                    useBothWheelAxes: true,
                });
            })();
        });

        getSiblings(data.user_id, data.stud_id, baseUrl);
        getLogs(data.user_id, data.application_id, baseUrl);
        getInv(data.stud_id, baseUrl);
        getPayment(data.stud_id, baseUrl);
    }

    async function getSiblings(user_id, stud_id, baseUrl) {

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
                $('#noSiblings').html("<div id='nodata' class='col-lg-12 mb-2 mt-5'>\
                                    <center>\
                                        <img src='" + baseUrl + "/public/framework/img/nodata/6.png' class='img-fluid mb-4' width='50%'>\
                                        <h6 style='letter-spacing :2px; font-family: Quicksand, sans-serif !important;margin-bottom:25px'>\
                                        <strong> NO INFORMATION FOUND </strong>\
                                        </h6>\
                                    </center>\
                                    </div>");
            }

        }
    }

    async function getLogs(user_id, application_id, baseUrl) {

        const res = await callApi('post', "LogRecord/getLogByParentID", {
            user_id: user_id,
            application_id: application_id,
        });

        if (isSuccess(res)) {

            $('#logDetails').empty();

            if (res.data.length > 0) {
                const data = res.data;
                for (i = 0; i < data.length; i++) {

                    var date = moment(data[i].log_date).format("DD/MM/YYYY hh:mm A");
                    var log_event = data[i].log_event;
                    var log_remark = data[i].log_remark;
                    var log_type = data[i].log_type;

                    var icon = '<i class="bx bx-paper-plane"></i>';

                    if (log_type == 'info') {
                        icon = '<i class="fa fa-info-circle" aria-hidden="true"></i>';
                    } else if (log_type == 'warning') {
                        icon = '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>';
                    } else if (log_type == 'danger') {
                        icon = '<i class="fa fa-times" aria-hidden="true"></i>';
                    } else if (log_type == 'success') {
                        icon = '<i class="fa fa-check-circle" aria-hidden="true"></i>';
                    }

                    $('#logDetails').append('<li class="timeline-item timeline-item-' + log_type + ' mb-4">\
                                            <span class="timeline-indicator timeline-indicator-' + log_type + '">\
                                            ' + icon + '\
                                            </span>\
                                            <div class="timeline-event">\
                                                <div class="timeline-header border-bottom mb-3">\
                                                    <h6 class="mb-0">' + log_event + '</h6>\
                                                    <small class="text-muted">' + date + '</small>\
                                                </div>\
                                                <div class="d-flex justify-content-between flex-wrap mb-2">\
                                                    <div>\
                                                       ' + log_remark + '\
                                                    </div>\
                                                </div>\
                                            </div>\
                                        </li>');
                }
            } else {
                $('#logDetails').html("<div id='nodata' class='col-lg-12 mb-2 mt-5'>\
                                    <center>\
                                        <img src='" + baseUrl + "/public/framework/img/nodata/6.png' class='img-fluid mb-4' width='50%'>\
                                        <h6 style='letter-spacing :2px; font-family: Quicksand, sans-serif !important;margin-bottom:25px'>\
                                        <strong> NO INFORMATION FOUND </strong>\
                                        </h6>\
                                    </center>\
                                    </div>");
            }

        }
    }

    async function getInv(stud_id, baseUrl) {
        const res = await callApi('post', "billing/getListAccordionInvoiceByStudID", {
            'stud_id': stud_id,
            'billing_type': 2,
        });

        if (isSuccess(res)) {
            $('#noInvoice').empty();
            $('#dataInvoice').empty();
            if (res.data != '') {
                $('#dataInvoice').html(res.data);
            } else {
                $('#noInvoice').html("<div id='nodata' class='col-lg-12 mb-2 mt-5'>\
                                    <center>\
                                        <img src='" + baseUrl + "/public/framework/img/nodata/6.png' class='img-fluid mb-4' width='50%'>\
                                        <h6 style='letter-spacing :2px; font-family: Quicksand, sans-serif !important;margin-bottom:25px'>\
                                        <strong> NO INFORMATION FOUND </strong>\
                                        </h6>\
                                    </center>\
                                    </div>");
            }
        }
    }

    async function getPayment(stud_id, baseUrl) {
        const res = await callApi('post', "billing/getListAccordionPaymentByStudID", stud_id);
        if (isSuccess(res)) {
            $('#noPayment').empty();
            $('#dataPayment').empty();
            if (res.data != '') {
                $('#dataPayment').html(res.data);
            } else {
                $('#noPayment').html("<div id='nodata' class='col-lg-12 mb-2 mt-5'>\
                                    <center>\
                                        <img src='" + baseUrl + "/public/framework/img/nodata/6.png' class='img-fluid mb-4' width='50%'>\
                                        <h6 style='letter-spacing :2px; font-family: Quicksand, sans-serif !important;margin-bottom:25px'>\
                                        <strong> NO INFORMATION FOUND </strong>\
                                        </h6>\
                                    </center>\
                                    </div>");
            }
        }
    }


    async function viewInvDetail(billingID) {
        console.log(billingID);
    }

    async function viewPaymentDetail(paymentID) {
        console.log(paymentID);
    }
</script>