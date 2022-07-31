<div class="row">

    <div class="col-lg-6 col-md-12 p-4 fill border-right psbar">
        <!-- parent / guardian details -->
        <div class="row">
            <div class="alert alert-primary" role="alert">
                <h6 class="alert-heading fw-bold mb-1">Personal / Parent / Guardian Details</h6>
            </div>
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
            <div class="col-lg-6">
                <label style="color : #b3b3cc">Job</label><br>
                <span id="user_job" style="font-weight:bold"></span>
            </div>
            <div class="col-lg-6">
                <label style="color : #b3b3cc">Salary</label><br>
                <span id="user_salary" style="font-weight:bold"></span>
            </div>
        </div>

        <!-- student Details -->
        <div class="row mt-4">
            <div class="alert alert-primary" role="alert">
                <h6 class="alert-heading fw-bold mb-1">Student Details</h6>
            </div>
            <div class="col-lg-12">
                <label style="color : #b3b3cc"> Student Full Name</label><br>
                <span id="stud_name" style="font-weight:bold"></span>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-lg-4">
                <label style="color : #b3b3cc"> Preferred Name</label><br>
                <span id="stud_preferred_name" style="font-weight:bold"></span>
            </div>
            <div class="col-lg-4">
                <label style="color : #b3b3cc">NRIC / Passport</label><br>
                <span id="stud_nric" style="font-weight:bold"></span>
            </div>
            <div class="col-lg-4">
                <label style="color : #b3b3cc"> Gender </label><br>
                <span id="stud_gender" style="font-weight:bold"></span>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-lg-4">
                <label style="color : #b3b3cc"> Race </label><br>
                <span id="stud_race" style="font-weight:bold"></span>
            </div>
            <div class="col-lg-4">
                <label style="color : #b3b3cc"> Birth Date </label><br>
                <span id="stud_dob" style="font-weight:bold"></span>
            </div>
            <div class="col-lg-4">
                <label style="color : #b3b3cc"> Relationship </label><br>
                <span id="user_relation" style="font-weight:bold"></span>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-12 p-4 fill border-right psbar">
        <!-- application details -->
        <div class="row">
            <div class="alert alert-primary" role="alert">
                <h6 class="alert-heading fw-bold mb-1">Applications Details</h6>
            </div>
            <div class="col-lg-6">
                <label style="color : #b3b3cc">Application No </label><br>
                <span id="application_no" style="font-weight:bold"></span>
            </div>
            <div class="col-lg-6">
                <label style="color : #b3b3cc">Application Date</label><br>
                <span id="application_date" style="font-weight:bold"></span> (<span id="application_day" style="font-weight:bold"></span>)
            </div>
        </div>

        <form id="formApplication" action="admission/rejectAction" method="POST">

            <div class="row mt-2">
                <div class="alert alert-primary" role="alert">
                    <h6 class="alert-heading fw-bold mb-1">Reason</h6>
                </div>
            </div>

            <span class="text-danger mb-2"> Reminder : This reason will be include in email notify to parent. </span>

            <textarea name="application_remark" id="application_remark" rows="5" class="form-control mt-2" maxlength="200" placeholder="Type any reason here (max 200 words).." required></textarea>

            <div class="col-lg-12 mt-4">
                <center>
                    <input type="hidden" name="application_id" id="application_id" required>
                    <input type="hidden" name="application_status" id="application_status" value="2" required>
                    <input type="hidden" name="parent_user_id" id="parent_user_id" required>
                    <input type="hidden" name="application_no" id="application_no_data" required>
                    <button type="submit" id="submitBtn" class="btn btn-info"> <i class='fa fa-save'></i> Save </button>
                </center>
            </div>
        </form>
    </div>
</div>

<script>
    // get data array from general function
    function getPassData(baseUrl, token, data) {
        $('#application_id').val(data.application_id);
        $('#application_no').text(data.application_no);
        $('#application_no_data').val(data.application_no);
        $('#parent_user_id').val(data.parent_user_id);

        var myDate = new Date(data.application_date);
        $('#application_date').text(moment(myDate).format("DD/MM/YYYY hh:mm A"));
        $('#application_day').text(moment(myDate).format("dddd"));

        $('#user_job').text(data.user_job);
        $('#user_salary').text('RM ' + data.user_salary);

        $('#user_salutation').text(data.user_salutation);
        $('#user_fullname').text(data.user_fullname);
        $('#user_preferred_name').text(data.user_preferred_name);
        $('#user_nric').text(data.user_nric);
        $('#user_email').text(data.user_email);
        $('#user_contact_no').text(data.user_contact_no);

        $('#stud_name').text(data.stud_name);
        $('#stud_preferred_name').text(data.stud_preferred_name);
        $('#stud_nric').text(data.stud_nric);
        $('#stud_gender').text(data.stud_gender);
        $('#stud_race').text(data.stud_race);
        $('#stud_dob').text(moment(data.stud_dob).format("DD/MM/YYYY"));
        $('#user_relation').text(data.user_relation);
    }

    $("#formApplication").submit(function(event) {
        event.preventDefault();

        const form = $(this);
        const url = form.attr('action');

        cuteAlert({
            type: 'question',
            title: 'Are you sure?',
            message: 'Application will be rejected!',
            closeStyle: 'circle',
            cancelText: 'Abort',
            confirmText: 'Yes, Confirm!',
        }).then(
            async (e) => {
                if (e == 'confirm') {
                    const res = await submitApi(url, form.serializeArray(), 'formApplication', getDataList);
                    if (res.status == 200) {
                        setTimeout(function() {
                            $('#generalModal-lg').modal('hide');
                        }, 200);
                    }
                }
            }
        );
    });
</script>