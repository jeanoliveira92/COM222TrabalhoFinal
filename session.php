<?php
// Usuário não logado! Redireciona para a página de login
if (!isset($_SESSION["id"])) {
    // Usuário não logado! Redireciona para a página de login
    header("Location: logon.php?connect=1");
}
?> 