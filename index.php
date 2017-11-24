<?php
session_start();

if (( isset($_COOKIE["email"]) && isset($_COOKIE["email"])) && (!$_SESSION['id'])) {
    header("Location: logon.php");
}
?>

<html lang="pt-br>
      <head>
      <meta charset="UTF-8">
      <title>VinumWeb</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
    <script src="js/jquery.js"></script>
    <script src="js/skel.min.js"></script>
    <!-- conflito
    <script src="js/skel-layers.min.js"></script>
    -->
    <script src="js/init.js"></script>
    <noscript>
    <link rel="stylesheet" href="css/skel.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/style-xlarge.css" />
    </noscript>
</head>
<body class="landing">
    <?php include_once("navMenu.php"); ?>
    <!-- Banner -->
    <section id="banner">
        <h2>Bem vindo ao VinumWeb</h2>
        <p>Conheça, avalie e descubra tudo sobre vinhos!</p>

        <ul class="actions">
            <li>
                <a href="#conhecer" class="button big">Começe a sua busca!</a>
            </li>
        </ul>
    </section>

    <!-- One -->
    <section id="one" class="wrapper style1 special">
        <div class="container">
            <header class="major">
                <h2 id="conhecer">Que tal conhecer alguns vinhos?</h2>
                <p>Informe suas preferências abaixo e mostraremos algumas garrafas!</p>
            </header>
<?php include_once('slider.php'); ?>
        </div>
    </section>

    <!-- Two -->
    <section id="two" class="wrapper style2 special">
        <div class="container">
            <header class="major">
                <h2>Conheça também alguns tipos de uva</h2>
                <p>Afinal, as melhores uvas geram os melhores vinhos</p>
            </header>
            <section class="profiles">
                <div class="row">
                    <section class="3u 6u(medium) 12u$(xsmall) profile">
                        <img src="images/cs.png" alt="" />
                        <h4>Cabernet Sauvignon</h4>
                        <p>Uma das mais usadas em todo mundo</p>

                    </section>
                    <section class="3u 6u$(medium) 12u$(xsmall) profile">
                        <img src="images/noir.png" alt="" />
                        <h4>Pinot noir</h4>
                        <p>Usada na fabricação de vinhos suaves</p>
                    </section>
                    <section class="3u 6u(medium) 12u$(xsmall) profile">
                        <img src="images/char.png" alt="" />
                        <h4>Chardonnay</h4>
                        <p>Usada na produção de vinhos brancos e espumantes</p>
                    </section>
                    <section class="3u$ 6u$(medium) 12u$(xsmall) profile">
                        <img src="images/blanc.png" alt="" />
                        <h4>Sauvignon blanc</h4>
                        <p>Gera vinhos suaves, com boa acidez e sabor discretamente herbáceo</p>
                    </section>
                </div>
            </section>
            <footer>
                <p>Ao buscar por vinhos no sistema são listadas também as uvas utilizadas na produção da bebida. Você também pode adicionar os seus vinhos ao sistema e participar da comunidade VinumWeb!</p>
            </footer>
        </div>
    </section>

   <?php include_once 'footer.php';