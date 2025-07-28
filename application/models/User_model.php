<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function get_user_by_email($email)
    {
        return $this->db->where('email', $email)->get('users')->row();
    }
    public function get_user_by_id($id){
    return $this->db->where('id', $id)->get('users')->row();
    }
    public function insert_user($data) {
        return $this->db->insert('users', $data);
    }
    public function update_user($id, $data) {
        return $this->db->where('id', $id)->update('users', $data);
    }

}
