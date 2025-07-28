<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task_model extends CI_Model {

    public function insertTask($data) {
        return $this->db->insert('tasks', $data);
    }

    public function getTasksByUser($user_id) {
        return $this->db->get_where('tasks', ['user_id' => $user_id])->result();
    }

    public function getTaskById($task_id) {
        return $this->db->get_where('tasks', ['id' => $task_id])->row();
    }

    public function updateTask($task_id, $data) {
        return $this->db->where('id', $task_id)->update('tasks', $data);
    }

    public function deleteTask($task_id) {
        return $this->db->where('id', $task_id)->delete('tasks');
    }
    public function updateStatus($task_id, $status)
{
    $this->db->where('id', $task_id);
    return $this->db->update('tasks', ['status' => $status]);
}

}
