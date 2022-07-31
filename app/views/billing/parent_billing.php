@extends('app.templates.blade')

@section('content')

<style>
    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        color: white;
        background-color: #5a8dee;
    }
</style>

<h4 class="py-3 breadcrumb-wrapper mb-4">
    <span class="text-muted fw-light"> Billing /</span> My Billing
</h4>

<!-- List Table -->
<div class="row">

    <!-- table item -->
    <div class="col-lg-3">
        <h5> List student </h5>
        <div id="dataListStud" class="row">
        </div>
    </div>

    <div class="col-lg-9">
        <div id="nodatadiv"> {{ noStudentSelect() }} </div>
        <div id="showData" class="card p-4" style="display: none">
            <div class="row">
                <div class="col-lg-3">
                    <center>
                        <img src="" id="studentAvatarUpdate" class="img-fluid" width="100%">
                    </center>
                </div>
                <div class="col-lg-9">

                    <div class="col-lg-12">
                        <div class="alert alert-primary" role="alert">
                            <h6 class="alert-heading fw-bold mb-1">Student Details</h6>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-lg-4">
                            <label style="color : #b3b3cc"> Matric No. </label><br>
                            <span id="studMatric_no" style="font-weight:bold"> - </span>
                        </div>

                        <div class="col-lg-8">
                            <div class="form-group">
                                <label style="color : #b3b3cc"> Student Name </label><br>
                                <span id="studName" style="font-weight:bold"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-lg-4">
                            <label style="color : #b3b3cc"> NRIC / Passport </label><br>
                            <span id="studNric" style="font-weight:bold"></span>
                        </div>
                        <div class="col-lg-4">
                            <label style="color : #b3b3cc"> Academic </label><br>
                            <span id="studAcademic" style="font-weight:bold"> - </span>
                        </div>
                        <div class="col-lg-4">
                            <label style="color : #b3b3cc"> Level / Class </label><br>
                            <span id="studLevel" style="font-weight:bold"> - / - </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="alert alert-primary" role="alert">
                    <h6 class="alert-heading fw-bold mb-1">Billing Details</h6>
                </div>
                <div class="nav-align-top">
                    <ul class="nav nav-pills nav-fill" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-invoice" aria-controls="navs-pills-justified-invoice" aria-selected="true">
                                <i class="fas fa-file-invoice" aria-hidden="true"></i>
                                Invoice
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-payment" aria-controls="navs-pills-justified-payment" aria-selected="false">
                                <i class="fas fa-receipt" aria-hidden="true"></i>
                                Payment History
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="navs-pills-justified-invoice" role="tabpanel">
                        <div id="nodatadivBill"> {{ nodata() }} </div>
                        <div id="dataListInv" class="card-datatable table-responsive" style="display: none;">
                        </div>
                    </div>
                    <div class="tab-pane fade" id="navs-pills-justified-payment" role="tabpanel">
                        <div id="nodatadivPay"> {{ nodata() }} </div>
                        <div id="dataListPay" class="card-datatable table-responsive" style="display: none;">
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
<!--end::Row-->

<script type="text/javascript">
    $(document).ready(function() {
        getDataListStud('{{ $userID }}');
    });

    async function getDataListStud(id) {
        const res = await callApi('post', "student/getListChildren", id);
        // check if request is success
        if (isSuccess(res)) {
            $('#dataListStud').append(res.data);
        } else {
            noti(res.status); // show error message
        }
    }

    async function getData(id) {
        const res = await callApi('post', "student/getStudentBillingByID", id);
        var path = "{{ asset('') }}";

        // check if request is success
        if (isSuccess(res)) {
            $('#showData').show();
            $('#nodatadiv').hide();

            $('#studentAvatarUpdate').attr("src", path + res.data.stud_image);
            $('#studMatric_no').text(res.data.stud_matric_no);
            $('#studName').text(res.data.stud_name);
            $('#studNric').text(res.data.stud_nric);
            $('#studAcademic').text(res.data.academic_name);
            $('#studLevel').text(res.data.level_name + ' / ' + res.data.class_name);

            $('.cardColor').removeClass("bg-primary text-white");
            $('#card-' + id).addClass("bg-primary text-white");

            $('.textColor').removeClass("text-white");
            $('#text-' + id).addClass("text-white");

            getDataList(id);
        } else {
            noti(res.status); // show error message
        }
    }

    // server side datatable
    async function getDataList(id) {
        const res = await callApi('post', "billing/getListAccordionInvoiceByStudID", {
            'stud_id': id,
            'billing_type': 0
        });

        $('#dataListInv').empty();
        $('#dataListPay').empty();

        if (isSuccess(res)) {

            if (res.data != '') {
                $('#nodatadivBill').hide();
                $('#dataListInv').show();
                $('#dataListInv').html(res.data);
            } else {
                $('#nodatadivBill').hide();
                $('#dataListInv').empty();
                $('#dataListInv').html("<div id='nodata' class='col-lg-12 mb-2 mt-5'>\
                                    <center>\
                                        <img src='public/framework/img/nodata/6.png' class='img-fluid mb-4' width='50%'>\
                                        <h6 style='letter-spacing :2px; font-family: Quicksand, sans-serif !important;margin-bottom:25px'>\
                                        <strong> NO INFORMATION FOUND </strong>\
                                        </h6>\
                                    </center>\
                                    </div>");
            }

        } else {
            noti(res.status);
        }

        const res2 = await callApi('post', "billing/getListAccordionPaymentByStudID", id);
        if (isSuccess(res2)) {
            if (res2.data != '') {
                $('#nodatadivPay').hide();
                $('#dataListPay').show();
                $('#dataListPay').html(res2.data);
            } else {
                $('#dataListPay').hide();
                $('#dataListPay').empty();
                $('#nodatadivPay').html("<div id='nodata' class='col-lg-12 mb-2 mt-5'>\
                                    <center>\
                                        <img src='public/framework/img/nodata/6.png' class='img-fluid mb-4' width='50%'>\
                                        <h6 style='letter-spacing :2px; font-family: Quicksand, sans-serif !important;margin-bottom:25px'>\
                                        <strong> NO INFORMATION FOUND </strong>\
                                        </h6>\
                                    </center>\
                                    </div>");
            }
        } else {
            noti(res2.status);
        }

    }

    async function paymentForm(id, stud_id, amount) {
        data = {
            'billing_id': id,
            'student_id': stud_id,
            'amount': amount,
        }
        // loadFormContent('billing/_paymentForm.php', 'generalContent', 'fullscreen', 'billing/payment', 'Payment Details', data);
        loadFileContent('billing/_paymentForm.php', 'generalContent', 'fullscreen', 'Payment Details', data);

    }

    async function viewInv(id) {
        const res = await callApi('post', "billing/getInvDetailByInvoiceID", id);
        // check if request is success
        if (isSuccess(res)) {
            loadFileContent('billing/_invTemplate.php', 'generalContent', 'xl', 'Invoice', res.data);
        } else {
            noti(res.status); // show error message
        }
    }
</script>

@endsection