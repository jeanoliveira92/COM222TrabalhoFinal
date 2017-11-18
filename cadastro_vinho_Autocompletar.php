<?php

include_once("mysqlconfig.php");

$q = $_GET['q'];

//$mysqli=mysqli_connect('localhost','vinumweb','vinumweb','vinumweb') or die("Falha ao buscar vinhos no banco");
$dao = banco();

$dao->buscar("vinho", array("nome"));
$dao->where(array("nome LIKE '%" . $q . "%'"));
//$sql="SELECT nome FROM vinho WHERE nome LIKE '%".$q."%'";

$result = $dao->executar();
//$result = mysqli_query($mysqli,$sql) or die(mysqli_error());

while ($row = mysqli_fetch_array($result)) {
    echo $row['nome'] . "\n";
}
?>