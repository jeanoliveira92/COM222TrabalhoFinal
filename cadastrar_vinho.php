<?php

include_once('DAO.php');
$msg = "";
$error = 0;

//Obter nome,alimentos que harmonizam e preço do formulario
$nome = addslashes($_POST['nome']);
$harmonizacao = addslashes($_POST['harmonizacao']);
$preco = addslashes($_POST['preco']);

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

    //Verificar se o vinho ja esta cadastrado no banco
    $banco->buscar('vinho', null);
    $banco->where(array("nome='" . $nome . "'"));
    $resultado = $banco->executar();

    //Caso nao foi, cadastrar
    if (mysqli_num_rows($resultado) == 0) {
        //Obter demais dados do vinho
        $produtor = addslashes($_POST['produtor']);
        $pais = addslashes($_POST['pais']);
        $regiao = addslashes($_POST['regiao']);
        $tipouva = addslashes($_POST['tipouva']);
        $estilo = addslashes($_POST['estilo']);
        $tipo = addslashes($_POST['tipo']);
        $rotulo = $_FILES['rotulo'];

        // Verifica campos vazios
        if (empty($produtor)) {
            $msg = "Campo produtor em branco";
            $erro = 1;
        } else if (empty($pais)) {
            $msg = "Campo país em branco";
            $erro = 1;
        } else if (empty($regiao)) {
            $msg = "Campo região em branco";
            $erro = 1;
        } else if (empty($tipouva)) {
            $msg = "Campo tipo de uva em branco";
            $erro = 1;
        } else if (empty($estilo)) {
            $msg = "Campo estilo em branco";
            $erro = 1;
        } else if (empty($tipo)) {
            $msg = "Campo tipo em branco";
            $erro = 1;

            // Verifica por caracteres especiais 
        } else if (substr_count($produtor, "\\")) {
            $msg = "Campo nome invalido. Contém: aspas simples/duplas, barras ou valor NULL";
            $erro = 1;
        } else if (substr_count($pais, "\\")) {
            $msg = "Campo harmonizacao invalido. Contém: aspas simples/duplas, barras ou valor NULL";
            $erro = 1;
        } else if (substr_count($regiao, "\\")) {
            $msg = "Campo preco invalido. Contém: aspas simples/duplas, barras ou valor NULL";
            $erro = 1;
        } else if (substr_count($tipouva, "\\")) {
            $msg = "Campo preco invalido. Contém: aspas simples/duplas, barras ou valor NULL";
            $erro = 1;
        } else if (substr_count($estilo, "\\")) {
            $msg = "Campo preco invalido. Contém: aspas simples/duplas, barras ou valor NULL";
            $erro = 1;
        } else if (substr_count($regiao, "\\")) {
            $msg = "Campo preco invalido. Contém: aspas simples/duplas, barras ou valor NULL";
            $erro = 1;
            // Validar se carregou uma imagem
        } else if (empty($rotulo["name"])) {
            $msg = "Não há imagem carregada";
            $erro = 1;
            //Validar se é uma imagem
        } else if (!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $rotulo["type"])) {
            $msg = "Arquivo carregado nao é uma imagem";
            $eror = 2;

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
                $id = $vinho['id'];

                //Sucesso no cadastro do vinho
                echo "<h2>O novo vinho foi cadastrado!</h2>";
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
}

echo $msg;


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


