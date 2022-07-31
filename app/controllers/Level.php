<?php

use Config_level_model as LM;
use Config_subject_level_linking_model as SubLink;

class Level extends Controller
{
    public function index()
    {
        redirect('settings/level');
    }

    public function getListDt()
    {
        echo $this->LM->getlist();
    }

    public function getLevelByID()
    {
        json(LM::find($_POST['id']));
    }

    public function create()
    {
        $data = LM::insert($_POST);
        json($data);
    }

    public function update()
    {
        $data = LM::update($_POST);
        json($data);
    }

    public function delete()
    {
        $data = LM::delete($_POST['id']);
        json($data);
    }

    public function getSelectLevel()
    {
        $data = $this->LM->getAllActiveLevel();
        echo '<option value=""> - Select - </option>';
        foreach ($data as $row) {
            echo '<option value="' . $row['level_id'] . '""> ' . $row['level_name'] . '</option>';
        }
    }

    public function getListLevelDiv()
    {
        $data = LM::where(['school_id' => session()->get('schoolID')]);

        foreach ($data as $row) {
            echo '<div class="col-12 mb-2">
                <div id="card-' . $row['level_id'] . '" class="card cardColor" onclick="getData(' . $row['level_id'] . ')">
                    <div class="card-body">
                        <div class="d-flex justify-content-between" style="position: relative;">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar">
                                    <span class="avatar-initial bg-label-primary rounded-circle">
                                        <i class="fas fa-school"></i>
                                    </span>
                                </div>
                                <div class="card-info">
                                    <h5 id="text-' . $row['level_id'] . '" class="card-title mb-0 textColor">' . $row['level_name'] . '</h>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        }
    }

    public function getListLevelTeacherDiv()
    {
        $data = $this->SubLink->levelByTeacherID();

        foreach ($data as $row) {
            echo '<div class="col-12 mb-2">
                <div id="card-' . $row['level_id'] . '" class="card cardColor" onclick="getData(' . $row['level_id'] . ')">
                    <div class="card-body">
                        <div class="d-flex justify-content-between" style="position: relative;">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar">
                                    <span class="avatar-initial bg-label-primary rounded-circle">
                                        <i class="fas fa-school"></i>
                                    </span>
                                </div>
                                <div class="card-info">
                                    <h5 id="text-' . $row['level_id'] . '" class="card-title mb-0 textColor">' . $row['level_name'] . '</h>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        }
    }
}