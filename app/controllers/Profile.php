<?php

class Profile extends Controller
{
    public function index()
    {
        error('404');
    }

    public function personal()
    {
        $data = [
            'title' => 'My Profile',
            'currentSidebar' => 'profile',
            'currentSubSidebar' => NULL,
            'userID' => session()->get('userID'),
        ];

        if (session()->get('roleID') == 4) {
            render('user/teacher_view', $data);
        } elseif (session()->get('roleID') == 5) {
            render('profile/parent_personal', $data);
        } else {
            render('profile/admin_personal', $data);
        }
    }
}