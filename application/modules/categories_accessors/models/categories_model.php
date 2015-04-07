<?php

class Categories_model extends CI_Model {

    private $table_name = 'categories';
//    private $images_table = 'news_images';
    private $redirect_url = 'categories';

    public function __construct() {
        $this->load->database();
    }

    public function order($id, $direction) {
        $query = $this->db->get_where($this->table_name, array('id' => $id));
        $category = $query->row_array();
        $order = $category['order'];
        if ($direction == 'up') {
            $order++;
        } elseif ($direction == 'down') {
            $order--;
        }
        $data = array(
            'order' => $order,
        );

        $this->db->where('id', $id);
        $this->db->update($this->table_name, $data);
        redirect('admin/' . $this->redirect_url);
    }

    public function get($id = null, $for_front = false) {
        if (!$for_front) {
            if ($id) {
                $query = $this->db->get_where($this->table_name, array('id' => $id));

                return $query->row_array();
            }
            $this->db->order_by('order', 'desc');
            $query = $this->db->get($this->table_name);
            if (count($query->result_array()) > 0) {
                return $query->result_array();
            } else {
                return false;
            }
        } else {
            if ($id) {
                $query = $this->db->get_where($this->table_name, array('id' => $id, 'active' => 'on'));

                return $query->row_array();
            }
            $this->db->order_by('order', 'desc');
            $query = $this->db->get_where($this->table_name, array('active' => 'on'));
            if (count($query->result_array()) > 0) {
                return $query->result_array();
            } else {
                return false;
            }
        }
    }

    public function get_by_url($url, $for_front = true) {
        if ($for_front) {
            $query = $this->db->get_where($this->table_name, array('active' => 'on', 'url' => $url));
            return $query->row_array();
        } else {
            $query = $this->db->get_where($this->table_name, array('url' => $url));
            return $query->row_array();
        }
    }

    public function get_blogs($id = null) {
        if ($id) {
            $query = $this->db->get_where($this->table_name, array('id' => $id));
            return $query->row_array();
        }
        $this->db->order_by('order', 'desc');
        $query = $this->db->get($this->table_name);
        if (count($query->result_array()) > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function get_tags($page_id) {
        if ($page_id) {
            $query = $this->db->get_where('tags', array('page_id' => $page_id, 'object' => 'blog'));
            return $query->result_array();
        }
    }

    public function set($image) {

        $data = array(
            'active' => $this->input->post('active'),
            'url' => $this->input->post('url'),
            'name' => $this->input->post('name'),
            'image' => $image,
            'text' => $this->input->post('text'),
            'metatitle' => $this->input->post('metatitle'),
            'desc' => $this->input->post('desc'),
            'keyw' => $this->input->post('keyw'),
        );

        $this->db->insert($this->table_name, $data);
        return $this->db->insert_id();
    }

    public function delete($id) {
        $this->db->delete($this->table_name, array('id' => $id));
    }

    public function update($id, $image = null) {
        if (!$image) {
            $data = array(
                'active' => $this->input->post('active'),
                'name' => $this->input->post('name'),
                'url' => $this->input->post('url'),
                'text' => $this->input->post('text'),
                'metatitle' => $this->input->post('metatitle'),
                'desc' => $this->input->post('desc'),
                'keyw' => $this->input->post('keyw'),
            );
            $this->db->where('id', $id);
            $this->db->update($this->table_name, $data);
        } else {
            $data = array(
                'active' => $this->input->post('active'),
                'name' => $this->input->post('name'),
                'url' => $this->input->post('url'),
                'text' => $this->input->post('text'),
                'image' => $image,
                'metatitle' => $this->input->post('metatitle'),
                'desc' => $this->input->post('desc'),
                'keyw' => $this->input->post('keyw'),
            );

            $this->db->where('id', $id);
            $this->db->update($this->table_name, $data);
        }
    }

}
