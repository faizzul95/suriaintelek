<?php

use Student_enroll_model as Enrol;
use Student_info_model as Stud;
use Application_model as App;
use Attendance_model as AT;
use StudentAssessment_model as AM;
use Log_record_model as Log;

class Student extends Controller
{
    public function index()
    {
        redirect('student/all'); // redirect to page settings level
    }

    public function all()
    {
        $data = [
            'title' => 'All Student',
            'currentSidebar' => 'student',
            'currentSubSidebar' => 'allStud'
        ];

        render('student/all_list', $data);
    }

    public function enrol()
    {
        $data = [
            'title' => 'Enrolled Student',
            'currentSidebar' => 'student',
            'currentSubSidebar' => 'enrol'
        ];

        render('student/enrol_list', $data);
    }

    public function withdraw()
    {
        $data = [
            'title' => 'Withdraw Student',
            'currentSidebar' => 'student',
            'currentSubSidebar' => 'withdraw'
        ];

        render('student/withdraw_list', $data);
    }

    public function graduate()
    {
        $data = [
            'title' => 'Graduate Student',
            'currentSidebar' => 'student',
            'currentSubSidebar' => 'graduate'
        ];

        render('student/graduate_list', $data);
    }

    public function children()
    {
        $data = [
            'title' => 'My Children',
            'currentSidebar' => 'children',
            'currentSubSidebar' => 'children',
            'user_id' => session()->get('userID'),
        ];

        render('student/children_list', $data);
    }

    public function wards()
    {
        $data = [
            'title' => 'My Student',
            'currentSidebar' => 'wards',
            'currentSubSidebar' => 'wards',
        ];

        render('student/wards_list', $data);
    }

    public function getListAllDt()
    {
        echo $this->Enrol->getlistAll(escape($_POST['academicID']));
    }

    public function getListEnrolDt()
    {
        echo $this->Enrol->getlist(escape($_POST['academicID']));
    }

    public function getListWithdrawDt()
    {
        echo $this->Enrol->getlistWithdraw(escape($_POST['academicID']));
    }

    public function getListGraduateDt()
    {
        echo $this->Enrol->getlistgGrad(escape($_POST['academicID']));
    }

    public function getListDt()
    {
        echo $this->Stud->getlist();
    }

    public function getListChildrenDt()
    {
        echo $this->Stud->getStudenListByParentIDDt(escape($_POST['userID']));
    }

    public function getListStudentTeacherDt()
    {
        echo $this->Stud->studenListBylevelIDDt(escape($_POST['level_id']));
    }

    public function getListChildren()
    {
        $data = $this->Stud->getStudenListByParentID(escape($_POST['id']));

        foreach ($data as $row) {
            $studImage = asset($row['stud_image']);
            // <span class="avatar-initial bg-label-primary rounded-circle"><i class="bx bx-user fs-4"></i></span>
            echo '<div class="col-12 mb-2">
                <div id="card-' . $row['stud_id'] . '" class="card cardColor" onclick="getData(' . $row['stud_id'] . ', ' . $row['enroll_date'] . ')">
                    <div class="card-body">
                        <div class="d-flex justify-content-between" style="position: relative;">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar">
                                    <img src="' . $studImage . '" class="img-fluid avatar-initial bg-label-primary rounded-circle" width="100%">
                                </div>
                                <div class="card-info">
                                    <a href="javascript:void(0)">
                                        <h5 id="text-' . $row['stud_id'] . '" class="card-title mb-0 me-2 textColor">' . $row['stud_preferred_name'] . '</h5>
                                    </a>
                                </div>
                            </div>
                            <div class="resize-triggers">
                                <div class="expand-trigger">
                                    <div style="width: 255px; height: 43px;"></div>
                                </div>
                                <div class="contract-trigger"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        }
    }

    public function getStudentByID()
    {
        $data = $this->Stud->getStudentDetailByID(escape($_POST['id']));
        // $data = Stud::find($_POST['id'], NULL, ['qrCode', 'enrollment', 'enrollment.class', 'enrollment.level']);
        json($data);
    }

    public function getStudentBillingByID()
    {
        $data = $this->Stud->getStudentDetailBillingByID(escape($_POST['id']));

        if ($data['application_status'] >= '6') {
            $data = $this->Enrol->getEnrollDetailsByID(escape($_POST['id']));
        } else {
            $data['stud_matric_no'] = '-';
            $data['level_name'] = '-';
            $data['class_name'] = '-';
            $data['academic_name'] = '-';
        }

        json($data);
    }

    public function create()
    {
        $data = Stud::insert($_POST);
        json($data);
    }

    public function profile($studentEncodeID = NULL)
    {
        if (!empty($studentEncodeID)) {
            $data = [
                'title' => 'Profile Student',
                'currentSidebar' => (session()->get('roleID') != '5') ? 'student' : 'profile',
                'currentSubSidebar' => 'enrol',
                'studentID' => decodeID($studentEncodeID),
            ];

            render('student/_studentProfile', $data);
        } else {
            redirect('student');
        }
    }

    public function update()
    {
        $data = Stud::save($_POST);

        $stud = Stud::find($_POST['stud_id']);
        $application = App::find($stud['application_id'], 'application_id');

        if ($data['resCode'] == 200) {
            $appData = App::save(
                [
                    'application_id' => $stud['application_id'],
                    'application_status' => $_POST['application_status'],
                    'graduate_date' => (isset($_POST['graduate_date'])) ? $_POST['graduate_date'] : NULL,
                    'withdraw_date' => (isset($_POST['withdraw_date'])) ? $_POST['withdraw_date'] : NULL,
                    'withdraw_reason' => (isset($_POST['withdraw_reason'])) ? $_POST['withdraw_reason'] : NULL,
                ]
            );

            $statusApp = $appData['data']['application_status'];

            $data['data']['application_status'] = $statusApp;
            $data['data']['graduate_date'] = $appData['data']['graduate_date'];
            $data['data']['withdraw_date'] = $appData['data']['withdraw_date'];
            $data['data']['withdraw_reason'] = $appData['data']['withdraw_reason'];

            if ($statusApp == 7 || $statusApp == 8) {
                $statusLog = ($statusApp == 7) ? 'graduated from school at ' . date('d/M/Y', strtotime($_POST['graduate_date'])) : 'withdraw from school at ' . date('d/M/Y', strtotime($_POST['withdraw_date']));
                // Add log
                Log::save(
                    [
                        'log_event' => 'Application',
                        'log_remark' => 'Application no ' . $application['application_no'] . ' has been ' . $statusLog,
                        'log_date' => date('Y-m-d H:i:s'),
                        'log_type' => 'info',
                        'application_id' => $stud['application_id'],
                        'user_id' => $application['parent_user_id'],
                        'school_id' => '1',
                    ]
                );
            }
        }

        json($data);
    }

    public function delete()
    {
        $data = Stud::delete($_POST['id']);
        json($data);
    }

    public function getStudentSibling()
    {
        $data = $this->Stud->studentSiblings(escape($_POST['user_id']), escape($_POST['stud_id']));
        json($data);
    }

    public function uploadProfile()
    {
        $data = $this->Stud->upload_save($_POST);
        json($data);
    }

    public function countTotalStudent()
    {
        $data = [
            'enrol' => $this->App->countApp(6),
            'graduate' => $this->App->countApp(7),
            'withdraw' => $this->App->countApp(8)
        ];

        json($data);
    }

    public function getListCurrentEnrollStudentBylevelID()
    {
        $data = $this->Enrol->currentEnrolByLevelID(escape($_POST['level_id']));
        if (count($data) > 0) {

            echo '<div class="table-responsive text-nowrap">
                    <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th> Student Name </th>
                            <th> Matric No </th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">';

            $count = 1;
            foreach ($data as $row) {

                $studName = $row['stud_name'];
                $matricNo = $row['stud_matric_no'];
                $status = $row['application_status'];

                if ($status == 6) {
                    $status = '<span class="badge bg-label-success">Enrolled</span>';
                } else if ($status == 7) {
                    $status = '<span class="badge bg-label-primary">Graduate</span>';
                } else if ($status == 8) {
                    $status = '<span class="badge bg-label-danger">Withdraw</span>';
                } else {
                    $status = '';
                }

                echo '<tr>
                        <td> ' . $studName . ' </td>
                        <td> ' . $matricNo . ' </td>
                    </tr>';

                $count++;
            }
            echo ' </tbody>
            </table>';
        } else {
            echo nodata();
        }
    }

    public function getListEnrollStudentBylevelID()
    {
        $data = $this->Enrol->currentEnrolByLevelID(escape($_POST['level_id']));

        if (count($data) > 0) {

            $month = (isset($_POST['month'])) ? escape($_POST['month']) : date('m');
            $year = (isset($_POST['year'])) ? escape($_POST['year']) : date('Y');
            $week = escape($_POST['week']);

            $chkAtt = $this->AT->attendanceByAYMonth(escape($_POST['level_id']), $year, $month);

            $result = NULL;

            if (count($chkAtt) > 0) {

                $totalDate = cal_days_in_month(CAL_GREGORIAN, $month, $year);

                if ($week == '01') {
                    $startDay = 1;
                    $endDay = 7;
                } elseif ($week == '02') {
                    $startDay = 8;
                    $endDay = 14;
                } elseif ($week == '03') {
                    $startDay = 15;
                    $endDay = 21;
                } else {
                    $startDay = 22;
                    $endDay = $totalDate;
                }

                $result .= '<table id="dataList" class="table table-sm table-striped table-bordered">
                                <thead class="table-dark table border-top">
                                    <tr>
                                        <td style="width: 50%" rowspan="2">
                                            <center class="mb-4"> STUDENT NAME </center>
                                        </td>
                                        <th style="width: 50%" colspan="' . ($endDay - $startDay) . '">
                                            <center> Date </center>
                                        </th>
                                    </tr>
                                    <tr>';

                for ($day = $startDay; $day <= $endDay; $day++) {

                    $dateCombine = date('Y-m-d', strtotime($year . '-' . $month . '-' . $day));
                    $daysFullName = date('l', strtotime($dateCombine));
                    $daysCode = date('N', strtotime($dateCombine));
                    $dateFormat = date('d.m.Y', strtotime($dateCombine));

                    if ($daysCode == '6' || $daysCode == '7') {
                        $display = 'display: none';
                    } else {
                        $display = '';
                    }

                    $result .= '<th style="width: 10%; ' . $display . '">
                                    <center>' . $daysFullName . ' <br> ' . $dateFormat . '</center>
                                </th>';
                }

                $result .= '</tr>
                        </thead>
                        <tbody>';

                foreach ($data as $stud) {

                    $result .= '<tr>
                                    <td> ' . $stud['stud_name'] . ' </td>';

                    for ($day = $startDay; $day <= $endDay; $day++) {

                        $dateCombine = date('Y-m-d', strtotime($year . '-' . $month . '-' . $day));
                        $daysCode = date('N', strtotime($dateCombine));
                        $attend = $this->AT->getListByStudID($stud['stud_id'], $dateCombine);

                        if ($attend != NULL) {
                            if ($attend['attendance_status'] == 0) {
                                $status = '<i class="fa fa-close" aria-hidden="true" style="color: red;" title="No Record Found"></i>';
                            } else if ($attend['attendance_status'] == 1) {
                                $status = '<i class="fa fa-check" aria-hidden="true" style="color: green; title="Present"></i>';
                            } else if ($attend['attendance_status'] == 2) {
                                $status = '<i class="fa fa-exclamation" aria-hidden="true" style="color: yellow; title="Absent"></i>';
                            } else {
                                $status = '<i class="fa fa-question" aria-hidden="true" style="color: gray; title="Others"></i>';
                            }
                        } else {
                            $status = '<i class="fa fa-close" aria-hidden="true" style="color: red;" title="No Record Found"></i>';
                        }

                        if ($daysCode == '06' || $daysCode == '07') {
                            $display = 'display: none';
                        } else {
                            $display = '';
                        }

                        $result .= '<td style="' . $display . '">
                                        <center>' . $status . '</center>
                                    </td>';
                    }

                    $result .= '</tr>';
                }

                $result .= '</tbody>
                        </table>';

                echo $result;
            } else {
                echo nodata();
            }
        } else {
            echo nodata();
        }
    }

    public function getListAccordionSubjectByStudID()
    {
        $data = $this->Enrol->getSubjectByStudID(escape($_POST['id']));
        if (count($data) > 0) {
            $data = groupArray($data, ['academic_name']);
            $count = 1;
            echo '<div class="col-12">
                <div class="accordion mt-3 accordion-header-info" id="subject">';
            foreach ($data as $year => $subject) {
                echo '
                    <div class="accordion-item card">
                        <h2 class="accordion-header">
                            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#subject-' . $count . '" aria-expanded="false">
                                ' . $year . '
                            </button>
                        </h2>
                
                        <div id="subject-' . $count . '" class="accordion-collapse collapse" data-bs-parent="#subject" style="">
                        <div class="accordion-body">';

                if ($subject[0]['subject_name'] != null) {
                    $subject = groupArray($subject, ['subject_name']);

                    foreach ($subject as $sub_name => $chapter) {
                        echo '<div class="mb-4">
                                <div class="alert alert-dark" role="alert">
                                <strong> ' . $sub_name . ' </strong>
                             </div>';
                        if (!empty($chapter[0]['chapter_no'])) {

                            echo '<table id="dataListSubj" class="table table-bordered table-striped table-responsive">
                                            <thead class="table-dark table border-top">
                                                <tr>
                                                    <th width="5%" align="center"> No. </th>
                                                    <th width="95%"> TOPIC </th>
                                                </tr>
                                            </thead>
                                            <tbody>';

                            $chapter = groupArray($chapter, ['chapter_no', 'chapter_desc']);

                            foreach ($chapter as $key => $topic) {

                                foreach ($topic as $title => $sub) {
                                    echo '<tr>
                                                <td align="center">' . $key . '</td>
                                                <td>' . $title . '</td>
                                            </tr>';

                                    foreach ($sub as $row) {
                                        if (!empty($row['topic_no'])) {
                                            echo '<tr>
                                                        <td  align="center"></td>
                                                        <td> &nbsp; &nbsp; ' .  $row['topic_no'] . ' - ' . $row['topic_desc'] . '</td>
                                                    </tr>';
                                        }
                                    }
                                }
                            }

                            echo ' </tbody>
                                    </table>';

                            echo '</div>';
                        } else {
                            echo noSearchQuery();
                        }
                    }
                } else {
                    echo nodata();
                }

                echo '
                        </div>
                    </div>';
                $count++;
            }
            echo '</div>
        </div>';
        }
    }


    public function getListAccordionFilesByStudID()
    {
        $data = $this->Stud->getStudentDetailByID(escape($_POST['id']));
        $matricFront = asset('upload/school_logo/student_matric_front.jpeg');
        $matricBack = asset('upload/school_logo/student_matric_back.jpeg');

        $stud_id = $data['stud_id'];
        $stud_qrcode = asset($data['stud_qrcode']);
        $stud_image = asset($data['stud_image']);
        $stud_matric_no = $data['stud_matric_no'];
        $stud_name = $data['stud_name'];
        $stud_preferred_name = $data['stud_preferred_name'];

        $nameTextSize = strlen($stud_preferred_name) < 15 ? '22px' : '18px';
        $fileName = replaceFolderName($data['stud_name']);

        echo '<style>
                .containerMatric {
                    position: relative;
                    text-align: center;
                    color: black;
                }

                .studName {
                    position: absolute;
                    top: 70%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    font-size: ' . $nameTextSize . ';
                    font-weight: bold;
                }

                .matricNo {
                    position: absolute;
                    top: 81%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    font-size: 14px;
                    font-weight: normal;
                }

                .qrCode {
                    position: absolute;
                    top: 44.5%;
                    left: 49.2%;
                    transform: translate(-50%, -50%);
                }

                .studImage {
                    position: absolute;
                    top: 44.2%;
                    left: 49.2%;
                    transform: translate(-50%, -50%);
                }
            </style>';

        echo '<div class="row">
                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="card h-100">

                        <div id="matric1" class="containerMatric">
                            <img class="card-img-top" src="' . $matricFront . '" alt="Matric Card (Front)" style="width:100%;">
                            <img src="' . $stud_image . '" style="width:50%;" class="studImage">
                            <div class="studName"> ' . $stud_preferred_name . ' </div>
                            <div class="matricNo"> ' . $stud_matric_no . ' </div>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title"> Matric Card (Front) </h5>
                            <a href="javascript:void(0)" id="generate1" class="btn btn-sm btn-info" onclick="saveCardImage(1,' . $stud_id . ', \'' . $fileName . '\')"><i class="fa fa-download"></i> Download </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="card h-100">
                        <div id="matric2" class="containerMatric">
                            <img class="card-img-top" src="' . $matricBack . '" alt="Matric Card (Back)" style="width:100%;">
                            <img src="' . $stud_qrcode . '" style="width:52%;" class="qrCode">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"> Matric Card (Back) </h5>
                            <a href="javascript:void(0)" id="generate2" class="btn btn-sm btn-info" onclick="saveCardImage(2,' . $stud_id . ', \'' . $fileName . '\')"><i class="fa fa-download"></i> Download </a>
                        </div>
                    </div>
                </div>
            </div>';
    }

    public function getListAssessmentDiv()
    {
        $reportID = escape($_POST['report_id']);
        $data = $this->AM->assessmentSubjectByReportID($reportID);

        foreach ($data as $row) {
            $teacherName = $row['user_fullname'];
            $subjectID = $row['subject_id'];

            $statusEval = $row['assessment_status'];
            if ($statusEval == 0) {
                $status = '<span class="badge badge-sm bg-label-danger"> NOT EVALUATE YET </span>';
                $icon = "fas fa-close";
                $label = "danger";
            } else {
                $status = '<span class="badge badge-sm bg-label-success"> COMPLETED </span>';
                $icon = "fas fa-check";
                $label = "success";
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
                                    <small> ' . $teacherName . ' </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        }
    }

    public function studentCertByStudID()
    {
        $data = $this->Stud->getStudentDetailByID(escape($_POST['id']));
        $certTemplate = asset('upload/cert/template/CERT.jpeg');
        $certTemplate2 = asset('upload/cert/template/CERT_2.jpeg');

        $stud_matric_no = $data['stud_matric_no'];
        $stud_qrcode = asset($data['stud_qrcode']);
        $stud_name = $data['stud_name'];
        $stud_preferred_name = $data['stud_preferred_name'];

        $graduate_date =  date('d.m.Y', strtotime($data['graduate_date']));

        $nameTextSize = strlen($stud_name) > 38 ? '22px' : '26px';

        echo '<style>
                .containerCert {
                    position: relative;
                    text-align: center;
                    color: black;
                }

                .studName {
                    position: absolute;
                    top: 58.5%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    font-size: ' . $nameTextSize . ';
                    font-weight: bold;
                  }

                .gradDate {
                    position: absolute;
                    top: 78%;
                    left: 33%;
                    transform: translate(-50%, -50%);
                    font-size: 16px;
                    font-weight: normal;
                  }

                .matricNo {
                    position: absolute;
                    top: 64%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    font-size: 14px;
                    font-weight: normal;
                }

                .qrCode {
                    position: absolute;
                    top: 78%;
                    left: 90%;
                    transform: translate(-50%, -50%);
                }
             </style>';

        echo '<div class="containerCert">
                    <img src="' . $certTemplate2 . '" alt="Certificate" style="width:100%;">
                    <img src="' . $stud_qrcode . '" style="width:11.5%;" class="qrCode">
                    <div class="studName"> ' . $stud_name . ' </div>
                    <div class="matricNo"> STUDENT MATRIC : ' . $stud_matric_no . ' </div>
                    <div class="gradDate"> ' . $graduate_date . ' </div>
                </div>';
    }
}
