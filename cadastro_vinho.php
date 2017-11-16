<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Cadastre um novo vinho</title>

	<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/themes/start/jquery-ui.css" />
	<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" />
	<link rel="stylesheet" type="text/css" href="css/jquery.tagsinput.css" />

	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery.autocomplete.js"></script>
	<script type="text/javascript" src="js/jquery.tagsinput.js"></script>
	<!-- conflito <script type='text/javascript' src='js/jquery-ui.min.js'></script> -->

	<script type="text/javascript">
	 	$(document).ready(function(){
			$("#nome").autocomplete("cadastrar.php", {
				width:310,
				selectFirst: false
			});
		});
 	</script>
	<script type="text/javascript">
		$(function() {
			$('#harmonizacao').tagsInput({width:'auto'});
		});
	</script>
</head>
<body>
	<center>
		<form action="addbanco.php" enctype="multipart/form-data" method="POST">
			<h2>Informe os dados do seu vinho</h2>
			<hr/>
			<th></th>
			<table>
				<tr><td><label for="nome">Nome:</label></td>
					<td><input type="text" name="nome" id="nome" placeholder="Nome do vinho"></td>
				</tr>
				<tr><td><label for="produtor">Produtor:</label></td>
					<td><input type="text" required="true" min="4" name="produtor" id="produtor" placeholder="Nome do produtor"></td>
				</tr>
				<tr><td><label for="pais">Pais de origem:</label></td>
					<td><input type="text" name="pais" required="true" min="4" id="pais" placeholder="País de origem"></td>
				</tr>
				<tr><td><label for="regiao">Região de origem:</label></td>
					<td><input type="text" name="regiao" required="true" min="4" id="regiao" placeholder="Região"></td>
				</tr>
				<tr><td><label for="tipouva">Tipo de uva:</label></td>
					<td><input type="text" name="tipouva" required="true" min="4" id="tipouva" placeholder="Tipo de uva"></td>
				</tr>
				<tr><td><label for="estilo">Estilo:</label></td>
					<td><input type="text" id="estilo" required="true" min="4" name="estilo" placeholder="Estilo do vinho"><br>
					</td>
				</tr>
				<tr><td><label for="harmonizacao">Harmoniza com:</label></td>
					<td><input type="text" id="harmonizacao" name="harmonizacao" placeholder="Comidas que combinam"></td>
				</tr>
				<tr><td><label for="tipo">Tipo:</label></td>
					<td>
						<select name="tipo" id="tipo">
							<option value="vermelho">Vermelho</option>
							<option value="branco">Branco</option>
							<option value="espumante">Espumante</option>
							<option value="rosa">Rosa</option>
							<option value="sobremesa">Sobremesa</option>
							<option value="porto">Porto</option>
						</select>
					</td>
				</tr>
				<tr><td><label for="rotulo">Envie o rótulo:</label></td>
					<td><input type="file" required="true" name="rotulo" id="rotulo"></td>
				</tr>
			</table>
			<br/>
			<input type="submit" value="Cadastrar vinho">
		</form>
		<hr/>
		<h4>*Informe os alimentos que harmonizam com o vinho separados por vírgula</h4>
		<h4>*Ao selecionar a sugestão de um vinho na entrada de nome você não precisa informar os demais campos</h4>
	</center>
</body>
</html>