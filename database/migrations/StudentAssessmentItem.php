<?php

class StudentAssessmentItem
{
    protected $table = 'student_assessment_item';

    public function up()
    {
        $column =  [
            'assessment_item_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
                'null' => FALSE,
            ),
            'assessment_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'null' => TRUE,
                'comment' => 'Refer table student_assessment',
            ),
            'assessment_item_desc' => array(
                'type' => 'VARCHAR',
                'length' => 255,
                'null' => TRUE,
            ),
            'assessment_item_grade' => array(
                'type' => 'VARCHAR',
                'length' => 255,
                'null' => TRUE,
            ),
        ];

        $key = [
            1 => ['type' => 'PRIMARY KEY', 'reference' => 'assessment_item_id'],
            2 => ['type' => 'INDEX', 'reference' => 'assessment_id'],
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
            'ASSESSMENT_ITEM' => array(
                'FOREIGN_KEY' => 'assessment_id',
                'REFERENCES_TABLE' => 'student_assessment',
                'REFERENCES_KEY' => 'assessment_id',
                'ON_DELETE' => 'CASCADE',
                'ON_UPDATE' => 'NO ACTION',
            ),
        ];

        addRelation($this->table, $relation);
        echo "Table <b style='color:red'><i>{$this->table}</i></b> relation added <br>";
    }
}