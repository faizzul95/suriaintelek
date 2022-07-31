@extends('app.templates.blade')

@section('content')

<h4 class="py-3 breadcrumb-wrapper mb-4">
    <span class="text-muted fw-light"> My Students </span>
</h4>

<!-- List Table -->
<div class="row">

    <!-- table classroom -->
    <div class="col-xl-2 col-lg-2 col-md-12">
        <h5> List Levels </h5>
        <div id="dataListLevel" class="row"></div>

        <input type="hidden" id="levelStudent">
    </div>

    <!-- table item -->
    <div class="col-lg-10 col-md-12">
        <div class="row mt-4">
            <div class="col-12">
                <div id="nodatadiv"> {{ noSelectDataLeft('level') }} </div>
                <div class="card" id="dataListDiv" style="display: none;">
                    <div class="card-datatable table-responsive">
                        <table id="dataList" class="table border-top" width="100%">
                            <thead class="table-dark table border-top">
                                <tr>
                                    <th> Student Name </th>
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
            </div>
        </div>
    </div>
</div>
<!--end::Row-->

<script type="text/javascript">
    $(document).ready(function() {
        getDataListLevel();
    });

    async function getDataListLevel() {
        const res = await callApi('post', "level/getListLevelTeacherDiv");

        // check if request is success
        if (isSuccess(res)) {
            $('#dataListLevel').append(res.data);
        } else {
            noti(res.status); // show error message
        }
    }

    async function getData(id) {
        $('.cardColor').removeClass("bg-primary text-white");
        $('#card-' + id).addClass("bg-primary text-white");

        $('.textColor').removeClass("text-white");
        $('#text-' + id).addClass("text-white");

        $('#levelStudent').val(id);
        getDataStudentList();
    }

    async function getDataStudentList() {
        var level_id = $('#levelStudent').val();

        generateDatatable('dataList', 'serverside', 'student/getListStudentTeacherDt', 'nodatadiv', {
            'level_id': level_id
        });

    }

    async function updateRecord(id, encodeID, baseURL) {
        window.location.href = baseURL + 'student/profile/' + encodeID;
    }
</script>

@endsection