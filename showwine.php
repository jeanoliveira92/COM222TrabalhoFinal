<?php
session_start();

include_once('DAO.php');
$idvinho = $_GET['id'];
$banco = new DAO();
$banco->buscar('vinho', NULL);
$banco->where(array("id=" . $idvinho));
$res = $banco->executar();
if ($banco->numLinhasAfetadas($res) == 0) {
    header("location: index.php");
}
$vinho = $res->fetch_assoc();

function buscaAvaliacoes() {
    $idvinho = $_GET['id'];
    $database = new DAO();
    $database->buscar('avaliacao', NULL);
    $database->where(array("idvinho=" . $idvinho));
    $review = $database->executar();
    if ($database->numLinhasAfetadas($review) == 0) {
        return NULL;
    } else {
        return $review;
    }
}

function buscaUsuario($id) {
    $database = new DAO();
    $database->buscar('usuario', NULL);
    $database->where(array("id=" . $id));
    $usuario = $database->executar();
    if ($database->numLinhasAfetadas($usuario) == 0) {
        return NULL;
    } else {
        return $usuario->fetch_assoc();
    }
}

function exibeHarmonizacoes() {
    $idvinho = $_GET['id'];
    $database = new DAO();
    $database->buscar('harmonizacao', array('alimento'));
    $database->where(array("idvinho=" . $idvinho));
    $harm = $database->executar();

    if ($database->numLinhasAfetadas($harm) == 0) {
        echo "<h4>Nenhuma harmonização com esse vinho cadastrada.</h4>";
    } else {
        $count = $database->numLinhasAfetadas($harm);
        echo '<ul>';
        $alim = $harm->fetch_assoc();
        echo '<li>' . $alim['alimento'] . '</li>';
        while ($alim = $harm->fetch_assoc()) {
            echo '<li>, ' . $alim['alimento'] . '</li>';
        }
        echo '<ul>';
    }
}

$pageTitle = $vinho['nome'];
include_once("header.php");
?>
<style>
    li{
        display: inline;
        font-size: 18px;
    }
</style>
<!-- One -->
<section id="one" class="style2 special">
    <div class="container">
        <header class="major wrapper">
            <h2><?php echo $vinho['nome']; ?></h2>
            <p>Um vinho <?php echo $vinho['tipo']; ?> da região de <?php echo $vinho['regiao']; ?>, <?php echo $vinho['paisorigem']; ?></p>
        </header>
        <div class="row nopadding">
            <div class="4u 12u$(medium)">
                <span class="image fit">
                    <img src="images/rotulos/<?php echo $vinho['rotulo']; ?>" alt="" />
                </span>
            </div>
            <div ader class="8u 12u$(medium) row nopadding">
                <div class="12u$" style="margin-bottom: 20px;">
                    <h3> 
                        <?php
                        if ($vinho['numavaliacoes'] == 0) {
                            echo "O vinho ainda não foi avaliado";
                        } else {
                            echo 'Avaliação média: ' . $vinho['avaliacao'];
                        }
                        ?>
                    </h3>
                </div>

                <div class="12u">
                    <div class="row">
                        <section class="3u 6u(medium) 12u$(xsmall) profile">
                            <img src="images/showico/tipo.png" alt="" />
                            <h4>Estilo</h4>
                            <p><?php echo $vinho['estilo']; ?></p>
                        </section>
                        <section class="3u 6u(medium) 12u$(xsmall) profile">
                            <img src="images/showico/prod.png" alt="" />
                            <h4>Produtor</h4>
                            <p><?php echo $vinho['produtor']; ?></p>
                        </section>
                        <section  class="3u 6u(medium) 12u$(xsmall) profile">
                            <img src="images/showico/preco.png" alt="" />
                            <h4>Preço médio</h4>
                            <p>R$<?php echo $vinho['preco']; ?></p>
                        </section>
                        <section class="3u$ 6u$(medium) 12u$(xsmall) profile">
                            <img src="images/showico/uva.png" alt="" />
                            <h4>Tipo de uva</h4>
                            <p><?php echo $vinho['tipouva']; ?></p>
                        </section>
                    </div>
                </div>

                <div class="12u">
                    <section>
                        <h2>Alimentos harmonizantes:</h2>
                        <?php
                        exibeHarmonizacoes();
                        ?>
                    </section>  
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container row">
        <div class="12u">
             <section class="12u" style="text-align: center;">
                <h2>Avaliações:</h2>
            </section>
        </div>
        <div class="12u$">
            <?php
            $avaliacoes = buscaAvaliacoes();
            if ($avaliacoes != NULL) {
                while ($av = $avaliacoes->fetch_assoc()) {
                    $pessoa = buscaUsuario($av['idusuario']);
                    if ($pessoa !== NULL) {
                        echo '<blockquote><h4><a href="">' . $pessoa['nome'] . '</a> avaliou em ' . $av['nota'] . ':</h4>';
                        echo '"' . $av['opiniao'] . '"</blockquote>';
                    }
                }
            } else {
                echo "<h4>Esse vinho ainda não foi avaliado.</h4>";
            }
            ?>
        </div>
    </div>
</div>
</section>
<?php
if (isset($_SESSION['nome']) && isset($_SESSION['id'])) {
    include_once('avaliacao.php');
}
?>
</body>
</html>

