<?php
// Entra se houver dados em cache (email e senha) ou vier dados do formulario via POST 
// Sucess é uma variavel de confirmação de sucesso no login. ele entra no formulario exibe mensagem e direciona a index
if ((isset($_COOKIE["email"]) && isset($_COOKIE["email"]) ) || $_SERVER['REQUEST_METHOD'] == "POST") {
    // Verifica primeiro se existem os campos e depois se estão vazios
    if (( isset($_COOKIE["email"]) && isset($_COOKIE["email"]) ) ||
            ( isset($_POST['email']) && isset($_POST['senha']) && !empty($_POST['email']) && !empty($_POST['senha']))) {

        // Cria-se primeiro a conexão com o banco            
        include_once("DAO.php");
        // Variaveis de login
        $email = "";
        $senha = "";
        // Se os cookies existem, carrega-se eles nas variaveis
        if (isset($_COOKIE["email"]) && isset($_COOKIE["email"])) {
            $email = $_COOKIE["email"];
            $senha = $_COOKIE["senha"];
            // Se os dados vieram via POST
        } else {
            // Recupera o email
            $email = addslashes(trim($_POST["email"]));
            // Recupera a senha, a criptografando em SHA256, a mais moderna atualmente
            $senha = hash('sha256', addslashes($_POST["senha"]));
        }
        // Conecta com o BD
        $dao = new DAO();
        // Constroi a query e executa
        $dao->buscar("usuario");
        $dao->where(array("email='" . $email . "'", "senha='" . $senha . "'"));
        $dado = $dao->executar();
        // Pega o dado
        $row = $dado->fetch_assoc();

        // Verifica se retornou algo e valida. Se entrar, o usuario existe
        if ($row) {
            //Inicia sessões 
            session_start();
            // TUDO OK! Agora, passa os dados para a sessão e redireciona o usuário 
            $_SESSION["id"] = $row["id"];
            $_SESSION["nome"] = $row["nome"];

            // VERIFICA SE O BOTAO LEMBRAR TA ATIVO
            echo $dao->sql . "<br>";

            if (isset($_POST['remember'])) {
                echo "DENTRO";
                $tempo_expiracao = time() + (3600 * 24 * 5); // = 5 dias
                setcookie("email", $email, $tempo_expiracao);
                setcookie("senha", $senha, $tempo_expiracao);
            }
            // Redireciona para a index apos login
            header("location: index.php");
            //header("location: ../index.php");
        } else {
            header("location: logon.php?error=2");
        }
    } else {
        // Usuario e/ou senha em brancos ou invalidos
        header("location: logon.php?error=1");
    }
} else {
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">
        <head>
            <meta charset="utf-8"/>
            <meta name="viewport" content="width=device-width,height=device-height,initial-scale=1">
            <title>LOGIN</title>
            <link href="css/bootstrap.min.css" rel="stylesheet"/> 
            <link href="css/stylelg.css" rel="stylesheet"/> 
            <script src="js/jquery-1.12.3.min.js"></script>
            <script src="js/bootstrap.min.js"></script>  
        </head>
        <body>
            <div class="grad"></div>
            <div class="container lg">
                <div class="row">
                    <div class="col-md-offset-2 col-md-10">
                        <div class='col-md-offset-1 col-md-3 header'>
                            <div><a href="index.php">Vinum<span>Web</span></a></div>
                        </div>
                        <div class="col-md-4 login">
                            <form method="POST" action="logon.php">
                                <input type="text" placeholder="e-mail" name="email" <?php if (isset($_GET['success'])) echo "disabled"; ?>><br>
                                <input type="password" placeholder="senha" name="senha" <?php if (isset($_GET['success'])) echo "disabled"; ?>><br>
                                <div class="form-check">
                                    <label>
                                        <input type="checkbox" name="remember" class="form-check-input" <?php if (isset($_GET['success'])) echo "disabled"; ?>>
                                        Lembrar
                                    </label>
                                </div>
                                <input type="button" value="Registrar" onclick="location.href = 'signup.php'" <?php if (isset($_GET['success'])) echo "disabled"; ?>> <input type="submit" value="Login  " <?php if (isset($_GET['success'])) echo "disabled"; ?>>
                            </form>
                            <?php if (isset($_GET['error'])) { ?>
                                <div class="alert alert-danger" role="alert"><?php echo "E-mail ou senha inválido(os)"; ?></div>
                            <?php } else if (isset($_GET['connect'])) {
                                ?>
                                <div class="alert alert-success" role="alert"><?php echo "Para continuar, conecte-se ao seu usuário"; ?></div>
                            <?php }  else if (isset($_GET['logout'])) {
                                ?>
                                <div class="alert alert-success" role="alert"><?php echo "Log-out realizado com sucesso"; ?></div>
    <?php } ?>
                        </div>            
                    </div>
                </div>
            </div>
        </body>
    </html>
    <?php
}

if (isset($_GET['success'])) {
    // header("refresh: 1; location: ../index.php");
    ?>
    <!-- redireciona a pagina depois de 3 segundos-->
    <META HTTP-EQUIV="REFRESH" CONTENT="3; URL=../index.php">
    <?php
}
?>