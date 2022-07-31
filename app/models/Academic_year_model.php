<?php

class Academic_year_model extends Model
{
    public $table      = 'config_academic_year';
    public $primaryKey = 'academic_id';
    public $uniqueKey = [];
    public $foreignKey = ['school_id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'academic_name',
        'academic_status',
        'school_id',
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected $rules = [
        'academic_id' => 'numeric',
        'academic_name' => 'required|min:1|max:50',
        'academic_status' => 'required|numeric',
        'school_id' => 'required|numeric',
    ];

    /**
     * Custom message for validation
     *
     * @return array
     */
    protected $messages = [
        'academic_name' => 'Academic Name',
        'academic_status' => 'Status'
    ];

    ###################################################################
    #                                                                 #
    #               Start custom function below                       #
    #                                                                 #
    ###################################################################

    public function getlist()
    {
        //  server side datatables
        $cols = array(
            "academic_name",
            "school_id", // dummy field
            "academic_status",
            "academic_id",
        );

        $schoolID = session()->get('schoolID') ?? '1';
        $this->db->where("school_id", $schoolID);
        $result = $this->db->get($this->table, null, $cols);
        $this->serversideDt->query($this->getInstanceDB->getLastQuery());

        $this->serversideDt->edit('academic_status', function ($data) {
            if ($data['academic_status'] == 1) {
                return '<span class="badge bg-label-success">Current</span>';
            } else if ($data['academic_status'] == 2) {
                return '<span class="badge bg-label-danger">Previous</span>';
            } else {
                return '';
            }
        });

        $this->serversideDt->edit('school_id', function ($data) {
            return $this->countStudentInAY($data['academic_id']);
        });

        $this->serversideDt->edit('academic_id', function ($data) {
            $del = $edit = $default = '';
            $edit = '<button class="btn btn-sm btn-info" onclick="updateRecord(' . $data[$this->primaryKey] . ')" title="Edit"><i class="fa fa-edit"></i> </button>';
            if ($data['academic_status'] != 1) {
                if ($this->countStudentInAY($data['academic_id']) == 0) {
                    $del = '<button onclick="deleteRecord(' . $data[$this->primaryKey] . ')" data-toggle="confirm" data-id="' . $data[$this->primaryKey] . '" class="btn btn-sm btn-danger" title="Remove"> <i class="fa fa-trash"></i> </button>';
                }
                $default = '<button class="btn btn-sm btn-primary" onclick="setDefault(' . $data[$this->primaryKey] . ')" title="Set default current"><i class="fa fa-lock"></i> </button>';
            }
            return "<center> $default $edit $del </center>";
        });

        echo $this->serversideDt->generate();
    }

    function getCurrentAY($schoolid = NULL)
    {
        $schoolID = $schoolid ?? session()->get('schoolID');
        $this->db->where("school_id", $schoolID);
        $this->db->where("academic_status", '1');
        return $this->db->fetchRow($this->table);
    }

    public function getAllAcademicYear()
    {
        $schoolID = session()->get('schoolID') ?? SCHOOL_ID; // get by session school id
        $this->db->where("school_id", $schoolID);
        return $this->db->get($this->table);
    }

    function countStudentInAY($academicID)
    {
        $this->db->where("school_id", SCHOOL_ID);
        $this->db->where("academic_id", $academicID);
        return $this->db->getValue('student_enrollment', "count(*)");
    }

    function setCurrentDefault($newCurrentID)
    {
        $this->db->where("school_id", SCHOOL_ID);
        $this->db->where("academic_status", 1);
        $result = $this->db->fetchRow($this->table);
        $previousID = $result['academic_id'];

        update($this->table, ["academic_status" => "2"], $previousID); // set previous
        return update($this->table, ["academic_status" => "1"], $newCurrentID); // set new current
    }
}
