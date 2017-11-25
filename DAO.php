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
  * Os atributos que tem lista antes sao arrays, os demais, valores.
  *
  */
  public function buscarVinhos($precomin,$precomax,$listaTipoVinho,$listaUvas,$avaliacao,$listaPaises,$listaEstilos,$listaComida) {

    $and = true;

    //Consulta base: Leva em consideracao precos e avaliacao
    $this->sql = 'SELECT * FROM vinho where (preco>='.$precomin.' AND preco<='.$precomax.') AND avaliacao >= '.$avaliacao;

    // Inserir tipos de vinho, caso necessario
    if($listaTipoVinho != NULL) {
      if($and == true){
        $this->sql .= ' AND';
      } else {
        $and = true;
      }

      $this->sql .= ' (';
      foreach ($listaTipoVinho as $tipo) {
        $this->sql .= "tipo='".$tipo."' or ";
      }
      $this->sql = rtrim($this->sql,' or ');
      $this->sql .= ')';
    }

    // Inserir lista de uvas, caso necessario
    if($listaUvas != NULL) {
      if($and == true){
        $this->sql .= ' AND';
      } else {
        $and = true;
      }
      $this->sql .= ' (';
      foreach ($listaUvas as $uva) {
        $this->sql .= "tipouva='".$uva."' or ";
      }
      $this->sql = rtrim($this->sql,' or ');
      $this->sql .= ')';
    }

    // Inserir lista de paises, caso necessario
    if($listaPaises != NULL) {
      if($and == true){
        $this->sql .= ' AND';
      } else {
        $and = true;
      }
      $this->sql .= ' (';
      foreach ($listaPaises as $pais) {
        $this->sql .= "paisorigem='".$pais."' or ";
      }
      $this->sql = rtrim($this->sql,' or ');
      $this->sql .= ')';
    }

    // Inserir lista de estilos, caso necessario
    if($listaEstilos != NULL) {
      if($and == true){
        $this->sql .= ' AND';
      } else {
        $and = true;
      }
      $this->sql .= ' (';
      foreach ($listaEstilos as $estilo) {
        $this->sql .= "estilo='".$estilo."' or ";
      }
      $this->sql = rtrim($this->sql,' or ');
      $this->sql .= ')';
    }

    // Inserir lista de harmonizacoes, caso necessario
    if($listaComida != NULL) {
      $this->sql .= ' AND id in ( select idvinho from harmonizacao where ';

      foreach ($listaComida as $comida) {
        $this->sql .= "alimento='".$comida."' or ";
      }
      $this->sql = rtrim($this->sql,' or ');
      $this->sql .= ')';
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
  public function ordenacao($atributo,$asc)
  {
       if($asc == true){
        $this->sql .= ' ORDER BY '.$atributo.' asc'; 
      } else {
        $this->sql .= ' ORDER BY '.$atributo.' desc'; 
      }
  }

  /**
  *Adiciona um group By na consulta. Asc é booleano, informando a ordem ascendente ou não
  * @param $atributo Ordenado de acordo com esse atributo
  * @param $asc atributo boolean, se for true é ordenado de forma ascendente
  */
  public function agrupar($atributo,$asc)
  {
    if($asc == true)
    {
      $this->sql .= ' GROUP BY '.$atributo.'asc';
    } else {
      $this->sql .= ' GROUP BY '.$atributo.'desc';
    }
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
   * Define o SQL que será realizado no banco, de forma direta
   * @return resultado da consulta
   */
  public function setSQL($consulta)
  {
    $this->sql = $consulta;
  }
  
  /**
   * Obter código SQL presente no DAO
   * @return codigo SQL
   */
  public function obterSQL()
  {
      return $this->sql;
  }

  /**
  * Recebe um Mysqli_Result e retorna o número de linhas afetadas no BD
  * @param $resultado É o resultado da consulta Mysql
  * @return número de linhas afetadas
  */
  public function numLinhasAfetadas($resultado)
  {
    return mysqli_num_rows($resultado);
  }
}
