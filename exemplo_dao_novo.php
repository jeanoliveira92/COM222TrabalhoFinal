<?php
	include_once('DAO.php');

	$banco = new DAO();

	$tvinho = array('vermelho','branco','espumante','rosa','sobremesa','porto');
	$tuva = array('cabernet sauvignon','pinot noir','espumante','bege');
	$tpaises = array('Brasil','França');
	$testilo = array('Suave','Classico','Arrojado');
	$tcomida = array('queijo','broaa','Carne');

	$banco->buscarVinhos(5,1000,NULL,$tuva,2,$tpaises,$testilo,NULL);
	echo $banco->obterSQL();
?>