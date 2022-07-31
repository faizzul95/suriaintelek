@extends('app.templates.blade')

@section('content')

<h4 class="py-3 breadcrumb-wrapper mb-4">
    <span class="text-muted fw-light"> My Children</span>
</h4>

<!-- List Table -->
<div class="card">
    <div class="card-header border-bottom">
        <h5 class="card-title">
            List Children
            <button type="button" class="btn btn-warning btn-sm float-end ms-2" onclick="getDataList('{{ $user_id }}')" title="Refresh">
                <i class="fa fa-refresh"></i>
            </button>
        </h5>
    </div>
    <div id="nodatadiv" style="display: none;"> {{ nodata() }} </div>
    <div id="dataListDiv" class="card-datatable table-responsive" style="display: none;">
        <table id="dataList" class="table border-top" width="100%">
            <thead class="table-dark table border-top">
                <tr>
                    <th> Student Name </th>
                    <!-- <th> Matric No </th> -->
                    <th> Level </th>
                    <th> Class </th>
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
        setTimeout(function() {
            getDataList('{{ $user_id }}');
        }, 100);
    });

    // server side datatable
    async function getDataList(id) {
        generateDatatable('dataList', 'serverside', 'student/getListChildrenDt', 'nodatadiv', {
            'userID': id
        });
    }

    async function viewStudent(id) {
        const res = await callApi('post', "student/getStudentByID", id);
        // check if request is success
        if (isSuccess(res)) {
            loadFileContent('student/_studentView.php', 'generalContent', 'fullscreen', 'Student Information', res.data);
        } else {
            noti(res.status); // show error message
        }
    }

    async function updateRecord(id, encodeID, baseURL) {
        window.location.href = baseURL + 'student/profile/' + encodeID;
    }

    function formModal(type = 'create', data = null) {
        const modalTitle = (type == 'create') ? 'Register Student' : 'Update Student';
        const urlForm = (type == 'create') ? 'student/create' : 'student/update';
        loadFormContent('student/_studentForm.php', 'generalContent', 'xl', urlForm, modalTitle, data);
        // loadFileContent('student/_studentForm.php', 'generalContent', 'xl', 'Update Student', data);
    }
</script>

@endsection