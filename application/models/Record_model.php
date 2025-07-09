<?php

class Record_model extends CI_Model {
    public function get_records($filters = []) {
        if (!empty($filters['name'])) {
            $this->db->like('name', $filters['name']);
        }
        if (!empty($filters['email'])) {
            $this->db->like('email', $filters['email']);
        }
        if (!empty($filters['department'])) {
            $this->db->like('department', $filters['department']);
        }


        
        $res = $this->db->order_by('created_at', 'DESC')->get('records')->result_array();
        // echo "<pre>"; echo "test"; print_r($this->db->lase_query());exit;
                return $res;

    }

    public function get_existing_emails() {
        return array_column($this->db->select('email')->get('records')->result_array(), 'email');
    }

    public function insert_record($data) {
        $this->db->insert('records', $data);
    }

    public function update_record($data, $email) {
        $this->db->where('email', $email)->update('records', $data);
    }

    public function delete_records_not_in($emails) {
        if (!empty($emails)) {
            $this->db->where_not_in('email', $emails)->delete('records');
        }
    }
}


?>