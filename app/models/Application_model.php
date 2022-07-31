<?php

class Application_model extends Model
{
    public $table      = 'application';
    public $primaryKey = 'application_id';
    public $uniqueKey = ['application_no'];
    public $foreignKey = ['approval_user_id', 'level_id', 'school_id', 'parent_user_id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'application_no',
        'application_date',
        'application_stage',
        'application_status',
        'application_remark',
        'approval_user_id',
        'approval_date',
        'email_status',
        'email_date',
        'enroll_date',
        'graduate_date',
        'withdraw_date',
        'withdraw_reason',
        'level_id',
        'school_id',
        'parent_user_id',
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected $rules = [
        'application_id' => 'numeric',
        'application_no' => 'nullable|max:255',
        'application_stage' => 'numeric|min:1|max:7',
        'application_status' => 'required|numeric|min:1|max:10',
        'application_remark' => 'nullable|min:1|max:250',
        'approval_user_id' => 'nullable|numeric',
        'email_status' => 'nullable|numeric',
        'enroll_date' => 'nullable|date',
        'graduate_date' => 'nullable|date',
        'withdraw_date' => 'nullable|date',
        'withdraw_reason' => 'nullable|min:1|max:250',
        'level_id' => 'numeric',
        'school_id' => 'numeric',
        'parent_user_id' => 'numeric',
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

    public function getlist($status = null)
    {
        //  server side datatables
        $cols = array(
            "app.application_no",
            "user.user_fullname",
            "student_info.stud_name",
            "config_level.level_name",
            "app.application_date",
            "app.approval_date",
            "app.application_remark",
            "app.application_status",
            "app.application_id",
        );

        $schoolID = session()->get('schoolID') ?? SCHOOL_ID;
        $this->db->where("app.school_id", $schoolID);

        if (empty($status)) {
            $this->db->where('application_status', array(1, 2, 3, 4, 5, 9), 'IN');
        } else {
            $this->db->where("application_status", $status);
        }

        $this->db->join("user", "app.parent_user_id=user.user_id", "LEFT");
        $this->db->join("student_info", "app.application_id=student_info.application_id", "LEFT");
        $this->db->join("config_level", "app.level_id=config_level.level_id", "LEFT");
        $this->db->get($this->table . " app", null, $cols); // get data to show in table

        $this->serversideDt->query($this->getInstanceDB->getLastQuery());

        $this->serversideDt->edit('application_no', function ($data) {
            return '<a href="javascript:void(0)" onclick="viewApplication(' . $data['application_id'] . ')">' . $data['application_no'] . '</a>';
        });

        if (empty($status)) {
            $this->serversideDt->hide('approval_date');
            $this->serversideDt->hide('application_remark');
            $this->serversideDt->hide('application_id');

            $this->serversideDt->edit('application_date', function ($data) {
                return date('d/m/Y h:i A', strtotime($data['application_date']));
            });
        } else  if ($status == 1) {
            $this->serversideDt->hide('approval_date');
            $this->serversideDt->hide('application_remark');
            $this->serversideDt->hide('application_status');

            $this->serversideDt->edit('application_date', function ($data) {
                return date('d/m/Y h:i A', strtotime($data['application_date']));
            });
        } else  if ($status == 2) {
            $this->serversideDt->hide('level_name');
            $this->serversideDt->hide('application_date');
            $this->serversideDt->hide('application_status');
            $this->serversideDt->hide('application_id');

            $this->serversideDt->edit('approval_date', function ($data) {
                return date('d/m/Y h:i A', strtotime($data['approval_date']));
            });
        } else  if ($status == 3) {
            $this->serversideDt->hide('level_name');
            $this->serversideDt->hide('application_date');
            $this->serversideDt->hide('application_remark');

            $this->serversideDt->edit('approval_date', function ($data) {
                return date('d/m/Y h:i A', strtotime($data['approval_date']));
            });
        }

        $this->serversideDt->edit('application_status', function ($data) {
            if ($data['application_status'] == 1) {
                return '<span class="badge bg-label-primary">New</span>';
            } else if ($data['application_status'] == 2) {
                return '<span class="badge bg-label-danger">Rejected</span>';
            } else if ($data['application_status'] == 3) {
                return '<span class="badge bg-label-success">Approved</span> <br> <small class="text-danger"> Remark : Waiting for payment </small>';
            } else if ($data['application_status'] == 4) {
                return '<span class="badge bg-label-info">Payment Approval</span>';
            } else if ($data['application_status'] == 5) {
                return '<span class="badge bg-label-danger">Payment Rejected</span>';
            } else if ($data['application_status'] == 9) {
                return '<span class="badge bg-label-danger">Cancelled</span>';
            } else {
                return '';
            }
        });

        $this->serversideDt->edit('application_id', function ($data) {
            $del = $edit = $inv = '';
            if ($data['application_status'] == 1) {
                $del = '<button onclick="rejectApplication(' . $data[$this->primaryKey] . ')" data-toggle="confirm" data-id="' . $data[$this->primaryKey] . '" class="btn btn-sm btn-danger" title="Reject"> <i class="fa fa-close"></i> </button>';
            } else if ($data['application_status'] == 3 || $data['application_status'] == 4 || $data['application_status'] == 5) {
                $inv = '<button onclick="viewInv(' . $data[$this->primaryKey] . ')" data-id="' . $data[$this->primaryKey] . '" class="btn btn-sm btn-dark" title="View Invoice"> <i class="fas fa-file-invoice"></i> </button>';
            }
            $edit = '<button class="btn btn-sm btn-info" onclick="approveApplication(' . $data[$this->primaryKey] . ')" title="Approve"><i class="fa fa-check"></i> </button>';

            return "<center> $del $edit $inv </center>";
        });

        echo $this->serversideDt->generate();
    }


    public function getlistApprove()
    {
        //  server side datatables
        $cols = array(
            "app.application_no",
            "user.user_fullname",
            "student_info.stud_name",
            "config_level.level_name",
            "app.application_date",
            "app.approval_date",
            "app.application_remark",
            "app.application_status",
            "billing.billing_id",
            "app.application_id",
        );

        $schoolID = session()->get('schoolID') ?? SCHOOL_ID;
        $this->db->where("app.school_id", $schoolID);

        $this->db->where('application_status', array(3, 4, 5), 'IN');

        $this->db->join("user", "app.parent_user_id=user.user_id", "LEFT");
        $this->db->join("student_info", "app.application_id=student_info.application_id", "LEFT");
        $this->db->join("config_level", "app.level_id=config_level.level_id", "LEFT");
        $this->db->join("billing", "student_info.stud_id=billing.stud_id", "LEFT");
        $this->db->get($this->table . " app", null, $cols); // get data to show in table

        $this->serversideDt->query($this->getInstanceDB->getLastQuery());

        $this->serversideDt->edit('application_no', function ($data) {
            return '<a href="javascript:void(0)" onclick="viewApplication(' . $data['application_id'] . ')">' . $data['application_no'] . '</a>';
        });

        $this->serversideDt->hide('level_name');
        $this->serversideDt->hide('application_date');
        $this->serversideDt->hide('application_remark');
        $this->serversideDt->hide('billing_id'); // hides 'billing id' column from the output

        $this->serversideDt->edit('approval_date', function ($data) {
            return date('d/m/Y h:i A', strtotime($data['approval_date']));
        });

        $this->serversideDt->edit('application_status', function ($data) {
            if ($data['application_status'] == 1) {
                return '<span class="badge bg-label-primary">New</span>';
            } else if ($data['application_status'] == 2) {
                return '<span class="badge bg-label-danger">Rejected</span>';
            } else if ($data['application_status'] == 3) {
                return '<span class="badge bg-label-success">Approved</span> <br> <small class="text-danger"> Remark : Waiting for payment </small>';
            } else if ($data['application_status'] == 4) {
                return '<span class="badge bg-label-info">Payment Approval</span>';
            } else if ($data['application_status'] == 5) {
                return '<span class="badge bg-label-danger">Payment Rejected</span>';
            } else if ($data['application_status'] == 9) {
                return '<span class="badge bg-label-danger">Cancelled</span>';
            } else {
                return '';
            }
        });

        $this->serversideDt->edit('application_id', function ($data) {
            $del = $edit = $inv = '';
            if ($data['application_status'] == 1) {
                $del = '<button onclick="rejectApplication(' . $data[$this->primaryKey] . ')" data-toggle="confirm" data-id="' . $data[$this->primaryKey] . '" class="btn btn-sm btn-danger" title="Reject"> <i class="fa fa-close"></i> </button>';
            } else if ($data['application_status'] == 3 || $data['application_status'] == 4 || $data['application_status'] == 5) {
                $inv = '<button onclick="viewInv(' . $data['billing_id'] . ')" data-id="' . $data['billing_id'] . '" class="btn btn-sm btn-dark" title="View Invoice"> <i class="fas fa-file-invoice"></i> </button>';
            }
            $edit = '<button class="btn btn-sm btn-info" onclick="approveApplication(' . $data[$this->primaryKey] . ')" title="Approve"><i class="fa fa-check"></i> </button>';

            return "<center> $del $edit $inv </center>";
        });

        echo $this->serversideDt->generate();
    }

    public function countApp($status)
    {
        $schoolID = session()->get('schoolID') ?? SCHOOL_ID;
        $this->db->where("school_id", $schoolID);
        $this->db->where("application_status", $status);
        return $this->db->getValue($this->table, "count(*)");
    }

    public function appDetails($appID)
    {
        $schoolID = session()->get('schoolID') ?? SCHOOL_ID;
        $this->db->where("app.school_id", $schoolID);
        $this->db->where("app.application_id", $appID);
        $this->db->join("user", "app.parent_user_id=user.user_id", "LEFT");
        $this->db->join("student_info", "app.application_id=student_info.application_id", "LEFT");
        $this->db->join("config_level", "app.level_id=config_level.level_id", "LEFT");
        return $this->db->fetchRow($this->table . " app", null);
    }
}
