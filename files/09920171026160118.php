<?php
require_once('./lib/nusoap.php');

$wsdl = 'http://localhost/projetos/WS_MAQVELL/service.php?wsdl';
//$wsdl = 'http://maqvell.ddns.net/webservice/service.php?wsdl';
$client = new nusoap_client($wsdl, true);

$err = $client->getError();

if ($err){
    echo "Erro no construtor<pre>".$err."</pre>";
}
$senha = 'e9e5c81693a07fb7ce2772ccd491f058';

// --------------------- VENDA --------------------- //
$venda = array();
$dados = array(
    /*Dados venda*/
    'senha' => $senha,
    'codPagamento' =>  1, //cond de pagamento
    'tipoPagto' => 'DDE', //tipo de pagamento
    'dataVenda' => '20170823', //data venda
    'valorPago' => 100, //valor pago
    'pedidoEcm' => 4, //pedido original
    'codCliente' => 2
);

$setVenda = $client->call("setVenda", $dados);
$vendaJSON = json_decode($setVenda, true);

$arrayItens = array();
$itens1 = array(
    'senha' => $senha,
    'codProd' => 53503,
    'unidade' => 'UN',
    'quantidade' => 1,
    'valorUnitario' => 50,
    'pedidoEcm' => 4 // referencia do pedido
);
$itens2 = array(
    'senha' => $senha,
    'codProd' => 53504,
    'unidade' => 'UN',
    'quantidade' => 1,
    'valorUnitario' => 50,
    'pedidoEcm' => 4 // referencia do pedido
);

/*Nesse caso, os itens seria um retorno do seu banco de dados que já voltaria dentro de um array*/
array_push($arrayItens, $itens1);
array_push($arrayItens, $itens2);

/*chama método e passa para o webservice*/
/* Não pode repetir os itens.*/
foreach ($arrayItens as $itens) {
    $setVendaItens = $client->call("setVendaItens", $itens);
    $vendaItensJSON = json_decode($setVendaItens, true);
    echo '<br />';
    print_r($vendaItensJSON);
    echo "</pre>";
}

// --------------------- /VENDA --------------------- //

if ($client->fault){
    echo "Falha<pre>".print_r($vendaJSON)."</pre>";
    echo "Falha<pre>".print_r($vendaItensJSON)."</pre>";
}else{
    $err = $client->getError();
    if ($err){
        echo "Erro<pre>".$err."</pre>";
    } else{
        echo "<pre>";
        print_r($vendaJSON);
        echo "</pre>";
    }
}
