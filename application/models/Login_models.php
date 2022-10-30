<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login_models extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function listaUsuarios($user = null, $pass = null) {

        $where = "where u.usuario = '{$user}' and u.senha = '{$pass}'";

        if ($user = null && $pass = null) {
            $where = '';
        }

        $sql = "SELECT t.nome, u.*  
			FROM usuario u
			JOIN tecnico t on(u.cod_tecnico = t.codigo)
			$where";

        $query = $this->db->query($sql);

        return $query->result_array();
    }

}
