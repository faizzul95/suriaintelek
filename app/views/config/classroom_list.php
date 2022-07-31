@extends('app.templates.blade')

@section('content')

<h4 class="py-3 breadcrumb-wrapper mb-4">
    <span class="text-muted fw-light"> Settings /</span> Classroom
</h4>

<!-- List Table -->
<div class="card">
    <div class="card-header border-bottom">
        <h5 class="card-title">
            List Classroom
            <button type="button" class="btn btn-warning btn-sm float-end ms-2" onclick="getDataList()" title="Refresh">
                <i class="fa fa-refresh"></i>
            </button>
            <button type="button" class="btn btn-secondary btn-sm float-end" onclick="formModal()">
                <i class="fa fa-plus"></i> Add Classroom
            </button>
        </h5>
    </div>
    <div id="nodatadiv" style="display: none;"> {{ nodata() }} </div>
    <div id="dataListDiv" class="card-datatable table-responsive" style="display: none;">
        <table id="dataList" class="table border-top" width="100%">
            <thead class="table-dark table border-top">
                <tr>
                    <th> Classroom Name </th>
                    <th> Max Student </th>
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
        generateDatatable('dataList', 'serverside', 'classroom/getListDt', 'nodatadiv');
    }

    async function updateRecord(id) {
        const res = await callApi('post', "classroom/getClassroomByID", id);
        // check if request is success
        if (isSuccess(res)) {
            formModal('update', res.data);
        } else {
            noti(res.status); // show error message
        }
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
                    const res = await deleteApi(id, 'classroom/delete', getDataList);
                }
            }
        );
    }

    function formModal(type = 'create', data = null) {
        const modalTitle = (type == 'create') ? 'Register Classroom' : 'Update Classroom';
        const urlForm = (type == 'create') ? 'classroom/create' : 'classroom/update';
        loadFormContent('config/_classroomForm.php', 'generalContent', 'md', urlForm, modalTitle, data);
    }
</script>

@endsection