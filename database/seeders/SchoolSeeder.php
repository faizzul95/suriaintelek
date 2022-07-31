<?php

use Master_school_model as school;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->_createDefaultSchool();
    }

    protected function _createDefaultSchool()
    {
        $schools = $this->_dataSeed();

        foreach ($schools as $id => $sc) {
            school::save([
                'school_id' => $id,
                'school_name' => $sc['name'],
                'school_email' => $sc['email'],
                'school_contact_no' => $sc['contact'],
                'school_contact_person' => $sc['person'],
                'school_address' => $sc['address'],
                'school_postcode' => $sc['postcode'],
                'school_city' => $sc['city'],
                'school_state' => $sc['state'],
                'school_logo' => 'logo.png',
                'school_status' => '1',
            ]);
        }

        $class = get_class($this);

        echo "<b style='color:red'><i>{$class}</i></b> running succesfully <br>";
    }

    public function _dataSeed()
    {
        return [
            1 => [
                'name' => 'TADIKA SURIA INTELEK KUALA SELANGOR',
                'email' => 'suriaintelek@gmail.com',
                'contact' => '0133178899',
                'person' => '-',
                'address' => '22A, Lorong Teratai 2/12, Bandar Baru, 45000 Kuala Selangor, Selangor',
                'postcode' => '45000',
                'city' => 'Kuala Selangor',
                'state' => 'Selangor',
            ],
        ];
    }
}
