<?php

session_start();
include_once('DAO.php');
//obter parametros: O vinho é importante caso seja necessario redirecionar de volta
global $pvinho;
$pvinho = $_GET['vinho'];
$pusr = $_GET['user'];

//Validar se é necessário redirecionar de cara
if (empty($pusr)) {
    if (empty($pvinho)) {
        header("location: index.php");
    } else {
        header("showwine.php?id=" . $pvinho);
    }
}

//Buscar usuário
$banco = new DAO();
$banco->buscar('usuario', NULL);
$banco->where(array("id='" . $pusr."'"));

//echo $banco->sql;

$user = $banco->executar();

if ($user->num_rows > 0) {
    $user = $user->fetch_assoc();
} else {
    //Não encontrou. Redirecionar
    if (empty($pvinho)) {
        //Se o id do vinho for invalido, mandar p/ index
        header("location: index.php");
    } else {
        //Se o id do vinho for passado, redirecionar
        header("location: showwine.php?id=" . $pvinho);
    }
}

function listarAvaliacoes($avaliacoes, $user) {
    $vinho;
    $avaliacao;

    $server = new DAO();
    echo '<div class="row 150%">';
    while ($avaliacao = $avaliacoes->fetch_assoc()) {
        //Buscar vinho
        $server->buscar('vinho', NULL);
        $server->where(array('id=' . $avaliacao['idvinho']));
        $vinho = $server->executar()->fetch_assoc();

        echo '<div class="4u"><span class="image fit"><a href="showwine.php?id=' . $vinho['id'] . '"><img src="images/rotulos/' . $vinho['rotulo'] . '"/></a></span></div>';
        echo '<div class="4u$"><blockquote><h3>' . $vinho['nome'] . '</a>: Nota ' . $avaliacao['nota'] . '.</h3>';
        echo '<h4>"' . $avaliacao['opiniao'] . '"</h4></blockquote></div>';
    }
    echo "</div>";
}

$pageTitle = "Avaliações de ".$user['nome'];
include_once 'header.php';
//As revisoes mais recentes aparecem primeiro
?>

<section id="one" class="wrapper">
    <div class="container">
        <header class="major">
            <h2><?php echo $user['nome']; ?></h2>
            <p>Integrante da comunidade | <?php echo $user['email']; ?></p>
        </header>
    </div>
</section>

<section id="one" class="special">
    <div class="row">
        <div class="12u$">
            <header>
                <?php
                $db = new DAO();
                $db->buscar('avaliacao', NULL);
                $db->where(array('idusuario=' . $_GET['user']));
                $db->ordenacao('ordem', false);

                if ($resultado = $db->executar()) {
                    if ($db->numLinhasAfetadas($resultado) == 0) {
                        echo '<h3> ' . $user['nome'] . ' ainda não avaliou nenhum vinho.</h3> ';
                    } else {
                        if ($db->numLinhasAfetadas($resultado) == 1) {

                            echo '<h3> ' . $user['nome'] . ' avaliou um vinho em nosso site! Confira abaixo:</h3> ';
                        } else {
                            echo '<h3> ' . $user['nome'] . ' avaliou ' . $db->numLinhasAfetadas($resultado) . ' vinhos em nosso site! Confira abaixo:</h3> ';
                        }

                        listarAvaliacoes($resultado, $user);
                    }
                } else {
                    //Erro, melhor redirecionar
                    if (empty($pvinho)) {
                        header("location: index.php");
                    } else {
                        header("showwine.php?id=" . $pvinho);
                    }
                }
                ?>
            </header>
        </div>
    </div>
</section>

<?php
include_once 'footer.php';
