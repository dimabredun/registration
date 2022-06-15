<?php

class DbConnection
{
    private ?PDO $pdo = null;

    private string $host = '127.0.0.1';
    private string $dbName = 'login_register';
    private string $dbUser = 'log_reg';
    private string $charset = 'utf8mb4';
    private string $dbPassword = 'Pass*001';

    public function getPdo(): PDO
    {
        $dsn = "mysql:host=$this->host;dbname=$this->dbName;charset=$this->charset";

        try {
            $this->pdo = new PDO($dsn, $this->dbUser, $this->dbPassword);

            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $exception) {
            echo 'Connection failed - '. $exception->getMessage();
        }

        return $this->pdo;
    }
}