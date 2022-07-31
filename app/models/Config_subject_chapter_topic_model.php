<?php

class Config_subject_chapter_topic_model extends Model
{
    public $table      = 'config_subject_chapter_topic';
    public $primaryKey = 'topic_id';
    public $uniqueKey = [];
    public $foreignKey = ['subject_id', 'chapter_id', 'school_id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject_id',
        'chapter_id',
        'topic_no',
        'topic_desc',
        'school_id',
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected $rules = [
        'topic_id' => 'numeric',
        'topic_no' => 'min:1|max:10',
        'topic_desc' => 'min:1|max:100',
        'subject_id' => 'numeric',
        'chapter_id' => 'numeric',
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

    public function getAllTopicByFKID($subjectID, $chapterID)
    {
        $schoolID = session()->get('schoolID') ?? SCHOOL_ID; // get by session school id
        $this->db->where("school_id", $schoolID);
        $this->db->where("subject_id", $subjectID);
        $this->db->where("chapter_id", $chapterID);
        return $this->db->get($this->table);
    }

    public function countTopicNo($subjectID, $chapterID)
    {
        $schoolID = session()->get('schoolID') ?? SCHOOL_ID; // get by session school id
        $this->db->where("school_id", $schoolID);
        $this->db->where("subject_id", $subjectID);
        $this->db->where("chapter_id", $chapterID);
        return $this->db->getValue($this->table, "count(*)");
    }
}
