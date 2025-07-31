<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Task_model');

        // Auth Check with Google Exception
        $class = $this->router->fetch_class();
        $method = $this->router->fetch_method();

        if (!$this->session->userdata('is_logged_in') &&
            !($class === 'dashboard' && in_array($method, ['google', 'googleCallback']))) {
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
        $data = [
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'contact_number' => $this->input->post('contact_number')
        ];

        if (!empty($this->input->post('password'))) {
            $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        }

        if (!empty($_FILES['profile_image']['name'])) {
            $config['upload_path'] = './uploads/profile_images/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048;
            $config['file_name'] = 'user_' . $user_id . '_' . time();

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('profile_image')) {
                $upload_data = $this->upload->data();
                $data['profile_image'] = 'uploads/profile_images/' . $upload_data['file_name'];
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('dashboard/profile');
                return;
            }
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
            echo $updated ? 'success' : show_error('Update failed', 500);
        } else {
            show_error('Unauthorized or invalid task', 403);
        }
    }

    public function updateOrder() {
        if (!$this->input->is_ajax_request()) {
            show_error('No direct script access allowed');
        }

        header('Content-Type: application/json');

        $orders = $this->input->post('order');
        if (!$orders) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
            return;
        }

        foreach ($orders as $order) {
            $this->db->where('id', $order['id']);
            $this->db->update('tasks', ['sort_order' => $order['newPosition']]);
        }

        echo json_encode(['status' => 'success']);
    }

    public function getTasksJson() {
        $user_id = $this->session->userdata('user_id');
        $tasks = $this->Task_model->getTasksByUser($user_id);
        header('Content-Type: application/json');
        echo json_encode(['data' => $tasks]);
    }


}
