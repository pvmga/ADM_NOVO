<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Empresa_models extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function listaEmpresa($empresa) {

        //$where = ($usuario !== 'TODOS') ? "where ( t.criador_tarefa = '{$usuario}' or te.nome = '{$usuario}' )" : '';

        $sql = "select * from empresa where ativo = 'S' and (nome like '%$empresa%' or nome_fantasia like '%$empresa%' or codigo like '{$empresa}')";

        $query = $this->db->query($sql);

        foreach ($query->result_array() as $empresas) {
            
            $alterarEmpresa = base_url().'formulario_cadastro_empresa/' . $empresas['codigo'];

            $nfce = 'NÃO';
            if ($empresas['nfce'] == '1') {
                $nfce = 'SIM';
            }
            
            $contato = 'NÃO';
            if ($empresas['contato'] == 'S') {
                $contato = 'SIM';
            }
                
            $data['data'][] = [
                'id' => $empresas['codigo'],
                'razao_social' => ($empresas['nome']),
                'nome_fantasia' => ($empresas['nome_fantasia']),
                'nfce' => $empresas['nfce'],
                'nfce_listagem' => $nfce,
                'cte' => $empresas['cte'],
                'mdfe' => $empresas['mdfe'],
                'ativo' => $empresas['ativo'],
                'cnpj' => $empresas['cnpj'],
                'inscricao' => $empresas['inscricao'],
                'responsavel' => ($empresas['responsavel']),
                'email' => $empresas['email'],
                'cidade' => $empresas['cidade'],
                'telefone_celular' => ($empresas['telefone_celular']),
                'telefone_fixo' => ($empresas['telefone_fixo']),
                'motivo' => ($empresas['motivo']),
                'contato' => $empresas['contato'],
                'contato_listagem' => $contato,
//                'alterar' => "<button class='btn btn-warning btn-circle' title='Alterar empresa'><i class='fas fa-exclamation-triangle'></i></button>",
                'alterar' => "<a href=". $alterarEmpresa ." class='btn btn-warning btn-circle' title='Alterar empresa' ><i class='fas fa-exclamation-triangle'></i></a>",
                'excluir' => "<button class='btn btn-danger btn-circle' title='Excluir empresa'><i class='fas fa-trash'></i></button>",
            ];
        }

        if ($query->num_rows() > 0) {
            return $data;
        } else {
            return false;
        }
    }
    
    public function updateEmpresa($dados) {
        $this->db->where('codigo', $dados['codigo']);
        $query = $this->db->update('empresa', $dados);
        return $query;
    }

    public function inserirEmpresa($dados) {
        $query = $this->db->insert('empresa', $dados);
        return $query;
    }

}
