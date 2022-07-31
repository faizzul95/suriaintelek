<?php

class Billing_payment_model extends Model
{
    public $table      = 'billing_payment';
    public $primaryKey = 'payment_id';
    public $uniqueKey = [];
    public $foreignKey = ['billing_id', 'stud_id', 'school_id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'receipt_no',
        'payment_amount',
        'payment_date',
        'payment_via',
        'payment_status',
        'payment_user_id',
        'payment_remark',
        'payment_reason',
        'payment_receipt_file',
        'payment_receipt_file_type',
        'billing_id',
        'stud_id',
        'school_id',
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected $rules = [
        'payment_id' => 'numeric',
        'stud_id' => 'numeric',
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
    public function getPaymentDetailByID($paymentID, $decode = false)
    {
        if ($decode) {
            $paymentID = decodeID($paymentID);
        }

        $schoolID = session()->get('schoolID') ?? SCHOOL_ID;
        $this->db->where("bp.school_id", $schoolID);
        $this->db->where("bp.payment_id", $paymentID);

        $this->db->join("user", "bp.payment_user_id=user.user_id", "LEFT");
        return $this->db->fetchRow($this->table . " bp", null);
    }

    public function getPaymentListDt($status = NULL, $payment_date = NULL)
    {
        $cols = array(
            "billing_payment.receipt_no",
            "billing.invoice_no",
            "user.user_preferred_name",
            "billing_payment.payment_date",
            "billing_payment.payment_amount",
            "billing_payment.payment_via",
            "billing_payment.payment_status",
            "billing.billing_id",
            "billing_payment.payment_id",
        );

        $schoolID = session()->get('schoolID') ?? SCHOOL_ID;
        $this->db->where("billing_payment.school_id", $schoolID);
        if ($status != NULL) {
            $this->db->where("billing_payment.payment_status", $status);
        }

        if ($payment_date != NULL) {
            $this->db->where("billing_payment.payment_date", $payment_date);
        }

        $this->db->join("user", "billing_payment.payment_user_id=user.user_id", "LEFT");
        $this->db->join("billing", "billing_payment.billing_id=billing.billing_id", "LEFT");
        $this->db->get($this->table, null, $cols);

        $this->serversideDt->query($this->getInstanceDB->getLastQuery());

        $this->serversideDt->hide('billing_id'); // hides 'matric' column from the output

        $this->serversideDt->edit('invoice_no', function ($data) {
            return '<a href="javascript:void(0)" onclick="viewInv(' . $data['billing_id'] . ')">' . $data['invoice_no'] . '</a>';
        });

        $this->serversideDt->edit('payment_date', function ($data) {
            return date('d/m/Y', strtotime($data['payment_date']));
        });

        $this->serversideDt->edit('payment_status', function ($data) {
            if ($data['payment_status'] == 0) {
                return '<span class="badge bg-label-warning">PROCESSING</span>';
            } else if ($data['payment_status'] == 1) {
                return '<span class="badge bg-label-success">ACCEPTED</span>';
            } else if ($data['payment_status'] == 2) {
                return '<span class="badge bg-label-danger">DECLINED</span>';
            } else if ($data['payment_status'] == 3) {
                return '<span class="badge bg-label-info">OTHERS</span><br>
                <span class="badge bg-label-warning">BAL: ' . $data['balance_amount'] . '</span>';
            } else {
                return 'Undefined status';
            }
        });

        $this->serversideDt->edit('payment_id', function ($data) {
            if ($data['payment_status'] == 0) {
                return '<center><button onclick="paymentView(' . $data[$this->primaryKey] . ')" data-id="' . $data[$this->primaryKey] . '" class="btn btn-sm btn-success" title="Approve Payment"> <i class="fas fa-check"></i> </button></center>';
            } else {
                return '<center><button onclick="viewReceipt(' . $data[$this->primaryKey] . ')" data-id="' . $data[$this->primaryKey] . '" class="btn btn-sm btn-info" title="View Payment Details"> <i class="fas fa-eye"></i> </button></center>';
            }
        });

        echo $this->serversideDt->generate();
    }
}
