create database vinumweb;

use vinumweb;

create table vinho
(
	id int unique not null AUTO_INCREMENT,
	rotulo varchar(256) not null,
	produtor varchar(64) not null,
	nome varchar(64) not null,
	regiao varchar(32) not null,
	paisorigem varchar(32) not null,
	avaliacao float(2) default 0,
	preco float(2) default 0,
	numavaliacoes int default 0,
	tipo enum('vermelho','branco','espumante','rosa','sobremesa','porto'),
	tipouva varchar(32) not null,
	estilo varchar(32) not null,
	primary key (id)
);

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
	senha varchar(64) not null,
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
	ordem int unique not null AUTO_INCREMENT,
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
	DECLARE numav int(11);
	select numavaliacoes into numav from vinho where id=new.idvinho;
	IF(numav < 1) THEN
		UPDATE vinho SET avaliacao=new.nota where id=new.idvinho;
		UPDATE vinho SET numavaliacoes=1 where id=new.idvinho;
	ELSE
		update vinho set avaliacao = (avaliacao*numavaliacoes+new.nota)/(numavaliacoes+1) where id=new.idvinho;
		update vinho set numavaliacoes = (numavaliacoes+1) where id = new.idVinho;
	END IF;
END

--Apos inserido um preco, essa procedure deve ser chamada para atualizar
--o preco do vinho
DELIMITER $
CREATE PROCEDURE atualiza_preco(IN valor float(2),IN cod_vinho int)
BEGIN
	DECLARE qtd bigint;
	SELECT count(*) INTO qtd from vinhos_usuario where idvinho = cod_vinho;

	IF(qtd != 1) THEN
		update vinho set preco = (preco*(qtd-1)+valor)/(qtd) where id=cod_vinho;
	END IF;
END$
DELIMITER ;

--Obter as uvas do banco
SELECT DISTINCT tipouva from vinho where tipouva like '%tipo%' order by tipouva asc;