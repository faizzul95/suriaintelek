<?php

class BillingItem
{
    protected $table = 'billing_item';

    public function up()
    {
        $column =  [
            'billing_item_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
                'null' => FALSE,
            ),
            'billing_item_description' => array(
                'type' => 'VARCHAR',
                'length' => 255,
                'null' => TRUE
            ),
            'billing_item_qty' => array(
                'type' => 'INT',
                'length' => 11,
                'null' => TRUE
            ),
            'billing_item_unit_price' => array(
                'type' => 'DECIMAL',
                'length' => "18,2",
                'null' => TRUE
            ),
            'billing_item_total_price' => array(
                'type' => 'DECIMAL',
                'length' => "18,2",
                'null' => TRUE
            ),
            'billing_item_type' => array(
                'type' => 'TINYINT',
                'comment' => '1-Debit, 2-Credit',
                'null' => TRUE
            ),
            'billing_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'comment' => 'Refer table billing',
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
            1 => ['type' => 'PRIMARY KEY', 'reference' => 'billing_item_id'],
            2 => ['type' => 'INDEX', 'reference' => 'school_id'],
            3 => ['type' => 'INDEX', 'reference' => 'billing_id'],
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
            'ITEM_SCHOOL' => array(
                'FOREIGN_KEY' => 'school_id',
                'REFERENCES_TABLE' => 'master_school',
                'REFERENCES_KEY' => 'school_id',
                'ON_DELETE' => 'CASCADE',
                'ON_UPDATE' => 'NO ACTION',
            ),
            'ITEM_BILLING' => array(
                'FOREIGN_KEY' => 'billing_id',
                'REFERENCES_TABLE' => 'billing',
                'REFERENCES_KEY' => 'billing_id',
                'ON_DELETE' => 'CASCADE',
                'ON_UPDATE' => 'NO ACTION',
            ),
        ];

        addRelation($this->table, $relation);
        echo "Table <b style='color:red'><i>{$this->table}</i></b> relation added <br>";
    }
}