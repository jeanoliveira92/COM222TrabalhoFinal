<?php

include_once 'DAO.php';
$banco = new DAO();

$tipo;
$low;
$upp;
$rate;

if (isset($_GET['tipo'])) {
    $tipo = $_GET['tipo'];
}
if (isset($_GET['low'])) {
    $low = $_GET['low'];
}
if (isset($_GET['upp'])) {
    $upp = $_GET['upp'];
}
if (isset($_GET['rate'])) {
    $rate = $_GET['rate'];
}

include_once 'DAO.php';
$banco = new DAO();

$banco->buscar("vinho");
$banco->where(array("tipo='".$tipo."'"));//, "value > ".$low." AND value < ".$upp, "avaliacao >=".$rate));
$result = $banco->executar();

//echo $banco->sql;
//echo $banco->numLinhasAfetadas($result);