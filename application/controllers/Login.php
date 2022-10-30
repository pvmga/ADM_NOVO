<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['title'] = "ADM - Login";

        $this->load->view('templates/header', $data);
        $this->load->view('telas/view_login');
        $this->load->view('ajax/validaLogin');
    }

    public function verificaLogin() {
        $user = $this->input->post('emailLogin');
        $pass = md5($this->input->post('senhaLogin'));

        $this->load->model('login_models');
        $usuarios = $this->login_models->listaUsuarios($user, $pass);

        if (count($usuarios) > 0) {
            $this->session->set_userdata($usuarios[0]);
        }

        echo json_encode($usuarios);
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('');
    }

}
