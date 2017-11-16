<!DOCTYPE html>
<!--
	Transit by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Cadastre um novo vinho</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-xlarge.css" />
		</noscript>

		<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/themes/start/jquery-ui.css" />
		<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" />
		<link rel="stylesheet" type="text/css" href="css/jquery.tagsinput.css" />

		<script type="text/javascript" src="js/jquery.autocomplete.js"></script>
		<script type="text/javascript" src="js/jquery.tagsinput.js"></script>
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

		<!-- Header -->
			<header id="header">
				<h1><a href="index.html">Transit</a></h1>
				<nav id="nav">
					<ul>
						<li><a href="index.html">Home</a></li>
						<li><a href="generic.html">Generic</a></li>
						<li><a href="elements.html">Elements</a></li>
						<li><a href="#" class="button special">Sign Up</a></li>
					</ul>
				</nav>
			</header>

		<!-- Main -->
			<section id="main" class="wrapper">
				<div class="container">

					<header class="major">
						<h2>Cadastrar Vinho</h2>
						<p>Informe os dados do seu vinho</p>
					</header>

					<section>
						<form action="addbanco.php" enctype="multipart/form-data" method="POST">
							<div class="row uniform 50%">
								<div class="6u 12u$(4)">
									<label for="nome">Nome:</label>
									<input type="text" name="nome" id="nome" placeholder="Nome do vinho">
								</div>
								
								<div class="6u$ 12u$(4)">
									<label for="produtor">Produtor:</label>
									<input type="text" required="true" min="4" name="produtor" id="produtor" placeholder="Nome do produtor">
								</div>
								<div class="6u 12u$(4)">
									<label for="pais">Pais de origem:</label>
									<input type="text" name="pais" required="true" min="4" id="pais" placeholder="País de origem">
								</div>
								<div class="6u$ 12u$(4)">
									<label for="regiao">Região de origem:</label>
									<input type="text" name="regiao" required="true" min="4" id="regiao" placeholder="Região">
								</div>
								<div class="6u 12u$(4)">
									<label for="tipouva">Tipo de uva:</label>
									<input type="text" name="tipouva" required="true" min="4" id="tipouva" placeholder="Tipo de uva">
								</div>
								<div class="6u$ 12u$(4)">
									<label for="estilo">Estilo:</label>
									<input type="text" id="estilo" required="true" min="4" name="estilo" placeholder="Estilo do vinho">
								</div>
								<div class="4u 12u$(3)">
									<label for="harmonizacao">Harmoniza com:</label>
									<input type="text" id="harmonizacao" name="harmonizacao" placeholder="Comidas que combinam">
								</div>
								<div class="4u 12u$(3)">
									<label for="tipo">Tipo:</label>
										<select name="tipo" id="tipo">
											<option value="vermelho">Vermelho</option>
											<option value="branco">Branco</option>
											<option value="espumante">Espumante</option>
											<option value="rosa">Rosa</option>
											<option value="sobremesa">Sobremesa</option>
											<option value="porto">Porto</option>
										</select>
								</div>
								<div class="4u 12u$(3)">
									<label for="rotulo">Envie o rótulo:</label>
									<div class="fileUpload button fit">
										<span>Carregar Arquivo</span>
										<input type="file" required="true" name="rotulo" id="rotulo" class="upload">
									</div>
								</div>
								<div class="12u$">
									<ul class="actions">
										<li><input type="submit" value="Cadastrar vinho" class="special"></li>
										<li><input type="reset" value="Reset"></li>
									</ul>
								</div>
							</div>
						</form>
						<hr/>
						<h4>*Informe os alimentos que harmonizam com o vinho separados por vírgula</h4>
						<h4>*Ao selecionar a sugestão de um vinho na entrada de nome você não precisa informar os demais campos</h4>
					</section>
				</div>
			</section>

		<!-- Footer -->
			<footer id="footer">
				<div class="container">
					<section class="links">
						<div class="row">
							<section class="3u 6u(medium) 6u 12u$(4)(small)">
								<h3>Lorem ipsum dolor</h3>
								<ul class="unstyled">
									<li><a href="#">Lorem ipsum dolor sit</a></li>
									<li><a href="#">Nesciunt itaque, alias possimus</a></li>
									<li><a href="#">Optio rerum beatae autem</a></li>
									<li><a href="#">Nostrum nemo dolorum facilis</a></li>
									<li><a href="#">Quo fugit dolor totam</a></li>
								</ul>
							</section>
							<section class="3u 6u$(medium) 6u 12u$(4)(small)">
								<h3>Culpa quia, nesciunt</h3>
								<ul class="unstyled">
									<li><a href="#">Lorem ipsum dolor sit</a></li>
									<li><a href="#">Reiciendis dicta laboriosam enim</a></li>
									<li><a href="#">Corporis, non aut rerum</a></li>
									<li><a href="#">Laboriosam nulla voluptas, harum</a></li>
									<li><a href="#">Facere eligendi, inventore dolor</a></li>
								</ul>
							</section>
							<section class="3u 6u(medium) 6u 12u$(4)(small)">
								<h3>Neque, dolore, facere</h3>
								<ul class="unstyled">
									<li><a href="#">Lorem ipsum dolor sit</a></li>
									<li><a href="#">Distinctio, inventore quidem nesciunt</a></li>
									<li><a href="#">Explicabo inventore itaque autem</a></li>
									<li><a href="#">Aperiam harum, sint quibusdam</a></li>
									<li><a href="#">Labore excepturi assumenda</a></li>
								</ul>
							</section>
							<section class="3u$ 6u$(medium) 6u 12u$(4)(small)">
								<h3>Illum, tempori, saepe</h3>
								<ul class="unstyled">
									<li><a href="#">Lorem ipsum dolor sit</a></li>
									<li><a href="#">Recusandae, culpa necessita nam</a></li>
									<li><a href="#">Cupiditate, debitis adipisci blandi</a></li>
									<li><a href="#">Tempore nam, enim quia</a></li>
									<li><a href="#">Explicabo molestiae dolor labore</a></li>
								</ul>
							</section>
						</div>
					</section>
					<div class="row">
						<div class="8u 6u 12u$(4)(medium)">
							<ul class="copyright">
								<li>&copy; Untitled. All rights reserved.</li>
								<li>Design: <a href="http://templated.co">TEMPLATED</a></li>
								<li>Images: <a href="http://unsplash.com">Unsplash</a></li>
							</ul>
						</div>
						<div class="4u$ 6u 12u$(4)(medium)">
							<ul class="icons">
								<li>
									<a class="icon rounded fa-facebook"><span class="label">Facebook</span></a>
								</li>
								<li>
									<a class="icon rounded fa-twitter"><span class="label">Twitter</span></a>
								</li>
								<li>
									<a class="icon rounded fa-google-plus"><span class="label">Google+</span></a>
								</li>
								<li>
									<a class="icon rounded fa-linkedin"><span class="label">LinkedIn</span></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>

	</body>
</html>