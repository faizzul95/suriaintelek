<form id="formSubTopic" action="subject/saveSubTopic" method="POST">

    <div class="row mt-2">
        <div class="col-lg-2">
            <div class="form-group">
                <label> Sub-Topic No. </label>
                <input type="text" id="sub_topic_no" name="sub_topic_no" class="form-control" autocomplete="off" readonly required>
            </div>
        </div>
        <div class="col-lg-10">
            <div class="form-group">
                <label> Sub-Topic Description <span class="text-danger">*</span></label>
                <input type="text" id="sub_topic_desc" name="sub_topic_desc" class="form-control" maxlength="100" autocomplete="off" onKeyUP="this.value = this.value.toUpperCase();" required>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-12">
            <span class="text-danger mb-2">* Indicates a required field</span>
            <center>
                <input type="hidden" id="sub_topic_id" name="sub_topic_id" class="form-control" readonly>
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
        if (data.sub_topic_id == null) {
            getCurrentSubTopicNo(data.subject_id, data.chapter_id, data.topic_id);
        } else {
            getUpdateData(data.sub_topic_id);
        }
    }

    async function getCurrentSubTopicNo(subject_id, chapter_id, topic_id) {
        const res = await callApi('post', "subject/countSubTopicNoByFKID", {
            subject_id: subject_id,
            chapter_id: chapter_id,
            topic_id: topic_id,
        });

        if (isSuccess(res)) {
            $('#sub_topic_no').val(res.data);
        } else {
            noti(res.status); // show error message
        }
    }

    async function getUpdateData(sub_topic_id) {
        const res = await callApi('post', "subject/getUpdateSubTopic", {
            sub_topic_id: sub_topic_id,
        });

        if (isSuccess(res)) {
            $('#sub_topic_no').val(res.data.sub_topic_no);
            $('#sub_topic_desc').val(res.data.sub_topic_desc);
        } else {
            noti(res.status); // show error message
        }
    }

    $("#formSubTopic").submit(function(event) {
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
                    const res = await submitApi(url, form.serializeArray(), 'formSubTopic', showSyllabus);
                }
            }
        );
    });
</script>