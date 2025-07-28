<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Task_model');

        if (!$this->session->userdata('is_logged_in')) {
            redirect('login');
        }
    }

    public function index() {
        $user_id = $this->session->userdata('user_id');
        $data['title'] = 'Dashboard';
        $data['profile'] = $this->User_model->get_user_by_id($user_id);
        $data['tasks'] = $this->Task_model->getTasksByUser($user_id);
        $this->load->view('dashboard/task', $data);
    }

    public function profile() {
        $user_id = $this->session->userdata('user_id');
        $data['title'] = 'Profile';
        $data['profile'] = $this->User_model->get_user_by_id($user_id);
        $this->load->view('dashboard/profile', $data);
    }

    public function update_profile() {
        $user_id = $this->session->userdata('user_id');

        $data = array(
            'name'           => $this->input->post('name'),
            'email'          => $this->input->post('email'),
            'contact_number' => $this->input->post('contact_number')
        );

        if (!empty($this->input->post('password'))) {
            $data['password'] = $this->input->post('password');
        }

        if ($this->User_model->update_user($user_id, $data)) {
            $this->session->set_flashdata('success', 'Profile updated successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to update profile.');
        }

        redirect('dashboard/profile');
    }

    public function storeTask() {
        $user_id = $this->session->userdata('user_id');
        $data = [
            'user_id' => $user_id,
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'start_date' => $this->input->post('start_date'),
            'end_date' => $this->input->post('end_date')
        ];
        $this->Task_model->insertTask($data);
        $this->session->set_flashdata('toastr_success', 'Task created successfully.');
        redirect('dashboard');
    }

    public function updateTask() {
        $task_id = $this->input->post('task_id');
        $data = [
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'start_date' => $this->input->post('start_date'),
            'end_date' => $this->input->post('end_date')
        ];
        if ($this->Task_model->updateTask($task_id, $data)) {
            $this->session->set_flashdata('toastr_success', 'Task updated successfully.');
        } else {
            $this->session->set_flashdata('toastr_error', 'Failed to update task.');
        }
        redirect('dashboard');
    }

    public function deleteTask($id) {
        if ($this->Task_model->deleteTask($id)) {
            $this->session->set_flashdata('toastr_success', 'Task deleted successfully.');
        } else {
            $this->session->set_flashdata('toastr_error', 'Failed to delete task.');
        }
        redirect('dashboard');
    }

    public function update_status() {
        $task_id = $this->input->post('task_id');
        $status = $this->input->post('status');
        $user_id = $this->session->userdata('user_id');
        $task = $this->Task_model->getTaskById($task_id);

        if ($task && $task->user_id == $user_id) {
            $updated = $this->Task_model->updateStatus($task_id, $status);
            if ($updated) {
                echo 'success';
            } else {
                show_error('Update failed', 500);
            }
        } else {
            show_error('Unauthorized or invalid task', 403);
        }
    }
}
