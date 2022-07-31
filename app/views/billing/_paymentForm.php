<div class="row">

    <div class="col-lg-9 col-xs-12 col-md-12 p-4 fill border-right psbar" style="overflow:auto;max-height:80vh!important;position:relative!important">

        <div class="row" style="padding-bottom: 0; padding-left: 20;padding-right: 20;padding-top: 0px;">
            <div class="col-sm-7">
                <h1 style="color: rgb(255, 140, 0); font-size: 40px; text-align: left; font-weight: 800; margin-bottom: 10px; margin-top: 10px;">
                    PROFORMA INVOICE</h1>
                <h6 style="text-align: left; margin-left: 5px; font-size: 14px;">
                    <span style="color: rgb(255, 165, 0);">
                        INVOICE NO :
                    </span>
                    <span id="invoice_no_view"> (INV NO HERE)</span> <br>
                    <span style="color: rgb(255, 165, 0);">
                        INVOICE DATE :
                    </span>
                    <span id="invoice_issue_date_view"> (INV ISSUE DATE HERE) </span>
                </h6>
            </div>
            <div class="col-sm-3" style="text-align: right; padding-left: 20; padding-right: 2;">
                <p>
                    <span style="color: #FFA500; font-size: 11px;">Address</span>
                </p>
                <span style="font-size: 11px;">
                    22A, Lorong Teratai 2/12,
                    Bandar Baru,<br>
                    45000 Kuala Selangor, <br>
                    Selangor.
                </span>
                <p>
                    <span style="color: rgb(255, 165, 0); font-size: 11px;">Phone : </span>
                    <span style="font-size: 11px;">Tel. (6013) 317-8899</span>
                </p>
            </div>
            <div class="col-sm-2" style="padding-left: 10;">
                <img id="logoSchoolview" class="img-fluid" width="80%">
            </div>
        </div>

        <hr>

        <div class="row" style="padding-bottom: 0; padding-left: 20;padding-right: 20;padding-top: 0px;">
            <div class="col-sm-6">
                <span id="user_fullname_view" style="color: #FFA500;">Parent Full Name</span> <br>
                <span id="user_address_view">Address</span><br>
                <span id="user_postcode_view">Postcode</span>, <span id="user_city_view">City</span><br>
                <span id="user_state_view">State</span><br>
            </div>
            <div class="col-sm-6" style="padding-left: 10;">
                Student Name : <span id="stud_name_view"></span> <br>
                Matric No : <span id="stud_matric_no_view">-</span><br>
                Academic :<span id="academic_name_view">-</span><br>
                Level : <span id="level_name_view">-</span><br>
                Class : <span id="class_name_view">-</span><br>
                Due Date : <span id="invoice_payment_date_view">-</span><br>
            </div>
        </div>

        <div class="row mt-4" style="padding-bottom: 0; padding-left: 20;padding-right: 20;padding-top: 0px;">
            <div class="table-responsive">
                <table class="table">
                    <thead style="margin-right: 10px;">
                        <tr>
                            <th style="background-color: #FFA500;">DESCRIPTION</th>
                            <th style="background-color: #FFA500;text-align: center;">DEBIT (RM)</th>
                            <th style="background-color: #FFA500;text-align: center;">CREDIT (RM)</th>
                        </tr>
                    </thead>
                    <tbody id="invoiceItemView"></tbody>
                </table>
            </div>
        </div>

        <div class="row mt-4">
            <div style="padding-right: 30px; padding-left: 60px; margin-bottom: 18px;">
                <div class="row mt-4">
                    <div class="col-sm-4 col-12"></div>
                    <div class="col-sm-8 col-12">
                        <div class="text-sm-right">
                            <div class="row">
                                <div class="col-sm-8 col-7 grand-total-amount bg-color-title">
                                    <h4 style="padding-right: 10px; padding-left: 180px; margin-top: 16px;">TOTAL AMOUNT (RM):</h4>
                                </div>
                                <div class="col-sm-4 col-5 grand-total-amount bg-color-amount">
                                    <h4 id="actual_amount_view" style="padding-right: 10px; padding-left: 130px; margin-top: 16px;">0.00</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div style="padding-bottom: 5px;">
                <p style="font-size: 11px; font-weight: 600;">
                    By making payment of this invoice, or in part thereof, I / We grant permission to Tadika Suria Intelek to use my / our
                    personal information to be processed and shared with the relevant Data Processors & Data Users for the purposes of the running
                    of the educational activities of Tadika Suria Intelek, in compliance with the Personal Data Protection Act 2010.
                </p>
            </div>
        </div>

    </div>

    <div class="col-lg-3 col-xs-12 col-md-12 p-4 fill border-right psbar" style="overflow:auto;max-height:80vh!important;position:relative!important">

        <form id="formPayment" action="billing/payment" method="POST" enctype="multipart/form-data">

            <div class="row mt-2">
                <div class="col-lg-12">
                    <div class="alert alert-primary" role="alert">
                        Payment Information
                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label> Payment Date <span class="text-danger">*</span> </label>
                        <input type="date" id="payment_date" name="payment_date" class="form-control" required>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label> Payment Amount <span class="text-danger">*</span> </label>
                        <input type="number" id="payment_amount" name="payment_amount" min="0" step="0.01" class="form-control" required>
                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label> Payment Via <span class="text-danger">*</span> </label>
                        <select id="payment_via" name="payment_via" class="form-control" required>
                            <option value=""> - Select - </option>
                            <option value="CDM">CDM</option>
                            <option value="ONLINE TRANSFER">ONLINE TRANSFER</option>
                            <option value="CASH">CASH</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label> Remarks </label>
                        <textarea id="payment_remark" name="payment_remark" class="form-control" rows="4"></textarea>
                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label> Upload Payment Receipt <span class="text-danger">*</span> </label>
                        <input type="file" id="payment_receipt_file" name="payment_receipt_file" class="form-control" accept="image/x-png,image/jpeg,image/jpg, .pdf" required>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-lg-12">
                    <span class="text-danger mb-2">* Indicates a required field</span>
                    <center class="mt-4">
                        <input type="hidden" id="student_id" name="student_id" class="form-control" readonly>
                        <input type="hidden" id="billing_id" name="billing_id" class="form-control" readonly>
                        <button type="submit" id="submitBtn" class="btn btn-success"> <i class='fa fa-save'></i> Save </button>
                    </center>
                </div>
            </div>

        </form>

    </div>
</div>

<style>
    .inv--total-amounts .grand-total-title h4,
    .inv--total-amounts .grand-total-amount h4 {
        position: relative;
        font-weight: 600;
        font-size: 12px;
        margin-bottom: 0;
        padding: 0;
        color: #0e1726;
        display: inline-block;
        letter-spacing: 1px;
    }

    .bg-color-title {
        background: linear-gradient(120deg, #fff 15%, #fdcd3b 15%);
        /* -webkit-print-color-adjust: exact; */
    }

    .bg-color-amount {
        background: linear-gradient(120deg, #fdcd3b 15%, #FF8C00 15%);
        /* -webkit-print-color-adjust: exact; */
        /* font-size: 11px; */
    }
</style>

<script>
    function getPassData(baseUrl, token, data) {
        $('#billing_id').val(data.billing_id);
        $('#student_id').val(data.student_id);
        $('#payment_amount').val(data.amount);
        $('#payment_amount').attr('max', data.amount);

        viewInvoice(data.billing_id, baseUrl);

        'use strict';

        document.addEventListener('DOMContentLoaded', function() {
            (function() {
                const scrollBar = document.getElementsByClassName('psbar');
                new PerfectScrollbar(scrollBar, {
                    suppressScrollX: true,
                    suppressScrollY: true,
                    maxScrollbarLength: 200,
                    theme: 'dark',
                    handlers: ['click-rail', 'drag-scrollbar', 'wheel', 'touch'],
                    wheelPropagation: false,
                    useBothWheelAxes: true,
                });
            })();
        });
    }

    async function viewInvoice(id, baseUrl) {
        const res = await callApi('post', "billing/getInvDetailByInvoiceID", id);
        const data = res.data;
        $("#logoSchoolview").attr("src", baseUrl + "public/upload/school_logo/logo2.png");

        $('#user_salutation').text(data.user_salutation);
        $('#user_fullname_view').text(data.user_fullname);
        $('#user_preferred_name_view').text(data.user_preferred_name);
        $('#user_email_view').text(data.user_email);
        $('#user_contact_no_view').text(data.user_contact_no);
        $('#user_address_view').text(data.user_address);
        $('#user_postcode_view').text(data.user_postcode);
        $('#user_city_view').text(data.user_city);
        $('#user_state_view').text(data.user_state);

        $('#stud_name_view').text(data.stud_name);
        $('#stud_preferred_name').text(data.stud_preferred_name);
        $('#stud_nric').text(data.stud_nric);
        $('#stud_matric_no_view').text(data.stud_matric_no);
        $('#stud_race').text(data.stud_race);
        $('#stud_dob').text(moment(data.stud_dob).format("DD/MM/YYYY"));
        $('#user_relation').text(data.user_relation);

        $('#invoice_no_view').text(data.invoice_no);
        $('#actual_amount_view').text(data.actual_amount);
        $('#invoice_issue_date_view').text(moment(data.invoice_issue_date).format("DD/MM/YYYY"));
        $('#invoice_payment_date_view').text(moment(data._view).format("DD/MM/YYYY"));

        $('#academic_name_view').text(data.academic_name);
        $('#level_name_view').text(data.level_name);
        $('#class_name_view').text(data.class_name);

        viewInvoiceItem(data.billing_id);

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
        $('#payment_date').val(today);

    }

    async function viewInvoiceItem(billingID) {
        const res = await callApi('post', "billing/getInvItemByBillingID", billingID);
        // check if request is success
        if (isSuccess(res)) {
            $('#invoiceItemView').html(res.data);
        } else {
            noti(res.status); // show error message
        }
    }

    $("#formPayment").submit(function(event) {
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
                    const res = await submitApi(url, form.serializeArray(), 'formPayment');
                    if (isSuccess(res)) {
                        const stud_id = $('#student_id').val();
                        if (res.status == 200) {
                            getDataList(stud_id);
                            setTimeout(function() {
                                $('#generalModal-fullscreen').modal('hide');
                            }, 200);
                        }
                    }
                }
            }
        );
    });
</script>