@extends('app.templates.blade')

@section('content')

<h4 class="py-3 breadcrumb-wrapper mb-4">
    <span class="text-muted fw-light"> Billing /</span> Settings
</h4>

<!-- List Table -->
<div class="row">

    <!-- table item -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title">
                    List Item
                    <button type="button" class="btn btn-warning btn-sm float-end ms-2" onclick="getDataList()" title="Refresh">
                        <i class="fa fa-refresh"></i>
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm float-end" onclick="invTemplate()">
                        <i class="fa fa-plus"></i> Invoice Template
                    </button>
                    <!-- <button type="button" class="btn btn-secondary btn-sm float-end" onclick="formModal()">
                <i class="fa fa-plus"></i> Add Level
            </button> -->
                </h5>
            </div>
            <div id="nodatadiv" style="display: none;"> {{ nodata() }} </div>
            <div id="dataListDiv" class="card-datatable table-responsive" style="display: none;">
                <table id="dataList" class="table border-top" width="100%">
                    <thead class="table-dark table border-top">
                        <tr>
                            <th> Name </th>
                            <th> Description </th>
                            <th> Price (RM)</th>
                            <th width="2%"> Action </th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- table preset  -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title">
                    Preset Billing
                    <button type="button" class="btn btn-warning btn-sm float-end ms-2" onclick="getDataPresetList()" title="Refresh">
                        <i class="fa fa-refresh"></i>
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm float-end" onclick="formModalPreset()">
                        <i class="fa fa-plus"></i> Add Preset
                    </button>
                </h5>
            </div>
            <div id="nodatadivPreset" style="display: none;"> {{ nodata() }} </div>
            <div id="dataListPresetDiv" class="card-datatable table-responsive" style="display: none;">
                <table id="dataListPreset" class="table border-top" width="100%">
                    <thead class="table-dark table border-top">
                        <tr>
                            <th> Name </th>
                            <th> Category </th>
                            <th> Status</th>
                            <th width="2%"> Action </th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!--end::Row-->

<script type="text/javascript">
    $(document).ready(function() {
        getDataList();
        getDataPresetList();
    });

    // server side datatable
    async function getDataList() {
        generateDatatable('dataList', 'serverside', 'itemFee/getListDt', 'nodatadiv');
    }

    async function updateRecord(id) {
        const res = await callApi('post', "itemFee/getItemByID", id);
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
                    const res = await deleteApi(id, 'itemFee/delete', getDataList);
                }
            }
        );
    }

    function formModal(type = 'create', data = null) {
        const modalTitle = (type == 'create') ? 'Register Item' : 'Update Item';
        const urlForm = (type == 'create') ? 'itemFee/create' : 'itemFee/update';
        // loadFormContent(fileToLoad, modalBodyID, modalSize, urlForm, modalTitle, data, modalType);
        loadFormContent('billing/_itemForm.php', 'generalContent', 'md', urlForm, modalTitle, data, 'offcanvas');
    }

    // Prest Table

    // server side datatable
    async function getDataPresetList() {
        generateDatatable('dataListPreset', 'serverside', 'billing/getPresetListDt', 'nodatadivPreset');
    }

    async function updatePresetRecord(id) {
        const res = await callApi('post', "billing/getPresetByID", id);
        // check if request is success
        if (isSuccess(res)) {
            formModalPreset('update', res.data);
        } else {
            noti(res.status); // show error message
        }
    }

    function deletePresetRecord(id) {
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
                    const res = await deleteApi(id, 'billing/delete', getDataList);
                }
            }
        );
    }

    function formModalPreset(type = 'create', data = null) {
        const modalTitle = (type == 'create') ? 'Register Preset Invoice' : 'Update Preset Invoice';
        // const urlForm = (type == 'create') ? 'billing/presetCreate' : 'billing/presetUpdate';
        loadFormContent('billing/_presetInvForm.php', 'generalContent', 'lg', 'billing/presetSave', modalTitle, data);
    }

    function invTemplate(data = null) {
        loadFileContent('billing/_invTemplate.php', 'generalContent', 'xl', 'Invoice Template', null);
    }
</script>

@endsection