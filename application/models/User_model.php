<?php

class User_model extends CI_Model
{
    public function get_user($username)
    {
        return $this->db->get_where('users', ['username' => $username])->row_array();
    }

    public function active_sessions_count($user_id)
    {
        return $this->db->where(['user_id' => $user_id, 'is_active' => 1])
            ->count_all_results('user_sessions');
    }

    public function add_session($user_id, $token)
    {
        $this->db->insert('user_sessions', [
            'user_id' => $user_id,
            'token' => $token
        ]);
    }

    public function deactivate_token($token)
    {
        $this->db->update('user_sessions', ['is_active' => 0], ['token' => $token]);
    }
    public function user_exists($username)
    {
        return $this->db->get_where('users', ['username' => $username])->row_array();
    }

    public function register($username, $password)
    {
        $data = [
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];
//         echo "<pre>";
// print_r($data);exit;
        return $this->db->insert('users', $data);
    }

}
?>