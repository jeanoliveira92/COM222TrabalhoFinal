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
                    <a href="logout.php">( Logout )</a></li>
            <?php } else { ?>
                <li><a href="logon.php">Login</a></li>
                <li><a class="button special" href="signup.php">Sign up</a></li>
            <?php } ?>
        </ul>
    </nav>
</header>