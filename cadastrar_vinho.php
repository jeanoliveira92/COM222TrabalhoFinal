<?php

include_once('DAO.php');

//Obter nome,alimentos que harmonizam e preço do formulario
$nome           = $_POST['nome'];
$harmonizacao   = $_POST['harmonizacao'];
$preco          = $_POST['preco'];

//Criar DAO
$banco = new DAO();

//Verificar se o vinho ja esta cadastrado no banco
$banco->buscar('vinho', null);
$banco->where(array("nome='" . $nome . "'"));
$resultado = $banco->executar();

//Caso nao foi, cadastrar
if (mysqli_num_rows($resultado) == 0) {
    //Obter demais dados do vinho
    $produtor   = $_POST['produtor'];
    $pais       = $_POST['pais'];
    $regiao     = $_POST['regiao'];
    $tipouva    = $_POST['tipouva'];
    $estilo     = $_POST['estilo'];
    $tipo       = $_POST['tipo'];
    $rotulo     = $_FILES['rotulo'];

    if (!empty($rotulo["name"])) {

        echo $_FILES['rotulo']['tmp_name'];

        //validar se é uma imagem
        if (preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $rotulo["type"])) {

            // Pega extensão da imagem
            preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $rotulo["name"], $ext);

            // Gera um nome único para a imagem
            $nome_imagem = md5(uniqid(time())) . "." . $ext[1];

            // Caminho de onde ficará a imagem
            $caminho_imagem = "/rotulos/" . $nome_imagem;

            // Faz o upload da imagem para seu respectivo caminho
            move_uploaded_file($rotulo["tmp_name"], $caminho_imagem);

            //Gerar array pares atributo=>valor
            $dados = array('nome' => $nome, 'produtor' => $produtor, 'preco' => $preco, 'paisorigem' => $pais, 'regiao' => $regiao, 'tipouva' => $tipouva, 'estilo' => $estilo, 'tipo' => $tipo, 'rotulo' => $nome_imagem);

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
                $id = $vinho['id'];

                //Sucesso no cadastro do vinho
                echo "<h2>O novo vinho foi cadastrado!</h2>";
            }
        } else {
            echo "<h2>O rótulo do vinho é inválido!</h2>";
        }
    }
} else {
    //Como o vinho já é cadastrado, adicionar apenas as harmonizações
    $vinho = mysqli_fetch_assoc($resultado);
    adicionarHarmonizacao($banco, $harmonizacao, $vinho['id']);

    //Validar se o usuario informou novo preco
    if (!($preco == NULL || $preco == "")) {
        //Calcular e definir media de preco do vinho
        $consulta = 'CALL atualiza_preco(' . $preco . ',' . $vinho['id'] . ')';
        $banco->setSQL($consulta);
        $banco->executar();

        //Adicionar vinho do usuario
    }
}

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

?>