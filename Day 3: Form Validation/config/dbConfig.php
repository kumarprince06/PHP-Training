<?php

class DatabaseConfiguration
{
    private $serverName = "localhost";
    private $databaseName = "fromvalidation";
    private $username = "root";
    private $password = "#M.S.Dhoni07@";
    public $db;

    public function databaseConnection()
    {
        // Connect to database
        try {
            $conn = new PDO("mysql:host=" . $this->serverName . ";dbname=" . $this->databaseName, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db = $conn;
            return $conn;
        } catch (PDOException $e) {
            // Throw Exception
            die("Failed to connect with MySQL: " . $e->getMessage());
        }
    }
}
