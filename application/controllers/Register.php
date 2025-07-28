<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    
    public function index() {
        $this->load->view('register');
    }

    
    public function save() {
        $this->load->library('form_validation');
        $this->load->model('User_model');

        
        $this->form_validation->set_rules('name', 'Full Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('mobile', 'Mobile Number', 'required|regex_match[/^[0-9]{10}$/]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

        
        if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata('toastr_error', validation_errors());
            redirect('register');
        } 
        
        else {
            $data = [
                'name'           => $this->input->post('name'),
                'email'          => $this->input->post('email'),
                'contact_number' => $this->input->post('mobile'), 
                'password'       => $this->input->post('password'),
                'created_at'     => date('Y-m-d H:i:s'),
            ];

            $this->User_model->insert_user($data);
            $this->session->set_flashdata('toastr_success', 'Account created successfully.');
            redirect('login'); 
        }
    }
}
