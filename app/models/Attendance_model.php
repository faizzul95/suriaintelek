<?php

class Attendance_model extends Model
{
    public $table      = 'student_attendance';
    public $primaryKey = 'attendance_id';
    public $uniqueKey = [];
    public $foreignKey = ['stud_id', 'academic_id', 'term_id', 'level_id', 'class_id', 'school_id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'attendance_date',
        'attendance_time',
        'attendance_day',
        'attendance_month',
        'attendance_year',
        'attendance_status',
        'attendance_remark',
        'attendance_document_support',
        'stud_id',
        'academic_id',
        'term_id',
        'level_id',
        'class_id',
        'teacher_user_id',
        'school_id'
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected $rules = [
        'attendance_id' => 'numeric',
        'stud_id' => 'numeric',
        'school_id' => 'numeric',
    ];

    /**
     * Custom message for validation
     *
     * @return array
     */
    protected $messages = [];

    ###################################################################
    #                                                                 #
    #               Start custom function below                       #
    #                                                                 #
    ###################################################################
    function attendanceByAYMonth($levelID, $year, $month)
    {
        $schoolID = session()->get('schoolID') ?? SCHOOL_ID;

        $this->db->where("school_id", $schoolID);
        $this->db->where("level_id", $levelID);
        $this->db->where("attendance_year", $year);
        $this->db->where("attendance_month", $month);
        return $this->db->get($this->table, null);
    }

    function countStudAttendance($studentID, $year, $month)
    {
        $schoolID = session()->get('schoolID') ?? SCHOOL_ID;

        $this->db->where("school_id", $schoolID);
        $this->db->where("stud_id", $studentID);
        $this->db->where("attendance_year", $year);
        $this->db->where("attendance_month", $month);
        return $this->db->getValue($this->table, "count(*)");
    }

    public function getListByStudID($studentID, $dateCombine, $decode = false)
    {
        if ($decode) {
            $studentID = decodeID($studentID);
        }

        $schoolID = session()->get('schoolID') ?? SCHOOL_ID;
        $this->db->where("school_id", $schoolID);
        $this->db->where("stud_id", $studentID);
        $this->db->where("attendance_date", $dateCombine);

        return $this->db->fetchRow($this->table, null);
    }

    function getAttendanceRecordByStudDetail($studentID, $academicID, $levelID, $date)
    {
        $schoolID = session()->get('schoolID') ?? SCHOOL_ID;
        $this->db->where("school_id", $schoolID);
        $this->db->where("stud_id", $studentID);
        $this->db->where("academic_id", $academicID);
        $this->db->where("level_id", $levelID);
        $this->db->where("attendance_date", $date);
        return $this->db->fetchRow($this->table, null);
    }
}
