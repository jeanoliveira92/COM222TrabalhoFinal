<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $pageTitle; ?></title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
        <script src="js/jquery.min.js"></script>
        <script src="js/skel.min.js"></script>
        <script src="js/skel-layers.min.js"></script>
        
        <noscript>
        <link rel="stylesheet" href="css/skel.css" />
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/style-xlarge.css" />
        </noscript>

        <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/themes/start/jquery-ui.css" />
        <link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" />
        <link rel="stylesheet" type="text/css" href="css/jquery.tagsinput.min.css" />
        <script src="js/init.js"></script>
    </head>
    <body>
        <!-- Header -->
        <header id="header">
            <h1><a href="index.php">Vinum<span>Web</span></a></h1>
            <nav id="nav">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="cadastro_vinho.php">Cadastrar Vinho</a></li>

                    <?php if (isset($_SESSION["id"])) { ?>
                        <li><a href="meusvinhos.php">My Wines<a/a></li>
                                    <li><a href="perfil.php"><?php echo explode(" ", $_SESSION["nome"])[0] . "&nbsp;"; ?></a>
                                        <a class="button special" style="margin-left: 15px !important;" href="logout.php">Logout</a></li>
                                <?php } else { ?>
                                    <li><a href="logon.php">Login</a></li>
                                    <li><a class="button special" href="signup.php">Sign up</a></li>
                                    <?php } ?>
                                </ul>
                                </nav>
                                </header>