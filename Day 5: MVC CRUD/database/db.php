<?php
class Database
{
    private $host = "localhost"; // Server name
    private $db_name = "mvc_crud"; // Database name
    private $username = "root";  // Database User Name
    private $password = "#M.S.Dhoni07@";      // Database user password
    public $conn;

    public function getConnection()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
