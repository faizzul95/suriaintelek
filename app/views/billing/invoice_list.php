@extends('app.templates.blade')

@section('content')

<h4 class="py-3 breadcrumb-wrapper mb-4">
    <span class="text-muted fw-light"> Invoice /</span> List
</h4>

<div class="card">
    <div class="card-header border-bottom">
        <h5 class="card-title">
            Invoice List
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
                    <th width="2%"> Invoice No </th>
                    <th> Student Name </th>
                    <th> Type </th>
                    <th> Amount (RM) </th>
                    <th> Issue Date </th>
                    <th> Due Date </th>
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
        generateDatatable('dataList', 'serverside', 'billing/getInvoiceListDt', 'nodatadiv');
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