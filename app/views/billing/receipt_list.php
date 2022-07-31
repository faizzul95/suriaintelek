@extends('app.templates.blade')

@section('content')

<h4 class="py-3 breadcrumb-wrapper mb-4">
    <span class="text-muted fw-light"> Payment /</span> List
</h4>

<div class="card">
    <div class="card-header border-bottom">
        <h5 class="card-title">
            Payment List
            <button type="button" class="btn btn-warning btn-sm float-end ms-2" onclick="getDataList()" title="Refresh">
                <i class="fa fa-refresh"></i>
            </button>
            <select id="status_filter" class="form-control form-control-sm float-end" onchange="getDataList()" style="width: 12%!important;">
                <option value="">All</option>
                <option value="0">PROCESSING</option>
                <option value="1">ACCEPTED</option>
                <option value="2">DECLINED</option>
                <option value="3">OTHERS</option>
            </select>
        </h5>
    </div>

    <!-- <div class="card-body"> -->
    <div id="nodatadiv" style="display: none;"> {{ nodata() }} </div>
    <div id="dataListDiv" class="card-datatable table-responsive" style="display: none;">
        <table id="dataList" class="table border-top" width="100%">
            <thead class="table-dark table border-top">
                <tr>
                    <th width="2%"> Receipt No </th>
                    <th width="2%"> Invoice No </th>
                    <th> Payor Name </th>
                    <th> Date </th>
                    <th> Amount (RM) </th>
                    <th> Payment Via </th>
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
        setTimeout(function() {
            getDataList();
        }, 20);
    });

    async function getDataList() {
        var status = $('#status_filter').val();
        generateDatatable('dataList', 'serverside', 'billing/getPaymentListDt', 'nodatadiv', {
            'status': status
        });
    }

    async function paymentView(id) {
        const res = await callApi('post', "billing/getPaymentDetailByID", id);
        loadFileContent('billing/_paymentView.php', 'generalContent', 'xl', 'Payment View', res.data);
    }
</script>

@endsection