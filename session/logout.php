<?php

// Inicia sessões, para assim poder destruí-las 
session_start();
// Deleta a id
session_unset("id");
// Deleta o nome
session_unset("nome");
// Destroi a sessao
session_destroy();
// coloca um tempo negativo ao cookie, invalidando o mesmo
setcookie("email", "", time() - 3600);
setcookie("senha", "", time() - 3600);

header("Location: ../index.php");
?>