<?php

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
    }
    public function register()
    {
// echo "<pre>";
// print_r($_POST);exit;

        if ($_POST) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $confirm = $this->input->post('confirm_password');

            if (empty($username) || empty($password)) {
                $data['error'] = 'All fields required';
            } elseif ($password !== $confirm) {
                $data['error'] = 'Passwords do not match';
            } elseif ($this->User_model->user_exists($username)) {
                $data['error'] = 'Username already taken';
            } else {
                $this->User_model->register($username, $password);
                $data['success'] = 'Registered successfully. Please login.';
            }
        }

        $this->load->view('register_view', isset($data) ? $data : []);
    }

    public function login()
    {
        if ($_POST) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $user = $this->User_model->get_user($username);

            if ($user && password_verify($password, $user['password'])) {
                if ($this->User_model->active_sessions_count($user['id']) >= 2) {
                    $data['error'] = 'Max 2 sessions allowed';
                } else {
                    $token = bin2hex(random_bytes(32));
                    $this->User_model->add_session($user['id'], $token);

                    $this->session->set_userdata([
                        'user_id' => $user['id'],
                        'username' => $user['username'],
                        'token' => $token
                    ]);
                    redirect('dashboard');
                }
            } else {
                $data['error'] = 'Invalid credentials';
            }
        }
        $this->load->view('login_view', isset($data) ? $data : []);
    }

    public function logout()
    {
        $token = $this->session->userdata('token');
        $this->User_model->deactivate_token($token);
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}


?>