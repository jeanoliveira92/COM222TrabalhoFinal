<?php
	include_once('DAO.php');
	//Não sei como pegar o valor do slider. Adicione ao arquivo avaliacao.php
	$nota = $_GET['nota'];
	$wine = $_GET['idvinho'];
	$usrid = $_SESSION['id'];
	$opiniao = $_GET['opiniao'];

	$bd = new DAO();
	$bd->cadastro('avaliacao',array('idvinho'=>$wine,'idusuario'=>$usrid,'nota'=>$nota,'opiniao'=>$opiniao));

	if($res = $bd->executar()) {
		//Como funcionou, só redirecionar que a avaliacao dele será exibida
		header("location: showwine.php?id=".$wine);
	} else {
		//Redirecionar e mensagem de erro
		header("location: showwine.php?id=".$wine);
	}
?>