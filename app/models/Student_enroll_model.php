<?php

class Student_enroll_model extends Model
{
    public $table      = 'student_enrollment';
    public $primaryKey = 'enrollment_id';
    public $uniqueKey = [];
    public $foreignKey = ['stud_id', 'academic_id', 'term_id', 'level_id', 'class_id', 'school_id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'stud_id',
        'academic_id',
        'term_id',
        'level_id',
        'class_id',
        'school_id',
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected $rules = [
        'enrollment_id' => 'numeric',
        'stud_id' => 'numeric',
        'academic_id' => 'numeric',
        'term_id' => 'numeric',
        'level_id' => 'numeric',
        'class_id' => 'numeric',
        'school_id' => 'numeric',
    ];

    /**
     * Custom message for validation
     *
     * @return array
     */
    protected $messages = [];

    /**
     * Call funtion relation
     *
     * @return array
     */
    public $with = [
        'class',
        'academic',
        'level',
    ];

    public function classRelation($data)
    {
        return hasOne('Config_classroom_model', 'class_id', $data['class_id']);
    }

    ###################################################################
    #                                                                 #
    #               Start custom function below                       #
    #                                                                 #
    ###################################################################
    public function getlistAll($academic = null)
    {
        //  server side datatables
        $cols = array(
            "stud.stud_name",
            "stud.stud_matric_no",
            "config_level.level_name",
            "config_classroom.class_name",
            "application.application_status",
            "application.graduate_date",
            "application.withdraw_date",
            "application.withdraw_reason",
            "stud.stud_id",
            "enroll.enrollment_id",
        );

        $schoolID = session()->get('schoolID') ?? SCHOOL_ID;
        $this->db->where("application.school_id", $schoolID);
        $this->db->where('application.application_status', array(6, 7, 8), 'IN');
        $this->db->where("enroll.academic_id", $academic);

        $this->db->join("config_classroom", "enroll.class_id=config_classroom.class_id", "LEFT");
        $this->db->join("config_level", "enroll.level_id=config_level.level_id", "LEFT");
        $this->db->join("student_info stud", "enroll.stud_id=stud.stud_id", "LEFT");
        $this->db->join("application", "stud.application_id=application.application_id", "LEFT");
        $this->db->get($this->table . " enroll", null, $cols); // get data to show in table

        $this->serversideDt->query($this->getInstanceDB->getLastQuery());

        $this->serversideDt->hide('stud_id'); // hides 'stud_id' column from the output
        $this->serversideDt->hide('class_name'); // hides 'class_name' column from the output
        $this->serversideDt->hide('graduate_date'); // hides 'graduate_date' column from the output
        $this->serversideDt->hide('withdraw_date'); // hides 'withdraw_date' column from the output
        $this->serversideDt->hide('withdraw_reason'); // hides 'withdraw_reason' column from the output

        $this->serversideDt->edit('application_status', function ($data) {
            $statusID = $data['application_status'];

            if ($statusID == 6) {
                $status = '<span class="badge bg-label-success">Enrolled</span>';
            } else if ($statusID == 7) {
                $gradDate = (!empty($data['graduate_date'])) ? date('d/m/Y', strtotime($data['graduate_date'])) : '';
                $status = '<span class="badge bg-label-primary" title="Graduation date : ' . $gradDate . '">Graduate</span>';
            } else if ($statusID == 8) {
                $reason = $data['withdraw_reason'];
                $withdrawDate = (!empty($data['withdraw_date'])) ? date('d/m/Y', strtotime($data['withdraw_date'])) : '';
                $status = '<span class="badge bg-label-danger" title="Reason : ' . $reason . '">Withdraw</span>';
            }

            return $status;
        });

        $this->serversideDt->edit('level_name', function ($data) {
            return $data['level_name'] . ' / ' . $data['class_name'];
        });

        $this->serversideDt->edit('enrollment_id', function ($data) {
            $statusID = $data['application_status'];

            $view = $edit =  $print = '';
            $view = '<button onclick="viewStudent(' . $data['stud_id'] . ')" data-id="' . $data['stud_id'] . '" class="btn btn-sm btn-info" title="View Student"> <i class="fa fa-eye"></i> </button>';
            $edit = '<button class="btn btn-sm btn-dark" onclick="updateRecord(' . $data['stud_id'] . ', \'' . encodeID($data['stud_id']) . '\', \'' . base_url . '\')" title="Profile Student"><i class="fa fa-graduation-cap"></i> </button>';
            $print = '<button class="btn btn-sm btn-dark" onclick="printCert(' . $data[$this->primaryKey] . ')" title="Print Certificate"><i class="fa fa-print"></i> </button>';

            if ($statusID == 6) {
                return "<center> $view $edit</center>";
            } else if ($statusID == 7) {
                return "<center> $view $print</center>";
            }
        });

        echo $this->serversideDt->generate();
    }

    public function getlist($academic = null)
    {
        //  server side datatables
        $cols = array(
            "stud.stud_name",
            "stud.stud_matric_no",
            "config_level.level_name",
            "config_classroom.class_name",
            "stud.stud_id",
            "enroll.enrollment_id",
        );

        $schoolID = session()->get('schoolID') ?? SCHOOL_ID;
        $this->db->where("application.school_id", $schoolID);
        $this->db->where("application.application_status", '6');
        $this->db->where("enroll.academic_id", $academic);

        $this->db->join("config_classroom", "enroll.class_id=config_classroom.class_id", "LEFT");
        $this->db->join("config_level", "enroll.level_id=config_level.level_id", "LEFT");
        $this->db->join("student_info stud", "enroll.stud_id=stud.stud_id", "LEFT");
        $this->db->join("application", "stud.application_id=application.application_id", "LEFT");
        $this->db->get($this->table . " enroll", null, $cols); // get data to show in table

        $this->serversideDt->query($this->getInstanceDB->getLastQuery());

        $this->serversideDt->hide('stud_id'); // hides 'stud id' column from the output
        $this->serversideDt->hide('class_name'); // hides 'stud id' column from the output

        $this->serversideDt->edit('level_name', function ($data) {
            return $data['level_name'] . ' / ' . $data['class_name'];
        });

        $this->serversideDt->edit('enrollment_id', function ($data) {
            $view = $edit =  '';
            $view = '<button onclick="viewStudent(' . $data['stud_id'] . ')" data-id="' . $data['stud_id'] . '" class="btn btn-sm btn-info" title="View Student"> <i class="fa fa-eye"></i> </button>';
            $edit = '<button class="btn btn-sm btn-dark" onclick="updateRecord(' . $data['stud_id'] . ', \'' . encodeID($data['stud_id']) . '\', \'' . base_url . '\')" title="Profile Student"><i class="fa fa-graduation-cap"></i> </button>';

            return "<center> $view $edit </center>";
        });

        echo $this->serversideDt->generate();
    }

    public function getlistWithdraw($academic = null)
    {
        //  server side datatables
        $cols = array(
            "stud.stud_name",
            "stud.stud_matric_no",
            "config_level.level_name",
            "config_classroom.class_name",
            "application.withdraw_date",
            "application.withdraw_reason",
            "application.application_status",
            "stud.stud_id",
            "enroll.enrollment_id",
        );

        $schoolID = session()->get('schoolID') ?? SCHOOL_ID;
        $this->db->where("application.school_id", $schoolID);
        $this->db->where("application.application_status", '8');
        $this->db->where("enroll.academic_id", $academic);

        $this->db->join("config_classroom", "enroll.class_id=config_classroom.class_id", "LEFT");
        $this->db->join("config_level", "enroll.level_id=config_level.level_id", "LEFT");
        $this->db->join("student_info stud", "enroll.stud_id=stud.stud_id", "LEFT");
        $this->db->join("application", "stud.application_id=application.application_id", "LEFT");
        $this->db->get($this->table . " enroll", null, $cols); // get data to show in table

        $this->serversideDt->query($this->getInstanceDB->getLastQuery());

        $this->serversideDt->hide('stud_id'); // hides 'stud id' column from the output
        $this->serversideDt->hide('level_name'); // hides 'level name' column from the output
        $this->serversideDt->hide('class_name'); // hides 'class name' column from the output
        $this->serversideDt->hide('application_status'); // hides 'class name' column from the output
        $this->serversideDt->hide('enrollment_id'); // hides 'class name' column from the output

        $this->serversideDt->edit('stud_name', function ($data) {
            return '<a href="javascript:void(0)" onclick="viewStudent(' . $data['stud_id'] . ')">' . $data['stud_name'] . ' </a>';
        });

        $this->serversideDt->edit('application_status', function ($data) {
            return '<span class="badge bg-label-danger">Withdraw</span>';
        });

        $this->serversideDt->edit('withdraw_date', function ($data) {
            return (!empty($data['withdraw_date'])) ? date('d/m/Y', strtotime($data['withdraw_date'])) : '';
        });

        $this->serversideDt->edit('enrollment_id', function ($data) {
            $del = $edit =  '';
            $edit = '<button class="btn btn-sm btn-info" onclick="updateRecord(' . $data[$this->primaryKey] . ')" title="Edit"><i class="fa fa-edit"></i> </button>';

            return "<center> $del $edit </center>";
        });

        echo $this->serversideDt->generate();
    }

    public function getlistgGrad($academic = null)
    {
        //  server side datatables
        $cols = array(
            "stud.stud_name",
            "stud.stud_matric_no",
            "application.graduate_date",
            "stud.stud_id",
            "enroll.enrollment_id",
        );

        $schoolID = session()->get('schoolID') ?? SCHOOL_ID;
        $this->db->where("application.school_id", $schoolID);
        $this->db->where("application.application_status", '7');
        $this->db->where("enroll.academic_id", $academic);

        $this->db->join("config_classroom", "enroll.class_id=config_classroom.class_id", "LEFT");
        $this->db->join("config_level", "enroll.level_id=config_level.level_id", "LEFT");
        $this->db->join("student_info stud", "enroll.stud_id=stud.stud_id", "LEFT");
        $this->db->join("application", "stud.application_id=application.application_id", "LEFT");
        $this->db->get($this->table . " enroll", null, $cols); // get data to show in table

        $this->serversideDt->query($this->getInstanceDB->getLastQuery());

        $this->serversideDt->hide('stud_id'); // hides 'stud id' column from the output

        $this->serversideDt->edit('stud_name', function ($data) {
            return '<a href="javascript:void(0)" onclick="viewStudent(' . $data['stud_id'] . ')">' . $data['stud_name'] . ' </a>';
        });

        $this->serversideDt->edit('graduate_date', function ($data) {
            return (!empty($data['graduate_date'])) ? date('d/m/Y', strtotime($data['graduate_date'])) : '';
        });

        $this->serversideDt->edit('enrollment_id', function ($data) {
            $print = $edit =  '';
            $print = '<button class="btn btn-sm btn-dark" onclick="printCert(' . $data[$this->primaryKey] . ')" title="Print Certificate"><i class="fa fa-print"></i> </button>';

            return "<center> $print $edit </center>";
        });

        echo $this->serversideDt->generate();
    }

    public function getEnrollbyStudentId($stud_id = NULL)
    {
        $schoolID = session()->get('schoolID') ?? SCHOOL_ID;
        $this->db->where("enroll.school_id", $schoolID);
        $this->db->where("enroll.stud_id", $stud_id);

        $this->db->join("config_academic_year", "enroll.academic_id=config_academic_year.academic_id", "LEFT");
        $this->db->join("config_classroom", "enroll.class_id=config_classroom.class_id", "LEFT");
        $this->db->join("config_level", "enroll.level_id=config_level.level_id", "LEFT");
        $this->db->join("student_info stud", "enroll.stud_id=stud.stud_id", "LEFT");
        return $this->db->fetchRow($this->table . " enroll", null);
    }

    public function getEnrollDetailsByID($studentID, $decode = false)
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
        return $this->db->fetchRow("student_info stud", null); // get data to show in table
    }

    public function currentEnrolByLevelID($levelID)
    {
        $schoolID = session()->get('schoolID') ?? SCHOOL_ID;
        $academicID = session()->get('academicID') ?? SCHOOL_ID;

        $this->db->where("stud.school_id", $schoolID);
        $this->db->where("enroll.academic_id", $academicID);
        $this->db->where("enroll.level_id", $levelID);

        $this->db->join("application app", "stud.application_id=app.application_id", "LEFT");
        $this->db->join("user", "app.parent_user_id=user.user_id", "LEFT");
        $this->db->join("student_enrollment enroll", "stud.stud_id=enroll.stud_id", "LEFT");
        $this->db->join("config_classroom", "enroll.class_id=config_classroom.class_id", "LEFT");
        $this->db->join("config_level", "enroll.level_id=config_level.level_id", "LEFT");
        $this->db->join("config_academic_year", "enroll.academic_id=config_academic_year.academic_id", "LEFT");
        return $this->db->get("student_info stud", null); // get data to show in table
    }

    public function getSubjectByStudID($studID)
    {
        $schoolID = session()->get('schoolID') ?? SCHOOL_ID;
        $this->db->where("stud_enrol.school_id", $schoolID);
        $this->db->where("stud_enrol.stud_id", $studID);

        $this->db->join("config_academic_year academic", "stud_enrol.academic_id=academic.academic_id", "LEFT");
        $this->db->join("config_subject_level_linking sub_link", "stud_enrol.level_id=sub_link.level_id", "LEFT");
        $this->db->join("config_subject subject", "sub_link.subject_id=subject.subject_id", "LEFT");
        $this->db->join("config_subject_chapter chapter", "subject.subject_id=chapter.subject_id", "LEFT");
        $this->db->join("config_subject_chapter_topic topic", "chapter.chapter_id=topic.chapter_id", "LEFT");
        $this->db->orderBy("chapter.chapter_no", "asc");
        return $this->db->get($this->table . " stud_enrol", null);
    }
}
