<?php

class Config_subject_model extends Model
{
    public $table      = 'config_subject';
    public $primaryKey = 'subject_id';
    public $uniqueKey = [];
    public $foreignKey = ['school_id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject_code',
        'subject_name',
        'subject_remark',
        'subject_status',
        'school_id',
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected $rules = [
        'subject_id' => 'numeric',
        'subject_code' => 'min:1|max:50',
        'subject_name' => 'required|min:1|max:50',
        'subject_remark' => 'min:1|max:255',
        'subject_status' => 'required|numeric',
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
            "subject_code",
            "subject_name",
            "subject_remark",
            "subject_status",
            "subject_id",
        );

        $schoolID = session()->get('schoolID') ?? SCHOOL_ID;
        $this->db->where("school_id", $schoolID);
        $result = $this->db->get($this->table, null, $cols);
        $this->serversideDt->query($this->getInstanceDB->getLastQuery());

        $this->serversideDt->edit('subject_status', function ($data) {
            if ($data['subject_status'] == 1) {
                return 'active';
            } else if ($data['subject_status'] == 0) {
                return 'inactive';
            } else {
                return '';
            }
        });

        $this->serversideDt->edit('subject_id', function ($data) {
            $del = $edit = '';
            $del = '<button onclick="deleteRecord(' . $data[$this->primaryKey] . ')" data-toggle="confirm" data-id="' . $data[$this->primaryKey] . '" class="btn btn-sm btn-danger" title="Remove"> <i class="fa fa-trash"></i> </button>';
            $edit = '<button class="btn btn-sm btn-info" onclick="updateRecord(' . $data[$this->primaryKey] . ')" title="Edit"><i class="fa fa-edit"></i> </button>';

            return "<center> $del $edit </center>";
        });

        echo $this->serversideDt->generate();
    }

    public function getAllSubject()
    {
        $schoolID = session()->get('schoolID') ?? SCHOOL_ID; // get by session school id
        $this->db->where("school_id", $schoolID);
        return $this->db->get($this->table);
    }

    public function getAllActiveSubject()
    {
        $schoolID = session()->get('schoolID') ?? SCHOOL_ID; // get by session school id
        $this->db->where("school_id", $schoolID);
        $this->db->where("subject_status", '1'); // get active status subject
        return $this->db->get($this->table);
    }
}
