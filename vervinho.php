<?php
	include_once('DAO.php');
	$idvinho = $_GET['id'];
	$banco = new DAO();
	$banco->buscar('vinho',NULL);
	$banco->where(array("id=".$idvinho));
	$res = $banco->executar();

	if($banco->numLinhasAfetadas($res)==0) {
		header("location: index.php");
	}

	$vinho = $res->fetch_assoc();
	

	function buscaAvaliacoes() {
		$idvinho = $_GET['id'];
		$database = new DAO();
		$database->buscar('avaliacao',NULL);
		$database->where(array("idvinho=".$idvinho));
		$review = $database->executar();

		if($database->numLinhasAfetadas($review) == 0) {
			return NULL;
		} else {
			return $review;
		}
	}

	function buscaUsuario($id) {
		$database = new DAO();
		$database->buscar('usuario',NULL);
		$database->where(array("id=".$id));
		$usuario = $database->executar();

		if($database->numLinhasAfetadas($usuario)==0) {
			return NULL;
		} else {
			return $usuario->fetch_assoc();
		}
	}

	function exibeAvaliacoes() {
		$idvinho = $_GET['id'];
	}
?>
<html lang="en">
	<head>
		<title>vw | <?php echo $vinho['nome']; ?></title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-xlarge.css" />
		</noscript>
		<meta charset="UTF-8">
	</head>
	<body class="landing">
		<!-- One -->
			<section id="one" class="wrapper style2 special">
				<div class="container">
					<header class="major">
						<h2><?php echo $vinho['nome']; ?></h2>
						<p>Um vinho <?php echo $vinho['tipo']; ?> da região de <?php echo $vinho['regiao']; ?>, <?php echo $vinho['paisorigem']; ?></p>
					</header>
					<div class="row 150%">
						<div class="4u">
							<span class="image fit">
								<img src="images/rotulos/<?php echo $vinho['rotulo']; ?>" alt="" />
							</span>
						</div>
						<div>
							<header class="major">
								<h3> 
									<?php 
										if($vinho['numavaliacoes'] == 0){
											echo "O vinho ainda não foi avaliado";
										} else {
											echo 'Avaliação média: '.$vinho['avaliacao'];
										}
									?>
								</h3>
							</header>

							<div class="12u 12u(3)">
								<div class="row">
									<section class="3u 6u(medium) 12u$(xsmall) profile">
										<img src="images/showico/tipo.png" alt="" />
										<h4>Estilo</h4>
										<p><?php echo $vinho['estilo']; ?></p>
									</section>
									<section class="3u 6u(medium) 12u$(xsmall) profile">
										<img src="images/showico/prod.png" alt="" />
										<h4>Produtor</h4>
										<p><?php echo $vinho['produtor']; ?></p>
									</section>
									<section  class="3u 6u(medium) 12u$(xsmall) profile">
										<img src="images/showico/preco.png" alt="" />
										<h4>Preço médio</h4>
										<p>R$<?php echo $vinho['preco']; ?></p>
									</section>
									<section class="3u$ 6u$(medium) 12u$(xsmall) profile">
										<img src="images/showico/uva.png" alt="" />
										<h4>Tipo de uva</h4>
										<p><?php echo $vinho['tipouva']; ?></p>
									</section>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

			<section id="harmonizacao" class="wrapper 20%">
				<div class="container">
				<div class="row 10%">
					<div class="6u 12u$(medium)">
						<section>
							<h2>Alimentos harmonizantes:</h2>
							<?php
								$avaliacoes = buscaAvaliacoes();
								if($avaliacoes != NULL) {
									while($av = $avaliacoes->fetch_assoc()) {
										$pessoa = buscaUsuario($av['idusuario']);

										if($pessoa !== NULL) {
											echo '<blockquote><h4><a href="">'.$pessoa['nome'].'</a> avaliou em '.$av['nota'].':</h4>';
											echo '"'.$av['opiniao'].'"</blockquote>';
										}
									}
								} else {
									echo "<h4>Esse vinho ainda não foi avaliado.</h4>";
								}
							?>
						</section>
					</div>

					<div class="6u 12u$(medium)">
						<section>
							<h2>Avaliações:</h2>
							<?php
								$avaliacoes = buscaAvaliacoes();
								if($avaliacoes != NULL) {
									while($av = $avaliacoes->fetch_assoc()) {
										$pessoa = buscaUsuario($av['idusuario']);

										if($pessoa !== NULL) {
											echo '<blockquote><h4><a href="">'.$pessoa['nome'].'</a> avaliou em '.$av['nota'].':</h4>';
											echo '"'.$av['opiniao'].'"</blockquote>';
										}
									}
								} else {
									echo "<h4>Esse vinho ainda não foi avaliado.</h4>";
								}
							?>
						</section>
					</div>
				</div>
			</div>
			</section>
		<!-- Three -->
			<section id="three" class="wrapper style2 special">
				<div class="container">
					<header class="major">
						<h2>Avalie esse vinho</h2>
						<p>A sua avaliação será de grande importância para a comunidade VinumWeb</p>
					</header>
				</div>
				<div class="container 50%">
					<form action="#" method="post">
						<div class="row uniform">
							<div class="12u$">
		                        <script src="js/nouislider.min.js"></script>
		                        <link href="css/nouislider.min.css" rel="stylesheet">
		                        <div id="rate-value" class="2u" style="position: relative; float: left;padding-bottom: 10px;">1000</div>
		                        <div id="rate-range" class="8u" style="position: relative; float: left;"></div>
		                        <div class="2u" style="position: relative; float: left;padding-left: 30px">5.0</div>
		                        <script>
		                            var rateSlider = document.getElementById('rate-range');

		                            noUiSlider.create(rateSlider, {
		                                start: [3],
		                                snap: true, // salto a salta elemento
		                                range: {
		                                    'min': 1,
		                                    '3.5%': 1.1, '6%': 1.2, '8.5%': 1.3, '11%': 1.4, '13.5%': 1.5, '16%': 1.6, '18.5%': 1.7,
		                                    '21%': 1.8, '23.5%': 1.9, '26%': 2, '28.5%': 2.1, '31%': 2.2, '33.5%': 2.3, '36%': 2.4,
		                                    '38.5%': 2.5, '41%': 2.6, '43.5%': 2.7, '46%': 2.8, '48.5%': 2.9, '51%': 3, '53.5%': 3.1,
		                                    '56%': 3.2, '58.5%': 3.3, '61%': 3.4, '63.5%': 3.5, '66%': 3.6, '68.5%': 3.7, '71%': 3.8,
		                                    '73.5%': 3.9, '76%': 4, '78.5%': 4.1, '81%': 4.2, '83.5%': 4.3, '86%': 4.4, '88.5%': 4.5,'91%': 4.6, '93.5%': 4.7, '96%': 4.8, '98.5%': 4.9,
		                                    'max': 5
		                                }
		                            });
		                            var ratenodes = [
		                                document.getElementById('rate-value'), // 0
		                            ];

		                            // Display the slider value and how far the handle moved
		                            // from the left edge of the slider.
		                            rateSlider.noUiSlider.on('update', function ( values, handle, unencoded, isTap, positions ) {
		                                    ratenodes[handle].innerHTML = parseFloat(values[handle]).toFixed(1);
		                                   // rateSlider.noUiSlider.get();
		                            });
		                        </script>
							</div>
							<div class="12u$">
								<textarea name="opiniao" id="opiniao" placeholder="Opinião" rows="6"></textarea>
							</div>
							<div class="12u$">
								<ul class="actions">
									<li><input value="Avaliar bebida" class="special big" type="submit"></li>
								</ul>
							</div>
						</div>
					</form>
				</div>
			</section>
		</body>
</html>