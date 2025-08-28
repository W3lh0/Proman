<?php

namespace core;

class Connection 
{
    private string $host;
    private string $userName;
    private string $password;
    private string $dbName;
    private array $options = [];
    private \PDO $dbconnection;

    public function __construct(string $host, string $dbName, string $userName, string $password, array $options = []) 
    {
        $this->host = $host;
        $this->userName = $userName;
        $this->password = $password;
        $this->dbName = $dbName;
        $this->options = $options;

        $dns = "mysql:host={$this->host};dbname={$this->dbName};charset=utf8mb4";

        try {
            $this->dbconnection = new \PDO($dns, $this->userName, $this->password, $this->options);
        } catch (\PDOException $err) {
            die("Database connection failed: " . $err->getMessage());
        }
    }

    public function getConnection(): \PDO
    {
        return $this->dbconnection;
    }
}