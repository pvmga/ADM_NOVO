<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Produto_models extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function listaProduto($produto) {

        $sql = "select * from produto where descricao like '%{$produto}%'";

        $query = $this->db->query($sql);

        foreach ($query->result_array() as $produtos) {
            $alterarProdutos = base_url().'formulario_cadastro_produto/' . $produtos['codigo'];

            $data['data'][] = [
                'id' => $produtos['codigo'],
                'descricao' => ($produtos['descricao']),
                'ativo' => $produtos['ativo'],
                'alterar' => "<a href=". $alterarProdutos ." class='btn btn-warning btn-circle' title='Alterar produtos'><i class='fas fa-exclamation-triangle'></i></a>",
                'excluir' => "<button class='btn btn-danger btn-circle' title='Excluir produto'><i class='fas fa-trash'></i></button>",
            ];
        }

        if ($query->num_rows() > 0) {
            return $data;
        } else {
            return false;
        }
    }
    
    public function listaProdutoModels($produto) {

        $sql = "select * from produto where codigo = '{$produto}'";

        $query = $this->db->query($sql);

        foreach ($query->result_array() as $produtos) {

            $data['data'][] = [
                'id' => $produtos['codigo'],
                'descricao' => ($produtos['descricao']),
                'ativo' => $produtos['ativo']
            ];
        }

        if ($query->num_rows() > 0) {
            return $data;
        } else {
            return false;
        }
    }
    
    public function insertProdutoModels($dadosProduto) {
        $this->db->insert('produto', $dadosProduto);
        return $this->db->insert_id();
    }
    
    public function updateProdutoModels($dadosProduto, $cod_produto) {
        $this->db->where('codigo', $cod_produto);
        return $this->db->update('produto', $dadosProduto);
    }

}
