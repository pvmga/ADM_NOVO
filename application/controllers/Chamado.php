<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Chamado extends MY_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('codigo') == false)
            redirect('');
    }

    public function index() {
        $data['title'] = "ADM - Chamado listagem";

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('telas/view_chamado_listagem');
        $this->load->view('templates/modal');
        $this->load->view('templates/footer');
        $this->load->view('ajax/chamadosListagem');
    }

    public function formulario_cadastro() {
        $data['title'] = "ADM - Cadastro de chamados";

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('telas/view_chamado_cadastro');
        $this->load->view('templates/modal');
        $this->load->view('templates/footer');
        $this->load->view('ajax/chamadosCadastro');
    }

    public function listagemChamados() {
        $this->load->model('chamado_models');

        $criador_tarefa = $this->input->post('criador_tarefa');
        $data = $this->chamado_models->listaChamados($criador_tarefa);

        if ($data == NULL) {
            $data['data'] = array();
            $data['data'][] = [
                'codigo' => '',
                'nome_fantasia' => 'Não existe registros...',
                'assunto' => '',
//                'criador_tarefa' => '',
                'nome_tecnico' => '',
                'nome_produto' => '',
                'nome_componente' => '',
                'solicitante' => '',
                'nome_status' => '',
                "visualizar" => '',
                "alterar" => '',
            ];
        }

        echo json_encode($data);
    }

    public function uploadArquivos() {
        $files = $_FILES;

        if (count($files) > 0) {
            foreach ($files as $file) {
                $tamanhoArray = count($file['name']);
                $i = 0;

                for ($i; $i < $tamanhoArray; $i++) {
                    $info = new SplFileInfo($file['name'][$i]);

                    //gerar novo nome
                    $aleatorio = 0;
                    $aleatorio .= rand(0, 100);

                    $novoNome = $aleatorio . date('YmdHis') . '.' . $info->getExtension();

                    if (move_uploaded_file($file['tmp_name'][$i], 'files/' . $novoNome)) {
                        $imagens[] = array('nome_original' => $file['name'][$i], 'novo_nome' => $novoNome);
                        $imagensOriginais[] = $file['name'][$i];
                    }
                }
            }
        } else {
            $imagens = '';
        }

        echo json_encode($imagens);
    }

    public function salvarChamado() {
        $this->load->model('chamado_models');

        $dados = $this->input->post('dados');
        $arquivos = json_decode($dados['arquivos']);

        
        $tarefa = array(
            'cod_empresa' => $dados['cod_empresa'],
            'nome' => $dados['nome'],
            'cod_tecnico' => $dados['cod_tecnico'],
            'assunto' => ($dados['assunto']),
            'cod_produto' => $dados['cod_produto'],
            'cod_componente' => $dados['cod_componente'],
            'nome_status' => $dados['nome_status'],
            'prioridade' => $dados['prioridade'],
            'data_abertura' => date('Y-m-d H:i:s'),
            'data_fechamento' => ''
        );

//        echo json_encode($tarefa);
//        exit();

        // UPDATE OU INSERT DA TAREFA
        if ($dados['codigo_chamado'] == 0) {
            $cod_tarefa = $this->chamado_models->insertChamadoModels($tarefa);
            $user = array(
                'criador_tarefa' => $this->session->userdata('nome'),
            );
            $this->chamado_models->updateChamado($user, $cod_tarefa);
        } else {
            if ($tarefa['prioridade'] == 'Resolvido') {
                $tarefa['data_fechamento'] = date('Y-m-d H:i:s');
            }
            // UPDATE RETORNANDO O CÓDIGO DA TAREFA.
            $this->chamado_models->updateChamado($tarefa, $dados['codigo_chamado']);
        }

        $cod_tarefa = isset($cod_tarefa) ? $cod_tarefa : $dados['codigo_chamado'];
        $tarefa_men = array(
            'cod_tarefa' => $cod_tarefa,
            'mensagem' => nl2br($dados['mensagem']),
            'tecnico_alt' => $this->session->userdata('nome'),
            'status' => $dados['nome_status'],
            'data_registro' => date('Y-m-d H:i:s'),
            'arquivo' => isset($arquivos[0]) ? $arquivos[0]->novo_nome : '',
            'arquivo2' => isset($arquivos[1]) ? $arquivos[1]->novo_nome : '',
            'arquivo3' => isset($arquivos[2]) ? $arquivos[2]->novo_nome : '',
            'arquivo4' => isset($arquivos[3]) ? $arquivos[3]->novo_nome : '',
            'arquivo5' => isset($arquivos[4]) ? $arquivos[4]->novo_nome : '',
            'arquivo6' => isset($arquivos[5]) ? $arquivos[5]->novo_nome : '',
            'arquivo7' => isset($arquivos[6]) ? $arquivos[6]->novo_nome : '',
            'arquivo8' => isset($arquivos[7]) ? $arquivos[7]->novo_nome : '',
            'arquivo9' => isset($arquivos[8]) ? $arquivos[8]->novo_nome : '',
            'arquivo10' => isset($arquivos[9]) ? $arquivos[9]->novo_nome : '',
            'arquivo_original' => isset($arquivos[0]) ? $arquivos[0]->nome_original : '',
            'arquivo_original2' => isset($arquivos[1]) ? $arquivos[1]->nome_original : '',
            'arquivo_original3' => isset($arquivos[2]) ? $arquivos[2]->nome_original : '',
            'arquivo_original4' => isset($arquivos[3]) ? $arquivos[3]->nome_original : '',
            'arquivo_original5' => isset($arquivos[4]) ? $arquivos[4]->nome_original : '',
            'arquivo_original6' => isset($arquivos[5]) ? $arquivos[5]->nome_original : '',
            'arquivo_original7' => isset($arquivos[6]) ? $arquivos[6]->nome_original : '',
            'arquivo_original8' => isset($arquivos[7]) ? $arquivos[7]->nome_original : '',
            'arquivo_original9' => isset($arquivos[8]) ? $arquivos[8]->nome_original : '',
            'arquivo_original10' => isset($arquivos[9]) ? $arquivos[9]->nome_original : '',
        );

        $result = $this->chamado_models->insertChamadoMensagensModels($tarefa_men);

        echo json_encode($result);
    }
    
    public function enviarEmailChamado() {
        $cod_tarefa = $this->input->post('cod_tarefa');
        $result = $this->enviarEmail($cod_tarefa);
        echo json_encode($result);
    }

    public function buscarChamadoModal() {
        $this->load->model('chamado_models');

        $codigo = $this->input->post('codigo');
        $dadosChamado = $this->chamado_models->buscarChamado($codigo);

        echo json_encode($dadosChamado);
    }

}
