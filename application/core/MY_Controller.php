<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }
	
    public function uppercasebr($str) {
        return strtoupper(strtr($str, "áéíóúâêôãõàèìòùç", "ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
    }
	
    public function enviarEmail($codigo) {
        $this->load->model('chamado_models');
        $dadosChamado = $this->chamado_models->buscarChamado($codigo);

        /* ESTRUTURA PADRÃO */        
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'mail.ingasoft.com.br';
        $config['smtp_user'] = 'tarefasonline@ingasoft.com.br';
        $config['smtp_pass'] = '@db64902';
        $config['smtp_port'] = 587;
        $config['smtp_crypto'] = '';
        $config['smtp_timeout'] = '60';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE; // define se haverá quebra de palavra no texto
        $config['validate'] = TRUE; // define se haverá validação dos endereços de email

        $config['mailtype'] = 'html';
        
        // Inicializa a library Email, passando os parâmetros de configuração
        $this->load->library('email');
        $this->email->initialize($config);
        $email_tecnico = strtolower($dadosChamado[0]['email_tecnico']);
        $array_copias = array();
        if ($email_tecnico == 'suportegadm@ingasoft.com.br') {
            $array_copias = array('michel@ingasoft.com.br', 'paulo@ingasoft.com.br', 'suportelfp@ingasoft.com.br');
        } else if ($email_tecnico == 'michel@ingasoft.com.br') {
            $array_copias = array('suportegadm@ingasoft.com.br', 'paulo@ingasoft.com.br', 'suportelfp@ingasoft.com.br');
        } else if ($email_tecnico == 'paulo@ingasoft.com.br') {
            $array_copias = array('suportegadm@ingasoft.com.br', 'michel@ingasoft.com.br', 'suportelfp@ingasoft.com.br');
        } else if ($email_tecnico == 'suportelfp@ingasoft.com.br') {
            $array_copias = array('suportegadm@ingasoft.com.br', 'michel@ingasoft.com.br', 'paulo@ingasoft.com.br');
        } else {
            $array_copias = array('suportegadm@ingasoft.com.br', 'michel@ingasoft.com.br', 'paulo@ingasoft.com.br', 'suportelfp@ingasoft.com.br');
        }
        // Define remetente e destinatário
        $this->email->from('tarefasonline@ingasoft.com.br', 'Mensagem do Gerenciador Online'); // Remetente
        $this->email->to($email_tecnico); // Destinatário
        $this->email->cc($array_copias); // Cópia

        $this->load->model('chamado_models');

        $mensagemEmail = '';
        foreach ($dadosChamado as $tarefas) {
                $mensagemEmail .=''
                        . '<br />'
                        . '<b style="color: #1F497D; font-size: 14px;">' . $tarefas['tecnico_alt'] . ' - ' . (date('d/m/Y H:i', strtotime($tarefas['data_registro']))) . ' - ' . $tarefas['status'] . '</b>'
                        . '<br />'
                        . '<a href="' . base_url() . 'files/' . $tarefas['arquivo10'] . '" target="_blank">' . $tarefas['arquivo_original10'] . '<a/> '
                        . '<a href="' . base_url() . 'files/' . $tarefas['arquivo9'] . '" target="_blank">' . $tarefas['arquivo_original9'] . '<a/> '
                        . '<a href="' . base_url() . 'files/' . $tarefas['arquivo8'] . '" target="_blank">' . $tarefas['arquivo_original8'] . '<a/> '
                        . '<a href="' . base_url() . 'files/' . $tarefas['arquivo7'] . '" target="_blank">' . $tarefas['arquivo_original7'] . '<a/> '
                        . '<a href="' . base_url() . 'files/' . $tarefas['arquivo6'] . '" target="_blank">' . $tarefas['arquivo_original6'] . '<a/> '
                        . '<a href="' . base_url() . 'files/' . $tarefas['arquivo5'] . '" target="_blank">' . $tarefas['arquivo_original5'] . '<a/> '
                        . '<a href="' . base_url() . 'files/' . $tarefas['arquivo4'] . '" target="_blank">' . $tarefas['arquivo_original4'] . '<a/> '
                        . '<a href="' . base_url() . 'files/' . $tarefas['arquivo3'] . '" target="_blank">' . $tarefas['arquivo_original3'] . '<a/> '
                        . '<a href="' . base_url() . 'files/' . $tarefas['arquivo2'] . '" target="_blank">' . $tarefas['arquivo_original2'] . '<a/> '
                        . '<a href="' . base_url() . 'files/' . $tarefas['arquivo'] . '" target="_blank">' . $tarefas['arquivo_original'] . '<a/> '
                        . '<br /><span style="color: black; text-indent: 1.5em;">' . $tarefas['mensagem'] . '</span><br />';
        }
        
//        echo json_encode($mensagemEmail);
//        exit();

        // Define o assunto do email
        $this->email->subject('Tarefa #'.$codigo.' - '.(($dadosChamado[0]['assunto'])).' ( '.(($dadosChamado[0]['nome_tecnico'])).' )');
//        return var_dump("<html style='color: #1F497D; font-size: 14px; font-family: Verdana, Arial, sans-serif, Trebuchet MS; text-align: justify;'>
//                                                        <strong>Produto: </strong>".ucfirst(strtolower($dadosChamado[0]['nome_produto']))."<br/>
//                                                        <strong>Tarefa: </strong>".ucfirst(strtolower($dadosChamado[0]['codigo']))."<br/>
//                                                        <strong>Empresa: </strong>". utf8_encode(ucfirst(strtolower($dadosChamado[0]['nome_fantasia'])))."<br/>
//                                                        <strong>Telefone fixo: </strong>".ucfirst(strtolower($dadosChamado[0]['telefone_fixo']))."<br/>
//                                                        <strong>Solicitante: </strong>".ucfirst(strtolower($dadosChamado[0]['solicitante']))."<br/>
//                                                        <strong>Técnico de lançamento: </strong>".ucfirst(strtolower($dadosChamado[0]['criador_tarefa']))."<br/>
//                                                        <strong>Técnico responsável: </strong>".ucfirst(strtolower($dadosChamado[0]['nome_tecnico']))."<br/><br/>
//                                                        <fieldset>
//                                                                <legend><b>Comentários</b></legend>
//                                                                <tr>
//                                                                    <td>".$mensagemEmail."</td>
//                                                                </tr>
//                                                                <br/>
//                                                        </fieldset>
//                                                        </html>");
        $this->email->message("<html style='color: #1F497D; font-size: 14px; font-family: Verdana, Arial, sans-serif, Trebuchet MS; text-align: justify;'>
                                                        <strong>Produto: </strong>".(($dadosChamado[0]['nome_produto']))."<br/>
                                                        <strong>Tarefa: </strong>".(($dadosChamado[0]['codigo']))."<br/>
                                                        <strong>Empresa: </strong>". utf8_encode((($dadosChamado[0]['nome_fantasia'])))."<br/>
                                                        <strong>Telefone fixo: </strong>".(($dadosChamado[0]['telefone_fixo']))."<br/>
                                                        <strong>Solicitante: </strong>".(($dadosChamado[0]['solicitante']))."<br/>
                                                        <strong>Técnico de lançamento: </strong>".(($dadosChamado[0]['criador_tarefa']))."<br/>
                                                        <strong>Técnico responsável: </strong>".(($dadosChamado[0]['nome_tecnico']))."<br/><br/>
                                                        <fieldset>
                                                                <legend><b>Comentários</b></legend>
                                                                <tr>
                                                                    <td>".$mensagemEmail."</td>
                                                                </tr>
                                                                <br/>
                                                        </fieldset>
                                                        </html>");
        $this->email->attach(base_url()."files/".$dadosChamado[0]['arquivo']);
        $this->email->attach(base_url()."files/".$dadosChamado[0]['arquivo2']);
        $this->email->attach(base_url()."files/".$dadosChamado[0]['arquivo3']);
        $this->email->attach(base_url()."files/".$dadosChamado[0]['arquivo4']);
        $this->email->attach(base_url()."files/".$dadosChamado[0]['arquivo5']);
        $this->email->attach(base_url()."files/".$dadosChamado[0]['arquivo6']);
        $this->email->attach(base_url()."files/".$dadosChamado[0]['arquivo7']);
        $this->email->attach(base_url()."files/".$dadosChamado[0]['arquivo8']);
        $this->email->attach(base_url()."files/".$dadosChamado[0]['arquivo9']);
        $this->email->attach(base_url()."files/".$dadosChamado[0]['arquivo10']);
        
        if ($this->email->send()) {
            return '1';
        } else {
            return $this->email->send();
        }
    }

    public function enviarEmailMarketing($email) {
        /* ESTRUTURA PADRÃO */
        $this->load->library('email');

        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'mail.ingasoft.com.br';
        $config['smtp_user'] = 'comercial@ingasoft.com.br';
        $config['smtp_pass'] = 'sup05mailpa';
        $config['smtp_port'] = 587;
        $config['smtp_crypto'] = '';
        $config['smtp_timeout'] = '60';
        $config['charset'] = 'utf-8';
        $config['mailtype'] = 'html';
        $config['wordwrap'] = TRUE; // define se haverá quebra de palavra no texto
        $config['validate'] = TRUE; // define se haverá validação dos endereços de email

        // Inicializa a library Email, passando os parâmetros de configuração
        $this->email->initialize($config);

        // Define remetente e destinatário
        $this->email->from('comercial@ingasoft.com.br', 'Departamento Comercial'); // Remetente
        $this->email->to($email); // Destinatário
        $this->email->cc('comercial@ingasoft.com.br');

        // Define o assunto do email
        $this->email->subject('Sistema de Gestão Empresarial conheça o nosso produto');
        $link_site = "http://www.ingasoft.com.br";
//        amorimeng@yahoo.com.br

        $this->email->message("<html style='font-size: 14px; font-family: Verdana, Arial, sans-serif, Trebuchet MS; text-align: justify;'>
                                                            <p>Olá, tudo bem com você ? <br />
                                                            Espero que sim.</p>
                                                            <p style='color: #6c5ce7; font-size: 18px;'>Borá decolar o futuro da tua empresa ?</p>
                                                            <p>Meu nome é <b>Alexandre</b>, trabalho na <b>Ingasoft</b>, empresa que hoje trabalha com desenvolvimento de software de Gestão Empresarial <b>ERP</b>, situada em Maringá/PR.
                                                            Nossa software house oferece diversidades em sistemas, que temos <b>Nohall</b> para trabalhar com <b>excelência</b> e, além disto, temos um suporte de ponta.</p>
                                                            <p>Para saber mais visite o nosso site <a href='{$link_site}'>www.ingasoft.com.br</a> ou, <a href='https://ingasoft.com.br/download/carta-apresentacao.pdf'>clique neste link para acessar <b>nossa carta de apresentação</b> do nosso produto</a></p>
                                                            <p style='color: #6c5ce7; font-size: 18px;'>Vamos bater um papo ?</p>
                                                            <p>Sinta-se à vontade para ligar se tiver quaisquer dúvidas, ou, permita-me entrar em contato para explicar melhor. Meu numero é <b>(44) 3025-5690 |(44) 9 9854-3210</b> (Tim/WhatsApp).</p>
                                                            <p>Tenha um ótimo dia!</p>
                                                            </html>");

//        $this->email->send();
//
//        return $this->email->print_debugger();                                                            
        if (($email != 'paulo@ingasoft.com.br') && ($email != 'comercial@ingasoft.com.br') && ($email != 'financeiro@ingasoft.com.br')) {
            if ($this->email->send()) {
                return '1';
            } else {
                return '0';
            }
        
        }
    }
}
