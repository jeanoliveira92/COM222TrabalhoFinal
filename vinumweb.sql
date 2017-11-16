create database vinumweb;

use viniumweb;

create table vinho
(
	id int unique not null AUTO_INCREMENT,
	rotulo varchar(256) not null,
	produtor varchar(64) not null,
	nome varchar(64) not null,
	regiao varchar(32) not null,
	paisorigem varchar(32) not null,
	avaliacao float(2) default null,
	numavaliacoes int default 0,
	tipo enum('vermelho','branco','espumante','rosa','sobremesa','porto'),
	tipouva varchar(32) not null,
	estilo varchar(32) not null,
	primary key (id)
);

--Inserts para teste

create table harmonizacao
(
	id int not null AUTO_INCREMENT,
	idVinho int not null,
	alimento varchar(64) not null,
	foreign key(idVinho) references vinho(id) on delete cascade on update cascade,
	primary key(id,idVinho)
);

create table usuario
(
	id int not null AUTO_INCREMENT,
	nome varchar(64) not null,
	email varchar(64) not null unique,
	senha varchar(50) not null,
	primary key(id)
);

create table vinhos_usuario
(
	idvinho int,
	idusuario int,
	foreign key(idvinho) references vinho(id) on update cascade on delete cascade,
	foreign key(idusuario) references usuario(id) on update cascade on delete cascade,
	primary key(idvinho,idusuario)
);

create table avaliacao
(
	idvinho int,
	idusuario int,
	nota float(2),
	opiniao varchar(128),
	foreign key(idvinho) references vinho(id) on update cascade on delete cascade,
	foreign key(idusuario) references usuario(id) on update cascade on delete cascade,
	primary key(idvinho,idusuario)
);

--Apos inserida uma avaliacao, a avaliacao da tabela vinho deve ser atualizada
DELIMITER $
CREATE TRIGGER atualiza_avaliacao after INSERT ON avaliacao FOR EACH ROW
BEGIN
	update vinho set avaliacao = (avaliacao*numavaliacoes+new.nota*1)/numavaliacoes+1 where id=new.idvinho;
	update vinho set numavaliacoes = numavaliacoes+1 where id = new.idvinho;
END$

DELIMITER $
CREATE TRIGGER atualiza_avaliacao_att after UPDATE ON avaliacao FOR EACH ROW
BEGIN
	update vinho set avaliacao = (avaliacao*numavaliacoes-old.nota*1)/numavaliacoes-1 where id=old.idvinho;
	update vinho set avaliacao = (avaliacao*numavaliacoes+new.nota*1)/numavaliacoes where id=new.idvinho;
END$

DELIMITER ;

--Apos alterada uma avaliacao, a avaliacao da tabela vinho deve ser atualizada
	