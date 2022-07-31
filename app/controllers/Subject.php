<?php

use Config_subject_model as SubjectM;
use Config_subject_chapter_model as chapterM;
use Config_subject_chapter_topic_model as topicM;
use Config_subject_chapter_subtopic_model as subtopicM;
use Config_subject_level_linking_model as assign;

use StudentAssessment_model as AM;

class Subject extends Controller
{
    public function index()
    {
        redirect('settings/subject'); // redirect to page settings subject
    }

    public function getListDt()
    {
        echo $this->SubjectM->getlist();
    }

    public function getSubjectByID()
    {
        json(SubjectM::find($_POST['id']));
    }

    public function getSubjectByCode()
    {
        $data = SubjectM::where(['subject_code' => $_POST['id']]);
        json($data);
    }

    public function save()
    {
        $data = SubjectM::updateOrInsert($_POST);
        json($data);
    }

    public function delete()
    {
        $data = SubjectM::delete($_POST['id']);
        json($data);
    }

    public function getListSubject()
    {
        $data = $this->SubjectM->getAllSubject();

        if (count($data) > 0) {
            foreach ($data as $row) {

                $subjectID = $row['subject_id'];
                $subjectCode = $row['subject_code'];
                $subjectName = $row['subject_name'];
                $subjectStatus = $row['subject_status'];

                $status = ($subjectStatus == 0) ? '<span class="badge badge-center bg-label-danger" title="Inactive"><i class="fa fa-close"></i></span>' : '<span class="badge badge-center bg-label-success" title="Active"><i class="fa fa-check"></i></span>';

                $count = chapterM::countData($subjectID, 'subject_id');
                $deleteBtn = ($count == 0) ? '<li class="nav-item">
                                <button onclick="deleteRecord(' . $subjectID . ')" class="btn btn-sm btn-label-danger" title="Remove Subject" type="button">
                                    <i class="fas fa-trash-alt" aria-hidden="true"></i>
                                </button>
                            </li>' : '';

                // echo  'Indicator : <span class="badge badge-center bg-label-danger" title="Inactive"> Inactive <span class="badge badge-center bg-label-success" title="Active"> Active';
                echo  '<nav class="navbar navbar-expand-md bg-primary mt-2">
                            <div class="container-fluid">
                                ' . $status . '
                                &nbsp; ' . $subjectCode . ' - ' . $subjectName . '
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-ex-' . $subjectID . '">
                                    <span class="navbar-toggler-icon"></span>
                                </button>

                                <div class="collapse navbar-collapse" id="navbar-ex-' . $subjectID . '">
                                    <ul class="navbar-nav ms-lg-auto">
                                        ' . $deleteBtn . '
                                        <li class="nav-item">
                                            <button onclick="updateRecord(' . $subjectID . ')" class="btn btn-sm btn-label-success ms-2" title="Edit Subject" type="button">
                                                <i class="fas fa-edit" aria-hidden="true"></i>
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button onclick="showSyllabus(' . $subjectID . ', \'' . $subjectName . '\')" class="btn btn-sm btn-label-info ms-2" type="button">
                                                <i class="fas fa-book-open" aria-hidden="true"></i>
                                                Syllabus
                                            </button>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </nav>';

                echo '<div id="subid' . $subjectID . '" class="syllabusDiv" class="col-md-12 col-lg-12"></div>';
            }
        } else {

            echo '<div class="card mb-4">
                        <div class="card-body">';
            echo nodata();
            echo        '</div>
                  </div>';
        }
    }

    // CHAPTER
    public function getChapterByFK()
    {
        $data = chapterM::where(['subject_id' => $_POST['id']]);

        if (count($data) > 0) {
            echo '<div class="card mt-2 mb-2">
                        <div class="card-header border-bottom">
                            <h5 class="card-title">
                            Syllabus ' . $_POST['name'] . '
                                <button type="button" class="btn btn-danger btn-sm float-end ms-2" onclick="closeSyllabus()" title="Close">
                                    <i class="fa fa-close"></i> 
                                </button>
                                <button type="button" class="btn btn-warning btn-sm float-end ms-2" onclick="showSyllabus()" title="Refresh">
                                    <i class="fa fa-refresh"></i>
                                </button>
                                <button type="button" class="btn btn-dark btn-sm float-end ms-2" onclick="saveChapter()" title="Add Chapter">
                                    <i class="fa fa-plus"></i> Add Chapter
                                </button>
                            </h5>
                        </div>
                        <div class="card-body">';

            foreach ($data as $row) {

                $chapterid = $row['chapter_id'];
                $no = $row['chapter_no'];
                $desc = $row['chapter_desc'];

                echo ' <nav class="nav nav-pills flex-column w-100" style="margin-top:10px;">
                        <span class="nav-link text-white active" style="background-color:#283144">
                            CHAPTER ' . $no . ' : ' . $desc . '
                            <a href="javascript:void(0);" class="btn btn-xs btn-danger float-end" id="1" onclick="deleteChapter(' . $chapterid . ')" title="Remove Chapter"> 
                                <i class="fa fa-trash"></i> 
                            </a>
                            <a href="javascript:void(0)" class="btn btn-info btn-xs float-end me-2" onclick="saveChapter(\'update\', ' . $chapterid . ')"  title="Edit Chapter">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="javascript:void(0)" class="btn btn-warning btn-xs float-end me-2" onclick="saveTopic(' . $chapterid . ')"  title="Add Topic">
                                <i class="fa fa-plus"></i> Add Topic
                            </a>
                        </span>';

                $this->getTopicByChapterID($chapterid);

                echo    '</nav>';
            }

            echo ' </div>
                </div>';
        } else {

            echo '<div class="card mt-2 mb-4">
                        <div class="card-header border-bottom">
                            <h5 class="card-title">
                            Syllabus ' . $_POST['name'] . '
                                <button type="button" class="btn btn-danger btn-sm float-end ms-2" onclick="closeSyllabus()" title="Close">
                                    <i class="fa fa-close"></i> 
                                </button>
                                <button type="button" class="btn btn-warning btn-sm float-end ms-2" onclick="showSyllabus()" title="Refresh">
                                    <i class="fa fa-refresh"></i>
                                </button>
                                <button type="button" class="btn btn-dark btn-sm float-end ms-2" onclick="saveChapter()" title="Add Chapter">
                                    <i class="fa fa-plus"></i> Add Chapter
                                </button>
                            </h5>
                        </div>
                        <div class="card-body">';
            echo nodata();
            echo        '</div>
                  </div>';
        }
    }

    public function countChapterNoBySubjectID()
    {
        $currentNo = $this->chapterM->countChapterNo(escape($_POST['subject_id']));
        json($currentNo + 1);
    }

    public function saveChapter()
    {
        $_POST['school_id'] = session()->get('schoolID') ?? SCHOOL_ID;
        $data = chapterM::save($_POST);
        json($data);
    }

    public function getUpdateChapter()
    {
        $data = chapterM::find($_POST['chapter_id']);
        json($data);
    }

    public function deleteChapter()
    {
        $getDataChapter = chapterM::find($_POST['id']);
        $subject_id = $getDataChapter['subject_id'];

        $remove = chapterM::delete($_POST['id']);
        $getAllDataChapter = chapterM::where(['subject_id' => $subject_id]);

        if ($remove['resCode'] == 200) {
            $countChapterNo = 1;
            foreach ($getAllDataChapter as $row) {
                chapterM::update(
                    [
                        'chapter_id' => $row['chapter_id'],
                        'chapter_desc' => $row['chapter_desc'],
                        'chapter_no' => $countChapterNo,
                    ]
                );
                $countChapterNo++;
            }
        }

        json($remove);
    }

    // TOPIC
    public function getTopicByChapterID($chapterID)
    {
        $data = topicM::where(['chapter_id' => $chapterID]);

        if (count($data) > 0) {
            foreach ($data as $row) {

                $topicid = $row['topic_id'];
                $chapterid = $row['chapter_id'];
                $no = $row['topic_no'];
                $desc = $row['topic_desc'];

                echo ' <nav class="nav nav-pills flex-column mt-2 w-80" style="margin-left: 20px">
                            <span class="nav-link ml-5 my-1 text-primary" style="margin-top: 10px;background-color : #D4F4FF">
                                ' . $no . ' - ' . $desc . '
                                <a href="javascript:void(0);" class="btn btn-xs btn-danger float-end" id="1" onclick="deleteTopic(' . $topicid . ')" title="Remove Topic"> 
                                    <i class="fa fa-trash"></i> 
                                </a>
                                <a href="javascript:void(0);" class="btn btn-info btn-xs float-end me-2" onclick="saveTopic(' . $chapterid . ',\'update\',' . $topicid . ')" title="Edit Topic">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:void(0);" class="btn btn-warning btn-xs float-end me-2" onclick="saveSubTopic(' . $chapterid . ', ' . $topicid . ')" title="Add Sub-Topic">
                                <i class="fa fa-plus"></i> Add Sub Topic
                            </a>
                            </span>';

                $this->getSubTopicByTopicID($topicid);

                echo '  </nav>';
            }
        }
    }

    public function countTopicNoByFKID()
    {
        $currentNo = $this->topicM->countTopicNo(escape($_POST['subject_id']), escape($_POST['chapter_id']));
        // dd($currentNo, $_POST);
        $chapterData = chapterM::find($_POST['chapter_id']);
        $chapterNo = $chapterData['chapter_no'];
        $newNo = $chapterNo . '.' . ($currentNo + 1);
        json($newNo);
    }

    public function saveTopic()
    {
        $_POST['school_id'] = session()->get('schoolID') ?? SCHOOL_ID;
        $data = topicM::save($_POST);
        json($data);
    }

    public function getUpdateTopic()
    {
        $data = topicM::find($_POST['topic_id']);
        json($data);
    }

    public function deleteTopic()
    {
        $getDataTopic = topicM::find($_POST['id']);
        $subject_id = $getDataTopic['subject_id'];
        $chapter_id = $getDataTopic['chapter_id'];

        $chapterData = chapterM::find($chapter_id);
        $chapterNo = $chapterData['chapter_no'];

        $remove = topicM::delete($_POST['id']);
        $getAllDataTopic = $this->topicM->getAllTopicByFKID($subject_id, $chapter_id);

        if ($remove['resCode'] == 200) {
            $countTopicNo = 1;
            foreach ($getAllDataTopic as $row) {
                topicM::update(
                    [
                        'topic_id' => $row['topic_id'],
                        'topic_desc' => $row['topic_desc'],
                        'topic_no' => $chapterNo . '.' . $countTopicNo,
                    ]
                );
                $countTopicNo++;
            }
        }

        json($remove);
    }

    // SUB TOPIC
    public function getSubTopicByTopicID($topicID)
    {
        $data = subtopicM::where(['topic_id' => $topicID]);

        if (count($data) > 0) {
            foreach ($data as $row) {

                $subtopicid = $row['sub_topic_id'];
                $topicid = $row['topic_id'];
                $chapterid = $row['chapter_id'];
                $no = $row['sub_topic_no'];
                $desc = $row['sub_topic_desc'];

                echo '<nav class="nav nav-pills flex-column w-80" style="margin-left: 30px">
                        <span class="nav-link ml-3 my-1 text-primary" style="background-color : #F5FDFF">
                            ' . $no . ' - ' . $desc . '
                            <a href="javascript:void(0);" class="btn btn-xs btn-danger float-end" id="1" onclick="deleteSubTopic(' . $subtopicid . ')" title="Remove Sub-Topic"> 
                                <i class="fa fa-trash"></i> 
                            </a>
                            <a href="javascript:void(0);" class="btn btn-info btn-xs float-end me-2" onclick="saveSubTopic(' . $chapterid . ',' . $topicid . ',\'update\',' . $subtopicid . ')" title="Edit Sub-Topic">
                                <i class="fa fa-edit"></i>
                            </a>
                        </span>
                    </nav> ';
            }
        }
    }

    public function countSubTopicNoByFKID()
    {
        $currentNo = $this->subtopicM->countSubTopicNo(escape($_POST['subject_id']), escape($_POST['chapter_id']), escape($_POST['topic_id']));
        $chapterData = topicM::find($_POST['topic_id']);
        $topicNo = $chapterData['topic_no'];
        $newNo = $topicNo . '.' . ($currentNo + 1);
        json($newNo);
    }

    public function saveSubTopic()
    {
        $_POST['school_id'] = session()->get('schoolID') ?? SCHOOL_ID;
        $data = subtopicM::save($_POST);
        json($data);
    }

    public function getUpdateSubTopic()
    {
        $data = subtopicM::find($_POST['sub_topic_id']);
        json($data);
    }

    public function deleteSubTopic()
    {
        $getDataTopic = subtopicM::find($_POST['id']);
        $subject_id = $getDataTopic['subject_id'];
        $chapter_id = $getDataTopic['chapter_id'];
        $topic_id = $getDataTopic['topic_id'];

        $topicData = topicM::find($topic_id);
        $topicNo = $topicData['topic_no'];

        $remove = subtopicM::delete($_POST['id']);
        $getAllDataSubTopic = $this->subtopicM->getAllSubTopicByFKID($subject_id, $chapter_id, $topic_id);

        if ($remove['resCode'] == 200) {
            $countSubTopicNo = 1;
            foreach ($getAllDataSubTopic as $row) {
                subtopicM::update(
                    [
                        'sub_topic_id' => $row['sub_topic_id'],
                        'sub_topic_desc' => $row['sub_topic_desc'],
                        'sub_topic_no' => $topicNo . '.' . $countSubTopicNo,
                    ]
                );
                $countSubTopicNo++;
            }
        }

        json($remove);
    }

    // Assign Subject

    public function getListSubjectAssign()
    {
        $data = $this->assign->assignSubjectByLevelID(escape($_POST['level_id']));
        if (count($data) > 0) {

            echo '
            <div class="table-responsive text-nowrap">
                    <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th width="85%"> Subject Name </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">';

            foreach ($data as $row) {

                $id = $row['subject_level_id'];
                $fullName = $row['user_fullname'];
                $preffName = $row['user_preferred_name'];
                $subjectName = $row['subject_name'];
                $subjectCode = $row['subject_code'];

                echo '<tr>
                        <td> ' . $subjectCode . ' : ' . $subjectName . ' <br> <em>' . $preffName . '</em> </td>
                        <td> 
                            <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="removeAssign(' . $id . ')">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a> 
                        </td>
                    </tr>';
            }
            echo ' </tbody>
            </table>';
        } else {
            echo nodata();
        }
    }

    public function getSelectSubject()
    {
        $assign = assign::where(['level_id' => escape($_POST['id'])]);
        $data = $this->SubjectM->getAllActiveSubject();

        $ids = array();
        foreach ($assign as $assign) {
            array_push($ids, $assign['subject_id']);
        }

        echo '<option value=""> - Select - </option>';
        foreach ($data as $row) {
            if (!in_array($row['subject_id'], $ids)) {
                echo '<option value="' . $row['subject_id'] . '"> ' . $row['subject_code'] . ' - ' . $row['subject_name'] . ' </option>';
            }
        }
    }

    public function assignSave()
    {
        $_POST['school_id'] = session()->get('schoolID') ?? SCHOOL_ID;
        $data = assign::insert($_POST);
        json($data);
    }

    public function assignDelete()
    {
        $data = assign::delete($_POST['id']);
        json($data);
    }

    public function getListStudSubjectAssessmentDiv()
    {
        $levelID = escape($_POST['level_id']);
        $subjectID = escape($_POST['subject_id']);
        $reportID = escape($_POST['report_id']);
        $studID = escape($_POST['stud_id']);

        $data = $this->assign->subjectStudentAssignByLevelID($levelID);

        foreach ($data as $row) {
            $teacherName = $row['user_fullname'];
            $subjectID = $row['subject_id'];

            $dataAsssement = AM::where([
                'report_id' => $reportID,
                'subject_id' => $subjectID,
            ], 'fetchRow');

            if (empty($dataAsssement)) {
                $status = '<span class="badge badge-sm bg-label-warning"> ASSESSMENT NOT FOUND </span>';
                $icon = "fas fa-exclamation-triangle";
                $label = "warning";
            } else {
                $statusEval = $dataAsssement['assessment_status'];
                if ($statusEval == 0) {
                    $status = '<span class="badge badge-sm bg-label-danger"> NOT EVALUATE YET </span>';
                    $icon = "fas fa-close";
                    $label = "danger";
                } else {
                    $status = '<span class="badge badge-sm bg-label-success"> COMPLETED </span>';
                    $icon = "fas fa-check";
                    $label = "success";
                }
            }

            echo '<div class="col-12 mb-2">
                <div id="cardSubject-' . $subjectID . '" class="card cardSubjectColor" onclick="getAssessmentForm(' . $subjectID . ')">
                    <div class="card-body">
                        <div class="d-flex justify-content-between" style="position: relative;">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar">
                                    <span class="avatar-initial bg-label-' . $label . ' rounded-circle">
                                        <i class="' . $icon . '"></i>
                                    </span>
                                </div>
                                <div class="card-info">
                                    <h5 id="textSubject-' . $subjectID . '" class="card-title mb-0 textSubjectColor">' . $row['subject_name'] . '</h5>
                                    <small> ' . $teacherName . ' <br> ' . $status . '</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        }
    }
}
