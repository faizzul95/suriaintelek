<?php

class ConfigSubjectChapterTopic
{
    protected $table = 'config_subject_chapter_topic';

    public function up()
    {
        $column =  [
            'topic_id' => array(
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
            'chapter_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'comment' => 'Refer table config_subject_chapter',
                'null' => TRUE,
            ),
            'topic_no' => array(
                'type' => 'VARCHAR',
                'length' => 10,
                'null' => TRUE
            ),
            'topic_desc' => array(
                'type' => 'VARCHAR',
                'length' => 100,
                'null' => TRUE
            ),
            'school_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'comment' => 'Refer table master_school',
                'null' => TRUE,
            ),
        ];

        $key = [
            1 => ['type' => 'PRIMARY KEY', 'reference' => 'topic_id'],
            2 => ['type' => 'INDEX', 'reference' => 'subject_id'],
            3 => ['type' => 'INDEX', 'reference' => 'chapter_id'],
            4 => ['type' => 'INDEX', 'reference' => 'school_id'],
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
            'TOPIC_SCHOOL' => array(
                'FOREIGN_KEY' => 'school_id',
                'REFERENCES_TABLE' => 'master_school',
                'REFERENCES_KEY' => 'school_id',
                'ON_DELETE' => 'CASCADE',
                'ON_UPDATE' => 'NO ACTION',
            ),
            'TOPIC_SUBJECT' => array(
                'FOREIGN_KEY' => 'subject_id',
                'REFERENCES_TABLE' => 'config_subject',
                'REFERENCES_KEY' => 'subject_id',
                'ON_DELETE' => 'CASCADE',
                'ON_UPDATE' => 'NO ACTION',
            ),
            'TOPIC_CHAPTER' => array(
                'FOREIGN_KEY' => 'chapter_id',
                'REFERENCES_TABLE' => 'config_subject_chapter',
                'REFERENCES_KEY' => 'chapter_id',
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