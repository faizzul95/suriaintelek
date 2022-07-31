<?php

use User_model as users;
use Files_model as Files;

class User extends Controller
{
    public function index()
    {
        error('404'); // redirect to page error 404
    }

    public function parent()
    {
        $data = [
            'title' => 'List Parent',
            'currentSidebar' => 'user',
            'currentSubSidebar' => 'parent',
        ];

        render('user/parent_list', $data);
    }

    public function parentView($parentEncodeID = null)
    {
        if (!empty($parentEncodeID)) {
            $data = [
                'title' => 'Parent Details',
                'currentSidebar' => 'user',
                'currentSubSidebar' => 'parent',
                'userID' => decodeID($parentEncodeID),
            ];

            render('profile/parent_personal', $data);
        } else {
            redirect('user/parents');
        }
    }

    // use in list_user for client side datatable (with csrf)
    public function getAll()
    {
        json(users::all());
    }

    public function getUsersByID()
    {
        $data = users::find($_POST['id']);
        json($data);
    }

    public function getListParentDt()
    {
        echo $this->users->getlistParent();
    }

    public function create()
    {
        $data = users::insert($_POST);
        json($data);
    }

    public function update()
    {
        $data = users::update($_POST);
        json($data);
    }

    public function save()
    {
        $_POST['school_id'] = session()->get('schoolID');

        if (isset($_POST['user_password'])) {
            $_POST['user_password'] = password_hash($_POST['user_password'], PASSWORD_DEFAULT);
        } else {
            $_POST['user_password'] = password_hash($_POST['user_nric'], PASSWORD_DEFAULT);
        }

        $data = users::save($_POST);

        if ($_POST['role_id'] == 4) {

            // generate folder for profile pic
            $folderAvatar = folder('directory/teacher', $_POST['user_fullname'], 'avatar');

            // move image from default
            $moveImg = moveFile(
                'user.png',
                'upload/image/user/default/user.png',
                $folderAvatar,
                [
                    'type' => 'User_model',
                    'file_type' => 'TEACHER_PROFILE',
                    'entity_id' => $data['id'],
                    'user_id' => $data['id'],
                ],
                'copy'
            );

            if (!empty($moveImg)) {
                Files::save($moveImg);

                // update user info
                $updateData = [
                    'user_id' => $data['id'],
                    'user_avatar' => $moveImg['files_path'],
                ];
                users::save($updateData);
            }
        }

        json($data);
    }

    public function delete()
    {
        $data = users::delete($_POST['id']);
        json($data);
    }

    public function uploadProfile()
    {
        $roleID = (isset($_POST['role_id'])) ? escape($_POST['role_id']) : session()->get('roleID');
        $userData = users::find($_POST['user_id']);
        $userName = $userData['user_fullname'];

        if ($roleID == 1 || $roleID == 2) {
            $typeFolder = 'admin';
        } else  if ($roleID == 3) {
            $typeFolder = 'admission';
        } else  if ($roleID == 4) {
            $typeFolder = 'teacher';
        } else  if ($roleID == 5) {
            $typeFolder = 'parent';
        } else {
            $typeFolder = '_temp';
        }

        $folder = folder('directory/' . $typeFolder, $userName, 'avatar');
        $data = $this->users->upload_save($_POST, $folder);

        if ($data['resCode'] == 200) {
            $currentUserID = session()->get('userID');
            if ($currentUserID == $_POST['user_id']) {
                session()->set('avatar', $data['data']['user_avatar']);
            }
        }

        json($data);
    }
}