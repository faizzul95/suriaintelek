<?php

class StudentInfo
{
    protected $table = 'student_info';

    public function up()
    {
        $column =  [
            'stud_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
                'null' => FALSE,
            ),
            'stud_matric_no' => array(
                'type' => 'VARCHAR',
                'length' => 50,
                'null' => TRUE,
                'comment' => 'generate by system and only generate for enroll student',
            ),
            'stud_name' => array(
                'type' => 'VARCHAR',
                'length' => 255,
                'null' => TRUE,
            ),
            'stud_preferred_name' => array(
                'type' => 'VARCHAR',
                'length' => 30,
                'null' => TRUE,
            ),
            'stud_nric' => array(
                'type' => 'VARCHAR',
                'length' => 15,
                'null' => TRUE,
            ),
            'stud_gender' => array(
                'type' => 'VARCHAR',
                'length' => 15,
                'null' => TRUE,
            ),
            'stud_race' => array(
                'type' => 'VARCHAR',
                'length' => 30,
                'null' => TRUE,
            ),
            'stud_dob' => array(
                'type' => 'DATE',
                'null' => TRUE,
            ),
            'stud_qrcode' => array(
                'type' => 'VARCHAR',
                'length' => 255,
                'null' => TRUE,
                'comment' => 'generate by system and generate using matric_no',
            ),
            'stud_image' => array(
                'type' => 'VARCHAR',
                'length' => 255,
                'null' => TRUE,
                'default' => 'upload/image/user/default/student.png',
            ),
            'application_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'comment' => 'Refer table application',
                'null' => TRUE
            ),
            'user_relation' => array(
                'type' => 'VARCHAR',
                'length' => 255,
                'comment' => 'Relationship with parent/guardian',
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
            1 => ['type' => 'PRIMARY KEY', 'reference' => 'stud_id'],
            2 => ['type' => 'INDEX', 'reference' => 'application_id'],
            3 => ['type' => 'INDEX', 'reference' => 'school_id'],
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
            'STUDENT_SCHOOL' => array(
                'FOREIGN_KEY' => 'school_id',
                'REFERENCES_TABLE' => 'master_school',
                'REFERENCES_KEY' => 'school_id',
                'ON_DELETE' => 'CASCADE',
                'ON_UPDATE' => 'NO ACTION',
            ),
            'STUDENT_APPLICATION' => array(
                'FOREIGN_KEY' => 'application_id',
                'REFERENCES_TABLE' => 'application',
                'REFERENCES_KEY' => 'application_id',
                'ON_DELETE' => 'CASCADE',
                'ON_UPDATE' => 'NO ACTION',
            ),
        ];

        addRelation($this->table, $relation);
        echo "Table <b style='color:red'><i>{$this->table}</i></b> relation added <br>";
    }
}