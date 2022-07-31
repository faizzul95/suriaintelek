<?php

class User_model extends Model
{
    public $table      = 'user';
    public $primaryKey = 'user_id';
    public $uniqueKey = ['user_email', 'user_username'];
    public $foreignKey = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_salutation',
        'user_fullname',
        'user_preferred_name',
        'user_nric',
        'user_gender',
        'user_email',
        'user_contact_no',
        'user_address',
        'user_postcode',
        'user_city',
        'user_state',
        'user_race',
        'user_religion',
        'user_job',
        'user_salary',
        'user_username',
        'user_password',
        'user_avatar',
        'user_status',
        'role_id',
        'school_id',
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected $rules = [
        'user_id' => 'numeric',
        // 'user_salutation' => 'required|min:1|max:10',
        // 'user_fullname' => 'required|min:1|max:255',
        // 'user_preferred_name' => 'required|min:1|max:20',
        // 'user_gender' => 'required|min:1|max:20',
        // 'user_email' => 'required|email|min:1|max:255',
        // 'user_contact_no' => 'required|min:1|max:15',
        // 'user_address' => 'required|min:1|max:255',
        // 'user_postcode' => 'required|min:1|max:255',
        // 'user_city' => 'required|min:1|max:100',
        // 'user_state' => 'required|min:1|max:100',
        // 'user_race' => 'min:1|max:20',
        // 'user_religion' => 'min:1|max:20',
        // 'user_username' => 'nullable|min:1|max:20',
        // 'user_password' => 'required|min:1|max:255',
        // 'role_id' => 'numeric',
        // 'school_id' => 'required|numeric',
    ];

    /**
     * Custom message for validation
     *
     * @return array
     */
    protected $messages = [
        'user_salutation' => 'salutation',
        'user_fullname' => 'name',
        'user_preferred_name' => 'preferred name',
        'user_gender' => 'gender',
        'user_email' => 'email',
        'user_contact_no' => 'contact no',
        'user_address' => 'address',
        'user_postcode' => 'postcode',
        'user_city' => 'city',
        'user_state' => 'state',
        'user_race' => 'race',
        'user_religion' => 'religion',
        'user_username' => 'username',
        'user_password' => 'password',
        'role_id' => 'role',
        'school_id' => 'school',
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
            "user_salutation",
            "user_fullname",
            "user_gender",
            "user_email",
            "user_id",
        );

        // $this->db->join("master_role", "user.role_id=master_role.role_id", "LEFT");
        // $this->db->where('user.user_status == 1'); 
        $result = $this->db->get("" . $this->table . "", null, $cols);

        $this->serversideDt->query($this->getInstanceDB->getLastQuery());

        // $this->serversideDt->hide('created_at'); // hides 'created_at' column from the output

        $this->serversideDt->edit('user_salutation', function ($data) {
            return '<a href="javascript:void(0)" onclick="viewRecord(' . $data[$this->primaryKey] . ')"> ' . $data['user_code'] . ' </a>';
        });

        $this->serversideDt->edit('user_gender', function ($data) {
            if ($data['user_gender'] == 1) {
                return 'Male';
            } else {
                return 'Female';
            }
        });

        $this->serversideDt->edit('user_id', function ($data) {
            $del = $edit =  '';
            $del = '<button onclick="deleteRecord(' . $data[$this->primaryKey] . ')" data-toggle="confirm" data-id="' . $data[$this->primaryKey] . '" class="btn btn-sm btn-danger" title="Delete"> <i class="fa fa-trash"></i> </button>';
            $edit = '<button class="btn btn-sm btn-info" onclick="updateRecord(' . $data[$this->primaryKey] . ')" title="Edit"><i class="fa fa-edit"></i> </button>';

            return "<center> $del $edit </center>";
        });

        echo $this->serversideDt->generate();
    }

    public function getUserLogin($params = NULL)
    {
        $this->db->where('user_email', $params);
        $this->db->orWhere('user_username', $params);
        return $this->db->fetchRow($this->table);
    }

    // Teacher
    public function getlistTeacher()
    {
        //  server side datatables
        $cols = array(
            "user_fullname",
            "user_nric",
            "user_email",
            "user_contact_no",
            "user_status",
            "user_id",
        );

        // $this->db->join("master_role", "user.role_id=master_role.role_id", "LEFT");
        $this->db->where("user.role_id ", '4');
        $result = $this->db->get($this->table . " user", null, $cols);

        $this->serversideDt->query($this->getInstanceDB->getLastQuery());

        $this->serversideDt->hide('user_contact_no'); // hides 'user_contact_no' column from the output
        $this->serversideDt->hide('user_nric'); // hides 'user_contact_no' column from the output

        $this->serversideDt->edit('user_fullname', function ($data) {
            return $data['user_fullname'] . '<br>' . $data['user_nric'];
        });

        $this->serversideDt->edit('user_email', function ($data) {
            return $data['user_email'] . '<br>' . $data['user_contact_no'];
        });

        $this->serversideDt->edit('user_status', function ($data) {
            if ($data['user_status'] == 0) {
                return '<span class="badge bg-label-warning">Inactive</span>';
            } else if ($data['user_status'] == 1) {
                return '<span class="badge bg-label-success">Active</span>';
            } else if ($data['user_status'] == 2) {
                return '<span class="badge bg-label-danger">Terminate</span>';
            } else {
                return '';
            }
        });

        $this->serversideDt->edit('user_id', function ($data) {

            $encodeID = encodeID($data['user_id']);

            $del = $edit =  '';
            $del = '<button onclick="deleteRecord(' . $data[$this->primaryKey] . ')" data-toggle="confirm" data-id="' . $data[$this->primaryKey] . '" class="btn btn-sm btn-danger" title="Delete"> <i class="fa fa-trash"></i> </button>';
            $edit = '<button class="btn btn-sm btn-info" onclick="viewRecord(' . $data[$this->primaryKey] . ', \'' . $encodeID . '\', \'' . base_url . '\')" title="View Record"><i class="fa fa-eye"></i> </button>';

            return "<center> $del $edit </center>";
        });

        echo $this->serversideDt->generate();
    }

    public function getlistParent()
    {
        //  server side datatables
        $cols = array(
            "user_fullname",
            "user_nric",
            "user_email",
            "user_contact_no",
            "user_status",
            "user_id",
        );

        // $this->db->join("master_role", "user.role_id=master_role.role_id", "LEFT");
        $this->db->where("user.role_id ", '5');
        $result = $this->db->get($this->table . " user", null, $cols);

        $this->serversideDt->query($this->getInstanceDB->getLastQuery());

        $this->serversideDt->hide('user_contact_no'); // hides 'user_contact_no' column from the output
        $this->serversideDt->hide('user_nric'); // hides 'user_contact_no' column from the output

        $this->serversideDt->edit('user_fullname', function ($data) {
            return $data['user_fullname'] . '<br>' . $data['user_nric'];
        });

        $this->serversideDt->edit('user_email', function ($data) {
            return $data['user_email'] . '<br>' . $data['user_contact_no'];
        });

        $this->serversideDt->edit('user_status', function ($data) {
            if ($data['user_status'] == 0) {
                return '<span class="badge bg-label-warning">Inactive</span>';
            } else if ($data['user_status'] == 1) {
                return '<span class="badge bg-label-success">Active</span>';
            } else if ($data['user_status'] == 2) {
                return '<span class="badge bg-label-danger">Terminate</span>';
            } else {
                return '';
            }
        });

        $this->serversideDt->edit('user_id', function ($data) {

            $encodeID = encodeID($data['user_id']);

            $del = $edit =  '';
            $del = '<button onclick="deleteRecord(' . $data[$this->primaryKey] . ')" data-toggle="confirm" data-id="' . $data[$this->primaryKey] . '" class="btn btn-sm btn-danger" title="Delete"> <i class="fa fa-trash"></i> </button>';
            $edit = '<button class="btn btn-sm btn-info" onclick="viewRecord(' . $data[$this->primaryKey] . ', \'' . $encodeID . '\', \'' . base_url . '\')" title="View Record"><i class="fa fa-eye"></i> </button>';

            return "<center> $del $edit </center>";
        });

        echo $this->serversideDt->generate();
    }

    public function getProfileByID($params = NULL)
    {
        $this->db->where($this->primaryKey, $params);
        return $this->db->fetchRow($this->table);
    }

    public function upload_save($data, $folder)
    {
        $image = $data['image'];
        list($type, $image) = explode(';', $image);
        list(, $image) = explode(',', $image);

        $image = base64_decode($image);
        $userID = $data['user_id'];
        $roleID = $data['role_id'];
        $filename = $data['filename'];

        $fileNameNew = $userID . "_" . date('dFY') . "_" . date('his') . '.jpg';
        $path = $folder . '/' . $fileNameNew;

        if (file_put_contents($path, $image)) {

            $dataUser = $this->getProfileByID($userID);
            $oldPic = $dataUser['user_avatar'];

            chown($path, 666);
            if (!empty($oldPic)) {
                if ($oldPic != 'upload/image/user/default/user.png') {
                    if (removefile($oldPic)) {
                        $data = [
                            'user_id' =>  $userID,
                            'user_avatar' => $path,
                        ];

                        return updateOrInsert($this->table, $data);
                    } else {
                        return ['resCode' => 400, 'message' => "Ops. Update unsuccessful"];
                    }
                } else {
                    $data = [
                        'user_id' =>  $userID,
                        'user_avatar' => $path,
                    ];

                    return updateOrInsert($this->table, $data);
                }
            } else {
                $data = [
                    'user_id' =>  $userID,
                    'user_avatar' => $path,
                ];

                return updateOrInsert($this->table, $data);
            }
        } else {
            return ['resCode' => 400, 'message' => "Ops. Profile upload failed"];
        }
    }

    public function getUserByRoleID($roleID)
    {
        $schoolID = session()->get('schoolID') ?? SCHOOL_ID;
        $this->db->where('school_id', $schoolID);
        $this->db->where('role_id', $roleID);
        return $this->db->get($this->table);
    }
}
