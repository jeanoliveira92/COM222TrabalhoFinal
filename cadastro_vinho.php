<?php
session_start();
include_once 'session.php';
// Titulo da Pagina
$pageTitle = "Cadastre um novo vinho";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    function adicionarHarmonizacao($banco, $harmonizacao, $id) {
        if ($harmonizacao !== '' && $harmonizacao !== null) {
            //dividir a String de dados
            if ($lista = explode(",", $harmonizacao)) {
                //Para cada alimento harmonizante cadastrado, adicionar na tabela harmonizacao
                foreach ($lista as $alimento) {
                    $banco->cadastro('harmonizacao', array('idVinho' => $id, 'alimento' => $alimento));
                    $banco->executar();
                }
            }
        }
    }

    include_once('DAO.php');
    $msg;
    $Sucess;

    //Obter nome,alimentos que harmonizam e preço do formulario
    $nome = addslashes($_POST['nome']);
    $harmonizacao = addslashes($_POST['harmonizacao']);
    $preco = addslashes($_POST['preco']);

    //Obter demais dados do vinho
    $produtor = addslashes($_POST['produtor']);
    $pais = addslashes($_POST['pais']);
    $regiao = addslashes($_POST['regiao']);
    $tipouva = addslashes($_POST['tipouva']);
    $estilo = addslashes($_POST['estilo']);
    $tipo = addslashes($_POST['tipo']);
    $rotulo = $_FILES['rotulo'];

    // Verifica campos vazios
    if (empty($nome)) {
        $msg = "Campo nome em branco";
        $erro = 1;
    } else if (empty($harmonizacao)) {
        $msg = "Campo harmonização em branco";
        $erro = 1;
    } else if (empty($preco)) {
        $msg = "Campo preco vazio";
        // Verifica por caracteres especiais 
    } else if (substr_count($nome, "\\")) {
        $msg = "Campo nome invalido. Contém: aspas simples/duplas, barras ou valor NULL";
        $erro = 1;
    } else if (substr_count($harmonizacao, "\\")) {
        $msg = "Campo harmonizacao invalido. Contém: aspas simples/duplas, barras ou valor NULL";
        $erro = 1;
    } else if (substr_count($preco, "\\")) {
        $msg = "Campo preco invalido. Contém: aspas simples/duplas, barras ou valor NULL";
        $erro = 1;

        // Entra se tudo válido
    } else {
        //Criar DAO
        $banco = new DAO();

        // remove o ponto no preço. Para não converter em decimal ao salvar no banco
        $preco = str_replace(".", "", $preco);

        //Verificar se o vinho ja esta cadastrado no banco
        $banco->buscar('vinho', null);
        $banco->where(array("nome='" . $nome . "'"));
        $resultado = $banco->executar();

        //Caso nao foi, cadastrar
        if (mysqli_num_rows($resultado) == 0) {
            // Verifica campos vazios
            if (empty($produtor)) {
                $msg = "Campo produtor em branco";
            } else if (empty($pais)) {
                $msg = "Campo país em branco";
            } else if (empty($regiao)) {
                $msg = "Campo região em branco";
            } else if (empty($tipouva)) {
                $msg = "Campo tipo de uva em branco";
            } else if (empty($estilo)) {
                $msg = "Campo estilo em branco";
            } else if (empty($tipo)) {
                $msg = "Campo tipo em branco";
                // Verifica por caracteres especiais 
            } else if (substr_count($produtor, "\\")) {
                $msg = "Campo produtor invalido. Contém: aspas simples/duplas, barras ou valor NULL";
            } else if (substr_count($pais, "\\")) {
                $msg = "Campo pais invalido. Contém: aspas simples/duplas, barras ou valor NULL";
            } else if (substr_count($regiao, "\\")) {
                $msg = "Campo região invalido. Contém: aspas simples/duplas, barras ou valor NULL";
            } else if (substr_count($tipouva, "\\")) {
                $msg = "Campo Tipo da uva invalido. Contém: aspas simples/duplas, barras ou valor NULL";
            } else if (substr_count($estilo, "\\")) {
                $msg = "Campo estilo invalido. Contém: aspas simples/duplas, barras ou valor NULL";
            } else if (substr_count($regiao, "\\")) {
                $msg = "Campo região invalido. Contém: aspas simples/duplas, barras ou valor NULL";
                // Validar se carregou uma imagem
            } else if (empty($rotulo["name"])) {
                $msg = "Não há imagem carregada";
                //Validar se é uma imagem
            } else if (!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $rotulo["type"])) {
                $msg = "Arquivo carregado nao é uma imagem";
                // Realiza o cadastro
            } else {
                // Pega extensão da imagem
                preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $rotulo["name"], $ext);

                // Gera um nome único para a imagem
                $nome_imagem = md5(uniqid(time())) . "." . $ext[1];

                // Caminho de onde ficará a imagem
                $caminho_imagem = "images/rotulos/" . $nome_imagem;

                // Faz o upload da imagem para seu respectivo caminho
                move_uploaded_file($rotulo["tmp_name"], $caminho_imagem);

                //Gerar array pares atributo=>valor
                $dados = array('nome' => $nome,
                    'produtor' => $produtor,
                    'preco' => $preco,
                    'paisorigem' => $pais,
                    'regiao' => $regiao,
                    'tipouva' => $tipouva,
                    'estilo' => $estilo,
                    'tipo' => $tipo,
                    'rotulo' => $nome_imagem);

                //Inserir no banco
                $banco->cadastro('vinho', $dados);

                if ($banco->executar()) {
                    //Buscar id desse novo vinho cadastrado
                    $banco->buscar('vinho', null);
                    $banco->where(array("nome='" . $nome . "'"));
                    $resultado = $banco->executar();

                    $vinho = mysqli_fetch_assoc($resultado);

                    //Cadastrar harmonizacoes com ele
                    adicionarHarmonizacao($banco, $harmonizacao, $vinho['id']);

                    //Pegar ID do usuário e cadastrar em MyWines
                    $user = $_SESSION['id'];
                    $id = $vinho['id'];

                    $banco->cadastro('vinhos_usuario', array('idvinho' => $id, 'idusuario' => $user));
                    $banco->executar();

                    //Sucesso no cadastro do vinho
                    $Sucess = "O novo vinho foi cadastrado com sucesso!";
                }
            }
        } else {
            //Como o vinho já é cadastrado, adicionar apenas as harmonizações
            $vinho = mysqli_fetch_assoc($resultado);
            adicionarHarmonizacao($banco, $harmonizacao, $vinho['id']);

            //Validar se o usuario informou novo preco
            if (!($preco == NULL || $preco == "")) {
                //Adicionar vinho do usuario
                $usr = $_SESSION['id'];
                $idvinho = $vinho['id'];
                $banco->cadastro('vinhos_usuario', array('idvinho' => $idvinho, 'idusuario' => $usr));

                if ($res = $banco->executar()) {
                    // vinho adicionado a mywines
                    $erro = "Falha ao adicionar vinho a sua lista pessoal!";

                    //Calcular e definir media de preco do vinho
                    $consulta = 'CALL atualiza_preco(' . $preco . ',' . $vinho['id'] . ')';
                    $banco->setSQL($consulta);
                    $banco->executar();
                } else {
                    //Erro ao adicionar
                    //Sucesso no cadastro do vinho
                    $Sucess = "O vinho foi adicionado a sua lista pessoal!";
                }
            }
        }
    }
}
?>

<?php include_once("header.php"); ?>
<!-- Main -->
<section id="main" class="wrapper">
    <div class="container">
        <header class="major">
            <h2>Cadastrar Vinho</h2>
            <p>Informe os dados do seu vinho</p>
        </header>
        <section>
            <form action="cadastro_vinho.php" enctype="multipart/form-data" method="POST">
                <div class="row uniform 50%">
                    <div class="12u$">
                        <?php if (isset($msg)) { ?>
                            <div class="alert-danger" role="alert"><?php echo $msg ?></div>
                        <?php } else if (isset($Sucess)) { ?>
                            <div class="alert-success" role="alert"><?php echo $Sucess ?></div>
                        <?php } ?>
                    </div>
                    <div class="6u 12u$(medium)">
                        <label for="nome">Nome:</label>
                        <input type="text" name="nome" id="nome" placeholder="Nome do vinho"  <?php if (isset($msg)) echo "value='" . $nome . "'" ?>>
                    </div>

                    <div class="6u$ 12u$(medium)">
                        <label for="produtor">Produtor:</label>
                        <input type="text" min="4" name="produtor" id="produtor" placeholder="Nome do produtor" <?php if (isset($msg)) echo "value='" . $produtor . "'" ?>>
                    </div>
                    <div class="6u 12u$(medium)">
                        <label for="pais">Pais de origem:</label>
                        <input type="text" name="pais" min="4" id="pais" placeholder="País de origem" <?php if (isset($msg)) echo "value='" . $pais . "'" ?>>
                    </div>
                    <div class="6u$ 12u$(medium)">
                        <label for="regiao">Região de origem:</label>
                        <input type="text" name="regiao" min="4" id="regiao" placeholder="Região" <?php if (isset($msg)) echo "value='" . $regiao . "'" ?>>
                    </div>
                    <div class="4u 12u$(medium)">
                        <label for="tipouva">Tipo de uva:</label>
                        <input type="text" name="tipouva" min="4" id="tipouva" placeholder="Tipo de uva" <?php if (isset($msg)) echo "value='" . $tipouva . "'" ?>>
                    </div>
                    <div class="4u 12u$(medium)">
                        <label for="estilo">Estilo:</label>
                        <input type="text" id="estilo" min="4" name="estilo" placeholder="Estilo do vinho" <?php if (isset($msg)) echo "value='" . $estilo . "'" ?>>
                    </div>
                    <div class="4u$ 12u$(medium)">
                        <label for="preco">Preço:</label>
                        <input type="text" name="preco" min="4" id="preco" placeholder="Preço 1000,00" <?php if (isset($msg)) echo "value='" . $preco . "'" ?>>
                    </div>
                    <div class="4u 12u$(medium)">
                        <label for="harmonizacao">Harmoniza com:</label>
                        <input type="text" id="harmonizacao" name="harmonizacao" placeholder="Comidas que combinam" <?php if (isset($msg)) echo "value='" . $harmonizacao . "'" ?>>
                    </div>
                    <div class="4u 12u$(medium)">
                        <label for="tipo">Tipo:</label>
                        <select name="tipo" id="tipo">
                            <option value="vermelho" <?php
                            if (isset($msg)) {
                                if ($tipo == "vermelho") {
                                    echo "selected";
                                }
                            }
                            ?>>Vermelho</option>
                            <option value="branco" <?php
                            if (isset($msg)) {
                                if ($tipo == "branco") {
                                    echo "selected";
                                }
                            }
                            ?>>Branco</option>
                            <option value="espumante" <?php
                            if (isset($msg)) {
                                if ($tipo == "espumante") {
                                    echo "selected";
                                }
                            }
                            ?>>Espumante</option>
                            <option value="rosa" <?php
                            if (isset($msg)) {
                                if ($tipo == "rosa") {
                                    echo "selected";
                                }
                            }
                            ?>>Rosa</option>
                            <option value="sobremesa" <?php
                            if (isset($msg)) {
                                if ($tipo == "sobremesa") {
                                    echo "selected";
                                }
                            }
                            ?>>Sobremesa</option>
                            <option value="porto" <?php
                            if (isset($msg)) {
                                if ($tipo == "porto") {
                                    echo "selected";
                                }
                            }
                            ?>>Porto</option>
                        </select>
                    </div>
                    <div class="4u 12u$(medium)">
                        <div class="12u">
                            <label for="rotulo">Envie o rótulo:</label>
                            <input id="uploadFile" type="text" placeholder="Choose File" disabled="disabled" />
                        </div>
                        <div class="fileUpload button">
                            <span>Upload</span>
                            <input type="file" class="upload" name="rotulo" id="rotulo" />
                        </div>
                    </div>
                    <div class="12u$">
                        <ul class="actions">
                            <li><input type="submit" onclick="" value="Cadastrar vinho" ></li>
                            <li><input type="reset" value="Reset" class="special"></li>
                        </ul>
                    </div>
                </div>
            </form>
            <hr/>
            <h4>*Informe os alimentos que harmonizam com o vinho separados por vírgula</h4>
            <h4>*Ao selecionar a sugestão de um vinho na entrada de nome você só precisa informar o preço. Você também pode informar os alimentos que harmonizam com a bebida.</h4>
        </section>
    </div>
</section>
<script src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.autocomplete.js"></script>
<script type="text/javascript" src="js/jquery.tagsinput.min.js"></script>
<script type="text/javascript">
    // Autocomplete do nome do vinho
    $("#nome").autocomplete("cadastro_vinho_Autocompletar.php", {
        width: 592,
        selectFirst: false
    });

    // Nome do arquivo no campo text
    document.getElementById("rotulo").onchange = function () {
        document.getElementById("uploadFile").value = this.value;
    };

    // Blocos do campo harmonização
    $(function () {
        $('#harmonizacao').tagsInput({width: 'auto'});
    });
</script>
<?php
include_once 'footer.php';

