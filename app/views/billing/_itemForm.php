<form id="formItem" action="itemFee/create" method="POST">

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label> Item Name <span class="text-danger">*</span> </label>
                <input type="text" id="item_name" name="item_name" class="form-control" maxlength="50" autocomplete="off" onkeyup="this.value = this.value.toUpperCase();" required>
            </div>
        </div>
    </div>

    <div class="row  mt-2">
        <div class="col-lg-12">
            <div class="form-group">
                <label> Price <span class="text-danger">*</span> </label>
                <input type="number" id="item_price" name="item_price" min="0" class="form-control" required>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-lg-12">
            <div class="form-group">
                <label> Description <span class="text-danger">*</span> </label>
                <textarea id="item_description" name="item_description" class="form-control" rows="4" required></textarea>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-12">
            <span class="text-danger mb-2">* Indicates a required field</span>
            <center class="mt-4">
                <input type="hidden" id="item_id" name="item_id" class="form-control" readonly>
                <input type="hidden" id="school_id" name="school_id" value="1" class="form-control" readonly>
                <button type="submit" id="submitBtn" class="btn btn-success"> <i class='fa fa-save'></i> Save </button>
            </center>
        </div>
    </div>

</form>

<script>
    $("#formItem").submit(function(event) {
        event.preventDefault();

        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }

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
                    const res = await submitApi(url, form.serializeArray(), 'formItem', getDataList);
                }
            }
        );
    });

    function getPassData(baseUrl, token, data) {
        CKEDITOR.replace('item_description');
    }
</script>