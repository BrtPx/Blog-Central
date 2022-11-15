<?php

class Login_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function credsLogin($usercreds)
    {
        $this->db->select("*");
        $this->db->where("username", $usercreds['username']);
        $this->db->where("password", $usercreds['password']);
        $query = $this->db->from("ptz_users")->row();
        return $query;
    }

    public function giveAccess($username, $password)
    {
        $this->db->select("*");
        $this->db->where("username", $username);
        $this->db->where("password", $password);
        $query = $this->db->get("ptz_users");
        if ($query->num_rows() == 1) {
            return $query;
        }
    }
}