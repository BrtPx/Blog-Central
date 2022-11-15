<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
    }

    public function chkuser()
    {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];


            if ($this->login_model->giveAccess($username, $password)) {
                $data = array(
                    "response" => "success",
                    "message" => "Welcome"
                );
            } else {
                $data = [
                    "response" => "error",
                    "message" => "Account login failed"
                ];
            }
            echo json_encode($data);
        }
    }
}