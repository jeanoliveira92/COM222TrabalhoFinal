<?php
        session_start();
        
	include_once('DAO.php');
	//Não sei como pegar o valor do slider. Adicione ao arquivo avaliacao.php
	$nota = $_POST['rate'];
	$wine = $_POST['idvinho'];
	$usrid = $_SESSION['id'];
	$opiniao = $_POST['opiniao'];

	$bd = new DAO();
	$bd->cadastro('avaliacao',array('idvinho'=>$wine,'idusuario'=>$usrid,'nota'=>$nota,'opiniao'=>$opiniao));

        echo $bd->sql;
	if($res = $bd->executar()) {
		//Como funcionou, só redirecionar que a avaliacao dele será exibida
		header("location: showwine.php?sucess=1&id=".$wine."#avaliacoes");
            //echo "foi";
	} else {
            //echo "erro";
		//Redirecionar e mensagem de erro
		header("location: showwine.php?error=1&id=".$wine."#avaliacoes");
	}
?>