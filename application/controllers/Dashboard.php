<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('codigo') == false)
            redirect('');
    }

    public function index() {
        $data['title'] = "ADM - Dashboard";

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('telas/view_dashboard');
        $this->load->view('templates/modal');
        $this->load->view('templates/footer');
        $this->load->view('ajax/dashboard');
    }

    public function buscarDadosDashboard() {
        $this->load->model('chamado_models');
        
        $result['aguardando'] = $this->chamado_models->getCardDash('Aguardando');
        $result['confirmadas'] = $this->chamado_models->getCardDash('Confirmado');
        $result['atualizar'] = $this->chamado_models->getCardDash('Atualizar');
        $result['resolvidas'] = $this->chamado_models->getCardDash('Resolvido');
        
        echo json_encode($result);
    }

}
