<?php
session_start();
include_once 'session.php';
include_once 'DAO.php';

$dao = new DAO();

$email;
$msg;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
$nome = addslashes($_POST['nome']);
$email = addslashes($_POST['email']);

if (empty($nome)) {
$msg = "Campo nome em branco";
} else if (empty($email)) {
$msg = "Campo email em branco";
} else if (substr_count($nome, "\\")) {
$msg = "Campo preco invalido. Contém: aspas simples/duplas, barras ou valor NULL";
} else if (substr_count($email, "\\")) {
$msg = "Campo preco invalido. Contém: aspas simples/duplas, barras ou valor NULL";

// Se não houver erros,a atualiza o usuario
} else {
$dao->atualizacao("usuario", array("nome" => $nome, "email" => $email));
$dao->where(array("id='".$_SESSION['id']."'"));
$dao->executar();

$_SESSION['nome'] = $nome;
$msg = "Atualizado com sucesso!";
}
} else {
$dao->buscar("usuario", array("email"));
$dao->where(array("id='" . $_SESSION['id'] . "'"));
$dado = $dao->executar();
$row = $dado->fetch_assoc();

$email = $row['email'];
}
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?php $nome; ?></title>
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
                    <form action="perfil.php" enctype="multipart/form-data" method="POST">
                        <?php if (isset($msg)) { ?>
                            <div class="alert-success" role="alert"><?php echo $msg ?></div>
                        <?php } ?>
                        <div class="row uniform 50%">
                            <div class="12u$">
                                <label for="nome">Nome:</label>
                                <input type="text" name="nome" id="nome" value="<?php echo $_SESSION['nome']; ?>"placeholder="Nome do vinho" required>
                            </div>

                            <div class="10u 12u$(Medium)">
                                <label for="produtor">Email:</label>
                                <input type="email" min="4" name="email" id="produtor" value="<?php echo $email; ?>" placeholder="Nome do produtor" required>
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