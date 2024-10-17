<?php

class DB {
    private $serverName = "localhost";
    private $databaseName = "crud";
    private $username = "root";
    private $password = "#M.S.Dhoni07@";
    public $db;

    public function __construct() {
        // Connect to database
        try {
            $conn = new PDO("mysql:host=".$this->serverName.";dbname=".$this->databaseName, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db = $conn;
        } catch (PDOException $e) {
            // Throw Exception
            die("Failed to connect with MySQL: " . $e->getMessage());
        }
    }

    public function getRows($table, $conditions = array()) { 
        // Build SQL query
        // Prepare and execute the query
        // Process and return the results
    }
    
}

?>
