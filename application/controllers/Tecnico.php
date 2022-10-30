<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tecnico extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('codigo') == false)
            redirect('');
    }

	public function index()
	{
		$data['title'] = "ADM - Técnico listagem";

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('templates/topbar');
		$this->load->view('telas/view_tecnico_listagem');
		$this->load->view('templates/footer');
		$this->load->view('ajax/tecnicosListagem');
	}

	public function listagemTecnico() {
            $this->load->model('tecnico_models');

            $data = $this->tecnico_models->listaTecnico($this->input->get('q'));

            echo json_encode($data);
	}
}
