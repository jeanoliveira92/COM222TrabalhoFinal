<?php
    session_start();
    // Se habilitar esse, forçará estar logado para acessar a pagina. Comente a linha de cima.
    //include_once('session.php');
?>
<!-- Header -->
<header id="header">
    <h1><a href="index.php">Vinum<span>Web</span></a></h1>
    <nav id="nav">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="cadastro_vinho.php">Entrar</a></li>
            <li><a href="cadastro_vinho.php">Cadastrar Vinho</a></li>
            
            <?php if (isset($_SESSION["id"])) { ?>
            <li><a href="perfil.php"><?php echo $_SESSION["nome"][1]."&nbsp;";?></a><a href="session/logout.php">( Logout )</a></li>
            <?php } else { ?>
                <li><a href="session/logon.php">Inscreva-se</a></li>
                <li><a href="session/logon.php">Entrar</a></li>
            <?php } ?>
        </ul>
    </nav>
</header>