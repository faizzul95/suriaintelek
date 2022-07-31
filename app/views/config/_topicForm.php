<form id="formTopic" action="subject/saveTopic" method="POST">

    <div class="row mt-2">
        <div class="col-lg-2">
            <div class="form-group">
                <label> Topic No. </label>
                <input type="text" id="topic_no" name="topic_no" class="form-control" autocomplete="off" readonly required>
            </div>
        </div>
        <div class="col-lg-10">
            <div class="form-group">
                <label> Topic Description <span class="text-danger">*</span></label>
                <input type="text" id="topic_desc" name="topic_desc" class="form-control" maxlength="100" autocomplete="off" onKeyUP="this.value = this.value.toUpperCase();" required>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-12">
            <span class="text-danger mb-2">* Indicates a required field</span>
            <center>
                <input type="hidden" id="topic_id" name="topic_id" class="form-control" readonly>
                <input type="hidden" id="subject_id" name="subject_id" class="form-control" readonly>
                <input type="hidden" id="chapter_id" name="chapter_id" class="form-control" readonly>
                <!-- button submit must be put id "submitBtn" -->
                <button type="submit" id="submitBtn" class="btn btn-success"> <i class='fa fa-save'></i> Save </button>
            </center>
        </div>
    </div>

</form>

<script>
    function getPassData(baseUrl, token, data) {
        if (data.topic_id == null) {
            getCurrentTopicNo(data.subject_id, data.chapter_id);
        } else {
            getUpdateData(data.topic_id);
        }
    }

    async function getCurrentTopicNo(subject_id, chapter_id) {
        const res = await callApi('post', "subject/countTopicNoByFKID", {
            subject_id: subject_id,
            chapter_id: chapter_id,
        });

        if (isSuccess(res)) {
            $('#topic_no').val(res.data);
        } else {
            noti(res.status); // show error message
        }
    }

    async function getUpdateData(topic_id) {
        const res = await callApi('post', "subject/getUpdateTopic", {
            topic_id: topic_id,
        });

        if (isSuccess(res)) {
            $('#topic_no').val(res.data.topic_no);
            $('#topic_desc').val(res.data.topic_desc);
        } else {
            noti(res.status); // show error message
        }
    }

    $("#formTopic").submit(function(event) {
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
                    const res = await submitApi(url, form.serializeArray(), 'formTopic', showSyllabus);
                }
            }
        );
    });
</script>