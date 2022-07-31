<form id="formSubject" action="term/create" method="POST">

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label> Subject Code <span class="text-danger">*</span> </label>
                <input type="text" id="subject_code" name="subject_code" class="form-control" maxlength="50" autocomplete="off" onKeyUP="this.value = this.value.toUpperCase();" required>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label> Subject Name <span class="text-danger">*</span> </label>
                <input type="text" id="subject_name" name="subject_name" class="form-control" maxlength="50" autocomplete="off" onKeyUP="this.value = this.value.toUpperCase();" required>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-lg-6">
            <div class="form-group">
                <label> Subject Description </label>
                <input type="text" id="subject_remark" name="subject_remark" class="form-control" maxlength="50" autocomplete="off">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label> Status <span class="text-danger">*</span> </label>
                <select id="subject_status" name="subject_status" class="form-control" required>
                    <option value=""> - Select - </option>
                    <option value="1"> Active </option>
                    <option value="0"> Inactive </option>
                </select>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-12">
            <span class="text-danger mb-2">* Indicates a required field</span>
            <center>
                <input type="hidden" id="subject_id" name="subject_id" class="form-control" readonly>
                <input type="hidden" id="school_id" name="school_id" value="1" class="form-control" readonly>
                <!-- button submit must be put id "submitBtn" -->
                <button type="submit" id="submitBtn" class="btn btn-success"> <i class='fa fa-save'></i> Save </button>
            </center>
        </div>
    </div>

</form>

<script>
    $("#formSubject").submit(function(event) {
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
                    const res = await submitApi(url, form.serializeArray(), 'formSubject', getDataList);
                }
            }
        );
    });
</script>