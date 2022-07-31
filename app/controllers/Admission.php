<?php

use Application_model as App;
use Student_info_model as Stud;
use Student_enroll_model as Enrol;
use Master_runningno_model as RunningNo;
use User_model as User;
use Log_record_model as Log;

use Billing_model as Bill;
use Billing_item_model as Item;
use Config_preset_billing_model as Preset;
use Config_item_fee_model as FeeItem;
use Files_model as Files;

class Admission extends Controller
{
    public function index()
    {
        // error('404');
        redirect('application/form', true);
    }

    public function form()
    {
        view('application/parent_form', ['title' => 'Register']);
    }

    public function all()
    {
        $data = [
            'title' => 'All Application',
            'currentSidebar' => 'application',
            'currentSubSidebar' => 'allApp'
        ];

        render('application/all_list', $data);
    }

    public function new()
    {
        $data = [
            'title' => 'New Application',
            'currentSidebar' => 'application',
            'currentSubSidebar' => 'new'
        ];

        render('application/new_list', $data);
    }

    public function reject()
    {
        $data = [
            'title' => 'New Application',
            'currentSidebar' => 'application',
            'currentSubSidebar' => 'reject'
        ];

        render('application/reject_list', $data);
    }

    public function approve()
    {
        $data = [
            'title' => 'Approved Application',
            'currentSidebar' => 'application',
            'currentSubSidebar' => 'approve'
        ];

        render('application/approve_list', $data);
    }

    public function getListAllDt()
    {
        echo $this->App->getlist();
    }

    public function getListNewDt()
    {
        echo $this->App->getlist(1);
    }

    public function getListRejectDt()
    {
        echo $this->App->getlist(2);
    }

    public function getListApproveDt()
    {
        echo $this->App->getlistApprove();
    }

    public function getAppByID()
    {
        json(App::find($_POST['id']));
    }

    public function getAppDetailByID()
    {
        json($this->App->appDetails($_POST['id']));
    }

    public function countApplication()
    {
        $data = [
            'new' => $this->App->countApp(1),
            'reject' => $this->App->countApp(2),
            'enrol' => $this->App->countApp(3)
        ];

        json($data);
    }

    public function rejectAction()
    {
        $_POST['approval_user_id'] = session()->get('userID');
        $_POST['approval_date'] = timestamp();

        // Add log
        Log::save(
            [
                'log_event' => 'Application',
                'log_remark' => 'Application no ' . $_POST['application_no'] . ' rejected by admission',
                'log_date' => timestamp(),
                'log_type' => 'success',
                'application_id' => $_POST['application_id'],
                'user_id' => $_POST['parent_user_id'],
                'school_id' => session()->get('schoolID'),
            ]
        );

        json(App::update($_POST));
    }

    public function approveApplicationAction()
    {
        // update application
        $_POST['approval_user_id'] = session()->get('userID');
        $_POST['approval_date'] = timestamp();
        $_POST['application_stage'] = '2';
        $_POST['application_status'] = '3';

        $stud = Stud::find($_POST['application_id'], 'application_id');

        // update user (parent) status
        User::update([
            'user_id' => $_POST['parent_user_id'],
            'user_status' => '1',
        ]);

        // Add log
        Log::save(
            [
                'log_event' => 'Application',
                'log_remark' => 'Application no ' . $_POST['application_no'] . ' approved by admission and waiting for payment made',
                'log_date' => timestamp(),
                'log_type' => 'success',
                'application_id' => $_POST['application_id'],
                'user_id' => $_POST['parent_user_id'],
                'school_id' => session()->get('schoolID'),
            ]
        );

        // GENERATE BILLING

        // first : register new billing and get id
        $billing = Bill::save(
            [
                'stud_id' => $stud['stud_id'],
                'academic_id' => session()->get('academicID'),
                'billing_month' => date('m'),
                'billing_year' => date('Y'),
                'billing_type' => '2',
                'invoice_issue_date' => $_POST['invoice_issue_date'],
                'invoice_payment_date' => $_POST['invoice_payment_date'],
                'payment_status' => '0',
                'billing_status' => '0',
                'school_id' => session()->get('schoolID'),
            ]
        );

        // second : find preset from user select
        $preset = Preset::find($_POST['preset_id']);
        $itemArr = explode(",", $preset['preset_item_arr']);

        $amount = 0;
        foreach ($itemArr as $item_id) {
            // third : find item and get amount 
            $item = FeeItem::find($item_id);

            // fourth : save fee item into billing item 
            Item::save(
                [
                    'billing_item_description' => $item['item_description'],
                    'billing_item_qty' => 1,
                    'billing_item_unit_price' => $item['item_price'],
                    'billing_item_total_price' => $item['item_price'],
                    'billing_item_type' => '1',
                    'billing_id' => $billing['id'],
                    'school_id' => session()->get('schoolID'),
                ]
            );

            // calculate total amount price
            $amount += $item['item_price'];
        }

        // Fifth : update billing amount 
        $invNo =  $this->RunningNo->generateInvoiceNo();
        $updateBiiling = Bill::update(
            [
                'invoice_no' => $invNo,
                'billing_id' => $billing['id'],
                'actual_amount' => $amount,
                'balance_amount' => $amount,
                'billing_status' => '3',
            ]
        );

        // update invoice running no
        if (isset($updateBiiling['resCode']) == 200) {
            $this->RunningNo->updateInvoiceNo();
        }

        $parent = User::find($_POST['parent_user_id'], 'user_id');

        $emailDetail = [
            'user_fullname' => $parent['user_fullname'],
            'application_no' => $_POST['application_no'],
            'user_nric' => $parent['user_nric'],
            'user_email' => $parent['user_email'],
            'invoice_no' => $invNo,
            'user_salutation' => $parent['user_salutation'],
        ];

        sentMail(5, ['parent_name' => $parent['user_fullname'], 'parent_email' => $parent['user_email'], 'subject' => 'Application Approval'], $emailDetail);

        json(App::update($_POST));
    }

    public function approveRegistrationAction()
    {
        $parent = User::find($_POST['parent_user_id'], 'user_id');

        if ($_POST['application_status'] == '6') {

            $stud = Stud::find($_POST['application_id'], 'application_id');

            // add enrol details
            Enrol::insert([
                'stud_id' => $stud['stud_id'],
                'academic_id' => $_POST['academic_id'],
                'term_id' => '0',
                'level_id' => $_POST['level_id'],
                'class_id' => $_POST['class_id'],
                'school_id' => session()->get('schoolID'),
            ]);

            // Add log
            Log::save(
                [
                    'log_event' => 'Registration',
                    'log_remark' => $stud['stud_name'] . ' have been enrolled',
                    'log_date' => timestamp(),
                    'application_id' => $_POST['application_id'],
                    'user_id' => $_POST['parent_user_id'],
                    'school_id' => session()->get('schoolID'),
                ]
            );

            // update student
            $stud_matric_no = $this->RunningNo->generateStudentNo();

            // generate folder for qr
            $folderQr = folder('directory/student', $stud_matric_no, 'qrcode');

            //generate QR Code
            $qrCode = generateQR(
                $stud_matric_no,
                $folderQr,
                ['image' => 'img/favicon/favicon.ico', 'size' => 120]
            );

            // move qr code to specific folder
            $moveQr = moveFile(
                $qrCode['qrFilename'],
                $qrCode['qrPath'],
                $folderQr,
                [
                    'type' => 'Student_info_model',
                    'file_type' => 'QR_CODE',
                    'entity_id' => $stud['stud_id'],
                    'user_id' => $stud['stud_id'],
                ],
                'copy'
            );

            if (!empty($moveQr)) {
                Files::save($moveQr);
            }

            // generate folder for student profile pic
            $folderAvatar = folder('directory/student', $stud_matric_no, 'avatar');

            // move image from default
            $moveImg = moveFile(
                'student.png',
                'upload/image/student/default/student.png',
                $folderAvatar,
                [
                    'type' => 'Student_info_model',
                    'file_type' => 'STUDENT_PROFILE',
                    'entity_id' => $stud['stud_id'],
                    'user_id' => $stud['stud_id'],
                ],
                'copy'
            );

            if (!empty($moveImg)) {
                Files::save($moveImg);
            }

            $studData = Stud::update([
                'stud_id' => $stud['stud_id'],
                'stud_matric_no' => $stud_matric_no,
                'stud_qrcode' => $qrCode['qrPath'],
                'stud_image' => (!empty($moveImg)) ? $moveImg['files_path'] : 'upload/image/student/default/student.png',
            ]);

            // update student running no
            if (isset($studData['resCode']) == 200) {
                $this->RunningNo->updateStudentNo();
            }

            // generate folder for parent profile pic
            $folderParentAvatar = folder('directory/parent', $parent['user_fullname'], 'avatar');

            // move image from default
            $moveParentImg = moveFile(
                'user.png',
                'upload/image/user/default/user.png',
                $folderParentAvatar,
                [
                    'type' => 'User_model',
                    'file_type' => 'PARENT_PROFILE',
                    'entity_id' => $parent['user_id'],
                    'user_id' => $parent['user_id'],
                ],
                'copy'
            );

            if (!empty($moveParentImg)) {
                Files::save($moveParentImg);

                // update user info
                $updateDataParent = [
                    'user_id' => $parent['id'],
                    'user_avatar' => $moveParentImg['files_path'],
                ];
                User::save($updateDataParent);
            }

            // sent mail 
            $studEnroll = $this->Enrol->getEnrollbyStudentId($stud['stud_id']);

            $emailDetail = [
                'user_fullname' => $parent['user_fullname'],
                'application_no' => escape($_POST['application_no']),
                'stud_name' => $stud['stud_name'],
                'user_email' => $parent['user_email'],
                'stud_matric_no' => $stud_matric_no,
                'user_salutation' => $parent['user_salutation'],
                'academic_name' => $studEnroll['academic_name'],
                'level_name' => $studEnroll['level_name'],
                'class_name' => $studEnroll['class_name'],
            ];

            sentMail(6, ['parent_name' => $parent['user_fullname'], 'parent_email' => $parent['user_email'], 'subject' => 'Enrollment'], $emailDetail);

        } else if ($_POST['application_status'] == '5') {

            // Add log
            Log::save(
                [
                    'log_event' => 'Registration',
                    'log_remark' => 'Registration payment for application no ' . $_POST['application_no'] . ' has been declined',
                    'log_date' => timestamp(),
                    'application_id' => $_POST['application_id'],
                    'log_type' => 'danger',
                    'user_id' => $_POST['parent_user_id'],
                    'school_id' => session()->get('schoolID'),
                ]
            );

            $emailDetail = [
                'user_fullname' => $parent['user_fullname'],
                'application_no' => escape($_POST['application_no']),
                'user_email' => $parent['user_email'],
                'user_salutation' => $parent['user_salutation'],
            ];

            sentMail(8, ['parent_name' => $parent['user_fullname'], 'parent_email' => $parent['user_email'], 'subject' => 'Registration Fee Payment'], $emailDetail);

        } else if ($_POST['application_status'] == '9') {

            // Add log
            Log::save(
                [
                    'log_event' => 'Registration',
                    'log_remark' => 'Application no ' . $_POST['application_no'] . ' has been cancelled/withdraw',
                    'log_date' => timestamp(),
                    'application_id' => $_POST['application_id'],
                    'log_type' => 'danger',
                    'user_id' => $_POST['parent_user_id'],
                    'school_id' => session()->get('schoolID'),
                ]
            );
            
        }

        json(App::update($_POST));
    }
}
