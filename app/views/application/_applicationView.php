<!-- application details -->
<div class="row">
    <div class="alert alert-primary" role="alert">
        <h6 class="alert-heading fw-bold mb-1">Applications Details</h6>
    </div>
    <div class="col-lg-6">
        <label style="color : #b3b3cc">Application No </label><br>
        <span id="application_no_appview" style="font-weight:bold"></span>
    </div>
    <div class="col-lg-6">
        <label style="color : #b3b3cc">Application Date</label><br>
        <span id="application_date_appview" style="font-weight:bold"></span> (<span id="application_day_appview" style="font-weight:bold"></span>)
    </div>
</div>


<!-- parent / guardian details -->
<div class="row mt-4">
    <div class="alert alert-primary" role="alert">
        <h6 class="alert-heading fw-bold mb-1">Personal / Parent / Guardian Details</h6>
    </div>
    <div class="col-lg-4">
        <label style="color : #b3b3cc">Salutation</label><br>
        <span id="user_salutation_appview" style="font-weight:bold"></span>
    </div>
    <div class="col-lg-8">
        <label style="color : #b3b3cc">Full Name</label><br>
        <span id="user_fullname_appview" style="font-weight:bold"></span>
    </div>
</div>

<div class="row mt-2">
    <div class="col-lg-4">
        <label style="color : #b3b3cc">Preferred Name</label><br>
        <span id="user_preferred_name_appview" style="font-weight:bold"></span>
    </div>
    <div class="col-lg-4">
        <label style="color : #b3b3cc">NRIC</label><br>
        <span id="user_nric_appview" style="font-weight:bold"></span>
    </div>
    <div class="col-lg-4">
        <label style="color : #b3b3cc">Email</label><br>
        <span id="user_email_appview" style="font-weight:bold"></span>
    </div>
</div>

<div class="row mt-2">
    <div class="col-lg-4">
        <label style="color : #b3b3cc">Contact No.</label><br>
        <span id="user_contact_no_appview" style="font-weight:bold"></span>
    </div>
    <div class="col-lg-4">
        <label style="color : #b3b3cc">Job</label><br>
        <span id="user_job_appview" style="font-weight:bold"></span>
    </div>
    <div class="col-lg-4">
        <label style="color : #b3b3cc">Salary</label><br>
        <span id="user_salary_appview" style="font-weight:bold"></span>
    </div>
</div>

<div class="row mt-2">
    <div class="col-lg-4">
        <label style="color : #b3b3cc">Address</label><br>
        <span id="user_address_appview" style="font-weight:bold"></span>
    </div>
    <div class="col-lg-4">
        <label style="color : #b3b3cc">Postal Code</label><br>
        <span id="user_postcode_appview" style="font-weight:bold"></span>
    </div>
    <div class="col-lg-4">
        <label style="color : #b3b3cc">City / State</label><br>
        <span id="user_city_appview" style="font-weight:bold"></span> /
        <span id="user_state_appview" style="font-weight:bold"></span>
    </div>
</div>

<!-- student Details -->
<div class="row mt-4">
    <div class="alert alert-primary" role="alert">
        <h6 class="alert-heading fw-bold mb-1">Student Details</h6>
    </div>
    <div class="col-lg-12">
        <label style="color : #b3b3cc"> Student Full Name</label><br>
        <span id="stud_name_appview" style="font-weight:bold"></span>
    </div>
</div>

<div class="row mt-2">
    <div class="col-lg-4">
        <label style="color : #b3b3cc"> Preferred Name</label><br>
        <span id="stud_preferred_name_appview" style="font-weight:bold"></span>
    </div>
    <div class="col-lg-4">
        <label style="color : #b3b3cc">NRIC / Passport</label><br>
        <span id="stud_nric_appview" style="font-weight:bold"></span>
    </div>
    <div class="col-lg-4">
        <label style="color : #b3b3cc"> Gender </label><br>
        <span id="stud_gender_appview" style="font-weight:bold"></span>
    </div>
</div>

<div class="row mt-2">
    <div class="col-lg-4">
        <label style="color : #b3b3cc"> Race </label><br>
        <span id="stud_race_appview" style="font-weight:bold"></span>
    </div>
    <div class="col-lg-4">
        <label style="color : #b3b3cc"> Birth Date </label><br>
        <span id="stud_dob_appview" style="font-weight:bold"></span>
    </div>
    <div class="col-lg-4">
        <label style="color : #b3b3cc"> Relationship </label><br>
        <span id="user_relation_appview" style="font-weight:bold"></span>
    </div>
</div>

<script>
    // get data array from general function
    function getPassData(baseUrl, token, data) {
        $('#application_id').val(data.application_id);
        $('#application_no_appview').text(data.application_no);

        var myDate = new Date(data.application_date);
        $('#application_date_appview').text(moment(myDate).format("DD/MM/YYYY hh:mm A"));
        $('#application_day_appview').text(moment(myDate).format("dddd"));

        $('#user_salutation_appview').text(data.user_salutation);
        $('#user_fullname_appview').text(data.user_fullname);
        $('#user_preferred_name_appview').text(data.user_preferred_name);
        $('#user_nric_appview').text(data.user_nric);
        $('#user_email_appview').text(data.user_email);
        $('#user_contact_no_appview').text(data.user_contact_no);
        $('#user_address_appview').text(data.user_address);
        $('#user_postcode_appview').text(data.user_postcode);
        $('#user_city_appview').text(data.user_city);
        $('#user_state_appview').text(data.user_state);

        $('#user_job_appview').text(data.user_job);
        $('#user_salary_appview').text('RM ' + data.user_salary);

        $('#stud_name_appview').text(data.stud_name);
        $('#stud_preferred_name_appview').text(data.stud_preferred_name);
        $('#stud_nric_appview').text(data.stud_nric);
        $('#stud_gender_appview').text(data.stud_gender);
        $('#stud_race_appview').text(data.stud_race);
        $('#stud_dob_appview').text(moment(data.stud_dob).format("DD/MM/YYYY"));
        $('#user_relation_appview').text(data.user_relation);
    }
</script>