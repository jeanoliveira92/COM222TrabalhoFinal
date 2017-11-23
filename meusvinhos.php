<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Vw | Meus vinhos</title>
    </head>
    <body>
    <center>
        <?php
        include_once('DAO.php');

        //Parametros necessarios
        $id = $_SESSION['id'];
        $consulta = 'select * from vinho where id in (select idvinho from vinhos_usuario where id=' . $id . ')';

        //Buscar vinhos do cara no banco
        $banco = new DAO();
        $banco->setSQL($consulta);
        $res = $banco->executar();

        if (mysqli_num_rows($res) == 0) {
            echo "<h3>Não há nenhum vinho em sua lista pessoal!</h3>";
        } else {
            echo "<h3>Você possui " . mysqli_num_rows($res) . " em sua lista pessoal!</h3>";
            echo "<table>";
            while ($vinho = $res->fetch_assoc()) {

                echo "<tr>";
                //Rotulo a esquerda
                echo "<td>";
                echo '<a href="vervinho.php?id=' . $vinho['id'] . '&usr=' . $id . '>
									<img scr="images/' . $vinho['rotulo'] . '"/>
								  </a>';
                echo "</td>";
                //Dados do vinho a direita
                echo "<td>";
                echo '<h4>' . $vinho['produtor'] . '</h4>';
                echo '<h4>' . $vinho['nome'] . '</h4>';
                echo '<p>' . $vinho['paisorigem'] . ' - ' . $vinho['regiao'] . '</p>';
                echo '<p> Média de avaliações: ' . $vinho['avaliacao'] . ' | 
									  Média de preços: ' . $vinho['preco'] . '
								 </p>';
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        ?>
    </center>
    <?php
    include_once 'footer';
    