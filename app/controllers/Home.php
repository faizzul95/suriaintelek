<?php

class Home
{
    public function index()
    {
        $data = [
            'title' => 'Home',
            'currentSidebar' => 'home',
            'currentSubSidebar' => NULL,
        ];

        view('landing/home', $data);
    }

    public function gallery()
    {
        $data = [
            'title' => 'Gallery',
            'currentSidebar' => 'gallery',
            'currentSubSidebar' => NULL,
        ];

        view('landing/gallery', $data);
    }

    public function contactus()
    {
        $data = [
            'title' => 'Contact Us',
            'currentSidebar' => 'contactus',
            'currentSubSidebar' => NULL,
        ];

        view('landing/contactus', $data);
    }

    public function register()
    {
        $data = [
            'title' => 'Register',
            'currentSidebar' => 'register',
            'currentSubSidebar' => NULL,
        ];

        view('landing/register', $data);
    }
}
