<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function addNewUser($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('users', $userInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }
}
