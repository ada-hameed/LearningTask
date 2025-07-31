<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task_model extends CI_Model {

    public function insertTask($data) {
        return $this->db->insert('tasks', $data);
    }

    public function getTasksByUser($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->order_by('sort_order', 'ASC');
        return $this->db->get('tasks')->result();
    }
    public function getTaskById($task_id) {
    return $this->db->where('id', $task_id)->get('tasks')->row();
}

    public function updateTask($task_id, $data) {
        return $this->db->where('id', $task_id)->update('tasks', $data);
    }


    public function deleteTask($task_id) {
    return $this->db->where('id', $task_id)->delete('tasks');
}

    public function updateStatus($task_id, $status) {
        $this->db->where('id', $task_id);
        return $this->db->update('tasks', ['status' => $status]);
    }

}
