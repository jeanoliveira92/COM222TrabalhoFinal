<?php
session_start();
$pageTitle = "Vw | My Wines";

include_once 'session.php';
include_once 'header.php';
include_once 'DAO.php';

$id = $_SESSION['id'];
$consulta = 'select * from vinho where id in (select idvinho from vinhos_usuario where idusuario=' . $id . ')';

//Buscar vinhos do cara no banco
$banco = new DAO();
$banco->setSQL($consulta);
$res = $banco->executar();


header('Content-type: text/html; charset=ISO8859-1');
?>
<section id="main" class="wrapper">
    <div class="container-full nomargin">

        <?php
        if (mysqli_num_rows($res) == 0) {
            ?>
            <header class="major">
                <h2>My Wines</h2>
                <p>N�o h� nenhum vinho em sua lista pessoal!</p>
            </header>  
            <?php
        } else {
            ?>
            <header class="major">
                <h2>My Wines</h2>
                <p>Voc� possui <?php echo mysqli_num_rows($res); ?> vinho(s) em sua lista pessoal!</p>
            </header>   
            <div class="row">
                <?php
                while ($row = $res->fetch_assoc()) {
                    echo "
    <div class = '6u 12u$(medium) row showvinho' style='margin-bottom: 15px !important;'>
        <a href = 'showwine.php?id=" . $row['id'] . "'>
            <div class = 'showvinhoimg' style = 'background-image: URL(images/rotulos/" . $row['rotulo'] . ")'>
            </div>
        </a>
        <div class = 'divcontent'>
            <a href = 'showwine.php?id=" . $row['id'] . "'>
                <ul class = 'ultitulo'>
                    <li>" . $row['produtor'] . "</li>
                    <li><span>" . $row['nome'] . "</span></a></li>
                </ul>                         
            </a>
            <ul class='reg' style='margin-left: 8px;'>
                <li>" . $row['paisorigem'] . "</li>
                <li><span>.</span>  </li>
                <li>" . $row['regiao'] . "</li>
            </ul>

            <div class='average' style='padding-left: 35px;'>
                <div class='ratingbottom'>
                    <p>Avalia��o M�dia</p>
                    <ul class='reg2 '>
                        <li><span>" . number_format($row['avaliacao'], 2, '.', '') . "</span></li>
                        <li>( " . $row['numavaliacoes'] . " avalia��es )</li>
                    </ul>
                </div>
                <div class='ratingbottom'>
                    <p>Pre�o Medio</p>
                    <span>R$ " . number_format($row['preco'], 2, '.', '') . "
                    </span>
            </div>
        </div>
    </div>
</div>";
                }
            }
            ?>
        </div>
        <header class="major wrapper">
        </header>
    </div>
</section>


<?php
include_once 'footer.php';
