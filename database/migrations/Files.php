<?php

class Files
{
    protected $table = 'files';

    public function up()
    {
        $column =  [
            'files_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
                'null' => FALSE,
            ),
            'files_name' => array(
                'type' => 'VARCHAR',
                'length' => 255,
                'null' => TRUE,
            ),
            'files_original_name' => array(
                'type' => 'VARCHAR',
                'length' => 255,
                'null' => TRUE,
            ),
            'files_folder' => array(
                'type' => 'VARCHAR',
                'length' => 150,
                'null' => TRUE,
            ),
            'files_type' => array(
                'type' => 'VARCHAR',
                'length' => 150,
                'null' => TRUE,
            ),
            'files_mime' => array(
                'type' => 'VARCHAR',
                'length' => 150,
                'null' => TRUE,
            ),
            'files_extension' => array(
                'type' => 'VARCHAR',
                'length' => 10,
                'null' => TRUE,
            ),
            'files_size' => array(
                'type' => 'INT',
                'length' => 11,
                'null' => TRUE,
                'default' => 0,
            ),
            'file_compression' => array(
                'type' => 'TINYINT',
                'length' => 1,
                'comment' => '1 = full size only, 2 = full size & compressed, 3 = full size, compressed & thumbnail	',
                'null' => TRUE,
                'default' => 1,
            ),
            'files_description' => array(
                'type' => 'VARCHAR',
                'length' => 250,
                'null' => TRUE,
                'after' => 'file_compression',
            ),
            'files_path' => array(
                'type' => 'VARCHAR',
                'length' => 250,
                'null' => TRUE,
            ),
            'file_path_is_url' => array(
                'type' => 'TINYINT',
                'length' => 1,
                'comment' => '0 = No, 1 = Yes',
                'null' => TRUE,
                'default' => 0,
            ),
            'entity_type' => array(
                'type' => 'VARCHAR',
                'length' => 255,
                'null' => TRUE,
            ),
            'entity_file_type' => array(
                'type' => 'VARCHAR',
                'length' => 255,
                'null' => TRUE,
            ),
            'entity_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'null' => TRUE,
            ),
            'user_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'comment' => 'Refer table user',
                'null' => TRUE
            ),
        ];

        $key = [
            1 => ['type' => 'PRIMARY KEY', 'reference' => 'files_id'],
            2 => ['type' => 'INDEX', 'reference' => 'user_id'],
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
            'FILES_USER' => array(
                'FOREIGN_KEY' => 'user_id',
                'REFERENCES_TABLE' => 'user',
                'REFERENCES_KEY' => 'user_id',
                'ON_DELETE' => 'CASCADE',
                'ON_UPDATE' => 'NO ACTION',
            ),
        ];

        addRelation($this->table, $relation);
        echo "Table <b style='color:red'><i>{$this->table}</i></b> relation added <br>";
    }
}