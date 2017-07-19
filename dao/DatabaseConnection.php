<?php

class DatabaseConnection
{

    /**
     * @var PDO
     */
    public static $pdo;

    private $host = "localhost";
    private $db = "spreadsheets";
    private $user = "root";
    private $pass = "";
    private $charset = "utf8";

    public function __construct()
    {
        try {
            $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
            $opt = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_TIMEOUT => "5"
//                , PDO::ATTR_AUTOCOMMIT => FALSE
            ];
            if (DatabaseConnection::$pdo == null) {
                DatabaseConnection::$pdo = new PDO($dsn, $this->user, $this->pass, $opt);
            }
        } catch (PDOException $e) {
            echo $e->getMessage() . "<br";
        }
    }

    /**
     * @return PDO
     */
    public function getPdo(): PDO
    {
        return DatabaseConnection::$pdo;
    }

    public static function beginTransaction()
    {
        DatabaseConnection::$pdo->beginTransaction();
    }

    public static function rollBack()
    {
        if (DatabaseConnection::$pdo->inTransaction()) {
            DatabaseConnection::$pdo->rollBack();
        }
    }

    public static function commit()
    {
        if (DatabaseConnection::$pdo->inTransaction()) {
            DatabaseConnection::$pdo->commit();
        }
    }
}