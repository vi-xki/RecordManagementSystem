<?php
class Dashboard extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Record_model');
        $this->load->library('session');
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }

    public function index() {

        // echo "TEST_____________________--------------";exit;
        $filters = $this->input->get();
        $data['records'] = $this->Record_model->get_records($filters);
        $data['username'] = $this->session->userdata('username');

        // echo "<pre>";print_r($data);exit;
        $this->load->view('dashboard_view', $data);
    }

    public function upload() {
        if ($_FILES['file']['error'] == UPLOAD_ERR_OK) {
            $file = fopen($_FILES['file']['tmp_name'], 'r');
            fgetcsv($file); // skip header

            $data = [];
            while (($row = fgetcsv($file)) !== FALSE) {
                $data[] = [
                    'name' => $row[0],
                    'email' => $row[1],
                    'phone' => $row[2],
                    'department' => $row[3],
                    'salary' => (float)$row[4]
                ];
            }
            fclose($file);

            $existing = $this->Record_model->get_existing_emails();
            $emails = [];

            foreach ($data as $rec) {
                $emails[] = $rec['email'];
                if (in_array($rec['email'], $existing)) {
                    $this->Record_model->update_record($rec, $rec['email']);
                } else {
                    $this->Record_model->insert_record($rec);
                }
            }

            $this->Record_model->delete_records_not_in($emails);
            $this->session->set_flashdata('message', 'Data sync complete');
        }
        redirect('dashboard');
    }
}


?>


