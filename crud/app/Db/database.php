<?php

namespace App\Db;
use \PDO;

class Database {
    /**
    *Nome do banco de dados
    *@var string 
    */
    const HOST = 'db';

    /**
    *Nome do banco de dados
    *@var string 
    */
    const NAME = 'wdev_vagas';

    /**
    *Usuario do banco de dados
    *@var string 
    */
    const USER = 'root';

    /**
    *Senha do banco de dados
    *@var string 
    */
    const PASS = '';

    /**
    *Nome da tabela a ser manipulada
    *@var string 
    */
    private $table;

    /**
    *instancia de conexao com bd
    *@var  PDO
    */
    private $conection;

    /**
    *Define a tabela e instancia e conexao
    *@param string 
    */
    const HOST = 'db';

    public function __construct($table = null)
    {
        $this->table = $table;
    }



}