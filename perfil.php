<?php session_start(); ?>
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
        <!-- conflito
        <script src="js/skel-layers.min.js"></script>
        -->
        <noscript>
        <link rel="stylesheet" href="css/skel.css" />
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/style-xlarge.css" />
        </noscript>

        <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/themes/start/jquery-ui.css" />
        <link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" />
        <link rel="stylesheet" type="text/css" href="css/jquery.tajjgsinput.css" />

        <script type="text/javascript" src="js/jquery.autocomplete.js"></script>
        <script type="text/javascript" src="js/jquery.tagsinput.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#nome").autocomplete("cadastro_vinho_Autocompletar.php", {
                    width: 310,
                    selectFirst: false
                });
            });
        </script>
        <script type="text/javascript">
            $(function () {
                $('#harmonizacao').tagsInput({width: 'auto'});
            });
        </script>

        <script src="js/init.js"></script>
    </head>
    <body>
        <?php include_once("navMenu.php"); ?>
        <!-- Main -->
        <section id="main" class="wrapper">
            <div class="container">
                <header class="major">
                    <h2>Dados Pessoais</h2>
                    <p>Informe os seus dados</p>
                </header>
                <section>
                    <form action="cadastrar_vinho.php" enctype="multipart/form-data" method="POST">
                        <div class="row uniform 50%">
                            <div class="12u$">
                                <label for="nome">Nome:</label>
                                <input type="text" name="nome" id="nome" placeholder="Nome do vinho">
                            </div>

                            <div class="10u 12u$(Medium)">
                                <label for="produtor">Email:</label>
                                <input type="text" min="4" name="produtor" id="produtor" placeholder="Nome do produtor">
                            </div>
                            <div class="2u 12u$(Medium)">
                                <label for="produtor">Alterar sua senha:</label>
                                <ul class="actions">
                                    <li><input type="submit" onclick="" value="Alterar a senha" ></li>
                                </ul>
                            </div>
                            <div class="12u$" style="margin-top: 40px;">
                                <ul class="actions" style="text-align: center;">
                                    <li><input type="submit" onclick="" value="Atualizar Dados" ></li>
                                </ul>
                            </div>
                        </div>
                    </form>
                    <hr/>
               </section>
            </div>
        </section>

        <!-- Footer -->
        <footer id="footer">
            <div class="container">
                <div class="row">
                    <div class="8u 12u$(medium)">
                        <ul class="copyright">
                            <li>&copy; VinumWeb. Todos os direitos reservados.</li>
                            <li>Design base: <a href="http://templated.co">Templated</a></li>
                            <li>Densenvolvedores: Jean, Mateus e Adam</li>
                        </ul>
                    </div>
                    <div class="4u$ 12u$(medium)">
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