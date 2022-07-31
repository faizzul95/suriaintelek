<?php

use Academic_year_model as AY;

class Academicyear extends Controller
{
    public function index()
    {
        redirect('settings/academic'); 
    }

    public function getListDt()
    {
        echo $this->AY->getlist();
    }

    public function getAYByID()
    {
        json(AY::find($_POST['id']));
    }

    public function create()
    {
        $data = AY::insert($_POST);
        json($data);
    }

    public function update()
    {
        $data = AY::update($_POST);
        json($data);
    }

    public function delete()
    {
        $data = AY::delete($_POST['id']);
        json($data);
    }

    public function setCurrent()
    {
        $data = $this->AY->setCurrentDefault(escape($_POST['id']));
        json($data);
    }

    public function getCurrentAcademic()
    {
        $data = $this->AY->getCurrentAY();
        echo '<option value="' . $data['academic_id'] . '"> ' . $data['academic_name'] . '</option>';
    }

    public function getSelectAcademic()
    {
        $current = $this->AY->getCurrentAY();
        $data = $this->AY->getAllAcademicYear();

        echo '<option value=""> - Select - </option>';
        foreach ($data as $row) {
            $select = ($row['academic_id'] == $current['academic_id']) ? 'selected' : '';
            echo '<option value="' . $row['academic_id'] . '" ' . $select . '> ' . $row['academic_name'] . ' </option>';
        }
    }
}