<?php

class Billing
{
    protected $table = 'billing';

    public function up()
    {
        $column =  [
            'billing_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
                'null' => FALSE,
            ),
            'stud_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'comment' => 'Refer table stud_info',
                'null' => TRUE
            ),
            'academic_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'comment' => 'Refer table config_academic_year',
                'null' => TRUE
            ),
            'term_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'comment' => 'Refer table config_term',
                'null' => TRUE
            ),
            'billing_month' => array(
                'type' => 'VARCHAR',
                'length' => 15,
                'null' => TRUE
            ),
            'billing_year' => array(
                'type' => 'VARCHAR',
                'length' => 4,
                'null' => TRUE
            ),
            'billing_type' => array(
                'type' => 'INT',
                'comment' => '1 - Application, 2 - Registration, 3 - Monthly, 4 - Graduation',
                'null' => TRUE,
                'default' => 3,
            ),
            'invoice_no' => array(
                'type' => 'VARCHAR',
                'length' => 50,
                'null' => TRUE
            ),
            'invoice_issue_date' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'invoice_payment_date' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'payment_status' => array(
                'type' => 'TINYINT',
                'comment' => '0-unpaid, 1-paid, 2-overdue, 3-partial payment, 4-outstanding',
                'null' => TRUE
            ),
            'actual_amount' => array(
                'type' => 'DECIMAL',
                'length' => "18,2",
                'null' => TRUE
            ),
            'balance_amount' => array(
                'type' => 'DECIMAL',
                'length' => "18,2",
                'null' => TRUE
            ),
            'billing_status' => array(
                'type' => 'TINYINT',
                'comment' => '0-draft, 1-confirm, 2-cancel, 3-posted',
                'null' => TRUE
            ),
            'school_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'comment' => 'Refer table master_school',
                'null' => TRUE
            ),
        ];

        $key = [
            1 => ['type' => 'PRIMARY KEY', 'reference' => 'billing_id'],
            2 => ['type' => 'INDEX', 'reference' => 'school_id'],
            3 => ['type' => 'INDEX', 'reference' => 'academic_id'],
            4 => ['type' => 'INDEX', 'reference' => 'stud_id'],
        ];

        migrate($this->table, $column, $key);
        echo "Table <b style='color:red'><i>{$this->table}</i></b> migrate running succesfully <br>";
    }

    public function down()
    {
        dropTable($this->table);
        echo "Table <b style='color:red'><i>{$this->table}</i></b> drop succesfully <br>";
    }

    public function relation()
    {
        $relation = [
            'BILLING_SCHOOL' => array(
                'FOREIGN_KEY' => 'school_id',
                'REFERENCES_TABLE' => 'master_school',
                'REFERENCES_KEY' => 'school_id',
                'ON_DELETE' => 'CASCADE',
                'ON_UPDATE' => 'NO ACTION',
            ),
            'BILLING_ACADEMIC' => array(
                'FOREIGN_KEY' => 'academic_id',
                'REFERENCES_TABLE' => 'config_academic_year',
                'REFERENCES_KEY' => 'academic_id',
                'ON_DELETE' => 'CASCADE',
                'ON_UPDATE' => 'NO ACTION',
            ),
            'BILLING_STUDENT' => array(
                'FOREIGN_KEY' => 'stud_id',
                'REFERENCES_TABLE' => 'student_info',
                'REFERENCES_KEY' => 'stud_id',
                'ON_DELETE' => 'CASCADE',
                'ON_UPDATE' => 'NO ACTION',
            ),
        ];

        addRelation($this->table, $relation);
        echo "Table <b style='color:red'><i>{$this->table}</i></b> relation added <br>";
    }
}