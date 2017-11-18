<?php ?>
<!-- Header -->
<header id="header">
    <div><a class="navbar-brand" href="index.php"><img src="images/logo.png"></span></a></div>
    <nav id="nav">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="cadastro_vinho.php">Entrar</a></li>
            <li><a href="cadastro_vinho.php">Cadastrar Vinho</a></li>
            <?php if (isset($_SESSION['nome'])) { ?>
                <li><a href="session/logon.php">Logout</a></li>
            <?php } else { ?>
                <li><a href="session/logon.php">Logar</a></li>
                <?php
            } ?>
        </ul>
    </nav>
</header>
<?php
?>