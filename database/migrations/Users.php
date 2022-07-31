<?php

class Users
{
    protected $table = 'user';

    public function up()
    {
        $column =  [
            'user_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
                'null' => FALSE,
            ),
            'user_salutation' => array(
                'type' => 'VARCHAR',
                'length' => 10,
                'null' => TRUE
            ),
            'user_fullname' => array(
                'type' => 'VARCHAR',
                'length' => 255,
                'null' => TRUE
            ),
            'user_preferred_name' => array(
                'type' => 'VARCHAR',
                'length' => 20,
                'null' => TRUE
            ),
            'user_nric' => array(
                'type' => 'VARCHAR',
                'length' => 15,
                'null' => TRUE,
                'after' => 'user_preferred_name',
            ),
            'user_gender' => array(
                'type' => 'VARCHAR',
                'length' => 15,
                'null' => TRUE,
            ),
            'user_email' => array(
                'type' => 'VARCHAR',
                'length' => 255,
                'null' => TRUE
            ),
            'user_contact_no' => array(
                'type' => 'VARCHAR',
                'length' => 15,
                'null' => TRUE
            ),
            'user_address' => array(
                'type' => 'VARCHAR',
                'length' => 255,
                'null' => TRUE
            ),
            'user_postcode' => array(
                'type' => 'VARCHAR',
                'length' => 10,
                'null' => TRUE
            ),
            'user_city' => array(
                'type' => 'VARCHAR',
                'length' => 100,
                'null' => TRUE
            ),
            'user_state' => array(
                'type' => 'VARCHAR',
                'length' => 100,
                'null' => TRUE
            ),
            'user_race' => array(
                'type' => 'VARCHAR',
                'length' => 20,
                'null' => TRUE
            ),
            'user_religion' => array(
                'type' => 'VARCHAR',
                'length' => 20,
                'null' => TRUE
            ),
            'user_job' => array(
                'type' => 'VARCHAR',
                'length' => 150,
                'null' => TRUE,
                'after' => 'user_religion'
            ),
            'user_salary' => array(
                'type' => 'VARCHAR',
                'length' => 8,
                'null' => TRUE,
                'after' => 'user_job'
            ),
            'user_username' => array(
                'type' => 'VARCHAR',
                'length' => 20,
                'null' => TRUE
            ),
            'user_password' => array(
                'type' => 'VARCHAR',
                'length' => 255,
                'null' => TRUE
            ),
            'user_avatar' => array(
                'type' => 'VARCHAR',
                'length' => 255,
                'null' => TRUE,
                'default' => 'upload/image/user/default/user.png',
            ),
            'role_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'comment' => 'Refer table master_role',
                'null' => TRUE,
            ),
            'school_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'comment' => 'Refer table master_school',
                'null' => TRUE,
            ),
            'user_status' => array(
                'type' => 'TINYINT',
                'null' => TRUE,
                'comment' => '0 - Inactive, 1 - Active, 2-Block',
                'default' => '1',
            )
        ];

        $key = [
            1 => ['type' => 'PRIMARY KEY', 'reference' => 'user_id'],
            2 => ['type' => 'INDEX', 'reference' => 'role_id'],
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
            'USER_SCHOOL' => array(
                'FOREIGN_KEY' => 'school_id',
                'REFERENCES_TABLE' => 'master_school',
                'REFERENCES_KEY' => 'school_id',
                'ON_DELETE' => 'CASCADE',
                'ON_UPDATE' => 'NO ACTION',
            ),
            'USER_ROLE' => array(
                'FOREIGN_KEY' => 'role_id',
                'REFERENCES_TABLE' => 'master_role',
                'REFERENCES_KEY' => 'role_id',
                'ON_DELETE' => 'CASCADE',
                'ON_UPDATE' => 'NO ACTION',
            ),
        ];

        addRelation($this->table, $relation);
        echo "Table <b style='color:red'><i>{$this->table}</i></b> relation added <br>";
    }
}

// type => INT, TINYINT, BIGINT, CHAR, VARCHAR, TEXT, DATE, YEAR, TIMESTAMP, DATE, TIME, DATETIME, DECIMAL, FLOAT, BOOLEAN, ENUM
// unsigned => TRUE / FALSE
// auto_increment => TRUE / FALSE
// null => TRUE / FALSE
// length
// comment
// default
// rename => (only use to change column name)
// after => (add column after tablename)
// drop => TRUE (remove if dont want to drop)