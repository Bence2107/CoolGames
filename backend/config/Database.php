<?php

class Database {
    private static ?Database $instance = null;
    private PDO $connection;

    private string $host = "localhost";
    private string $user = "root";
    private string $pass = "";
    private string $database = "coolgames";
    private string $sqlFilePath = __DIR__ . "/../sql/coolgames.sql";

    private function __construct() {
        try {
            $dsn = "mysql:host=$this->host;charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            $this->connection = new PDO($dsn, $this->user, $this->pass, $options);

            if(!$this->databaseExists()){
                $this->createDatabase();
            }
            else {
                $this->connection->exec("USE `$this->database`");
            }
        }
        catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance() : Database {
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }

    private function databaseExists() : bool {
        try {
            $stmt = $this->connection->prepare("SHOW DATABASES LIKE ?");
            $stmt->execute([$this->database]);
            return $stmt->fetch() !== false;
        }
        catch (PDOException $e) {
            error_log("Database query failed: " . $e->getMessage());
            return false;
        }
    }

    private function createDatabase(): void
    {
        try{
            $this->connection->exec("CREATE DATABASE IF NOT EXISTS `$this->database`");
            $this->connection->exec("USE `$this->database`");
            if (file_exists($this->sqlFilePath)) {
                $sql = file_get_contents($this->sqlFilePath);
                $this->connection->exec($sql);
            } else {
                error_log("SQL file not found at: " . $this->sqlFilePath);
            }
        }
        catch (PDOException $e) {
            die("Database create / import failed: " . $e->getMessage());
        }
    }
}