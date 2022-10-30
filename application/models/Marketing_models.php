<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Marketing_models extends CI_Model {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('America/Sao_Paulo');
    }

    public function listaMarketing($enviado = 'S', $codigo = 0, $tipoConsulta = 'N') {
        if ($codigo > 0) {
            $sql = "select * from email_marketing where codigo = " . $codigo;
        } else {
            if ($enviado == 'N') {
                $sql = "select * from email_marketing where produto = 'ingasoft' and enviado = '{$enviado}' limit 1";
            } else {
                $sql = "select * from email_marketing where produto = 'ingasoft' and contato = '{$tipoConsulta}'";
            }
        }

        $query = $this->db->query($sql);

        foreach ($query->result_array() as $tecnicos) {
            $codigo = $tecnicos['codigo'];
            if ($tecnicos['contato'] == 'N') {
                $novo_status = 1;
                $status = 'N';
                $btn = 'warning';
            } else {
                $novo_status = 0;
                $status = 'S';
                $btn = 'info';
            }
            $data['data'][] = [
                'codigo' => $tecnicos['codigo'],
                'nome' => ($tecnicos['nome']),
                'cidade' => ($tecnicos['cidade']),
                'telefone_fixo' => ($tecnicos['telefone_fixo']),
                'email' => ($tecnicos['email']),
                'enviado' => ($tecnicos['data_envio']),
                'observacao_envio' => ($tecnicos['observacao_envio']),
                'contato' => '<button class="btn btn-'.$btn.' btn-circle" title="Alterar status e-mail marketing" style="height: 2.0rem; width: 2.0rem;" onclick="alterarStatus(' . $novo_status . ','.$codigo.');">'.$status.'</button>',
                'excluir' => '<button class="btn btn-primary btn-circle" title="Reenviar e-mail marketing" style="height: 2.0rem; width: 2.0rem; margin-right: 5px;" onclick="CheckForSession(' . $codigo . ');"><i class="fas fa-arrow-right"></i></button><button class="btn btn-danger btn-circle" title="Excluir e-mail marketing" style="height: 2.0rem; width: 2.0rem;" onclick="excluirMarketing(' . $codigo . ');"><i class="fas fa-trash"></i></button>',
            ];
        }

        if ($query->num_rows() > 0) {
            return $data;
        } else {
            return false;
        }
    }

    public function updateMarketing($codigo, $obs) {
        $data = date('Y-m-d H:i:s');
        $sql = "update email_marketing set enviado = 'S', data_envio = '" . $data . "', observacao_envio = '" . $obs . "' where codigo = " . $codigo;

        $query = $this->db->query($sql);

        return true;
    }

    public function insertMarketing($nome, $email, $cidade, $telefone_fixo, $produto) {
        //return $this->db->insert('email_telemarketing', $dados);

        $query = $this->db->query("INSERT INTO email_marketing (nome, email, cidade, telefone_fixo, produto) values ('{$nome}', '{$email}', '{$cidade}', '{$telefone_fixo}', '{$produto}')");

        return true;
    }

    public function excluirMarketingModels($codigo) {
        
        $where = "";
        if ($codigo != '') {
            $where = " WHERE codigo = {$codigo}";
        }
        $query = $this->db->query("DELETE FROM email_marketing {$where}");

        return true;
    }

    public function alterarStatusModels($codigo, $status) {
        if ($status == 0) {
            $status = 'N';
        } else {
            $status = 'S';
        }
        $query = $this->db->query("UPDATE email_marketing set contato = '{$status}' WHERE codigo = {$codigo}");

        return true;
    }

}
