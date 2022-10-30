<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Produto extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('codigo') == false)
            redirect('');
    }

    public function index() {
        $data['title'] = "ADM - Produto listagem";

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('telas/view_produto_listagem');
        $this->load->view('templates/footer');
        $this->load->view('ajax/produtosListagem');
    }
    
    public function formulario_cadastro_produto() {
        $data['title'] = "ADM - Cadastro de produtos";

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('telas/view_produto_cadastro');
        $this->load->view('templates/modal');
        $this->load->view('templates/footer');
        $this->load->view('ajax/produtosCadastro');
    }
    
    public function buscarProduto() {
        $this->load->model('produto_models');
        
        $codigo = $this->input->post('codigo');
        $data = $this->produto_models->listaProdutoModels($codigo);

        echo json_encode($data);
    }

    public function listagemProduto() {
        $this->load->model('produto_models');

        $data = $this->produto_models->listaProduto($this->input->get('q'));

        echo json_encode($data);
    }
    
    public function salvarProduto() {
        $this->load->model('produto_models');

        $dadosProduto = array(
            'descricao' => $this->input->post('descricao_produto'),
            'ativo' => $this->input->post('ativo')
        );
        
        $codigo = $this->input->post('codigo');
        if ($codigo == 0) {
            $data = $this->produto_models->insertProdutoModels($dadosProduto);
        } else {
            $data = $this->produto_models->updateProdutoModels($dadosProduto, $codigo);
        }

        echo json_encode($data);
    }

}
