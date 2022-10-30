<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Empresa extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('codigo') == false)
            redirect('');
    }

    public function index() {
        $data['title'] = "ADM - Empresa listagem";

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('telas/view_empresa_listagem');
        $this->load->view('templates/footer');
        $this->load->view('ajax/empresasListagem');
    }
    
    public function formulario_cadastro_empresa() {
        $data['title'] = "ADM - Empresa cadastro";

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('telas/view_empresa_cadastro');
        $this->load->view('templates/footer');
        $this->load->view('ajax/empresasCadastro');
    }

    public function listagemEmpresa() {
        $this->load->model('empresa_models');

        $data = $this->empresa_models->listaEmpresa($this->input->get('q'));

        echo json_encode($data);
    }
    
    public function buscarEmpresaModal() {
        echo json_encode('teste');
    }
    
    public function inserirEmpresa() {
        $this->load->model('empresa_models');
                
        $dadosEmpresa = array(
            'codigo' => $this->input->post('codigo'),
            'nome' => $this->input->post('razao_social'),
            'nome_fantasia' => $this->input->post('nome_fantasia'),
            'cnpj' => $this->input->post('cnpj'),
            'inscricao' => $this->input->post('inscricao'),
            'responsavel' => $this->input->post('responsavel'),
            'email' => $this->input->post('email'),
            'cidade' => $this->input->post('cidade'),
            'telefone_celular' => $this->input->post('telefone_celular'),
            'telefone_fixo' => $this->input->post('telefone_fixo'),
            'motivo' => $this->input->post('motivo'),
            'ativo' => $this->input->post('ativo'),
            'contato' => $this->input->post('contato'),
            'nfce' => $this->input->post('nfce') == 'true' ? 1 : 0,
            'cte' => $this->input->post('cte') == 'true' ? 1 : 0,
            'mdfe' => $this->input->post('mdfe') == 'true' ? 1 : 0,
        );
        
        if ($this->input->post('codigo') == 0) {
            $data = $this->empresa_models->inserirEmpresa($dadosEmpresa);
        } else {
            $data = $this->empresa_models->updateEmpresa($dadosEmpresa);
        }

        
        echo json_encode($data);
    }

}
