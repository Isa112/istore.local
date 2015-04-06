<?php

class Blog extends MX_Controller {

    private $module = 'blog';
    private $module_name = 'Блог';

    public function __construct() {
        parent::__construct();
        $this->load->model('blog_model');
    }

    public function index() {
        $this->load->helper('url');

        if (!$this->session->userdata('logged')) {
            redirect('admin/login');
        } else {
            redirect('admin/main');
        }
    }

    public function view($for_front = false, $url = false) {
        $data['module_name'] = $this->module_name;
        $data['module'] = $this->module;
        if (!$for_front) {
            if ($url) {
                $data['entries'] = $this->blog_model->get_by_url($url);
            } else {
                $data['entries'] = $this->blog_model->get();
                $this->load->view($this->module, $data);
            }
        } else {
            if ($url) {
                $data['entries'] = $this->blog_model->get_by_url($url);
                $this->load->view('front/post', $data);
            } else {
                $data['entries'] = $this->blog_model->get('', true);
                $this->load->view('front/' . $this->module, $data);
            }
        }
    }

    public function edit($id = null) {
        global $object;
        $object = 'blog';
        $data['title'] = 'Административная панель';
        $entry = $this->blog_model->get_blogs($id);
        $data['entry'] = $entry;
        $tags = $this->blog_model->get_tags($id);
        $data['tags'] = $tags;
        $data['module_name'] = $this->module_name;
        $data['module'] = $this->module;
        $data['categories'] = Modules::run('categories/get');
        if ($this->input->post('do') == 'blogEdit') {
            $this->form_validation->set_rules('name', 'Заголовок', 'required|trim|xss_clean');
            //$this->form_validation->set_rules('url', 'Чпу', 'required|trim|xss_clean');
            $this->form_validation->set_rules('text', 'Текст', 'required');
            $this->form_validation->set_rules('title', 'Мета title', 'trim|xss_clean');
            $this->form_validation->set_rules('desc', 'Мета description', 'trim|xss_clean');
            $this->form_validation->set_rules('keyw', 'Мета keywords', 'trim|xss_clean');
            $this->form_validation->set_rules('date', 'Дата публикации', 'trim|xss_clean');

            $this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('edit', $data);
            } else {
                $config['upload_path'] = './images/' . $this->module;
                $config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|JPEG';
                $config['max_size'] = '5120';
                $config['encrypt_name'] = true;

                $this->load->library('upload', $config);

                $image_data = $this->upload->data();
                if ($_FILES['image']['name'] == '') {
                    if ($this->input->post('tags')) {
                        foreach ($this->input->post('tags') as $tag) {
                            Modules::run('admin/set_tag', $tag, $id, $object);
                        }
                    }
                    $this->blog_model->update($id);
                    $arr = array(
                        'error' => '<div class="alert alert-success" role="alert"><strong>Успех! </strong>Запись была успешно обновлена!</div>'
                    );
                    $this->session->set_userdata($arr);
                    redirect('admin/' . $this->module . '/edit/' . $entry['id']);
                } else {
                    if (!$this->upload->do_upload('image')) {
                        $this->session->set_userdata('error', $this->upload->display_errors('<span class="label label-danger">', '</span>'));
                        redirect('admin/' . $this->module . '/edit/' . $entry['id']);
                    } else {
                        $entry = $this->blog_model->get_blogs($id);
                        if (file_exists('images/' . $this->module . '/' . $entry['image'])) {
                            unlink('images/' . $this->module . '/' . $entry['image']);
                            if ($this->input->post('tags')) {
                                foreach ($this->input->post('tags') as $tag) {
                                    Modules::run('admin/set_tag', $tag, $id, $object);
                                }
                            }
                            $image_data = $this->upload->data();
                            $this->blog_model->update($id, $image_data['file_name']);
                            $arr = array(
                                'error' => '<div class="alert alert-success" role="alert"><strong>Успех! </strong>Запись была успешно обновлена!</div>'
                            );
                            $this->session->set_userdata($arr);
                            redirect('admin/' . $this->module . '/edit/' . $entry['id']);
                        } else {
                            if ($this->input->post('tags')) {
                                foreach ($this->input->post('tags') as $tag) {
                                    Modules::run('admin/set_tag', $tag, $id, $object);
                                }
                            }
                            $image_data = $this->upload->data();
                            $this->blog_model->update($id, $image_data['file_name']);
                            $arr = array(
                                'error' => '<div class="alert alert-success" role="alert"><strong>Успех! </strong>Запись была успешно обновлена!</div>'
                            );
                            $this->session->set_userdata($arr);
                            redirect('admin/' . $this->module . '/edit/' . $entry['id']);
                        }
                    }
                }
            }
        } else {
            $this->load->view('edit', $data);
        }
    }

    public function get_by_url($url) {
        return $this->blog_model->get_by_url($url);
    }

    public function get3posts_for_front() {
        return $this->blog_model->get3posts_for_front();
    }

    public function check_url($url) {
        if ($this->blog_model->get_by_url($url)) {
            $this->form_validation->set_message('check_url', 'Такой ЧПУ уже занят!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function add() {
        global $object;
        $object = 'blog';
        $data['title'] = 'Административная панель';
        $data['module_name'] = $this->module_name;
        $data['module'] = $this->module;
        $data['categories'] = Modules::run('categories/get');
        if ($this->input->post('do') == 'blogAdd') {
            $this->form_validation->set_rules('name', 'Заголовок', 'required|trim|xss_clean');
            $this->form_validation->set_rules('url', 'Чпу', 'required|trim|xss_clean|callback_check_url');
            $this->form_validation->set_rules('text', 'Текст', 'trim|xss_clean');
            $this->form_validation->set_rules('title', 'Мета title', 'trim|xss_clean');
            $this->form_validation->set_rules('desc', 'Мета description', 'trim|xss_clean');
            $this->form_validation->set_rules('keyw', 'Мета keywords', 'trim|xss_clean');
            $this->form_validation->set_rules('date', 'Дата публикации', 'trim|xss_clean');

            $this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('add', $data);
            } else {
                $config['upload_path'] = './images/' . $this->module;
                $config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|JPEG';
                $config['max_size'] = '5120';
                $config['encrypt_name'] = true;

                $this->load->library('upload', $config);

                $image_data = $this->upload->data();
                if (!$this->upload->do_upload('image')) {
                    $this->session->set_userdata('error', $this->upload->display_errors('<span class="label label-danger">', '</span>'));
                    redirect('admin/' . $this->module . '/add');
                } else {
                    $image_data = $this->upload->data();
                    $insert_id = $this->blog_model->set($image_data['file_name']);

                    $arr = array(
                        'error' => '<div class="alert alert-success" role="alert"><strong>Успех! </strong>Запись была успешно добавлена!</div>'
                    );
                    $this->session->set_userdata($arr);
                    redirect('admin/' . $this->module . '/edit/' . $insert_id);
                }
            }
        } else {
            $this->load->view('add', $data);
        }
    }

    public function delete($id) {
        $entry = $this->blog_model->get($id);
        if (count($entry) > 0) {
            if (file_exists('images/' . $this->module . '/' . $entry['image'])) {
                $this->blog_model->delete($id);
                unlink('images/' . $this->module . '/' . $entry['image']);
                redirect('admin/' . $this->module);
            } else {
                $this->blog_model->delete($id);
                redirect('admin/' . $this->module);
            }
        } else {
            die('Ошибка! Такой записи в базе не существует!');
        }
    }

    public function up($id) {
        $this->blog_model->order($id, 'up');
    }

    public function down($id) {
        $this->blog_model->order($id, 'down');
    }

}
