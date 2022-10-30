<?php
require_once('./lib/nusoap.php');

//$wsdl = 'http://localhost/projetos/WS_MAQVELL/service.php?wsdl';
$wsdl = 'http://maqvell.ddns.net/webservice/service.php?wsdl';

$client = new nusoap_client($wsdl, true);

$err = $client->getError();

if ($err){
    echo "Erro no construtor<pre>".$err."</pre>";
}

//OBRIGATÓRIO SER ENVIADO
$senha = 'e9e5c81693a07fb7ce2772ccd491f058';

//LISTA TODOS OS PRODUTOS
//$produtos = $client->call("getProdutos", array($senha));
//TRUE RETORNA UM ARRAY ASSOCIATIVO
//$produtosJSON = json_decode($produtos, true);

//RETORNA UM PRODUTO BUSCADO ESPECIFICAMENTE
//array(SENHA, CODIGO_DO_PRODUTO)
//$produto = $client->call("getProduto", array($senha, 2));
//$produtoJSON = json_decode($produto, true);

//RETORNA SOMENTE PRODUTOS QUE TIVERAM ALTERAÇÃO NO CADASTRO OU MOVIMENTAÇÃO DE ESTOQUE.
//$data_alteracao = '20170802 17:20:00';
//array(SENHA, DATA_ULTIMA_ALTERACAO, DATA_ULTIMA_SAIDA, DATA_INCLUSAO)
//$produtosAlterados = $client->call("getProdutosAlterados", array($senha, $data_alteracao));
//$produtosAlteradosJSON = json_decode($produtosAlterados, true);

//$clientes = $client->call("getClientes", array($senha));
//$clienteJSON = json_decode($clientes, true);

//$tecnicos = $client->call("getTecnicos", array($senha));
//$tecnicosJSON = json_decode($tecnicos, true);

$maquinas = $client->call("getMaquinasEquipamentos", array($senha));
$maquinasJSON = json_decode($maquinas, true);

if ($client->fault){
    //echo "Falha<pre>".print_r($produtosJSON)."</pre>";
    //echo "Falha<pre>".print_r($produtoJSON)."</pre>";
    //echo "Falha<pre>".print_r($produtosAlteradoJSON)."</pre>";
    //echo "Falha<pre>".print_r($clienteJSON)."</pre>";
    //echo "Falha<pre>".print_r($tecnicosJSON)."</pre>";
    echo "Falha<pre>".print_r($maquinasJSON)."</pre>";
}else{
    $err = $client->getError();
    if ($err){
        echo "Erro<pre>".$err."</pre>";
    } else{
        echo "<pre>";
        //print_r($produtosJSON);
        //print_r($produtoJSON);
        //print_r($produtosAlteradosJSON);
        //print_r($clienteJSON);
        //print_r($tecnicosJSON);
        print_r($maquinasJSON);
        echo "</pre>";
    }
}
