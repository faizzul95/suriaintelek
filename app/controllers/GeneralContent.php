<?php

use General_content_model as GC;

class GeneralContent extends Controller
{
    public function index()
    {
        redirect('generalcontent/list', true);
    }

    public function list()
    {
        view('general/list', ['title' => 'General']);
    }

    public function getTnC()
    {
        $data = $this->GC->getTnCdata();
        json($data);
    }

    public function getPrivacy()
    {
        $data = $this->GC->getPrivacydata();
        json($data);
    }
}