<?php

class Config_subject_chapter_subtopic_model extends Model
{
    public $table      = 'config_subject_chapter_subtopic';
    public $primaryKey = 'sub_topic_id';
    public $uniqueKey = [];
    public $foreignKey = ['topic_id', 'subject_id', 'chapter_id', 'school_id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'topic_id',
        'subject_id',
        'chapter_id',
        'sub_topic_no',
        'sub_topic_desc',
        'school_id',
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected $rules = [
        'sub_topic_id' => 'numeric',
        'topic_id' => 'numeric',
        'sub_topic_no' => 'min:1|max:10',
        'sub_topic_desc' => 'min:1|max:100',
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

    public function getAllSubTopicByFKID($subjectID, $chapterID, $topicID)
    {
        $schoolID = session()->get('schoolID') ?? SCHOOL_ID; // get by session school id
        $this->db->where("school_id", $schoolID);
        $this->db->where("subject_id", $subjectID);
        $this->db->where("chapter_id", $chapterID);
        $this->db->where("topic_id", $topicID);
        return $this->db->get($this->table);
    }

    public function countSubTopicNo($subjectID, $chapterID, $topicID)
    {
        $schoolID = session()->get('schoolID') ?? SCHOOL_ID; // get by session school id
        $this->db->where("school_id", $schoolID);
        $this->db->where("subject_id", $subjectID);
        $this->db->where("chapter_id", $chapterID);
        $this->db->where("topic_id", $topicID);
        return $this->db->getValue($this->table, "count(*)");
    }
}
