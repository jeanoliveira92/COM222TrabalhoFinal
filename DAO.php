<?php

include_once('iDAO.php');

class DAO implements iDAO{
    public $sql = '';
    public $banco;
    
    /**
     * Método construtor - Conecta com Mysql
     */
    public function __construct(){
   	 $this->banco = new mysqli("localhost","vinumweb","vinumweb","vinumweb");
    }
    
    /**
     * Realiza um SELECT no banco de dados
     * @param $nometabela tabela alvo da busca
     * @param array $atributos lista dos atributos a serem selecionados, um array
     */
    public function buscar($nometabela, array $atributos = NULL)
    {
        if($atributos == NULL)
        {
            $this->sql = 'SELECT * FROM '.$nometabela;
        } 
        else
        {
            $this->sql = 'SELECT ';
            foreach ($atributos as $atributo)
            {
                $this->sql.=$atributo.', ';
            }
            $this->sql = rtrim($this->sql,', ').' FROM '.$nometabela;
        }
  }
  
  /**
   * Insere uma tupla em derterminada tabela do banco
   * @param $nometabela tabela alvo da inserção
   * @param array $atributos lista de atributos e valores a serem inseridos, no formato registro = ('atributo' => 'valor')
   */
  public function cadastro($nometabela,array $atributos) {
    $this->sql = 'INSERT INTO '.$nometabela.' ';
    $helper = array('(','(');
    //Inserir atributos e seus valores em variaveis
    foreach ($atributos as $atributo => $valor)
    {
      $helper[0] .=$atributo.',';
      $helper[1] .="'".$valor."',";
    }
    //Adicionar atributos e valores ao sql
    $this->sql.=rtrim($helper[0],',').') VALUES '.rtrim($helper[1],',').')';
  }
  
  /**
   * Atualiza determinados atributos de uma tabela sql.
   * @param type $nometabela tabela alvo do update
   * @param array $atributos array com atributos e valores a serem alterados, no formato registro = ('atributo' => 'valor')
   */
  public function atualizacao($nometabela, array $atributos) {
    $this->sql = 'UPDATE '.$nometabela.' SET ';
    
    //Adicionar atributos e valores ao sql
    foreach ($atributos as $atrib => $valor)
    {
      $this->sql.=$atrib."='".$valor."', ";
    }
    $this->sql = rtrim($this->sql,', ');
  }
  
  /**
   * Remove dados de uma tabela. Deve ser adicionada condicao where para remover apenas alguns registros
   * @param $nometabela nome da tabela que serão removidos os dados
   */
  public function remocao($nometabela)
  {
    $this->sql = 'DELETE FROM '.$nometabela;
  }
  
  /**
   * Acrescenta um filtro condicional (where) na consulta sql
   * @param $condicoes filtros aplicados no where
   */
  public function where(array $condicoes)
  {
    $this->sql .= ' WHERE ';
    
    //Adicionar todas as condicoes do array no SQL
    foreach ($condicoes as $condicao)
    {
      $this->sql.=$condicao.' AND ';
    }
    //Remover o AND que esta sobrando
    $this->sql = rtrim($this->sql,' AND ');
  }
  
  /**
   * Adiciona um critério de ordenação a consulta SQL
   * @param type $atributo atributo de ordenacao
   */
  public function ordenacao($atributo)
  {
    $this->sql .= ' ORDER BY '.$atributo.'asc';    
  }

  /**
   * Executa uma consulta no banco e retorna os resultados da consulta
   * @return resultado da consulta
   */
  public function executar()
  {
      return $this->banco->query($this->sql);
  }
  
  /**
   * Obter código SQL presente no DAO
   * @return codigo SQL
   */
  public function obterSQL()
  {
      return $this->sql;
  }
}
