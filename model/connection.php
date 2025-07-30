<?php

class Connection 
{
    private string $host;
    private string $userName;
    private string $password;
    private string $dbName;
    private array $options;
    private PDO $dbconnection;

    public function __constructor(string $host, string $dbName, string $userName, string $password, array $options = []) 
    {
        $this->host = $host;
        $this->userName = $userName;
        $this->password = $password;
        $this->dbName = $dbName;
        $this->$option = $options;

        $dns = "mysql:host{$this->host};dbname{$this->dbName};charset=utf8mb4";

        try {
            $this->pdo = new PDO($dns, $this->userName, $this->password, $this->options);

            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        } catch (PDOException $err) {
            die("Database connection failed: " . $err->getMessage());
        }
    }

    public function getConnection(): PDO
    {
        return $this->dbconnection;
    }
}