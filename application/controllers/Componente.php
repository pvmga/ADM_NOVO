<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Componente extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('codigo') == false)
            redirect('');
    }

    public function index() {
        $data['title'] = "ADM - Componente listagem";

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('telas/view_componente_listagem');
        $this->load->view('templates/footer');
        $this->load->view('ajax/componentesListagem');
    }
    
    public function formulario_cadastro_componente() {
        $data['title'] = "ADM - Cadastro de componentes";

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('telas/view_componente_cadastro');
        $this->load->view('templates/modal');
        $this->load->view('templates/footer');
        $this->load->view('ajax/componentesCadastro');
    }

    public function listagemComponente() {
        $this->load->model('componente_models');

        $data = $this->componente_models->listaComponente();

        echo json_encode($data);
    }

    public function buscarComponente() {
        $this->load->model('componente_models');
        
        $codigo = $this->input->post('codigo');
        $data = $this->componente_models->listaComponente($codigo);

        echo json_encode($data);
    }

    public function salvarComponente() {
        $this->load->model('componente_models');

        $dadosComponente = array(
            'descricao' => $this->input->post('descricao_componente'),
            'cod_produto' => $this->input->post('select2Produto'),
            'ativo' => $this->input->post('ativo')
        );
        
        $codigo = $this->input->post('codigo');
        if ($codigo == 0) {
            $data = $this->componente_models->insertComponenteModels($dadosComponente);
        } else {
            $data = $this->componente_models->updateComponenteModels($dadosComponente, $codigo);
        }

        echo json_encode($data);
    }

}
