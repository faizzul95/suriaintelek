@extends('app.templates.blade')

@section('content')

<style>
    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        color: white;
        background-color: #5a8dee;
    }
</style>

<h4 class="py-3 breadcrumb-wrapper mb-4">
    <span class="text-muted fw-light"> Attendance /</span> Report
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
                    <select id="year_filter" class="form-control" onchange="getDataStudentList()">
                    </select>
                </div>

                <div class="col-4">
                    <label class="form-label"> Month </label>
                    <select id="month_filter" class="form-control" onchange="getDataStudentList()">
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
                    <label class="form-label"> Week </label>
                    <select id="week_filter" class="form-control" onchange="getDataStudentList()">
                        <option value="01"> Week 1 </option>
                        <option value="02"> Week 2 </option>
                        <option value="03"> Week 3 </option>
                        <option value="04"> Week 4 </option>
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
            var week = getISOWeekInMonth(date);

            $('#month_filter option:eq(' + date.getMonth() + ')').prop('selected', true);
            $('#week_filter option:eq(' + (week - 1) + ')').prop('selected', true);
        }
    }

    function getISOWeekInMonth(date) {
        // Copy date so don't affect original
        var d = new Date(+date);
        if (isNaN(d)) return;
        // Move to previous Monday
        d.setDate(d.getDate() - d.getDay() + 1);
        // Week number is ceil date/7
        return Math.ceil(d.getDate() / 7);
    }

    async function getData(id) {
        getSelectAcademic();
        setTimeout(function() {
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

    async function getDataStudentList() {

        var month = $('#month_filter').val();
        var year = $('#year_filter').find(':selected').text();
        var week = $('#week_filter').val();
        var level_id = $('#levelStudent').val();

        const res = await callApi('post', "student/getListEnrollStudentBylevelID", {
            'level_id': level_id,
            'month': month,
            'year': $.trim(year),
            'week': week,
        });

        if (isSuccess(res)) {
            $('#dataListDiv').html(res.data);
        } else {
            noti(res.status); // show error message
        }

    }
</script>

@endsection