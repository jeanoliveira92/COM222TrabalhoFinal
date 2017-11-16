<?php

interface iDAO {
    public function buscar($nometabela, array $atributos = NULL);
    public function cadastro($nometabela,array $atributos);
    public function atualizacao($nometabela, array $atributos);
    public function remocao($nometabela);
    public function where(array $condicoes);
    public function executar();
}
