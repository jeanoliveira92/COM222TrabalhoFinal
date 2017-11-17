<?php
	include_once('DAO.php');
	$banco = new DAO();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Pesquisa por vinhos</title>
	<link href="css/nouislider.min.css" rel="stylesheet">
</head>
<body>
	<div>
		<h3>Tipo de vinho</h3>
		<input type="checkbox" name="tipo" value="vermelho">Vermelho<br>
		<input type="checkbox" name="tipo" value="branco">Branco<br>
		<input type="checkbox" name="tipo" value="rosa">Rosa<br>
		<input type="checkbox" name="tipo" value="espumante">Espumante<br>
		<input type="checkbox" name="tipo" value="porto">Porto<br>
		<input type="checkbox" name="tipo" value="sobremesa">Sobremesa<br>
	</div>

	<div>
		<h3>Intervalo de preço</h3>
		<script src="js/nouislider.min.js" id="intervalo" ></script>
		<div id="slider"></div>
	</div>

	<div>
		<h3>Avaliação dos usuários</h3>
		<input type="range" step="0.5" min="0" max="5" name="avaliacao" id="avaliacao"/>
	</div>

	<div>
		<h3>Uvas</h3>
		<input type="text" id="uvas" name="uvas" />
	</div>

	<div>
		<h3>Países</h3>
		<input type="text" id="paises" name="paises" />
	</div>

	<div>
		<h3>Estilos de vinho</h3>
		<input type="text" id="estilos" name="estilos" />
	</div>

	<div>
		<h3>Harmonização com comidas</h3>
		<?php
			$banco->setSQL('SELECT DISTINCT alimento from harmonizacao');
			$res = $banco->executar();

			if(mysqli_num_rows($res) == 0)
			{
				echo "Nenhuma harminização cadastrada";
			} else {
				while($harm = $res->fetch_assoc()) {
					echo '<input type="checkbox" name="'.$harm['alimento'].'" value="'.$harm['alimento'].'">'.$harm['alimento'].'<br>';
				}
			}

		?>
	</div>
</body>
<script>
	var slider = document.getElementById('slider');

	noUiSlider.create(slider, {
	    start: [20, 80],
	    connect: true,
	    range: {
	        'min': 0,
	        'max': 100
	    }
	});
</script>
</html>