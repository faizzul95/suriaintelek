<?php

use Files_model as file;

class Files extends Controller
{
    public function index()
    {
        error('404');
    }

    public function getAll()
    {
        json(file::all());
    }

    public function getFilesByUserID()
    {
        $data = file::where(['user_id' => $_POST['id']]);
        json($data);
    }

    public function getFilesByID()
    {
        $data = file::find($_POST['id']);
        json($data);
    }

    public function delete()
    {
        $data = file::delete($_POST['id']);
        json($data);
    }
}