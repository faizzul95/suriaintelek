<?php

use Student_enroll_model as Enrol;
use Student_info_model as Stud;
use StudentReportCard_model as RCM;
use StudentAssessment_model as AM;
use StudentAssessmentItem_model as AIM;

use Config_subject_model as SubjectM;
use Config_subject_chapter_model as chapterM;
use Config_subject_chapter_topic_model as topicM;

use Config_subject_level_linking_model as assign;
use Notification_model as Noti;

class Reportcard extends Controller
{
    public function index()
    {
        $roleID = session()->get('roleID');

        if ($roleID == 1 || $roleID == 2) {
            $page = 'admin_list';
        } else if ($roleID == 4) {
            $page = 'teacher_list';
        } else {
            error('404');
        }

        $data = [
            'title' => 'Report Card',
            'currentSidebar' => 'reportcard',
            'currentSubSidebar' => NULL
        ];

        render('reportcard/' . $page, $data);
    }

    public function getListReportByStudIdDt()
    {
        echo $this->RCM->getListByStudID(escape($_POST['id']));
    }

    public function getReportCard()
    {
        $dataEnroll = $this->Enrol->currentEnrolByLevelID(escape($_POST['level_id']));

        if (count($dataEnroll) > 0) {

            $roleID = session()->get('roleID');
            $month = (isset($_POST['month'])) ? escape($_POST['month']) : date('m');
            $year = (isset($_POST['year'])) ? escape($_POST['year']) : date('Y');
            $date = (isset($_POST['date'])) ? escape($_POST['date']) : NULL;
            $level_id = (isset($_POST['level_id'])) ? escape($_POST['level_id']) : NULL;

            if (!empty($date)) {

                $dataReport = RCM::where(
                    [
                        'report_date' => $date,
                        'level_id' => $level_id,
                        'report_year' => $year,
                        'school_id' => session()->get('schoolID')
                    ],
                    'get',
                    ['studentDetail'],
                );

                $btnRemove = ($roleID == 1 || $roleID == 2) ? '<button type="button" class="btn btn-danger btn-sm float-end ms-2" onclick="removeReportCard()" title="Remove">
                                <i class="fa fa-trash"></i> Remove Report Card
                            </button>' : NULL;

                if (!empty($dataReport)) {
                    echo '<div class="card">
                            <div class="card-header border-bottom">
                                <h5 class="card-title">
                                Report Card for ' . date('l, jS F Y', strtotime(date($date))) . '
                                    <button type="button" class="btn btn-warning btn-sm float-end ms-2" onclick="getDataStudentList()" title="Refresh">
                                        <i class="fa fa-refresh"></i>
                                    </button>
                                    ' . $btnRemove . '
                                </h5>
                            </div>
                            <div class="card-body">';

                    echo '<div class="table-responsive text-nowrap">
                            <table class="table">
                            <thead class="table-dark">
                                <tr>
                                    <th width = "50%"> Student Name </th>
                                    <th width = "20%"> Matric No </th>
                                    <th width = "10%"> Verify </th>
                                    <th width = "10%"> Status </th>
                                    <th width = "10%" align="center"> Assessment </th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">';

                    foreach ($dataReport as $row) {

                        $studID = $row['stud_id'];
                        $status = $row['report_status'];
                        $verifystatus = $row['guardian_verify_status'];
                        $verifydate = date("d/m/Y", strtotime($row['guardian_verify_date']));
                        $studName = $row['studentDetail']['stud_name'];
                        $matricNo = $row['studentDetail']['stud_matric_no'];

                        if ($status == 0) {
                            $status = '<span class="badge bg-label-danger"> DRAFT </span>';
                        } else {
                            $status = '<span class="badge bg-label-success"> POSTED </span>';
                        }

                        $titleVerify = 'Verified at ' . $verifydate;
                        $verify = ($verifystatus == 0) ? '<span class="badge bg-label-warning"> NOT VERIFY </span>' : '<span class="badge bg-label-success" title="' . $titleVerify . '"> VERIFIED </span>';

                        $btnEvaluate = ($roleID == 1 || $roleID == 2) ? '<button type="button" class="btn btn-success btn-sm" onclick="viewAssessmentReport(' . $row['report_id'] . ')" title="View assessment">
                                            <i class="fa fa-eye"></i> Assessment
                                        </button>' : '<button type="button" class="btn btn-info btn-sm" onclick="doAssessmentReport(' . $row['report_id'] . ')" title="Assessment">
                                            <i class="fa fa-edit"></i> Assessment
                                        </button>';

                        echo '<tr>
                                <td> ' . $studName . ' </td>
                                <td> ' . $matricNo . ' </td>
                                <td> ' . $verify . ' </td>
                                <td> ' . $status . ' </td>
                                <td> 
                                    <center> ' . $btnEvaluate . ' </center> 
                                </td>
                            </tr>';
                    }
                    echo '  </tbody>
                            </table>
                        </div>
                        </div>
                    </div>';
                } else {
                    echo noReportCard(session()->get('roleID'));
                }
            } else {
                echo nodata();
            }
        } else {
            echo nodata();
        }
    }

    function getDaysListSelectByYearMonth()
    {
        $month = (isset($_POST['month'])) ? escape($_POST['month']) : date('m');
        $year = (isset($_POST['year'])) ? escape($_POST['year']) : date('Y');
        $dayName = (isset($_POST['dayName'])) ? escape($_POST['dayName']) : 'friday';

        $ts = strtotime('first ' . $dayName . ' of ' . $year . '-' . $month . '-01');
        $ls = strtotime('last day of ' . $year . '-' . $month . '-01');
        $dateList = array(date('Y-m-d', $ts));

        while (($ts = strtotime('+1 week', $ts)) <= $ls) {
            $dateList[] = date('Y-m-d', $ts);
        }

        $todayDate = date('Y-m-d');

        echo '<option value=""> - Select - </option>';
        foreach ($dateList as $date) {
            $selected = ($date == $todayDate) ? 'selected' : '';
            $formatDate = date('d/m/Y', strtotime($date));
            echo '<option value="' . $date . '" ' . $selected . '> ' . $formatDate . '</option>';
        }
    }

    public function create()
    {
        $report_year = escape($_POST['report_year']);
        $report_month = escape($_POST['report_month']);
        $report_date = escape($_POST['report_date']);
        $level_id = escape($_POST['level_id']);
        $school_id = session()->get('schoolID');

        $dataEnroll = $this->Enrol->currentEnrolByLevelID($level_id);

        $dataSave = [];
        if (count($dataEnroll) > 0) {

            foreach ($dataEnroll as $data) {

                $save = [
                    'stud_id' => $data['stud_id'],
                    'academic_id' => $data['academic_id'],
                    'level_id' => $data['level_id'],
                    'guardian_id' => $data['parent_user_id'],
                    'school_id' => $school_id,
                    'report_date' => $report_date,
                    'report_month' => $report_month,
                    'report_year' => $report_year,
                    'created_at' => timestamp(),
                ];
                array_push($dataSave, $save);
            }

            $data = RCM::bulkData($dataSave); // call static function

        } else {
            $data = [
                "resCode" => 400,
                "message" =>  message(400, 'insert'),
                "id" => NULL,
                "data" => $_POST
            ];
        }

        json($data);
    }

    public function delete()
    {
        $data = RCM::delete($_POST['report_date'], 'report_date'); // call static function
        json($data);
    }

    public function assessmentSave()
    {
        // update item
        foreach ($_POST['assessment_item_grade'] as $key => $grade) {
            $data = AIM::save(
                [
                    'assessment_item_id' => $key,
                    'assessment_item_grade' => $grade,
                ]
            );
        }

        AM::save(
            [
                'assessment_id' => $_POST['assessment_id'],
                'assessment_remark' => $_POST['assessment_remark'],
                'assessment_date' => date('Y-m-d'),
                'assessment_status' => 1,
            ]
        );

        $countAssessment = $this->AM->countPostedAssessment($_POST['report_id']);
        $countSubjectTaken = assign::countData($_POST['level_id'], 'level_id');

        if ($countAssessment == $countSubjectTaken) {
            RCM::save(
                [
                    'report_id' => $_POST['report_id'],
                    'report_status' => '1',
                ]
            );

            $studData = RCM::where(['report_id' => $_POST['report_id']], 'fetchRow', ['studentDetail', 'guardianDetail']);
            $studentID = $studData['studentDetail']['stud_id'];
            $studentMatric = $studData['studentDetail']['stud_matric_no'];
            $studentName = $studData['studentDetail']['stud_name'];

            Noti::save(
                [
                    'noti_type' => '4',
                    'noti_text' => 'New report card has been posted for student ' . $studentMatric,
                    'noti_redirect' => url('student/profile/' . encodeID($studentID)),
                    'noti_status' => '0',
                    'user_id' => $studData['guardianDetail']['user_id'],
                    'user_preferred_name' => 'Notification',
                    'school_id' => '1',
                ]
            );
        }

        json($data);
    }

    public function verifySave()
    {
        RCM::save(
            [
                'report_id' => $_POST['report_id'],
                'guardian_verify_status' => 1,
                'guardian_verify_date' => date("Y-m-d"),
            ]
        );
    }

    public function getReportIDByFilter()
    {
        $data = RCM::where([
            'report_id' => $_POST['report_id'],
            'report_date' => $_POST['report_date'],
            'level_id' => $_POST['level_id'],
        ], 'fetchRow');

        json($data);
    }

    public function getReportByID()
    {
        $data = RCM::find($_POST['id']);

        json($data);
    }

    public function getAssessmentFormBySubjectReportID($sID = NULL, $rID = NULL, $studID = NULL, $levID = NULL)
    {
        $subjectID = (empty($sID)) ? escape($_POST['subject_id']) : $sID;
        $reportID = (empty($rID)) ? escape($_POST['report_id']) : $rID;
        $studentID = (empty($studID)) ? escape($_POST['stud_id']) : $studID;
        $levelID = (empty($levID)) ? escape($_POST['level_id']) : $levID;

        if (empty($subjectID)) {
            noSelectDataLeft('subject');
        } else {

            $data = AM::where(
                [
                    'subject_id' => $subjectID,
                    'report_id' => $reportID,
                ],
                'fetchRow',
            );

            $roleID = session()->get('roleID');
            if (empty($data)) {

                // check if current role is teacher
                if ($roleID == 4) {
                    $teacherID = session()->get('userID');
                } else {
                    // if not role teacher then get teacher id from subject linking
                    $link = assign::where(
                        [
                            'subject_id' => $subjectID,
                            'level_id' => $levelID
                        ],
                        'fetchRow'
                    );
                    $teacherID = $link['teacher_user_id'];
                }

                $assessmentData = AM::save(
                    [
                        'report_id' => $reportID,
                        'subject_id' => $subjectID,
                        'teacher_id' => $teacherID,
                    ]
                );

                if ($assessmentData['resCode'] == 200) {
                    $assessment_id = $assessmentData['id'];
                    $topic = topicM::where(['subject_id' => $subjectID]);
                    if (!empty($topic)) {
                        foreach ($topic as $data) {
                            AIM::save(
                                [
                                    'assessment_id' => $assessment_id,
                                    'assessment_item_desc' => $data['topic_desc'],
                                ]
                            );
                        }
                    }
                }

                return $this->getAssessmentFormBySubjectReportID($subjectID, $reportID, $studentID, $levelID);
                exit;
            }

            $dataItem = AIM::where(
                [
                    'assessment_id' => $data['assessment_id'],
                ],
            );

            if (empty($dataItem)) {
                noSyllabus();
            } else {

                echo '
                <table class="table table-sm table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 80%!important;"> Description </th>
                        <th style="width: 20%!important;"> Result </th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">';

                foreach ($dataItem as $row) {

                    $assessment_item_id  = $row['assessment_item_id'];
                    $assessment_id = $row['assessment_id'];
                    $assessment_item_desc = $row['assessment_item_desc'];
                    $assessment_item_grade = $row['assessment_item_grade'];

                    $resultAssessment = ($data['assessment_status'] == 0) ? '<select name="assessment_item_grade[' . $assessment_item_id . ']" class="form-control">
                                            <option value="N/A"> N/A </option>
                                            <option value="Good"> Good </option>
                                            <option value="Moderate"> Moderate </option>
                                            <option value="Excellent"> Excellent </option>
                                        </select>' : $assessment_item_grade;
                    echo '<tr>
                            <td> ' . $assessment_item_desc . ' </td>
                            <td> ' . $resultAssessment . '</td>
                        </tr>';
                }
                echo '  </tbody>
                </table>';

                echo '<label class="form-label"> Comment </label><br>';
                if ($data['assessment_status'] == 0) {
                    echo '<input type="text" id="assessment_remark" name="assessment_remark" class="form-control mb-4" maxlength = "250" placeholder="Type something... (maxlength : 250)">
                    <input type="hidden" id="assessment_id" name="assessment_id" placeholder="assessment_id" value="' . $data['assessment_id'] . '">
                    <span class="text-danger mb-2"><b> Notes : </b> <i> N/A </i> indicates the topic has not been taught yet</span>
                    <center>
                        <button type="submit" id="submitBtn" class="btn btn-info mt-4">
                        <i class="fa fa-save"></i> Confirm
                        </button>
                    </center>';
                } else {
                    $comment = (!empty($data['assessment_remark'])) ? $data['assessment_remark'] : 'N/A';
                    echo '<span style="font-weight: bold;">' . $comment . '</span>';
                }
            }
        }
    }

    public function getAssessmentItemFormByIds()
    {
        $subjectID = escape($_POST['subject_id']);
        $reportID = escape($_POST['report_id']);
        $studentID = escape($_POST['stud_id']);
        $levelID = escape($_POST['level_id']);

        $assessmentData = AM::where(
            [
                'report_id' => $reportID,
                'subject_id' => $subjectID,
            ],
            'fetchRow'
        );

        $assessment_id = $assessmentData['assessment_id'];

        $checkItem = AIM::where(
            [
                'assessment_id' => $assessment_id
            ]
        );

        if (count($checkItem) == 0) {
            $topic = topicM::where(['subject_id' => $subjectID]);
            if (!empty($topic)) {
                foreach ($topic as $data) {
                    AIM::save(
                        [
                            'assessment_id' => $assessment_id,
                            'assessment_item_desc' => $data['topic_desc'],
                        ]
                    );
                }
            }
        }

        return $this->getAssessmentFormBySubjectReportID($subjectID, $reportID, $studentID, $levelID);
        exit;
    }
}