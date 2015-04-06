<?php

class Goods extends MX_Controller {

    private $module = 'goods';
    private $module_name = 'Товары';

    public function __construct() {
        parent::__construct();
        $this->load->model('goods_model');
        $this->model = $this->goods_model;
    }

    public function index() {
        $this->load->helper('url');

        if (!$this->session->userdata('logged')) {
            redirect('admin/login');
        } else {
            redirect('admin/main');
        }
    }

    public function view($for_front = false, $url = false,$subcategory_id) {
        $data['module_name'] = $this->module_name;
        $data['module'] = $this->module;
        if (!$for_front) {
            if (!$url) {
                $data['entries'] = $this->model->get(false,false,$subcategory_id);
                $data['subcategories'] = Modules::run('subcategories/get');
                //var_dump($data['subcategories']);die;
                foreach($data['entries'] as &$entry)
                {
                    $entry['subcategory_name'] = $this->getSubCatNameById($entry['subcategory_id']);
                }
                $this->load->view($this->module, $data);
            } else {
                $data['entry'] = $this->model->get_by_url($url);
                $this->load->view('front/tour', $data);
            }
        } else {
            if (!$url) {
                $data['entries'] = $this->model->get('', true);
                $this->load->view('front/' . $this->module, $data);
            } else {
                //$data['entry'] = $this->model->get_by_url($url);
                $this->load->view('front/tour', $data);
            }
        }
    }

    public function get_by_url($url) {
        return $this->model->get_by_url($url);
    }

    public function get_by_id($id) {
        return $this->model->get($id);
    }

    // static query to table 'good_attr_value' to get values
    /*public function getGAVById($id)
    {
        return $this->model->getGAV($id);
    }*/

    public function edit($id = null) {
        $entry = $this->model->get($id);
        $data['entry'] = $entry;
        $data['module_name'] = $this->module_name;
        $data['module'] = $this->module;
        $attrs = $this->model->getGAV($id);
        foreach($attrs as &$attr)
        {
            $attr['name'] = $this->model->getAttrNameById($attr['attr_id']);
        }

        $data['attrs'] = $attrs;

        if ($this->input->post('do') == $this->module . 'Edit') {
            //var_dump($this->input->post('text'));die;
            $this->form_validation->set_rules('name', 'Название', 'trim|required|xss_clean');
            $this->form_validation->set_rules('url', 'ЧПУ', 'trim|required|xss_clean');
            $this->form_validation->set_rules('active', 'Активность', 'trim|xss_clean');
            $this->form_validation->set_rules('metatile','Meta title','trim|xss_clean');

            $this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('edit', $data);
            } else {
                $config['upload_path'] = './images/' . $this->module;
                $config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|JPEG';
                $config['max_size'] = '5120';
                $config['encrypt_name'] = true;

                $this->load->library('upload', $config);
                if ($_FILES['imageBg']['name'] == '' && $_FILES['imageSm']['name'] == '') {
                    $this->model->update($id,$data['entry']['subcategory_id']);
                    $this->model->updateGAV($id);
                    $arr = array(
                        'error' => '<div class="alert alert-success" role="alert"><strong>Успех! </strong>Запись успешно обновлена!</div>'
                    );
                    $this->session->set_userdata($arr);
                    redirect('admin/' . $this->module . '/edit/' . $entry['id']);
                }
                if($_FILES['imageBg']['name'] == '')
                {
                    if (!$this->upload->do_upload('imageSm')) 
                    {
                        $this->session->set_userdata('error', $this->upload->display_errors('<span class="label label-danger">', '</span>'));
                        $this->model->update($id,$data['entry']['subcategory_id']);
                        $this->model->updateGAV($id);
                        redirect('admin/' . $this->module . '/edit/' . $entry['id']);
                    } 
                    else 
                    {
                        $image2_data = $this->upload->data();
                    }
                    
                    $entry = $this->model->get($id);
                    if (file_exists('images/' . $this->module . '/' . $entry['imageSm'])) {
                        unlink('images/' . $this->module . '/' . $entry['imageSm']);
                        $this->model->update($id,$data['entry']['subcategory_id'], null,$image2_data['file_name']);
                        $this->model->updateGAV($id);
                        $arr = array(
                            'error' => '<div class="alert alert-success" role="alert"><strong>Успех! </strong>Запись была успешно обновлена!</div>'
                        );
                        $this->session->set_userdata($arr);
                        redirect('admin/' . $this->module . '/edit/' . $entry['id']);
                    } 
                    else 
                    {
                        $this->model->update($id,$data['entry']['subcategory_id'],null, $image2_data['file_name']);
                        //var_dump($image2_data['file_name']);die;
                        $this->model->updateGAV($id);
                        $arr = array(
                            'error' => '<div class="alert alert-success" role="alert"><strong>Успех! </strong>Запись была успешно обновлена!</div>'
                        );
                        $this->session->set_userdata($arr);
                        redirect('admin/' . $this->module . '/edit/' . $entry['id']);
                    } 
                }
                if($_FILES['imageSm']['name']=='')
                {
                    if (!$this->upload->do_upload('imageBg')) 
                    {
                        $this->session->set_userdata('error', $this->upload->display_errors('<span class="label label-danger">', '</span>'));
                        $this->model->update($id,$data['entry']['subcategory_id']);
                        $this->model->updateGAV($id);
                        redirect('admin/' . $this->module . '/edit/' . $entry['id']);
                    } 
                    else 
                    {
                        $image1_data = $this->upload->data();
                    }
                
                    $entry = $this->model->get($id);
                    if (file_exists('images/' . $this->module . '/' . $entry['imageBg'])) 
                    {
                        unlink('images/' . $this->module . '/' . $entry['imageBg']);
                        $image_data = $this->upload->data();
                        $this->model->update($id,$data['entry']['subcategory_id'], $image_data['file_name']);
                        $this->model->updateGAV($id);
                        $arr = array(
                            'error' => '<div class="alert alert-success" role="alert"><strong>Успех! </strong>Запись была успешно обновлена!</div>'
                        );
                        $this->session->set_userdata($arr);
                        redirect('admin/' . $this->module . '/edit/' . $entry['id']);
                    } 
                    else 
                    {
                        $image_data = $this->upload->data();
                        $this->model->update($id,$data['entry']['subcategory_id'],$image_data['file_name']);
                        $this->model->updateGAV($id);
                        $arr = array(
                            'error' => '<div class="alert alert-success" role="alert"><strong>Успех! </strong>Запись была успешно обновлена!</div>'
                        );
                        $this->session->set_userdata($arr);
                        redirect('admin/' . $this->module . '/edit/' . $entry['id']);
                    }
                } 
                 
                
                if(!$this->upload->do_upload('imageBg'))
                {
                    $this->session->set_userdata('error', $this->upload->display_errors('<span class="label label-danger">', '</span>'));
                    redirect('admin/' . $this->module . '/edit/' . $entry['id']);
                }
                else
                {
                    $image1_data = $this->upload->data();
                }
                if(!$this->upload->do_upload('imageSm'))
                {
                    $this->session->set_userdata('error', $this->upload->display_errors('<span class="label label-danger">', '</span>'));
                    redirect('admin/' . $this->module . '/edit/' . $entry['id']);
                } 
                else
                {
                    $image2_data = $this->upload->data();
                }
                 
                
                $entry = $this->model->get($id);
                if (file_exists('images/' . $this->module . '/' . $entry['imageBg']) && file_exists('images/' . $this->module . '/' . $entry['imageSm'])) 
                {
                    unlink('images/' . $this->module . '/' . $entry['imageBg']);
                    unlink('images/' . $this->module . '/' . $entry['imageSm']);
                    $this->model->update($id,$data['entry']['subcategory_id'], $image1_data['file_name'],$image2_data['file_name']);
                    $this->model->updateGAV($id);
                    $arr = array(
                        'error' => '<div class="alert alert-success" role="alert"><strong>Успех! </strong>Запись была успешно обновлена!</div>'
                    );
                    $this->session->set_userdata($arr);
                    redirect('admin/' . $this->module . '/edit/' . $entry['id']);
                } 
                if (file_exists('images/' . $this->module . '/' . $entry['imageBg'])) 
                {
                    unlink('images/' . $this->module . '/' . $entry['imageBg']);
                    $this->model->update($id,$data['entry']['subcategory_id'], $image1_data['file_name'],$image2_data['file_name']);
                    $this->model->updateGAV($id);
                    $arr = array(
                        'error' => '<div class="alert alert-success" role="alert"><strong>Успех! </strong>Запись была успешно обновлена!</div>'
                    );
                    $this->session->set_userdata($arr);
                    redirect('admin/' . $this->module . '/edit/' . $entry['id']);
                } 
                if(file_exists('images/',$this->module . '/' . $entry['imageSm']))
                {
                    unlink('images/' . $this->mosule . '/' . $entry['imageSm']);
                    $this->model->update($id,$data['entry']['subcategory_id'], $image1_data['file_name'],$image2_data['file_name']);
                    $this->model->updateGAV($id);
                    $arr = array(
                        'error' => '<div class="alert alert-success" role="alert"><strong>Успех! </strong>Запись была успешно обновлена!</div>'
                    );
                    $this->session->set_userdata($arr);
                    redirect('admin/' . $this->module . '/edit/' . $entry['id']);
                } 
                 
                
                $this->model->update($id,$data['entry']['subcategory_id'], $image1_data['file_name'],$image2_data['file_name']);
                $this->model->updateGAV($id);
                $arr = array(
                    'error' => '<div class="alert alert-success" role="alert"><strong>Успех! </strong>Запись была успешно обновлена!</div>'
                );
                $this->session->set_userdata($arr);
                redirect('admin/' . $this->module . '/edit/' . $entry['id']);
                    
                    
                }
        } else {
            $this->load->view('edit', $data);
        }
    }

    public function check_url($url) {
        if ($this->model->get_by_url($url)) {
            $this->form_validation->set_message('check_url', 'Такой ЧПУ уже занят!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function add() {
        $data['module_name'] = $this->module_name;
        $data['module'] = $this->module;
        $hotels = Modules::run('hotels/get', '', true);
        $data['hotels'] = $hotels;
        if ($this->input->post('do') == $this->module . 'Add') {
            $this->form_validation->set_rules('name', 'Название', 'trim|required|xss_clean');
            $this->form_validation->set_rules('url', 'ЧПУ', 'trim|required|xss_clean');
            $this->form_validation->set_rules('price', 'Стоимость', 'trim|required|xss_clean');
            $this->form_validation->set_rules('metatitle', 'Meta title', 'trim|xss_clean');
            $this->form_validation->set_rules('desc', 'Мета описание', 'trim|xss_clean');

            $this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('add', $data);
            } else {
                $config['upload_path'] = './images/' . $this->module;
                $config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|JPEG';
                $config['max_size'] = '5120';
                $config['encrypt_name'] = true;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('imageBg')) {
                    $this->session->set_userdata('error', $this->upload->display_errors('<span class="label label-danger">', '</span>'));
                    redirect('admin/'.$this->module.'categories/add');
                } else {
                    $image1_data = $this->upload->data();
                }

                if (!$this->upload->do_upload('imageSm')) {
                    $this->session->set_userdata('error', $this->upload->display_errors('<span class="label label-danger">', '</span>'));
                    redirect('admin/'.$this->module.'/add');
                } else {
                    $image2_data = $this->upload->data();
                }

                $insert_id = $this->model->set($image1_data['file_name'],$image2_data['file_name']);
                $this->model->setGAV($insert_id);
                redirect('admin/' . $this->module . '/edit/' . $insert_id);
            }
        } else {
            $this->load->view('add', $data);
        }
    }

    public function delete($id) {
        if (!$this->session->userdata('logged')) {
            redirect('admin/login');
            exit();
        }
        $entry = $this->model->get($id);
        if (count($entry) > 0) {
            if (file_exists('images/' . $this->module . '/' . $entry['image'])) {
                $this->model->delete($id);
                unlink('images/' . $this->module . '/' . $entry['image']);
                $images = $this->model->get_images($id);
                foreach ($images as $img) {
                    if (file_exists('images/' . $this->module . '/' . $img['image'])) {
                        unlink('images/' . $this->module . '/' . $img['image']);
                        $this->model->delete_images($id);
                    } else {
                        die('Картинок не найдено');
                    }
                }
                redirect('admin/' . $this->module);
            } else {
                $this->model->delete($id);
                redirect('admin/' . $this->module);
            }
        } else {
            die('Ошибка! Такой записи в базе не существует!');
        }
    }

    public function images_upload($hotel_id) {
        if (!$this->session->userdata('logged')) {
            redirect('admin/login');
        }
        if (!($_FILES)) {
            die("Не выбрано ни одной картинки!");
        }
        if ($_FILES['file']['name']) {
            foreach ($_FILES['file']['name'] as $k => $f) {
                if (!$_FILES['file']['error'][$k]) {
                    $blacklist = array(".php", ".phtml", ".php3", ".php4", ".html", ".htm", ".asp", ".aspx");
                    foreach ($blacklist as $item)
                        if (preg_match("/$item\$/i", $_FILES['file']['name'][$k]))
                            die("Недопустимый формат файла");
                    if (is_uploaded_file($_FILES['file']['tmp_name'][$k])) {
                        $namef = time() . "_" . md5(uniqid()) . "." . preg_replace("/.*?\./", '', $_FILES['file']['name'][$k]);
                        ;
                        $uploadfile = "images/" . $this->module . "/" . $namef;
                        if (!move_uploaded_file($_FILES['file']['tmp_name'][$k], $uploadfile)) {
                            die("Error");
                        } else {
                            $image = $namef;
                            $this->model->images_insert($image, $hotel_id);
                            echo 'Файл "' . $_FILES['file']['name'][$k] . '" успешно загружен';
                        }
                    }
                }
            }
        }
    }

     public function get_halls_for_point($id) {
        $phalls = $this->points_model->get_halls_for_point($id);
        if (!$phalls) {
            echo '<div class="alert alert-danger" role="alert">Тренеровочных залов не найдено!</div>';
        }
        ?>
        <div class="row halls">
            <?php foreach ($phalls as $key => $phall): ?>
                <div class="col-sm-6 col-md-4" <?php
                if ($key % 3 == 0) {
                    echo 'style="clear:both;"';
                }
                ?>>
                    <div class="thumbnail">
                        <button id="<?= $phall['id'] ?>" type="button" class="close hall_del">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <img src="/images/points/halls/<?= $phall['image'] ?>" width="350" height="240" alt="...">
                        <div class="caption">
                            <h3 class="hall_name"><?php
                                if (!$phall['name']) {
                                    if ($phall['description'] == '') {
                                        echo '<input type="text" class="form-control" placeholder="Название">';
                                    }
                                } else {
                                    echo $phall['name'];
                                }
                                ?></h3>
                            <p class="hall_description"><?php
                                if (!$phall['description']) {
                                    if ($phall['name'] == '') {
                                        echo '<textarea class="form-control" rows="5" placeholder="Описание спорт. зала"></textarea>';
                                    }
                                } else {
                                    echo $phall['description'];
                                }
                                ?></p>
                            <p>
                                <a href="javascript:" class="btn btn-primary hall_save" role="button">Сохранить</a> 
                                <a href="javascript:" class="btn btn-default hall_edit" role="button">Редактировать</a>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
    }

    public function get_images($id, $front = false) {
        if ($front) {
            return $this->model->get_images($id);
        } else {
            $pimages = $this->model->get_images($id);

            if (!$pimages) {
                echo '<div class="alert alert-danger" role="alert">Миниатюр не найдено!</div>';
            }
            ?>
            <div class="row images">
                <?php
                foreach ($pimages as $k => $pimage):
                    $k++;
                    ?>
                    <div id="image_<?= $pimage['id'] ?>" style="" class="col-sm-6 col-sm-4">
                        <p class="thumbnail" style="width:100%;height:100%;">
                            <button id="<?= $pimage['id'] ?>" type="button" class="close image_del">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <a class="image_view" style="width:100%;height:100%;" href="/images/<?= $this->module . '/' . $pimage['image'] ?>">
                                <img class="img-rounded" style="width:100%;height:100%;" src="/images/<?= $this->module . '/' . $pimage['image'] ?>" alt="...">
                            </a>
                            <div class="caption">
                                <h3 class="good_name"><?php
                                    if (!$pimage['name']) {
                                        echo '<input type="text" class="form-control" placeholder="Название">';
                                    } else {
                                        echo $pimage['name'];
                                    }
                                    ?>
                                </h3>
                                <p>
                                    <a href="javascript:" class="btn btn-primary good_save" role="button">Сохранить</a> 
                                    <a href="javascript:" class="btn btn-default good_edit" role="button">Редактировать</a>
                                </p>
                            </div>
                        </p>
                    </div>
                    <?php if ($k % 6 == 0): ?>
                        <div class="clear"></div>
                    <?php endif; ?>
                    <?php
                endforeach;
                ?>
            </div>
            <?php
        }
    }

    public function image_delete() {
        if (!$this->session->userdata('logged')) {
            alert('Авторизуйтесь!');
            die();
        }
        $id = $this->input->post('id');
        $image = $this->model->get_image($id);
        if (count($image) > 0) {
            if (file_exists('images/' . $this->module . '/' . $image['image'])) {
                $this->model->delete_image($id);
                unlink('images/' . $this->module . '/' . $image['image']);
            } else {
                $this->model->delete_image($id);
            }
        } else {
            die('Такой картинки не существует!');
        }
    }

    public function up($id) {
        $this->model->order($id, 'up');
    }

    public function down($id) {
        $this->model->order($id, 'down');
    }

    public function getCategoriesAjax()
    {
        echo json_encode($this->model->getCategories());   
    }

    public function getSubCategoriesAjax()
    {
        echo json_encode($this->model->getSubCategories());   
    }

    public function getAttrAjax()
    {
        $id = (int) $_POST['id'];
        echo json_encode($this->model->getAttrById($id));
    }



    public function getSubCatNameById($id)
    {
        return $this->model->getSubCatNameById($id);
    }

    public function getBySubCatUrl($url)
    {
        //var_dump($url);
        if ($url) 
        {
            return $this->model->getBySubCatUrl($url);
        }
        else
            return false;
    }

    public function getAttrById($goodId)
    {
        return $this->model->getGAV($goodId);
    }

    public function getAttrNameById($id)
    {
        return $this->model->getAttrNameById($id);
    }

    public function good_data_save()
    {
        var_dump($_POST);
        $this->model->good_data_save();
    }


}
