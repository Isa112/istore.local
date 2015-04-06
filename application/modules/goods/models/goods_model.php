<?php

class Goods_model extends CI_Model {

    private $table_name = 'goods';
    private $primary_key = 'id';
    private $redirect_url = 'goods';
    private $images_table = 'goods_images';

    public function __construct() {
        $this->load->database();
    }

    public function order($id, $direction) {
        $query = $this->db->get_where($this->table_name, array($this->primary_key => $id));
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

        $this->db->where($this->primary_key, $id);
        $this->db->update($this->table_name, $data);
        redirect('admin/' . $this->redirect_url);
    }

    public function get($id = null, $for_front = false,$subcategory_id=null) {
        if (!$for_front) {
            if ($id) {
                $query = $this->db->get_where($this->table_name, array($this->primary_key => $id));

                return $query->row_array();
            }
            $this->db->order_by('order', 'desc');
            if($subcategory_id)
                $query = $this->db->get_where($this->table_name,array('subcategory_id'=>$subcategory_id));
            else
                $query = $this->db->get($this->table_name);
            if (count($query->result_array()) > 0) {
                return $query->result_array();
            } else {
                return false;
            }
        } else {
            if ($id) {
                $query = $this->db->get_where($this->table_name, array($this->primary_key => $id, 'active' => 'on'));

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

    public function getBySubCatUrl($url)
    {
        $id = $this->getSubCatIdByUrl($url);
        $query = $this->db->get_where($this->table_name,array('subcategory_id'=>$id));
        if(count($query->result_array()) > 0)
            return $query->result_array();
        else 
            return false;
    }

    public function get_by_url($url) {
        $query = $this->db->get_where($this->table_name, array('active' => 'on', 'url' => $url));
        return $query->row_array();
    }

    public function images_insert($image, $id) {
        $data = array(
            'image' => $image,
            'order' => 0,
            'good_id' => $id
        );

        return $this->db->insert($this->images_table, $data);
    }

    public function get_images($id) {
        $query = $this->db->get_where($this->images_table, array('good_id' => $id));
        return $query->result_array();
    }

    public function delete_images($id) {
        $this->db->delete($this->images_table, array('tour_id' => $id));
    }

    public function get_image($id) {
        $query = $this->db->get_where($this->images_table, array($this->primary_key => $id));
        return $query->row_array();
    }

    public function delete_image($id) {
        $this->db->delete($this->images_table, array($this->primary_key => $id));
    }

    public function set($image1,$image2) {
        
        $data = array(
            'name' => $this->input->post('name'),
            'url' => $this->input->post('url'),
            'price' => $this->input->post('price'),
            'imageBg' => $image1,
            'imageSm' => $image2,
            'text'  => $this->input->post('text'),
            'active' => $this->input->post('active'),
            'subcategory_id' => $this->input->post('subcategory'),
            'metatitle' => $this->input->post('metatitle'),
            'desc' => $this->input->post('desc'),
            'keyw' => $this->input->post('keyw')
        );

        $this->db->insert($this->table_name, $data);
        return $this->db->insert_id();
    }

    public function setGAV($good_id)
    {
        foreach($_POST['attr'] as $key=>$attr)
        { 
            $data = null;
            $data['good_id'] = $good_id;
            $data['attr_id'] = $key;
            $data['value'] = $attr;
            $this->db->insert('good_attr_value',$data);
        }
    }

    public function delete($id) {
        if (!$this->session->userdata('logged')) {
            redirect('admin/login');
        }
        $this->db->delete($this->table_name, array($this->primary_key => $id));
    }

    public function update($id,$subCategory_id,$image1 = null,$image2 = null) {
        if(!$image2 && !$image1)
        {

            $data = array(
                'name' => $this->input->post('name'),
                'url' => $this->input->post('url'),
                'active' => $this->input->post('active'),
                'price' => $this->input->post('price'),
                'text'  => $this->input->post('text'),
                'metatitle' => $this->input->post('metatitle'),
                'subcategory_id' => $this->input->post('subcategory')
            );
            //var_dump($data['text']);die;
            $this->db->where($this->primary_key, $id);
            $this->db->update($this->table_name, $data);
        } 
        elseif(!$image1)
        {
            $data = array(
                'name' => $this->input->post('name'),
                'url' => $this->input->post('url'),
                'active' => $this->input->post('active'),
                'price' => $this->input->post('price'),
                'text'  => $this->input->post('text'),
                'imageSm' => $image2,
                'subcategory_id' => $this->input->post('subcategory')
            );
            $this->db->where($this->primary_key, $id);
            $this->db->update($this->table_name, $data);
        }
        elseif(!$image2)
        {
            //var_dump('lol_model');die;
            $data = array(
                'name' => $this->input->post('name'),
                'url' => $this->input->post('url'),
                'active' => $this->input->post('active'),
                'text'  => $this->input->post('text'),
                'price' => $this->input->post('price'),
                'imageBg' => $image1,
                'subcategory_id' => $this->input->post('subcategory')
            );
            $this->db->where($this->primary_key, $id);
            $this->db->update($this->table_name, $data);
        }
        else 
        {
            $data = array(
                'name' => $this->input->post('name'),
                'url' => $this->input->post('url'),
                'active' => $this->input->post('active'),
                'text'  => $this->input->post('text'),
                'imageBg' => $image1,
                'imageSm' => $image2,
                'price' => $this->input->post('price'),
                'subcategory_id' => $this->input->post('subcategory')
            );

            $this->db->where($this->primary_key, $id);
            $this->db->update($this->table_name, $data);
        }

        if($subcategory_id != $this->input->post('subcategory'))
            $this->deleteGAV($id);
    }

    public function updateGAV($good_id) {
        //var_dump($_POST['attr']);die;
        foreach($_POST['attr'] as $key=>$attr)
        { 
            $data = null;
            $data['value'] = $attr;
            $this->db->where(array('good_id'=>$good_id,'attr_id'=>$key));
            $this->db->update('good_attr_value',$data);
            if($this->db->count_all()==0)
                $this->db->insert('good_attr_value',array('good_id' =>$good_id,'attr_id'=>$key,'value'=>$attr));
        }
    }

    public function deleteGAV($good_id)
    {
        $this->db->where('good_id',$good_id);
        $this->db->delete('good_attr_value');
    }

    // extracts categories from db

    public function getCategories()
    {
        $query = $this->db->get("categories");
        return ($query->result_array());
    }

    public function getSubCategories()
    {
        $query = $this->db->get("subcategories");
        return ($query->result_array());
    }

    public function getAttrById($catId)
    {
        $query = $this->db->get_where('attributes',array('category_id'=>$catId));
        return $query->result_array();
    }

    public function getGAV($good_id)
    {
        $query = $this->db->get_where('good_attr_value',array('good_id'=>$good_id));
        return $query->result_array();
    }

    public function getAttrNameById($id)
    {
        $query = $this->db->get_where('attributes',array('id'=>$id));
        $result = $query->row_array();
        return $result['name'];
    }

    public function getSubCatNameById($id)
    {
        $query = $this->db->get_where('subcategories',array('id' => $id));
        $subCategory = $query->row_array();
        return $subCategory['text'];
    }

    public function getSubCatIdByUrl($url)
    {
        $query = $this->db->get_where('subcategories',array('url' => $url));
        $subCat = $query->row_array();
        return  $subCat['id'];
    }

    public function good_data_save() {
        $good_id = $this->input->post('good_id');
        $good_name = $this->input->post('good_name');
        var_dump($_POST);
        $data = array(
            'name' => $good_name,
            'order' => 0
        );

        $this->db->where('id', $good_id);
        $this->db->update($this->images_table, $data);
    }

}
