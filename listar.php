<?php
session_start();
include_once 'session.php';
include_once 'DAO.php';
$banco = new DAO();
?>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Listar vinhos</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
        <script src="js/jquery.js"></script>
        <script src="js/skel.min.js"></script>
        <!-- conflito
        <script src="js/skel-layers.min.js"></script>
        -->
        <noscript>
        <link rel="stylesheet" href="css/skel.css" />
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/style-xlarge.css" />
        </noscript>

        <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/themes/start/jquery-ui.css" />
        <link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" />
        <link rel="stylesheet" type="text/css" href="css/jquery.tagsinput.min.css" />

        <script type="text/javascript" src="js/jquery.autocomplete.js"></script>
        <script type="text/javascript" src="js/jquery.tagsinput.min.js"></script>
        <style>
            .row>*{
                padding: 0px 0 0 0.5em;
            }
        </style>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#nome").autocomplete("cadastro_vinho_Autocompletar.php", {
                    width: 592,
                    selectFirst: false
                });
            });
        </script>

        <script src="js/init.js"></script>

    </head>
    <body>
        <?php include_once("navMenu.php"); ?>
        <!-- Main -->
        <section id="main" class="wrapper">
            <div class="container-full nomargin">
                <section>
                    <div class="row">
                        <div class="4u 12u$(Medium)">
                            <form action="cadastro_vinho.php" enctype="multipart/form-data" method="POST">
                                <div class="12u$ row">
                                    <div class="12u$">
                                        <h3>Tipo de vinho</h3>
                                    </div>
                                    <div class="4u 12u$(medium)">
                                        <input type="checkbox" id="vermelho" name="tipo[]" cheked="">
                                        <label for="vermelho" class="checklabel">Vermelho</label>
                                    </div>

                                    <div class="4u 12u$(medium)">
                                        <input type="checkbox" id="branco" name="tipo[]" value="branco">
                                        <label for="branco" class="checklabel">Branco</label>
                                    </div>
                                    <div class="4u$ 12u$(medium)">
                                        <input type="checkbox" id="rosa" name="tipo[]" value="rosa">
                                        <label for="rosa" class="checklabel">Rosa</label>
                                    </div>
                                    <div class="4u 12u$(medium)">
                                        <input type="checkbox" id="espumante" name="tipo[]" value="espumante">
                                        <label for="espumante" class="checklabel">Espumante</label>
                                    </div>
                                    <div class="4u 12u$(medium)">
                                        <input type="checkbox" id="porto" name="tipo[]" value="porto">
                                        <label for="porto" class="checklabel">Porto</label>
                                    </div>
                                    <div class="4u$ 12u$(medium)">
                                        <input type="checkbox" id="sobremesa" name="tipo[]" value="sobremesa">
                                        <label for="sobremesa" class="checklabel">Sobremesa</label>
                                    </div>
                                </div>
                                <div class="12u$ marginlabel">
                                    <h3>Intervalo de preço</h3>
                                    <script src="js/nouislider.min.js" id="intervalo" ></script>
                                    <div id="lower-value"  class="3u" style="position: relative; float: left;padding-right: 30px; padding-bottom: 10px; text-align: right;"></div>
                                    <div id="price-range"  class="6u" style="position: relative; float: left;"></div>
                                    <div id="upper-value"  class="3u" style="position: relative; float: left;padding-left: 30px; text-align: left;"></div>
                                    <script src="js/nouislider.min.js"></script>
                                    <link href="css/nouislider.min.css" rel="stylesheet">
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
            });
                                    </script>
                                </div>

                                <div class="12u$ marginlabel">
                                    <h3>Avaliação dos usuários</h3>
                                    <div id="rate-value" class="3u" style="position: relative; float: left;padding-bottom: 10px; text-align: center;">1000</div>
                                    <div id="rate-range" class="6u" style="position: relative; float: left;"></div>
                                    <div class="3u" style="position: relative; float: left;padding-left: 30px; text-align: center">5.0</div>
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
                                        });

                                        function sliderValues() {
                                            document.getElementById('low').value = priceSlider.noUiSlider.get()[0];
                                            document.getElementById('upp').value = priceSlider.noUiSlider.get()[1];
                                            document.getElementById('rate').value = rateSlider.noUiSlider.get();
                                        }
                                    </script>
                                </div>

                                <div class="12u$ row marginlabel">
                                    <div class="12u$">
                                        <h3>Uvas</h3>
                                    </div>
                                    <?php
                                    $banco->setSQL("SELECT DISTINCT tipouva from vinho order by tipouva asc;");
                                    $dado = $banco->executar();

                                    while ($row = $dado->fetch_assoc()) {
                                        echo "<div class='4u 12u$(medium)'>
                                        <input type='checkbox' id='" . $row['tipouva'] . "' name='uva[]'>
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
                                        echo "<div class='4u 12u$(medium)'>
                                        <input type='checkbox' id='" . $row['paisorigem'] . "' name='pais[]'>
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
                                        echo "<div class='4u 12u$(medium)'>
                                        <input type='checkbox' id='" . $row['estilo'] . "' name='estilo[]'>
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
                                        echo "<div class='4u 12u$(medium)'>
                                        <input type='checkbox' id='" . $row['alimento'] . "' name='alimento[]'>
                                        <label for='" . $row['alimento'] . "' class='checklabel'>" . $row['alimento'] . "</label>
                                    </div>";
                                    }
                                    ?>
                                </div>

                            </form>
                        </div>

                        <!-- Exbição dos vinhos > -->
                        <div class="8u 12u$(medium) row">
                            <div class="12u row showvinho">
                                <div style="background-image: URL(images/rotulos/vinno.jpg)">
                                    
                                </div>  
                                <div>
                                    <ul>
                                        <li>Caballo Loco</li>
                                        <li><span>Grand Cru Apalta 2012</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </section>

        <?php
        include_once 'footer.php';
        