<?php

class Feedback_model extends CI_Model {

    private $table_name = 'feedback';
    private $redirect_url = 'feedback';

    public function __construct() {
        $this->load->database();
    }

    public function get($id = null, $for_front = false) {
        if (!$for_front) {
            if ($id) {
                $query = $this->db->get_where($this->table_name, array('id' => $id));

                return $query->row_array();
            }
            $query = $this->db->get($this->table_name);
            if (count($query->result_array()) > 0) {
                return $query->result_array();
            } else {
                return false;
            }
        }
    }

    public function get_email() {
        $query = $this->db->get('feedback_email');
        if (count($query->row_array()) > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function save_email() {
        $data = array(
            'email' => $this->input->post('email')
        );
        $this->db->update('feedback_email', $data);
    }

    public function get_unread_requests() {
        $query = $this->db->get_where($this->table_name, array('read' => '0'));
        if (count($query->result_array()) > 0) {
            return count($query->result_array());
        } else {
            return false;
        }
    }

    public function request_delete($id) {
        $this->db->delete($this->table_name, array('id' => $id));
    }

    public function update_request_read($id) {
        $data = array(
            'read' => 'on'
        );
        $this->db->where('id', $id);
        $this->db->update($this->table_name, $data);
    }

    public function set() {

        date_default_timezone_set('Asia/Bishkek');
        $data = array(
            'name' => $this->input->post('name'),
            'text' => $this->input->post('text'),
            'email' => $this->input->post('email'),
            'date' => date('Y-m-d H:i:s'),
            'phone' => $this->input->post('phone'),
            'ip' => $this->input->ip_address(),
            'read' => 0
        );

        return $this->db->insert($this->table_name, $data);
    }

    public function delete($id) {
        $this->db->delete($this->table_name, array('id' => $id));
    }

}
