<?php

class ConfigSubjectChapterSubTopic
{
    protected $table = 'config_subject_chapter_subtopic';

    public function up()
    {
        $column =  [
            'sub_topic_id' => array(
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
            'topic_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'comment' => 'Refer table config_subject_chapter_topic',
                'null' => TRUE,
            ),
            'sub_topic_no' => array(
                'type' => 'VARCHAR',
                'length' => 10,
                'null' => TRUE
            ),
            'sub_topic_desc' => array(
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
            1 => ['type' => 'PRIMARY KEY', 'reference' => 'sub_topic_id'],
            2 => ['type' => 'INDEX', 'reference' => 'subject_id'],
            3 => ['type' => 'INDEX', 'reference' => 'chapter_id'],
            4 => ['type' => 'INDEX', 'reference' => 'topic_id'],
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
            'SUBTOPIC_SCHOOL' => array(
                'FOREIGN_KEY' => 'school_id',
                'REFERENCES_TABLE' => 'master_school',
                'REFERENCES_KEY' => 'school_id',
                'ON_DELETE' => 'CASCADE',
                'ON_UPDATE' => 'NO ACTION',
            ),
            'SUBTOPIC_SUBJECT' => array(
                'FOREIGN_KEY' => 'subject_id',
                'REFERENCES_TABLE' => 'config_subject',
                'REFERENCES_KEY' => 'subject_id',
                'ON_DELETE' => 'CASCADE',
                'ON_UPDATE' => 'NO ACTION',
            ),
            'SUBTOPIC_CHAPTER' => array(
                'FOREIGN_KEY' => 'chapter_id',
                'REFERENCES_TABLE' => 'config_subject_chapter',
                'REFERENCES_KEY' => 'chapter_id',
                'ON_DELETE' => 'CASCADE',
                'ON_UPDATE' => 'NO ACTION',
            ),
            'SUBTOPIC_TOPIC' => array(
                'FOREIGN_KEY' => 'topic_id',
                'REFERENCES_TABLE' => 'config_subject_chapter_topic',
                'REFERENCES_KEY' => 'topic_id',
                'ON_DELETE' => 'CASCADE',
                'ON_UPDATE' => 'NO ACTION',
            ),
        ];

        addRelation($this->table, $relation);
        echo "Table <b style='color:red'><i>{$this->table}</i></b> relation added <br>";
    }
}