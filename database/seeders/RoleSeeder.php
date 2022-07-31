<?php

use Master_role_model as Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->_createDefaultRole();
    }

    protected function _createDefaultRole()
    {
        $roles = $this->_dataSeed();

        foreach ($roles as $id => $role) {
            Role::save([
                'role_id' => $id,
                'role_name' => $role['name'],
                'school_id' => $role['school'],
            ]);
        }

        $class = get_class($this);

        echo "<b style='color:red'><i>{$class}</i></b> running succesfully <br>";
    }

    public function _dataSeed()
    {
        return [
            1 => ['name' => 'System Administrator', 'school' => '1'],
            2 => ['name' => 'Administrator', 'school' => '1'],
            3 => ['name' => 'Admission', 'school' => '1'],
            4 => ['name' => 'Teacher', 'school' => '1'],
            5 => ['name' => 'Parent', 'school' => '1'],
            6 => ['name' => 'Student', 'school' => '1'],
        ];
    }
}
