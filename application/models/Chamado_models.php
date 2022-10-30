<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Chamado_models extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function listaChamados($criador_tarefa) {
        $where = ($criador_tarefa !== 'TODOS') ? " where t.criador_tarefa = '{$criador_tarefa}'" : '';

        $sql = "select 
                    t.codigo,
                    t.data_abertura,
                    t.data_fechamento,
                    t.assunto,
                    t.nome_status,
                    t.criador_tarefa,
                    t.nome as solicitante,
                    t.cod_tecnico,
                    te.nome as nome_tecnico,
                    p.descricao as nome_produto,
                    e.nome_fantasia,
                    e.nome as razao_social,
                    e.telefone_fixo,
                    e.telefone_celular,
                    e.email,
                    c.descricao as nome_componente
            from tarefa t
            join empresa e on(t.cod_empresa = e.codigo)
            join tecnico te on(t.cod_tecnico = te.codigo)
            join produto p on(t.cod_produto = p.codigo)
            join componente c on(t.cod_componente = c.codigo)
            $where";

        $query = $this->db->query($sql);


        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $tarefa) {

                $style = "";
                if ($tarefa['nome_status'] == 'Aguardando') {
                    $style = "style='background-color: rgb(180, 132, 8); color: white; padding: 5px;'";
                } else if ($tarefa['nome_status'] == 'Confirmado') {
                    $style = "style='background-color: #1cc88a; color: white; padding: 5px;'";
                } else if ($tarefa['nome_status'] == 'Atualizar') {
                    $style = "style='background-color: #e74a3b; color: white; padding: 5px;'";
                } else if ($tarefa['nome_status'] == 'Finalizado') {
                    $style = "style='background-color: #4e73df; color: white; padding: 5px;'";
                } else if ($tarefa['nome_status'] == 'Resolvido') {
                    $style = "style='background-color: #36b9cc; color: white; padding: 5px;'";
                }

                $visualizarChamado = 'visualizarChamado(' . $tarefa['codigo'] . ')';
                $alterarChamado = base_url().'formulario_cadastro/' . $tarefa['codigo'];

                $data['data'][] = [
                    'codigo' => $tarefa['codigo'],
    //				'nome_fantasia' => $this->formatCollate($tarefa['nome_fantasia']),
                    'nome_fantasia' => $tarefa['nome_fantasia'],
                    'razao_social' => $tarefa['razao_social'],
                    'assunto' => $tarefa['assunto'],
                    'criador_tarefa' => $tarefa['criador_tarefa'],
                    'nome_tecnico' => $tarefa['nome_tecnico'],
                    'nome_produto' => $tarefa['nome_produto'],
                    'nome_componente' => $tarefa['nome_componente'],
                    'solicitante' => $tarefa['solicitante'],
                    'nome_status' => "<span $style >" . $tarefa['nome_status'] . "</span>",
                    'visualizar' => "<button class='btn btn-info btn-circle' title='Visualizar tarefa' onclick=" . $visualizarChamado . "><i class='fas fa-info-circle'></i></button>",
                    'alterar' => "<a href=". $alterarChamado ." class='btn btn-warning btn-circle' title='Alterar tarefa'><i class='fas fa-exclamation-triangle'></i></a>",
                ];
            }
            return $data;
        } else {
            return false;
        }
    }

    public function formatCollate($vlr) {
        return iconv('UTF-8', 'Windows-1252', mb_strtoupper($vlr));
    }

    public function buscarChamado($codigo) {
        $query = "select
                tm.*,
                t.codigo,
                t.data_abertura,
                t.data_fechamento,
                t.assunto,
                t.nome_status,
                t.criador_tarefa,
                t.cod_tecnico,
                t.prioridade,
                t.cod_produto,
                t.cod_componente,
                t.nome as solicitante,
                te.nome as nome_tecnico,
                te.email as email_tecnico,
                p.descricao as nome_produto,
                t.cod_empresa,
                e.nome_fantasia,
                e.nome as razao_social,
                e.telefone_fixo,
                e.telefone_celular,
                e.email,
                c.descricao as nome_componente
            from tarefa t
            left join tarefa_men tm on(t.codigo = tm.cod_tarefa)
            join empresa e on(t.cod_empresa = e.codigo)
            join tecnico te on(t.cod_tecnico = te.codigo)
            join produto p on(t.cod_produto = p.codigo)
            join componente c on(t.cod_componente = c.codigo)
            where t.codigo = {$codigo}
            order by tm.codigo desc";

        $query = $this->db->query($query);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function insertChamadoModels($tarefa) {
        $this->db->insert('tarefa', $tarefa);
        return $this->db->insert_id();
    }

    public function insertChamadoMensagensModels($tarefa_men) {

        $this->db->insert('tarefa_men', $tarefa_men);
        return $tarefa_men['cod_tarefa'];
    }
    
    public function updateChamado($dados, $cod_chamado) {
        $this->db->where('codigo', $cod_chamado);
        $query = $this->db->update('tarefa', $dados);
        return $query;
    }
    
    public function getCardDash($tipo) {
        $query = "select
                    count(t.codigo) quantidade
                from tarefa t
                where t.nome_status = ?";

        $query = $this->db->query($query, $tipo);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

}
