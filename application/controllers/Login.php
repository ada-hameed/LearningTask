<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
        $this->load->library('google');
    }

    public function index()
    {
        $client = $this->google->getClient();
        $data['google_login_url'] = $client->createAuthUrl();
        $this->load->view('login', $data);
    }

    public function authenticate()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->User_model->get_user_by_email($email);

        if ($user && $user->password === $password) {
            $this->session->set_userdata([
                'user_id'      => $user->id,
                'name'         => $user->name,
                'email'        => $user->email,
                'is_logged_in' => true
            ]);
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('error', 'Invalid Email or Password');
            redirect('login');
        }
    }

    public function google()
    {
        $client = $this->google->getClient();
        $auth_url = $client->createAuthUrl();
        redirect($auth_url);
    }

public function googleCallback()
{
    $client = $this->google->getClient();
    $code = $this->input->get('code');

    // Step 1: Check if 'code' is received
    if (!$code) {
        $this->session->set_flashdata('toastr_error', 'Google login failed. Authorization code missing.');
        redirect('login');
        return;
    }

    // Step 2: Try to get access token
    $token = $client->fetchAccessTokenWithAuthCode($code);

    // Step 3: Handle token errors
    if ($token === null || isset($token['error'])) {
        $errorMsg = $token['error_description'] ?? 'Token fetch failed.';
        $this->session->set_flashdata('toastr_error', 'Google login error: ' . $errorMsg);
        redirect('login');
        return;
    }

    // Step 4: Set token and fetch user info
    $client->setAccessToken($token);
    $oauth = new Google_Service_Oauth2($client);
    $googleUser = $oauth->userinfo->get();

    // Step 5: Check if user exists
    $user = $this->User_model->get_user_by_email($googleUser->email);

    // Step 6: Create user if not exists
    if (!$user) {
        $this->User_model->insert_user([
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'profile_image' => $googleUser->picture,
            'password' => null
        ]);
        $user = $this->User_model->get_user_by_email($googleUser->email);
    }

    // Step 7: Set session
    $this->session->set_userdata([
        'user_id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'is_logged_in' => true
    ]);

    // Step 8: Redirect to dashboard
    redirect('dashboard');
}


    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
