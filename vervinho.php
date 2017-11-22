<?php
	include_once('DAO.php');
	$idvinho = $_GET['id'];
	$usr = $_GET['usr'];

	$banco = new DAO();
	$banco->buscar(vinho,NULL);
	$banco->where(array("id=".$idvinho));
	$res = $banco->executar();
	$vinho = $res->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo 'Vw | '.$vinho['nome']; ?></title>
</head>
<body>
	<center>
		<?php
		//Dados do vinho
			echo '<h2>'.$vinho['nome'].'<h2>'; 
			echo '<img src="images/'.$vinho['rotulo'].'"/>';
			echo "Table";
			echo "<p>Media de preço: ".$vinho['preco'].'</p>';
			echo '<p>Fabricado em: '.$vinho['regiao'].','.$vinho['paisorigem'].'</p>';
			echo '<p>Avaliação média: '.$vinho['avaliacao'];
		//Avaliacoes - Ao clicar sobre o nome do avaliador, devem ser exibidas todas as avaliacoes feitas por ele
			echo '<h3>Avaliações da bebida<h3>';
			$sql = 'select * from avaliacao av join usuario usr on av.idusuario=usr.id where idvinho='.$idvinho;
			$banco->setSQL($sql);
			$res = $banco->executar();

			while($dados = $res->fetch_assoc()) {
				echo '<p>Avaliação: '.$dados['nota'].'<br/><a href="avaliacoes_usuario.php?id="'.$dados['idusuario'].'">
						'.$dados['nome'].': </a> '.$dados['opiniao'].'
					  </p>';
			}
		?>
	</center>
</body>
</html>