<?php

namespace App\Entity;
use \App\Db\Database;
use PDO;

class Vaga {

/**
 * Identificador unico da vaga
 * @var integer
 */

public $id;

/**
 *Titulo da vaga
 *@var string 
 */
public $titulo;

/**
 *Descricao da vaga (pode conter html)
 *@var string 
 */
public $descricao;

/**
 *Defini-se a vaga que esta ativa
 *@var string(s/n) 
 */
public $ativo;

/**
 *Data de publicacao da vaga
 *@var string
 */
public $data;

/**
 *Metodo responsavel por cadastrar uma vaga no banco
 *@var boolean
 */
public function cadastrar() 
{
    //DEFINIR A DATA
    $this->data = date("Y:m:d H:i:s");
     
    //INSERIR A VAGA NO BANCO
    $obDatabase = new Database('vagas');
    $this->id = $obDatabase->insert([
        'titulo'    => $this->titulo,
        'descricao' => $this->descricao,
        'ativo'     => $this->ativo,
        'data'      => $this->data
    ]); 

    //echo "<pre>"; print_r($this->id); echo "</pre>"; exit;
    //RETORNAR SUCESSO
    return true;
}

/**
 *Metodo responsavel por atualizar  a vaga denttro do banco
 *@return boolean
 */
public function atualizar(Type $var = null)
{
    return (new Database('vagas'))->update('id = '.$this->id,[
        'titulo'    => $this->titulo,
        'descricao' => $this->descricao,
        'ativo'     => $this->ativo,
        'data'      => $this->data         
    ]);
}

/**
 *Metodo responsavel por obter as vagas denttro do banco
 *@param string $where
 *@param string $order
 *@param string $limit
 *@return array
 */
public static function getVagas($where = null, $order = null, $limit = null)
{
   return (new Database('vagas'))->select($where,$order,$limit)
                                ->fetchAll(PDO::FETCH_CLASS,self::class);
}

/*
*Metodo responsavel por buscar uma vaga com base em seu ID
*@param integer $id
*@return Vaga
*/ 
public static function getVaga($id){
    return (new Database('vagas'))->select('id = '.$id)
                                  ->fetchObject(self::class);  

}

}