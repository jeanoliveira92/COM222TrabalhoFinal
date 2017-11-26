<?php

include_once 'listar_Dados.php';

while ($row = $result->fetch_assoc()) {
echo "
    <div class = '6u 12u$(medium) row showvinho'>
        <a href = 'showwine.php?id=" .$row['id'] . "'>
            <div class = 'showvinhoimg' style = 'background-image: URL(images/rotulos/" .$row['rotulo'] . ")'>
            </div>
        </a>
        <div class = 'divcontent'>
            <a href = 'showwine.php?id=" .$row['id'] . "'>
                <ul class = 'ultitulo'>
                    <li>" .$row['produtor'] . "</li>
                    <li><span>" .$row['nome'] . "</span></a></li>
                </ul>                         
            </a>
            <ul class='reg'>
                <li>" .$row['paisorigem'] . "</li>
                <li><span>.</span>  </li>
                <li>" .$row['regiao'] . "</li>
            </ul>

            <div class='average'>
                <div class='ratingbottom'>
                    <p>Avaliação Média</p>
                    <ul class='reg2 '>
                        <li><span>" .$row['avaliacao'] . "</span></li>
                        <li></li>
                    </ul>
                </div>
                <div class='ratingbottom'>
                    <p>Preço Medio</p>
                    <span>R$ " . number_format($row['preco'], 2, '.', '') ."
                    </span>
            </div>
        </div>
    </div>
</div>";
}