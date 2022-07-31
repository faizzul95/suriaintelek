<?php

class Student_attendance_model extends Model
{
    public $table      = 'student_attendance';
    public $primaryKey = 'attendance_id';
    public $uniqueKey = [];
    public $foreignKey = ['stud_id', 'academic_id', 'term_id', 'level_id', 'class_id', 'school_id', 'teacher_user_id'];

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
        'teacher_user_id',
        'attendance_date',
        'attendance_time',
        'attendance_day',
        'attendance_month',
        'attendance_year',
        'attendance_status',
        'attendance_remark',
        'attendance_document_support',
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected $rules = [
        'attendance_id' => 'numeric',
        'stud_id' => 'numeric',
        'academic_id' => 'numeric',
        'term_id' => 'numeric',
        'level_id' => 'numeric',
        'class_id' => 'numeric',
        'school_id' => 'numeric',
        'teacher_user_id' => 'numeric',
        'attendance_date' => 'nullable|date',
        'attendance_status' => 'nullable|numeric',
        'attendance_remark' => 'nullable|min:1|max:250',
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

}
