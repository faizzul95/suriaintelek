<?php

class Config_subject_level_linking_model extends Model
{
    public $table      = 'config_subject_level_linking';
    public $primaryKey = 'subject_level_id';
    public $uniqueKey = [];
    public $foreignKey = ['subject_id', 'level_id', 'school_id', 'teacher_user_id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject_id',
        'level_id',
        'teacher_user_id',
        'school_id',
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected $rules = [
        'subject_level_id' => 'numeric',
        'subject_id' => 'numeric',
        'level_id' => 'min:1|max:100',
        'teacher_user_id' => 'numeric',
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

    public function assignSubjectByLevelID($levelID)
    {
        $schoolID = session()->get('schoolID') ?? SCHOOL_ID;
        $this->db->where("assign.school_id", $schoolID);
        $this->db->where("assign.level_id", $levelID);
        $this->db->where("user.user_status", 1);
        $this->db->join("user", "assign.teacher_user_id=user.user_id", "LEFT");
        $this->db->join("config_subject", "assign.subject_id=config_subject.subject_id", "LEFT");
        return $this->db->get($this->table . ' assign', null); // get data to show in table
    }

    public function assignTeacherByLevelID($levelID)
    {
        $schoolID = session()->get('schoolID') ?? SCHOOL_ID;
        $this->db->where("assign.school_id", $schoolID);
        $this->db->where("assign.level_id", $levelID);
        $this->db->where("user.user_status", 1);
        $this->db->join("user", "assign.teacher_user_id=user.user_id", "LEFT");
        $this->db->join("config_subject", "assign.subject_id=config_subject.subject_id", "LEFT");
        $this->db->groupBy("assign.teacher_user_id");
        return $this->db->get($this->table . ' assign', null); // get data to show in table
    }

    public function levelByTeacherID()
    {
        $schoolID = session()->get('schoolID') ?? SCHOOL_ID;
        $userID = session()->get('userID');

        $this->db->where("assign.school_id", $schoolID);
        $this->db->where("assign.teacher_user_id", $userID);
        $this->db->where("user.user_status", 1);

        $this->db->join("user", "assign.teacher_user_id=user.user_id", "LEFT");
        $this->db->join("config_level", "assign.level_id=config_level.level_id", "LEFT");
        $this->db->groupBy("assign.level_id");
        return $this->db->get($this->table . ' assign', null); // get data to show in table
    }

    public function subjectByTeacherLevelID($levelID)
    {
        $schoolID = session()->get('schoolID') ?? SCHOOL_ID;
        $userID = session()->get('userID');

        $this->db->where("assign.school_id", $schoolID);
        $this->db->where("assign.teacher_user_id", $userID);
        $this->db->where("assign.level_id", $levelID);
        $this->db->where("user.user_status", 1);

        $this->db->join("user", "assign.teacher_user_id=user.user_id", "LEFT");
        $this->db->join("config_subject", "assign.subject_id=config_subject.subject_id", "LEFT");
        return $this->db->get($this->table . ' assign', null); // get data to show in table
    }

    public function subjectStudentAssignByLevelID($levelID)
    {
        $schoolID = session()->get('schoolID') ?? SCHOOL_ID;
        $this->db->where("assign.school_id", $schoolID);
        $this->db->where("assign.level_id", $levelID);
        $this->db->where("user.user_status", 1);
        $this->db->join("user", "assign.teacher_user_id=user.user_id", "LEFT");
        $this->db->join("config_subject", "assign.subject_id=config_subject.subject_id", "LEFT");
        return $this->db->get($this->table . ' assign', null); // get data to show in table
    }
}
