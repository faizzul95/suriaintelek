<?php

use User_model as users;
use Master_school_model as school;
use Master_role_model as roles;
use Academic_year_model as AY;

class Auth extends Controller
{
    public function index()
    {
        redirect('auth/login', true);
    }

    public function login()
    {
        view('auth/login', ['title' => 'Login']);
    }

    public function register()
    {
        view('auth/register', ['title' => 'Register']);
    }

    public function forgot()
    {
        view('auth/forgot', ['title' => 'Forgot Password']);
    }

    public function authorize()
    {
        $username = escape($_POST['username']);
        $enteredPassword = escape($_POST['password']);

        $data = $this->users->getUserLogin($username);

        $redirectUrl = NULL;

        if (!empty($data)) {

            $status = $data['user_status'];
            $roleid = $data['role_id'];
            $schoolid = $data['school_id'];
            $avatar = (!empty($data['user_avatar'])) ? $data['user_avatar'] : 'upload/image/user/default/user.png';
            $current_password = $data['user_password'];

            // role profile
            $role = roles::find($roleid);
            $rolename = $role['role_name'];

            // school profile
            $schools = school::find($schoolid);
            $schoolName = $schools['school_name'];
            $schoolLogo = $schools['school_logo'];

            // current academic
            $academic = $this->AY->getCurrentAY($schoolid);
            $academicID = $academic['academic_id'];
            $academicName = $academic['academic_name'];

            $result = passDecrypt($current_password, $enteredPassword);

            if ($result) {
                if ($status == '1') {

                    // Set session a USING SESSION MANAGER
                    $this->session->set('userID', $data['user_id']);
                    $this->session->set('userSalutation', $data['user_salutation']);
                    $this->session->set('userFullname', $data['user_fullname']);
                    $this->session->set('userPreferredName', $data['user_preferred_name']);
                    $this->session->set('userEmail', $data['user_email']);
                    $this->session->set('avatar', $data['user_avatar']);
                    $this->session->set('roleID', $roleid);
                    $this->session->set('roleName', $rolename);
                    $this->session->set('schoolID', $schoolid);
                    $this->session->set('schoolName', $schoolName);
                    $this->session->set('schoolLogo', $schoolLogo);
                    $this->session->set('avatar', $avatar);
                    $this->session->set('academicID', $academicID);
                    $this->session->set('academicName', $academicName);
                    $this->session->set('isLoggedIn', TRUE);

                    $response = 200;
                    $message = 'Login successful';
                    $redirectUrl = url('dashboard');
                    
                } else {
                    $response = 500;
                    $message = 'Your account is inactive';
                }
            } else {
                $response = 500;
                $message = 'Invalid username or password';
            }
        } else {
            $response = 500;
            $message = 'Invalid username or password';
        }

        json(["response" => $response, "message" => $message, "redirectUrl" => $redirectUrl]);
    }

    public function logout()
    {
        $this->session->clear();
        redirect($_ENV['DEFAULT_CONTROLLER'], true);
        exit;
    }
}