<?php

class Dashboard extends Controller
{
    public function index()
    {
        $roleID = session()->get('roleID');

        if ($roleID == 1) {
            $page = 'superadmin';
        } else if ($roleID == 2) {
            $page = 'administrator';
        } else if ($roleID == 3) {
            $page = 'admission';
        } else if ($roleID == 4) {
            $page = 'teacher';
        } else if ($roleID == 5) {
            $page = 'parent';
        } else {
            error('404');
        }

        $data = [
            'title' => 'Dashboard',
            'currentSidebar' => 'dashboard',
            'currentSubSidebar' => NULL
        ];

        render('dashboard/' . $page, $data);
    }
}
