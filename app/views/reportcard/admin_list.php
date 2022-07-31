@extends('app.templates.blade')

@section('content')

<h4 class="py-3 breadcrumb-wrapper mb-4">
    <span class="text-muted fw-light"> Report Card
</h4>

<!-- List Table -->
<div class="row">

    <!-- table classroom -->
    <div class="col-xl-2 col-lg-2 col-md-12">
        <h5> List Levels </h5>
        <div id="dataListLevel" class="row"></div>

        <input type="hidden" id="levelStudent">
    </div>

    <div class="col-lg-10 col-md-12">
        <div id="nodatadiv"> {{ noSelectDataLeft('level') }} </div>
        <div id="showData" style="display: none">

            <div class="row g-4">
                <div class="col-4">
                    <label class="form-label"> Academic Year </label>
                    <select id="year_filter" class="form-control" onchange="getDateFilterList()">
                    </select>
                </div>

                <div class="col-4">
                    <label class="form-label"> Month </label>
                    <select id="month_filter" class="form-control" onchange="getDateFilterList()">
                        <option value="01"> 01 - January </option>
                        <option value="02"> 02 - Febuary </option>
                        <option value="03"> 03 - March </option>
                        <option value="04"> 04 - April </option>
                        <option value="05"> 05 - May </option>
                        <option value="06"> 06 - June </option>
                        <option value="07"> 07 - July </option>
                        <option value="08"> 08 - August </option>
                        <option value="09"> 09 - September </option>
                        <option value="10"> 10 - October </option>
                        <option value="11"> 11 - November </option>
                        <option value="12"> 12 - December </option>
                    </select>
                </div>

                <div class="col-4">
                    <label class="form-label"> Date </label>
                    <select id="date_filter" class="form-control" onchange="getDataStudentList()">
                        <option value=""> - Select - </option>
                    </select>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div id="dataListDiv" class="card-datatable table-responsive"></div>
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
        const res = await callApi('post', "level/getListLevelDiv");

        // check if request is success
        if (isSuccess(res)) {
            $('#dataListLevel').append(res.data);
        } else {
            noti(res.status); // show error message
        }
    }

    async function getSelectAcademic() {
        const res = await callApi('post', "academicyear/getSelectAcademic");

        if (isSuccess(res)) {
            $('#year_filter').html(res.data);

            var date = new Date();
            $('#month_filter option:eq(' + date.getMonth() + ')').prop('selected', true);
        }
    }

    async function getData(id) {
        getSelectAcademic();
        setTimeout(function() {
            getDateFilterList();
            getDataStudentList();
        }, 100);

        $('#showData').show();
        $('#nodatadiv').hide();

        $('.cardColor').removeClass("bg-primary text-white");
        $('#card-' + id).addClass("bg-primary text-white");

        $('.textColor').removeClass("text-white");
        $('#text-' + id).addClass("text-white");

        $('#levelStudent').val(id);
    }

    async function getDateFilterList() {

        var month = $('#month_filter').val();
        var year = $('#year_filter').find(':selected').text();

        const res = await callApi('post', "reportcard/getDaysListSelectByYearMonth", {
            'month': month,
            'year': $.trim(year),
        });

        if (isSuccess(res)) {
            $('#date_filter').html(res.data);
            getDataStudentList();
        } else {
            noti(res.status); // show error message
        }

    }

    async function getDataStudentList() {

        var year = $('#year_filter').find(':selected').text();

        const res = await callApi('post', "reportcard/getReportCard", {
            'level_id': $('#levelStudent').val(),
            'month': $('#month_filter').val(),
            'year': $.trim(year),
            'date': $('#date_filter').val(),
        });

        if (isSuccess(res)) {
            $('#dataListDiv').html(res.data);
        } else {
            noti(res.status); // show error message
        }

    }

    function createReportCard() {
        cuteAlert({
            type: 'question',
            title: 'Are you sure want to make a report card?',
            message: 'This will take some time to completed !',
            closeStyle: 'circle',
            cancelText: 'Abort',
            confirmText: 'Yes, Confirm!',
        }).then(
            async (e) => {
                if (e == 'confirm') {

                    $.blockUI({
                        message: '<div class="d-flex justify-content-center"><p class="mb-0">Please wait...</p></div>',
                        css: {
                            backgroundColor: 'transparent',
                            color: '#fff',
                            border: '0'
                        },
                        overlayCSS: {
                            opacity: 0.35
                        }
                    });

                    var year = $('#year_filter').find(':selected').text();

                    const res = await callApi('post', "reportcard/create", {
                        'level_id': $('#levelStudent').val(),
                        'report_month': $('#month_filter').val(),
                        'report_year': $.trim(year),
                        'report_date': $('#date_filter').val(),
                    });

                    if (isSuccess(res)) {
                        getDataStudentList();
                        noti(res.status, 'Report create');
                        $.unblockUI();
                    } else {
                        noti(500, 'Report card create unsuccessfully!');
                    }
                }
            }
        );
    }

    function removeReportCard() {
        cuteAlert({
            type: 'question',
            title: 'Are you sure want to remove this report card?',
            message: 'Records will be permanently deleted !',
            closeStyle: 'circle',
            cancelText: 'Abort',
            confirmText: 'Yes, Confirm!',
        }).then(
            async (e) => {
                if (e == 'confirm') {

                    $.blockUI({
                        message: '<div class="d-flex justify-content-center"><p class="mb-0">Please wait...</p></div>',
                        css: {
                            backgroundColor: 'transparent',
                            color: '#fff',
                            border: '0'
                        },
                        overlayCSS: {
                            opacity: 0.35
                        }
                    });

                    var year = $('#year_filter').find(':selected').text();

                    const res = await callApi('post', "reportcard/delete", {
                        'level_id': $('#levelStudent').val(),
                        'report_month': $('#month_filter').val(),
                        'report_year': $.trim(year),
                        'report_date': $('#date_filter').val(),
                    });

                    if (isSuccess(res)) {
                        getDataStudentList();
                        noti(res.status, 'Report create');
                        $.unblockUI();
                    } else {
                        noti(500, 'Report card create unsuccessfully!');
                    }
                }
            }
        );
    }

    async function viewAssessmentReport(id) {
        const res = await callApi('post', "reportcard/getReportIDByFilter", {
            'report_id': id,
            'level_id': $('#levelStudent').val(),
            'report_date': $('#date_filter').val(),
        });
        loadFileContent('reportcard/_assessmentView.php', 'generalContent', 'fullscreen', 'Assessment View', res.data);
    }
</script>

@endsection