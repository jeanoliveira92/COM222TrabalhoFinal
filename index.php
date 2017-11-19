<html lang="pt-br>
    <head>
        <meta charset="UTF-8">
        <title>VinumWeb</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
        <script src="js/jquery.min.js"></script>
        <script src="js/skel.min.js"></script>
        <script src="js/skel-layers.min.js"></script>
        <script src="js/init.js"></script>
        <noscript>
        <link rel="stylesheet" href="css/skel.css" />
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/style-xlarge.css" />
        </noscript>
        <link href="css/nouislider.min.css" rel="stylesheet">
    </head>
    <body class="landing">
        <?php include_once("navMenu.php"); ?>
        <!-- Banner -->
        <section id="banner">
            <h2>Bem vindo ao VinumWeb</h2>
            <p>Conheça, avalie e descubra tudo sobre vinhos!</p>

            <ul class="actions">
                <li>
                    <a href="#conhecer" class="button big">Quero fazer parte da comunidade!</a>
                </li>
            </ul>
        </section>

        <!-- One -->
        <section id="one" class="wrapper style1 special">
            <div class="container">
                <header class="major">
                    <h2 id="conhecer">Que tal conhecer alguns vinhos?</h2>
                    <p>Informe suas preferências abaixo e mostraremos algumas garrafas!</p>
                </header>
                <div class="row uniform 50%">
                    <div class="4u 12u$(4)">
                        <div class="select-wrapper">
                            <select>
                                <option value="branco">Vinho branco</option>
                                <option value="vermelho">Vinho vermelho</option>
                                <option value="espumante">Vinho espumante</option>
                                <option value="ros">Vinho rosa</option>
                                <option value="sobremesa">Vinho sobremesa</option>
                                <option value="porto">Vinho porto</option>
                            </select>
                        </div>
                    </div>
                    <div class="4u 12u$(4)">
                        <script src="js/nouislider.min.js"></script>
                        <div id="sliderRange"></div>
                        <script>
                            var slider = document.getElementById('sliderRange');

                            noUiSlider.create(slider, {
                                start: [1000, 4000],
                                connect: true,
                                range: {
                                    'min': 0,
                                    'max': 5000
                                }
                            });

                        </script>
                    </div>
                    <div class="4u$ 12u$(4)">
                        <div id="slider-range"></div>
                        <script>
                            var rangeSlider = document.getElementById('slider-range');

                            noUiSlider.create(rangeSlider, {
                                start: [2000],
                                range: {
                                    'min': [1000],
                                    'max': [5000]
                                }
                            });
                        </script>
                    </div>
                </div>
                <br/><br/>
                <ul class="actions">
                    <li>
                        <a href="#" class="button big">Exibir vinhos</a>
                    </li>
                </ul>
            </div>
        </section>

        <!-- Two -->
        <section id="two" class="wrapper style2 special">
            <div class="container">
                <header class="major">
                    <h2>Conheça também alguns tipos de uva</h2>
                    <p>Afinal, as melhores uvas geram os melhores vinhos</p>
                </header>
                <section class="profiles">
                    <div class="row">
                        <section class="3u 6u(medium) 12u$(xsmall) profile">
                            <img src="images/cs.png" alt="" />
                            <h4>Cabernet Sauvignon</h4>
                            <p>Uma das mais usadas em todo mundo</p>

                        </section>
                        <section class="3u 6u$(medium) 12u$(xsmall) profile">
                            <img src="images/noir.png" alt="" />
                            <h4>Pinot noir</h4>
                            <p>Usada na fabricação de vinhos suaves</p>
                        </section>
                        <section class="3u 6u(medium) 12u$(xsmall) profile">
                            <img src="images/char.png" alt="" />
                            <h4>Chardonnay</h4>
                            <p>Usada na produção de vinhos brancos e espumantes</p>
                        </section>
                        <section class="3u$ 6u$(medium) 12u$(xsmall) profile">
                            <img src="images/blanc.png" alt="" />
                            <h4>Sauvignon blanc</h4>
                            <p>Gera vinhos suaves, com boa acidez e sabor discretamente herbáceo</p>
                        </section>
                    </div>
                </section>
                <footer>
                    <p>Ao buscar por vinhos no sistema são listadas também as uvas utilizadas na produção da bebida. Você também pode adicionar os seus vinhos ao sistema e participar da comunidade VinumWeb!</p>
                </footer>
            </div>
        </section>

        <!-- Footer -->
        <footer id="footer">
            <div class="container">
                <div class="row">
                    <div class="8u 12u$(medium)">
                        <ul class="copyright">
                            <li>&copy; VinumWeb. Todos os direitos reservados.</li>
                            <li>Design base: <a href="http://templated.co">Templated</a></li>
                            <li>Densenvolvedores: Jean, Mateus e Adam</li>
                        </ul>
                    </div>
                    <div class="4u$ 12u$(medium)">
                        <ul class="icons">
                            <li>
                                <a class="icon rounded fa-facebook"><span class="label">Facebook</span></a>
                            </li>
                            <li>
                                <a class="icon rounded fa-twitter"><span class="label">Twitter</span></a>
                            </li>
                            <li>
                                <a class="icon rounded fa-google-plus"><span class="label">Google+</span></a>
                            </li>
                            <li>
                                <a class="icon rounded fa-linkedin"><span class="label">LinkedIn</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

    </body>
</html>