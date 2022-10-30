<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Representante extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('codigo') == false)
            redirect('');
    }

	public function index()
	{
		$data['title'] = "ADM - Representante listagem";

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('templates/topbar');
		$this->load->view('telas/view_representante_listagem');
		$this->load->view('templates/footer');
		$this->load->view('ajax/representantesListagem');
	}

	public function listagemRepresentante() {
		$this->load->model('representante_models');

		$data = $this->representante_models->listaRepresentante($this->input->get('q'));

		echo json_encode($data);
	}
}
