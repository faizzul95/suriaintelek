<?php

class Student_info_model extends Model
{
    public $table      = 'student_info';
    public $primaryKey = 'stud_id';
    public $uniqueKey = [];
    public $foreignKey = ['application_id', 'school_id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'stud_matric_no',
        'stud_name',
        'stud_preferred_name',
        'stud_nric',
        'stud_gender',
        'stud_race',
        'stud_dob',
        'stud_qrcode',
        'stud_image',
        'application_id',
        'user_relation',
        'school_id',
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected $rules = [
        'stud_id' => 'numeric',
        // 'stud_matric_no' => 'nullable|min:1|max:20',
        // 'stud_name' => 'required|min:1|max:250',
        // 'stud_preferred_name' => 'required|min:1|max:30',
        // 'stud_nric' => 'required|min:1|max:15',
        // 'stud_gender' => 'required|min:1|max:15',
        // 'stud_race' => 'required|min:1|max:30',
        // 'user_relation' => 'required|min:1|max:255',
        // 'stud_dob' => 'required|date',
        // 'school_id' => 'required|numeric',
        // 'application_id' => 'required|numeric',
    ];

    /**
     * Custom message for validation
     *
     * @return array
     */
    protected $messages = [
        'stud_matric_no' => 'Matric no',
        'stud_name' => 'Student Name'
    ];

    /**
     * Call funtion relation
     *
     * @return array
     */
    public $with = [
        'qrCode',
        'enrollment',
        'guardian',
    ];

    public function qrCodeRelation($data)
    {
        return hasOne('Files_model', 'entity_id', $data[$this->primaryKey], ['entity_file_type' => 'QR_CODE']);
    }

    public function enrollmentRelation($data)
    {
        return hasOne('Student_enroll_model', 'stud_id', $data[$this->primaryKey], ['academic_id' => session()->get('academicID')]);
    }

    ###################################################################
    #                                                                 #
    #               Start custom function below                       #
    #                                                                 #
    ###################################################################

    public function getStudentDetailByID($studentID, $decode = false)
    {
        if ($decode) {
            $studentID = decodeID($studentID);
        }

        $schoolID = session()->get('schoolID') ?? SCHOOL_ID;
        $academicID = session()->get('academicID') ?? SCHOOL_ID;

        $this->db->where("stud.school_id", $schoolID);
        $this->db->where("stud.stud_id", $studentID);
        $this->db->where("enroll.academic_id", $academicID);

        $this->db->join("application app", "stud.application_id=app.application_id", "LEFT");
        $this->db->join("user", "app.parent_user_id=user.user_id", "LEFT");
        $this->db->join("student_enrollment enroll", "stud.stud_id=enroll.stud_id", "LEFT");
        $this->db->join("config_classroom", "enroll.class_id=config_classroom.class_id", "LEFT");
        $this->db->join("config_level", "enroll.level_id=config_level.level_id", "LEFT");
        $this->db->join("config_academic_year", "enroll.academic_id=config_academic_year.academic_id", "LEFT");
        return $this->db->fetchRow($this->table . " stud", null); // get data to show in table
    }

    public function getStudentDetailBillingByID($studentID, $decode = false)
    {
        if ($decode) {
            $studentID = decodeID($studentID);
        }

        $schoolID = session()->get('schoolID') ?? SCHOOL_ID;
        $academicID = session()->get('academicID') ?? SCHOOL_ID;

        $this->db->where("stud.school_id", $schoolID);
        $this->db->where("stud.stud_id", $studentID);

        $this->db->join("application app", "stud.application_id=app.application_id", "LEFT");
        $this->db->join("user", "app.parent_user_id=user.user_id", "LEFT");

        return $this->db->fetchRow($this->table . " stud", null); // get data to show in table
    }

    public function getStudenListByParentIDDt($userID)
    {
        $cols = array(
            "stud.stud_name",
            "stud.stud_matric_no",
            "config_level.level_name",
            "config_classroom.class_name",
            "app.application_status",
            "stud.stud_id",
        );

        $schoolID = session()->get('schoolID') ?? SCHOOL_ID;

        $this->db->where("app.school_id", $schoolID);
        $this->db->where('app.application_status', array(6, 7, 8), 'IN');
        $this->db->where("app.parent_user_id", $userID);

        $this->db->join("user", "app.parent_user_id=user.user_id", "LEFT");
        $this->db->join("student_info stud", "app.application_id=stud.application_id", "LEFT");
        $this->db->join("student_enrollment enroll", "stud.stud_id=enroll.stud_id", "LEFT");
        $this->db->join("config_classroom", "enroll.class_id=config_classroom.class_id", "LEFT");
        $this->db->join("config_level", "enroll.level_id=config_level.level_id", "LEFT");
        $this->db->get("application app", null, $cols);

        $this->serversideDt->query($this->getInstanceDB->getLastQuery());

        $this->serversideDt->hide('stud_matric_no'); // hides 'matric' column from the output
        // $this->serversideDt->hide('stud_id'); // hides 'stud id' column from the output

        $this->serversideDt->edit('stud_name', function ($data) {
            return '<a href="javascript:void(0)" onclick="updateRecord(' . $data['stud_id'] . ', \'' . encodeID($data['stud_id']) . '\', \'' . base_url . '\')">' . $data['stud_name'] . ' <br> ' . $data['stud_matric_no'] . '</a>';
        });

        $this->serversideDt->edit('application_status', function ($data) {
            if ($data['application_status'] == 1) {
                return '<span class="badge bg-label-primary">New</span>';
            } else if ($data['application_status'] == 2) {
                return '<span class="badge bg-label-danger">Rejected</span>';
            } else if ($data['application_status'] == 3) {
                return '<span class="badge bg-label-success">Approved</span> <br> <small class="text-danger"> Remark : Waiting for payment </small>';
            } else if ($data['application_status'] == 4) {
                return '<span class="badge bg-label-info">Waiting Approval</span>';
            } else if ($data['application_status'] == 5) {
                return '<span class="badge bg-label-danger">Payment Rejected</span>';
            } else if ($data['application_status'] == 6) {
                return '<span class="badge bg-label-success">Enrolled</span>';
            } else if ($data['application_status'] == 7) {
                return '<span class="badge bg-label-primary">Graduate</span>';
            } else if ($data['application_status'] == 8) {
                return '<span class="badge bg-label-danger">Withdraw</span>';
            } else if ($data['application_status'] == 9) {
                return '<span class="badge bg-label-danger">Cancelled</span>';
            } else {
                return '';
            }
        });

        $this->serversideDt->edit('stud_id', function ($data) {
            $view = $inv = '';
            if ($data['application_status'] == 3 || $data['application_status'] == 4 || $data['application_status'] == 5) {
                $inv = '<button onclick="viewInv(' . $data['application_id'] . ')" data-id="' . $data['application_id'] . '" class="btn btn-sm btn-dark" title="View Invoice"> <i class="fas fa-file-invoice"></i> </button>';
            } else {
                $view = '<button class="btn btn-sm btn-success" onclick="updateRecord(' . $data['stud_id'] . ', \'' . encodeID($data['stud_id']) . '\', \'' . base_url . '\')" title="Profile Student"><i class="fa fa-graduation-cap"></i> </button>';
            }

            return "<center> $view $inv </center>";
        });

        echo $this->serversideDt->generate();
    }

    public function studenListBylevelIDDt($levelID)
    {
        $cols = array(
            "stud.stud_name",
            "stud.stud_matric_no",
            "config_level.level_name",
            "config_classroom.class_name",
            "app.application_status",
            "stud.stud_id",
        );

        $schoolID = session()->get('schoolID') ?? SCHOOL_ID;

        $this->db->where("app.school_id", $schoolID);
        $this->db->where("app.level_id", $levelID);
        $this->db->where('app.application_status', array(6, 7, 8), 'IN');

        $this->db->join("student_info stud", "app.application_id=stud.application_id", "LEFT");
        $this->db->join("student_enrollment enroll", "stud.stud_id=enroll.stud_id", "LEFT");
        $this->db->join("config_classroom", "enroll.class_id=config_classroom.class_id", "LEFT");
        $this->db->join("config_level", "enroll.level_id=config_level.level_id", "LEFT");
        $data = $this->db->get("application app", null, $cols);

        $this->serversideDt->query($this->getInstanceDB->getLastQuery());

        $this->serversideDt->hide('stud_matric_no'); // hides 'matric' column from the output
        // $this->serversideDt->hide('stud_id'); // hides 'stud id' column from the output

        $this->serversideDt->edit('stud_name', function ($data) {
            return '<a href="javascript:void(0)" onclick="updateRecord(' . $data['stud_id'] . ', \'' . encodeID($data['stud_id']) . '\', \'' . base_url . '\')">' . $data['stud_name'] . ' <br> ' . $data['stud_matric_no'] . '</a>';
        });

        $this->serversideDt->edit('application_status', function ($data) {
            if ($data['application_status'] == 1) {
                return '<span class="badge bg-label-primary">New</span>';
            } else if ($data['application_status'] == 2) {
                return '<span class="badge bg-label-danger">Rejected</span>';
            } else if ($data['application_status'] == 3) {
                return '<span class="badge bg-label-success">Approved</span> <br> <small class="text-danger"> Remark : Waiting for payment </small>';
            } else if ($data['application_status'] == 4) {
                return '<span class="badge bg-label-info">Waiting Approval</span>';
            } else if ($data['application_status'] == 5) {
                return '<span class="badge bg-label-danger">Payment Rejected</span>';
            } else if ($data['application_status'] == 6) {
                return '<span class="badge bg-label-success">Enrolled</span>';
            } else if ($data['application_status'] == 7) {
                return '<span class="badge bg-label-primary">Graduate</span>';
            } else if ($data['application_status'] == 8) {
                return '<span class="badge bg-label-danger">Withdraw</span>';
            } else if ($data['application_status'] == 9) {
                return '<span class="badge bg-label-danger">Cancelled</span>';
            } else {
                return '';
            }
        });

        $this->serversideDt->edit('stud_id', function ($data) {

            $view = '<button class="btn btn-sm btn-success" onclick="updateRecord(' . $data['stud_id'] . ', \'' . encodeID($data['stud_id']) . '\', \'' . base_url . '\')" title="Profile Student"><i class="fa fa-graduation-cap"></i> </button>';
            return "<center> $view </center>";
        });

        echo $this->serversideDt->generate();
    }

    public function getStudenListByParentID($userID)
    {
        $schoolID = session()->get('schoolID') ?? SCHOOL_ID;
        $this->db->where("app.school_id", $schoolID);
        $this->db->where("app.parent_user_id", $userID);
        $this->db->where('app.application_status', array(3, 4, 6, 7, 8), 'IN');
        $this->db->join("user", "app.parent_user_id=user.user_id", "LEFT");
        $this->db->join("student_info stud", "app.application_id=stud.application_id", "LEFT");
        return $this->db->get("application app", null);
    }

    public function studentSiblings($user_id, $stud_id)
    {
        $schoolID = session()->get('schoolID') ?? SCHOOL_ID;
        // $academicID = session()->get('academicID') ?? 'SCHOOL_ID';

        $this->db->where("app.school_id", $schoolID);
        $this->db->where("stud.stud_id!=$stud_id");
        $this->db->where('app.application_status', array(6, 7, 8), 'IN');
        $this->db->where("app.parent_user_id", $user_id);

        $this->db->join("user", "app.parent_user_id=user.user_id", "LEFT");
        $this->db->join("student_info stud", "app.application_id=stud.application_id", "LEFT");
        $this->db->join("student_enrollment enroll", "stud.stud_id=enroll.stud_id", "LEFT");
        $this->db->join("config_classroom", "enroll.class_id=config_classroom.class_id", "LEFT");
        $this->db->join("config_level", "enroll.level_id=config_level.level_id", "LEFT");
        return $this->db->get("application app", null); // get data to show in table
    }

    public function getProfileByID($params = NULL)
    {
        $this->db->where($this->primaryKey, $params);
        return $this->db->fetchRow($this->table);
    }

    public function upload_save($data)
    {
        $image = $data['image'];
        list($type, $image) = explode(';', $image);
        list(, $image) = explode(',', $image);

        $image = base64_decode($image);
        $studID = $data['stud_id'];
        $filename = $data['filename'];

        $dataUser = $this->getProfileByID($studID);
        $oldPic = $dataUser['stud_image'];
        $matric = $dataUser['stud_matric_no'];
        // $folder = folder($matric); // create folder
        $folderName = folder('directory/student', $matric, 'avatar');
        $fileNameNew = $studID . "_" . date('dFY') . "_" . date('his') . '.jpg';

        $path = $folderName . '/' . $fileNameNew;

        if (file_put_contents($path, $image)) {

            chown($path, 666);
            if (!empty($oldPic)) {
                if ($oldPic != 'default/student.png') {
                    // $removePath = 'upload/image/student/'  . $oldPic;
                    $removePath = $oldPic;
                    if (removefile($removePath)) {
                        $data = [
                            'stud_id' =>  $studID,
                            'stud_image' => $folderName . '/' . $fileNameNew,
                        ];

                        return updateOrInsert($this->table, $data);
                    } else {
                        return ['resCode' => 400, 'message' => "Ops. Update unsuccessful"];
                    }
                } else {
                    $data = [
                        'stud_id' =>  $studID,
                        'stud_image' => $folderName . '/' . $fileNameNew,
                    ];

                    return updateOrInsert($this->table, $data);
                }
            } else {
                $data = [
                    'stud_id' =>  $studID,
                    'stud_image' => $folderName . '/' . $fileNameNew,
                ];


                return updateOrInsert($this->table, $data);
            }
        } else {
            return ['resCode' => 400, 'message' => "Ops. Profile upload failed"];
        }
    }
}
