<!-- application details -->
<div class="row">
    <div class="alert alert-primary" role="alert">
        <h6 class="alert-heading fw-bold mb-1">Payment View Details</h6>
    </div>
</div>

<div class="row mt-2">
    <div class="col-lg-6">
        <label style="color : #b3b3cc">Receipt No </label><br>
        <span id="receipt_no" style="font-weight:bold"></span>
    </div>
    <div class="col-lg-6">
        <label style="color : #b3b3cc">Payment Date</label><br>
        <span id="payment_date" style="font-weight:bold"></span> (<span id="payment_day" style="font-weight:bold"></span>)
    </div>
</div>

<div class="row mt-2">
    <div class="col-lg-6">
        <label style="color : #b3b3cc">Payment Via </label><br>
        <span id="payment_via" style="font-weight:bold"></span>
    </div>
    <div class="col-lg-6">
        <label style="color : #b3b3cc">Amount</label><br>
        <span id="payment_amount" style="font-weight:bold"></span>
    </div>
</div>

<div class="row mt-2">
    <div class="col-lg-12">
        <label style="color : #b3b3cc">Remarks</label><br>
        <span id="payment_remark" style="font-weight:bold"></span>
    </div>
</div>

<div class="row mt-2">
    <div class="col-lg-12">
        <label style="color : #b3b3cc">File</label><br>
        <a href="javascript:void(0)" id="preview_file" class="btn btn-sm btn-success" title="Preview"> 
            <i class="fa fa-eye"></i>  
        </a> 
        <a href="javascript:void(0)" id="download_file" class="btn btn-sm btn-dark" title="Download"> 
            <i class="fa fa-download"></i>  
        </a> 
    </div>
</div>


<!-- Approval Details -->
<div class="row mt-2">
    <div class="col-lg-12">
        <form id="formApprovePay" action="billing/approvePaymentAction" method="POST">

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
                        <label class="form-label"> Status Payment <span class="text-danger">*</span> </label>
                        <select name="payment_status" id="payment_status" class="form-control" required>
                            <option value="">- Select - </option>
                            <option value="1"> Accept </option>
                            <option value="2"> Decline </option>
                            <option value="3"> Others </option>
                        </select>
                    </div>
                </div>	
            </div>

            <div class="col-lg-12 mt-4">
                <span class="text-danger">* Indicates a required field</span>
                <center>
                    <input type="hidden" name="payment_id" id="payment_id" required>
                    <input type="hidden" name="parent_user_id" id="parent_user_id" required>
                    <input type="hidden" name="billing_id" id="billing_id" required>
                    <button type="submit" id="submitBtn" class="btn btn-info"> <i class='fa fa-save'></i> Save </button>
                </center>
            </div>
        </form>
    </div>
</div>

<script>
    // get data array from general function
    function getPassData(baseUrl, token, data) {
        $('#payment_id').val(data.payment_id);
        $('#parent_user_id').val(data.payment_user_id);
        $('#billing_id').val(data.billing_id);
        $('#receipt_no').text(data.receipt_no);

        var myDate = new Date(data.payment_date);
        $('#payment_date').text(moment(myDate).format("DD/MM/YYYY"));
        $('#payment_day').text(moment(myDate).format("dddd"));

        $('#payment_via').text(data.payment_via);
        $('#payment_amount').text('RM ' + data.payment_amount);
        $('#payment_remark').html(data.payment_remark);
        $('#preview_file').attr("onclick", "previewPDF('" + data.payment_receipt_file + "', '" + data.payment_receipt_file_type + "')");
        $('#download_file').attr("onclick", "downloadPDF('" + data.payment_receipt_file + "', '" + data.payment_receipt_file_type + "')");
    }

    $("#formApprovePay").submit(function(event) {
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
                    const res = await submitApi(url, form.serializeArray(), 'formApprovePay');
                    if (isSuccess(res)) {
                        if (res.status == 200) {
                            getDataList();
                            setTimeout(function() {
                                $('#generalModal-xl').modal('hide');
                            }, 200);
                        }
                    }
                }
            }
        );
    });
</script>