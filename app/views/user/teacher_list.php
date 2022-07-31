@extends('app.templates.blade')

@section('content')

<h4 class="py-3 breadcrumb-wrapper mb-4">
    <span class="text-muted fw-light"> Users /</span> Teacher
</h4>

<!-- Users List Table -->
<div class="card">
    <div class="card-header border-bottom">
        <h5 class="card-title">
            List Teacher
            <button type="button" class="btn btn-warning btn-sm float-end ms-2" onclick="getDataList()" title="Refresh">
                <i class="fa fa-refresh"></i>
            </button>
            <button type="button" class="btn btn-secondary btn-sm float-end" onclick="formModal()">
                <i class="fa fa-plus"></i> Add Teacher
            </button>
        </h5>
    </div>
    <div id="nodatadiv" style="display: none;"> {{ nodata() }} </div>
    <div id="dataListDiv" class="card-datatable table-responsive" style="display: none;">
        <table id="dataList" class="table border-top" width="100%">
            <thead class="table-dark table border-top">
                <tr>
                    <th> Teacher Name </th>
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
        generateDatatable('dataList', 'serverside', 'teacher/getListTeacherDt', 'nodatadiv');
    }

    async function viewRecord(id, encodeID, baseURL) {
        window.location.href = baseURL + 'teacher/view/' + encodeID;
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

    function formModal(type = 'create', data = null) {
        data = {
            role_id: 4
        };
        loadFormContent('user/_form.php', 'generalContent', 'lg', 'user/save', 'Register Teacher', data);
    }
</script>

@endsection