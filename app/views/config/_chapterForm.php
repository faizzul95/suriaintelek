<form id="formChapter" action="subject/saveChapter" method="POST">

    <div class="row mt-2">
        <div class="col-lg-2">
            <div class="form-group">
                <label> Chapter No. </label>
                <input type="text" id="chapter_no" name="chapter_no" class="form-control" autocomplete="off" readonly required>
            </div>
        </div>
        <div class="col-lg-10">
            <div class="form-group">
                <label> Chapter Description <span class="text-danger">*</span></label>
                <input type="text" id="chapter_desc" name="chapter_desc" class="form-control" maxlength="100" autocomplete="off" onKeyUP="this.value = this.value.toUpperCase();" required>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-12">
            <span class="text-danger mb-2">* Indicates a required field</span>
            <center>
                <input type="hidden" id="chapter_id" name="chapter_id" class="form-control" readonly>
                <input type="hidden" id="subject_id" name="subject_id" class="form-control" readonly>
                <!-- button submit must be put id "submitBtn" -->
                <button type="submit" id="submitBtn" class="btn btn-success"> <i class='fa fa-save'></i> Save </button>
            </center>
        </div>
    </div>

</form>

<script>
    function getPassData(baseUrl, token, data) {
        if (data.chapter_id == null) {
            getCurrentChapterNo(data.subject_id);
        } else {
            getUpdateData(data.chapter_id);
        }
    }

    async function getCurrentChapterNo(subject_id) {
        const res = await callApi('post', "subject/countChapterNoBySubjectID", {
            subject_id: subject_id,
        });

        if (isSuccess(res)) {
            $('#chapter_no').val(res.data);
        } else {
            noti(res.status); // show error message
        }
    }

    async function getUpdateData(chapter_id) {
        const res = await callApi('post', "subject/getUpdateChapter", {
            chapter_id: chapter_id,
        });

        if (isSuccess(res)) {
            $('#chapter_no').val(res.data.chapter_no);
            $('#chapter_desc').val(res.data.chapter_desc);
        } else {
            noti(res.status); // show error message
        }
    }

    $("#formChapter").submit(function(event) {
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
                    const res = await submitApi(url, form.serializeArray(), 'formChapter', showSyllabus);
                }
            }
        );
    });
</script>