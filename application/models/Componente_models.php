<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Componente_models extends MY_Model {

    public function __construct() {
        parent::__construct();
    }

    public function listaComponente($codigo = null) {
        $where = '';
        if ($codigo != null) {
            $where = " where c.codigo = {$codigo}";
        }
        
        $sql = "select c.*, p.descricao as descricao_produto from componente c left join produto p on (p.codigo = c.cod_produto) $where";

        $query = $this->db->query($sql);

        foreach ($query->result_array() as $componente) {
            
            $alterarComponente = base_url().'formulario_cadastro_componente/' . $componente['codigo'];
            
            $data['data'][] = [
                'id' => $componente['codigo'],
                'descricao' => ($componente['descricao']),
                'cod_produto' => ($componente['cod_produto']),
                'descricao_produto' => ($componente['descricao_produto']),
                'ativo' => $componente['ativo'],
                'alterar' => "<a href=". $alterarComponente ." class='btn btn-warning btn-circle' title='Alterar componente'><i class='fas fa-exclamation-triangle'></i></a>",
                'excluir' => "<button class='btn btn-danger btn-circle' title='Excluir componente' onclick='excluirComponente(".$componente['codigo'].");'><i class='fas fa-trash'></i></button>",
            ];
        }

        if ($query->num_rows() > 0) {
            return $data;
        } else {
            return false;
        }
    }

    public function insertComponenteModels($dadosComponente) {
        $this->db->insert('componente', $dadosComponente);
        return $this->db->insert_id();
    }
    
    public function updateComponenteModels($dadosComponente, $cod_componente) {
        $this->db->where('codigo', $cod_componente);
        return $this->db->update('componente', $dadosComponente);
    }

}
