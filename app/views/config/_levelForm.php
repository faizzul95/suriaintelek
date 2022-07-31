<form id="formLevel" action="level/create" method="POST">

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label> Level Name <span class="text-danger">*</span> </label>
                <input type="text" id="level_name" name="level_name" class="form-control" maxlength="50" autocomplete="off" required>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-lg-12">
            <div class="form-group">
                <label> Status <span class="text-danger">*</span> </label>
                <select id="level_status" name="level_status" class="form-control" required>
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
                <input type="hidden" id="level_id" name="level_id" class="form-control" readonly>
                <input type="hidden" id="school_id" name="school_id" value="1" class="form-control" readonly>
                <!-- button submit must be put id "submitBtn" -->
                <button type="submit" id="submitBtn" class="btn btn-success"> <i class='fa fa-save'></i> Save </button>
            </center>
        </div>
    </div>

</form>

<script>
    $("#formLevel").submit(function(event) {
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
                    const res = await submitApi(url, form.serializeArray(), 'formLevel', getDataList);
                }
            }
        );
    });
</script>