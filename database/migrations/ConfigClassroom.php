<?php

class ConfigClass
{
    protected $table = 'config_classroom';

    public function up()
    {
        $column =  [
            'class_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
                'null' => FALSE,
            ),
            'class_name' => array(
                'type' => 'VARCHAR',
                'length' => 50,
                'null' => TRUE
            ),
            'class_max_student' => array(
                'type' => 'TINYINT',
                'length' => 4,
                'null' => TRUE
            ),
            'class_status' => array(
                'type' => 'TINYINT',
                'default' => '0',
                'comment' => '0 - Inactive, 1 - Active',
                'default' => '1',
            ),
            'school_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'comment' => 'Refer table master_school',
                'null' => TRUE,
            ),
        ];

        $key = [
            1 => ['type' => 'PRIMARY KEY', 'reference' => 'class_id'],
            2 => ['type' => 'INDEX', 'reference' => 'school_id'],
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
            'CLASS_SCHOOL' => array(
                'FOREIGN_KEY' => 'school_id',
                'REFERENCES_TABLE' => 'master_school',
                'REFERENCES_KEY' => 'school_id',
                'ON_DELETE' => 'CASCADE',
                'ON_UPDATE' => 'NO ACTION',
            ),
        ];

        addRelation($this->table, $relation);
        echo "Table <b style='color:red'><i>{$this->table}</i></b> relation added <br>";
    }
}