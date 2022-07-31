<?php

class StudentAssessment_model extends Model
{
    public $table      = 'student_assessment';
    public $primaryKey = 'assessment_id';
    public $uniqueKey = [];
    public $foreignKey = ['report_id', 'subject_id', 'teacher_id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'report_id',
        'subject_id',
        'teacher_id',
        'assessment_date',
        'assessment_status',
        'assessment_remark',
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected $rules = [
        'assessment_id' => 'numeric',
        'report_id' => 'numeric',
        'subject_id' => 'numeric',
        'teacher_id' => 'numeric',
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
        'assessmentItem',
        'teacherDetail',
    ];

    ###################################################################
    #                                                                 #
    #               Start custom function below                       #
    #                                                                 #
    ###################################################################

    public function assessmentItemRelation($data)
    {
        if (isset($data[$this->primaryKey])) {
            return hasMany('StudentAssessmentItem_model', 'assessment_id', $data[$this->primaryKey]);
        }
    }

    public function teacherDetailRelation($data)
    {
        return hasOne('User_model', 'user_id', $data['teacher_id']);
    }

    public function countPostedAssessment($reportID)
    {
        $this->db->where("report_id", $reportID);
        $this->db->where("assessment_status", 1);
        return $this->db->getValue($this->table, "count(*)");
    }

    public function assessmentSubjectByReportID($reportID)
    {
        $this->db->where("assess.report_id", $reportID);
        $this->db->where("user.user_status", 1);
        $this->db->join("user", "assess.teacher_id=user.user_id", "LEFT");
        $this->db->join("config_subject", "assess.subject_id=config_subject.subject_id", "LEFT");
        return $this->db->get($this->table . ' assess', null); // get data to show in table
    }
}
