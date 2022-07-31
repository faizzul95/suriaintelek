<form id="formApplication" action="application/addNewApplication" method="POST">

    <div class="row">
        <!-- Personal Details -->
        <div class="row col-md-6">
            <h6 class="fw-bold">1. Personal / Parent / Guardian Details</h6>
            <div class="col-md-3">
                <label class="form-label" for="salutation">Salutation <span class="text-danger">*</span> </label>
                <select id="user_salutation" name="user_salutation" class="form-control" required>
                    <option value=""> - Select - </option>
                    <option value="Mr"> Encik / Mr </option>
                    <option value="Mrs"> Puan / Mrs </option>
                    <option value="Ms"> Cik / Ms </option>
                    <option value="Dr"> Dr </option>
                    <option value="Dato"> Dato' </option>
                    <option value="Datin"> Datin </option>
                    <option value="Tan Sri"> Tan Sri </option>
                    <option value="Puan Sri"> Puan Sri </option>
                </select>
            </div>
            <div class="col-md-9">
                <label class="form-label" for="fullname">Full Name <span class="text-danger">*</span></label>
                <input type="text" id="user_fullname" name="user_fullname" class="form-control maxlength-input" maxlength="100" autocomplete="off" onKeyUP="this.value = this.value.toUpperCase();" required>
            </div>
            <div class="col-md-4 mt-2">
                <label class="form-label" for="preferred name">Preferred Name <span class="text-danger">*</span></label>
                <input type="text" id="user_preferred_name" name="user_preferred_name" class="form-control maxlength-input" maxlength="15" autocomplete="off" onKeyUP="this.value = this.value.toUpperCase();" required>
            </div>
            <div class="col-md-4 mt-2">
                <label class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" id="user_email" name="user_email" class="form-control maxlength-input" maxlength="50" autocomplete="off" required>
            </div>
            <div class="col-md-4 mt-2">
                <label class="form-label">Contact / HP No <span class="text-danger">*</span></label>
                <input type="text" id="user_contact_no" name="user_contact_no" class="form-control maxlength-input" maxlength="13" autocomplete="off" onkeypress="return isNumberKey(event)" required>
            </div>
            <div class="col-md-12 mt-2">
                <label class="form-label"> Address <span class="text-danger">*</span></label>
                <textarea id="user_address" name="user_address" class="form-control maxlength-input" maxlength="250" autocomplete="off" rows="3" onKeyUP="this.value = this.value.toUpperCase();" required></textarea>
            </div>
            <div class="col-md-4 mt-2">
                <label class="form-label"> Postal Code <span class="text-danger">*</span></label>
                <input type="text" id="user_postcode" name="user_postcode" class="form-control maxlength-input" maxlength="8" autocomplete="off" onkeypress="return isNumberKey(event)" required>
            </div>
            <div class="col-md-4 mt-2">
                <label class="form-label"> City <span class="text-danger">*</span></label>
                <input type="text" id="user_city" name="user_city" class="form-control maxlength-input" maxlength="25" autocomplete="off" onKeyUP="this.value = this.value.toUpperCase();" required>
            </div>
            <div class="col-md-4 mt-2">
                <label class="form-label"> State <span class="text-danger">*</span></label>
                <select id="user_state" name="user_state" class="form-control" required>
                    <option value=""> - Select - </option>
                    <option value="Johor">Johor</option>
                    <option value="Kedah">Kedah</option>
                    <option value="Kelantan">Kelantan</option>
                    <option value="Kuala Lumpur">Kuala Lumpur</option>
                    <option value="Labuan">Labuan</option>
                    <option value="Melaka">Melaka</option>
                    <option value="Negeri Sembilan">Negeri Sembilan</option>
                    <option value="Pahang">Pahang</option>
                    <option value="Penang">Penang</option>
                    <option value="Perak">Perak</option>
                    <option value="Perlis">Perlis</option>
                    <option value="Putrajaya">Putrajaya</option>
                    <option value="Sabah">Sabah</option>
                    <option value="Sarawak">Sarawak</option>
                    <option value="Selangor">Selangor</option>
                    <option value="Terengganu">Terengganu</option>
                </select>
            </div>
            <div class="col-md-4 mt-2">
                <label class="form-label"> Gender <span class="text-danger">*</span></label>
                <select id="user_gender" name="user_gender" class="form-control" required>
                    <option value=""> - Select - </option>
                    <option value="Male"> Male </option>
                    <option value="Female"> Female </option>
                </select>
            </div>
            <div class="col-md-4 mt-2">
                <label class="form-label"> Religion </label>
                <select id="user_religion" name="user_religion" class="form-control">
                    <option value=""> - Select - </option>
                    <option value="Islam"> Islam </option>
                    <option value="Buddhism"> Buddhism </option>
                    <option value="Christianity"> Christianity </option>
                    <option value="Hinduism"> Hinduism </option>
                    <option value="Sikhism "> Sikhism </option>
                    <option value="Others"> Others </option>
                </select>
            </div>
            <div class="col-md-4 mt-2">
                <label class="form-label"> Race </label>
                <select id="user_race" name="user_race" class="form-control">
                    <option value=""> - Select - </option>
                    <option value="Melayu"> Melayu </option>
                    <option value="Chinese"> Chinese </option>
                    <option value="Indian"> Indian </option>
                    <option value="Others"> Others </option>
                </select>
            </div>
        </div>
        <!-- Student Details -->
        <div class="row col-md-6">
            <h6 class="fw-bold">2. Student Details</h6>
            <div class="col-md-12">
                <label class="form-label" for="username"> Student Full Name <span class="text-danger">*</span></label>
                <input type="text" id="stud_name" name="stud_name[]" class="form-control maxlength-input" maxlength="150" autocomplete="off" onKeyUP="this.value = this.value.toUpperCase();" required>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="username"> Preferred Name <span class="text-danger">*</span></label>
                <input type="text" id="stud_preferred_name" name="stud_preferred_name[]" class="form-control maxlength-input" maxlength="15" autocomplete="off" required>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="username"> NRIC / Passport <span class="text-danger">*</span></label>
                <input type="text" id="stud_nric" name="stud_nric[]" class="form-control maxlength-input" maxlength="15" autocomplete="off" required>
            </div>
            <div class="col-md-4">
                <label class="form-label"> Gender <span class="text-danger">*</span></label>
                <select id="stud_gender" name="stud_gender[]" class="form-control" required>
                    <option value=""> - Select - </option>
                    <option value="Male"> Male </option>
                    <option value="Female"> Female </option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label"> Race </label>
                <select id="stud_race" name="stud_race[]" class="form-control">
                    <option value=""> - Select - </option>
                    <option value="Melayu"> Melayu </option>
                    <option value="Chinese"> Chinese </option>
                    <option value="Indian"> Indian </option>
                    <option value="Others"> Others </option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label"> Birth Date <span class="text-danger">*</span></label>
                <input type="date" id="stud_dob" name="stud_dob[]" class="form-control" max="<?= date('Y-12-31', strtotime('-6 years')); ?>" min="<?= date('Y-01-01', strtotime('-6 years')); ?>" value="<?= date('Y-01-01', strtotime('-6 years')); ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label"> Level <span class="text-danger">*</span></label>
                <select id="level_id" name="level_id[]" class="form-control" required>
                    <option value=""> - Select - </option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Relationship <span class="text-danger">*</span></label>
                <select id="user_relation" name="user_relation[]" class="form-control" required>
                    <option value=""> - Select - </option>
                    <option value="Mother"> Ibu Kandung / Mother </option>
                    <option value="Father"> Bapa Kandung / Father </option>
                    <option value="Adoptive Mother"> Ibu Angkat / Adoptive Mother </option>
                    <option value="Adoptive Father"> Bapa Angkat / Adoptive Father </option>
                    <option value="Brother"> Abang / Brother </option>
                    <option value="Kakak"> Kakak / Sister </option>
                    <option value="Uncle"> Ibu Saudara / Auntie </option>
                    <option value="Uncle"> Bapa Saudara / Uncle </option>
                    <option value="Cousin"> Sepupu / Cousin </option>
                    <option value="Guardian"> Penjaga / Guardian </option>
                </select>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <span class="text-danger mb-2">* Indicates a required field</span>

        <div class="col-lg-12">
            <center>
                <input type="hidden" id="application_id" name="application_id" class="form-control" readonly>
                <input type="hidden" id="school_id" name="school_id" value="1" class="form-control" readonly>
                <!-- button submit must be put id "submitBtn" -->
                <button type="submit" id="submitBtn" class="btn btn-info"> <i class='fa fa-save'></i> Save </button>
            </center>
        </div>
    </div>
</form>

<script>
    $("#formApplication").submit(function(event) {
        event.preventDefault();

        const form = $(this);
        const url = form.attr('action');

        cuteAlert({
            type: 'question',
            title: 'Are you sure?',
            message: 'Form will be submitted!',
            closeStyle: 'circle',
            cancelText: 'Abort',
            confirmText: 'Yes, Confirm!',
        }).then(
            async (e) => {
                if (e == 'confirm') {
                    const res = await submitApi(url, form.serializeArray(), 'formApplication', getDataList);
                }
            }
        );
    });
</script>