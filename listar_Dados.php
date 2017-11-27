<?php

$consulta = array();

include_once 'DAO.php';
$banco = new DAO();

// Limitador de preços
if (isset($_GET['low']) && isset($_GET['upp'])) {
    // Se a barra estiver no maximo, deve pegar todos os valores acima do low
    if($_GET['upp'] == 1300){
        array_push($consulta, "(preco >'" . $_GET['low'] . "')");
    }else{
        array_push($consulta, "(preco >'" . $_GET['low'] . "' AND preco < '" . $_GET['upp'] . "')");
    }
}

// Verifica a avaliação minima
if (isset($_GET['rate'])) {
    array_push($consulta, "(avaliacao >='" . $_GET['rate'] . "')");
}

// Verifica se veio algum tipo, se veio, for uma variavel (index), ou vetor(listar)
if (isset($_GET['tipo'])) {
    if (is_array($_GET['tipo'])) {
        // Faz loop pelo array dos tipos
        $temp = array();
        foreach ($_GET['tipo'] as $var) {
            array_push($temp, "tipo='" . $var . "'");
        }
        $banco->ou($temp);
        array_push($consulta, "(" . $banco->sql . ")");
    } else {
        array_push($consulta, "(tipo='" . $_GET['tipo'] . "')");
    }
}

// Verifica se veio algum tipo de uva
if (isset($_GET['uva'])) {
    // Faz loop pelo array dos tipos
    $temp = array();
    foreach ($_GET['uva'] as $var) {
        array_push($temp, "tipouva='" . $var . "'");
    }
    $banco->ou($temp);
    array_push($consulta, "(" . $banco->sql . ")");
}

// Verifica se veio algum pais
if (isset($_GET['pais'])) {
    // Faz loop pelo array dos tipos
    $temp = array();
    foreach ($_GET['pais'] as $var) {
        array_push($temp, "paisorigem='" . $var . "'");
    }
    $banco->ou($temp);
    array_push($consulta, "(" . $banco->sql . ")");
}

// Verifica se veio algum estilo
if (isset($_GET['estilo'])) {
    // Faz loop pelo array dos tipos
    $temp = array();
    foreach ($_GET['estilo'] as $var) {
        array_push($temp, "estilo='" . $var . "'");
    }
    $banco->ou($temp);
    array_push($consulta, "(" . $banco->sql . ")");
}

// Verifica se veio algum tipo de alimento
if (isset($_GET['alimento'])) {
    // Faz loop pelo array dos tipos
    // usar temporariamente a query global para construir o union
    $banco->buscar("harmonizacao", array("idvinho"));
    $harWhere = array();

    foreach ($_GET['alimento'] as $var) {
        array_push($harWhere, "alimento='" . $var . "'");
    }
    $banco->whereOu($harWhere);
    array_push($consulta, "id in (" . $banco->sql . ")");
}

$banco->buscar("vinho");
$banco->where($consulta);

$result = $banco->executar();


//echo json_encode($consulta);
//echo $banco->sql;
//echo $banco->numLinhasAfetadas($result);