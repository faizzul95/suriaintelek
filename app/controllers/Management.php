<?php

use Config_level_model as ML;
use Master_role_model as MR;

class Management extends Controller
{
    public function index()
    {
        error('404');
    }

    public function role()
    {
        $data = [
            'title' => 'Roles',
            'currentSidebar' => 'role',
            'currentSubSidebar' => NULL
        ];

        render('management/roles_list', $data);
    }

    public function school()
    {
        $data = [
            'title' => 'Schools',
            'currentSidebar' => 'school',
            'currentSubSidebar' => NULL
        ];

        render('management/school_profile', $data);
    }

    public function roleSave()
    {
        $data = MR::save($_POST); 
        json($data);
    }

    public function enrollment()
    {
        $data = [
            'title' => 'Management',
            'currentSidebar' => 'enrollment',
            'currentSubSidebar' => NULL
        ];

        render('management/school_student_enroll', $data);
    }
}
