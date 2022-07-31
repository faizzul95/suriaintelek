<form id="formPreset" action="billing/presetCreate" method="POST">

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label> Present Name <span class="text-danger">*</span> </label>
                <input type="text" id="preset_name" name="preset_name" class="form-control" maxlength="50" autocomplete="off" onkeyup="this.value = this.value.toUpperCase();" required>
            </div>
        </div>
    </div>

    <div class="row mt-2">

        <div class="col-lg-6">
            <div class="form-group">
                <label> Category <span class="text-danger">*</span> </label>
                <select id="preset_type" name="preset_type" class="form-control" required>
                    <option value=""> - Select - </option>
                    <option value="1"> Application Fees </option>
                    <option value="2"> Registration Fees </option>
                    <option value="3"> Monthly Fees </option>
                    <option value="4"> Graduation Fees </option>
                </select>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <label> Status <span class="text-danger">*</span> </label>
                <select id="preset_status" name="preset_status" class="form-control" required>
                    <option value=""> - Select - </option>
                    <option value="1"> Active </option>
                    <option value="0"> Inactive </option>
                </select>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-12">

            <div id="dataListItemDiv" class="card-datatable table-responsive">
                <table id="dataListItem" class="table table-bordered table-striped" width="100%">
                    <thead class="table-dark table border-top">
                        <tr>
                            <th width="2%"> # </th>
                            <th> Item Name </th>
                            <th> Price (RM)</th>
                        </tr>
                    </thead>
                    <tbody id="item"></tbody>
                </table>
            </div>

        </div>
    </div>

    <div class="row mt-2">
        <div class="col-lg-12">
            <span class="text-danger mb-2">* Indicates a required field</span>
            <center class="mt-4">
                <input type="hidden" id="preset_id" name="preset_id" class="form-control" readonly>
                <input type="hidden" id="school_id" name="school_id" value="1" class="form-control" readonly>
                <button type="submit" id="submitBtn" class="btn btn-success"> <i class='fa fa-save'></i> Save </button>
            </center>
        </div>
    </div>

</form>

<script>
    $("#formPreset").submit(function(event) {
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
                    const res = await submitApi(url, form.serializeArray(), 'formPreset', getDataPresetList);
                }
            }
        );
    });

    function getPassData(baseUrl, token, data) {
        const ids = (data != null) ? data['preset_item_arr'] : null;
        getListItem(ids);
    }

    async function getListItem(ids = null) {
        const res = await callApi('post', "itemFee/getItemListTD", ids);
        // check if request is success
        if (isSuccess(res)) {
            $('#item').empty();
            $('#item').html(res.data);
        } else {
            noti(res.status); // show error message
        }
    }
</script>