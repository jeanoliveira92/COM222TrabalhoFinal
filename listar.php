<?php
	include_once('DAO.php');
	$banco = new DAO();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Pesquisa por vinhos</title>
	<script src="js/jquery.js"></script>
	<script src="js/skel.min.js"></script>
	<script src="js/skel-layers.min.js"></script>
	<noscript>
		<link rel="stylesheet" href="css/skel.css" />
		<link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="css/style-xlarge.css" />
	</noscript>

	<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/themes/start/jquery-ui.css" />
	<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" />
	<link rel="stylesheet" type="text/css" href="css/jquery.tajjgsinput.css" />

	<script type="text/javascript" src="js/jquery.autocomplete.js"></script>
	<script type="text/javascript">
	 	$(document).ready(function(){
			$("#uvas").autocomplete("busca_uva.php", {
				width:310,
				selectFirst: false
			});
		});
	</script>
	<!--script type="text/javascript">
	 	function addParagrafo(){
	 		document.getElementById("puvas").textContent = document.getElementById("tipo".value);
	 	}
	</script-->
</head>
<body>
    <div style="">
	<div>
		<h3>Tipo de vinho</h3>
		<input type="checkbox" id="tipo" name="tipo" value="vermelho">Vermelho<br>
		<input type="checkbox" id="tipo" name="tipo" value="branco">Branco<br>
		<input type="checkbox" id="tipo" name="tipo" value="rosa">Rosa<br>
		<input type="checkbox" id="tipo" name="tipo" value="espumante">Espumante<br>
		<input type="checkbox" id="tipo" name="tipo" value="porto">Porto<br>
		<input type="checkbox" id="tipo" name="tipo" value="sobremesa">Sobremesa<br>
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
		<input type="text" id="uvas" name="uvas"/>
		<div id="tuvas">
		</div>
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
    </div>
    <div style="">
    aehuaheauehau
    </di>
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