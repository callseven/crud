<?php

namespace App\Db;
use \PDO;
use PDOException;

class Database {
    /**
    *Nome do banco de dados
    *@var string 
    */
    const HOST = 'localhost';

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
    private $connection;

    /**
    *Define a tabela e instancia e conexao
    *@param string $table
    */

    public function __construct($table = null)
    {
        $this->table = $table;
        $this->setConnection();
    }

    /**
    *Metodo responsavel por criar uma conexao com o bd
    *
    */
    private function setConnection() {
        try{
            $this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME,self::USER,self::PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }catch (PDOException $e){
            die('ERROR: '.$e->getMessage());
        }
    }

    /**
    *Metodo responsavel por executar queries dentro no bd
    *@param string  $query
    *@return array $params
    *return PDOStatement
    */
    public function execute($query,$params = []){
        try{
            $statement = $this->connection->prepare($query);
            $statement->execute($params);
            return $statement;
        }catch (PDOException $e){
            die('ERROR: '.$e->getMessage());
        }
    }

    /**
    *Metodo responsavel por inserir dados no bd
    *@param array $values [ field => value]
    *@return integer
    */
    public function insert($values) {
        //Dados da query
        $fields = array_keys($values);
        $binds = array_pad([], count($fields),'?');
        
        //Monta a query
        $query = 'INSERT INTO '.$this->table.' ('.implode(',',$fields).') VALUES ('.implode(',',$binds).')';
        
        //EXECUTA O INSERT
        $this->execute($query,array_values($values));

        //RETORNA O ID INSERIDO 
        return $this->connection->lastInsertId();

    }
    /*
    *Metodo responsavel por executar uma consulta no banco de dados
    *@param string $where
    *@param string $order
    *@param string $limit
    *@return PDOStatement
    */
    public function select($where = null, $order = null, $limit = null, $fields = '*'){
        //dados da query
        $where = strlen($where) ? 'WHERE '.$where : '';
        $order = strlen($order) ? 'ORDER BY '.$order : '';
        $limit = strlen($limit) ? 'LIMIT '.$limit : '';
        
        //monta a query
        $query = 'SELECT '.$fields.' FROM '.$this->table.' '.$where.' '.$order.' '.$limit;

        //executa a query
        return $this->execute($query);
    }

    /*
    *Metodo responsavel por executar atualizacoes no banco de dados
    *@param string $where
    *@param array $values [field => value]
    *@return boolean
    */
    public function update($where,$values){

        //dados da query
        $fields = array_keys($values);

        //monta query
        $query = 'UPDATE '.$this->table.' SET '.implode('=?,',$fields).'=? WHERE '.$where;
        //executar a query
        $this->execute($query,array_values($values )); 
        
    }


}