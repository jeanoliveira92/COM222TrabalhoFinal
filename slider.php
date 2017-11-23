            <form action="listar.php" name="form" method="GET">
                <div class="row uniform 50%">
                    <div class="2u 12u$(medium)" style="padding-top: 59px;">
                        <div class="select-wrapper">
                            <select class="inputbar" name="tipo">
                                <option value="branco">Vinho branco</option>
                                <option value="vermelho">Vinho vermelho</option>
                                <option value="espumante">Vinho espumante</option>
                                <option value="ros">Vinho rosa</option>
                                <option value="sobremesa">Vinho sobremesa</option>
                                <option value="porto">Vinho porto</option>
                            </select>
                        </div>
                    </div>
                    <div class="6u 12u$(medium)" style="padding-top: 25px;">
                        <div class="12u$">
                            <h4>Valor:</h4>
                        </div>
                        <div id="lower-value"  class="2u" style="position: relative; float: left;padding-right: 30px; padding-bottom: 10px; text-align: right;"></div>
                        <div id="price-range"  class="8u" style="position: relative; float: left;"></div>
                        <div id="upper-value"  class="2u" style="position: relative; float: left;padding-left: 30px; text-align: left;"></div>
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
                                    '1%': 2,'2%': 5,'3%': 7,'4%': 10,'5%': 12,'6%': 15,'7%': 17,'8%': 20,'9%': 22,
                                    '10%': 25,'11%': 27,'12%': 30,'13%': 32,'14%': 35,'15%': 37,'16%': 40,'17%': 42,'18%': 45,'19%': 47,
                                    '20%': 50,'21%': 52,'22%': 55,'23%': 57,'24%': 60,'25%': 62,'26%': 65,'27%': 67,'28%': 70,'29%': 72,
                                    '30%': 75,'31%': 77,'32%': 80,'33%': 82,'34%': 85,'35%': 87,'36%': 90,'37%': 92,'38%': 95,'39%': 97,
                                    '40%': 100, '41%': 110,'42%': 120,'43%': 130,'44%': 140,'45%': 150,'46%': 160,'47%': 170,'48%': 180,'49%': 190,
                                    '50%': 200,'51%': 210,'52%': 220,'53%': 230,'54%': 240,'55%': 250,'56%': 260,'57%': 270,'58%': 280,'59%': 290,
                                    '60%': 300,'61%': 310,'62%': 320,'63%': 330,'64%': 340,'65%': 350,'66%': 360,'67%': 370,'68%': 380,'69%': 390,
                                    '70%': 400,'71%': 410,'72%': 420,'73%': 430,'74%': 440,'75%': 450,'76%': 460,'77%': 470,'78%': 480,'79%': 490,
                                    '80%': 500,'81%': 510,'82%': 520,'83%': 530,'84%': 540,'85%': 550,'86%': 560,'87%': 570,'88%': 580,'89%': 590,
                                    '90%': 600,'91%': 600,'92%': 650,'93%': 700,'94%': 750,'95%': 800,'96%': 900,'97%': 1000,'98%': 1100,'99%': 1200,
                                    'max': 1300
                                }
                            });
                            
                            var pricenodes = [
                                document.getElementById('lower-value'), // 0
                                document.getElementById('upper-value')  // 1
                            ];

                            // Display the slider value and how far the handle moved
                            // from the left edge of the slider.
                            priceSlider.noUiSlider.on('update', function ( values, handle, unencoded, isTap, positions ) {
                                    pricenodes[handle].innerHTML = "R$ " + parseInt(values[handle]);
                            });
                        </script>
                    </div>
                    <div class="4u 12u$(medium)" style="padding-top: 25px;">
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
                                    '73.5%': 3.9, '76%': 4, '78.5%': 4.1, '81%': 4.2, '83.5%': 4.3, '86%': 4.4, '88.5%': 4.5,'91%': 4.6, '93.5%': 4.7, '96%': 4.8, '98.5%': 4.9,
                                    'max': 5
                                }
                            });
                            var ratenodes = [
                                document.getElementById('rate-value'), // 0
                            ];

                            // Display the slider value and how far the handle moved
                            // from the left edge of the slider.
                            rateSlider.noUiSlider.on('update', function ( values, handle, unencoded, isTap, positions ) {
                                    ratenodes[handle].innerHTML = parseFloat(values[handle]).toFixed(1);
                                   // rateSlider.noUiSlider.get();
                            });
                            
                            function sliderValues(){
                                document.getElementById('low').value = priceSlider.noUiSlider.get()[0];
                                document.getElementById('upp').value = priceSlider.noUiSlider.get()[1];
                                document.getElementById('rate').value = rateSlider.noUiSlider.get();
                            }
                        </script>
                    </div>
                </div>
                <br/><br/>
                <ul class="actions">
                    <li>
                        <input type="hidden" id="low" name="low" />
                        <input type="hidden" id="upp" name="upp" />
                        <input type="hidden" id="rate" name="rate" />
                        <button class="button big" onclick="sliderValues();">Exibir vinhos</button>
                    </li>
                </ul>
            </form>