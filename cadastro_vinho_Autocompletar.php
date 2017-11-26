<?php

include_once("DAO.php");

$q = $_GET['q'];

//$mysqli=mysqli_connect('localhost','vinumweb','vinumweb','vinumweb') or die("Falha ao buscar vinhos no banco");
$dao = new DAO;

$dao->buscar("vinho", array("nome"));
$dao->where(array("nome LIKE '%" . $q . "%' LIMIT 10"));
//$sql="SELECT nome FROM vinho WHERE nome LIKE '%".$q."%'";

$result = $dao->executar();
//$result = mysqli_query($mysqli,$sql) or die(mysqli_error());

while ($row = mysqli_fetch_array($result)) {
    echo $row['nome'] . "\n";
}
?>