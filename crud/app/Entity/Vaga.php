<?php

namespace App\Entity;

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

    //ATRIBUIR O ID NA VAGA DA INSTANCIA

    //RETORNAR SUCESSO

}



}