<?php
session_start();
//include_once 'session.php';
include_once 'listar_Dados.php';

$pageTitle = "Vw | Lista de Vinhos";
include_once("header.php");
header('Content-type: text/html; charset=ISO8859-1');
?>
<style>
    .row>*{
        padding: 0px 0 0 0.5em;
    }
</style>
<!-- Main -->
<section id="main" class="wrapper">
    <div class="container-full nomargin">
        <section>
            <div class="row">
                <div class="3u 12u$(Medium) painel">
                    <form action="listar_Autocompletar.php" method="GET">
                        <div class="12u$ row" >
                            <div class="12u$">
                                <h3>Tipo de vinho</h3>
                            </div>
                            <div class="4u 6u(medium)">
                                <input type="checkbox" id="vermelho" name="tipo[]" value="vermelho" <?php if ($_GET['tipo'] == 'vermelho') echo "checked"; ?>>
                                <label for="vermelho" class="checklabel">Vermelho</label>
                            </div>

                            <div class="4u 6u(medium)">
                                <input type="checkbox" id="branco" name="tipo[]" value="branco" <?php if ($_GET['tipo'] == 'branco') echo "checked"; ?>>
                                <label for="branco" class="checklabel">Branco</label>
                            </div>
                            <div class="4u 6u(medium)">
                                <input type="checkbox" id="rosa" name="tipo[]" value="rosa" <?php if ($_GET['tipo'] == 'rosa') echo "checked"; ?>>
                                <label for="rosa" class="checklabel">Rosa</label>
                            </div>
                            <div class="4u 6u(medium)">
                                <input type="checkbox" id="espumante" name="tipo[]" value="espumante" <?php if ($_GET['tipo'] == 'espumante') echo "checked"; ?>>
                                <label for="espumante" class="checklabel">Espumante</label>
                            </div>
                            <div class="4u 6u(medium)">
                                <input type="checkbox" id="porto" name="tipo[]" value="porto" <?php if ($_GET['tipo'] == 'porto') echo "checked"; ?>>
                                <label for="porto" class="checklabel">Porto</label>
                            </div>
                            <div class="4u 6u(medium)">
                                <input type="checkbox" id="sobremesa" name="tipo[]" value="sobremesa" <?php if ($_GET['tipo'] == 'sobremesa') echo "checked"; ?>>
                                <label for="sobremesa" class="checklabel">Sobremesa</label>
                            </div>
                        </div>
                        <div class="12u$ marginlabel">
                            <h3>Intervalo de preço</h3>
                            <script src="js/nouislider.min.js" id="intervalo" ></script>
                            <link href="css/nouislider.min.css" rel="stylesheet">
                            <div id="lower-value"  style="position: relative; float: left; width: 20%; padding-bottom: 10px; text-align: left;"></div>
                            <div id="price-range"  style="position: relative; float: left; width: 55%; "></div>
                            <div id="upper-value"  style="position: relative; float: left; width: 25%; padding-bottom: 10px; text-align: right;"></div>

                            <input type="hidden" id="low" name="low" />
                            <input type="hidden" id="upp" name="upp" />
                            <script>
                                var priceSlider = document.getElementById('price-range');
                                noUiSlider.create(priceSlider, {
                                    start: [25, 100],
                                    connect: true,
                                    snap: true, // salto a salta elemento
                                    range: {
                                        'min': 0,
                                        // 0% - 49% [0-100]
                                        '1%': 2, '2%': 5, '3%': 7, '4%': 10, '5%': 12, '6%': 15, '7%': 17, '8%': 20, '9%': 22,
                                        '10%': 25, '11%': 27, '12%': 30, '13%': 32, '14%': 35, '15%': 37, '16%': 40, '17%': 42, '18%': 45, '19%': 47,
                                        '20%': 50, '21%': 52, '22%': 55, '23%': 57, '24%': 60, '25%': 62, '26%': 65, '27%': 67, '28%': 70, '29%': 72,
                                        '30%': 75, '31%': 77, '32%': 80, '33%': 82, '34%': 85, '35%': 87, '36%': 90, '37%': 92, '38%': 95, '39%': 97,
                                        '40%': 100, '41%': 110, '42%': 120, '43%': 130, '44%': 140, '45%': 150, '46%': 160, '47%': 170, '48%': 180, '49%': 190,
                                        '50%': 200, '51%': 210, '52%': 220, '53%': 230, '54%': 240, '55%': 250, '56%': 260, '57%': 270, '58%': 280, '59%': 290,
                                        '60%': 300, '61%': 310, '62%': 320, '63%': 330, '64%': 340, '65%': 350, '66%': 360, '67%': 370, '68%': 380, '69%': 390,
                                        '70%': 400, '71%': 410, '72%': 420, '73%': 430, '74%': 440, '75%': 450, '76%': 460, '77%': 470, '78%': 480, '79%': 490,
                                        '80%': 500, '81%': 510, '82%': 520, '83%': 530, '84%': 540, '85%': 550, '86%': 560, '87%': 570, '88%': 580, '89%': 590,
                                        '90%': 600, '91%': 600, '92%': 650, '93%': 700, '94%': 750, '95%': 800, '96%': 900, '97%': 1000, '98%': 1100, '99%': 1200,
                                        'max': 1300
                                    }
                                });
                                var pricenodes = [
                                    document.getElementById('lower-value'), // 0
                                    document.getElementById('upper-value')  // 1
                                ];
                                // Display the slider value and how far the handle moved
                                // from the left edge of the slider.
                                priceSlider.noUiSlider.on('update', function (values, handle, unencoded, isTap, positions) {
                                    pricenodes[handle].innerHTML = "R$ " + parseInt(values[handle]);
                                    if (handle == 0) {
                                        document.getElementById('low').value = priceSlider.noUiSlider.get()[0];
                                    } else if (handle == 1) {
                                        document.getElementById('upp').value = priceSlider.noUiSlider.get()[1];
                                    }
                                });
                            </script>
                        </div>
                        <input type="hidden" id="rate" name="rate" />
                        <div class="12u$ marginlabel">
                            <h3>Avaliação dos usuários</h3>
                            <div id="rate-value" style="position: relative; float: left; width: 20%; padding-bottom: 10px; text-align: center;">1.0</div>
                            <div id="rate-range" style="position: relative; float: left; width: 55%; "></div>
                            <div style="position: relative; float: left;padding-left: 30px; width: 25%; padding-bottom: 10px; text-align: center">5.0</div>
                            <script>
                                var rateSlider = document.getElementById('rate-range');
                                noUiSlider.create(rateSlider, {
                                    start: [3],
                                    snap: true, // salto a salta elemento
                                    range: {
                                        'min': 1,
                                        '3.5%': 1.1, '6%': 1.2, '8.5%': 1.3, '11%': 1.4, '13.5%': 1.5, '16%': 1.6, '18.5%': 1.7,
                                        '21%': 1.8, '23.5%': 1.9, '26%': 2, '28.5%': 2.1, '31%': 2.2, '33.5%': 2.3, '36%': 2.4,
                                        '38.5%': 2.5, '41%': 2.6, '43.5%': 2.7, '46%': 2.8, '48.5%': 2.9, '51%': 3, '53.5%': 3.1,
                                        '56%': 3.2, '58.5%': 3.3, '61%': 3.4, '63.5%': 3.5, '66%': 3.6, '68.5%': 3.7, '71%': 3.8,
                                        '73.5%': 3.9, '76%': 4, '78.5%': 4.1, '81%': 4.2, '83.5%': 4.3, '86%': 4.4, '88.5%': 4.5, '91%': 4.6, '93.5%': 4.7, '96%': 4.8, '98.5%': 4.9,
                                        'max': 5
                                    }
                                });
                                var ratenodes = [
                                    document.getElementById('rate-value'), // 0
                                ];
                                // Display the slider value and how far the handle moved
                                // from the left edge of the slider.
                                rateSlider.noUiSlider.on('update', function (values, handle, unencoded, isTap, positions) {
                                    ratenodes[handle].innerHTML = parseFloat(values[handle]).toFixed(1);
                                    // rateSlider.noUiSlider.get();
                                    document.getElementById('rate').value = rateSlider.noUiSlider.get();
                                });

                                // Pega os valores passados por GET e seta nos sliders
                                priceSlider.noUiSlider.set([<?php echo $_GET['low'] . "," . $_GET['upp']; ?>]);
                                rateSlider.noUiSlider.set(<?php echo $_GET['rate']; ?>);
                            </script>
                            <?php ?>
                        </div>
                        <div class="12u$ row marginlabel">
                            <div class="12u$">
                                <h3>Uvas</h3>
                            </div>
                            <?php
                            $banco->setSQL("SELECT DISTINCT tipouva from vinho order by tipouva asc;");
                            $dado = $banco->executar();

                            while ($row = $dado->fetch_assoc()) {
                                echo "<div class='4u 6u(medium)'>
                                        <input type='checkbox' id='" . $row['tipouva'] . "' name='uva[]' value='" . $row['tipouva'] . "'>
                                        <label for='" . $row['tipouva'] . "' class='checklabel'>" . $row['tipouva'] . "</label>
                                    </div>";
                            }
                            ?>
                        </div>

                        <div class="12u$ row marginlabel">
                            <div class="12u$">
                                <h3>Países</h3>
                            </div>
                            <?php
                            $banco->setSQL("SELECT DISTINCT paisorigem from vinho order by paisorigem asc;");
                            $dado = $banco->executar();

                            while ($row = $dado->fetch_assoc()) {
                                echo "<div class='4u 6u(medium)'>
                                        <input type='checkbox' id='" . $row['paisorigem'] . "' value='" . $row['paisorigem'] . "'>
                                        <label for='" . $row['paisorigem'] . "' class='checklabel'>" . $row['paisorigem'] . "</label>
                                    </div>";
                            }
                            ?>
                        </div>

                        <div class="12u$ row marginlabel">
                            <div class="12u$">
                                <h3>Estilos de vinho</h3>
                            </div>
                            <?php
                            $banco->setSQL("SELECT DISTINCT estilo from vinho order by estilo asc;");
                            $dado = $banco->executar();

                            while ($row = $dado->fetch_assoc()) {
                                echo "<div class='4u 6u(medium)'>
                                        <input type='checkbox' id='" . $row['estilo'] . "' name='estilo[]' value='" . $row['estilo'] . "'>
                                        <label for='" . $row['estilo'] . "' class='checklabel'>" . $row['estilo'] . "</label>
                                    </div>";
                            }
                            ?>
                        </div>

                        <div class="12u$ row marginlabel">
                            <div class="12u$">
                                <h3>Harmonização com comidas</h3>
                            </div>
                            <?php
                            $banco->setSQL("SELECT DISTINCT alimento from harmonizacao order by alimento asc;");
                            $dado = $banco->executar();

                            while ($row = $dado->fetch_assoc()) {
                                echo "<div class='4u 6u(medium)'>
                                        <input type='checkbox' id='" . $row['alimento'] . "' name='alimento[]' value='" . $row['alimento'] . "'>
                                        <label for='" . $row['alimento'] . "' class='checklabel'>" . $row['alimento'] . "</label>
                                    </div>";
                            }
                            ?>
                        </div>
                        <!-- <input type="submit" value="eita nois"> -->
                    </form>
                </div>

                <!-- Exbição dos vinhos > -->
                <div class="9u 6u$(medium) row" id="vinhos">
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="6u row showvinho">
                            <a href="showwine.php?id=<?php echo $row['id'] ?>">
                                <div class="showvinhoimg" style="background-image: URL(images/rotulos/<?php echo $row['rotulo'] ?>)">
                                </div>
                            </a>
                            <div class="divcontent">
                                <a href="showwine.php?id=<?php echo $row['id'] ?>">
                                    <ul class="ultitulo">
                                        <li><?php echo $row['produtor'] ?></li>
                                        <li><span><?php echo $row['nome'] ?></span></a></li>
                                    </ul>                         
                                </a>
                                <ul class="reg" style="margin-left: 8px;">
                                    <li><?php echo $row['regiao'] ?></li>
                                    <li><span><br></span></li>
                                    <li><?php echo $row['paisorigem'] ?></li>
                                </ul>

                                <div class="average">
                                    <div class="ratingbottom">
                                        <p>Avaliação Média</p>
                                        <ul class="reg2 ">
                                            <li><span><?php echo number_format($row['avaliacao'], 2, '.', '') ?> </span></li>
                                            <li>( <?php echo $row['numavaliacoes']?> )</li>
                                        </ul>
                                    </div>
                                    <div class="ratingbottom">
                                        <p>Preço Medio</p>
                                        <span>R$ <?php
                                            echo number_format($row['preco'], 2, '.', '');
                                            ;
                                            ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
    </div>
</section>
</div>
</section>
<script type="text/javascript">

    // Dispara a funcao atualizar dados quando qualquer check box muda de estado
    $('input').change(trocaLista);
    // Dispara quando o mouse é disclicado sobre um dos botoes de controle do slider
    $('.noUi-handle').mouseup(trocaLista);
    // Funcao para atualizar dados na tela
    function trocaLista() {

        $('form').submit(function () {
            var dados = $(this).serialize();
            $.ajax({
                url: 'listar_Autocompletar.php',
                method: 'get',
                dataType: 'html',
                data: dados,
                success: function (data) {
                    $('#vinhos').empty().html(data);
                }
            });
            return false;
        });
        // Submete os dados do formulario
        $('form').trigger('submit');
    }
    ;
</script>
<?php
include_once 'footer.php';
