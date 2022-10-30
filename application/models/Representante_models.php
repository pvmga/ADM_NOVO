<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Representante_models extends CI_Model {

    public function __construct() {
		parent::__construct();
    }
    
    public function listaRepresentante($representante) {
      
		$sql = "select * from vendedor";

		$query = $this->db->query($sql);

		foreach ($query->result_array() as $representantes) {
			
			$data['data'][] = [
				'id' => $representantes['codigo'],
				'nome' => ($representantes['nome']),
				'email' => ($representantes['email']),
				'telefone_celular' => ($representantes['telefone_celular']),
				'alterar' => "<button class='btn btn-warning btn-circle' title='Alterar representante'><i class='fas fa-exclamation-triangle'></i></button>",
				'excluir' => "<button class='btn btn-danger btn-circle' title='Excluir representante'><i class='fas fa-trash'></i></button>",
			];
		}
		
		if ($query->num_rows() > 0) {
			return $data;
		} else {
			return false;
		}
    }
}
