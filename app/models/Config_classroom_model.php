<?php

class Config_classroom_model extends Model
{
    public $table      = 'config_classroom';
    public $primaryKey = 'class_id';
    public $uniqueKey = [];
    public $foreignKey = ['school_id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'class_name',
        'class_max_student',
        'class_status',
        'school_id',
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected $rules = [
        'class_id' => 'numeric',
        'class_name' => 'required|min:1|max:50',
        'class_max_student' => 'required|numeric',
        'class_status' => 'required|numeric',
        'school_id' => 'required|numeric',
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

    public function getlist()
    {
        //  server side datatables
        $cols = array(
            "class_name",
            "class_max_student",
            "class_status",
            "class_id",
        );

        $schoolID = session()->get('schoolID') ?? SCHOOL_ID;
        $this->db->where("school_id", $schoolID);
        $result = $this->db->get($this->table, null, $cols);
        $this->serversideDt->query($this->getInstanceDB->getLastQuery());

        $this->serversideDt->edit('class_status', function ($data) {
            if ($data['class_status'] == 1) {
                return '<span class="badge bg-label-success">Active</span>';
            } else if ($data['class_status'] == 0) {
                return '<span class="badge bg-label-danger">Inactive</span>';
            } else {
                return '';
            }
        });

        $this->serversideDt->edit('class_id', function ($data) {
            $del = $edit = '';
            $edit = '<button class="btn btn-sm btn-info" onclick="updateRecord(' . $data[$this->primaryKey] . ')" title="Edit"><i class="fa fa-edit"></i> </button>';
            if ($this->countStudentInClass($data['class_id']) == 0) {
                $del = '<button onclick="deleteRecord(' . $data[$this->primaryKey] . ')" data-toggle="confirm" data-id="' . $data[$this->primaryKey] . '" class="btn btn-sm btn-danger" title="Remove"> <i class="fa fa-trash"></i> </button>';
            }

            return "<center> $del $edit </center>";
        });

        echo $this->serversideDt->generate();
    }

    function countStudentInClass($classID)
    {
        $schoolID = session()->get('schoolID') ?? SCHOOL_ID;
        $academicID = session()->get('academicID') ?? '1';

        $this->db->where("school_id", $schoolID);
        $this->db->where("class_id", $classID);
        $this->db->where("academic_id ", $academicID);
        return $this->db->getValue('student_enrollment', "count(*)");
    }

    public function getAllActiveClass()
    {
        $schoolID = session()->get('schoolID') ?? SCHOOL_ID; // get by session school id
        $this->db->where("school_id", $schoolID);
        $this->db->where("class_status", '1'); // get active status class
        return $this->db->get($this->table);
    }

    function countStudentInAY($classID)
    {
        $schoolID = session()->get('schoolID') ?? SCHOOL_ID;
        $academicID = session()->get('academicID') ?? '1';

        $this->db->where("school_id", $schoolID);
        $this->db->where("class_id", $classID);
        return $this->db->getValue('student_enrollment', "count(*)");
    }
}
