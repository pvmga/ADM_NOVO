<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// LOGIN
$route['default_controller'] = 'login';
$route['verificaLogin'] = 'login/verificaLogin';

// DASHBOARD
$route['dashboard'] = 'dashboard';
$route['buscarDadosDashboard'] = 'dashboard/buscarDadosDashboard';

// CHAMADO
$route['chamado_listagem'] = 'chamado';
$route['formulario_cadastro/(:any)'] = 'chamado/formulario_cadastro';
$route['listagemChamados'] = 'chamado/listagemChamados';
$route['uploadArquivos'] = 'chamado/uploadArquivos';
$route['salvarChamado'] = 'chamado/salvarChamado';
$route['buscarChamadoModal'] = 'chamado/buscarChamadoModal';
$route['enviarEmailChamado'] = 'chamado/enviarEmailChamado';

// EMPRESA
$route['listagem_empresa'] = 'empresa';
$route['listagemEmpresa'] = 'empresa/listagemEmpresa';
$route['formulario_cadastro_empresa/(:any)'] = 'empresa/formulario_cadastro_empresa';
$route['buscarEmpresaModal'] = 'empresa/buscarEmpresaModal';
$route['inserirEmpresa'] = 'empresa/inserirEmpresa';

// TECNICO
$route['listagem_tecnico'] = 'tecnico';
$route['listagemTecnico'] = 'tecnico/listagemTecnico';

// REPRESENTANTE
$route['listagem_representante'] = 'representante';
$route['listagemRepresentante'] = 'representante/listagemRepresentante';

// PRODUTO
$route['listagem_produto'] = 'produto';
$route['listagemProduto'] = 'produto/listagemProduto';
$route['formulario_cadastro_produto/(:any)'] = 'produto/formulario_cadastro_produto';
$route['buscarProduto'] = 'produto/buscarProduto';
$route['salvarProduto'] = 'produto/salvarProduto';

// COMPONENTE
$route['listagem_componente'] = 'componente';
$route['listagemComponente'] = 'componente/listagemComponente';
$route['formulario_cadastro_componente/(:any)'] = 'componente/formulario_cadastro_componente';
$route['buscarComponente'] = 'componente/buscarComponente';
$route['salvarComponente'] = 'componente/salvarComponente';

// MARKETING
$route['marketing'] = 'marketing';
$route['listagemMarketing'] = 'marketing/listagemMarketing';
$route['verificaEenviaEmail'] = 'marketing/verificaEenviaEmail';
$route['importarArquivos'] = 'marketing/importarArquivos';
$route['excluirMarketing'] = 'marketing/excluirMarketing';
$route['alterarStatus'] = 'marketing/alterarStatus';

// SAIR
$route['logout'] = 'login/logout';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
