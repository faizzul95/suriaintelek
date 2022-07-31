<?php

use Config_preset_billing_model as Preset;

class PresetBillingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->_createDefaultPreset();
    }

    protected function _createDefaultPreset()
    {
        $preset = $this->_dataSeed();

        foreach ($preset as $id => $pre) {
            Preset::save([
                'preset_id' => $id,
                'preset_name' => $pre['name'],
                'preset_type' => $pre['type'],
                'preset_item_arr' => $pre['arr'],
                'preset_status' => $pre['status'],
                'school_id' => $pre['school'],
            ]);
        }

        $class = get_class($this);

        echo "<b style='color:red'><i>{$class}</i></b> running succesfully <br>";
    }

    public function _dataSeed()
    {
        return [
            1 => ['name' => 'APPLICATION', 'type' => '1', 'arr' => '1,3,4', 'status' => '1', 'school' => '1'],
            2 => ['name' => 'REGISTRATION', 'type' => '2', 'arr' => '1,5,6,7', 'status' => '1', 'school' => '1'],
        ];
    }
}
