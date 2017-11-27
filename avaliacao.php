<!-- JEAN, O VALOR DO SLIDER DEVE IR PRA PRÓXIMA PAGINA COM NOME NOTA, o restante está funcional -->
<section id="three" class="wrapper style2 special">
    <div class="container">
        <header class="major">
            <h2>Avalie esse vinho</h2>
            <p>A sua avaliação será de grande importância para a comunidade VinumWeb</p>
        </header>
    </div>
    <div class="container 30%">
        <form action="avaliar.php" method="POST">
            <div class="row uniform">
                <div class="12u$">
                    <div class="row uniform">
                        <div class="12u$">
                            <script src="js/nouislider.min.js"></script>
                            <link href="css/nouislider.min.css" rel="stylesheet">
                            <div class="12u 12u$(medium)" style="padding-top: 25px;">
                                <div class="12u$">
                                    <h4>Nota:</h4>
                                </div>
                                <div id="rate-value" class="2u" style="position: relative; float: left;padding-bottom: 10px;">1000</div>
                                <div id="rate-range" class="8u" style="position: relative; float: left;"></div>
                                <div class="2u" style="position: relative; float: left;padding-left: 30px">5.0</div>
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
                                        document.getElementById('rate').value = rateSlider.noUiSlider.get();
                                    }
                                </script>
                            </div>
                            <div class="12u$">
                                <textarea name="opiniao" id="opiniao" placeholder="Opinião" rows="6"></textarea>
                            </div>
                            <input type="hidden" name="idvinho" id="idvinho" value="<?php echo $_GET['id'] ?>">
                            <input type="hidden" name="rate" id="rate">
                            <div class="12u$" style="padding-top: 40px;">
                                <ul class="actions">
                                    <li><input value="Avaliar bebida" class="special big" type="submit" onclick="sliderValues();"></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                </section>