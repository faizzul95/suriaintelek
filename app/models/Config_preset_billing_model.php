<?php

class Config_preset_billing_model extends Model
{
    public $table      = 'config_preset_billing';
    public $primaryKey = 'preset_id';
    public $uniqueKey = [];
    public $foreignKey = ['school_id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'preset_name',
        'preset_type',
        'preset_item_arr',
        'preset_status',
        'school_id',
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected $rules = [
        'preset_id' => 'numeric',
        'preset_name' => 'required|min:1|max:150',
        'preset_type' => 'required|min:1|max:150',
        'preset_item_arr' => 'min:1|max:250',
        'preset_status' => 'required|numeric',
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
            "preset_name",
            "preset_type",
            "preset_status",
            "preset_id",
        );

        $schoolID = session()->get('schoolID') ?? SCHOOL_ID;
        $this->db->where("school_id", $schoolID);
        $result = $this->db->get($this->table, null, $cols);
        $this->serversideDt->query($this->getInstanceDB->getLastQuery());

        $this->serversideDt->edit('preset_status', function ($data) {
            if ($data['preset_status'] == 1) {
                return '<span class="badge bg-label-success">Active</span>';
            } else if ($data['preset_status'] == 0) {
                return '<span class="badge bg-label-danger">Inactive</span>';
            } else {
                return '';
            }
        });

        $this->serversideDt->edit('preset_type', function ($data) {
            if ($data['preset_type'] == 1) {
                return 'Application Fees';
            } else if ($data['preset_type'] == 2) {
                return 'Registration Fees';
            } else if ($data['preset_type'] == 3) {
                return 'Monthly Fees';
            } else if ($data['preset_type'] == 4) {
                return 'Graduation Fees';
            } else {
                return '';
            }
        });

        $this->serversideDt->edit('preset_id', function ($data) {
            $del = $edit = '';
            $edit = '<button class="btn btn-sm btn-info" onclick="updatePresetRecord(' . $data[$this->primaryKey] . ')" title="Edit"><i class="fa fa-edit"></i> </button>';
            $del = '<button onclick="deletePresetRecord(' . $data[$this->primaryKey] . ')" data-toggle="confirm" data-id="' . $data[$this->primaryKey] . '" class="btn btn-sm btn-danger" title="Remove"> <i class="fa fa-trash"></i> </button>';

            return "<center>  $del $edit </center>";
        });

        echo $this->serversideDt->generate();
    }

    public function getPresetBilling()
    {
        $schoolID = session()->get('schoolID') ?? SCHOOL_ID; // get by session school id
        $this->db->where("school_id", $schoolID);
        return $this->db->get($this->table);
    }
}
