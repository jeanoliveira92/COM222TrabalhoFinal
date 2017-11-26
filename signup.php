<?php
$error = -1;

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // Verifica primeiro se existem os campos e depois se estão vazios
    if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha']) && isset($_POST['senhar']) &&
            !empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['senha']) && !empty($_POST['senhar'])) {

        // Adiciona barras em caso de aspas simples/duplas, barra ou campo nulo 
        $nome = addslashes($_POST['nome']);
        // trim     - tira os espaços em branco
        // strlower - coloca todas letras em minusculas
        $email = addslashes(strtolower(trim($_POST['email'])));
        $senha = addslashes($_POST['senha']);
        $senhar = addslashes($_POST['senhar']);
        // Retorna o erro desses campos
        if (substr_count($nome, "\\")) {
            $nome = ""; // Apaga o campo para não retornar dado invalido
            $error = 0;
        } else if (substr_count($email, "\\")) {
            $email = ""; // Apaga o campo para não retornar dado invalido
            $error = 1;
        } else if (substr_count($senha, "\\")) {
            $senha = ""; // Apaga o campo para não retornar dado invalido
            $error = 2;
        } else if (substr_count($senhar, "\\")) {
            $senhar = ""; // Apaga o campo para não retornar dado invalido
            $error = 3;
            // Senha deve conter pelo menos 6 digitos
        } else if (strlen($senha) < 6) {
            $error = 4;
            // Verificar se as senhas digitadas correspondem
        } else if (strcmp($senha, $senhar)) {
            $error = 5;
        } else {
            include_once("DAO.php");
            // Encrypta a senha em SHA256
            $senha = hash('sha256', ($senha));
            // Conecta com o BD
            $dao = new DAO;
            // Constroi a query e executa
            $dao->cadastro("usuario", array("nome" => $nome, "senha" => $senha, "email" => $email));
            $dado = $dao->executar();

            header("location: logon.php");
        }
    } else {
        // Usuario e/ou senha em brancos ou invalidos
        $erro = 10;
    }
}
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
                        <form method="POST" action="signup.php">
                            <div class="field-wrap">
                                <input type="text" placeholder="nome" name="nome" required autocomplete="off" value="<?php
                                if ($error != -1) {
                                    echo $nome;
                                }
                                ?>"/>
                            </div>
                            <div class="field-wrap">
                                <input type="email" placeholder="e-mail" name="email" required autocomplete="off" value="<?php
                                if ($error != -1) {
                                    echo $email;
                                }
                                ?>"/>
                            </div>
                            <div class="field-wrap">
                                <input type="password" placeholder="senha" name="senha" required autocomplete="off"/>
                            </div>
                            <div class="field-wrap">
                                <input type="password" placeholder="repita a senha" name="senhar" required autocomplete="off"/>
                            </div>
                            <input type="button" value="Voltar" onclick="location.href = 'logon.php'"> <input type="submit" value="Registrar">
                        </form>
                        <?php if ($error != -1) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?php
                                switch ($error) {
                                    case 0: {
                                            echo "O campo nome invalido. Contém: aspas simples/duplas, barras ou valor NULL";
                                            break;
                                        }case 1: {
                                            echo "O campo email invalido. Contém: aspas simples/duplas, barras ou valor NULL";
                                            break;
                                        }case 2: {
                                            echo "O campo email invalido. Contém: aspas simples/duplas, barras ou valor NULL";
                                            break;
                                        }case 3: {
                                            echo "O campo repita senha invalido. Contém: aspas simples/duplas, barras ou valor NULL";
                                            break;
                                        }case 4: {
                                            echo "Senha deve conter no mínimo 6 caracteres";
                                            break;
                                        }case 5: {
                                            echo "Senhas não correspondem";
                                            break;
                                        }case 10: {
                                            echo "Falha ao enviar dados";
                                            break;
                                        }
                                }
                                ?>
                            </div>
                        <?php } ?> 
                    </div>           
                </div>
            </div>
        </div>
    </body>
</html>