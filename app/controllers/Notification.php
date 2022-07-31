<?php

use Notification_model as NOTI;

class Notification extends Controller
{
    public function index()
    {
        error('404');
    }

    public function getListNotiByUser()
    {
        $data = [
            'listNoti' => $this->NOTI->notiListByUser(),
            'countUnread' => $this->NOTI->countUnreadNotiByUser()
        ];

        json($data);
    }

    public function create()
    {
        $data = NOTI::insert($_POST);
        json($data);
    }

    public function update()
    {
        $data = NOTI::update($_POST);
        json($data);
    }

    public function save()
    {
        $data = NOTI::updateOrInsert($_POST);
        json($data);
    }

    public function markAllRead()
    {
        $data = NOTI::where(['user_id' => session()->get('userID')]);
        foreach ($data as $row) {
            NOTI::update([
                'noti_id' => $row['noti_id'],
                'noti_status' => 1,
            ]);
        }

        json($data);
    }

    public function read()
    {
        $data = NOTI::update([
            'noti_id' => $_POST['id'],
            'noti_status' => 1,
        ]);

        json($data);
    }

    public function delete()
    {
        $data = NOTI::delete($_POST['id']);
        json($data);
    }
}