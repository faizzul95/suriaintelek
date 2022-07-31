<?php

use Master_runningno_model as level;

class RunningNoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->_createDefaultRunningNo();
    }

    protected function _createDefaultRunningNo()
    {
        $runNo = $this->_dataSeed();

        foreach ($runNo as $id => $run) {
            level::save([
                'run_id' => $id,
                'run_prefix' => $run['prefix'],
                'run_suffix' => $run['suffix'],
                'run_type' => $run['type'],
                'run_zerodigit' => $run['zero'],
                'run_currentno' => $run['no'],
                'school_id' => $run['school'],
            ]);
        }

        $class = get_class($this);

        echo "<b style='color:red'><i>{$class}</i></b> running succesfully <br>";
    }

    public function _dataSeed()
    {
        return [
            1 => [
                'prefix' => 'SIK|APP',
                'suffix' => NULL,
                'type' => '1',
                'zero' => '5',
                'no' => '0',
                'school' => '1'
            ],
            2 => [
                'prefix' => 'SIK|STUD|2022',
                'suffix' => NULL,
                'type' => '2',
                'zero' => '5',
                'no' => '0',
                'school' => '1'
            ],
            3 => [
                'prefix' => 'SIK|INV',
                'suffix' => NULL,
                'type' => '3',
                'zero' => '5',
                'no' => '0',
                'school' => '1'
            ],
            4 => [
                'prefix' => 'SIK|RECEIPT',
                'suffix' => NULL,
                'type' => '4',
                'zero' => '1',
                'no' => '0',
                'school' => '1'
            ],
        ];
    }
}
