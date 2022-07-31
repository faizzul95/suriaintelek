<?php

class ConfigLevelSubject
{
    protected $table = 'config_subject_level_linking';

    public function up()
    {
        $column =  [
            'subject_level_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
                'null' => FALSE,
            ),
            'subject_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'comment' => 'Refer table config_subject',
                'null' => TRUE,
            ),
            'level_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'comment' => 'Refer table config_level',
                'null' => TRUE,
            ),
            'teacher_user_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'comment' => 'Refer table user',
                'null' => TRUE,
            ),
            'school_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'comment' => 'Refer table master_school',
                'null' => TRUE,
            ),
        ];

        $key = [
            1 => ['type' => 'PRIMARY KEY', 'reference' => 'subject_level_id'],
            2 => ['type' => 'INDEX', 'reference' => 'subject_id'],
            3 => ['type' => 'INDEX', 'reference' => 'level_id'],
            4 => ['type' => 'INDEX', 'reference' => 'teacher_user_id'],
            5 => ['type' => 'INDEX', 'reference' => 'school_id'],
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
            'LEVELSUBJECT_SCHOOL' => array(
                'FOREIGN_KEY' => 'school_id',
                'REFERENCES_TABLE' => 'master_school',
                'REFERENCES_KEY' => 'school_id',
                'ON_DELETE' => 'CASCADE',
                'ON_UPDATE' => 'NO ACTION',
            ),
            'LEVELSUBJECT_USER' => array(
                'FOREIGN_KEY' => 'teacher_user_id',
                'REFERENCES_TABLE' => 'user',
                'REFERENCES_KEY' => 'user_id',
                'ON_DELETE' => 'CASCADE',
                'ON_UPDATE' => 'NO ACTION',
            ),
            'LEVELSUBJECT_LEVEL' => array(
                'FOREIGN_KEY' => 'level_id',
                'REFERENCES_TABLE' => 'config_level',
                'REFERENCES_KEY' => 'level_id',
                'ON_DELETE' => 'CASCADE',
                'ON_UPDATE' => 'NO ACTION',
            ),
            'LEVELSUBJECT_SUBJECT' => array(
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