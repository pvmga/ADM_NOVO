<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Marketing extends MY_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('codigo') == false)
            redirect('');
    }

    public function index() {
        $data['title'] = "ADM - E-mail Marketing";

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('telas/view_email_marketing');
        $this->load->view('templates/footer');
        $this->load->view('ajax/emailMarketing');
    }

    public function listagemMarketing() {
        $this->load->model('marketing_models');
        
        $tipoConsulta = $this->input->post('tipoConsulta');

        $data = $this->marketing_models->listaMarketing('S', 0, $tipoConsulta);

        echo json_encode($data);
    }

    public function verificaEenviaEmail() {
        $this->load->model('marketing_models');
        $enviado = 'N';
        $codigo = $this->input->post('codigo');
        $msg = '';
        $nome = '';
        $email = '';
        $retorno = '';

        $data = $this->marketing_models->listaMarketing($enviado, $codigo);

        if ($data['data'][0]['codigo'] > 0) {

            $email = trim($data['data'][0]['email']);
            $nome = $data['data'][0]['nome'];

            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $retorno = $this->enviarEmailMarketing($email);
//                echo json_encode($retorno);
//                exit();
                if ($retorno == '1') {
                    $msg = 'ENVIADO COM SUCESSO.';
                } else {
                    $msg = 'NAO FOI ENVIADO E-MAIL. CONFERIR O E-MAIL DO CLIENTE OU AS CONFIGURAÇÕES DE SAÍDA.';
                }
            } else {
                $msg = 'E-MAIL DO CLIENTE ESTÁ INCORRETO';
            }
            $update = $this->marketing_models->updateMarketing($data['data'][0]['codigo'], $msg);
        } else {
            $update = 'NAO EXISTE REGISTROS A SER ENVIADO.';
        }
        echo json_encode(array('update' => $update, 'msg' => $msg, 'nome' => $nome, 'e-mail' => $email));
    }

    public function importarArquivos() {
        set_time_limit(0);
        $this->load->model('marketing_models');
        $files = $_FILES;

        $this->marketing_models->excluirMarketingModels('');

        if (!empty($files['file']['tmp_name'])) {
            $this->load->library('PHPExcel');

            $objReader = new PHPExcel_Reader_Excel5();
            $objReader->setReadDataOnly(true);
            $objPHPExcel = $objReader->load($files['file']['tmp_name']);

            // pegar total de colunas
            $colunas = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
            $total_colunas = PHPExcel_Cell::columnIndexFromString($colunas);

            //pegar total de linhas
            $total_linhas = $colunas = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

            for ($linha = 2; $linha <= $total_linhas; $linha++) {
                /* $dados = array(
                  'nome' => ($objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, $linha)->getValue()),
                  //'email' => ($objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1, $linha)->getValue()),
                  //'cidade' => ($objPHPExcel->getActiveSheet()->getCellByColumnAndRow(2, $linha)->getValue()),
                  //'telefone_fixo' => ($objPHPExcel->getActiveSheet()->getCellByColumnAndRow(3, $linha)->getValue()),
                  ); */
                $nome = trim(str_replace("'", '', $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, $linha)->getValue()));
                $email = trim(str_replace("'", '', $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1, $linha)->getValue()));
                $cidade = trim(str_replace("'", '', $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(2, $linha)->getValue()));
                $telefone_fixo = str_replace("'", '', $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(3, $linha)->getValue());
                $produto = ($objPHPExcel->getActiveSheet()->getCellByColumnAndRow(4, $linha)->getValue());
                $produto = ($produto == '') ? 'ingasoft' : $produto;

                //$dados2[] = $dados;
//                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $this->marketing_models->insertMarketing($nome, $email, $cidade, $telefone_fixo, $produto);   
//                }
            }

            //$this->marketing_models->insertMarketing($dados2);

            echo json_encode($linha);
            //echo json_encode($dados);
        }
    }

    public function excluirMarketing() {
        $this->load->model('marketing_models');
        $codigoMarketing = $this->input->post('codigoMarketing');
        $result = $this->marketing_models->excluirMarketingModels($codigoMarketing);

        echo json_encode($result);
    }

    public function alterarStatus() {
        $this->load->model('marketing_models');
        $codigoMarketing = $this->input->post('codigoMarketing');
        $status = $this->input->post('status');
        $result = $this->marketing_models->alterarStatusModels($codigoMarketing, $status);

        echo json_encode($result);
    }

}
