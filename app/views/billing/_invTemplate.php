<script src="framework/js/printThis.js"></script>

<div id="printInv">

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

    <div class="row" style="padding-bottom: 0; padding-left: 20;padding-right: 20;padding-top: 0px;">
        <div class="col-sm-7">
            <h1 style="color: rgb(255, 140, 0); font-size: 40px; text-align: left; font-weight: 800; margin-bottom: 10px; margin-top: 10px;">
                PROFORMA INVOICE</h1>
            <h6 style="text-align: left; margin-left: 5px; font-size: 14px;">
                <span style="color: rgb(255, 165, 0);">
                    INVOICE NO :
                </span>
                <span id="invoice_no"> (INV NO HERE)</span> <br>
                <span style="color: rgb(255, 165, 0);">
                    INVOICE DATE :
                </span>
                <span id="invoice_issue_date"> (INV ISSUE DATE HERE) </span>
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
            <img id="logoSchool" class="img-fluid" width="80%">
        </div>
    </div>

    <hr>

    <div class="row" style="padding-bottom: 0; padding-left: 20;padding-right: 20;padding-top: 0px;">
        <div class="col-sm-6">
            <span id="user_fullname" style="color: #FFA500;">Parent Full Name</span> <br>
            <span id="user_address">Address</span><br>
            <span id="user_postcode">Postcode</span>, <span id="user_city">City</span><br>
            <span id="user_state">State</span><br>
        </div>
        <div class="col-sm-6" style="padding-left: 10;">
            Student Name : <span id="stud_name"></span> <br>
            Matric No : <span id="stud_matric_no">-</span><br>
            Academic :<span id="academic_name">-</span><br>
            Level : <span id="level_name">-</span><br>
            Class : <span id="class_name">-</span><br>
            Due Date : <span id="invoice_payment_date">-</span><br>
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
                <tbody id="invoiceItem">
                    <tr>
                        <td>Registration Fee</td>
                        <td style="border-left: thin solid rgb(192, 192, 192); text-align: center;">50.00</td>
                        <td style="border-left: thin solid rgb(192, 192, 192); text-align: center;"></td>
                    </tr>
                    <!--   <tr>
                    <td>School Item <br>
                        <ol>
                            <li>Stationery</li>
                            <li>Color</li>
                            <li>Photostate</li>
                        </ol>
                    </td>
                    <td style="border-left: thin solid rgb(192, 192, 192); text-align: center;">50.00</td>
                    <td style="border-left: thin solid rgb(192, 192, 192); text-align: center;"></td>
                </tr>
                <tr>
                    <td> Book <br>
                        <ol>
                            <li>Textbook</li>
                            <li>Activity</li>
                            <li>Notebook</li>
                        </ol>
                    </td>
                    <td style="border-left: thin solid rgb(192, 192, 192); text-align: center;">160.00</td>
                    <td style="border-left: thin solid rgb(192, 192, 192); text-align: center;"></td>
                </tr>
                <tr>
                    <td>Uniform
                        <ol>
                            <li> 2 PAIRS (UNIFORM/T-SHIRT TRACKSUIT)</li>
                        </ol>
                    </td>
                    <td style="border-left: thin solid rgb(192, 192, 192); text-align: center;">80.00</td>
                    <td style="border-left: thin solid rgb(192, 192, 192); text-align: center;"></td>
                </tr> -->
                </tbody>
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
                                <h4 style="padding-right: 10px; padding-left: 150px; margin-top: 16px;">TOTAL AMOUNT (RM):</h4>
                            </div>
                            <div class="col-sm-4 col-5 grand-total-amount bg-color-amount">
                                <h4 id="actual_amount" style="padding-right: 10px; padding-left: 120px; margin-top: 16px;">0.00</h4>
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

<!-- <div class="row mt-2">
    <center>
        <button id="printInvBtn" class="btn btn-dark btn-md" onclick="printData('printInv', this.id)"><i class="fas fa-print"> </i> Print</button>
    </center>
</div> -->

<script>
    // get data array from general function
    function getPassData(baseUrl, token, data) {
        $("#logoSchool").attr("src", baseUrl + "public/upload/school_logo/logo2.png");

        $('#application_id').val(data.application_id);
        $('#application_no').text(data.application_no);

        $('#user_salutation').text(data.user_salutation);
        $('#user_fullname').text(data.user_fullname);
        $('#user_preferred_name').text(data.user_preferred_name);
        $('#user_email').text(data.user_email);
        $('#user_contact_no').text(data.user_contact_no);
        $('#user_address').text(data.user_address);
        $('#user_postcode').text(data.user_postcode);
        $('#user_city').text(data.user_city);
        $('#user_state').text(data.user_state);

        $('#stud_name').text(data.stud_name);
        $('#stud_preferred_name').text(data.stud_preferred_name);
        $('#stud_nric').text(data.stud_nric);
        $('#stud_matric_no').text(data.stud_matric_no);
        $('#stud_race').text(data.stud_race);
        $('#stud_dob').text(moment(data.stud_dob).format("DD/MM/YYYY"));
        $('#user_relation').text(data.user_relation);

        $('#invoice_no').text(data.invoice_no);
        $('#actual_amount').text(data.actual_amount);
        $('#invoice_issue_date').text(moment(data.invoice_issue_date).format("DD/MM/YYYY"));
        $('#invoice_payment_date').text(moment(data.invoice_payment_date).format("DD/MM/YYYY"));
        getInvoiceItem(data.billing_id);
    }

    async function getInvoiceItem(billingID) {
        const res = await callApi('post', "billing/getInvItemByBillingID", billingID);
        // check if request is success
        if (isSuccess(res)) {
            $('#invoiceItem').html(res.data);
        } else {
            noti(res.status); // show error message
        }
    }
</script>