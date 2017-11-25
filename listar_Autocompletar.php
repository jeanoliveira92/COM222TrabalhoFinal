<?php
$consulta = array();

// Limitador de preços
if(isset($_GET['low']) && isset($_GET['upp'])){
    array_push($consulta, "preco >'".$_GET['low']."' AND preco < '".$_GET['upp']."'");
}

// Verifica a avaliação minima
if(isset($_GET['rate'])){
    array_push($consulta, "avaliacao >='".$_GET['rate']."'");
}

// Verifica se veio algum tipo, se veio, for uma variavel (index), ou vetor(listar)
if(isset($_GET['tipo']) && is_array($_GET['tipo'])){    
    // Faz loop pelo array dos tipos
    foreach($_GET['tipo'] as $var){
        array_push($consulta, "tipo='".$var."'");
        $tipo = $var;
    }
} else{
    array_push($consulta, "tipo='".$_GET['tipo']."'");
}

// Verifica se veio algum tipo de uva
if(isset($_GET['uva'])){    
    // Faz loop pelo array dos tipos
    foreach($_GET['uva'] as $var){
        array_push($consulta, "tipouva='".$var."'");
    }
}

// Verifica se veio algum pais
if(isset($_GET['pais'])){    
    // Faz loop pelo array dos tipos
    foreach($_GET['pais'] as $var){
        array_push($consulta, "paisorigem='".$var."'");
    }
}

// Verifica se veio algum estilo
if(isset($_GET['estilo'])){    
    // Faz loop pelo array dos tipos
    foreach($_GET['estilo'] as $var){
        array_push($consulta, "estilo='".$var."'");
    }
}


// Verifica se veio algum tipo de alimento
if(isset($_GET['alimento'])){    
    // Faz loop pelo array dos tipos
    foreach($_GET['alimento'] as $var){
        array_push($consulta, "alimento='".$var."'");
    }
}

include_once 'DAO.php';
$banco = new DAO();

$banco->buscar("vinho");
$banco->where($consulta);

$result = $banco->executar();

//echo json_encode($consulta);
echo $banco->sql;
//echo $banco->numLinhasAfetadas($result);