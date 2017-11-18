<?php

// Cria a conexão com o banco
function banco() {
    include_once("../DAO.php");
    $servidor = 'localhost';
    $user = 'vinumweb';
    $senha = 'vinumweb';
    $banco = 'vinumweb';

    $dao = new DAO($servidor, $user, $senha, $banco);
    
    return $dao;
}

?>