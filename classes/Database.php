<?php
require_once 'DBCredentials.php';
$step1 = 'mysql:host=';
Class Database extends DBCredentials {
    protected ?PDO $pdo;

    public function __construct() {
        $dsn1 = "mysql:host={$this->host}";
        $dsn2 = ";dbname={$this->dbname}";
        $dsn3 = ";charset=utf8mb4";
        $dsn = $dsn1 . $dsn2 . $dsn3;
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        $this->pdo = 
        new PDO($dsn, $this->user, $this->password, $options);
    }

    public function __destruct() {
        $this->pdo = null;
    }

}

