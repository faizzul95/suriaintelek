<form id="formUser" action="user/save" method="POST">

    <div class="row">
        <div class="col-md-2">
            <label class="form-label">Salutation <span class="text-danger">*</span> </label>
            <select id="user_salutation" name="user_salutation" class="form-control" required>
                <option value=""> - Select - </option>
                <option value="MR"> Encik / Mr </option>
                <option value="MRS"> Puan / Mrs </option>
                <option value="MS"> Cik / Ms </option>
                <option value="DR"> Dr </option>
                <option value="DATO"> Dato' </option>
                <option value="DATIN"> Datin </option>
                <option value="TAN SRI"> Tan Sri </option>
                <option value="PUAN SRI"> Puan Sri </option>
            </select>
        </div>
        <div class="col-md-10">
            <label class="form-label">Full Name <span class="text-danger">*</span></label>
            <input type="text" id="user_fullname" name="user_fullname" class="form-control maxlength-input" maxlength="100" autocomplete="off" onKeyUP="this.value = this.value.toUpperCase();" required>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-6">
            <label class="form-label">Preferred Name <span class="text-danger">*</span></label>
            <input type="text" id="user_preferred_name" name="user_preferred_name" class="form-control maxlength-input" maxlength="15" autocomplete="off" onKeyUP="ucfirstVal(this.value, 'user_preferred_name');" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">NRIC No.<span class="text-danger">*</span></label>
            <input type="text" id="user_nric" name="user_nric" class="form-control maxlength-input" maxlength="15" autocomplete="off" required>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-6">
            <label class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" id="user_email" name="user_email" class="form-control maxlength-input" maxlength="50" autocomplete="off" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Contact / HP No <span class="text-danger">*</span></label>
            <input type="text" id="user_contact_no" name="user_contact_no" class="form-control maxlength-input" maxlength="13" autocomplete="off" onkeypress="return isNumberKey(event)" required>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-12">
            <label class="form-label"> Address <span class="text-danger">*</span></label>
            <textarea id="user_address" name="user_address" class="form-control maxlength-input" maxlength="250" autocomplete="off" rows="3" onKeyUP="this.value = this.value.toUpperCase();" required></textarea>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-4">
            <label class="form-label"> Postal Code <span class="text-danger">*</span></label>
            <input type="text" id="user_postcode" name="user_postcode" class="form-control maxlength-input" maxlength="8" autocomplete="off" onkeypress="return isNumberKey(event)" required>
        </div>
        <div class="col-md-4">
            <label class="form-label"> City <span class="text-danger">*</span></label>
            <input type="text" id="user_city" name="user_city" class="form-control maxlength-input" maxlength="25" autocomplete="off" onKeyUP="this.value = this.value.toUpperCase();" required>
        </div>
        <div class="col-md-4">
            <label class="form-label"> State <span class="text-danger">*</span></label>
            <select id="user_state" name="user_state" class="form-control" required>
                <option value=""> - Select - </option>
                <option value="JOHOR">Johor</option>
                <option value="KEDAH">Kedah</option>
                <option value="KELANTAN">Kelantan</option>
                <option value="KUALA LUMPUR">Kuala Lumpur</option>
                <option value="LABUAN">Labuan</option>
                <option value="MELAKA">Melaka</option>
                <option value="NEGERI SEMBILAN">Negeri Sembilan</option>
                <option value="PAHANG">Pahang</option>
                <option value="PULAU PINANG">Pulau Pinang</option>
                <option value="PERAK">Perak</option>
                <option value="PERLIS">Perlis</option>
                <option value="PUTRAJAYA">Putrajaya</option>
                <option value="SABAH">Sabah</option>
                <option value="SARAWAK">Sarawak</option>
                <option value="SELANGOR">Selangor</option>
                <option value="TERENGGANU">Terengganu</option>
            </select>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-4">
            <label class="form-label"> Gender <span class="text-danger">*</span></label>
            <select id="user_gender" name="user_gender" class="form-control" required>
                <option value=""> - Select - </option>
                <option value="Male"> Male </option>
                <option value="Female"> Female </option>
            </select>
        </div>
        <div class="col-md-4">
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
        <div class="col-md-4">
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

    <div class="row mt-2">
        <div class="col-md-6">
            <label class="form-label"> Role <span class="text-danger">*</span></label>
            <input type="text" id="user_job" name="user_job" class="form-control" readonly>
        </div>
        <div class="col-md-6">
            <label class="form-label"> Salary (RM) <span class="text-danger">*</span></label>
            <input type="text" id="user_salary" name="user_salary" class="form-control maxlength-input" maxlength="8" autocomplete="off" onkeypress="return isNumberKey(event)" required>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-12">
            <span class="text-danger">* Indicates a required field</span>
            <center>
                <input type="hidden" id="user_id" name="user_id" class="form-control" readonly>
                <input type="hidden" id="role_id" name="role_id" class="form-control" readonly>
                <input type="hidden" id="user_avatar" name="user_avatar" class="form-control" readonly>
                <button type="submit" id="submitBtn" class="btn btn-info"> <i class='fa fa-save'></i> Save </button>
            </center>
        </div>
    </div>
</form>

<script src="public/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js"></script>
<script>
    function getPassData(baseUrl, token, data) {
        var maxlengthInput = $('.maxlength-input');

        // Bootstrap Max Length
        // --------------------------------------------------------------------
        if (maxlengthInput.length) {
            maxlengthInput.each(function() {
                $(this).maxlength({
                    warningClass: 'label label-success bg-success text-white',
                    limitReachedClass: 'label label-danger',
                    separator: ' out of ',
                    preText: 'You typed ',
                    postText: ' chars available.',
                    validate: true,
                    threshold: +this.getAttribute('maxlength')
                });
            });
        }

        var role = data.role_id;
        var job = null;

        if (role == 1) {
            job = 'Superadmin';
        } else if (role == 2) {
            job = 'Administrator';
        } else if (role == 3) {
            job = 'Admission';
        } else if (role == 4) {
            job = 'Teacher';
        } else if (role == 5) {
            job = 'Parent';
        }

        $('#role_id').val(role);
        $('#user_job').val(job);
        $('#user_avatar').val("default/user.png");
    }

    function ucfirstVal(value, id) {
        let textUpper = capitalize(value);
        $('#' + id).val(textUpper);
    }

    $("#formUser").submit(function(event) {
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
                    const res = await submitApi(url, form.serializeArray(), 'formUser', getDataList);
                }
            }
        );
    });
</script>