
create database tarefas;
create table usuario 
(
	codigo integer auto_increment primary key, 
	usuario varchar(50), 
	senha varchar(50), 
	data_cadastro datetime
) ENGINE=InnoDB;

create table tecnico 
(
	codigo integer AUTO_INCREMENT PRIMARY KEY, 
	nome varchar(50), 
	email varchar(50), 
	data_cadastro datetime
) ENGINE=InnoDB;

create table empresa 
(
	codigo integer auto_increment primary key, 
	nome varchar(50), cnpj varchar(18), 
	inscricao varchar(16), 
	responsavel varchar(50), 
	email varchar(50), 
	telefone_celular varchar(15), 
	telefone_fixo varchar(15), 
	nome_fantasia varchar(50), 
	cidade varchar(40), 
	ativo char, 
	data_cadastro datetime
) ENGINE=InnoDB;

create table tarefa 
(
	codigo integer not null auto_increment primary key,
	cod_empresa integer,
	email varchar(50),
	nome varchar(50),
	cod_autor integer,
	cod_tecnico integer,
	telefone varchar(15),
	finalizado char,
	data_abertura datetime,
	data_previsao datetime,
	data_fechamento datetime,
	progresso integer,
	mensagem varchar(500)
) ENGINE=InnoDB;


create table parametro 
(
	codigo integer not null auto_increment primary key,
	versao varchar(10)
) ENGINE=InnoDB;

-- --INICIA VERS�O
insert into parametro (versao) values (1);

alter table tecnico add column ativo char;
alter table usuario add column ativo char;
-- --false = 0, true = 1
alter table empresa add column nfce boolean default false;
update parametro set versao = '2';
-- -------------------------------------/VERS�O 2

alter table tarefa drop column telefone;
alter table tarefa drop column email;
alter table tarefa add column assunto varchar(100);

alter table tarefa add constraint fk_tarefa_codautor foreign key (cod_autor) references tecnico(codigo);
alter table tarefa add constraint fk_tarefa_codtecnico foreign key (cod_tecnico) references tecnico(codigo);
alter table tarefa add constraint fk_tarefa_codmpresa foreign key (cod_empresa) references empresa(codigo);

update parametro set versao = '3';
-- -------------------------------------/VERS�O 3

-- alterar de myisam pra innodb
ALTER TABLE empresa
ENGINE = InnoDB;
ALTER TABLE tarefa
ENGINE = InnoDB;
ALTER TABLE tecnico
ENGINE = InnoDB;
ALTER TABLE usuario
ENGINE = InnoDB;
ALTER TABLE parametro
ENGINE = InnoDB;

-- alterar o collation
-- ALTER TABLE tecnico CONVERT TO CHARACTER SET latin1 COLLATE latin1_swedish_ci;
-- ALTER TABLE usuario CONVERT TO CHARACTER SET latin1 COLLATE latin1_swedish_ci;

alter table tarefa drop column progresso;

update parametro set versao = '4';
-- -------------------------------------/VERS�O 4

alter table tarefa add column cod_produto integer;
alter table tarefa add column cod_componente integer;

create table produto 
(
	codigo integer not null auto_increment primary key,
	descricao varchar(50) not null
)ENGINE=InnoDB ;

create table componente (
	codigo integer not null auto_increment primary key,
	descricao varchar(50) not null,
	cod_produto integer not null
)ENGINE=InnoDB ;

alter table tarefa add constraint fk_tarefa_codproduto foreign key (cod_produto) references produto(codigo);
alter table tarefa add constraint fk_tarefa_codcomponente foreign key (cod_componente) references componente(codigo);

update parametro set versao = '5';
-- -------------------------------------/VERS�O 5

alter table produto add column data_cadastro datetime;
alter table componente add column data_cadastro datetime;
alter table produto add column ativo char not null default 'N';
alter table componente add column ativo char not null default 'N';

alter table produto modify column ativo char not null ;
alter table componente modify column ativo char not null;

alter table componente add constraint fk_produto_codproduto foreign key (cod_produto) references produto(codigo);

alter table tarefa modify column data_abertura date;
alter table tarefa modify column data_previsao date;
alter table tarefa modify column data_fechamento date;

alter table produto modify column data_cadastro date;
alter table componente modify column data_cadastro date;
alter table empresa modify column data_cadastro date;
alter table usuario modify column data_cadastro date;
alter table tecnico modify column data_cadastro date;

update parametro set versao = '6';
-- -------------------------------------/VERS�O 6

alter table tarefa drop column data_previsao;
alter table tarefa DROP foreign key fk_tarefa_codautor;
alter table tarefa drop column cod_autor;

alter table tarefa add column nome_status varchar(20) not null;
alter table tarefa add column prioridade varchar(20) not null;

update parametro set versao = '7';
-- -------------------------------------/VERS�O 7

alter table tarefa add column arquivo varchar(100);

update parametro set versao = '8';
-- -------------------------------------/VERS�O 8

alter table tarefa drop finalizado;
update parametro set versao = '9';
-- -------------------------------------/VERS�O 9

create table tarefa_men 
(
	cod_tarefa integer, 
	mensagem varchar(500), 
	arquivo varchar(100)
) ENGINE=InnoDB ;

alter table tarefa_men add constraint fk_cod_tarefa foreign key (cod_tarefa) references tarefa(codigo);

ALTER TABLE tarefa DROP COLUMN arquivo;
ALTER TABLE tarefa DROP COLUMN mensagem;

update parametro set versao = '10';
-- -------------------------------------/VERS�O 10
ALTER TABLE parametro ADD COLUMN cad_cnpj_igual boolean default false;

update parametro set versao = '11';
-- -------------------------------------/VERS�O 11
ALTER TABLE usuario ADD COLUMN crud_cadastrar boolean default false;
ALTER TABLE usuario ADD COLUMN crud_alterar boolean default false;
ALTER TABLE usuario ADD COLUMN crud_excluir boolean default false;
ALTER TABLE usuario ADD COLUMN crud_listar boolean default false;

ALTER TABLE usuario ADD COLUMN tela_empresas boolean default false;
ALTER TABLE usuario ADD COLUMN tela_tecnicos boolean default false;
ALTER TABLE usuario ADD COLUMN tela_usuarios boolean default false;
ALTER TABLE usuario ADD COLUMN tela_produtos boolean default false;
ALTER TABLE usuario ADD COLUMN tela_componentes boolean default false;
ALTER TABLE usuario ADD COLUMN tela_tarefas boolean default false;
ALTER TABLE usuario ADD COLUMN tela_parametros boolean default false;
ALTER TABLE usuario ADD COLUMN tela_novidades boolean default false;

ALTER TABLE usuario ADD COLUMN rel_empresas boolean default false;
ALTER TABLE usuario ADD COLUMN rel_tecnicos boolean default false;
ALTER TABLE usuario ADD COLUMN rel_usuarios boolean default false;
ALTER TABLE usuario ADD COLUMN rel_produtos boolean default false;
ALTER TABLE usuario ADD COLUMN rel_componentes boolean default false;
ALTER TABLE usuario ADD COLUMN rel_tarefas boolean default false;


update parametro set versao = '12';
-- -------------------------------------/VERS�O 12
ALTER TABLE tarefa_men ADD COLUMN solucao VARCHAR(500);

update parametro set versao = '13';
-- -------------------------------------/VERS�O 13
ALTER TABLE tarefa_men MODIFY COLUMN mensagem text not null;
ALTER TABLE tarefa_men MODIFY COLUMN solucao text;

update parametro set versao = '14';
-- -------------------------------------/VERS�O 14
create table vendedor 
(
    codigo integer not null auto_increment primary key, 
    nome varchar(50) not null, 
    email varchar(50) not null, 
    ativo char not null,
    cod_empresa integer,
    data_cadastro date not null
) ENGINE=InnoDB ;

update parametro set versao = '15';
-- -------------------------------------/VERS�O 15

alter table vendedor drop column cod_empresa;
alter table vendedor add column cod_empresa integer;
ALTER TABLE vendedor ADD constraint fk_vendedor_codempresa foreign key (cod_empresa) references empresa(codigo);
ALTER TABLE usuario add column cod_tecnico integer;
alter table usuario add constraint fk_usuario_codtecnico foreign key (cod_tecnico) references tecnico(codigo);

update parametro set versao = '16';
-- -------------------------------------/VERS�O 16

alter table vendedor add column cidade varchar(40) not null;
alter table vendedor add column estado varchar(2) not null;
alter table tarefa add column criador_tarefa varchar(50) not null;

update parametro set versao = '17';
-- -------------------------------------/VERS�O 17

alter table vendedor add column telefone_celular varchar(15);
/*
create table cad_nbmi
(
    codigo integer auto_increment primary key, 
    ncm varchar(50), 
    data_inicio date,
    data_fim date,
    estado varchar(2)
) ENGINE=InnoDB ;
*/
alter table tarefa_men add column data_registro date;
alter table tarefa_men add column tecnico_alt varchar(50);
alter table tarefa_men add column codigo integer AUTO_INCREMENT PRIMARY KEY;

update parametro set versao = '18';
-- -------------------------------------/VERS�O 18

alter table vendedor add column telefone_celular_secundario varchar(15);
alter table vendedor add column email_secundario varchar(50);
alter table tarefa drop column data_abertura;

UPDATE tarefa_men
JOIN usuario on (usuario.usuario = tarefa_men.tecnico_alt)
JOIN tecnico on (usuario.cod_tecnico = tecnico.codigo)
SET tarefa_men.tecnico_alt = tecnico.nome;

update parametro set versao = '19';
-- -------------------------------------/VERS�O 19

UPDATE tarefa
JOIN usuario on (usuario.usuario = tarefa.criador_tarefa)
JOIN tecnico on (usuario.cod_tecnico = tecnico.codigo)
SET tarefa.criador_tarefa = tecnico.nome;

alter table tarefa_men modify column data_registro datetime;
alter table tarefa modify column data_fechamento datetime;

update parametro set versao = '20';
-- -------------------------------------/VERS�O 20

alter table usuario add column tela_representantes boolean default false;
update usuario set 
usuario.tela_empresas = 1,
usuario.tela_tecnicos = 1,
usuario.tela_usuarios = 1,
usuario.tela_produtos = 1,
usuario.tela_componentes = 1,
usuario.tela_tarefas = 1,
usuario.tela_parametros = 1,
usuario.tela_novidades = 1,
usuario.tela_representantes = 1;

update parametro set versao = '21';
-- -------------------------------------/VERS�O 21

alter table tarefa_men add column arquivo2 varchar(100);
alter table tarefa_men add column arquivo3 varchar(100);
alter table tarefa_men add column arquivo4 varchar(100);
alter table tarefa_men add column arquivo5 varchar(100);
alter table tarefa_men add column arquivo6 varchar(100);
alter table tarefa_men add column arquivo7 varchar(100);
alter table tarefa_men add column arquivo8 varchar(100);
alter table tarefa_men add column arquivo9 varchar(100);
alter table tarefa_men add column arquivo10 varchar(100);

update parametro set versao = '22';
-- -------------------------------------/VERS�O 22

alter table tarefa_men add column status varchar(20);

update parametro set versao = '23';
-- -------------------------------------/VERS�O 23

ALTER TABLE tarefa ADD COLUMN data_abertura datetime;
update tarefa set data_abertura = '20170601';

update parametro set versao = '24';
-- -------------------------------------/VERS�O 24

create table logs
(
    codigo integer not null AUTO_INCREMENT PRIMARY KEY, 
    data datetime not null, 
    ip varchar(20) not null, 
    usuario varchar(50) not null,
    query text not null,
    mensagem varchar(50) not null
) ENGINE=InnoDB ;

update parametro set versao = '25';
-- -------------------------------------/VERS�O 25

ALTER TABLE componente
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci;
ALTER TABLE empresa
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci;
ALTER TABLE logs
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci;
ALTER TABLE parametro
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci;
ALTER TABLE produto
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci;
ALTER TABLE tarefa
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci;
ALTER TABLE tarefa_men
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci;
ALTER TABLE tecnico
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci;
ALTER TABLE usuario
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci;
ALTER TABLE vendedor
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE cad_nbmi
(
    codigo integer auto_increment primary key, 
    ncm varchar(50), 
    data_inicio date,
    data_fim date,
    estado varchar(2)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE cad_nbmi
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE parametro MODIFY versao integer not null;

ALTER TABLE `parametro`
MODIFY COLUMN `cad_cnpj_igual`  tinyint(1) NOT NULL DEFAULT 0 AFTER `versao`;

UPDATE parametro SET versao = 26;
-- -------------------------------------/VERS�O 26
/*
CREATE TABLE `imagens` (
`codigo`  integer NOT NULL AUTO_INCREMENT ,
`cod_tarefa_men`  integer NOT NULL ,
`arquivo`  varchar(100) NOT NULL
);

ALTER TABLE `tarefas`.`tarefa_men` ADD INDEX (`cod_tarefa`);

ALTER TABLE `imagens`
ADD CONSTRAINT `ref_codTarefa_men` FOREIGN KEY (`cod_tarefa_men`) REFERENCES `tarefa_men` (`cod_tarefa`) ON DELETE CASCADE ON UPDATE RESTRICT;

alter table imagens add column arquivo_original varchar(100) not null;

INSERT INTO imagens (cod_tarefa_men, arquivo)
SELECT cod_tarefa, arquivo10 FROM TAREFA_MEN
*/

alter table tarefa_men add column
(
    arquivo_original varchar(100),
    arquivo_original2 varchar(100),
    arquivo_original3 varchar(100),
    arquivo_original4 varchar(100),
    arquivo_original5 varchar(100),
    arquivo_original6 varchar(100),
    arquivo_original7 varchar(100),
    arquivo_original8 varchar(100),
    arquivo_original9 varchar(100),
    arquivo_original10 varchar(100)
);

update tarefa_men set 
arquivo_original = arquivo,
arquivo_original2 = arquivo2,
arquivo_original3 = arquivo3,
arquivo_original4 = arquivo4,
arquivo_original5 = arquivo5,
arquivo_original6 = arquivo6,
arquivo_original7 = arquivo7,
arquivo_original8 = arquivo8,
arquivo_original9 = arquivo9,
arquivo_original10 = arquivo10;

UPDATE parametro SET versao = 27;

-- -------------------------------------/VERS�O 27

CREATE TABLE `novidade` (
`codigo`  integer NOT NULL AUTO_INCREMENT ,
`descricao`  text NOT NULL ,
`versao`  varchar(30) NOT NULL ,
`cod_tecnico`  integer NOT NULL ,
PRIMARY KEY (`codigo`),
CONSTRAINT `ref_cod_tecnico_cadastro` FOREIGN KEY (`cod_tecnico`) REFERENCES `tecnico` (`codigo`) ON DELETE RESTRICT ON UPDATE RESTRICT
)
ENGINE=InnoDB
;

ALTER TABLE `novidade`
ADD COLUMN `data_cadastro`  datetime NULL AFTER `cod_tecnico`;

UPDATE parametro SET versao = 28;
-- -------------------------------------/VERS�O 28

ALTER TABLE `novidade`
ADD COLUMN `cod_tecnico_alteracao`  int(11) NOT NULL AFTER `data_cadastro`;

ALTER TABLE `novidade`
ADD CONSTRAINT `ref_cod_tecnico_alteracao` FOREIGN KEY (`cod_tecnico_alteracao`) REFERENCES `tecnico` (`codigo`) ON DELETE RESTRICT ON UPDATE RESTRICT;

UPDATE parametro SET versao = 29;
-- -------------------------------------/VERS�O 29

CREATE TABLE `novidade_men` (
`codigo`  integer NOT NULL AUTO_INCREMENT ,
`descricao`  text NOT NULL ,
`data_cadastro`  datetime NOT NULL ,
`cod_tecnico_alteracao`  integer NOT NULL ,
PRIMARY KEY (`codigo`),
CONSTRAINT `cod_ref_tecnico_alteracao` FOREIGN KEY (`cod_tecnico_alteracao`) REFERENCES `tecnico` (`codigo`) ON DELETE RESTRICT ON UPDATE RESTRICT
)
;

ALTER TABLE `novidade_men`
MODIFY COLUMN `codigo`  integer NOT NULL AUTO_INCREMENT FIRST ,
MODIFY COLUMN `cod_tecnico_alteracao`  integer NOT NULL AFTER `data_cadastro`,
ADD COLUMN `cod_novidade`  integer NULL AFTER `cod_tecnico_alteracao`,
ADD CONSTRAINT `cod_ref_novidade` FOREIGN KEY (`cod_novidade`) REFERENCES `novidade` (`codigo`) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE `novidade`
DROP FOREIGN KEY `ref_cod_tecnico_cadastro`;

ALTER TABLE `novidade`
DROP COLUMN `cod_tecnico_alteracao`;


/*CUIDADO NA HORA DE RODAR ESSE COMANDO, IRÁ EXCLUIR TUDO JÁ GRAVADO. O CORRETO É FAZER UM INSERT INTO ANTES.*/
ALTER TABLE `novidade`
DROP COLUMN `descricao`,
MODIFY COLUMN `versao`  varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL AFTER `codigo`;

ALTER TABLE `novidade`
ADD CONSTRAINT `ref_cod_tecnico_insercao` FOREIGN KEY (`cod_tecnico`) REFERENCES `tecnico` (`codigo`) ON DELETE RESTRICT ON UPDATE RESTRICT;


UPDATE parametro SET versao = 30;
-- -------------------------------------/VERS�O 30

alter table empresa add column conexao char(1) default 'N';
UPDATE parametro SET versao = 31;
-- -------------------------------------/VERS�O 31

alter table empresa add column motivo varchar(50);
update parametro set versao = '32';
-- -------------------------------------/VERS�O 32

alter table empresa add column contato char default 'N';
update parametro set versao = '33';
-- -------------------------------------/VERS�O 33