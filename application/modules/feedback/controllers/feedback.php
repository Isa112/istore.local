<?php

class Feedback extends MX_Controller {

    private $module = 'feedback';
    private $model;
    private $module_name = 'Обратная связь';

    public function __construct() {
        parent::__construct();
        $this->load->model('feedback_model');
        $this->model = $this->feedback_model;
        $this->form_validation->set_message('required', 'Поле "%s" обязательно для заполения');
        $this->form_validation->set_message('valid_email', 'Поле "%s" должно содержать валидный E-mail адрес');
    }

    public function index() {
        $this->load->helper('url');

        if (!$this->session->userdata('logged')) {
            redirect('admin/login');
        } else {
            redirect('admin/main');
        }
    }

    public function savemail() {
        if (!$this->session->userdata('logged')) {
            redirect('admin/login');
        }
        if ($this->input->post('email')) {
            $email = $this->input->post('email');
            $this->model->save_email();
        }
    }

    public function view($for_front = false) {
        $data['module_name'] = $this->module_name;
        $data['module'] = $this->module;
        $data['email'] = $this->model->get_email();
        if (!$for_front) {
            $data['entries'] = $this->model->get();
            $this->load->view($this->module, $data);
        } else {
            $data['entries'] = $this->model->get('', true);
            $this->load->view('front/feedback_form', $data);
        }
    }

    public function save() {
        $data['module'] = $this->module;
        if ($this->input->post('do') == $this->module . 'Save') {
            $this->form_validation->set_rules('name', 'name', 'required|trim|xss_clean');
            $this->form_validation->set_rules('email', 'email', 'required|valid_email|trim|xss_clean');
            $this->form_validation->set_rules('theme', 'theme', 'required|trim|xss_clean');
            $this->form_validation->set_rules('message', 'message', 'required|trim|xss_clean');

            $this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('front/feedback_form');
            } else {
                $this->model->set();
                echo '<p style="margin:10px; font-weight:bold; text-align:center; color:green">Успех! Сообщение отправлено.</p>';
                $emailArray = $this->model->get_email();

                if (valid_email($emailArray['email'])) {
                    $config = array(
                        'protocol' => 'smtp',
                        'smtp_host' => 'ssl://smtp.googlemail.com',
                        'smtp_port' => 465,
                        'smtp_user' => 'officialakniet@gmail.com',
                        'smtp_pass' => 'googstud321',
                        'mailtype' => 'html',
                        'charset' => 'utf-8'
                    );
                    $this->load->library('email');
                    $this->email->initialize($config);

                    $this->email->set_newline("\r\n");
                    $this->email->from('support@travelshop.ru', 'Новое сообщение с сайта ' . str_ireplace('http://', '', substr(base_url(), 0, -1)));
                    $this->email->to($emailArray['email']);
                    $this->email->subject('Новое сообщение с сайта ' . str_ireplace('http://', '', substr(base_url(), 0, -1)));
                    $this->email->message(
                            'Имя: ' . $this->input->post('name') . '<br>' .
                            'Телефон: ' . $this->input->post('phone') . '<br>' .
                            'E-mail: ' . $this->input->post('email') . '<br>' .
                            'Текст: ' . $this->input->post('text') . '<br>' .
                            'Дата: ' . date('Y-m-d H:i:s') . '<br>' .
                            'IP: ' . $this->input->ip_address() . '<br>'
                    );
                    $this->email->send();
                }
            }
        } else {
            $this->load->view('front/feedback_form', $data);
        }
    }

    public function more($id = null) {
        $data['title'] = 'Административная панель';
        $data['module_name'] = $this->module_name;
        $data['module'] = $this->module;
        $entry = $this->model->get($id);
        $data['entry'] = $entry;
        $this->load->view('more', $data);
    }

    public function setread() {
        if (!$this->session->userdata('logged')) {
            redirect('admin/login');
        }
        if ($this->input->post('id')) {
            $id = $this->input->post('id');
            $this->model->update_request_read($id);
        }
    }

    public function delete($id) {
        $entry = $this->model->get($id);
        if (count($entry) > 0) {
            $this->model->delete($id);
            redirect('admin/' . $this->module);
        } else {
            die('Ошибка! Такой записи в базе не существует!');
        }
    }

    public function up($id) {
        $this->model->order($id, 'up');
    }

    public function down($id) {
        $this->model->order($id, 'down');
    }

}
