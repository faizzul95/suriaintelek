<?php

use Billing_model as BM;
use Config_preset_billing_model as PBM;
use Billing_payment_model as BPM;
use Billing_item_model as BIM;
use Master_runningno_model as RunningNo;
use Application_model as App;
use Student_info_model as Stud;
use User_model as Users;
use Notification_model as Noti;
use Log_record_model as Log;

class Billing extends Controller
{
    public function index()
    {
        if (session()->get('roleID') == 5) {
            redirect('billing/mybilling'); // redirect to page parent billing
        } else {
            redirect('settings/billing'); // redirect to page settings billing
        }
    }

    public function mybilling()
    {
        $data = [
            'title' => 'Billing',
            'currentSidebar' => 'billing',
            'currentSubSidebar' => 'billing',
            'userID' => session()->get('userID'),
        ];

        render('billing/parent_billing', $data);
    }

    public function invoice()
    {
        $data = [
            'title' => 'Invoice List',
            'currentSidebar' => 'billing',
            'currentSubSidebar' => 'invoice',
        ];

        render('billing/invoice_list', $data);
    }

    public function receipt()
    {
        $data = [
            'title' => 'Payment List',
            'currentSidebar' => 'billing',
            'currentSubSidebar' => 'receipt',
        ];

        render('billing/receipt_list', $data);
    }

    public function getPresetListDt()
    {
        echo $this->PBM->getlist();
    }

    public function getInvoiceListDt()
    {
        echo $this->BM->getInvoiceListDt();
    }

    public function getPaymentListDt()
    {
        echo $this->BPM->getPaymentListDt(escape($_POST['status']));
    }

    public function getPaymentDetailByID()
    {
        $data = $this->BPM->getPaymentDetailByID(escape($_POST['id']));
        json($data);
    }

    public function approvePaymentAction()
    {

        $status = $_POST['payment_status'];

        $data = BPM::update(
            [
                'payment_id' => $_POST['payment_id'],
                'payment_status' => $status,
            ]
        );

        $billing = BM::find($_POST['billing_id']);
        $payment = BPM::find($_POST['payment_id']);
        $user = Users::find($_POST['parent_user_id']);

        if ($status === '1') {

            if ($billing['balance_amount'] != '0.00') {
                $bal_amount = $billing['balance_amount'] - $payment['payment_amount'];
            } else {
                $bal_amount = '0.00';
            }

            if ($bal_amount == '0.00') {
                $payment_status = '1';
            } else {
                $payment_status = '3';
            }
        } else {
            $bal_amount = $billing['balance_amount'];
            $payment_status = $billing['payment_status'];
        }

        if (isset($data['resCode']) == 200) {

            //update billing
            BM::update(
                [
                    'billing_id' => $_POST['billing_id'],
                    'balance_amount' => $bal_amount,
                    'payment_status' => $payment_status,
                ]
            );

            // Add notification
            $getAdmissionAcc = Users::where(['role_id' => '3']);

            if (count($getAdmissionAcc) > 0) {
                foreach ($getAdmissionAcc as $noti) {
                    Noti::save(
                        [
                            'noti_type' => '3',
                            'noti_text' => 'Payment has been approved for Invoice No ' . $billing['invoice_no'] . '(Receipt No ' . $payment['receipt_no'] . ')',
                            'noti_redirect' => url('billing/view/' . encodeID($data['id'])),
                            'noti_status' => '0',
                            'user_id' => $noti['user_id'],
                            'user_preferred_name' => $user['user_preferred_name'],
                            'school_id' => '1',
                        ]
                    );
                }
            }

            // Add log
            Log::save(
                [
                    'log_event' => 'Approve Payment',
                    'log_remark' => 'Approve Payment Invoice no ' . $billing['invoice_no'] . ' submitted',
                    'log_date' => date('Y-m-d H:i:s'),
                    'log_type' => 'info',
                    'user_id' => $user['user_id'],
                    'school_id' => '1',
                ]
            );
        }

        json($data);
    }

    public function getPresetByID()
    {
        json(PBM::find($_POST['id']));
    }

    public function presetSave()
    {
        $data = PBM::updateOrInsert(
            [
                'preset_id' => $_POST['preset_id'],
                'preset_name' => $_POST['preset_name'],
                'preset_type' => $_POST['preset_type'],
                'preset_item_arr' =>  implode(",", $_POST['item_id']),
                'preset_status' => '1',
                'school_id' => '1',
            ]
        );
        json($data);
    }

    public function getSelectPreset()
    {
        $data = $this->PBM->getPresetBilling();
        echo '<option value=""> - Select - </option>';
        foreach ($data as $row) {
            echo '<option value="' . $row['preset_id'] . '""> ' . $row['preset_name'] . ' </option>';
        }
    }

    public function getInvDetailByInvoiceID()
    {
        $data = $this->BM->getInvDetailsByInvID(escape($_POST['id']));
        json($data);
    }

    public function getInvoiceByStudID()
    {
        $data = $this->BM->getInvByStudID(escape($_POST['stud_id']), escape($_POST['billing_type']));
        json($data);
    }

    public function getPaymentByStudID()
    {
        $data = $this->BM->getPaymentRecordByStudID(escape($_POST['id']));
        json($data);
    }

    public function getInvItemByBillingID()
    {
        $data = BIM::where(['billing_id' => $_POST['id']]);

        foreach ($data as $row) {
            $itemID = $row['billing_item_id'];
            $desc = $row['billing_item_description'];
            $type = $row['billing_item_type'];
            $totPrice = $row['billing_item_total_price'];
            $qty = $row['billing_item_qty'];
            $unitPrice = $row['billing_item_unit_price'];

            $debit = $credit = '';

            if ($type == 1) {
                $debit = $totPrice;
            } else {
                $credit = $totPrice;
            }

            echo '<tr>';
            echo "<td> $desc </td>";
            echo "<td style='border-left: thin solid rgb(192, 192, 192); text-align: center;'> $debit </td>";
            echo "<td style='border-left: thin solid rgb(192, 192, 192); text-align: center;'> $credit </td>";
            echo '</tr>';
        }
    }

    public function payment()
    {
        // generate receipt running no
        $recNo =  $this->RunningNo->generateReceiptNo();

        $billing = BM::find($_POST['billing_id']);
        $stud = Stud::find($billing['stud_id']);
        $app_id = $stud['application_id'];
        $studID = $stud['stud_id'];

        $app = App::find($app_id);
        $user = Users::find($app['parent_user_id']);

        $fileName = $fileExtension = $path = '';
        if (isset($_FILES['payment_receipt_file'])) {
            // get details of the uploaded file
            $fileTmpPath = $_FILES['payment_receipt_file']['tmp_name'];
            $fileName = $_FILES['payment_receipt_file']['name'];
            $fileSize = $_FILES['payment_receipt_file']['size'];
            $fileType = $_FILES['payment_receipt_file']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));
            $fileNameNew = $studID . "_" . date('dFY') . "_" . date('his') . '.' . $fileExtension;
            $folder = 'upload/invoice/registration';
            $path = $folder . '/' . $fileNameNew;
            move_uploaded_file($fileTmpPath, $path);
        }

        // save payment
        $data = BPM::save(
            [
                'receipt_no' => $recNo,
                'payment_amount' => $_POST['payment_amount'],
                'payment_date' => $_POST['payment_date'],
                'payment_via' => $_POST['payment_via'],
                'payment_status' => '0',
                'payment_remark' => $_POST['payment_remark'],
                'payment_receipt_file' => $path,
                'payment_receipt_file_type' => $fileExtension,
                'payment_user_id' => session()->get('userID'),
                'billing_id' => $_POST['billing_id'],
                'stud_id' => $studID,
                'school_id' => session()->get('schoolID'),
            ]
        );

        // update receipt running no
        if (isset($data['resCode']) == 200) {
            $this->RunningNo->updateReceiptNo();

            App::save(
                [
                    'application_id' => $app_id,
                    'application_status' => 4,
                ]
            );

            // Add notification
            $getAdmissionAcc = Users::where(['role_id' => '3']);

            if (count($getAdmissionAcc) > 0) {
                foreach ($getAdmissionAcc as $noti) {
                    Noti::save(
                        [
                            'noti_type' => '3',
                            'noti_text' => 'New payment has been submitted for Invoice No ' . $billing['invoice_no'],
                            'noti_redirect' => url('billing/view/' . encodeID($data['id'])),
                            'noti_status' => '0',
                            'user_id' => $noti['user_id'],
                            'user_preferred_name' => $user['user_preferred_name'],
                            'school_id' => '1',
                        ]
                    );
                }
            }

            // Add log
            Log::save(
                [
                    'log_event' => 'Payment',
                    'log_remark' => 'Payment Invoice no ' . $billing['invoice_no'] . ' submitted',
                    'log_date' => date('Y-m-d H:i:s'),
                    'log_type' => 'info',
                    'application_id' => $app_id,
                    'user_id' => $user['user_id'],
                    'school_id' => '1',
                ]
            );
        }

        json($data);
    }

    public function getListAccordionInvoiceByStudID()
    {
        $data = $this->BM->getInvByStudID(escape($_POST['stud_id']), escape($_POST['billing_type']));
        if (count($data) > 0) {
            $data = groupArray($data, ['billing_year']);
            $count = 1;
            echo '<div class="col-12">
                <div class="accordion mt-3 accordion-header-info" id="invoice">';
            foreach ($data as $year => $inv) {
                echo '
              <div class="accordion-item card">
                <h2 class="accordion-header">
                  <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#invoice-' . $count . '" aria-expanded="false">
                    ' . $year . '
                  </button>
                </h2>
        
                <div id="invoice-' . $count . '" class="accordion-collapse collapse" data-bs-parent="#invoice" style="">
                  <div class="accordion-body">
                    <table id="dataListInv" class="table table-bordered table-striped" width="100%">
                        <thead class="table-dark table border-top">
                            <tr>
                                <th> Invoice No. </th>
                                <th> Type </th>
                                <th> Amount </th>';
                if (session()->get('roleID') == 5) {
                    echo '<th> Issue Date </th>';
                    echo '<th> Due Date </th>';
                }
                echo '<th> Status</th>';
                echo (session()->get('roleID') == 5) ? '<th> Action </th>' : '';
                echo '</tr>
                        </thead>
                        <tbody>';

                foreach ($inv as $row) {

                    $billing_type = $row['billing_type'];
                    $payment_status = $row['payment_status'];
                    $actual_amount = $row['actual_amount'];

                    if ($billing_type == 1) {
                        $type = 'Application Fee';
                    } else if ($billing_type == 2) {
                        $type = 'Registration Fee';
                    } else if ($billing_type == 3) {
                        $type = 'Montly Fee';
                    } else if ($billing_type == 4) {
                        $type = 'Graduation Fee';
                    } else {
                        $type = 'Undefined type';
                    }

                    if ($payment_status == 0) {
                        $status = '<span class="badge bg-label-danger">UNPAID</span>';
                    } else if ($payment_status == 1) {
                        $status = '<span class="badge bg-label-success">PAID</span>';
                    } else if ($payment_status == 2) {
                        $status = '<span class="badge bg-label-danger">OVERDUE</span>';
                    } else if ($payment_status == 3) {
                        $status = '<span class="badge bg-label-info">PARTIAL</span><br>
                        <span class="badge bg-label-warning">BAL: ' . $row['balance_amount'] . '</span>';
                    } else if ($payment_status == 4) {
                        $status = '<span class="badge bg-label-warning">OUTSTANDING</span>';
                    } else {
                        $status = 'Undefined status';
                    }

                    $invNo = '<a href="javascript:void(0)" onclick="viewInv(' . $row['billing_id'] . ')" data-id="' . $row['application_id'] . '"> ' . $row['invoice_no'] . ' </a>';

                    echo '<tr>';
                    echo '<td> ' . $invNo . '</td>';
                    echo '<td> ' . $type . '   </td>';
                    echo '<td> ' . $row['actual_amount'] . ' </td>';
                    if (session()->get('roleID') == 5) {
                        echo '<td> ' . date('d/m/Y', strtotime($row['invoice_issue_date'])) . ' </td>';
                        echo '<td> ' . date('d/m/Y', strtotime($row['invoice_payment_date'])) . ' </td>';

                        $pay = $viewInv = '';
                        if ($payment_status != 1) {
                            $pay = '<button onclick="paymentForm(' . $row['billing_id'] . ', ' . $row['stud_id'] . ',\'' . $actual_amount . '\')" data-id="' . $row['billing_id'] . '" class="btn btn-sm btn-success" title="Pay"> <i class="fas fa-dollar-sign"></i> </button>';
                        }
                    }
                    echo '<td> ' . $status . ' </td>';
                    echo (session()->get('roleID') == 5) ? '<td> ' . $pay . ' ' . $viewInv . ' </td>' : '';
                    echo '</tr>';
                }

                echo '      </tbody>
                    </table>
                  </div>
                </div>
              </div>';

                $count++;
            }
            echo '</div>
        </div>';
        }
    }

    public function getListAccordionPaymentByStudID()
    {

        $data = $this->BM->getPaymentRecordByStudID(escape($_POST['id']));

        if (count($data) > 0) {
            $data = groupArray($data, ['billing_year']);
            $count = 1;
            echo '<div class="col-12">
                <div class="accordion mt-3 accordion-header-info" id="payment">';
            foreach ($data as $year => $inv) {
                echo '
              <div class="accordion-item card">
                <h2 class="accordion-header">
                  <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#payment-' . $count . '" aria-expanded="false">
                    ' . $year . '
                  </button>
                </h2>
        
                <div id="payment-' . $count . '" class="accordion-collapse collapse" data-bs-parent="#payment" style="">
                  <div class="accordion-body">
                    <table id="dataListInv" class="table table-bordered table-striped" width="100%">
                        <thead class="table-dark table border-top">
                            <tr>
                                <th> Receipt No. </th>
                                <th> Date </th>
                                <th> Amount </th>
                                <th> Status </th>
                            </tr>
                        </thead>
                        <tbody>';

                foreach ($inv as $row) {

                    $payment_status = $row['payment_status'];

                    if ($payment_status == 0) {
                        $status = '<span class="badge bg-label-warning">PROCESSING</span>';
                    } else if ($payment_status == 1) {
                        $status = '<span class="badge bg-label-success">ACCEPT</span>';
                    } else if ($payment_status == 2) {
                        $status = '<span class="badge bg-label-danger">DECLINE</span>';
                    } else if ($payment_status == 3) {
                        $status = '<span class="badge bg-label-info">OTHERS</span>';
                    } else {
                        $status = 'Undefined status';
                    }

                    $newDate = '';
                    if ($row['payment_date'] != NULL) {
                        $newDate = date("d/m/Y", strtotime($row['payment_date']));
                    }

                    echo '<tr>';
                    echo '<td> ' . $row['receipt_no'] . '</td>';
                    echo '<td> ' . $newDate . '   </td>';
                    echo '<td> ' . $row['payment_amount'] . ' </td>';
                    echo '<td> ' . $status . ' </td>';
                    echo '</tr>';
                }

                echo '      </tbody>
                    </table>
                  </div>
                </div>
              </div>';

                $count++;
            }
            echo '</div>
        </div>';
        }
    }
}