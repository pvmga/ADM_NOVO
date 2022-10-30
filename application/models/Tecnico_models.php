<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tecnico_models extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function listaTecnico($tecnico) {
        
        $where = '';
        if ($tecnico != '') {
            $where = "where nome like '%$tecnico%'";
        }
        $sql = "select * from tecnico $where";

        $query = $this->db->query($sql);

        foreach ($query->result_array() as $tecnicos) {

            $data['data'][] = [
                'id' => $tecnicos['codigo'],
                'nome' => ($tecnicos['nome']),
                'email' => ($tecnicos['email']),
                'alterar' => "<button class='btn btn-warning btn-circle' title='Alterar técnico'><i class='fas fa-exclamation-triangle'></i></button>",
                'excluir' => "<button class='btn btn-danger btn-circle' title='Excluir técnico'><i class='fas fa-trash'></i></button>",
            ];
        }

        if ($query->num_rows() > 0) {
            return $data;
        } else {
            return false;
        }
    }

}
