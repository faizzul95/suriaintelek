<?php

use Student_enroll_model as Enrol;
use Student_info_model as Stud;
use Application_model as App;
use Attendance_model as AT;

class Attendance extends Controller
{
    public function index()
    {
        error('404');
    }

    public function report()
    {
        $data = [
            'title' => 'Report Attendance',
            'currentSidebar' => 'attendance',
            'currentSubSidebar' => 'report'
        ];

        if (session()->get('roleID') == 4) {
            render('attendance/report_teacher', $data);
        } else {
            render('attendance/report', $data);
        }
    }

    public function record()
    {
        $data = [
            'title' => 'Record Attendance',
            'currentSidebar' => 'attendance',
            'currentSubSidebar' => 'record'
        ];

        render('attendance/record', $data);
    }

    public function recordAttendance()
    {
        $studID = (isset($_POST['stud_id'])) ? escape($_POST['stud_id']) : NULL;
        $studMatric = escape($_POST['stud_matric_no']);
        $status = escape($_POST['attendance_status']);

        if (empty($studID)) {
            $dataStudent = Stud::find($studMatric, 'stud_matric_no');
            $studID = $dataStudent['stud_id'];
        }

        // check if student enroll 
        $dataEnrol = $this->Enrol->getEnrollDetailsByID($studID);

        if (count($dataEnrol) > 0) {

            // check if attendance has been record
            $dataAtt = $this->AT->getAttendanceRecordByStudDetail($studID, $dataEnrol['academic_id'], $dataEnrol['level_id'], date('Y-m-d'));

            // save attendance
            $att = AT::updateOrInsert([
                'attendance_id' => (empty($dataAtt)) ? '' : $dataAtt['attendance_id'],
                'stud_id' => $studID,
                'academic_id' => $dataEnrol['academic_id'],
                'level_id' => $dataEnrol['level_id'],
                'class_id' => $dataEnrol['class_id'],
                'school_id' => session()->get('schoolID'),
                'teacher_user_id' => session()->get('userID'),
                'attendance_date' => date('Y-m-d'),
                'attendance_time' => date('H:i:s'),
                'attendance_day' => date('l'),
                'attendance_month' => date('m'),
                'attendance_year' => date('Y'),
                'attendance_status' => $status,
                'attendance_remark' => '',
            ]);
            json($att);
            exit();
        }

        json($dataEnrol);
    }

    public function getAttendanceListByStudID()
    {
        $month = (isset($_POST['month'])) ? $_POST['month'] : date('m');
        $year = (isset($_POST['year'])) ? $_POST['year'] : date('Y');

        $chkStudAtt = $this->AT->countStudAttendance(escape($_POST['id']), $year, $month);

        $result = NULL;

        if ($chkStudAtt > 0) {
            $totalDate = cal_days_in_month(CAL_GREGORIAN, $month, $year);

            $result .= '<table id="attendanceList" border="1" cellpadding="0" cellspacing="0" width="100%" class="table table-bordered">
                            <thead class="table-dark table border-top">
                                <tr align="center">
                                    <th> DAY </th>
                                    <th> DATE </th>
                                    <th> STATUS </th>
                                </tr>
                            </thead>
                        <tbody>';

            for ($day = 01; $day <= $totalDate; $day++) {

                $dateCombine = date('Y-m-d', strtotime($year . '-' . $month . '-' . $day));
                $daysFullName = date('l', strtotime($dateCombine));
                $dateFormat = date('d.m.Y', strtotime($dateCombine));

                if ($daysFullName != 'Sunday' && $daysFullName != 'Saturday') {
                    $result .= '<tr>';
                    $result .= '<td> ' . $daysFullName . '  </td>';
                    $result .= '<td> ' . $dateFormat . ' </td>';

                    $data = $this->AT->getListByStudID(escape($_POST['id']), $dateCombine);

                    if ($data != NULL) {
                        if ($data['attendance_status'] == 0) {
                            $status = '<i class="fa fa-times-circle fa-lg" style="color: #F23535;" title="No Record Found"></i>';
                        } else if ($data['attendance_status'] == 1) {
                            $status = '<i class="fa fa-check-circle fa-lg" style="color: #6EBF23;" Title="Present"></i>';
                        } else if ($data['attendance_status'] == 2) {
                            $status = '<i class="fa fa-exclamation-triangle fa-lg" style="color: #C6C343;" title="Absence"></i>';
                        } else {
                            $status = '<i class="fa fa-question-circle fa-lg" style="color: #868e96;" title="Others"></i>';
                        }
                    } else {
                        $status = '<i class="fa fa-times-circle fa-lg" style="color: #F23535;" title="No Record Found"></i>';
                    }

                    $result .= '<td align="center"> ' . $status . ' </td>';
                    $result .= '</tr>';
                }
            }

            $result .= '</tbody>
                    </table>';
            echo $result;

        } else {
            echo nodata();
        }
    }

    public function getListAttendanceRecordBylevelID()
    {
        $data = $this->Enrol->currentEnrolByLevelID(escape($_POST['level_id']));

        if (count($data) > 0) {

            $dayName = date('l');
            $canRecord = ($dayName == 'Saturday' or $dayName == 'Sunday') ? false : true;

            echo '<div class="card">
                    <div class="card-header border-bottom">
                        <h5 class="card-title">

                            ' . date('l, F jS, Y', strtotime(date('Y-m-d'))) . '

                            <button type="button" class="btn btn-warning btn-sm float-end ms-2" onclick="getDataStudentList()" title="Refresh">
                                <i class="fa fa-refresh"></i>
                            </button>

                            <input type="text" id="scannerInput" class="form-control form-control-sm float-end ms-2" oninput="saveAttendance()" style="width:20%" placeholder="Enter Student Number">

                        </h5>
                    </div>
                    <div class="card-body">';

            echo '<div class="table-responsive text-nowrap mt-4">
                    <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th width = "60%"> Student Name </th>
                            <th width = "20%"> Matric No </th>
                            <th width = "20%" align="center"> Status </th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">';

            $count = 1;
            foreach ($data as $row) {

                $studID = $row['stud_id'];
                $studName = $row['stud_name'];
                $matricNo = $row['stud_matric_no'];
                $status = $row['application_status'];
                echo '<tr>
                        <td> ' . $studName . ' </td>
                        <td> ' . $matricNo . ' </td>
                        <td> 
                            <center>';
                if ($canRecord) {
                    $checkAttendToday = AT::where(['stud_id' => $studID, 'attendance_date' => date('Y-m-d')], 'fetchRow');
                    $status = (!empty($checkAttendToday)) ? $checkAttendToday['attendance_status'] : '0';
                    $attend = ($status == "1") ? "selected" : NULL;
                    $absence = ($status == "2") ? "selected" : NULL;
                    $leave = ($status == "3") ? "selected" : NULL;

                    echo ' <select id="recordAttendance" class="form-control" onchange="recordData(\'' . $matricNo . '\', this.value, ' . $studID . ')">
                                    <option value=""> - Select - </option>
                                    <option value="1" ' . $attend . '> Attend </option>
                                    <option value="2" ' . $absence . '> Absence </option>
                                    <option value="3" ' . $leave . '> Leave / MC </option>
                                </select>';
                } else {
                    echo '<span class="badge bg-label-danger"> Not Available </span>';
                }
                echo ' </center> 
                        </td>
                    </tr>';

                $count++;
            }
            echo '  </tbody>
                    </table>
                </div>
                </div>
            </div>';
        } else {
            echo nodata();
        }
    }
}