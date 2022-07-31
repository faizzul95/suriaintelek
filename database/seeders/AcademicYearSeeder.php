<?php

use Academic_year_model as AY;

class AcademicYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->_createDefaultAY();
    }

    protected function _createDefaultAY()
    {
        $academic = $this->_dataSeed();

        foreach ($academic as $id => $ay) {
            AY::save([
                'academic_id' => $id,
                'academic_name' => $ay['name'],
                'academic_status' => $ay['status'],
                'school_id' => $ay['school'],
            ]);
        }

        $class = get_class($this);

        echo "<b style='color:red'><i>{$class}</i></b> running succesfully <br>";
    }

    public function _dataSeed()
    {
        return [
            1 => ['name' => '2021', 'status' => 2, 'school' => 1],
            2 => ['name' => '2022', 'status' => 1, 'school' => 1],
            3 => ['name' => '2023', 'status' => 0, 'school' => 1],
        ];
    }
}
