@extends('app.templates.blade')

@section('content')

<h4 class="py-3 breadcrumb-wrapper mb-4">
    <span class="text-muted fw-light"> Users /</span> Parent
</h4>

<!-- Users List Table -->
<div class="card">
    <div class="card-header border-bottom">
        <h5 class="card-title">
            List Parent
            <button type="button" class="btn btn-warning btn-sm float-end ms-2" onclick="getDataList()" title="Refresh">
                <i class="fa fa-refresh"></i>
            </button>
        </h5>
    </div>
    <div id="nodatadiv" style="display: none;"> {{ nodata() }} </div>
    <div id="dataListDiv" class="card-datatable table-responsive" style="display: none;">
        <table id="dataList" class="table border-top" width="100%">
            <thead class="table-dark table border-top">
                <tr>
                    <th> Parent Name </th>
                    <th> Contact </th>
                    <th> Status </th>
                    <th width="2%"> Action </th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
<!--end::Row-->

<script type="text/javascript">
    $(document).ready(function() {
        getDataList();
    });

    // server side datatable
    async function getDataList() {
        generateDatatable('dataList', 'serverside', 'user/getListParentDt', 'nodatadiv');
    }

    async function viewRecord(id, encodeID, baseURL) {
        window.location.href = baseURL + 'user/parentView/' + encodeID;
    }

    function deleteRecord(id) {
        cuteAlert({
            type: 'question',
            title: 'Are you sure?',
            message: 'Records will be permanently deleted !',
            closeStyle: 'circle',
            cancelText: 'Abort',
            confirmText: 'Yes, Confirm!',
        }).then(
            async (e) => {
                if (e == 'confirm') {
                    const res = await deleteApi(id, 'academicyear/delete', getDataList);
                }
            }
        );
    }
</script>

@endsection