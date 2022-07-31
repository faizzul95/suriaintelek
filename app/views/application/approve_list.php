@extends('app.templates.blade')

@section('content')

<h4 class="py-3 breadcrumb-wrapper mb-4">
    <span class="text-muted fw-light"> Application /</span> Approved Application
</h4>

<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span>New Application</span>
                        <div class="d-flex align-items-end mt-2">
                            <h2 class="mb-0 me-2" id="newApp">0</h2>
                        </div>
                    </div>
                    <span class="badge bg-label-warning rounded p-2">
                        <i class="bx bx-user-plus bx-lg"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span>Approved Application</span>
                        <div class="d-flex align-items-end mt-2">
                            <h2 class="mb-0 me-2" id="enrolApp">0</h2>
                        </div>
                    </div>
                    <span class="badge bg-label-primary rounded p-2">
                        <i class="bx bx-group bx-lg"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span>Rejected Application</span>
                        <div class="d-flex align-items-end mt-2">
                            <h2 class="mb-0 me-2" id="rejectApp">0</h2>
                        </div>
                    </div>
                    <span class="badge bg-label-danger rounded p-2">
                        <i class="bx bx-user-minus bx-lg"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header border-bottom">
        <h5 class="card-title">
            Approved Application
            <button type="button" class="btn btn-warning btn-sm float-end ms-2" onclick="getDataList()" title="Refresh">
                <i class="fa fa-refresh"></i>
            </button>
            <!-- <button type="button" class="btn btn-secondary btn-sm float-end" onclick="formModal()">
                <i class="fa fa-plus"></i> Add New Application
            </button> -->
        </h5>
    </div>

    <!-- <div class="card-body"> -->
    <div id="nodatadiv" style="display: none;"> {{ nodata() }} </div>
    <div id="dataListDiv" class="card-datatable table-responsive" style="display: none;">
        <table id="dataList" class="table border-top" width="100%">
            <thead class="table-dark table border-top">
                <tr>
                    <th width="2%"> Application No </th>
                    <th> Applicant Name </th>
                    <th> Student Name </th>
                    <th> Approval Date </th>
                    <th width="2%"> Status </th>
                    <th width="2%"> Action </th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <!-- </div> -->

</div>
<!--end::Row-->

<script type="text/javascript">
    $(document).ready(function() {
        getDataList();
    });

    async function getDataList() {
        countApplication();
        generateDatatable('dataList', 'serverside', 'admission/getListApproveDt', 'nodatadiv');
    }

    async function viewApplication(id) {
        const res = await callApi('post', "admission/getAppDetailByID", id);
        // check if request is success
        if (isSuccess(res)) {
            loadFileContent('application/_applicationView.php', 'generalContent', 'lg', 'Application View', res.data);
        } else {
            noti(res.status); // show error message
        }
    }

    async function countApplication() {
        const res = await callApi('post', "admission/countApplication");
        // check if request is success
        if (isSuccess(res)) {
            const data = res.data;
            $('#enrolApp').html(data.enrol);
            $('#newApp').html(data.new);
            $('#rejectApp').html(data.reject);
        } else {
            noti(res.status); // show error message
        }
    }

    async function approveApplication(id) {
        const res = await callApi('post', "admission/getAppDetailByID", id);
        loadFileContent('application/_approveRegForm.php', 'generalContent', 'fullscreen', 'Registration Approval Form', res.data);
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