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
        $dao->where(array("id='" . $_SESSION['id'] . "'"));
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

$pageTitle = "Vw | ". $_SESSION['nome'];
include_once("header.php");
?>

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

                    <div class="10u 12u$(medium)">
                        <label for="produtor">Email:</label>
                        <input type="email" min="4" name="email" id="produtor" value="<?php echo $email; ?>" placeholder="Nome do produtor" required>
                    </div>
                    <div class="2u 12u$(medium)">
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
<?php
include_once 'footer.php';
