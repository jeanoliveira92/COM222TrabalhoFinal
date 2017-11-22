<?php

$i;
$j = 41;
$bool = 0;

// 0 - 2 - 5 - 7 | 0% - 49% [0-100]
/*
  for ($i = 0; $i <= 100; $i += 1) {

  if($i%10 == 0 || ($i-2)%10 == 0 || ($i-5)%10 == 0 || ($i-7)%10 == 0){
  echo "'" . $j . "%': " . $i . ",";
  $j++;
  }

  } */

 //10 em 10 | 89% - 49% [500-1000]
 /*for ($i = 110; $i <= 600; $i += 10) {
  echo "'" . $j . "%': " . $i . ",";
  $j++;
}*/

// 10 em 10 | 89% - 49% [500-1000]
/* for ($i = 550; $i <= 1000; $i += 50) {
  echo "'" . $j . "%': " . $i . ",";
  $j++;
  } */

//for ($i = 1, $j = 1; $i < 5, $j < 100; $i += 0.1, $j += 2.5) {
  //      echo "'" . $j . "%': " . $i . ", ";
   // }

for($i = 0; $i < 10; i++){
    echo "INSERT INTO vinho values (null, `rotulo`, `produtor`, `nome`, `regiao`, `paisorigem`, `avaliacao`, `preco`, `numavaliacoes`, `tipo`, `tipouva`, `estilo`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12])
}