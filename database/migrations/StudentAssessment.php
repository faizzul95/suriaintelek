<?php

class StudentAssessment
{
    protected $table = 'student_assessment';

    public function up()
    {
        $column =  [
            'assessment_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
                'null' => FALSE,
            ),
            'report_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'null' => TRUE,
                'comment' => 'Refer table student_report_card',
            ),
            'subject_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'comment' => 'Refer table config_subject',
                'null' => TRUE
            ),
            'teacher_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'comment' => 'Refer table user',
                'null' => TRUE
            ),
            'assessment_date' => array(
                'type' => 'DATE',
                'null' => TRUE,
            ),
            'assessment_status' => array(
                'type' => 'TINYINT',
                'length' => 1,
                'null' => TRUE,
                'default' => 0,
                'comment' => '0 - draft, 1 - completed',
            ),
            'assessment_remark' => array(
                'type' => 'VARCHAR',
                'length' => 255,
                'null' => TRUE,
            ),
        ];

        $key = [
            1 => ['type' => 'PRIMARY KEY', 'reference' => 'assessment_id'],
            2 => ['type' => 'INDEX', 'reference' => 'report_id'],
            3 => ['type' => 'INDEX', 'reference' => 'subject_id'],
            4 => ['type' => 'INDEX', 'reference' => 'teacher_id'],
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
            'TEACHER_ASSESSMENT' => array(
                'FOREIGN_KEY' => 'teacher_id',
                'REFERENCES_TABLE' => 'user',
                'REFERENCES_KEY' => 'user_id',
                'ON_DELETE' => 'CASCADE',
                'ON_UPDATE' => 'NO ACTION',
            ),
            'REPORT_ASSESSMENT' => array(
                'FOREIGN_KEY' => 'report_id',
                'REFERENCES_TABLE' => 'student_report_card',
                'REFERENCES_KEY' => 'report_id',
                'ON_DELETE' => 'CASCADE',
                'ON_UPDATE' => 'NO ACTION',
            ),
            'SUBJECT_ASSESSMENT' => array(
                'FOREIGN_KEY' => 'subject_id',
                'REFERENCES_TABLE' => 'config_subject',
                'REFERENCES_KEY' => 'subject_id',
                'ON_DELETE' => 'CASCADE',
                'ON_UPDATE' => 'NO ACTION',
            ),
        ];

        addRelation($this->table, $relation);
        echo "Table <b style='color:red'><i>{$this->table}</i></b> relation added <br>";
    }
}