<?php

class Config_level_model extends Model
{
    public $table      = 'config_level';
    public $primaryKey = 'level_id';
    public $uniqueKey = [];
    public $foreignKey = ['school_id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'level_name',
        'level_status',
        'school_id',
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected $rules = [
        'level_id' => 'numeric',
        'level_name' => 'required|min:1|max:50',
        'level_status' => 'required|numeric',
        'school_id' => 'required|numeric',
    ];

    /**
     * Custom message for validation
     *
     * @return array
     */
    protected $messages = [
        'level_name' => 'level name',
        'level_status' => 'status',
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
            "level_name",
            "school_id",
            "level_status",
            "level_id",
        );

        $schoolID = session()->get('schoolID') ?? '1';
        $this->db->where("school_id", $schoolID);
        $result = $this->db->get($this->table, null, $cols);
        $this->serversideDt->query($this->getInstanceDB->getLastQuery());

        $this->serversideDt->edit('school_id', function ($data) {
            return $this->countStudentInLevel($data['level_id']);
        });

        $this->serversideDt->edit('level_status', function ($data) {
            if ($data['level_status'] == 0) {
                return '<span class="badge bg-label-danger">Inactive</span>';
            } else if ($data['level_status'] == 1) {
                return '<span class="badge bg-label-success">Active</span>';
            } else {
                return '';
            }
        });

        $this->serversideDt->edit('level_id', function ($data) {
            $del = $edit =  '';
            if ($this->countStudentInLevel($data['level_id']) == 0) {
                $del = '<button onclick="deleteRecord(' . $data[$this->primaryKey] . ')" data-toggle="confirm" data-id="' . $data[$this->primaryKey] . '" class="btn btn-sm btn-danger" title="Remove"> <i class="fa fa-trash"></i> </button>';
            }
            $edit = '<button class="btn btn-sm btn-info" onclick="updateRecord(' . $data[$this->primaryKey] . ')" title="Edit"><i class="fa fa-edit"></i> </button>';

            return "<center> $del $edit </center>";
        });

        echo $this->serversideDt->generate();
    }

    function countStudentInLevel($levelID)
    {
        $schoolID = session()->get('schoolID') ?? '1';
        $this->db->where("school_id", $schoolID);
        $this->db->where("level_id", $levelID);
        return $this->db->getValue('student_enrollment', "count(*)");
    }

    public function getAllActiveLevel()
    {
        // $schoolID = session()->get('schoolID') ?? '1'; // get by session school id
        $this->db->where("school_id", SCHOOL_ID);
        $this->db->where("level_status", '1'); // get active status level
        return $this->db->get($this->table);
    }
}
