<?php

class Application
{
    protected $table = 'application';

    public function up()
    {
        $column =  [
            'application_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
                'null' => FALSE,
            ),
            'application_no' => array(
                'type' => 'VARCHAR',
                'length' => 150,
                'null' => TRUE,
            ),
            'application_date' => array(
                'type' => 'DATETIME',
                'null' => TRUE
            ),
            'application_stage' => array(
                'type' => 'TINYINT',
                'null' => TRUE,
                'comment' => '1-Application, 2-Registration',
                'after' => 'application_date',
                'default' => '1',
            ),
            'application_status' => array(
                'type' => 'TINYINT',
                'null' => TRUE,
                'comment' => '1-New Application, 2-Rejected Application, 3-Payment Registration, 4-Waiting Approval, 5-Rejected Payment, 6-Enrolled, 7-Graduate, 8-Withdraw, 9-Cancelled Application',
                'default' => '1',
            ),
            'application_remark' => array(
                'type' => 'VARCHAR',
                'length' => 255,
                'null' => TRUE,
            ),
            'approval_user_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'comment' => 'Refer table user',
                'null' => TRUE
            ),
            'approval_date' => array(
                'type' => 'DATETIME',
                'null' => TRUE
            ),
            'email_status' => array(
                'type' => 'TINYINT',
                'null' => TRUE,
                'comment' => '0 - unsend, 1-sent',
                'default' => '0',
            ),
            'email_date' => array(
                'type' => 'DATETIME',
                'null' => TRUE
            ),
            'enroll_date' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'graduate_date' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'withdraw_date' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'withdraw_reason' => array(
                'type' => 'VARCHAR',
                'length' => 255,
                'null' => TRUE,
            ),
            'level_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'comment' => 'Refer table config_level, enroll level start',
                'null' => TRUE
            ),
            'school_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'comment' => 'Refer table master_school',
                'null' => TRUE
            ),
            'parent_user_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'comment' => 'Refer table user',
                'null' => TRUE
            ),
        ];

        $key = [
            1 => ['type' => 'PRIMARY KEY', 'reference' => 'application_id'],
            2 => ['type' => 'INDEX', 'reference' => 'approval_user_id'],
            3 => ['type' => 'INDEX', 'reference' => 'level_id'],
            4 => ['type' => 'INDEX', 'reference' => 'school_id'],
            5 => ['type' => 'INDEX', 'reference' => 'parent_user_id'],
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
            'APPLICATION_SCHOOL' => array(
                'FOREIGN_KEY' => 'school_id',
                'REFERENCES_TABLE' => 'master_school',
                'REFERENCES_KEY' => 'school_id',
                'ON_DELETE' => 'CASCADE',
                'ON_UPDATE' => 'NO ACTION',
            ),
            'APPLICATION_LEVEL' => array(
                'FOREIGN_KEY' => 'level_id',
                'REFERENCES_TABLE' => 'config_level',
                'REFERENCES_KEY' => 'level_id',
                'ON_DELETE' => 'CASCADE',
                'ON_UPDATE' => 'NO ACTION',
            ),
            'APPLICATION_USER' => array(
                'FOREIGN_KEY' => 'parent_user_id',
                'REFERENCES_TABLE' => 'user',
                'REFERENCES_KEY' => 'user_id',
                'ON_DELETE' => 'CASCADE',
                'ON_UPDATE' => 'NO ACTION',
            ),
        ];

        addRelation($this->table, $relation);
        echo "Table <b style='color:red'><i>{$this->table}</i></b> relation added <br>";
    }
}