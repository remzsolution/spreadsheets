<?php


class DatabaseConnection
{

    /**
     * @var PDO
     */
    public static $pdo;

    private static $options =
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_TIMEOUT => "5"
                , PDO::ATTR_AUTOCOMMIT => FALSE
        ];

    /**
     * @return PDO
     */
    public static function getPdo(): PDO
    {
        if (DatabaseConnection::$pdo != null) {
            return DatabaseConnection::$pdo;
        }

        //TODO: Move DB credentials to file
        $host = "localhost";
        $db = "spreadsheets";
        $user = "root";
        $pass = "";
        $charset = "utf8";

        try {
            $dsn = "mysql:host={$host};dbname={$db};charset={$charset}";

            DatabaseConnection::$pdo =
                new PDO($dsn, $user, $pass, DatabaseConnection::$options);
        } catch (PDOException $e) {
            echo $e->getMessage() . "<br>";
        }

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