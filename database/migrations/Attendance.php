<?php

class Attendance
{
    protected $table = 'student_attendance';

    public function up()
    {
        $column =  [
            'attendance_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
                'null' => FALSE,
            ),
            'stud_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'comment' => 'Refer table student',
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
            'level_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'comment' => 'Refer table config_level',
                'null' => TRUE
            ),
            'class_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'comment' => 'Refer table config_classroom',
                'null' => TRUE
            ),
            'academic_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'comment' => 'Refer table config_academic_year',
                'null' => TRUE
            ),
            'school_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'comment' => 'Refer table school',
                'null' => TRUE
            ),
            'attendance_date' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'attendance_time' => array(
                'type' => 'TIME',
                'null' => TRUE
            ),
            'attendance_day' => array(
                'type' => 'VARCHAR',
                'length' => 15,
                'null' => TRUE,
            ),
            'attendance_month' => array(
                'type' => 'VARCHAR',
                'length' => 15,
                'null' => TRUE,
            ),
            'attendance_year' => array(
                'type' => 'VARCHAR',
                'length' => 15,
                'null' => TRUE,
            ),
            'attendance_status' => array(
                'type' => 'TINYINT',
                'null' => TRUE,
                'comment' => '0-no record, 1-present, 2-absent, 3-Others',
                'default' => '0',
            ),
            'attendance_remark' => array(
                'type' => 'VARCHAR',
                'length' => 255,
                'null' => TRUE,
            ),
        ];

        $key = [
            1 => ['type' => 'PRIMARY KEY', 'reference' => 'attendance_id'],
            2 => ['type' => 'INDEX', 'reference' => 'stud_id'],
            3 => ['type' => 'INDEX', 'reference' => 'academic_id'],
            4 => ['type' => 'INDEX', 'reference' => 'term_id'],
            5 => ['type' => 'INDEX', 'reference' => 'level_id'],
            6 => ['type' => 'INDEX', 'reference' => 'class_id'],
            7 => ['type' => 'INDEX', 'reference' => 'school_id'],
            8 => ['type' => 'INDEX', 'reference' => 'attendance_taken_by'],
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
            'ATTENDANCE_SCHOOL' => array(
                'FOREIGN_KEY' => 'school_id',
                'REFERENCES_TABLE' => 'master_school',
                'REFERENCES_KEY' => 'school_id',
                'ON_DELETE' => 'CASCADE',
                'ON_UPDATE' => 'NO ACTION',
            ),
            'ATTENDANCE_LEVEL' => array(
                'FOREIGN_KEY' => 'level_id',
                'REFERENCES_TABLE' => 'config_level',
                'REFERENCES_KEY' => 'level_id',
                'ON_DELETE' => 'CASCADE',
                'ON_UPDATE' => 'NO ACTION',
            ),
            'ATTENDANCE_USER' => array(
                'FOREIGN_KEY' => 'attendance_taken_by',
                'REFERENCES_TABLE' => 'user',
                'REFERENCES_KEY' => 'user_id',
                'ON_DELETE' => 'CASCADE',
                'ON_UPDATE' => 'NO ACTION',
            ),
            'ATTENDANCE_STUDENT' => array(
                'FOREIGN_KEY' => 'stud_id',
                'REFERENCES_TABLE' => 'student_info',
                'REFERENCES_KEY' => 'stud_id',
                'ON_DELETE' => 'CASCADE',
                'ON_UPDATE' => 'NO ACTION',
            ),
            'ATTENDANCE_ACADEMIC' => array(
                'FOREIGN_KEY' => 'academic_id',
                'REFERENCES_TABLE' => 'config_academic_year',
                'REFERENCES_KEY' => 'academic_id',
                'ON_DELETE' => 'CASCADE',
                'ON_UPDATE' => 'NO ACTION',
            ),
            'ATTENDANCE_CLASSROOM' => array(
                'FOREIGN_KEY' => 'class_id',
                'REFERENCES_TABLE' => 'config_classroom',
                'REFERENCES_KEY' => 'class_id',
                'ON_DELETE' => 'CASCADE',
                'ON_UPDATE' => 'NO ACTION',
            ),
        ];

        addRelation($this->table, $relation);
        echo "Table <b style='color:red'><i>{$this->table}</i></b> relation added <br>";
    }
}