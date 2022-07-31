<?php

use User_model as Users;
use Application_model as App;
use Student_info_model as Stud;
use Student_guardian_model as Guardian;
use Master_runningno_model as RunningNo;
use General_content_model as GC;
use Notification_model as Noti;
use Log_record_model as Log;
use Config_level_model as LM;

class Application extends Controller
{
    public function index()
    {
        redirect('application/form', true);
    }

    public function form()
    {
        view('application/parent_form', ['title' => 'Register']);
    }

    public function addNewApplication()
    {
        // First : register user / parent / guardian
        $findUser = Users::where([
            'user_email' => $_POST['user_email'],
            'school_id' => SCHOOL_ID
        ]);

        $users = ($findUser) ? $findUser : Users::save(
            [
                'user_email' => $_POST['user_email'],
                'user_salutation' => $_POST['user_salutation'],
                'user_fullname' => $_POST['user_fullname'],
                'user_preferred_name' => $_POST['user_preferred_name'],
                'user_nric' => $_POST['user_nric'],
                'user_contact_no' => $_POST['user_contact_no'],
                'user_address' => $_POST['user_address'],
                'user_postcode' => $_POST['user_postcode'],
                'user_city' => $_POST['user_city'],
                'user_state' => $_POST['user_state'],
                'user_gender' => $_POST['user_gender'],
                'user_religion' => $_POST['user_religion'],
                'user_race' => $_POST['user_race'],
                'user_job' => $_POST['user_job'],
                'user_salary' => $_POST['user_salary'],
                'user_status' => '0',
                'user_username' => NULL,
                'user_password' => password_hash($_POST['user_nric'], PASSWORD_DEFAULT),
                'user_avatar' => 'upload/image/user/default/user.png',
                'role_id' => '5',
                'school_id' => '1',
            ]
        );

        if (isset($users['resCode']) == '200' || $findUser) {

            $countStudent = count($_POST['stud_name']);
            $user_id = (isset($users['id'])) ? $users['id'] : $findUser[0]['user_id'];
            if ($countStudent > 0) {
                foreach ($_POST['stud_name'] as $key => $studentName) {

                    $applicationNo = $this->RunningNo->generateApplicationNo();

                    // Second : register application
                    $application = App::save(
                        [
                            'application_no' => $applicationNo,
                            'application_date' => date('Y-m-d H:i:s'),
                            'application_stage' => '1',
                            'application_status' => '1',
                            'level_id' => $_POST['level_id'][$key],
                            'school_id' => '1',
                            'parent_user_id' => $user_id,
                        ]
                    );

                    // Third : register student
                    if (isset($application['resCode']) == '200') {

                        // Add notification
                        $getAdmissionAcc = Users::where(['role_id' => '3']);

                        if (count($getAdmissionAcc) > 0) {
                            foreach ($getAdmissionAcc as $data) {
                                Noti::save(
                                    [
                                        'noti_type' => '1',
                                        'noti_text' => 'New application has been submitted ' . $applicationNo,
                                        'noti_redirect' => url('application/view/' . encodeID($application['id'])),
                                        'noti_status' => '0',
                                        'user_id' => $data['user_id'],
                                        'user_preferred_name' => escape($_POST['user_preferred_name']),
                                        'school_id' => '1',
                                    ]
                                );
                            }
                        }

                        // Add log
                        Log::save(
                            [
                                'log_event' => 'Application',
                                'log_remark' => 'Application no ' . $applicationNo . ' submitted',
                                'log_date' => date('Y-m-d H:i:s'),
                                'log_type' => 'info',
                                'application_id' => $application['id'],
                                'user_id' => $user_id,
                                'school_id' => '1',
                            ]
                        );

                        $this->RunningNo->updateApplicationNo(); // update running application no
                        $student = Stud::save(
                            [
                                'stud_name' => $studentName,
                                'stud_preferred_name' => $_POST['stud_preferred_name'][$key],
                                'stud_nric' => $_POST['stud_nric'][$key],
                                'stud_gender' => $_POST['stud_gender'][$key],
                                'stud_race' => $_POST['stud_race'][$key],
                                'stud_dob' => $_POST['stud_dob'][$key],
                                'stud_dob' => $_POST['stud_dob'][$key],
                                'user_relation' => $_POST['user_relation'][$key],
                                'school_id' => '1',
                                'application_id' => $application['id'],
                            ]
                        );

                        // Fourth : Add parent linking
                        if (isset($student['resCode']) == '200') {

                            $linking = Guardian::save(
                                [
                                    'stud_id' => $student['id'],
                                    'user_id' => $user_id,
                                ]
                            );

                            sentMail(4, ['parent_name' => $_POST['user_fullname'], 'parent_email' => $_POST['user_email'], 'subject' => 'Application Submitted'], $application['data']);

                            json($linking);
                            
                        } else {
                            json($student); // sent error student validations
                        }
                    } else {
                        json($application); // sent error application validations
                    }
                }
            }
        } else {
            json($users); // sent error user validations
        }
    }

    public function getSelectLevel()
    {
        $data = $this->LM->getAllActiveLevel();
        echo '<option value=""> - Select - </option>';
        foreach ($data as $row) {
            echo '<option value="' . $row['level_id'] . '""> ' . $row['level_name'] . '</option>';
        }
    }

    public function getTnC()
    {
        $data = $this->GC->getTnCdata();
        json($data);
    }

    public function getPrivacy()
    {
        $data = $this->GC->getPrivacydata();
        json($data);
    }
}