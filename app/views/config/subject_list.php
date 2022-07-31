@extends('app.templates.blade')

@section('content')

<h4 class="py-3 breadcrumb-wrapper mb-4">
    <span class="text-muted fw-light"> Settings /</span> Subject
</h4>

<div class="row">
    <h5>
        <button type="button" class="btn btn-warning btn-sm float-end ms-2" onclick="getDataList()" title="Refresh">
            <i class="fa fa-refresh"></i>
        </button>
        <button type="button" class="btn btn-secondary btn-sm float-end" onclick="formModal()">
            <i class="fa fa-plus"></i> Add Subject
        </button>
    </h5>
    <div id="nodatadiv" style="display: none;"> {{ nodata() }} </div>
    <div id="dataListDiv" style="display: none;"></div>
</div>

<div class="row mt-2">
    <div class="col-12" id="contentData"></div>
    <input type="hidden" id="currentSubject" placeholder="subjectID">
    <input type="hidden" id="currentSubjectName" placeholder="subjectName">
</div>

<!--end::Row-->

<script type="text/javascript">
    $(document).ready(function() {
        getDataList();
    });

    async function getDataList() {
        const res = await callApi('post', "subject/getListSubject");
        if (isSuccess(res)) {
            $('#contentData').html(res.data);
        } else {
            noti(res.status); // show error message
        }
    }

    async function updateRecord(id) {
        const res = await callApi('post', "subject/getSubjectByID", id);
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
                    const res = await deleteApi(id, 'subject/delete', getDataList);
                }
            }
        );
    }

    function formModal(type = 'create', data = null) {
        const modalTitle = (type == 'create') ? 'Register Subject' : 'Update Subject';
        loadFormContent('config/_subjectForm.php', 'generalContent', 'lg', 'subject/save', modalTitle, data);
    }

    async function showSyllabus(subjectid = null, subjectName = null) {
        $('.syllabusDiv').empty(); // destroy all current div open

        if (subjectid == null) {
            subjectid = $('#currentSubject').val();
            subjectName = $('#currentSubjectName').val();
        }

        const res = await callApi('post', "subject/getChapterByFK", {
            id: subjectid,
            name: subjectName,
        });

        if (isSuccess(res)) {
            $('#subid' + subjectid).html(res.data);
            $('#currentSubject').val(subjectid);
            $('#currentSubjectName').val(subjectName);
        } else {
            noti(res.status); // show error message
        }
    }

    function closeSyllabus() {
        $('.syllabusDiv').empty(); // destroy all current div open
        $('#currentSubject').val('');
        $('#currentSubjectName').val('');
    }

    // CHAPTER 
    function saveChapter(typeForm = 'create', chapterID = null) {
        formModalChapter(typeForm, {
            subject_id: $('#currentSubject').val(),
            chapter_id: chapterID
        });
    }

    function formModalChapter(type = 'create', data = null) {
        const modalTitle = (type == 'create') ? 'Register Chapter' : 'Update Chapter';
        loadFormContent('config/_chapterForm.php', 'generalContent', 'lg', 'subject/saveChapter', modalTitle, data);
    }

    function deleteChapter(id) {
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
                    const res = await deleteApi(id, 'subject/deleteChapter', showSyllabus);
                }
            }
        );
    }

    // TOPIC 
    function saveTopic(chapterID, typeForm = 'create', topicID = null) {
        formModalTopic(typeForm, {
            subject_id: $('#currentSubject').val(),
            chapter_id: chapterID,
            topic_id: topicID,
        });
    }

    function formModalTopic(type = 'create', data = null) {
        const modalTitle = (type == 'create') ? 'Register Topic' : 'Update Topic';
        loadFormContent('config/_topicForm.php', 'generalContent', 'lg', 'subject/saveTopic', modalTitle, data);
    }

    function deleteTopic(id) {
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
                    const res = await deleteApi(id, 'subject/deleteTopic', showSyllabus);
                }
            }
        );
    }

    // SUB TOPIC 
    function saveSubTopic(chapterID, topicID, typeForm = 'create', subtopicID = null) {
        formModalSubTopic(typeForm, {
            subject_id: $('#currentSubject').val(),
            chapter_id: chapterID,
            topic_id: topicID,
            sub_topic_id: subtopicID,
        });
    }

    function formModalSubTopic(type = 'create', data = null) {
        const modalTitle = (type == 'create') ? 'Register Sub Topic' : 'Update Sub Topic';
        loadFormContent('config/_subtopicForm.php', 'generalContent', 'lg', 'subject/saveSubTopic', modalTitle, data);
    }

    function deleteSubTopic(id) {
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
                    const res = await deleteApi(id, 'subject/deleteSubTopic', showSyllabus);
                }
            }
        );
    }
</script>

@endsection