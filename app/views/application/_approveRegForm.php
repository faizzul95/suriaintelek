<!-- application details -->
<div class="row">

    <div class="col-lg-6">
        <!-- parent / guardian details -->
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-primary" role="alert">
                    <h6 class="alert-heading fw-bold mb-1">Personal / Parent / Guardian Details</h6>
                </div>
            </div>
            <div class="col-lg-4">
                <label style="color : #b3b3cc">Salutation</label><br>
                <span id="user_salutation_view" style="font-weight:bold"></span>
            </div>
            <div class="col-lg-8">
                <label style="color : #b3b3cc">Full Name</label><br>
                <span id="user_fullname_view" style="font-weight:bold"></span>
            </div>

            <div class="row mt-2">
                <div class="col-lg-4">
                    <label style="color : #b3b3cc">Preferred Name</label><br>
                    <span id="user_preferred_name_view" style="font-weight:bold"></span>
                </div>
                <div class="col-lg-4">
                    <label style="color : #b3b3cc">NRIC</label><br>
                    <span id="user_nric_view" style="font-weight:bold"></span>
                </div>
                <div class="col-lg-4">
                    <label style="color : #b3b3cc">Email</label><br>
                    <span id="user_email_view" style="font-weight:bold"></span>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-lg-4">
                <label style="color : #b3b3cc">Contact No.</label><br>
                <span id="user_contact_no_view" style="font-weight:bold"></span>
            </div>
            <div class="col-lg-4">
                <label style="color : #b3b3cc">Job</label><br>
                <span id="user_job_view" style="font-weight:bold"></span>
            </div>
            <div class="col-lg-4">
                <label style="color : #b3b3cc">Salary</label><br>
                <span id="user_salary_view" style="font-weight:bold"></span>
            </div>
        </div>

        <!-- student Details -->
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="alert alert-primary" role="alert">
                    <h6 class="alert-heading fw-bold mb-1">Student Details</h6>
                </div>
            </div>

            <div class="col-lg-4">
                <label style="color : #b3b3cc"> Student Full Name</label><br>
                <span id="stud_name_view" style="font-weight:bold"></span>
            </div>

            <div class="row mt-2">
                <div class="col-lg-4">
                    <label style="color : #b3b3cc"> Preferred Name</label><br>
                    <span id="stud_preferred_name_view" style="font-weight:bold"></span>
                </div>
                <div class="col-lg-4">
                    <label style="color : #b3b3cc">NRIC / Passport</label><br>
                    <span id="stud_nric_view" style="font-weight:bold"></span>
                </div>
                <div class="col-lg-4">
                    <label style="color : #b3b3cc"> Gender </label><br>
                    <span id="stud_gender_view" style="font-weight:bold"></span>
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
                    <label style="color : #b3b3cc"> Relationship </label><br>
                    <span id="user_relation_view" style="font-weight:bold"></span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">

        <!-- Application Details -->
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-primary" role="alert">
                    <h6 class="alert-heading fw-bold mb-1">Applications Details</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <label style="color : #b3b3cc">Application No </label><br>
                    <span id="application_no_text" style="font-weight:bold"></span>
                </div>
                <div class="col-lg-6">
                    <label style="color : #b3b3cc">Application Date</label><br>
                    <span id="application_date_view" style="font-weight:bold"></span> (<span id="application_day_view" style="font-weight:bold"></span>)
                </div>
                <div class="col-lg-12 mt-2">
                    <label style="color : #b3b3cc">Approval Date</label><br>
                    <span id="approval_date_view" style="font-weight:bold"></span> (<span id="approval_day_view" style="font-weight:bold"></span>)
                </div>
            </div>
        </div>

        <!-- Payment Details -->
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="alert alert-primary" role="alert">
                    <h6 class="alert-heading fw-bold mb-1">Payment Details</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">

                    <div id="dataListItemDiv" class="card-datatable table-responsive">
                        <div class="row" id="noInvoice"></div>
                        <table id="dataListInv" class="table table-bordered table-striped" width="100%">
                            <thead class="table-dark table border-top">
                                <tr>
                                    <th> Invoice No. </th>
                                    <th> Type Invoice </th>
                                    <th> Amount (RM) </th>
                                    <th> Status</th>
                                </tr>
                            </thead>
                            <tbody id="invList"></tbody>
                        </table>
                        <span class="text-danger">* Note : please refer billing module for payment infomation </span>
                    </div>

                </div>
            </div>
        </div>

        <!-- Approval Details -->
        <div class="row mt-2">
            <div class="col-lg-12">
                <form id="formApplication" action="admission/approveRegistrationAction" method="POST">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-primary" role="alert">
                                <h6 class="alert-heading fw-bold mb-1">Approval Details</h6>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label"> Status Registration <span class="text-danger">*</span> </label>
                                <select name="application_status" id="application_status" class="form-control" onchange="showEnrolField(this.value)" required>
                                    <option value="">- Select - </option>
                                    <option value="9"> Withdraw Application </option>
                                    <option value="5"> Reject Payment </option>
                                    <option value="6"> Complete (Enrolled) </option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-2" id="enrolDate" style="display: none;">
                            <div class="col-md-3">
                                <label class="form-label"> Academic <span class="text-danger">*</span> </label>
                                <select name="academic_id" id="academic_id" class="form-control" required>
                                    <option value="">- Select - </option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label"> Level <span class="text-danger">*</span> </label>
                                <select name="level_id" id="level_id" class="form-control" required>
                                    <option value="">- Select - </option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label"> Class <span class="text-danger">*</span> </label>
                                <select name="class_id" id="class_id" class="form-control" required>
                                    <option value="">- Select - </option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label"> Enrolled Date : <span class="text-danger">*</span> </label>
                                <input type="date" id="enroll_date" name="enroll_date" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mt-2" id="reasonWithdrawal" style="display: none;">
                            <div class="col-md-12">
                                <label class="form-label"> Withdrawal Reason <span class="text-danger">*</span> </label>
                                <textarea id="application_remark" name="application_remark" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 mt-4">
                        <span class="text-danger">* Indicates a required field</span>
                        <center>
                            <input type="hidden" name="application_id" id="application_id" required>
                            <input type="hidden" name="parent_user_id" id="parent_user_id" required>
                            <input type="hidden" name="application_no" id="application_no" required>
                            <button type="submit" id="submitBtn" class="btn btn-info"> <i class='fa fa-save'></i> Save </button>
                        </center>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    // get data array from general function
    function getPassData(baseUrl, token, data) {

        $('#application_id').val(data.application_id);
        $('#parent_user_id').val(data.parent_user_id);

        $('#application_no_text').text(data.application_no);
        $('#application_no').val(data.application_no);
        var myDate = new Date(data.application_date);
        $('#application_date_view').text(moment(myDate).format("DD/MM/YYYY hh:mm A"));
        $('#approval_date_view').text(moment(myDate).format("DD/MM/YYYY hh:mm A"));
        $('#application_day_view').text(moment(myDate).format("dddd"));
        $('#approval_day_view').text(moment(myDate).format("dddd"));

        $('#user_salutation_view').text(data.user_salutation);
        $('#user_fullname_view').text(data.user_fullname);
        $('#user_preferred_name_view').text(data.user_preferred_name);
        $('#user_nric_view').text(data.user_nric);
        $('#user_email_view').text(data.user_email);
        $('#user_contact_no_view').text(data.user_contact_no);

        $('#user_job_view').text(data.user_job);
        $('#user_salary_view').text('RM ' + data.user_salary);

        $('#stud_name_view').text(data.stud_name);
        $('#stud_preferred_name_view').text(data.stud_preferred_name);
        $('#stud_nric_view').text(data.stud_nric);
        $('#stud_gender_view').text(data.stud_gender);
        $('#stud_race_view').text(data.stud_race);
        $('#stud_dob_view').text(moment(data.stud_dob).format("DD/MM/YYYY"));
        $('#user_relation_view').text(data.user_relation);

        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //January is 0 so need to add 1 to make it 1!
        var yyyy = today.getFullYear();
        if (dd < 10) {
            dd = '0' + dd
        }
        if (mm < 10) {
            mm = '0' + mm
        }

        today = yyyy + '-' + mm + '-' + dd;

        $('#enroll_date').attr('min', today);

        levelSelect(data.level_id);
        classSelect();
        academicSelect();
        getInv(data.stud_id, baseUrl)
    }

    $("#formApplication").submit(function(event) {
        event.preventDefault();

        const form = $(this);
        const url = form.attr('action');

        cuteAlert({
            type: 'question',
            title: 'Are you sure?',
            message: 'Application will be approved!',
            closeStyle: 'circle',
            cancelText: 'Abort',
            confirmText: 'Yes, Confirm!',
        }).then(
            async (e) => {
                if (e == 'confirm') {
                    const res = await submitApi(url, form.serializeArray(), 'formApplication', getDataList);
                    if (res.status == 200) {
                        setTimeout(function() {
                            $('#generalModal-fullscreen').modal('hide');
                        }, 200);
                    }
                }
            }
        );
    });

    function showEnrolField(status) {
        if (status == 5 || status == '') {
            $('#enrolDate').hide();
            $('#reasonWithdrawal').hide();
            $('#enroll_date').prop('required', false);
            $('#academic_id').prop('required', false);
            $('#level_id').prop('required', false);
            $('#class_id').prop('required', false);
            $('#application_remark').prop('required', false);
        } else if (status == 9) {
            $('#reasonWithdrawal').show();
            $('#enrolDate').hide();
            $('#application_remark').prop('required', true);
            $('#enroll_date').prop('required', false);
            $('#academic_id').prop('required', false);
            $('#level_id').prop('required', false);
            $('#class_id').prop('required', false);
        } else {
            $('#enrolDate').show();
            $('#reasonWithdrawal').hide();
            $('#enroll_date').prop('required', true);
            $('#academic_id').prop('required', true);
            $('#level_id').prop('required', true);
            $('#class_id').prop('required', true);
            $('#application_remark').prop('required', false);
        }
    }

    async function levelSelect(id) {
        const res = await callApi('post', "level/getSelectLevel");
        $('#level_id').html(res.data);
        $('#level_id').val(id);
    }

    async function classSelect(id) {
        const res = await callApi('post', "classroom/getSelectClassroom");
        $('#class_id').html(res.data);
    }

    async function academicSelect() {
        const res = await callApi('post', "academicyear/getCurrentAcademic");
        $('#academic_id').html(res.data);
    }

    async function getInv(stud_id, baseUrl) {
        const res = await callApi('post', "billing/getInvoiceByStudID", {
            'stud_id': stud_id,
            'billing_type': 2,
        });

        if (isSuccess(res)) {
            $('#noInvoice').empty();
            $('#invList').empty();
            $('#dataListInv').hide();
            if (res.data.length > 0) {

                const data = res.data;
                for (i = 0; i < data.length; i++) {

                    var status = data[i].payment_status;
                    var type = data[i].billing_type;

                    if (type == 1) {
                        type = 'Application Fee';
                    } else if (type == 2) {
                        type = 'Registration Fee';
                    } else if (type == 3) {
                        type = 'Montly Fee';
                    } else if (type == 3) {
                        type = 'Graduation Fee';
                    }

                    if (status == 0) {
                        status = '<span class="badge bg-label-danger">UNPAID</span>';
                    } else if (status == 1) {
                        status = '<span class="badge bg-label-success">PAID</span>';
                    } else if (status == 2) {
                        status = '<span class="badge bg-label-danger">OVERDUE</span>';
                    } else if (status == 3) {
                        status = '<span class="badge bg-label-info">PARTIAL</span>';
                    } else if (status == 4) {
                        status = '<span class="badge bg-label-warning">OUTSTANDING</span>';
                    }

                    $('#invList').append('<tr>\
                                    <td> <a href ="javascript:void(0)" onclick="viewInvDetail(' + data[i].billing_id + ')">' + data[i].invoice_no + ' </a></td>\
                                    <td> ' + type + ' </td>\
                                    <td> ' + data[i].actual_amount + ' </td>\
                                    <td> ' + status + ' </td>\
                                </tr>');
                }
                $('#dataListInv').show();

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

    async function viewInvDetail(id) {
        const res = await callApi('post', "billing/getInvDetailByInvoiceID", id);
        // check if request is success
        if (isSuccess(res)) {
            loadFileContent('billing/_invTemplate.php', 'generalContent', 'xl', 'Invoice', res.data);
            $("#generalModal-xl").css("z-index", "1500");
        } else {
            noti(res.status); // show error message
        }
    }
</script>