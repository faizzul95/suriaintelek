<?php

class StudentAssessmentItem_model extends Model
{
    public $table      = 'student_assessment_item';
    public $primaryKey = 'assessment_item_id';
    public $uniqueKey = [];
    public $foreignKey = ['assessment_id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'assessment_id',
        'assessment_item_desc',
        'assessment_item_grade',
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected $rules = [
        'assessment_item_id' => 'numeric',
        'assessment_id' => 'numeric',
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
    public $with = [];

    ###################################################################
    #                                                                 #
    #               Start custom function below                       #
    #                                                                 #
    ###################################################################

    public function countItemGrade($subID)
    {
        $this->db->where("assessment_id", $subID);
        $this->db->where("assessment_item_grade is NULL");
        return $this->db->getValue($this->table, "count(*)");
    }
}
