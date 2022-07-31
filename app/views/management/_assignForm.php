<form id="formAssign" action="subject/assignSave" method="POST">

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label> Teacher Name <span class="text-danger">*</span> </label>
                <select id="user_id" name="teacher_user_id" class="form-control">
                    <option value="">- Select -</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-lg-12">
            <div class="form-group">
                <label> Subject <span class="text-danger">*</span></label>
                <select id="subject_id" name="subject_id" class="form-control" required>
                    <option value="">- Select -</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-12">
            <span class="text-danger mb-2">* Indicates a required field</span>
            <center>
                <input type="hidden" id="subject_level_id" name="subject_level_id" class="form-control" readonly>
                <input type="hidden" id="level_id_assign" name="level_id" class="form-control" readonly>
                <!-- button submit must be put id "submitBtn" -->
                <button type="submit" id="submitBtn" class="btn btn-success"> <i class='fa fa-save'></i> Save </button>
            </center>
        </div>
    </div>

</form>

<script>
    function getPassData(baseUrl, token, data) {
        $('#level_id_assign').val(data.level_id);
        getListTeacher(data.level_id);
        getListSubject(data.level_id);
    }

    async function getListTeacher(levelID) {
        const res = await callApi('post', "teacher/getSelectTeacher", levelID);
        if (isSuccess(res)) {
            $('#user_id').html(res.data);
        } else {
            noti(res.status); // show error message
        }
    }

    async function getListSubject(levelID) {
        const res = await callApi('post', "subject/getSelectSubject", levelID);
        if (isSuccess(res)) {
            $('#subject_id').html(res.data);
        } else {
            noti(res.status); // show error message
        }
    }

    $("#formAssign").submit(function(event) {
        event.preventDefault();

        const form = $(this);
        const url = form.attr('action');

        cuteAlert({
            type: 'question',
            title: 'Are you sure?',
            message: 'Form will be submitted!',
            closeStyle: 'circle',
            cancelText: 'Abort',
            confirmText: 'Yes, Confirm!',
        }).then(
            async (e) => {
                if (e == 'confirm') {
                    const res = await submitApi(url, form.serializeArray(), 'formAssign', getDataTeacherList);
                    getDataSubjectList();
                }
            }
        );
    });
</script>