<?php

class StudentReportCard
{
    protected $table = 'student_report_card';

    public function up()
    {
        $column =  [
            'report_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
                'null' => FALSE,
            ),
            'stud_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'comment' => 'Refer table student_info',
                'null' => TRUE
            ),
            'academic_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'comment' => 'Refer table config_academic_year',
                'null' => TRUE
            ),
            'level_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'comment' => 'Refer table config_level',
                'null' => TRUE
            ),
            'school_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'comment' => 'Refer table master_school',
                'null' => TRUE
            ),
            'guardian_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'comment' => 'Refer table user',
                'null' => TRUE
            ),
            'guardian_verify_status' => array(
                'type' => 'TINYINT',
                'length' => 1,
                'null' => TRUE,
                'default' => 0,
                'comment' => '0 - not verify, 1 - verify',
            ),
            'guardian_verify_date' => array(
                'type' => 'DATE',
                'null' => TRUE,
            ),
            'report_date' => array(
                'type' => 'DATE',
                'null' => TRUE,
            ),
            'report_month' => array(
                'type' => 'VARCHAR',
                'length' => 2,
                'null' => TRUE,
            ),
            'report_year' => array(
                'type' => 'VARCHAR',
                'length' => 4,
                'null' => TRUE,
            ),
            'report_status' => array(
                'type' => 'TINYINT',
                'length' => 1,
                'null' => TRUE,
                'default' => 0,
                'comment' => '0 - draft, 1 - posted',
            ),
            'report_email_notify' => array(
                'type' => 'TINYINT',
                'length' => 1,
                'null' => TRUE,
                'default' => 0,
                'comment' => '0 - unsent, 1 - sent',
            ),
        ];

        $key = [
            1 => ['type' => 'PRIMARY KEY', 'reference' => 'report_id'],
            2 => ['type' => 'INDEX', 'reference' => 'stud_id'],
            3 => ['type' => 'INDEX', 'reference' => 'academic_id'],
            4 => ['type' => 'INDEX', 'reference' => 'level_id'],
            5 => ['type' => 'INDEX', 'reference' => 'school_id'],
            6 => ['type' => 'INDEX', 'reference' => 'guardian_id'],
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
            'GUARDIAN_REPORT' => array(
                'FOREIGN_KEY' => 'guardian_id',
                'REFERENCES_TABLE' => 'user',
                'REFERENCES_KEY' => 'user_id',
                'ON_DELETE' => 'CASCADE',
                'ON_UPDATE' => 'NO ACTION',
            ),
            'STUDENT_REPORT' => array(
                'FOREIGN_KEY' => 'stud_id',
                'REFERENCES_TABLE' => 'student_info',
                'REFERENCES_KEY' => 'stud_id',
                'ON_DELETE' => 'CASCADE',
                'ON_UPDATE' => 'NO ACTION',
            ),
            'SCHOOL_REPORT' => array(
                'FOREIGN_KEY' => 'school_id',
                'REFERENCES_TABLE' => 'master_school',
                'REFERENCES_KEY' => 'school_id',
                'ON_DELETE' => 'CASCADE',
                'ON_UPDATE' => 'NO ACTION',
            ),
            'ACADEMIC_REPORT' => array(
                'FOREIGN_KEY' => 'academic_id',
                'REFERENCES_TABLE' => 'config_academic_year',
                'REFERENCES_KEY' => 'academic_id',
                'ON_DELETE' => 'CASCADE',
                'ON_UPDATE' => 'NO ACTION',
            ),
            'LEVEL_REPORT' => array(
                'FOREIGN_KEY' => 'level_id',
                'REFERENCES_TABLE' => 'config_level',
                'REFERENCES_KEY' => 'level_id',
                'ON_DELETE' => 'CASCADE',
                'ON_UPDATE' => 'NO ACTION',
            ),
        ];

        addRelation($this->table, $relation);
        echo "Table <b style='color:red'><i>{$this->table}</i></b> relation added <br>";
    }
}