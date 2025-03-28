<?php
class Database {
    private $host = "127.0.0.1";
    private $port = "3306";
    private $dbName = "projeto2025";
    private $username = "root";
    private $password = "123456";
    public $conecta;

    public function __construct() {
        try {
            $this->conecta = new PDO(
                "mysql:host=$this->host;port=$this->port;dbname=$this->dbName", 
                $this->username, 
                $this->password
            );
            $this->conecta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $erro) {
            error_log($erro->getMessage());
            die("Erro ao conectar com o banco de dados.");
        }
    }
}
