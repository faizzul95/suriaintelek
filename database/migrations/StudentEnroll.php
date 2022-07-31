<?php

class StudentEnroll
{
    protected $table = 'student_enrollment';

    public function up()
    {
        $column =  [
            'enrollment_id' => array(
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
            'school_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'comment' => 'Refer table master_school',
                'null' => TRUE
            )
        ];

        $key = [
            1 => ['type' => 'PRIMARY KEY', 'reference' => 'enrollment_id'],
            2 => ['type' => 'INDEX', 'reference' => 'stud_id'],
            3 => ['type' => 'INDEX', 'reference' => 'academic_id'],
            4 => ['type' => 'INDEX', 'reference' => 'term_id'],
            5 => ['type' => 'INDEX', 'reference' => 'level_id'],
            6 => ['type' => 'INDEX', 'reference' => 'class_id'],
            7 => ['type' => 'INDEX', 'reference' => 'school_id'],
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
            'ENROLLMENT_SCHOOL' => array(
                'FOREIGN_KEY' => 'school_id',
                'REFERENCES_TABLE' => 'master_school',
                'REFERENCES_KEY' => 'school_id',
                'ON_DELETE' => 'CASCADE',
                'ON_UPDATE' => 'NO ACTION',
            ),
            'ENROLLMENT_STUDENT' => array(
                'FOREIGN_KEY' => 'stud_id',
                'REFERENCES_TABLE' => 'student_info',
                'REFERENCES_KEY' => 'stud_id',
                'ON_DELETE' => 'CASCADE',
                'ON_UPDATE' => 'NO ACTION',
            ),
            'ENROLLMENT_CLASS' => array(
                'FOREIGN_KEY' => 'class_id',
                'REFERENCES_TABLE' => 'config_classroom',
                'REFERENCES_KEY' => 'class_id',
                'ON_DELETE' => 'CASCADE',
                'ON_UPDATE' => 'NO ACTION',
            ),
            'ENROLLMENT_ACADEMIC' => array(
                'FOREIGN_KEY' => 'academic_id',
                'REFERENCES_TABLE' => 'config_academic_year',
                'REFERENCES_KEY' => 'academic_id',
                'ON_DELETE' => 'CASCADE',
                'ON_UPDATE' => 'NO ACTION',
            ),
        ];

        addRelation($this->table, $relation);
        echo "Table <b style='color:red'><i>{$this->table}</i></b> relation added <br>";
    }
}