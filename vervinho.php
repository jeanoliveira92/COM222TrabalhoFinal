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
    
    function exibeHarmonizacoes() {
        $idvinho = $_GET['id'];
        $database = new DAO();
        $database->buscar('harmonizacao',array('alimento'));
        $database->where(array("idvinho=".$idvinho));
        $harm = $database->executar();

<<<<<<< HEAD
	function exibeHarmonizacoes() {
		$idvinho = $_GET['id'];
		$database = new DAO();
		$database->buscar('harmonizacao',array('alimento'));
		$database->where(array("idvinho=".$idvinho));
		$harm = $database->executar();

		if($database->numLinhasAfetadas($harm)==0) {
			echo "<h4>Nenhuma harmonização com esse vinho cadastrada.</h4>";
		} else {
			$count = $database->numLinhasAfetadas($harm);
			
			if($count < 7) {
				echo '<ul><h3>';
				while($alim = $harm->fetch_assoc()) {
					echo '<li>'.$alim['alimento'].'</li>';
				}
				echo '</h3><ul>';
			} else {
				echo '<ul><h4>';
				while($alim = $harm->fetch_assoc()) {
					echo '<li>'.$alim['alimento'].'</li>';
				}
				echo '</h4><ul>';
			}
		}
	}
>>>>>>> 285d08e0cd4913b56e8710e50e592aca9b1d5777
=======
        if($database->numLinhasAfetadas($harm)==0) {
            echo "<h4>Nenhuma harmonização com esse vinho cadastrada.</h4>";
        } else {
            $count = $database->numLinhasAfetadas($harm);
            
            if($count < 7) {
                echo '<ul><h3>';
                while($alim = $harm->fetch_assoc()) {
                    echo '<li>'.$alim['alimento'].'</li>';
                }
                echo '</h3><ul>';
            } else {
                echo '<ul><h4>';
                while($alim = $harm->fetch_assoc()) {
                    echo '<li>'.$alim['alimento'].'</li>';
                }
                echo '</h4><ul>';
            }
        }
    }
>>>>>>> f8b1394671e020c11b3f577390572924c50eae3a
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

<<<<<<< HEAD
                            if ($pessoa !== NULL) {
                                echo '<blockquote><h4><a href="">' . $pessoa['nome'] . '</a> avaliou em ' . $av['nota'] . ':</h4>';
                                echo '"' . $av['opiniao'] . '"</blockquote>';
                            }
                        }
                    } else {
                        echo "<h4>Esse vinho ainda não foi avaliado.</h4>";
                    }
                    ?>
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
=======
			<section id="harmonizacao" class="wrapper 20%">
				<div class="container">
				<div class="row 10%">
					<div class="6u 12u$(medium)">
						<section>
							<h2>Alimentos harmonizantes:</h2>
							<?php
								exibeHarmonizacoes();
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
											echo '<blockquote><h4><a href="userreviews.php?usr='.$pessoa['id'].'">'.$pessoa['nome'].'</a> avaliou em '.$av['nota'].':</h4>';
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
<<<<<<< HEAD
			<?php
				// O formulário de avaliacao só será exibido caso o usuario esteja logado
				session_start();
				$_SESSION['nome'] = 'gogogo';
				$_SESSION['id'] = 1;
				if(isset($_SESSION['nome'])){
					include_once('avaliacao.php');
				}
			?>
		</body>
</html>
=======
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
>>>>>>> 285d08e0cd4913b56e8710e50e592aca9b1d5777
=======
            <section id="harmonizacao" class="wrapper 20%">
                <div class="container">
                <div class="row 10%">
                    <div class="6u 12u$(medium)">
                        <section>
                            <h2>Alimentos harmonizantes:</h2>
                            <?php
                                exibeHarmonizacoes();
                            ?>
                        </section>
                    </div>
>>>>>>> f8b1394671e020c11b3f577390572924c50eae3a

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
<<<<<<< HEAD
        </section>
        <?php include_once 'footer.php';
>>>>>>> 875a9d2bfd42800403149b5aa25ca89dca4860d3
=======
            </section>
            <?php
                session_start();

                if(isset($_SESSION['nome']) && isset($_SESSION['id'])) {
                    include_once('avaliacao.php');
                }
            ?>
        </body>
</html>
>>>>>>> f8b1394671e020c11b3f577390572924c50eae3a
