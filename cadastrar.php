<?php
	$q=$_GET['q'];

	$mysqli=mysqli_connect('localhost','vinumweb','vinumweb','vinumweb') or die("Falha ao buscar vinhos no banco");
	
	$sql="SELECT nome FROM vinho WHERE nome LIKE '%".$q."%'";
	
	$result = mysqli_query($mysqli,$sql) or die(mysqli_error());
	
	if($result)
	{
		while($row=mysqli_fetch_array($result))
		{
			echo $row['nome']."\n";
		}
	}
?>