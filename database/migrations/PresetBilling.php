<?php

class PresetBilling
{
    protected $table = 'config_preset_billing';

    public function up()
    {
        $column =  [
            'preset_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
                'null' => FALSE,
            ),
            'preset_name' => array(
                'type' => 'VARCHAR',
                'length' => 150,
                'null' => TRUE,
            ),
            'preset_type' => array(
                'type' => 'VARCHAR',
                'length' => 150,
                'null' => TRUE,
            ),
            'preset_item_arr' => array(
                'type' => 'VARCHAR',
                'length' => 250,
                'null' => TRUE,
            ),
            'preset_status' => array(
                'type' => 'TINYINT',
                'null' => TRUE,
                'comment' => '0-inactive, 1-active',
                'default' => '1',
            ),
            'school_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'comment' => 'Refer table master_school',
                'null' => TRUE
            ),
        ];

        $key = [
            1 => ['type' => 'PRIMARY KEY', 'reference' => 'preset_id'],
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
            'PRESET_BILLING_SCHOOL' => array(
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