<?php

use Config_classroom_model as Classroom;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->_createDefaultClassroom();
    }

    protected function _createDefaultClassroom()
    {
        $classes = $this->_dataSeed();

        foreach ($classes as $id => $class) {
            Classroom::save([
                'class_id' => $id,
                'class_name' => $class['name'],
                'class_max_student' => $class['max'],
                'class_status' => $class['status'],
                'school_id' => $class['school'],
            ]);
        }

        $class = get_class($this);

        echo "<b style='color:red'><i>{$class}</i></b> running succesfully <br>";
    }

    public function _dataSeed()
    {
        return [
            1 => ['name' => 'Bilik 1', 'max' => '20', 'status' => '1', 'school' => '1'],
            2 => ['name' => 'Bilik 2', 'max' => '17', 'status' => '1', 'school' => '1'],
            3 => ['name' => 'Bilik 3', 'max' => '17', 'status' => '1', 'school' => '1'],
            4 => ['name' => 'Bilik 4', 'max' => '0', 'status' => '0', 'school' => '1'],
            5 => ['name' => 'Bilik 5', 'max' => '0', 'status' => '0', 'school' => '1'],
        ];
    }
}
