<?php

use Config_level_model as level;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->_createDefaultLevel();
    }

    protected function _createDefaultLevel()
    {
        $levels = $this->_dataSeed();

        foreach ($levels as $id => $level) {
            level::save([
                'level_id' => $id,
                'level_name' => $level['name'],
                'level_status' => $level['status'],
                'school_id' => $level['school'],
            ]);
        }

        $class = get_class($this);

        echo "<b style='color:red'><i>{$class}</i></b> running succesfully <br>";
    }

    public function _dataSeed()
    {
        return [
            1 => ['name' => 'Year 3', 'status' => '1', 'school' => '1'],
            2 => ['name' => 'Year 4', 'status' => '1', 'school' => '1'],
            3 => ['name' => 'Year 5', 'status' => '1', 'school' => '1'],
            4 => ['name' => 'Year 6', 'status' => '1', 'school' => '1'],
        ];
    }
}
