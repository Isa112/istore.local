<?php

class Subcategories_model extends CI_Model {

    private $table_name = 'subcategories';
    private $images_table = 'subcategories_images';
    private $redirect_url = 'subcategories';
    private $primary_key = 'id';

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
                /*var_dump($query->row_array());die;*/
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
            'text' => $this->input->post('text'),
            'category_id' => $this->input->post('category'),
            'image' => $image,
            'title' => $this->input->post('title'),
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
                'url' => $this->input->post('url'),
                'text' => $this->input->post('text'),
                'category_id' => $this->input->post('category'),
                'title' => $this->input->post('title'),
                'desc' => $this->input->post('desc'),
                'keyw' => $this->input->post('keyw'),
            );
            $this->db->where('id', $id);
            $this->db->update($this->table_name, $data);
        } else {
            $data = array(
                'active' => $this->input->post('active'),
                'url' => $this->input->post('url'),
                'text' => $this->input->post('text'),
                'category_id' => $this->input->post('category'),
                'image' => $image,
                'title' => $this->input->post('title'),
                'desc' => $this->input->post('desc'),
                'keyw' => $this->input->post('keyw'),
            );

            $this->db->where('id', $id);
            $this->db->update($this->table_name, $data);
        }
    }

    public function getCategoryById($id)
    {
        $id = (int)$id;
        return Modules::run('categories/get',$id);
    }

    public function getByCatId($id) {
        if ($id) 
        {
            $query = $this->db->get_where($this->table_name, array('category_id' => $id, 'active' => 'on'));

            return $query->result_array();
        }
        else {
            return false;
        }
    }

    public function getCatIdByUrl($url) {
        return Modules::run('categories/get_by_url',$url);
    }

    public function images_insert($image, $id) {
        $data = array(
            'image' => $image,
            'order' => 0,
            'subcategory_id' => $id
        );

        return $this->db->insert($this->images_table, $data);
    }

    public function get_images($id) {
        $query = $this->db->get_where($this->images_table, array('subcategory_id' => $id));
        return $query->result_array();
    }

    public function delete_images($id) {
        $this->db->delete($this->images_table, array('subcategory_id' => $id));
    }

    public function get_image($id) {
        $query = $this->db->get_where($this->images_table, array($this->primary_key => $id));
        return $query->row_array();
    }

    public function delete_image($id) {
        $this->db->delete($this->images_table, array($this->primary_key => $id));
    }

}
