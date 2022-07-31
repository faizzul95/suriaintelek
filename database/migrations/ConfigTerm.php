<?php

class ConfigTerm
{
    protected $table = 'config_term';

    public function up()
    {
        $column =  [
            'term_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
                'null' => FALSE,
            ),
            'term_name' => array(
                'type' => 'VARCHAR',
                'length' => 50,
                'null' => TRUE
            ),
            'term_status' => array(
                'type' => 'TINYINT',
                'default' => '0',
                'comment' => '0 - Inactive, 1 - Current, 2-Previous',
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
            1 => ['type' => 'PRIMARY KEY', 'reference' => 'term_id'],
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
        // empty
    }
}