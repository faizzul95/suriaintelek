<?php

class StudentReportCard_model extends Model
{
    public $table      = 'student_report_card';
    public $primaryKey = 'report_id';
    public $uniqueKey = [];
    public $foreignKey = ['stud_id', 'academic_id', 'level_id', 'school_id', 'guardian_id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'stud_id',
        'subject_id',
        'academic_id',
        'level_id',
        'school_id',
        'guardian_id',
        'guardian_verify_status',
        'guardian_verify_date',
        'report_date',
        'report_month',
        'report_year',
        'report_status',
        'report_email_notify',
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected $rules = [
        'report_id' => 'numeric',
        'stud_id' => 'numeric',
        'academic_id' => 'numeric',
        'level_id' => 'numeric',
        'school_id' => 'numeric',
        'guardian_id' => 'numeric',
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
        'assessment',
        'guardianDetail',
        'studentDetail',
    ];

    ###################################################################
    #                                                                 #
    #               Start custom function below                       #
    #                                                                 #
    ###################################################################

    public function assessmentRelation($data)
    {
        return hasMany('StudentAssessment_model', 'report_id', $data[$this->primaryKey]);
    }

    public function guardianDetailRelation($data)
    {
        return hasOne('User_model', 'user_id', $data['guardian_id']);
    }

    public function studentDetailRelation($data)
    {
        return hasOne('Student_info_model', 'stud_id', $data['stud_id']);
    }

    public function getListByStudID($studentID, $decode = false)
    {
        if ($decode) {
            $studentID = decodeID($studentID);
        }

        //  server side datatables
        $cols = array(
            "report.report_date",
            "report.guardian_verify_status",
            "report.guardian_verify_date",
            "report.report_id",
        );

        $schoolID = session()->get('schoolID') ?? SCHOOL_ID;
        $this->db->where("report.school_id", $schoolID);
        $this->db->where("report.stud_id", $studentID);
        $this->db->where("report.report_status", '1');

        $this->db->join("config_level", "report.level_id=config_level.level_id", "LEFT");
        $this->db->join("student_info stud", "report.stud_id=stud.stud_id", "LEFT");
        $this->db->orderBy("report.created_at", "asc");
        $this->db->get($this->table . " report", null, $cols); // get data to show in table

        $this->serversideDt->query($this->getInstanceDB->getLastQuery());

        $this->serversideDt->edit('report_date', function ($data) {
            return date('l, d/m/Y', strtotime($data['report_date']));
        });

        $this->serversideDt->edit('guardian_verify_status', function ($data) {
            if ($data['guardian_verify_status'] == 0) {
                return '<span class="badge bg-label-warning"> NOT VERIFY </span>';
            } else {
                return '<span class="badge bg-label-success"> VERIFIED </span>';
            }
        });

        $this->serversideDt->edit('guardian_verify_date', function ($data) {
            return ($data['guardian_verify_date']) ? date('d/m/Y', strtotime($data['guardian_verify_date'])) : '';
        });

        $this->serversideDt->edit('report_id', function ($data) {
            $view = '';

            if ($data['guardian_verify_status'] == 0) {
                $view = '<button onclick="viewReport(' . $data['report_id'] . ')" data-id="' . $data['report_id'] . '" class="btn btn-sm btn-info" title="Verify"> <i class="fa fa-check"></i> </button>';
            } else {
                $view = '<button onclick="viewReport(' . $data['report_id'] . ')" data-id="' . $data['report_id'] . '" class="btn btn-sm btn-success" title="View Report"> <i class="fa fa-eye"></i> </button>';
            }

            return "<center> $view </center>";
        });

        echo $this->serversideDt->generate();
    }
}
