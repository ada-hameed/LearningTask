<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
    }

    // Show login page
    public function index()
    {
        $this->load->view('login');
    }

    // Handle form submit
    public function authenticate()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->User_model->get_user_by_email($email);

        if ($user && $user->password === $password) {
            // Set session
            $this->session->set_userdata([
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'is_logged_in' => true
            ]);

            $this->session->set_flashdata('toastr_success', 'Login successful!');
            
            redirect('dashboard'); // You can change this
        } else {
            $this->session->set_flashdata('error', 'Invalid Email or Password');
            redirect('login');
        }
    }

    // Logout
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
